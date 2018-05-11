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
| Middleware options can be located in `app/Http/Kernel.php`
|
*/
	Route::get('/home', ['as' => 'public.home',   'uses' => 'UserController@index']);
// Homepage Route\
	Route::group(['middleware' => ['activity',]], function () {
		Route::get ('/', 'WelcomeController@welcome')->name ('welcome');
	});
	
	Route::group(['middleware' => ['activity','auth']], function () {
	Route::get ('/user/{username}', 'WelcomeController@show')->name ('welcome');
	Route::post ('/contactus/{username}', 'ContactUsController@store');
	Route::resource ('contactus', 'ContactUsController');
	Route::resource ('cart', 'CartController');
	Route::delete ('emptyCart', 'CartController@emptyCart');
	Route::post ('switchToWishlist/{id}', 'CartController@switchToWishlist');
	
	Route::resource ('wishlist', 'WishlistController');
	Route::delete ('emptyWishlist', 'WishlistController@emptyWishlist');
	Route::post ('switchToCart/{id}', 'WishlistController@switchToCart');
	});
// Authentication Routes
Auth::routes();

// Handling Stripe Webhooks
	Route::post(
		'stripe/webhook',
		'\Laravel\Cashier\Http\Controllers\WebhookController@handleWebhook'
	);
// Public Routes
Route::group(['middleware' => ['web', 'activity']], function () {
	Route::resource('billing','billingController');
	
	Route::get('/plan/{id}', 'PlanController@show')->name('plan');
	Route::resource('plans', 'PlanController');
	
	Route::group(['prefix' => 'subscribe'], function(){
		
		Route::post('/', 'PlanController@subscribe')->name('subscribe');
		Route::get('/cancel', 'PlanController@confirmCancellation')->name('confirmCancellation');
		Route::post('/cancel', 'PlanController@cancelSubscription')->name('subscriptionCancel');
		Route::post('/resume', 'PlanController@resumeSubscription')->name('subscriptionResume');
		
		Route::get('/invoices', 'InvoiceController@index')->name('invoices');
		Route::get('/invoice/{id}', 'InvoiceController@download')->name('downloadInvoice');
		
	});
	
	
	
    // Activation Routes
    Route::get('/activate', ['as' => 'activate', 'uses' => 'Auth\ActivateController@initial']);

    Route::get('/activate/{token}', ['as' => 'authenticated.activate', 'uses' => 'Auth\ActivateController@activate']);
    Route::get('/activation', ['as' => 'authenticated.activation-resend', 'uses' => 'Auth\ActivateController@resend']);
    Route::get('/exceeded', ['as' => 'exceeded', 'uses' => 'Auth\ActivateController@exceeded']);

    // Socialite Register Routes
    Route::get('/social/redirect/{provider}', ['as' => 'social.redirect', 'uses' => 'Auth\SocialController@getSocialRedirect']);
    Route::get('/social/handle/{provider}', ['as' => 'social.handle', 'uses' => 'Auth\SocialController@getSocialHandle']);

    // Route to for user to reactivate their user deleted account.
    Route::get('/re-activate/{token}', ['as' => 'user.reactivate', 'uses' => 'RestoreUserController@userReActivate']);
});

// Registered and Activated User Routes
Route::group(['middleware' => ['auth', 'activated', 'activity']], function () {

    // Activation Routes
    Route::get('/activation-required', ['uses' => 'Auth\ActivateController@activationRequired'])->name('activation-required');
    Route::get('/logout', ['uses' => 'Auth\LoginController@logout'])->name('logout');
});

// Registered and Activated User Routes
Route::group(['middleware' => ['auth', 'activated', 'activity', 'twostep','level:2']], function () {

    //  Homepage Route - Redirect based on user role is in controller.
  

    // Show users profile - viewable by other users.
    Route::get('profile/{username}', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@show',
    ]);
	
	Route::resource('photos', 'photoController');
	Route::resource('albums', 'albumController',
		[
			'only' => ['edit','update','create','store']
		]
	);
});

// Registered, activated, and is current user routes.
Route::group(['middleware' => ['auth', 'activated', 'currentUser', 'activity', 'twostep','level:3']], function () {
	//after subscribing return to profile
	Route::get('profile/{username}', 'ProfilesController@show')->name('profile');
	
	//blogs
	Route::resource('blogs', 'BlogsController');
    // User Profile and Account Routes
	
	
    Route::resource(
        'profile',
        'ProfilesController', [
            'only' => [
                'show',
                'edit',
                'update',
                'create',
            ],
        ]
    );
    Route::put('profile/{username}/updateUserAccount', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@updateUserAccount',
    ]);
    Route::put('profile/{username}/updateUserPassword', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@updateUserPassword',
    ]);
    Route::delete('profile/{username}/deleteUserAccount', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@deleteUserAccount',
    ]);

    // Route to show user avatar
    Route::get('images/profile/{id}/avatar/{image}', [
        'uses' => 'ProfilesController@userProfileAvatar',
    ]);

    // Route to upload user avatar.
    Route::post('avatar/upload', ['as' => 'avatar.upload', 'uses' => 'ProfilesController@upload']);
});

// Registered, activated, and is admin routes.
Route::group(['middleware' => ['auth', 'activated', 'role:admin', 'activity', 'twostep']], function () {
    Route::resource('/users/deleted', 'SoftDeletesController', [
        'only' => [
            'index', 'show', 'update', 'destroy',
        ],
    ]);

    Route::resource('users', 'UsersManagementController', [
        'names' => [
            'index'   => 'users',
            'destroy' => 'user.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);
    Route::post('search-users', 'UsersManagementController@search')->name('search-users');

    Route::resource('themes', 'ThemesManagementController', [
        'names' => [
            'index'   => 'themes',
            'destroy' => 'themes.destroy',
        ],
    ]);

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    Route::get('routes', 'AdminDetailsController@listRoutes');
    Route::get('active-users', 'AdminDetailsController@activeUsers');
});

//Routes that need not authentication
	Route::group(['middleware' => ['auth','activity']], function () {
		Route::get('albums/{id}', 'albumController@show');
		Route::get('albums', 'albumController@index');
	});
	


Route::redirect('/php', '/phpinfo', 301);
