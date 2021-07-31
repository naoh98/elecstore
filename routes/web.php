<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
//route hiển thị view electronic store
Route::get('/','Frontend\IndexController@index')->name('homepage');

/*============== ROUTE FOR PRODUCT PAGE, SINGLE PAGE ===================== */

//route hiển thị view tất cả sản phẩm electronic store
Route::get('/shop-category','Frontend\CategoryController@indexall')->name('cat.pro.all');
//route chức năng lọc tất cả sản phẩm
Route::get('/shop-category/product_filter','Frontend\CategoryController@filterall')->name('filter.all');

//route hiển thị view sản phẩm theo danh mục electronic store
Route::get('/shop-category/{category_id}','Frontend\CategoryController@index')->name('cat.pro');
//route chức năng lọc sản phẩm theo danh mục
Route::get('/shop-category/{category_id}/product_filter','Frontend\CategoryController@filter')->name('filter');

//route hiển thị Detail sản phẩm
Route::get('/product/{product_id}','Frontend\ProductController@index');



/*============== ROUTE FOR ABOUT, CONTACT, USER PROFILE, NEWS PAGE ===================== */

Route::get('/about', function () {
    return view('frontend.contents.about');
})->name('about');
Route::get('/contact',function () {
    return view('frontend.contents.contact');
})->name('contact');

Route::get('/profile', 'Frontend\ProfileController@index')->name('profile.index');
Route::post('/profile/update', 'Frontend\ProfileController@update')->name('profile.update');

Route::get('/news', 'Frontend\NewController@index')->name('news.index');
Route::get('/news/{id}', 'Frontend\NewController@show')->name('news.show');

//route thêm đánh giá
Route::post('/rating/{product_id}','Frontend\RatingController@saveRating')->name('rate');
//route edit đánh giá
Route::post('/rating/edit/{product_id}','Frontend\RatingController@editRating')->name('rate.edit');
//route chức năng load more review
Route::post('/loadmore/{product_id}','Frontend\RatingController@loadmore')->name('loadmore');


/*============== ROUTE FOR SHOPPING CART, CHECKOUT PAGE ===================== */

// Route for add to cart
Route::get('/products/add-to-cart/{id}', 'Frontend\CartController@addToCart')->name('addToCart');
// Route for show cart
Route::get('/products/show-cart', 'Frontend\CartController@showCart')->name('showCart');

// Route for update cart
Route::get('/products/update-cart', 'Frontend\CartController@updateCart')->name('updateCart');

// Route for delete cart
Route::get('/products/delete-cart', 'Frontend\CartController@deleteCart')->name('deleteCart');


// Route for checkout
Route::group(['middleware' => 'auth'], function () {

    Route::get('/checkout', 'Frontend\CheckoutController@index')->name('checkout.index');
    Route::post('/checkout','Frontend\CheckoutController@storeOrder' )->name('checkout.order');

});
// Route for Confirm order
Route::get('/checkout/alert', function () {
   return view('frontend.contents.confirm-order');
});




/*============== ROUTE FOR ADMINISTRATION ===================== */

