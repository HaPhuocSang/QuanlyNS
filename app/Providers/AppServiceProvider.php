<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Cart;
use App\Models\Type_book;
use Illuminate\Support\Facades\Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        View::composer(['admin.layout.header','layout.header','product.category','product.checkout','admin.authors.layout.header','admin.banners.layout.header','admin.books.layout.header','admin.categories.layout.header','admin.importproducts.layout.header','admin.suppliers.layout.header','admin.warehouses.layout.header','admin.contacts.layout.header',],function($view){
            if(Session('cart')){
                $oldCart=Session::get('cart'); //session cart được tạo trong method addToCart của PageController
                $cart=new Cart($oldCart);
                $view->with(['cart'=>Session::get('cart'),'productCarts'=>$cart->items,
                'totalPrice'=>$cart->totalPrice,'totalQty'=>$cart->totalQty]);
            }
        });
        View::composer('layout.header', function ($view) {
            $type_book = Type_book::all();
            $view->with('type_book', $type_book);
        });
    }
}
