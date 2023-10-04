<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;
use App\Models\Bill_Detail;

class BillController extends Controller
{
    //
    public function getBillList()
    {
        $bills = Bill::orderBy('updated_at', 'desc')->get();
        return view('admin.bills.admin-bill', compact('bills'));
    }
    public function getBillEdit(string $id)
    {
        $bill = Bill::where('id', $id)->get();
        $bill_details = Bill_Detail::where('id_bill', $id)->get();
        return view('admin.bills.admin-edit-bill', array('bill' => $bill), compact('bill_details'));
    }
    public function postBillEdit(Request $request, string $id)
    {
        // Kiểm tra dữ liệu gửi lên từ form
        $this->validate($request, [
            'status' => 'required', 
        ], [
            'status.required' => 'Vui lòng chọn trạng thái đơn hàng.',
        ]);

        $bill = Bill::find($id);
        $bill->status = $request->status;
        $bill->save();

        return redirect()->route('admin.BillList')->with('success', 'Bạn đã sửa thành công trạng thái đơn hàng!');
    }
}
