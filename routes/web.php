<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthOtpController;
use App\Http\Middleware\OtpVerified;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Restaurant;

use App\Http\Controllers\admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\admin\RestaurantController as AdminRestaurantController;
use App\Http\Controllers\admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\admin\SubCategoryController as AdminSubCategoryController;
use App\Http\Controllers\admin\AddonsController as AdminAddonsController;
use App\Http\Controllers\admin\CustomerController as AdminCustomerController;
use App\Http\Controllers\admin\ReCaptchaController as AdminReCaptchaController;
use App\Http\Controllers\admin\ProductController as AdminProductController;
use App\Http\Controllers\admin\LogoController as AdminLogoController;
use App\Http\Controllers\admin\SettingController as AdminSettingController;
use App\Http\Controllers\admin\TermsConditionsController as AdminTermsConditionsController;
use App\Http\Controllers\admin\OrderController as AdminOrderController;
use App\Http\Controllers\admin\DefaultCountryController as AdminDefaultCountryController;
use App\Http\Controllers\admin\FinanceController;
use App\Http\Controllers\Admin\Promotion;

use App\Http\Controllers\restaurant\ProductController;
use App\Http\Controllers\restaurant\CategoryController as RestroCategoryController;
use App\Http\Controllers\restaurant\SubCategoryController as RestroSubCategoryController;
use App\Http\Controllers\restaurant\DashboardController as RestroDashboardController;
use App\Http\Controllers\restaurant\AddonsController as RestroAddonsController;
use App\Http\Controllers\restaurant\CountryController as RestroCountryController;
use App\Http\Controllers\restaurant\StateController as RestroStateController;
use App\Http\Controllers\restaurant\CityController as RestroCityController;
use App\Http\Controllers\restaurant\OrderController as RestroOrderController;
use App\Http\Controllers\restaurant\TableController as RestroTableController;
use App\Http\Controllers\restaurant\ReservationController as RestroReservationController;
use App\Http\Controllers\restaurant\SettingController as RestroSettingController;
use App\Http\Controllers\restaurant\ProductReviewController as RestroProductReviewController;
use App\Http\Controllers\restaurant\TransectionController as RestroTransectionController;

use App\Http\Controllers\RestaurantController as UserRestaurantController;
use App\Http\Controllers\MenuController as UserMenuController;
use App\Http\Controllers\CheckoutController as UserCheckoutController;
use App\Http\Controllers\ProductController as UserProductController;
use App\Http\Controllers\TableReservationController as UserTableReservationController;
use App\Http\Controllers\ProfileController as UserProfileController;
use App\Http\Controllers\OrderController as UserOrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReservationController as UserReservationController;
use App\Http\Controllers\restaurant\RestaurentInformation;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\auth\ForgotPasswordController;

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


#User Pages to access without login
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('category/view', [App\Http\Controllers\HomeController::class, 'categoryPage'])->name('cat.view');
    Route::get('/list-restaurant', [UserRestaurantController::class, 'listing'])->name('user.restaurant_list');
    Route::get('/list-product', [UserProductController::class, 'listing'])->name('user.product_list');
    Route::get('/view-product/{id}', [UserProductController::class, 'index'])->name('user.product');
    Route::get('/restaurant-view/{id}', [UserRestaurantController::class, 'index'])->name('user.restro');





Auth::routes();
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::controller(AuthOtpController::class)->group(function(){
    Route::get('/otp/login', 'login')->name('otp.login');
    Route::post('/otp/generate', 'generate')->name('otp.generate');
    Route::get('/otp/resend/{no}', 'resend')->name('otp.resend');
    Route::get('/otp/verification/{user_id}', 'verification')->name('otp.verification');
    Route::post('/otp/login', 'loginWithOtp')->name('otp.getlogin');
});

