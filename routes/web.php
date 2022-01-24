<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BotManController;
// use App\Http\Controllers\UserController;
// use App\Http\Controllers\AdminController;

//FrontEnd
use App\Http\Controllers\frontEnd\HomeController;
use App\Http\Controllers\frontEnd\IndexController;
use App\Http\Controllers\frontEnd\ProductReviewController;
use App\Http\Controllers\frontEnd\CartController;
use App\Http\Controllers\frontEnd\WishlistController;
use App\Http\Controllers\frontEnd\CheckoutController;
use App\Http\Controllers\frontEnd\PaypalController;
use App\Http\Controllers\frontEnd\ProfileController;
use App\Http\Controllers\frontEnd\PayOnlineController;

//BackEnd
use App\Http\Controllers\backEnd\DashboardController;
use App\Http\Controllers\backEnd\ProductController;
use App\Http\Controllers\backEnd\CategoryController;
use App\Http\Controllers\backEnd\BrandController;
use App\Http\Controllers\backEnd\BannerController;
use App\Http\Controllers\backEnd\SliderController;
use App\Http\Controllers\backEnd\CouponController;
use App\Http\Controllers\backEnd\CurrencyController;
use App\Http\Controllers\backEnd\OrderController;
use App\Http\Controllers\backEnd\PaymentController;
use App\Http\Controllers\backEnd\SettingsController;
use App\Http\Controllers\backEnd\ShippingController;
use App\Http\Controllers\backEnd\UserManagementController;

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
//     return view('welcome');
// });
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['middleware'=>'PreventBackHistory'])->group(function () {
  Auth::routes();
});


// Route::get('/chatbot', function() {
//   return view('frontEnd.chatbot');
// });
// Route::match(['get', 'post'], '/botman', [BotManController::class, 'handle']);

Route::get('/', [IndexController::class, 'showHomepage'])->name('showHomepage');

//Products
Route::get('/products', [IndexController::class, 'showAllProducts'])->name('showAllProducts');
Route::post('/products/filter', [IndexController::class, 'productsFilter'])->name('productsFilter');
//New Products
Route::get('/newProducts', [IndexController::class, 'showNewProducts'])->name('showNewProducts');

//Popular Products
Route::get('/popularProducts', [IndexController::class, 'showpopularProducts'])->name('showPopularProducts');

//Popular Products
Route::get('/specialProducts', [IndexController::class, 'showSpecialProducts'])->name('showSpecialProducts');

Route::get('/products/category/{slug}', [IndexController::class, 'showProductCategory'])->name('showProductCategory');
Route::get('/products/detail/{slug}', [IndexController::class, 'showProductDetail'])->name('showProductDetail');
Route::get('/products/autoSearch', [IndexController::class, 'autoSearch'])->name('autoSearch');
Route::get('/products/search', [IndexController::class, 'searchResults'])->name('searchResults');

//About Us 
Route::get('/aboutUs', [IndexController::class, 'showAboutUs'])->name('showAboutUs');
//Contact Us
Route::get('/contactUs', [IndexController::class, 'showContactUs'])->name('showContactUs');
Route::post('/contactSubmit', [IndexController::class, 'contactSubmit'])->name('contactSubmit');

//Currency
Route::get('/currency', [CurrencyController::class, 'currencyLoad'])->name('currencyLoad');


