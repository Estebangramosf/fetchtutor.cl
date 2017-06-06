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
/*
Route::get('/', function () {
    return view('welcome');
});
*/


//URL::forceSchema("https");
Route::get('quienessomos', 'FrontController@QuienesSomos');
Route::get('/', 'HomeController@index');
Route::get('test', function(){
    return response()->json(['test'=>'test']);
});
Route::resource('posts', 'PostController');
Route::resource('multimedia', 'MultimediaController');
Route::resource('churches', 'ChurchController');

//Route::group(['middleware'=>'httpsprotocol'], function(){
    //Route::post('login', ['uses'=>'AuthController@login','https'=>true]);
    Route::auth();
//});

//Route::get('test', 'HomeController@test');
/*
Route::get('vue', function () {
    return view('users.vue');
});
Route::get('vue2', function () {
    return view('users.vue2');
});
Route::get('vue3', function () {
    return view('users.vue3');
});
*/
//Route::get('dashboard', 'UserController@dashboard');

Route::resource('admins', 'AdminController');

#Admin user routes
Route::get('users/all', 'UserController@all');
Route::get('users/all/{id}/edit', 'UserController@allEdit');


Route::resource('users', 'UserController');
Route::resource('moderators', 'ModeratorController');

//Route::resource('comments', 'CommentController');
Route::resource('posts.comments', 'CommentController');
Route::resource('multimedia.comments', 'MultimediaCommentController');

/*
Route::resource('roles', 'RoleController');
Route::resource('galleries', 'GalleryController');
*/

Route::group(['middleware' => 'auth'], function () {
    //Route::get('/', function ()    {
        // Uses Auth Middleware
        //return view('welcome');
    //});

    //Route::get('dashboard', 'UserController@dashboard');

    Route::get('profile', 'UserController@profile');//aqui tiene que tomar el id de Auth -> la sesión
    Route::get('user/profile', function () {
        // Uses Auth Middleware
    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
