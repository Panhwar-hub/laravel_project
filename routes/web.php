<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminDashController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ShopController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\SiteSettingsController;
use App\Http\Controllers\FrontEndEditorController;
use App\Http\Middleware\admin;
use App\Http\Controllers\Admin\StatisticsController;
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

Route::get('clear_cache', function () {
    \Artisan::call('optimize');
    \Artisan::call('route:clear');
    dd("Cache is cleared");
});

Route::get('/', [IndexController::class, 'index'])->name('home');
Route::get('/restaurants/{type?}/{slug?}', [IndexController::class, 'restaurants'])->name('restaurants');
Route::get('/restaurants-details', [IndexController::class, 'restaurants_details'])->name('restaurants-details');

Route::get('/music/{type?}/{slug?}', [IndexController::class, 'music'])->name('music');
Route::get('/music/feature/{type?}', [IndexController::class, 'musicfeature'])->name('musicfeature');

Route::get('/feature/{cat?}/{type?}', [IndexController::class, 'getfeature'])->name('feature');

Route::get('/art-and-museums/{type?}/{slug?}', [IndexController::class, 'art_and_museums'])->name('art-and-museums');
Route::get('/events/{type?}/{slug?}', [IndexController::class, 'events'])->name('events');
Route::get('/lifestyle/{type?}/{slug?}', [IndexController::class, 'lifestyle'])->name('lifestyle');
Route::get('/new-to-the-area/{type?}/{slug?}', [IndexController::class, 'new_to_the_area'])->name('new-to-the-area');
Route::get('/contact-us', [IndexController::class, 'contact_us'])->name('contact-us');
Route::get('/privacy-policy', [IndexController::class, 'privacy_policy'])->name('privacy-policy');

Route::get('/faqs', [IndexController::class, 'faqs'])->name('faqs');
Route::post('/create-faq', [BookingController::class, 'create_faq'])->name('create-faq');

Route::get('/email-verification', [IndexController::class, 'email_verification'])->name('email-verification');
Route::post('/mail-vefify', [UserController::class, 'mail_vefify'])->name('email-vefify');

Route::post('/add-reviews', [IndexController::class, 'add_reviews'])->name('add-reviews');

Route::get('/products', [IndexController::class, 'products'])->name('products');
Route::get('/search', [IndexController::class, 'search'])->name('search');
Route::get('/categories/{slug}', [IndexController::class, 'categories'])->name('categories');
Route::get('/brand/{slug}', [IndexController::class, 'brand'])->name('brand');
Route::get('/getsearch', [IndexController::class, 'colorsizesear'])->name('colorsizesear');
Route::get('/product-detail/{slug}', [IndexController::class, 'product_detail'])->name('product-detail');
Route::get('/vendors/{id}', [IndexController::class, 'vendors'])->name('vendors');
Route::get('/about-us', [IndexController::class, 'aboutus'])->name('aboutus');
Route::get('/shipping', [IndexController::class, 'shipping'])->name('shipping');
Route::get('/refund-policy', [IndexController::class, 'refund'])->name('refund');
Route::get('/terms&service', [IndexController::class, 'terms_of_service'])->name('terms_of_service');
// Route::get('/privacy-policy', [IndexController::class, 'privacy_policy'])->name('privacy_policy');
Route::get('/return-policy', [IndexController::class, 'return_policy'])->name('return_policy');
Route::get('/contact', [IndexController::class, 'contact'])->name('contact');
Route::get('/terms', [IndexController::class, 'terms'])->name('terms');
Route::get('/testimonials', [IndexController::class, 'testimonials'])->name('testimonials');
Route::get('/wishlist', [IndexController::class, 'wishlist'])->name('wishlist');
Route::post('/newsletter/store', [IndexController::class,'newsletterstore'])->name('newsletterstore');

Route::get('/new-to-the-area-detail/{slug}', [IndexController::class, 'new_to_the_area_detail'])->name('blog-detail');

Route::get('/products-search/{slug}', [IndexController::class, 'products_search'])->name('products_search');
Route::get('/vendor-products-search', [IndexController::class, 'vendor_products_search'])->name('vendor_products_search');

Route::get('/cart', [CartController::class, 'cart'])->name('cart');

Route::post('/save-cart', [CartController::class, 'save_cart'])->name('save-cart');
Route::post('update-cart',[CartController::class,'updatecart'])->name('update-cart');
Route::post('remove-cart',[CartController::class,'removecart'])->name('remove-cart');

Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::post('/checkouts', [CartController::class, 'checkoutpost'])->name('checkoutpost');

Route::get('/live-stream', [IndexController::class, 'live_stream'])->name('live-stream');
Route::get('/photos', [IndexController::class, 'photos'])->name('photos');
Route::get('/album/{decrypt}', [IndexController::class, 'album'])->name('album');
Route::get('/news-opportunities', [IndexController::class, 'opportunities'])->name('opportunities');
Route::get('/schedule', [IndexController::class, 'schedule'])->name('schedule');
Route::get('/get-schedule', [IndexController::class, 'get_schedule'])->name('get-schedule');
Route::get('/shop', [IndexController::class, 'shop'])->name('shop');
Route::get('/shop-detail/{slug}', [IndexController::class, 'shop_detail'])->name('shop-detail');
Route::get('/merchandise-detail/{slug}', [IndexController::class, 'merchandise_detail'])->name('merchandise-detail');
Route::get('/sponsors', [IndexController::class, 'sponsors'])->name('sponsors');


// Route::get('/save-cart', [CartController::class, 'save_cart'])->name('save-cart');

