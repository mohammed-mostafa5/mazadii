<?php

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

Route::get('/', function () {
    return view('welcome');
});



Auth::routes(['verify' => true]);


/*
|--------------------------------------------------------------------------
| Builder Generator Routes
|--------------------------------------------------------------------------
*/

Route::get('/home', 'HomeController@index')->middleware('verified');

Route::get('generator_builder', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@builder')->name('io_generator_builder');

Route::get('field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate')->name('io_field_template');

Route::get('relation_field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@relationFieldTemplate')->name('io_relation_field_template');

Route::post('generator_builder/generate', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generate')->name('io_generator_builder_generate');

Route::post('generator_builder/rollback', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@rollback')->name('io_generator_builder_rollback');

Route::post(
    'generator_builder/generate-from-file',
    '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generateFromFile'
)->name('io_generator_builder_generate_from_file');



///////////////////////////////////////////////////////////////////////////
///								end builder routes 						///
///////////////////////////////////////////////////////////////////////////



/*
|--------------------------------------------------------------------------
| Admin Panel Routes
|--------------------------------------------------------------------------
*/

Route::get('logout', 'AuthController@logout')->name('logout');

Route::group(['prefix' => 'adminPanel', 'namespace' => 'AdminPanel', 'as' => 'adminPanel.'], function () {
    Route::get('logout', 'AuthController@logout')->name('logout');

    Route::get('/login', 'AuthController@login')->name('login');
    Route::post('/postLogin', 'AuthController@postLogin')->name('postLogin');


    Route::group(['middleware' => ['auth:admin', 'permissionHandler']], function () {

        Route::get('/', 'DashboardController@dashboard')->name('dashboard');

        // Roles CRUD
        Route::resource('roles', 'RolesController');
        Route::get('updatePermissions', 'RolesController@updatePermissions')->name('roles.updatePermissions');

        // Admins CRUD
        Route::resource('admins', 'AdminController');

        //Metas CRUD
        Route::resource('metas', 'MetaController');


        // Pages CRUD
        Route::resource('pages', 'PageController');
        Route::resource('pages.paragraphs', 'ParagraphController')->shallow();
        Route::resource('pages.images', 'imagesController')->shallow();
        Route::resource('socialLinks', 'SocialLinkController');

        // CkEditor Upload Image By Ajax
        Route::post('ckeditor/upload', 'CkeditorController@upload')->name('ckeditor.upload');

        // User CURD
        Route::resource('users', 'UserController')->only(['index', 'show', 'update']);

        // Informations CURD
        Route::resource('information', 'InformationController');

        // Slider CURD
        Route::resource('sliders', 'sliderController');

        // Contact Us CURD
        Route::resource('contacts', 'ContactController');

        // Newsletter CURD
        Route::resource('newsletters', 'NewsletterController');

        // Categories CURD
        Route::resource('categories', 'CategoryController');

        // Product CURD
        Route::resource('products', 'ProductController');

        Route::delete('photo/{image}', 'ProductController@destroyImage')->name('products.destroyImage');


        Route::resource('countries', 'CountryController');
        Route::resource('countries.cities', 'CityController')->shallow();
        Route::resource('cities.areas', 'AreaController')->shallow();

        // Packages
        Route::resource('packages', 'PackageController');
        Route::resource('features', 'FeatureController');

        //Settings
        Route::get('customSettings', 'CustomSettingController@settings')->name('customSettings.show');
        Route::patch('customSettings/{id}', 'CustomSettingController@update')->name('customSettings.update');
    });
});

///////////////////////////////////////////////////////////////////////////
///								end admin panel routes 					///
///////////////////////////////////////////////////////////////////////////

/*
|--------------------------------------------------------------------------
| Users Panel Routes
|--------------------------------------------------------------------------
*/


Route::group(['prefix' => 'usersPanel', 'namespace' => 'UsersPanel', 'as' => 'usersPanel.'], function () {


    Route::get('packages', 'PackageController@packages')->name('packages');


    Route::group(['middleware' => ['auth:web']], function () {

        Route::get('/approval', 'AuthController@approval')->name('approval');

        Route::get('logout', 'AuthController@logout')->name('logout');

        Route::middleware(['approved'])->group(function () {
            Route::get('resendCodeToUser', 'AuthController@resendCodeToUser')->name('resendCodeToUser');

            Route::resource('pets', 'PetController');

            ////// Dashboard //////
            Route::get('dashboard', 'MainController@dashboard')->name('dashboard');
            Route::get('profile', 'MainController@profile')->name('profile');
            Route::get('setting', 'MainController@setting')->name('setting');
            Route::patch('setting', 'MainController@update')->name('update');
            // personal-information
            Route::get('personal-information', 'MainController@personalInformation')->name('personalInformation');
            Route::patch('personal-information', 'MainController@updatePersonalInformation')->name('updatePersonalInformation');
            // change-email
            Route::get('change-email', 'MainController@changeEmail')->name('changeEmail');
            Route::patch('change-email', 'MainController@updateEmail')->name('updateEmail');
            // change-password
            Route::get('change-password', 'MainController@changePassword')->name('changePassword');
            Route::patch('change-password', 'MainController@updatePassword')->name('updatePassword');


            ////// Wishlist //////
            Route::get('wishlist/{id}', 'WishlistController@addToWishlistOrRemoveProduct')->name('addToWishlist');
            Route::get('wishlist', 'WishlistController@wishlist')->name('wishlist');
            Route::get('wishlist/remove/{id}', 'WishlistController@removeProductWishlist')->name('removeProductWishlist');


            ////// Cart //////
            Route::get('cart', 'CartController@cart')->name('cart');
            Route::get('cart/{id}', 'CartController@addOrRemove')->name('cart.addOrRemove');
            Route::get('cart/quantity/{cart}', 'CartController@updateQuantity')->name('quantityUpdate');


            ////// Order //////
            Route::get('checkout', 'InvoiceController@checkout')->name('checkout');
            Route::get('coupon-validation', 'InvoiceController@couponValidation')->name('couponValidation');
            Route::post('order', 'InvoiceController@order')->name('orders.order');

            Route::get('orders', 'InvoiceController@invoices')->name('invoices');
            Route::get('orders/{id}', 'InvoiceController@invoice')->name('invoice');
        });


        Route::group(['middleware' => ['verified']], function () {
            // Route::get('dashboard', 'MainController@dashboard')->name('dashboard');

        });
    });
});

///////////////////////////////////////////////////////////////////////////
///								end Users Panel routes 				///
///////////////////////////////////////////////////////////////////////////



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





/*
|--------------------------------------------------------------------------
| WebSite Routes
|--------------------------------------------------------------------------
*/

Route::group(['namespace' => 'Website', 'as' => 'website.'], function () {

    // Route::get('/', 'MainController@coming_soon');
    Route::get('/', 'MainController@home')->name('home');
    Route::get('who-we-are', 'MainController@about')->name('about');
    Route::get('contact',  'MainController@contact')->name('contact');
    Route::post('contact',  'MainController@contactPost')->name('contact.post');
    Route::post('newslettre',  'MainController@newslettrePost')->name('newslettre.post');
    Route::get('terms-and-conditions',  'MainController@termsAndConditions')->name('terms-and-conditions');
    Route::get('privacy-policy',  'MainController@privacyPolicy')->name('privacy-policy');
    Route::get('/blogs',  'MainController@blogs')->name('blogs');
    Route::get('/blog/{id}',  'MainController@blog')->name('blog');

    //Shop
    Route::get('shop',  'ShopController@products')->name('shop.products');
    Route::get('offers',  'ShopController@offers')->name('shop.offers');
    Route::get('/category/{id}',  'ShopController@category')->name('shop.category');
    Route::get('/product/{id}',  'ShopController@product')->name('shop.product');
    Route::post('reviewProduct/{id}', 'ShopController@reviewProduct')->name('shop.reviewProduct');

    Route::get('/syndicate-news',  'MainController@syndicateNews')->name('syndicate-news');
    Route::get('/syndicate-news/{id}',  'MainController@syndicateNewsOne')->name('syndicate-news-one');
    // Route::get('/blogs',  'MainController@blogs')->name('blogs');
    // Route::get('/blog/{id}',  'MainController@blog')->name('blog');
    Route::get('/how-it-works',  'MainController@how')->name('how-it-works');

    Route::get('/search',  'SearchController@search')->name('search');
});

Route::group(['middleware' => ['guest']], function () {

    Route::get('login', 'AuthController@login')->name('login');
    Route::post('postLogin', 'AuthController@postLogin')->name('postLogin');

    Route::get('register', 'AuthController@registerForm')->name('registerForm');
    Route::post('postRegister', 'AuthController@postRegister')->name('postRegister');
});


///////////////////////////////////////////////////////////////////////////
///								end website routes  					///
///////////////////////////////////////////////////////////////////////////
