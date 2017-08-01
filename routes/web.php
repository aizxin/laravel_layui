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
// Route::auth();
Route::get('/', 'HomeController@index');

Route::get('/login','Auth\LoginController@showLoginForm');

Route::group(['namespace' => 'Admin'],function ($router)
{
	Route::post('/login','AuthController@postLogin');
	Route::get('/logout','AuthController@logout');
	// icon
	Route::get('/icon','IconController@index');
	// 七牛
	Route::resource('qiniu','QiniuController');
	// 已经登录
    Route::group(['middleware' => ['admin.auth','role.auth']], function () {

	    Route::get('admin', 'AdminController@index')->name('admin.index');
	    // 管理员
	    Route::post('user/index', 'UserController@index')->name('user.index');
	    Route::post('user/role', 'UserController@role')->name('user.role');
	    Route::resource('user', 'UserController');
	    // 权限
	    Route::post('permission/index','PermissionController@index')->name('permission.index');
	    Route::resource('permission','PermissionController');
	    // 角色
	    Route::post('role/index','RoleController@index')->name('role.index');
	    Route::post('role/permission','RoleController@permission')->name('role.permission');
	    Route::resource('role','RoleController');
	    // 文章
	    Route::group(['prefix' => 'article','as'=>'article.'],function (){
	    	Route::resource('category','ArticleCategoryController');
	    });
	    Route::post('article/switch','ArticleController@changeSwitch')->name('article.switch');
	    Route::post('article/index','ArticleController@index')->name('article.index');
	    Route::resource('article','ArticleController');
    });
});