Route::get('/payment-success/{id}', [CartController::class,'checkout_landing'])->name('checkout_landing');
Route::get('/payment', [CartController::class,'paysecure'])->name('paysecure');
Route::post('/pay-status', [CartController::class,'paystatus'])->name('paystatus');
Route::post('/place-order', [CartController::class,'placeorder'])->name('placeorder');
Route::post('stripe', [CartController::class, 'stripePost'])->name('stripe.post');
Route::get('/opportunities-detail/{slug}', [IndexController::class, 'opportunities_detail'])->name('opportunities-detail');
// Route::get('/contact-us', [IndexController::class, 'contactus'])->name('contact-us');

Route::get('/order-submit', [CartController::class, 'order_submit'])->name('order.submit');

Route::post('user/create-review', [IndexController::class, 'create_review'])->name('user.create-review');

Route::get('/explore-edusauras', [IndexController::class, 'explore_edusauras'])->name('explore_edusauras');
Route::get('/explorer/{category}', [IndexController::class, 'explorer'])->name('explorer');
Route::get('/search-edusauras', [IndexController::class, 'search_edusauras'])->name('search_edusauras');
Route::get('/explore-edusauras-detail/{id}', [IndexController::class, 'explore_edusauras_detail'])->name('explore_edusauras_detail');
Route::get('/educator', [IndexController::class, 'educator'])->name('educator');
Route::get('/contribute', [IndexController::class, 'contribute'])->name('contribute');
// Route::get('/news', [IndexController::class, 'news'])->name('news');
Route::get('/search-news', [IndexController::class, 'search_news'])->name('search_news');
// Route::get('/news-detail/{slug}', [IndexController::class, 'news_detail'])->name('news-detail');
Route::get('/partners', [IndexController::class, 'partners'])->name('partners');

Route::post('/contact-us-submit', [UserController::class, 'contact_us_submit'])->name('contact-us-submit');
Route::get('/sign-in', [UserController::class, 'signin'])->name('sign-in');
Route::post('/sign-in', [UserController::class, 'signin_submit'])->name('sign-in-submit');
Route::get('/sign-up', [UserController::class, 'signup'])->name('sign-up');
Route::post('/sign-up', [UserController::class, 'signup_submit'])->name('sign-up-submit');

