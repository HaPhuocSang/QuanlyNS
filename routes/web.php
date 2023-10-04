<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\ImportproductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BillController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return  redirect()->route('getHomepage');
});
Route::get('/input-email',[UserController::class,'getInputEmail'])->name('getInputEmail');
Route::post('/input-email',[UserController::class,'postInputEmail'])->name('postInputEmail');
Route::get('/input-verification',[UserController::class,'getVerification'])->name('getVerification');
Route::post('/input-verification',[UserController::class,'postVerification'])->name('postVerification');
Route::get('/input-newpassword',[UserController::class,'getNewPassword'])->name('getNewPassword');
Route::post('/input-newpassword',[UserController::class,'postNewPassword'])->name('postNewPassword');


Route::get('/home-page',[PageController::class,'getHomepage'])->name('getHomepage');
Route::get('/home-book-page/{id}',[PageController::class,'getBookpage'])->name('getBookpage');
Route::get('/home-book-type/{id}',[PageController::class,'getTypebook'])->name('getTypebook');
Route::get('/home-contact',[PageController::class,'getContact'])->name('getContact');
Route::post('/home-contact',[PageController::class,'postContact'])->name('postContact');
Route::get('/home-signup',[PageController::class,'getSignup'])->name('getSignup');
Route::post('/home-signup',[PageController::class,'postSignup'])->name('postSignup');
Route::put('/cart/update-quantity/{productId}', [PageController::class, 'updateQuantity'])->name('updateQuantity');
Route::get('/add-to-cart/{id}',[PageController::class,'addToCart'])->name('addToCart');
Route::post('/add-many-to-cart/{id}',[PageController::class,'addManyToCart'])->name('addManyToCart');
Route::get('/increase-quantity/{id}', [PageController::class, 'increaseQuantity'])->name('increaseQuantity');
Route::get('/decrease-quantity/{id}', [PageController::class, 'decreaseQuantity'])->name('decreaseQuantity');
Route::get('/del-to-cart/{id}',[PageController::class,'delCartItem'])->name('delToCart');
Route::get('/home-category-search', [PageController::class, 'search'])->name('search');
Route::get('/home-checkout', [PageController::class, 'getCheckout'])->name('getCheckout');
Route::post('/home-checkout', [PageController::class, 'postCheckout'])->name('postCheckout');


Route::get('/admin/sign-in',[UserController::class,'getLogin'])->name('admin.getLogin');
Route::post('/admin/sign-in',[UserController::class,'postLogin'])->name('admin.postLogin');
Route::get('/admin/log-out',[UserController::class,'getLogout'])->name('admin.getLogout');
Route::get('/profile',[UserController::class,'getMyprofile'])->name('admin.getMyprofile');
Route::post('/post-profile/{id}',[UserController::class,'postEditprofile'])->name('admin.postEditprofile');
Route::post('/post-change-password/{id}',[UserController::class,'changepassword'])->name('admin.changepassword');