Route::get('/terms_conditions',[AdminTermsConditionsController::class,'terms_and_conditions'])->name('terms_and_conditions');
Route::get('/privacy_policy',[AdminTermsConditionsController::class,'privacypolicy'])->name('privacypolicy');
// Admin routes..
Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => ['auth','admin']], function () {
        Route::get('/', [AdminDashboardController::class,'index'])->name('admin.dashboard');
        #restaurant
        // Route::get('/fetch-states', [AdminRestaurantController::class, 'fetchState'])->name('fetchState');//Ajax Routes
        // Route::post('/fetch-cities', [AdminRestaurantController::class, 'fetchCity'])->name('fetchCity');//Ajax Routes
        Route::post('/fetch-email', [AdminRestaurantController::class, 'fetchEmail'])->name('fetchEmail');//Ajax Routes
        Route::post('/fetch-phone', [AdminRestaurantController::class, 'fetchphone_number'])->name('fetchphone_number');//Ajax Routes
        Route::get('/restaurantstatus', [AdminRestaurantController::class,'changestatus'])->name('restaurantstatus');//Ajax Routes
        Route::get('/restaurant/change-password/{id}', [AdminRestaurantController::class,'changepassword'])->name('restaurant.changepassword');
        Route::post('/restaurant/update-password/{id}', [AdminRestaurantController::class,'updatepassword'])->name('restaurant.updatepassword');
        Route::resource('/restaurant', AdminRestaurantController::class);
        Route::get('/restaurant/destroy/{id}',[AdminRestaurantController::class,'destroy'])->name('restaurant.destroys');
        Route::get('/restrosearch',[AdminRestaurantController::class,'search'])->name('retrosearch');//Ajax Routes

        Route::get('restaurant/gallary/{id}',[AdminRestaurantController::class,'imgDelete'])->name('admin.restaurant.del');//Ajax Routes
        #Promotion
        Route::get('banner',[Promotion::class,'largeBannerIndex'])->name('large.banner.index');
        Route::post('banner/store',[Promotion::class,'bannerStore'])->name('banner.store');
        Route::post('bannergif/store',[Promotion::class,'gifBanner'])->name('bannergif.store');
        #customers
        Route::resource('/customer', AdminCustomerController::class);
        #recaptchas
        Route::resource('/recaptcha', AdminReCaptchaController::class);
        Route::get('/recaptcahstatus', [AdminReCaptchaController::class,'changestatus'])->name('recaptchastatus');
        #products
        Route::resource('/products', AdminProductController::class);
        Route::get('/products/destroy/{id}',[AdminProductController::class,'destroy'])->name('products.destroys');
        Route::get('products/image/{id}',[AdminProductController::class,'imgDelete'])->name('admin.product.del');//Ajax Routes
        Route::get('fetchSubCat',[AdminProductController::class,'fetchSubCat'])->name('admin.fetchSubCat');//Ajax Routes
        Route::get('fetchAddon',[AdminProductController::class,'fetchAddon'])->name('admin.fetchAddon');//Ajax Routes
        Route::get('/productstatus', [AdminProductController::class,'changestatus'])->name('productstatus');//Ajax Routes
        Route::get('/search',[AdminProductController::class,'search'])->name('search');//Ajax Routes
        Route::get('/namesearch',[AdminProductController::class,'searchname'])->name('searchname');//Ajax Routes
        #logo
        Route::resource('/logo', AdminLogoController::class);
        #setting
        Route::get('setting',[AdminSettingController::class,'index'])->name('admin.setting');
        Route::post('default-country',[AdminDefaultCountryController::class,'store'])->name('default_country.store');
        #orders
        Route::get('/order/all',[AdminOrderController::class,'index'])->name('admin.order.index');
        Route::get('/order/pending',[AdminOrderController::class,'pending'])->name('admin.order.pending');
        Route::get('/order/confirmmed',[AdminOrderController::class,'confirmmed'])->name('admin.order.confirmmed');
        // Route::get('/new/order/fetch',[AdminOrderController::class,'CheckNewOrder'])->name('admin.order.checkneworder');
        // Route::get('/new/order/view',[AdminOrderController::class,'ReadNewOrder'])->name('admin.order.readneworder');

        #Finance Stats
        Route::get('/restaurent/stats',[FinanceController::class,'restaurentStats'])->name('restaurent.profit.loss');
        Route::get('/stats',[FinanceController::class,'allStats'])->name('profit.loss');
        // Route::get('get/restaurent/stats/',[FinanceController::class,'getRestroStats'])->name('get.restaurent.stats');


    });
});