Route::get('/forget-password', [UserController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('/forget-password-submit', [UserController::class, 'submitForgetPasswordForm'])->name('forget.password.submit'); 
Route::get('/reset-password/{token}', [UserController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('/reset-password', [UserController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::group(['middleware' => 'auth'], function()
{
    Route::get('/sign-out', [UserController::class, 'signout'])->name('signout');
    
    // Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard.index');
    // Route::get('dashboard/edit_profile', [DashboardController::class, 'editprofile'])->name('dashboard.editProfile');
    // Route::post('dashboard/edit_profile', [DashboardController::class, 'saveprofile'])->name('dashboard.submitProfile');
    Route::get('dashboard/delete-profile/{id}', [DashboardController::class, 'delete_profile'])->name('dashboard.deleteProfile');

    Route::get('dashboard/password_change', [DashboardController::class, 'passwordchange'])->name('dashboard.passwordChange');
    Route::post('dashboard/update/password',[DashboardController::class, 'updatepassword'])->name('update.account.password');
    // Route::get('dashboard/my-wishlist', [DashboardController::class, 'myWishlist'])->name('dashboard.myWishlist');
    
    Route::post('add/wishlist',[UserController::class, 'addToWishlist'])->name('add.to.wishlist');
    Route::post('remove/wishlist',[UserController::class, 'removeFromWishlist'])->name('remove.from.wishlist');
    
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard.index');
    Route::get('dashboard/my-profile', [DashboardController::class, 'myProfile'])->name('dashboard.myProfile');
    Route::get('dashboard/edit_profile', [DashboardController::class, 'editprofile'])->name('dashboard.editProfile');
    Route::post('dashboard/edit_profile', [DashboardController::class, 'saveprofile'])->name('dashboard.submitProfile');
    Route::get('dashboard/my-orders', [DashboardController::class, 'myorders'])->name('dashboard.myBookings');
    Route::get('dashboard/view-orders/{decrypt}', [DashboardController::class, 'vieworders'])->name('dashboard.viewAppointment');
    // Route::get('dashboard/edit-orders/{decrypt}', [DashboardController::class, 'editAppointment'])->name('dashboard.editAppointment'); 
    Route::get('dashboard/delete-orders/{decrypt}', [DashboardController::class, 'deleteorders'])->name('dashboard.deleteAppointment');
    
    Route::get('dashboard/my-bookings', [DashboardController::class, 'mybookings'])->name('dashboard.bookings');
    Route::get('dashboard/view-bookings/{decrypt}', [DashboardController::class, 'viewbookings'])->name('dashboard.viewbooking');
    // Route::get('dashboard/edit-orders/{decrypt}', [DashboardController::class, 'editAppointment'])->name('dashboard.editAppointment'); 
    Route::get('dashboard/delete-bookings/{decrypt}', [DashboardController::class, 'deletebookings'])->name('dashboard.deletebooking');
    
    Route::get('/reviews-list', [DashboardController::class, 'reviews_listing'])->name('dashboard.reviews_listing'); 
    //  Route::get('/add-reviews', [DashboardController::class, 'add_reviews'])->name('dashboard.add_reviews'); 
    //  Route::post('/create-reviews', [DashboardController::class, 'create_reviews'])->name('dashboard.create_reviews');
    Route::get('/edit-review/{decrypt}', [DashboardController::class, 'edit_reviews'])->name('dashboard.edit_reviews');  
    Route::post('/edit-review', [DashboardController::class, 'savereviews'])->name('dashboard.savereviews');  
    Route::get('/suspend-review/{id}', [DashboardController::class, 'suspend_reviews'])->name('dashboard.suspend_reviews');  
    Route::get('/delete-review/{id}', [DashboardController::class, 'delete_reviews'])->name('dashboard.delete_reviews'); 
    
    Route::get('dashboard/refund-management', [DashboardController::class, 'refund'])->name('dashboard.refund');
    Route::get('dashboard/add-request-refund', [DashboardController::class, 'request_form'])->name('dashboard.requestform');
    Route::post('dashboard/add-request-post', [DashboardController::class, 'submitrequest'])->name('dashboard.submitrequest');
    
    Route::get('dashboard/return-management', [DashboardController::class, 'return'])->name('dashboard.return');
    Route::get('dashboard/add-request-return', [DashboardController::class, 'request_formreturn'])->name('dashboard.request_formreturn');
    
    Route::get('dashboard/order-cancel-management', [DashboardController::class, 'ordercancel'])->name('dashboard.ordercancel');
    Route::get('dashboard/add-request-order-cancel', [DashboardController::class, 'request_formcancel'])->name('dashboard.request_formcancel');
});



Route::get('/admins', function(){
	return redirect('admin/login');
})->name('admin.admin');

Route::middleware(['guest'])->prefix('admin')->namespace('Admin')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'get_login'])->name('admin.login');
    Route::post('/perform-login', [AdminLoginController::class, 'performLogin'])->name('admin.performLogin');
	//Route::post('/performLogin', 'LoginController@performLogin')->name('adminiy.performLogin')->middleware('throttle:4,1');
});

Route::middleware(['admin'])->prefix('admin')->namespace('admin')->group(function () {
    Route::get('/',function(){
      return redirect('/admin/dashboard');
    });
    
    Route::get('/get-sub-cat', [ShopController::class, 'get_sub_cat'])->name('admin.get_sub_cat'); 

    Route::get('/color-listing', [ShopController::class, 'color_listing'])->name('admin.color_listing'); 
    Route::get('/add-color', [ShopController::class, 'add_color'])->name('admin.add_color'); 
    Route::post('/create-color', [ShopController::class, 'create_color'])->name('admin.create_color');
    Route::get('/edit-color/{id}', [ShopController::class, 'edit_color'])->name('admin.edit_color');  
    Route::post('/edit-color', [ShopController::class, 'savecolor'])->name('admin.savecolor');  
    Route::get('/suspend-color/{id}', [ShopController::class, 'suspend_color'])->name('admin.suspend_color');  
    Route::get('/delete-color/{id}', [ShopController::class, 'delete_color'])->name('admin.delete_color'); 

    Route::get('/coupon-listing', [AdminDashController::class, 'coupon_listing'])->name('admin.coupon_listing'); 
    Route::get('/add-coupon', [AdminDashController::class, 'add_coupon'])->name('admin.add_coupon'); 
    Route::post('/create-coupon', [AdminDashController::class, 'create_coupon'])->name('admin.create_coupon');
    Route::get('/edit-coupon/{id}', [AdminDashController::class, 'edit_coupon'])->name('admin.edit_coupon');  
    Route::post('/edit-coupon', [AdminDashController::class, 'savecoupon'])->name('admin.savecoupon');  
    Route::get('/suspend-coupon/{id}', [AdminDashController::class, 'suspend_coupon'])->name('admin.suspend_coupon');  
    Route::get('/delete-coupon/{id}', [AdminDashController::class, 'delete_coupon'])->name('admin.delete_coupon'); 
    
    Route::get('/size-listing', [ShopController::class, 'size_listing'])->name('admin.size_listing'); 
    Route::get('/add-size', [ShopController::class, 'add_size'])->name('admin.add_size'); 
    Route::post('/create-size', [ShopController::class, 'create_size'])->name('admin.create_size');
    Route::get('/edit-size/{id}', [ShopController::class, 'edit_size'])->name('admin.edit_size');  
    Route::post('/edit-size', [ShopController::class, 'savesize'])->name('admin.savesize');  
    Route::get('/suspend-size/{id}', [ShopController::class, 'suspend_size'])->name('admin.suspend_size');  
    Route::get('/delete-size/{id}', [ShopController::class, 'delete_size'])->name('admin.delete_size'); 

    Route::get('/variation-listing', [ShopController::class, 'variation_listing'])->name('admin.variation_listing'); 
    Route::get('/add-variation', [ShopController::class, 'add_variation'])->name('admin.add_variation'); 
    Route::post('/create-variation', [ShopController::class, 'create_variation'])->name('admin.create_variation');
    Route::get('/edit-variation/{id}', [ShopController::class, 'edit_variation'])->name('admin.edit_variation');  
    Route::post('/edit-variation', [ShopController::class, 'savevariation'])->name('admin.savevariation');  
    Route::get('/suspend-variation/{id}', [ShopController::class, 'suspend_variation'])->name('admin.suspend_variation');  
    Route::get('/delete-variation/{id}', [ShopController::class, 'delete_variation'])->name('admin.delete_variation');  
    Route::get('/get-color', [ShopController::class, 'get_color'])->name('admin.get_color'); 
    
    Route::get('/variationimage-listing', [ShopController::class, 'variationimage_listing'])->name('admin.variationimage_listing'); 
    Route::get('/add-variationimage', [ShopController::class, 'add_variationimage'])->name('admin.add_variationimage'); 
    Route::post('/create-variationimage', [ShopController::class, 'create_variationimage'])->name('admin.create_variationimage');
    Route::get('/edit-variationimage/{id}', [ShopController::class, 'edit_variationimage'])->name('admin.edit_variationimage');  
    Route::post('/edit-variationimage', [ShopController::class, 'savevariationimage'])->name('admin.savevariationimage');  
    Route::get('/suspend-variationimage/{id}', [ShopController::class, 'suspend_variationimage'])->name('admin.suspend_variationimage');  
    Route::get('/delete-variationimage/{id}', [ShopController::class, 'delete_variationimage'])->name('admin.delete_variationimage');  

    Route::get('/dashboard', [AdminDashController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/list-web-crawl', [AdminDashController::class, 'ListWebCrawl'])->name('admin.listWebCrawl');
    Route::get('/new-web-crawl', [AdminDashController::class, 'NewWebCrawl'])->name('admin.newWebCrawl');
    Route::get('/search_crawl', [AdminDashController::class, 'searchCrawl'])->name('admin.searchCrawl');
    Route::get('/crawl-detail/{id}', [AdminDashController::class, 'crawlDetail'])->name('admin.crawlDetail');
    Route::get('/crawl-delete/{id}', [AdminDashController::class, 'crawlDelete'])->name('admin.crawlDelete');
    Route::get('/crawl-edit/{id}', [AdminDashController::class, 'crawlEdit'])->name('admin.crawlEdit');
    Route::post('/crawl-update', [AdminDashController::class, 'crawlUpdate'])->name('admin.crawlUpdate');
    Route::post('update-crawl-status', [AdminDashController::class, 'crawlStatusUpdate'])->name('admin.crawlStatusUpdate');

    Route::get('/inquiries-listing', [AdminDashController::class, 'inquiries_listing'])->name('admin.inquiries_listing'); 
    Route::get('/inquiries-listing/view/{id}', [AdminDashController::class, 'inquiries_listing_view'])->name('admin.inquiries_listing_view');         
    Route::get('/inquiries-listing/delete/{id}', [AdminDashController::class, 'inquiries_listing_delete'])->name('admin.inquiries_listing_delete'); 

    Route::get('/refund-listing', [AdminDashController::class, 'refund_listing'])->name('admin.refund_listing'); 
    Route::get('/refund-request/view/{id}', [AdminDashController::class, 'refund_listing_view'])->name('admin.refund_listing_view');         
    Route::get('/refund-request/delete/{id}', [AdminDashController::class, 'refund_listing_delete'])->name('admin.refund_listing_delete'); 
    Route::get('/refund-request-status/{id}', [AdminDashController::class, 'refund_status'])->name('admin.refund_status');  

    Route::get('/return-listing', [AdminDashController::class, 'return_listing'])->name('admin.return_listing'); 
    Route::get('/return-request/view/{id}', [AdminDashController::class, 'return_listing_view'])->name('admin.return_listing_view');         
    Route::get('/return-request/delete/{id}', [AdminDashController::class, 'return_listing_delete'])->name('admin.return_listing_delete'); 
    Route::get('/return-request-status/{id}', [AdminDashController::class, 'return_status'])->name('admin.return_status');  

    Route::get('/cancelorder-listing', [AdminDashController::class, 'cancelorder_listing'])->name('admin.cancelorder_listing'); 
    Route::get('/cancelorder-request/view/{id}', [AdminDashController::class, 'cancelorder_listing_view'])->name('admin.cancelorder_listing_view');         
    Route::get('/cancelorder-request/delete/{id}', [AdminDashController::class, 'cancelorder_listing_delete'])->name('admin.cancelorder_listing_delete'); 
    Route::get('/cancelorder-request-status/{id}', [AdminDashController::class, 'cancelorder_status'])->name('admin.cancelorder_status');  

    Route::get('/users-listing', [AdminDashController::class, 'users_listing'])->name('admin.users_listing'); 
    Route::get('/add-users', [AdminDashController::class, 'add_users'])->name('admin.add_users'); 
    Route::post('/create-users', [AdminDashController::class, 'create_users'])->name('admin.create_users');
    Route::get('/edit-users/{id}', [AdminDashController::class, 'edit_user'])->name('admin.edit_user');  
    Route::post('/edit-users', [AdminDashController::class, 'saveprofile'])->name('admin.saveprofile');  
    Route::get('/suspend-user/{id}', [AdminDashController::class, 'suspend_user'])->name('admin.suspend_user');  
    Route::get('/delete-user/{id}', [AdminDashController::class, 'delete_user'])->name('admin.delete_user');  
    
    Route::get('/logo-management', [SiteSettingsController::class, 'showLogo'])->name('admin.showLogo');
    Route::post('/logo-management-save', [SiteSettingsController::class, 'saveLogo'])->name('admin.saveLogo');

    Route::get('/orders', [OrderController::class,'orders'])->name('admin.orders');
    Route::get('/order-detail/{id}', [OrderController::class,'order_detail'])->name('admin.order_detail');
    Route::get('/order-delete/{id}', [OrderController::class,'order_delete'])->name('admin.order_delete');
    Route::get('/order-status', [OrderController::class,'order_status'])->name('admin.order_status');

    Route::get('/bookings', [OrderController::class,'bookings'])->name('admin.bookings');
    Route::get('/bookings-detail/{id}', [OrderController::class,'bookings_detail'])->name('admin.bookings_detail');
    Route::get('/bookings-delete/{id}', [OrderController::class,'bookings_delete'])->name('admin.bookings_delete');
    Route::get('/bookings-suspend/{id}', [OrderController::class,'bookings_suspend'])->name('admin.bookings_suspend');

    //  Route::get('/news-listing', [AdminDashController::class, 'news_listing'])->name('admin.news_listing'); 
    //  Route::get('/add-news', [AdminDashController::class, 'add_news'])->name('admin.add_news'); 
    //  Route::post('/create-news', [AdminDashController::class, 'create_news'])->name('admin.create_news');
    //  Route::get('/edit-news/{id}', [AdminDashController::class, 'edit_news'])->name('admin.edit_news');  
    //  Route::post('/edit-news', [AdminDashController::class, 'savenews'])->name('admin.savenews');  
    //  Route::get('/suspend-news/{id}', [AdminDashController::class, 'suspend_news'])->name('admin.suspend_news');  
    //  Route::get('/delete-news/{id}', [AdminDashController::class, 'delete_news'])->name('admin.delete_news');  

    Route::get('/testimonial-listing', [AdminDashController::class, 'testimonial_listing'])->name('admin.testimonial_listing'); 
    Route::get('/add-testimonial', [AdminDashController::class, 'add_testimonial'])->name('admin.add_testimonial'); 
    Route::post('/create-testimonial', [AdminDashController::class, 'create_testimonial'])->name('admin.create_testimonial');
    Route::get('/edit-testimonial/{id}', [AdminDashController::class, 'edit_testimonial'])->name('admin.edit_testimonial');  
    Route::post('/edit-testimonial', [AdminDashController::class, 'savetestimonial'])->name('admin.savetestimonial');  
    Route::get('/suspend-testimonial/{id}', [AdminDashController::class, 'suspend_testimonial'])->name('admin.suspend_testimonial');  
    Route::get('/delete-testimonial/{id}', [AdminDashController::class, 'delete_testimonial'])->name('admin.delete_testimonial'); 

    Route::get('/reviews-listing', [AdminDashController::class, 'reviews_listing'])->name('admin.reviews_listing'); 
    //  Route::get('/add-reviews', [AdminDashController::class, 'add_reviews'])->name('admin.add_reviews'); 
    //  Route::post('/create-reviews', [AdminDashController::class, 'create_reviews'])->name('admin.create_reviews');
    Route::get('/edit-reviews/{id}', [AdminDashController::class, 'edit_reviews'])->name('admin.edit_reviews');  
    Route::post('/edit-reviews', [AdminDashController::class, 'savereviews'])->name('admin.savereviews');  
    Route::get('/suspend-reviews/{id}', [AdminDashController::class, 'suspend_reviews'])->name('admin.suspend_reviews');  
    Route::get('/delete-reviews/{id}', [AdminDashController::class, 'delete_reviews'])->name('admin.delete_reviews'); 
    Route::post('/review-feedback', [AdminDashController::class, 'reviewfeedback'])->name('admin.review-feedback');  
    

    Route::get('/newsletter-listing', [AdminDashController::class, 'newsletter_listing'])->name('admin.newsletter_listing'); 
    Route::get('/newsletter-listing/view/{id}', [AdminDashController::class, 'newsletter_listing_view'])->name('admin.newsletter_listing_view');         
    Route::get('/newsletter-listing/delete/{id}', [AdminDashController::class, 'newsletter_listing_delete'])->name('admin.newsletter_listing_delete');

    Route::get('/album-listing', [GalleryController::class, 'album_listing'])->name('admin.album_listing'); 
    Route::get('/add-album', [GalleryController::class, 'add_album'])->name('admin.add_album'); 
    Route::post('/create-album', [GalleryController::class, 'create_album'])->name('admin.create_album');
    Route::get('/edit-album/{id}', [GalleryController::class, 'edit_album'])->name('admin.edit_album');  
    Route::post('/edit-album', [GalleryController::class, 'savealbum'])->name('admin.savealbum');  
    Route::get('/suspend-album/{id}', [GalleryController::class, 'suspend_album'])->name('admin.suspend_album');  
    Route::get('/delete-album/{id}', [GalleryController::class, 'delete_album'])->name('admin.delete_album'); 
    
    Route::get('/photos-listing', [GalleryController::class, 'photos_listing'])->name('admin.photos_listing'); 
    Route::get('/add-photos', [GalleryController::class, 'add_photos'])->name('admin.add_photos'); 
    Route::post('/create-photos', [GalleryController::class, 'create_photos'])->name('admin.create_photos');
    Route::get('/edit-photos/{id}', [GalleryController::class, 'edit_photos'])->name('admin.edit_photos');  
    Route::get('/edit-photos/{id}', [GalleryController::class, 'edit_photos'])->name('admin.edit_photos');  
    Route::post('/edit-photos', [GalleryController::class, 'savephotos'])->name('admin.savephotos');  
    Route::get('/suspend-photos/{id}', [GalleryController::class, 'suspend_photos'])->name('admin.suspend_photos');  
    Route::get('/delete-photos/{id}', [GalleryController::class, 'delete_photos'])->name('admin.delete_photos');

    Route::get('/blog-listing', [AdminDashController::class, 'blog_listing'])->name('admin.blog_listing'); 
    Route::get('/add-blog', [AdminDashController::class, 'add_blog'])->name('admin.add_blog'); 
    Route::post('/create-blog', [AdminDashController::class, 'create_blog'])->name('admin.create_blog');
    Route::get('/edit-blog/{id}', [AdminDashController::class, 'edit_blog'])->name('admin.edit_blog');  
    Route::post('/edit-blog', [AdminDashController::class, 'saveblog'])->name('admin.saveblog');  
    Route::get('/suspend-blog/{id}', [AdminDashController::class, 'suspend_blog'])->name('admin.suspend_blog');  
    Route::get('/delete-blog/{id}', [AdminDashController::class, 'delete_blog'])->name('admin.delete_blog'); 

    Route::get('/news-events-listing', [AdminDashController::class, 'news_events_listing'])->name('admin.news_events_listing'); 
    Route::get('/add-news-events', [AdminDashController::class, 'add_news_events'])->name('admin.add_news_events'); 
    Route::post('/create-news-events', [AdminDashController::class, 'create_news_events'])->name('admin.create_news_events');
    Route::get('/edit-news-events/{id}', [AdminDashController::class, 'edit_news_events'])->name('admin.edit_news_events');  
    Route::post('/edit-news-events', [AdminDashController::class, 'savenews_events'])->name('admin.savenews_events');  
    Route::get('/suspend-news-events/{id}', [AdminDashController::class, 'suspend_news_events'])->name('admin.suspend_news_events');  
    Route::get('/delete-news-events/{id}', [AdminDashController::class, 'delete_news_events'])->name('admin.delete_news_events'); 

    Route::get('/team-listing', [TeamController::class, 'team_listing'])->name('admin.team_listing'); 
    Route::get('/add-team', [TeamController::class, 'add_team'])->name('admin.add_team'); 
    Route::post('/create-team', [TeamController::class, 'create_team'])->name('admin.create_team');
    Route::get('/edit-team/{id}', [TeamController::class, 'edit_team'])->name('admin.edit_team');  
    Route::post('/edit-team', [TeamController::class, 'saveteam'])->name('admin.saveteam');  
    Route::get('/suspend-team/{id}', [TeamController::class, 'suspend_team'])->name('admin.suspend_team');  
    Route::get('/delete-team/{id}', [TeamController::class, 'delete_team'])->name('admin.delete_team'); 

    Route::get('/matches-listing', [TeamController::class, 'matches_listing'])->name('admin.matches_listing'); 
    Route::get('/add-matches', [TeamController::class, 'add_matches'])->name('admin.add_matches'); 
    Route::post('/create-matches', [TeamController::class, 'create_matches'])->name('admin.create_matches');
    Route::get('/edit-matches/{id}', [TeamController::class, 'edit_matches'])->name('admin.edit_matches');  
    Route::post('/edit-matches', [TeamController::class, 'savematches'])->name('admin.savematches');  
    Route::get('/suspend-matches/{id}', [TeamController::class, 'suspend_matches'])->name('admin.suspend_matches');  
    Route::get('/delete-matches/{id}', [TeamController::class, 'delete_matches'])->name('admin.delete_matches'); 

    Route::get('/lesson-listing', [AdminDashController::class, 'lesson_listing'])->name('admin.lesson_listing'); 
    Route::get('/add-lesson', [AdminDashController::class, 'add_lesson'])->name('admin.add_lesson'); 
    Route::post('/create-lesson', [AdminDashController::class, 'create_lesson'])->name('admin.create_lesson');
    Route::get('/edit-lesson/{id}', [AdminDashController::class, 'edit_lesson'])->name('admin.edit_lesson');  
    Route::post('/edit-lesson', [AdminDashController::class, 'savelesson'])->name('admin.savelesson');  
    Route::get('/suspend-lesson/{id}', [AdminDashController::class, 'suspend_lesson'])->name('admin.suspend_lesson');  
    Route::get('/delete-lesson/{id}', [AdminDashController::class, 'delete_lesson'])->name('admin.delete_lesson');  

    Route::get('/products-listing', [ShopController::class, 'products_listing'])->name('admin.products_listing'); 
    Route::get('/add-products', [ShopController::class, 'add_products'])->name('admin.add_products');
    Route::get('/get-products', [ShopController::class, 'get_products'])->name('admin.get_products');

    Route::get('/get-type-feature', [ShopController::class, 'get_type_feature'])->name('admin.get_type_feature');

    Route::post('/create-products', [ShopController::class, 'create_products'])->name('admin.create_products');
    Route::get('/edit-products/{slug}', [ShopController::class, 'edit_products'])->name('admin.edit_products');  
    Route::post('/edit-products', [ShopController::class, 'saveproducts'])->name('admin.saveproducts');  
    Route::get('/suspend-products/{id}', [ShopController::class, 'suspend_products'])->name('admin.suspend_products');  
    Route::get('/delete-products/{id}', [ShopController::class, 'delete_products'])->name('admin.delete_products');  
    Route::get('/delete-multi-img/{id}', [ShopController::class, 'delete_multiimg'])->name('admin.delete_multiimg'); 

    Route::get('/type-listing', [ShopController::class, 'type_listing'])->name('admin.type_listing'); 
    Route::get('/add-type', [ShopController::class, 'add_type'])->name('admin.add_type');
    Route::post('/create-type', [ShopController::class, 'create_type'])->name('admin.create_type');
    Route::get('/edit-type/{slug}', [ShopController::class, 'edit_type'])->name('admin.edit_type');  
    Route::post('/edit-type', [ShopController::class, 'savetype'])->name('admin.savetype');  
    Route::get('/suspend-type/{id}', [ShopController::class, 'suspend_type'])->name('admin.suspend_type');  
    Route::get('/delete-type/{id}', [ShopController::class, 'delete_type'])->name('admin.delete_type');  

    Route::get('/feature-listing', [ShopController::class, 'feature_listing'])->name('admin.feature_listing'); 
    Route::get('/add-feature', [ShopController::class, 'add_feature'])->name('admin.add_feature');
    Route::post('/create-feature', [ShopController::class, 'create_feature'])->name('admin.create_feature');
    Route::get('/edit-feature/{slug}', [ShopController::class, 'edit_feature'])->name('admin.edit_feature');  
    Route::post('/edit-feature', [ShopController::class, 'savefeature'])->name('admin.savefeature');  
    Route::get('/suspend-feature/{id}', [ShopController::class, 'suspend_feature'])->name('admin.suspend_feature');  
    Route::get('/delete-feature/{id}', [ShopController::class, 'delete_feature'])->name('admin.delete_feature');  
    
    Route::get('/address-listing', [ShopController::class, 'address_listing'])->name('admin.address_listing'); 
    Route::get('/add-address', [ShopController::class, 'add_address'])->name('admin.add_address');
    Route::post('/create-address', [ShopController::class, 'create_address'])->name('admin.create_address');
    Route::get('/edit-address/{slug}', [ShopController::class, 'edit_address'])->name('admin.edit_address');  
    Route::post('/edit-address', [ShopController::class, 'saveaddress'])->name('admin.saveaddress');  
    Route::get('/suspend-address/{id}', [ShopController::class, 'suspend_address'])->name('admin.suspend_address');  
    Route::get('/delete-address/{id}', [ShopController::class, 'delete_address'])->name('admin.delete_address');

    Route::get('/merchandise-listing', [ShopController::class, 'merchandise_listing'])->name('admin.merchandise_listing'); 
    Route::get('/add-merchandise', [ShopController::class, 'add_merchandise'])->name('admin.add_merchandise'); 
    Route::post('/create-merchandise', [ShopController::class, 'create_merchandise'])->name('admin.create_merchandise');
    Route::get('/edit-merchandise/{slug}', [ShopController::class, 'edit_merchandise'])->name('admin.edit_merchandise');  
    Route::post('/edit-merchandise', [ShopController::class, 'savemerchandise'])->name('admin.savemerchandise');  
    Route::get('/suspend-merchandise/{id}', [ShopController::class, 'suspend_merchandise'])->name('admin.suspend_merchandise');  
    Route::get('/delete-merchandise/{id}', [ShopController::class, 'delete_merchandise'])->name('admin.delete_merchandise');  
    
    Route::get('/partner-listing', [AdminDashController::class, 'partner_listing'])->name('admin.partner_listing'); 
    Route::get('/add-partner', [AdminDashController::class, 'add_partner'])->name('admin.add_partner'); 
    Route::post('/create-partner', [AdminDashController::class, 'create_partner'])->name('admin.create_partner');
    Route::get('/edit-partner/{id}', [AdminDashController::class, 'edit_partner'])->name('admin.edit_partner');  
    Route::post('/edit-partner', [AdminDashController::class, 'savepartner'])->name('admin.savepartner');  
    Route::get('/suspend-partner/{id}', [AdminDashController::class, 'suspend_partner'])->name('admin.suspend_partner');  
    Route::get('/delete-partner/{id}', [AdminDashController::class, 'delete_partner'])->name('admin.delete_partner');  
    
    
    Route::get('/category-listing', [AdminDashController::class, 'category_listing'])->name('admin.category_listing'); 
    Route::get('/add-category', [AdminDashController::class, 'add_category'])->name('admin.add_category'); 
    Route::post('/create-category', [AdminDashController::class, 'create_category'])->name('admin.create_category');
    Route::get('/edit-category/{id}', [AdminDashController::class, 'edit_category'])->name('admin.edit_category');  
    Route::post('/edit-category', [AdminDashController::class, 'savecategory'])->name('admin.savecategory');  
    Route::get('/suspend-category/{id}', [AdminDashController::class, 'suspend_category'])->name('admin.suspend_category');  
    Route::get('/delete-category/{id}', [AdminDashController::class, 'delete_category'])->name('admin.delete_category'); 

    Route::get('/brand-listing', [AdminDashController::class, 'brand_listing'])->name('admin.brand_listing'); 
    Route::get('/add-brand', [AdminDashController::class, 'add_brand'])->name('admin.add_brand'); 
    Route::post('/create-brand', [AdminDashController::class, 'create_brand'])->name('admin.create_brand');
    Route::get('/edit-brand/{id}', [AdminDashController::class, 'edit_brand'])->name('admin.edit_brand');  
    Route::post('/edit-brand', [AdminDashController::class, 'savebrand'])->name('admin.savebrand');  
    Route::get('/suspend-brand/{id}', [AdminDashController::class, 'suspend_brand'])->name('admin.suspend_brand');  
    Route::get('/delete-brand/{id}', [AdminDashController::class, 'delete_brand'])->name('admin.delete_brand'); 
    
    Route::get('/vendor-listing', [AdminDashController::class, 'vendor_listing'])->name('admin.vendor_listing'); 
    Route::get('/add-vendor', [AdminDashController::class, 'add_vendor'])->name('admin.add_vendor'); 
    Route::post('/create-vendor', [AdminDashController::class, 'create_vendor'])->name('admin.create_vendor');
    Route::get('/edit-vendor/{id}', [AdminDashController::class, 'edit_vendor'])->name('admin.edit_vendor');  
    Route::post('/edit-vendor', [AdminDashController::class, 'savevendor'])->name('admin.savevendor');  
    Route::get('/suspend-vendor/{id}', [AdminDashController::class, 'suspend_vendor'])->name('admin.suspend_vendor');  
    Route::get('/delete-vendor/{id}', [AdminDashController::class, 'delete_vendor'])->name('admin.delete_vendor'); 
    
    
    Route::get('/subcategory-listing', [AdminDashController::class, 'subcategory_listing'])->name('admin.subcategory_listing'); 
    Route::get('/add-subcategory', [AdminDashController::class, 'add_subcategory'])->name('admin.add_subcategory'); 
    Route::post('/create-subcategory', [AdminDashController::class, 'create_subcategory'])->name('admin.create_subcategory');
    Route::get('/edit-subcategory/{id}', [AdminDashController::class, 'edit_subcategory'])->name('admin.edit_subcategory');  
    Route::get('/edit-subcategory/{id}', [AdminDashController::class, 'edit_subcategory'])->name('admin.edit_subcategory');  
    Route::post('/edit-subcategory', [AdminDashController::class, 'savesubcategory'])->name('admin.savesubcategory');  
    Route::get('/suspend-subcategory/{id}', [AdminDashController::class, 'suspend_subcategory'])->name('admin.suspend_subcategory');  
    Route::get('/delete-subcategory/{id}', [AdminDashController::class, 'delete_subcategory'])->name('admin.delete_subcategory');  
    
    Route::post('/getsubcategory', [AdminDashController::class, 'getsubcategory'])->name('admin.getsubcategory'); 
    
    Route::get('/faq-listing', [AdminDashController::class, 'faq_listing'])->name('admin.faq_listing'); 
    Route::get('/add-faq', [AdminDashController::class, 'add_faq'])->name('admin.add_faq'); 
    Route::post('/create-faq', [AdminDashController::class, 'create_faq'])->name('admin.create_faq');
    Route::get('/edit-faq/{id}', [AdminDashController::class, 'edit_faq'])->name('admin.edit_faq');  
    Route::post('/edit-faq', [AdminDashController::class, 'savefaq'])->name('admin.savefaq');  
    Route::get('/suspend-faq/{id}', [AdminDashController::class, 'suspend_faq'])->name('admin.suspend_faq');  
    Route::get('/delete-faq/{id}', [AdminDashController::class, 'delete_faq'])->name('admin.delete_faq');  

    Route::get('/contact-social-info', [SiteSettingsController::class, 'socialInfo'])->name('admin.socialInfo');
    Route::post('/contact-social-info', [SiteSettingsController::class, 'saveSocialInfo'])->name('admin.saveSocialInfo');
    
    Route::get('/banner', [SiteSettingsController::class, 'homeSlider'])->name('admin.homeSlider');
    Route::get('/add-banner', [SiteSettingsController::class, 'addhomeSlider'])->name('admin.addhomeSlider');
    Route::post('/add-banner', [SiteSettingsController::class, 'createhomeSlider'])->name('admin.createhomeSlider');
    Route::get('/edit-banner/{id}', [SiteSettingsController::class, 'edithomeSlider'])->name('admin.edithomeSlider');
    Route::post('/edit-banner', [SiteSettingsController::class, 'updatehomeSlider'])->name('admin.updatehomeSlider');
    Route::get('/delete-home-slider/{id}', [SiteSettingsController::class, 'deletehomeSlider'])->name('admin.deletehomeSlider');
    Route::get('/suspend-home-slider/{id}', [SiteSettingsController::class, 'suspendhomeSlider'])->name('admin.suspendhomeSlider');

    Route::get('/welcome-slider', [SiteSettingsController::class, 'welcomeSlider'])->name('admin.welcomeSlider');
    Route::get('/add-welcome-slider', [SiteSettingsController::class, 'addwelcomeSlider'])->name('admin.addwelcomeSlider');
    Route::post('/add-welcome-slider', [SiteSettingsController::class, 'createwelcomeSlider'])->name('admin.createwelcomeSlider');
    Route::get('/edit-welcome-slider/{id}', [SiteSettingsController::class, 'editwelcomeSlider'])->name('admin.editwelcomeSlider');
    Route::post('/edit-welcome-slider', [SiteSettingsController::class, 'updatewelcomeSlider'])->name('admin.updatewelcomeSlider');
    Route::get('/delete-welcome-slider/{id}', [SiteSettingsController::class, 'deletewelcomeSlider'])->name('admin.deletewelcomeSlider');
    Route::get('/suspend-welcome-slider/{id}', [SiteSettingsController::class, 'suspendwelcomeSlider'])->name('admin.suspendwelcomeSlider');
    
    Route::get('/cms-content', [SiteSettingsController::class, 'cms'])->name('admin.cms');
    Route::get('/cms-content-edit/{id}', [SiteSettingsController::class, 'edit_cms'])->name('admin.editCms');
    Route::post('/cms-content-update', [SiteSettingsController::class, 'update_cms'])->name('admin.updateCms');
     
    Route::get('/check_slug', [AdminDashController::class, 'check_slug'])->name('admin.check_slug');

    Route::get('/admin-listing', [AdminDashController::class, 'admins_listing'])->name('admin.admin_listing'); 
    Route::get('/add-admin', [AdminDashController::class, 'add_admins'])->name('admin.add_admin'); 
    Route::post('/create-admin', [AdminDashController::class, 'create_admin'])->name('admin.create_admin');
    Route::get('/edit-admin/{id}', [AdminDashController::class, 'edit_admin'])->name('admin.edit_admin');  
    Route::post('/edit-admin', [AdminDashController::class, 'saveadmin'])->name('admin.saveadmin');  
    Route::get('/suspend-admin/{id}', [AdminDashController::class, 'suspend_admin'])->name('admin.suspend_admin');  
    Route::get('/delete-admin/{id}', [AdminDashController::class, 'delete_admin'])->name('admin.delete_admin');  
      
    
    /*FRONT END EDITOR*/
    Route::post('/statusAjaxUpdateCustom', [FrontEndEditorController::class,'statusAjaxUpdateCustom']);
    Route::post('/statusAjaxUpdate', [FrontEndEditorController::class,'statusAjaxUpdate']);
    Route::post('/updateFlagOnKey', [FrontEndEditorController::class,'updateFlagOnKey']);
    /*FRONT END EDITOR End*/
    
    /*FRONT END IMAGE Upload*/
    Route::post('/imageUpload', [FrontEndEditorController::class, 'imageUpload']);
    /*FRONT END IMAGE Upload END*/
    
    Route::get('/published-links-statistics', [StatisticsController::class, 'published_links_statistics'])->name('admin.published_links_statistics'); 
    Route::get('/inquiry-statistics', [StatisticsController::class, 'inquiry_statistics'])->name('admin.inquiry_statistics'); 
    
    Route::get('/web-crawl-statistics', [StatisticsController::class, 'web_crawl_statistics'])->name('admin.web_crawl_statistics'); 
    
    Route::get('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

    
   
});
