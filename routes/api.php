<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'v1'], function()
{
    Route::group(['prefix' => '', 'namespace' => 'Api\V1'], function () {

        // Endpoint Classroom
        Route::get('classroom', 'ClassRoomController@index');
        Route::post('classroom', 'ClassRoomController@store');
        Route::patch('classroom/{id}', 'ClassRoomController@update');
        Route::delete('classroom/{id}', 'ClassRoomController@delete');

        // Endpoint Major
        Route::get('major', 'MajorController@index');
        Route::post('major', 'MajorController@store');
        Route::patch('major/{id}', 'MajorController@update');
        Route::delete('major/{id}', 'MajorController@delete');

        // Endpoint Student
        Route::get('student', 'StudentController@index');
        Route::post('student', 'StudentController@store');
        Route::patch('student/{id}', 'StudentController@update');
        Route::delete('student/{id}', 'StudentController@delete');

        // Endpoint Teacher
        Route::get('teacher', 'TeacherController@index');
        Route::post('teacher', 'TeacherController@store');
        Route::patch('teacher/{id}', 'TeacherController@update');
        Route::delete('teacher/{id}', 'TeacherController@delete');

    });
});