// Restaurant routes...
Route::group(['prefix' => 'restaurant'], function () {
    Route::group(['middleware' => ['auth','restaurant']], function () {
        Route::get('/', [RestroDashboardController::class,'index'])->name('restro.dashboard');
        #product
        Route::resource('/product', ProductController::class);
        Route::get('/product/destroy/{id}',[ProductController::class,'destroy'])->name('product.destroys');
        Route::get('product/image/{id}',[ProductController::class,'imgDelete'])->name('product.del');//Ajax Routes
        Route::get('fetchSubCat',[ProductController::class,'fetchSubCat'])->name('fetchSubCat');//Ajax Routes
        Route::get('/add-image',[ProductController::class,'addImage'])->name('addImage');//Ajax Routes
        Route::get('/restroproductstatus', [ProductController::class,'changestatus'])->name('restro.productstatus');
        #category
        Route::get('category/index',[AdminCategoryController::class,'index'])->name('restro.category.index');
        Route::get('subcategory/index',[AdminSubCategoryController::class,'index'])->name('restro.subcategory.index');
        #addons
        // Route::get('addon/index',[RestroAddonsController::class,'addonIndex'])->name('restor.addons.index');
        #addons
        Route::resource('/addons', AdminAddonsController::class);
        Route::get('/addons/destroy/{id}',[AdminAddonsController::class,'destroy'])->name('addons.destroys');
        Route::get('/addonsstatus', [AdminAddonsController::class,'changestatus'])->name('addonsstatus');//Ajax Routes
        Route::get('/addonssearch',[AdminAddonsController::class,'search'])->name('addonssearch');//Ajax Routes
        #country
        Route::resource('/countries', RestroCountryController::class);
        #state
        Route::resource('/states', RestroStateController::class);
        #city
        Route::resource('/cities', RestroCityController::class);
        #orders
        Route::get('/order/all',[RestroOrderController::class,'index'])->name('restro.order.index');
        Route::get('/order/pending',[RestroOrderController::class,'pending'])->name('restro.order.pending');
        Route::get('/order/confirmed',[RestroOrderController::class,'confirmed'])->name('restro.order.confirms');
        Route::get('/order/{order_id}/canceled',[RestroOrderController::class,'OrderCanceled'])->name('restro.order.canceled');
        Route::get('/order/{order_id}/confirmed',[RestroOrderController::class,'OrderConfirmed'])->name('restro.order.confirmed');
        Route::get('/order/{id}/show',[RestroOrderController::class,'show'])->name('restro.order.show');
        Route::get('/order/{id}/invoice',[RestroOrderController::class,'invoice'])->name('restro.order.invoice');
        Route::get('/new/order/fetch',[RestroOrderController::class,'CheckNewOrder'])->name('restro.order.checkneworder');
        Route::get('/new/order/view',[RestroOrderController::class,'ReadNewOrder'])->name('restro.order.readneworder');
        #table
        Route::resource('/table', RestroTableController::class);
        Route::get('/table/destroy/{id}',[RestroTableController::class,'destroy'])->name('table.destroys');
        #reservation
        Route::resource('/reservation', RestroReservationController::class);
        Route::get('/reservation-status', [RestroReservationController::class,'changestatus'])->name('restro.reservation_status');
        Route::post('/approve-mail',[RestroReservationController::class,'approve'])->name('restro.approve_mail');
        Route::post('/reject-mail',[RestroReservationController::class,'reject'])->name('restro.reject_mail');
        #setting
        Route::get('/setting',[RestroSettingController::class,'index'])->name('restro.setting');
        Route::post('/create-mail',[RestroSettingController::class,'mail'])->name('restro.mail');
        Route::get('/otp/generate-mail',[RestroSettingController::class,'generate'])->name('otp.generateemail');
        Route::get('/otp/mail-verification/{user_id}', [RestroSettingController::class,'verification'])->name('otp.verificationemail');
        Route::get('/otp/resend/{no}', [RestroSettingController::class,'resend'])->name('otp.resendemail');
        Route::post('/otp/changemail', [RestroSettingController::class,'MailWithOtp'])->name('otp.changeemail');


        #CATEGORY
        Route::get('/changeStatus', [AdminCategoryController::class,'changestatus'])->name('changecategory');//Ajax Routes
        Route::resource('/category', AdminCategoryController::class);
        Route::get('/category/destroy/{id}',[AdminCategoryController::class,'destroy'])->name('category.destroys');

        #sub-category
        Route::get('/subcategorystatus', [AdminSubCategoryController::class,'changestatus'])->name('changesubcategory');//Ajax Routes
        Route::resource('/subcategory', AdminSubCategoryController::class);
        Route::get('/subcategory/destroy/{id}',[AdminSubCategoryController::class,'destroy'])->name('subcategory.destroys');
        #Restaurent Information
        Route::get('/restaurent/information',[RestaurentInformation::class,'index'])->name('rest.info.index');
        Route::post('/restaurent/store',[RestaurentInformation::class,'store'])->name('rest.info.store');
        Route::get('restro/gallary/{id}',[RestaurentInformation::class,'imgDelete'])->name('rest.gallary.del');//Ajax Routes

        #Product Reviews
        Route::get('product-review',[RestroProductReviewController::class,'index'])->name('restaurant.review.index');
        Route::get('/restro/productreview/status', [RestroProductReviewController::class,'changestatus'])->name('restro.productreviewstatus');

        #Transections
        Route::get('transections',[RestroTransectionController::class,'index'])->name('restro.transection');

        #Invoice
        Route::get('invoice/download-pdf/{id}', [RestroOrderController::class, 'downloadPDF'])->name('download-pdf');
    });
});
// User routes...
Route::middleware([OtpVerified::class])->group(function(){
    #dashboard

    // Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    // Route::get('category/view', [App\Http\Controllers\HomeController::class, 'categoryPage'])->name('cat.view');
    #restaurant
    // Route::get('/restaurant-view/{id}', [UserRestaurantController::class, 'index'])->name('user.restro');
    // Route::get('/list-restaurant', [UserRestaurantController::class, 'listing'])->name('user.restaurant_list');
    #menus
    Route::get('/menu', [UserMenuController::class, 'index'])->name('user.menu');
    Route::get('/fetch-category', [UserMenuController::class, 'fetchCategory'])->name('user.menu.fetchcategory');
    Route::get('/add-cart', [UserCheckoutController::class, 'add_to_cart'])->name('user.add_cart');
    Route::get('/delete-cart-product', [UserCheckoutController::class, 'delete_to_cart'])->name('user.delete_cart_product');//Ajax Routes
    // Route::get('/view-product/{id}', [UserProductController::class, 'index'])->name('user.product');
    // Route::get('/list-product', [UserProductController::class, 'listing'])->name('user.product_list');
    Route::get('/search-product',[UserProductController::class,'search'])->name('user.search_product');//Ajax Routes
    Route::get('/search-product-restaurant',[UserProductController::class,'restaurant_search'])->name('user.search_product_restaurant');//Ajax Routes
    Route::get('/search-product-category',[UserProductController::class,'category_search'])->name('user.search_product_category');//Ajax Routes
    Route::get('/search-product-type',[UserProductController::class,'type_search'])->name('user.search_product_type');//Ajax Routes
    Route::get('/search-product-price',[UserProductController::class,'price_search'])->name('user.search_product_price');//Ajax Routes
    Route::get('/view-cart', [UserCheckoutController::class, 'view_cart'])->name('user.view_cart');
    Route::get('/view-cart-incr-product', [UserCheckoutController::class, 'view_cart_incr_product'])->name('user.view_cart_product_incr');
    Route::get('/view-cart-decr-product', [UserCheckoutController::class, 'view_cart_decr_product'])->name('user.view_cart_product_decr');
    Route::get('/delete-view-cart-product', [UserCheckoutController::class, 'delete_to_view_cart'])->name('user.delete_view_cart_product');//Ajax Routes
    Route::get('/table-reservation', [UserReservationController::class, 'index'])->name('user.table_reservation');
    Route::get('/checkout', [UserCheckoutController::class, 'checkout'])->name('user.checkout');
    Route::get('/clear-cart', [UserCheckoutController::class, 'clear_cart'])->name('user.clear_cart');
    #profile
    Route::get('/profile', [UserProfileController::class, 'index'])->name('user.profile');
    Route::get('/fetch-states', [UserProfileController::class, 'fetchState'])->name('user.fetchState');//Ajax Routes
    Route::get('/fetch-city', [UserProfileController::class, 'fetchCity'])->name('user.fetchCity');//Ajax Routes
    Route::post('/user_address', [UserProfileController::class, 'address'])->name('user.address');
    Route::post('/user-changepassword', [UserProfileController::class,'ChangePassword'])->name('user.changepassword');
    Route::get('/update-default-address', [UserProfileController::class,'UpdateDefaultAddress'])->name('user.update_default_address');
    Route::get('/order/{id}/details', [UserProfileController::class,'OrderDetails'])->name('user.order_details');
    Route::get('/address/{id}/destroy', [UserProfileController::class,'address_destroy'])->name('user.address_destroys');
    Route::post('/update/profile', [UserProfileController::class,'UpdateProfile'])->name('user.update_profile');
    Route::get('/get-address', [UserProfileController::class,'GetAddress'])->name('user.profile_address');
    Route::post('/update-address', [UserProfileController::class,'UpdateAddress'])->name('user.updateaddress');

    Route::get('reservation-view/{id}',[UserProfileController::class,'ReservationView'])->name('user.reservationView');
    Route::get('product-review/{id}',[UserProfileController::class,'ProductReview'])->name('user.ProductReview');
    Route::post('product-review-store',[UserProfileController::class,'StoreProductReview'])->name('user.ProductReviewStore');
    #order
    Route::get('/order-confirm/{order_id}',[UserOrderController::class,'orderConfirmIndex'])->name('user.order_confirm');
    Route::get('/add-order',[UserOrderController::class,'addOrder'])->name('user.addOrder');
    #reservation
    Route::post('/reservation_add',[UserReservationController::class,'create_reservation'])->name('user.create_reservation');
    Route::get('/check-tables',[UserReservationController::class,'FindTables'])->name('user.find_tables');
    Route::get('/check-env',[UserOrderController::class,'checkenv'])->name('user.checkenv'); // tem
    Route::get('/check-mail',[UserOrderController::class,'checkmail'])->name('user.checkmail'); // tem
    Route::get('/config-clear',[UserOrderController::class,'configclear'])->name('user.config_clear'); // tem

    #payment
    Route::get('payment/page/{order_id}',[PaymentController::class,'paymentPage'])->name('payment.page.view');
    // Route::get('payment/status/store',[PaymentController::class,'storePaymentStatus'])->name('payment.status.store');
    Route::get('pay/now/{order_id}',[PaymentController::class,'payNow'])->name('pay.now');

    #Invoice
    Route::get('invoice/download-pdf/{id}', [UserProfileController::class, 'downloadPDF'])->name('user.download-pdf');

});

