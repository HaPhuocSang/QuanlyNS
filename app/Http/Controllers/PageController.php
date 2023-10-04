<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\ContactMail;
use App\Mail\BillMail;
use App\Models\Book;
use App\Models\Contact;
use App\Models\Banner;
use App\Models\Bill;
use App\Models\Bill_Detail;
use App\Models\Type_book;
use App\Models\Cart;
use App\Models\User;
use App\Models\Import_product;
use App\Models\Warehouse;

class PageController extends Controller
{
    //
    public function getHomepage()
    {
        $books = Book::orderBy('created_at', 'desc')->get();
        $banners = Banner::all();
        return view('product.index', compact('books', 'banners'));
    }
    public function getBookpage($id)
    {
        $book = Book::where('id', $id)->first(); // Sử dụng first() để lấy một đối tượng duy nhất
        return view('product.book-page', compact('book'));
    }
    public function getTypebook($id)
    {
        $books = Book::where('id_type', $id)->get();
        $type_book = Type_book::where('id', $id)->get();
        return view('product.category', compact('books'), array('type_book' => $type_book));
    }
    public function getContact()
    {
        return view('product.contact');
    }
    public function postContact(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone_number' => 'required|numeric',
            'email' => 'required|email',
            'content' => 'required',
        ], [
            'name.required' => 'Bạn chưa nhập Họ tên',
            'phone_number.required' => 'Bạn chưa nhập số điện thoại',
            'phone_number.numeric' => 'Số điện thoại phải là kiểu số',
            'email.required' => 'Bạn chưa nhập email',
            'email.email' => 'Địa chỉ email không hợp lệ',
            'content.required' => 'Bạn chưa nhập nội dung',
        ]);

        $contact = new Contact();
        $contact->name = $request->name;
        $contact->phone_number = $request->phone_number;
        $contact->email = $request->email;
        $contact->content = $request->content;
        $contact->save();

        $sentData = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'message' => $request->input('content'),
            'phone_number' => $request->input('phone_number'),
        ];
        // Gửi email cho bạn
        Mail::to('haphuocsang.dn2003@gmail.com')->send(new ContactMail($sentData));

        return redirect()->route('getContact')->with('success', 'Gửi thành công!');
    }
    public function addToCart(Request $request, $id)
    {
        $warehouse = Warehouse::where('id_book', $id)->first();
        if ($warehouse && $warehouse->quantity >= 1) {
            // Lấy thông tin sản phẩm
            $book = Book::find($id);
            $oldCart = $request->session()->has('cart') ? $request->session()->get('cart') : null;
            $cart = new Cart($oldCart);
            $cart->add($book, $id);
            $request->session()->put('cart', $cart);
            return redirect()->back();
        } else {
            return redirect()->back()->with('error', 'Sản phẩm đã hết hàng!');
        }
    }
    public function increaseQuantity($id)
    {
        $cart = session()->has('cart') ? new Cart(session('cart')) : new Cart();

        $cart->increaseQuantity($id);

        session(['cart' => $cart]);

        return redirect()->back();
    }
    public function decreaseQuantity($id)
    {
        $cart = session()->has('cart') ? new Cart(session('cart')) : new Cart();

        $cart->decreaseQuantity($id);

        if ($cart->isEmpty()) {
            session()->forget('cart'); // Xóa giỏ hàng nếu trống
        } else {
            session(['cart' => $cart]);
        }

        return redirect()->back();
    }
    //thêm 1 sản phẩm có số lượng >1 có id cụ thể vào model cart rồi lưu dữ liệu của model cart vào 1 session có tên cart (session được truy cập bằng thực thể Request)
    public function addManyToCart(Request $request, $id)
    {
        $warehouse = Warehouse::where('id_book', $id)->first();
        if ($warehouse && $warehouse->quantity >= $request->input('qty')) {
            $book = Book::find($id);
            $oldCart = Session('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart);
            $cart->addMany($book, $id, $request->input('qty'));
            $request->session()->put('cart', $cart);
            return redirect()->back();
        } 
        elseif($warehouse->quantity > 1){
            return redirect()->back()->with('error', 'Sản phẩm không đủ hàng để cung cấp!');
        }
        else {
            return redirect()->back()->with('error', 'Sản phẩm đã hết hàng!');
        }
    }
    public function updateQuantity(Request $request, $productId)
    {
        $newQuantity = $request->input('newQuantity');

        // Lấy giỏ hàng từ session
        $oldCart = session()->has('cart') ? session()->get('cart') : null;
        $cart = new Cart($oldCart);

        // Sử dụng phương thức updateQuantity() để cập nhật số lượng
        $cart->updateQuantity($productId, $newQuantity);

        // Lưu giỏ hàng đã cập nhật vào session
        session()->put('cart', $cart);

        return redirect()->back();
    }
    public function delCartItem($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else Session::forget('cart');
        return redirect()->back();
    }
    public function getSignup()
    {
        return view('product.sign-up');
    }
    public function postSignup(Request $req)
    {
        $this->validate(
            $req,
            [
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|max:20',
                'full_name' => 'required',
                'repassword' => 'required|same:password',
                'phone' => 'required|numeric|min:10'
            ],
            [
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Không đúng định dạng email',
                'email.unique' => 'Email đã có người sử  dụng',
                'password.required' => 'Vui lòng nhập mật khẩu',
                'repassword.same' => 'Mật khẩu không giống nhau',
                'password.min' => 'Mật khẩu ít nhất 6 ký tự',
                'password.max' => 'Mật khẩu nhỏ hơn 20 ký tự',
                'phone.required' => 'Số điện thoại ít nhất 10 ký tự',
                'phone.numeric' => 'Số điện thoại phải là kiểu số',
                'phone.min' => 'Số điện thoại ít nhất 10 kí tự',
                'full_name' => 'Chưa nhập họ tên',
            ]
        );

        $user = new User();
        $user->full_name = $req->full_name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->phone = $req->phone;
        $user->image = "daidien.jpg";
        $user->level = 3;  //level=1: admin; level=2:kỹ thuật; level=3: khách hàng
        $user->save();
        return redirect()->back()->with('success', 'Tạo tài khoản thành công');
    }
    public function getCheckout()
    {
        return view('product.checkout');
    }
    public function postCheckout(Request $request)
    {
        if (!Session::has('cart') || empty(Session::get('cart')->items)) {
            return redirect()->back()->with('error', 'Giỏ hàng của bạn đang trống. Vui lòng thêm sản phẩm vào giỏ hàng trước.');
        }
        else{
            $this->validate(
                $request,
                [
                    'name' => 'required',
                    'phone_number' => 'required|numeric',
                    'address' => 'required',
                ],
                [
                    'name.required' => 'Vui lòng nhập họ tên người nhận',
                    'phone_number.required' => 'Bạn chưa nhập số điện thoại',
                    'phone_number.numeric' => 'Số điện thoại phải là kiểu số',
                    'address.required' => 'Bạn chưa nhập địa chỉ người nhận',
                ]
            );
    
            $cart = Session::get('cart');
            $productCarts = $cart->items;
            $totalPrice = $cart->totalPrice;
            $tk = Session::get('tk');
    
            $bill = new Bill();
            $bill->id_user = $tk->id;
            $bill->name = $request->name;
            $bill->phone_number = $request->phone_number;
            $bill->address = $request->address;
            $bill->address_type = $request->address_type;
            $bill->payment = $request->payment;
            $bill->total = $cart->totalPrice;
            $bill->status = "đơn hàng mới";
            $bill->save();
    
            foreach ($productCarts as $product) {
                $bill_detail = new Bill_Detail();
                $bill_detail->id_bill = $bill->id;
                $bill_detail->id_book = $product['item']->id;
                $bill_detail->quantity = $product['qty'];
                if ($product['item']->promotion_price != 0) {
                    $bill_detail->unit_price = $product['item']->promotion_price;
                } else {
                    $bill_detail->unit_price = $product['item']->unit_price;
                }
                $bill_detail->save();
                $importProduct = Import_product::where('id_book', $product['item']->id)->first();
                if ($importProduct) {
                    $importProduct->decrement('quantity', $product['qty']);
                }
            }
    
            if (Auth::check()) {
                $tk = Auth::user();
                $sentData = [
                    'name' => $tk->full_name,
                    'email' => $tk->email,
                    'phone' => $tk->phone,
                    'bill' => $productCarts,
                    'total' => $totalPrice // Truyền giỏ hàng vào dữ liệu gửi đi
                ];
    
                // Gửi email
                Mail::to($tk->email)->send(new BillMail($sentData));
            }
    
            Session::forget('cart');
            return redirect()->back()->with('success', 'Đặt hàng thành công');
        }
    }
    public function search(Request $request)
    {
        $books = Book::orderBy('created_at', 'desc')->get();
        $search = $request->input('search');
        if ($search) {
            $results = Book::where('name', 'LIKE', '%' . $search . '%')->get();
        } else {
            $results = [];
        }
        return view('product.category', compact('books', 'results', 'search'));
    }
}
