<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get("EmployeeList","App\Http\Controllers\EmployeeController@index")->name("EmployeeList");
Route::get("Employee/create","App\Http\Controllers\EmployeeController@create");
Route::get("Employee/{id}/edit","App\Http\Controllers\EmployeeController@edit");
Route::get("Employee/{id}/view","App\Http\Controllers\EmployeeController@view");
Route::post("Employee","App\Http\Controllers\EmployeeController@insert");
Route::post("Employee/{id}","App\Http\Controllers\EmployeeController@update");
Route::post("deleteEmployee","App\Http\Controllers\EmployeeController@delete");