Route::group(['prefix'=>'admin','middleware'=>'adminLogin'],function(){
   
    Route::group(['prefix'=>'category'],function(){
        Route::get('admin-category',[CategoryController::class,'getCategoryList'])->name('admin.getCategoryList');
        Route::get('admin-add-category',[CategoryController::class,'getCategoryAdd'])->name('admin.getCategoryAdd');
        Route::post('admin-add-category',[CategoryController::class,'postCategoryAdd'])->name('admin.postCategoryAdd');
        Route::get('admin-edit-category/{id}',[CategoryController::class,'getCategoryEdit'])->name('admin.getCategoryEdit');
        Route::put('admin-edit-category/{id}',[CategoryController::class,'postCategoryEdit'])->name('admin.postCategoryEdit');
        Route::delete('admin-delete-category/{id}',[CategoryController::class,'deletetCategory'])->name('admin.deletetCategory');
        Route::get('admin-category-search', [CategoryController::class, 'search'])->name('admin.Categorysearch');
    });

    Route::group(['prefix'=>'author'],function(){
        Route::get('admin-author',[AuthorController::class,'getAuthorList'])->name('admin.getAuthorList');
        Route::get('admin-add-author',[AuthorController::class,'getAuthorAdd'])->name('admin.getAuthorAdd');
        Route::post('admin-add-author',[AuthorController::class,'postAuthorAdd'])->name('admin.postAuthorAdd');
        Route::get('admin-edit-author/{id}',[AuthorController::class,'getAuthorEdit'])->name('admin.getAuthorEdit');
        Route::put('admin-edit-author/{id}',[AuthorController::class,'postAuthorEdit'])->name('admin.postAuthorEdit');
        Route::delete('admin-delete-author/{id}',[AuthorController::class,'deletetAuthor'])->name('admin.deletetAuthor');
        Route::get('admin-author-search', [AuthorController::class, 'search'])->name('admin.authorsearch');
    });

    Route::group(['prefix'=>'supplier'],function(){
        Route::get('admin-supplier',[SupplierController::class,'getSupplierList'])->name('admin.getSupplierList');
        Route::get('admin-add-supplier',[SupplierController::class,'getSupplierAdd'])->name('admin.getSupplierAdd');
        Route::post('admin-add-supplier',[SupplierController::class,'postSupplierAdd'])->name('admin.postSupplierAdd');
        Route::get('admin-edit-supplier/{id}',[SupplierController::class,'getSupplierEdit'])->name('admin.getSupplierEdit');
        Route::put('admin-edit-supplier/{id}',[SupplierController::class,'postSupplierEdit'])->name('admin.postSupplierEdit');
        Route::delete('admin-delete-supplier/{id}',[SupplierController::class,'deletetSupplier'])->name('admin.deletetSupplier');
        Route::get('admin-supplier-search', [SupplierController::class, 'search'])->name('admin.supplierearch');
    });    
    
    Route::group(['prefix'=>'banner'],function(){
        Route::get('admin-banner',[BannerController::class,'getBannerList'])->name('admin.getBannerList');
        Route::get('admin-add-banner',[BannerController::class,'getBannerAdd'])->name('admin.getBannerAdd');
        Route::post('admin-add-banner',[BannerController::class,'postBannerAdd'])->name('admin.postBannerAdd');
        Route::get('admin-edit-banner/{id}',[BannerController::class,'getBannerEdit'])->name('admin.getBannerEdit');
        Route::put('admin-edit-banner/{id}',[BannerController::class,'postBannerEdit'])->name('admin.postBannerEdit');
        Route::delete('admin-delete-banner/{id}',[BannerController::class,'deletetBanner'])->name('admin.deletetBanner');
    });

    Route::group(['prefix'=>'book'],function(){
        Route::get('admin-book',[BookController::class,'getBookList'])->name('admin.getBookList');
        Route::get('admin-add-book',[BookController::class,'getBookAdd'])->name('admin.getBookAdd');
        Route::post('admin-add-book',[BookController::class,'postBookAdd'])->name('admin.postBookAdd');
        Route::get('admin-edit-book/{id}',[BookController::class,'getBookEdit'])->name('admin.getBookEdit');
        Route::put('admin-edit-book/{id}',[BookController::class,'postBookEdit'])->name('admin.postBookEdit');
        Route::delete('admin-delete-book/{id}',[BookController::class,'deletetBook'])->name('admin.deletetBook');
        Route::get('admin-book-search', [BookController::class, 'search'])->name('admin.booksearch');
    });
    Route::group(['prefix'=>'warehouse'],function(){
        Route::get('admin-warehouse',[WarehouseController::class,'getWarehouseList'])->name('admin.getWarehouseList');
        Route::get('admin-add-warehouse',[WarehouseController::class,'getWarehouseAdd'])->name('admin.getWarehouseAdd');
        Route::post('admin-add-warehouse',[WarehouseController::class,'postWarehouseAdd'])->name('admin.postWarehouseAdd');
        Route::get('admin-edit-warehouse/{id}',[WarehouseController::class,'getWarehouseEdit'])->name('admin.getWarehouseEdit');
        Route::put('admin-edit-warehouse/{id}',[WarehouseController::class,'postWarehouseEdit'])->name('admin.postWarehouseEdit');
        Route::delete('admin-delete-warehouse/{id}',[WarehouseController::class,'deletetWarehouse'])->name('admin.deletetWarehouse');
    });
    Route::group(['prefix'=>'importproduct'],function(){
        Route::get('admin-importproduct',[ImportproductController::class,'getImportproductList'])->name('admin.getImportproductList');
        Route::get('admin-add-importproduct',[ImportproductController::class,'getImportproductAdd'])->name('admin.getImportproductAdd');
        Route::post('admin-add-importproduct',[ImportproductController::class,'postImportproductAdd'])->name('admin.postImportproductAdd');
        Route::delete('admin-delete-importproduct/{id}',[ImportproductController::class,'deletetImportproduct'])->name('admin.deletetImportproduct');
    });   
    Route::group(['prefix'=>'contact'],function(){
        Route::get('admin-contact',[ContactController::class,'getContactList'])->name('admin.ContactList');
        Route::get('admin-contact-search', [ContactController::class, 'search'])->name('admin.Contactsearch');
        Route::get('admin-detail-contact/{id}', [ContactController::class, 'getDetailContact'])->name('admin.getDetailContact');
        Route::delete('admin-delete-contact/{id}',[ContactController::class,'deleteContact'])->name('admin.deleteContact');
    });  
    Route::group(['prefix' => 'bill'], function () {
        Route::get('admin-bill', [BillController::class, 'getBillList'])->name('admin.BillList');
        Route::get('admin-edit-bill/{id}', [BillController::class, 'getBillEdit'])->name('admin.getBillEdit'); 
        Route::put('admin-edit-bill/{id}', [BillController::class, 'postBillEdit'])->name('admin.postBillEdit'); 
    });
    Route::group(['prefix' => 'user'], function () {
        Route::get('admin-user', [UserController::class, 'getUserList'])->name('admin.getUserList');
        Route::get('admin-eidt-user/{id}', [UserController::class, 'getUserEdit'])->name('admin.getUserEdit');
        Route::post('admin-eidt-user/{id}', [UserController::class, 'postUserEdit'])->name('admin.postUserEdit');
    });
});