Route::prefix('admin')->group(function() {
    // Gom nhóm các route cho phần admin

    //Route đăng nhập, đăng ký cho admin


    Route::get('/', 'Backend\DashboardController@index')->name('admin.dashboard');

    // View đăng nhập thành công

    Route::get('/dashboard', 'Backend\DashboardController@index')->name('admin.dashboard');

    Route::get('/register', 'Backend\DashboardController@register');
    Route::get('/login', 'Backend\DashboardController@login');
    Route::get('/logout', 'Backend\DashboardController@logout');

    Route::post('/register', 'Backend\DashboardController@registerAdmin');
    Route::post('/login', 'Backend\DashboardController@loginAdmin');


    //route hiển thị danh sách adminNs
    Route::get('/adminList', 'Backend\ProfileController@adminList')->name('admin.list');
    Route::get('/adminList/profile', 'Backend\ProfileController@index')->name('admin.profile.index');
    Route::post('/adminList/profile', 'Backend\ProfileController@update')->name('admin.profile.update');


    //route hiển thị category
    Route::get('/product_category', 'Backend\CategoryProductController@index');
    Route::get('/product_category/create', 'Backend\CategoryProductController@createpage');
    Route::get('/product_category/edit/{category_id}', 'Backend\CategoryProductController@editpage');
    //route hiển thị product
    Route::get('/product', 'Backend\ProductController@index');
    Route::get('/product/create', 'Backend\ProductController@createpage');
    Route::get('/product/edit/{product_id}', 'Backend\ProductController@editpage');
    //route hiển thị manufacturer
    Route::get('/manufacturer', 'Backend\ManufacturerController@index');
    Route::get('/manufacturer/create', 'Backend\ManufacturerController@createpage');
    Route::get('/manufacturer/edit/{manufacturer_id}', 'Backend\ManufacturerController@editpage');
    //route hiển thị thuộc tính sản phẩm
    Route::get('/attribute', 'Backend\AttributeController@index');
    Route::get('/attribute/create', 'Backend\AttributeController@createpage');
    Route::get('/attribute/edit/{attribute_id}', 'Backend\AttributeController@editpage');
    // route hiển thị bài viết
    Route::get('/news', 'Backend\NewController@index')->name('admin.new.index');
    Route::get('/news/create', 'Backend\NewController@create')->name('admin.new.create');
    Route::get('/news/edit/{new_id}', 'Backend\NewController@edit')->name('admin.new.edit');
    //route thống kê order
    Route::get('/orders', 'Backend\Ordercontroller@index')->name('orders.index');
    //route Detail order
    Route::get('/orders/item/{order_id}', 'Backend\Ordercontroller@detail')->name('orders.detail');
    //route thống kê khách hàng
    Route::get('/customers', function () {
        $order_items = \App\Models\OrderModel::get();

        $user_id = $order_items->map(function ($item) {
           return $item->user_id;
        });
        $customers = \App\User::find($user_id);




        return view('backend.contents.customers.index', compact('customers'));

    })->name('customer.index');

    // Route hiển thị view setting
    Route::get('/settings', 'Backend\SettingController@index')->name('settings.index');
    Route::get('/settings/create', 'Backend\SettingController@create')->name('settings.create');
    Route::get('/settings/edit/{id}', 'Backend\SettingController@edit')->name('settings.edit');

    // Route chức năng setting
    Route::post('/settings/create', 'Backend\SettingController@store')->name('settings.store');
    Route::post('/settings/update/{id}', 'Backend\SettingController@update')->name('settings.update');
    Route::delete('/settings/delete/{id}', 'Backend\SettingController@delete')->name('settings.delete');






    //route chức năng category
    Route::post('/product_category/create', 'Backend\CategoryProductController@create');
    Route::post('/product_category/edit/{category_id}', 'Backend\CategoryProductController@edit');
    Route::delete('/product_category/delete/{category_id}', 'Backend\CategoryProductController@delete');
    //route chức năng product
    Route::post('/product/create', 'Backend\ProductController@create');
    Route::post('/product/edit/{product_id}', 'Backend\ProductController@edit');
    Route::delete('/product/delete/{product_id}', 'Backend\ProductController@delete');
    //route chức năng manufacturer
    Route::post('/manufacturer/create', 'Backend\ManufacturerController@create');
    Route::post('/manufacturer/edit/{manufacturer_id}', 'Backend\ManufacturerController@edit');
    Route::delete('/manufacturer/delete/{manufacturer_id}', 'Backend\ManufacturerController@delete');
    //route chức năng thuộc tính sản phẩm
    Route::post('/attribute/create', 'Backend\AttributeController@create');
    Route::post('/attribute/edit/{attribute_id}', 'Backend\AttributeController@edit');
    Route::delete('/attribute/delete/{attribute_id}', 'Backend\AttributeController@delete');
    //route chức năng đăng tin tức
    Route::post('/news/create', 'Backend\NewController@store')->name('admin.new.store');
    Route::post('/news/edit/{new_id}', 'Backend\NewController@update')->name('admin.new.update');
    Route::delete('/news/delete/{new_id}', 'Backend\NewController@delete')->name('admin.new.delete');

});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');


