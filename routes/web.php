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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*** ---- todoList  --- ***/
Route::group(["as" => "todos.", "prefix" => "todo", "middleware" => "auth",], function () {

    Route::get(
        "/",
        [
            "as" => "index",
            "uses" => "TodoController@index"
        ]
    );

    Route::get(
        "/create",
        [
            "as" => "create",
            "uses" => "TodoController@create"
        ]
    );
    Route::post(
        "/store",
        [
            "as" => "store",
            "uses" => "TodoController@store"
        ]
    );


    Route::post(
        "/update",
        [
            "as" => "update",
            "uses" => "TodoController@update"
        ]
    );

    Route::post(
        "/chekoff",
        [
            "as" => "chekoff",
            "uses" => "TodoController@chekoff"
        ]
    );


    Route::delete(
        "/delete/{id}",
        [
            "as" => "delete",
            "uses" => "TodoController@destroy"
        ]
    );
});
/*** ---- End Todolist  --- ***/