Route::group(['middleware'=>['isUser', 'auth']], function(){
    // Route::get('dashboard', [UserController::class, 'userDashboard'])->name('userDashboard');

    //Product Review
    Route::post('/productReview/{slug}', [ProductReviewController::class, 'productReview'])->name('productReview');

    //Cart
    Route::get('/cart', [CartController::class, 'showCart'])->name('showCart');
    Route::post('/cart/store', [CartController::class, 'cartStore'])->name('cartStore');
    Route::post('/cart/deleteFromCart', [CartController::class, 'deleteFromCart'])->name('deleteFromCart');
    Route::post('/cart/updateCart', [CartController::class, 'updateCart'])->name('updateCart');
    Route::post('/cart/reloadCart', [CartController::class, 'reloadCart'])->name('reloadCart');
    // Route::post('/cart/store', [CartController::class, 'cartDetails'])->name('cartDetails');
    
    //Coupon
    Route::post('/cart/applyCoupon', [CartController::class, 'applyCoupon'])->name('applyCoupon');

    //Wishlist
    Route::get('/wishlist', [WishlistController::class, 'showWishlist'])->name('showWishlist');
    Route::post('/wishlist/store', [WishlistController::class, 'wishlistStore'])->name('wishlistStore');
    Route::post('/wishlist/deleteFromWishlist', [WishlistController::class, 'deleteFromWishlist'])->name('deleteFromWishlist');
    Route::post('/wishlist/wishlistMoveToCart', [WishlistController::class, 'wishlistMoveToCart'])->name('wishlistMoveToCart');

    //Checkout
    Route::get('/checkout/billing', [CheckoutController::class, 'checkout1'])->name('checkout1');
    Route::post('/checkout/shipping', [CheckoutController::class, 'checkout2'])->name('checkout2');
    Route::post('/checkout/payment', [CheckoutController::class, 'checkout3'])->name('checkout3');
    Route::post('/checkout/review', [CheckoutController::class, 'checkout4'])->name('checkout4');
    Route::get('/checkout/confirmationCheckout', [CheckoutController::class, 'confirmationCheckout'])->name('confirmationCheckout');
    Route::get('/checkout/success/{order}', [CheckoutController::class, 'successfullyCheckout'])->name('successfullyCheckout');

    //Paypal
    Route::get('/paypal/receipt/{paypalOrderID}/{payerID}',[PaypalController::class, 'responsePayment'])->name('responsePayment');

    //POL
    Route::post('/payonline/checkout',[PayOnlineController::class, 'responsePOLPayment'])->name('responsePOLPayment');

    //Profile
    Route::get('/profile', [ProfileController::class, 'showProfile'])->name('showProfile');
    Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('updateProfile');

    Route::get('/address', [ProfileController::class, 'showAddress'])->name('showAddress');
    Route::post('/address/update', [ProfileController::class, 'updateAddress'])->name('updateAddress');

    Route::get('/orderHistory', [ProfileController::class, 'showOrderHistory'])->name('showOrderHistory');
    Route::post('/orderHistory', [ProfileController::class, 'searchOrderByDate'])->name('searchOrderByDate');
    Route::post('/orderHistory/cancel/{id}', [ProfileController::class, 'cancelOrder'])->name('cancelOrder');
    
    Route::get('/tracking', [ProfileController::class, 'showTracking'])->name('showTracking');
    Route::get('/help', [ProfileController::class, 'showHelp'])->name('showHelp');
 
});


