<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use App\Helpers\RouteHelper;

/* Frontend page routes. */
Route::group([
    'middlewareGroups' => RouteHelper::getGeneralMiddlewareGroups(),
    'middleware' => RouteHelper::getGeneralMiddleware(),
    'prefix' => RouteHelper::getBlogMain(),
], function () {

    /* Fully-installed and configured routes. */
    Route::get('/', 'Frontend\BlogController@index')->name('canvas.home');
    Route::get('/feed', 'Frontend\BlogController@feed')->name('canvas.feed');
    Route::get('/sitemap.xml', 'Frontend\BlogController@sitemap')->name('canvas.sitemap');

    Route::group(['prefix' => RouteHelper::getBlogPrefix()], function () {
        Route::get('/', 'Frontend\BlogController@index')->name('canvas.blog.post.index');
        Route::get('post/{slug}', 'Frontend\BlogController@showPost')->name('canvas.blog.post.show');
    });

    Route::get('/techs', 'Frontend\BlogController@index')->name('techs.home');

});
