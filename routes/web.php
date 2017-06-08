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

/* ###RUTAS REUTILIZABLES
Route::get('quienessomos', 'FrontController@QuienesSomos');
Route::get('/', 'HomeController@index');
Route::get('test', function(){
    return response()->json(['test'=>'test']);
});
Route::resource('posts', 'PostController');
Route::resource('multimedia', 'MultimediaController');
Route::resource('churches', 'ChurchController');
*/

//Route::group(['middleware'=>'httpsprotocol'], function(){
    //Route::post('login', ['uses'=>'AuthController@login','https'=>true]);
//Route::auth();
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
/* ###RUTAS REUTILIZABLES
Route::resource('admins', 'AdminController');

#Admin user routes
Route::get('users/all', 'UserController@all');
Route::get('users/all/{id}/edit', 'UserController@allEdit');


Route::resource('users', 'UserController');
Route::resource('moderators', 'ModeratorController');

//Route::resource('comments', 'CommentController');
Route::resource('posts.comments', 'CommentController');
Route::resource('multimedia.comments', 'MultimediaCommentController');
*/
/*
Route::resource('roles', 'RoleController');
Route::resource('galleries', 'GalleryController');
*/

/* ###RUTAS REUTILIZABLES
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
*/

Auth::routes();
/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::resource('/', 'FrontController');
Route::get('/home', 'HomeController@index')->name('home');
#Admin user routes
Route::get('users/all', 'UserController@all');
Route::get('users/all/{id}/edit', 'UserController@allEdit');
Route::resource('/users','UserController');
Route::resource('/posts','PostController');
Route::resource('/posts.comments','PostCommentController');
Route::resource('/multimedia','MultimediaController');
Route::resource('/multimedia.comments','MultimediaCommentController');


####################################


#Rutas Migracion Francisco

#Route::resource('/', 'PaginaController');
Route::resource('byformat', 'MazosController@index');
Route::resource('listadomazos', 'MazosController@backendIndex');
Route::resource('mazos', 'DeckController');
Route::resource('jugadores', 'PlayerController');
Route::resource('formatos', 'FormatosController');
Route::resource('eventos', 'EventController');
/*
Route::get('participantes/{id}', [
    'as'=>'participantes',
    'uses'=>'EventosMazosController@participaEvento'
]);
 */
Route::get('participantes/scoreparticipantes/{id}', 'EventosMazosController@createbyget');
Route::get('participantes/editscoreparticipantes/{id}', 'EventosMazosController@editbyget');
Route::resource('participantes', 'DeckEventController');
Route::resource('getjugadoresbydci', 'JugadoresController@getjugadoresbydci');
#Route::auth();
#Route::get('/home', 'HomeController@index');
Route::resource('lista', 'ListController');
Route::resource('getcartasbyid', 'CardController@getcartasbyid');

Route::get('formato/{id}', 'FrontController@getFormato');
//Route::resource('index', 'PaginaController');