Route::group(['prefix'=>'admin', 'middleware'=>['isAdmin', 'auth']], function(){
  /* Back End */

  //Dashboard
  Route::get('dashboard', [DashboardController::class, 'adminDashboard'])->name('adminDashboard');

  //Products
  Route::get('products', [ProductController::class, 'showProducts'])->name('showProducts');
  Route::get('createProduct', [ProductController::class, 'createProduct'])->name('createProduct');
  Route::post('insertProduct', [ProductController::class, 'insertProduct'])->name('insertProduct');
  Route::get('product/editProduct/{id}', [ProductController::class, 'editProduct'])->name('editProduct');
  Route::post('product/updateProduct/{id}', [ProductController::class, 'updateProduct'])->name('updateProduct');
  Route::delete('product/deleteProduct/{id}', [ProductController::class, 'deleteProduct'])->name('deleteProduct');
  Route::post('productChangeStatus', [ProductController::class, 'productChangeStatus'])->name('productChangeStatus');

  Route::get('productsAttribute/{id}', [ProductController::class, 'showProductAttribute'])->name('showProductAttribute');
  Route::post('productsAttribute/add/{id}', [ProductController::class, 'addProductAttribute'])->name('addProductAttribute');
  Route::post('productsAttribute/delete/{id}', [ProductController::class, 'deleteProductAttribute'])->name('deleteProductAttribute');

  //Categories
  Route::get('categories', [CategoryController::class, 'showCategories'])->name('showCategories');
  Route::get('createCategory', [CategoryController::class, 'createCategory'])->name('createCategory');
  Route::post('insertCategory', [CategoryController::class, 'insertCategory'])->name('insertCategory');
  Route::get('category/editCategory/{id}', [CategoryController::class, 'editCategory'])->name('editCategory');
  Route::post('category/updateCategory/{id}', [CategoryController::class, 'updateCategory'])->name('updateCategory');
  Route::delete('category/deleteCategory/{id}', [CategoryController::class, 'deleteCategory'])->name('deleteCategory');
  Route::post('categoryChangeStatus', [CategoryController::class, 'categoryChangeStatus'])->name('categoryChangeStatus');
  Route::post('category/{id}/child', [CategoryController::class, 'getChildByParentID']);

  //Brands
  Route::get('brands', [BrandController::class, 'showBrands'])->name('showBrands');
  Route::get('createBrand', [BrandController::class, 'createBrand'])->name('createBrand');
  Route::post('insertBrand', [BrandController::class, 'insertBrand'])->name('insertBrand');
  Route::get('brand/editBrand/{id}', [BrandController::class, 'editBrand'])->name('editBrand');
  Route::post('brand/updateBrand/{id}', [BrandController::class, 'updateBrand'])->name('updateBrand');
  Route::delete('brand/deleteBrand/{id}', [BrandController::class, 'deleteBrand'])->name('deleteBrand');
  Route::post('brandChangeStatus', [BrandController::class, 'brandChangeStatus'])->name('brandChangeStatus');

  // Banners
  Route::get('banners', [BannerController::class, 'showBanners'])->name('showBanners');
  Route::get('createBanner', [BannerController::class, 'createBanner'])->name('createBanner');
  Route::post('insertBanner', [BannerController::class, 'insertBanner'])->name('insertBanner');
  Route::get('banner/editBanner/{id}', [BannerController::class, 'editBanner'])->name('editBanner');
  Route::post('banner/updateBanner/{id}', [BannerController::class, 'updateBanner'])->name('updateBanner');
  Route::delete('banner/deleteBanner/{id}', [BannerController::class, 'deleteBanner'])->name('deleteBanner');
  Route::post('bannerChangeStatus', [BannerController::class, 'bannerChangeStatus'])->name('bannerChangeStatus');

  // Slider
  Route::get('sliders', [SliderController::class, 'showSliders'])->name('showSliders');
  Route::get('createSlider', [SliderController::class, 'createSlider'])->name('createSlider');
  Route::post('insertSlider', [SliderController::class, 'insertSlider'])->name('insertSlider');
  Route::get('slider/editSlider/{id}', [SliderController::class, 'editSlider'])->name('editSlider');
  Route::post('slider/updateSlider/{id}', [SliderController::class, 'updateSlider'])->name('updateSlider');
  Route::delete('slider/deleteSlider/{id}', [SliderController::class, 'deleteSlider'])->name('deleteSlider');
  Route::post('sliderChangeStatus', [SliderController::class, 'sliderChangeStatus'])->name('sliderChangeStatus');

  // Coupon
  Route::get('coupons', [CouponController::class, 'showCoupons'])->name('showCoupons');
  Route::get('createCoupon', [CouponController::class, 'createCoupon'])->name('createCoupon');
  Route::post('insertCoupon', [CouponController::class, 'insertCoupon'])->name('insertCoupon');
  Route::get('coupon/editCoupon/{id}', [CouponController::class, 'editCoupon'])->name('editCoupon');
  Route::post('coupon/updateCoupon/{id}', [CouponController::class, 'updateCoupon'])->name('updateCoupon');
  Route::delete('coupon/deleteCoupon/{id}', [CouponController::class, 'deleteCoupon'])->name('deleteCoupon');
  Route::post('couponChangeStatus', [CouponController::class, 'couponChangeStatus'])->name('couponChangeStatus');

  /* Order */
  Route::get('orders', [OrderController::class, 'showOrders'])->name('showOrders');
  Route::get('order/Details/{id}', [OrderController::class, 'showOrderDetails'])->name('showOrderDetails');
  Route::post('order/updateOrderStatus/{id}', [OrderController::class, 'updateOrderStatus'])->name('updateOrderStatus');
  Route::post('order/updateOrderTracking/{id}', [OrderController::class, 'updateOrderTracking'])->name('updateOrderTracking');
  Route::post('order/settleOrder/{id}', [OrderController::class, 'settleOrder'])->name('settleOrder');
  Route::get('invoice/{id}', [OrderController::class, 'showInvoice'])->name('showInvoice');

  //Shipping
  Route::get('shippings', [ShippingController::class, 'showShippings'])->name('showShippings');
  Route::get('createShipping', [ShippingController::class, 'createShipping'])->name('createShipping');
  Route::post('insertShipping', [ShippingController::class, 'insertShipping'])->name('insertShipping');
  Route::get('shipping/editShipping/{id}', [ShippingController::class, 'editShipping'])->name('editShipping');
  Route::post('shipping/updateShipping/{id}', [ShippingController::class, 'updateShipping'])->name('updateShipping');
  Route::delete('shipping/deleteShipping/{id}', [ShippingController::class, 'deleteShipping'])->name('deleteShipping');
  Route::post('shippingChangeStatus', [ShippingController::class, 'shippingChangeStatus'])->name('shippingChangeStatus');

  //Logistics
  Route::get('logistics', [ShippingController::class, 'showLogistics'])->name('showLogistics');
  Route::get('createLogistic', [ShippingController::class, 'createLogistic'])->name('createLogistic');
  Route::post('insertLogistic', [ShippingController::class, 'insertLogistic'])->name('insertLogistic');
  Route::get('logistic/editLogistic/{id}', [ShippingController::class, 'editLogistic'])->name('editLogistic');
  Route::post('logistic/updateLogistic/{id}', [ShippingController::class, 'updateLogistic'])->name('updateLogistic');
  Route::delete('logistic/deleteLogistic/{id}', [ShippingController::class, 'deleteLogistic'])->name('deleteLogistic');
  Route::post('logisticChangeStatus', [ShippingController::class, 'logisticChangeStatus'])->name('logisticChangeStatus');

  //Payment
  Route::get('paypal', [PaymentController::class, 'showPaypalTransactions'])->name('showPaypalTransactions');

  //Omise
  Route::get('omise', [PaymentController::class, 'showOmiseTransactions'])->name('showOmiseTransactions');

  //Currencies
  Route::get('currencies', [CurrencyController::class, 'showCurrencies'])->name('showCurrencies');
  Route::get('createCurrency', [CurrencyController::class, 'createCurrency'])->name('createCurrency');
  Route::post('insertCurrency', [CurrencyController::class, 'insertCurrency'])->name('insertCurrency');
  Route::get('currency/editCurrency/{id}', [CurrencyController::class, 'editCurrency'])->name('editCurrency');
  Route::post('currency/updateCurrency/{id}', [CurrencyController::class, 'updateCurrency'])->name('updateCurrency');
  Route::delete('currency/deleteCurrency/{id}', [CurrencyController::class, 'deleteCurrency'])->name('deleteCurrency');
  Route::post('currencyChangeStatus', [CurrencyController::class, 'currencyChangeStatus'])->name('currencyChangeStatus');

  //Setting & Page setup
  Route::get('setWebsiteInfo', [SettingsController::class, 'setWebsiteInfo'])->name('setWebsiteInfo');
  Route::put('setWebsiteInfo/updateWebsiteInfo', [SettingsController::class, 'updateWebsiteInfo'])->name('updateWebsiteInfo');

  Route::get('setSMTP', [SettingsController::class, 'setSMTP'])->name('setSMTP');
  Route::post('setSMTP/updateSMTP', [SettingsController::class, 'updateSMTP'])->name('updateSMTP');

  Route::get('setPaypal', [SettingsController::class, 'setPaypal'])->name('setPaypal');
  Route::patch('setPaypal/updatePayment', [SettingsController::class, 'updatePaypal'])->name('updatePaypal');

  Route::get('setOmise', [SettingsController::class, 'setOmise'])->name('setOmise');

  Route::get('setAboutUs', [SettingsController::class, 'setAboutUs'])->name('setAboutUs');
  Route::put('setAboutUs/updateWebsiteInfo', [SettingsController::class, 'updateAboutUs'])->name('updateAboutUs');

  //Users
  /* Customer */
  Route::get('customerManagement' , [UserManagementController::class, 'showCustomers'])->name('showCustomers');
  Route::get('createCustomer' , [UserManagementController::class, 'createCustomer'])->name('createCustomer');
  Route::post('insertCustomer', [UserManagementController::class, 'insertCustomer'])->name('insertCustomer');
  Route::get('customer/editCustomer/{id}', [UserManagementController::class, 'editCustomer'])->name('editCustomer');
  Route::post('customer/updateCustomer/{id}', [UserManagementController::class, 'updateCustomer'])->name('updateCustomer');
  Route::delete('customer/deleteCustomer/{id}', [UserManagementController::class, 'deleteCustomer'])->name('deleteCustomer');
  Route::get('resetPasswordCustomer/{id}', [UserManagementController::class, 'resetPasswordCustomer'])->name('resetPasswordCustomer');
  Route::post('updateNewPasswordCustomer/{id}', [UserManagementController::class, 'updateNewPasswordCustomer'])->name('updateNewPasswordCustomer');

  /* Admins */
  Route::get('adminManagement' , [UserManagementController::class, 'showAdmins'])->name('showAdmins');
  Route::get('createAdmin' , [UserManagementController::class, 'createAdmin'])->name('createAdmin');
  Route::post('insertAdmin', [UserManagementController::class, 'insertAdmin'])->name('insertAdmin');
  Route::get('editAdmin/{id}', [UserManagementController::class, 'editAdmin'])->name('editAdmin');
  Route::post('updateAdmin/{id}', [UserManagementController::class, 'updateAdmin'])->name('updateAdmin');
  Route::delete('deleteAdmin/{id}', [UserManagementController::class, 'deleteAdmin'])->name('deleteAdmin');
  Route::get('resetPasswordAdmin/{id}', [UserManagementController::class, 'resetPasswordAdmin'])->name('resetPasswordAdmin');
  Route::post('updateNewPasswordAdmin/{id}', [UserManagementController::class, 'updateNewPasswordAdmin'])->name('updateNewPasswordAdmin');
    

});