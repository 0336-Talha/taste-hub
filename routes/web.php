<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\DashboardController;
// HomePageController
use App\Http\Controllers\HomePageController;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\FrontPageController;

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProductController;
//admin product
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\NotificationController;

use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\ProductFilterController;




use App\Http\Controllers\ProductReviewController;









/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('frontEnd.index');
// });

Route::get('/',[FrontPageController::class,'index'])->name('web.home');
Route::get('/productDetail/{id}',[FrontPageController::class,'productDetail'])->name('user.productDetail');
Route::get('/filter/{search?}',[ProductFilterController::class,'index'])->name('filter');

Route::get('/searchProduct',[ProductFilterController::class,'search'])->name('search');

route::get('/make',[ProductFilterController::class,'make']);

Route::get('/addWishlist/{id}', [FrontPageController::class, 'wishlist'])->name('user.wishlist');

//product data 
// Route::post('/productData', [FrontPageController::class, 'productData'])->name('user.productData');
//offer
Route::post('/makeOffer', [FrontPageController::class, 'makeOffer'])->name('user.makeOffer');
 

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::post('/user/logout', [App\Http\Controllers\Auth\LoginController::class, 'userLogout'])->name('user.logout');

Route::group(['middleware' => 'guest'], function(){
    Route::view('/login','auth.login')->name('login');


});

Route::group(['middleware' => 'auth'], function(){
 

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/user/logout', [App\Http\Controllers\Auth\LoginController::class, 'userLogout'])->name('user.logout');

Route::get('/account', [AccountController::class, 'index'])->name('user.account');
Route::get('/states/{id}', [AccountController::class, 'getState']);
Route::post('/accountStore', [AccountController::class, 'accountStore'])->name('user.accountStore');
//change password
Route::post('/accountPassword', [AccountController::class, 'accountPassword'])->name('user.accountPassword');

//add product.
Route::get('/add_product', [ProductController::class, 'index'])->name('user.addproduct');
Route::post('/store_product', [ProductController::class, 'store'])->name('user.storeproduct');
//add image
Route::post('/store_productimages', [ProductController::class, 'storeProductImages'])->name('user.storeProductImages');

Route::get('/addProduct/remove/{id}', [ProductController::class, 'removeProductImages'])->name('user.removeProductImages');


//my product page
Route::get('/my-products',[ProductController::class,'productsPage'])->name('user.productPage');
//edit Product product Edit
Route::get('/my-products/edit/{id?}',[ProductController::class,'editProduct'])->name('user.editProduct');
//store Edit Product
Route::post('/updateProduct/{id}',[ProductController::class,'updateProduct'])->name('user.updateProduct');
//delete product
Route::get('/deleteProduct/{id}',[ProductController::class,'delete'])->name('user.deleteProduct');

//view Product offers/ work On offers  
Route::get('/viewProductOffers/{id}',[ProductController::class,'viewProductOffers'])->name('user.viewProductOffers');

Route::get('/acceptorrefectoffers',[ProductController::class,'acceptorrefectoffers'])->name('user.acceptorrefectoffers');


//id and check.  
// /viewProductOffers/{id}






//store into wishlist
// Route::get('/addWishlist/{id}', [FrontPageController::class, 'wishlist'])->name('user.wishlist');
Route::get('/wishlist', [FrontPageController::class, 'wishlistIndex'])->name('user.wishlistIndex');


//Carts

Route::post('/addToCart', [CartController::class, 'addToCart'])->name('user.addtocart');
Route::get('/cart', [CartController::class, 'index'])->name('user.cartIndex');
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('user.cartRemove');
//update
Route::post('/cartToQty', [CartController::class, 'cartToQty'])->name('user.cartToQty');

//checkout
Route::get('/checkout',[OrderController::class,'index'])->name('user.checkOut');
//payment
Route::post('/paymentRequest',[OrderController::class,'paymentRequest'])->name('user.paymentRequest');
Route::post('/workOnPayment',[OrderController::class,'workOnPayment'])->name('user.workOnPayment');

//notifications.

Route::get('notifications',[NotificationController::class,'index'])->name('user.notifications');
//reader
Route::get('notificationread/{id}',[NotificationController::class,'read'])->name('user.notificationRead');

//orders all
 
Route::get('orders',[OrderController::class,'ordersPage'])->name('user.ordersPage');
//orderInfo
Route::get('/orderInfo/{id}',[OrderController::class,'orderinfo'])->name('user.orderInfo');

//update order item TrackNo
Route::post('/updateTrackNo',[OrderController::class,'updateTrackNo'])->name('user.updateTrackNo');

//order id
Route::get('order/{id}',[OrderController::class,'userOrderDetail'])->name('user.userOrderDetail');

//product Review.
Route::get('productreview/{id}',[ProductReviewController::class,'index']);
// productReviewStore
Route::post('productReviewStore',[ProductReviewController::class,'storeReview'])->name('user.productReviewStore');

// store owner review rating
Route::post('storeAdminReview',[ProductReviewController::class,'storeAdminReview'])->name('user.storeAdminReview');

});




