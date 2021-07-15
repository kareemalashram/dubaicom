<?php





Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){

    Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function() {


        Route::get('/home','DashboardController@home')->name('dashboard');




        //categoery route

        Route::resource('categories','CategoryController')->except(['show']);


        //products route

        Route::resource('products','ProductController')->except(['show']);



        //clients route

        Route::resource('clients','ClientController')->except(['show']);
        Route::resource('clients.orders','Client\OrderController')->except(['show']);



        Route::resource('orders','OrderController');
        Route::get('/orders/{order}/products','OrderController@products')->name('orders.products');

        //user route

        Route::resource('users','UserController')->except(['show']);



    });

});





