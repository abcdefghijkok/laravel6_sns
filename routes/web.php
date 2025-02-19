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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
Route::prefix('login')->name('login.')->group(function () {
    Route::get('/{provider}', 'Auth\LoginController@redirectToProvider')->name('{provider}');
    Route::get('/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('{provider}.callback');
});
Route::prefix('register')->name('register.')->group(function () {
    Route::get('/{provider}', 'Auth\RegisterController@showProviderUserRegistrationForm')->name('{provider}');
    Route::post('/{provider}', 'Auth\RegisterController@registerProviderUser')->name('{provider}');
});
// Route::prefix('login')->name('login.')->group(function () {
//     Route::get('/{provider}', 'Auth\LoginController@redirectToProvider')->name('{provider}');
//     Route::get('/{provider}/callback', function ($provider) {
//         dd('Callback route hit!', $provider);
//     })->name('{provider}.callback');
// });



Route::get('/', 'ArticleController@index')->name('articles.index');
Route::resource('/articles', 'ArticleController')->except(['index', 'show'])->middleware('auth');
// authミドルウェアは、リクエストをコントローラーで処理する前にユーザーがログイン済みであるかどうかをチェックし、
// ログインしていなければユーザーをログイン画面へリダイレクトします。
// 既にログイン済みであれば、コントローラーでの処理が行われます。
Route::resource('/articles', 'ArticleController')->only(['show']);
// resourceメソッドに、onlyメソッドを繋げるとそのアクションのみを指定することができます。
// ここでは、リソースルートにonlyメソッドとexceptメソッドを使い分けて、showアクションメソッドに対してauthミドルウェアを使わないようにしています

// Route::resource('/articles', 'ArticleController')->only(['index', 'show'])->middleware('auth');

Route::prefix('articles')->name('articles.')->group(function () {
    Route::put('/{article}/like', 'ArticleController@like')->name('like')->middleware('auth');
    Route::delete('/{article}/like', 'ArticleController@unlike')->name('unlike')->middleware('auth');
});

Route::get('/tags/{name}', 'TagController@show')->name('tags.show');

Route::prefix('users')->name('users.')->group(function () {
    Route::get('/{name}', 'UserController@show')->name('show');
    Route::get('/{name}/likes', 'UserController@likes')->name('likes');
    Route::get('/{name}/followings', 'UserController@followings')->name('followings');
    Route::get('/{name}/followers', 'UserController@followers')->name('followers');
    Route::middleware('auth')->group(function () {
        Route::put('/{name}/follow', 'UserController@follow')->name('follow');
        Route::delete('/{name}/follow', 'UserController@unfollow')->name('unfollow');
    });
});