Route::group(['prefix' => 'admin'], function() {
	Route::group(['middleware' => 'admin.guest'], function(){
		Route::view('/login','admin.login')->name('admin.login');
		Route::post('/login', [AdminController::class,'authenticate'])->name('admin.auth');
	});
	
	Route::group(['middleware' => 'admin.auth'], function(){
		Route::get('/dashboard',[DashboardController::class, 'dashboard'])->name('admin.dashboard');
		Route::get('/logout',[DashboardController::class, 'logout'])->name('admin.logout');

        // admin Home Page
        Route::get('/homePage',[HomePageController::class, 'indexHome'])->name('admin.homepage');
        Route::post('/homePage',[HomePageController::class, 'storePage'])->name('admin.storepage');

		// category Manager
        Route::get('/category',[CategoryController::class, 'index'])->name('admin.category');
		Route::post('/categoryStore',[CategoryController::class,'storeMainCategory'])->name('admin.storeMainCategory');

		Route::get('/category/delete/{id}',[CategoryController::class,'deleteMainCategory'])->name('admin.deleteMainCategory');


		Route::get('/getMainCategory',[CategoryController::class,'getMainCategory'])->name('admin.getMainCategory');
		
		Route::get('/getSubCategory',[CategoryController::class,'getSubCategory'])->name('admin.getSubCategory');
		//Sub Category
		Route::post('/subCategoryStore',[CategoryController::class,'storeSubCategory'])->name('admin.storeSubCategory');
		// subcategory/delete/${subid}
		Route::get('/subcategory/delete/{subid}',[CategoryController::class,'deleteSubCategory'])->name('admin.deleteSubCategory');

		//brands
		Route::get('/brand',[BrandController::class,'index'])->name('admin.Brand');
		Route::Post('/storebrand',[BrandController::class,'storebrand'])->name('admin.storeBrand');

		//admin products.
		Route::get('/product/{filter?}',[AdminProductController::class,'index'])->name('admin.Product');
		Route::post('/storeProductAdmin',[AdminProductController::class,'storeProduct'])->name('admin.storeproduct');

		//edit.
		Route::get('/edit/{id}',[AdminProductController::class,'editor'])->name('admin.editPrt');
		// /product/update/' + productId
		Route::Post('/product/update/{id}',[AdminProductController::class,'update'])->name('admin.updatePrt');
		//deletion a product
		Route::get('/product/delete/{id}',[AdminProductController::class,'delete'])->name('admin.deletePrt');

		//admin Notificaions.
		Route::get('/notifcations',[AdminProductController::class,'adminNotification'])->name('admin.adminNotification');

		//admin orders
		Route::get('/orders',[AdminProductController::class,'adminOrders'])->name('admin.adminOrders');

		//view Order yah rha
		Route::get('/orderinfo/{id}',[AdminProductController::class,'adminOrderInfo'])->name('admin.adminOrderInfo');


		Route::post('/updateAdminTracking',[AdminProductController::class,'updateAdminTracking'])->name('admin.updateAdminTracking');

		
		// userOrdersManager
		Route::get('/userOrdersManager/{filter?}',[AdminProductController::class,'userOrdersManager'])->name('admin.userOrdersManager');
		// email sending.
		Route::get('/sendEmailToUser',[AdminProductController::class,'sendEmailToUser'])->name('admin.sendEmailToUser');

		//delivery controll
		Route::get('/delivery/{filter?}',[DeliveryController::class,'index'])->name('admin.orderDelivery');
		//make deliver
		Route::get('/makedelivery',[DeliveryController::class,'makeDeliver'])->name('admin.makeDeliver');

	});
});
