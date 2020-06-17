<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'TeachersController@index');




// Route::get('teachers', 'TeachersController@index');


// Route::get('/teachers/create', 'TeachersController@create');

// Route::post('/teachers/store', 'TeachersController@store');

// Route::get('/teachers/show', 'TeachersController@show');

Route::resource('teachers','TeachersController');



Route::resource('classes','ClassesController');



Route::get('/teachers', ['uses' => 'TeachersController@index', 'as' => 'teachers']);

// Route::get('/teachers/assignClass/{id}', 'TeachersController@assignClass');
Route::get('teachers/assignClass/{teacher}', [
    'as' => 'assignClass', 'uses' => 'TeachersController@assignClass'
]);

Route::post('assignClasses','TeachersController@assignClasses');

Route::get('/classes', ['uses' => 'ClassesController@index', 'as' => 'classes']);


Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', [ 'uses'=>'TeachersController@index', 'as' => 'home'] );


//Attandance
Route::get('attandance','AttandanceController@index');

//Attandance
// Route::get('','AttandanceController@getTeacherAttandance');
Route::get('attandance/getTeacherAttandance/{teacher}', [
    'as' => 'attandance', 'uses' => 'AttandanceController@getTeacherAttandance'
]);

//marke attandance
Route::post('attandance', 'AttandanceController@markeAttandance')->name('makreattandance.post');

//marke attandance
Route::post('operations', 'OperationsController@delete')->name('operationsdelete.post');

Route::post('teachers', 'TeachersController@store')->name('teacherstore.post');


