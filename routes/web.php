<?php

Route::get('/set_language/{lang}','Controller@setLanguage')->name('set_language');

Route::get('login/{driver}', 'Auth\LoginController@redirectToProvider')->name('social_auth');
Route::get('login/{driver}/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::group(['prefix' => 'courses'], function(){
    Route::group(['middleware'=>['auth']],function(){
        Route::get('/subscribed', 'CourseController@subscribed')
            ->name('courses.subscribed');
        Route::get('/{course}/inscribe', 'CourseController@inscribe')
            ->name('courses.inscribe');
        Route::post('/add_review', 'CourseController@addReview')
        ->name('courses.add_review');
    });
    Route::get('/{course}', 'CourseController@show')->name('courses.detail');
});

Route::group(['middleware' => ['auth']], function(){
    Route::group(['prefix' => 'subscriptions'], function () {
        Route::get('/plans', 'SubscriptionController@plans')
            ->name('subscriptions.plans');
        Route::get('/admin', 'SubscriptionController@admin')
            ->name('subscriptions.admin');
        Route::post('/process_subscriptions', 'SubscriptionController@processSubscription')
            ->name('subscriptions.process_subscription');

        Route::post('/resume', 'SubscriptionController@resume')
            ->name('subscriptions.resume');
        Route::post('/cancel', 'SubscriptionController@cancel')
            ->name('subscriptions.cancel');
    });

    Route::group(['prefix' => 'invoices'], function(){
        Route::get('/admin', 'InvoiceController@admin')->name('invoices.admin');
        Route::get('/{invoice}/download', 'InvoiceController@download')->name('invoices.download');
    });

    // Ruta para devolver la ruta para las imagenes del storage
    Route::get('/images/{path}/{attachment}', function ($path, $attachment) {
        $file = sprintf('storage/%s/%s', $path, $attachment);
        if (File::exists($file)) {
            return Image::make($file)->response();
        }
    });
});
