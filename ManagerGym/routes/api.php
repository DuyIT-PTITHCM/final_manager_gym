<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::apiResource('typemachine','Api\TypeMachineController')->middleware('auth:api');
Route::apiResource('partner','Api\PartnerController')->middleware('auth:api');
Route::post('login','Api\LoginController@Login');

Route::post('register','Api\Register@Register')->middleware('auth:api');
Route::apiResource('user','Api\UserController')->middleware('auth:api','uservalidater');

Route::post('change-password','Api\UserController@changePassword')->middleware('auth:api');

Route::apiResource('department','Api\DepartmentController')->middleware('auth:api','uservalidater');
Route::apiResource('device','Api\DeviceController')->middleware('auth:api');
Route::apiResource('devicepartner','Api\PartnerDeviceController')->middleware('auth:api');
//chuc nang 1
Route::apiResource('status','Api\StatusControler')->middleware('auth:api');

Route::get('allstatus','Api\StatusControler@getAllStatus')->middleware('auth:api');

Route::get('statistical','Api\Statistical@statisticalNowBuy')->middleware('auth:api');
Route::get('statisticalsalesmonth','Api\Statistical@statisticalNowSales')->middleware('auth:api');

Route::get('statisticalbuyyear','Api\Statistical@statisticalNowYearBuy')->middleware('auth:api');
Route::get('statisticalsalesyear','Api\Statistical@statisticalNowYearSales')->middleware('auth:api');

Route::get('statisticalservicemonth/{id}','Api\ServiceController@statisticalService')->middleware('auth:api');
Route::get('statisticalserviceyear/{id}','Api\ServiceController@statisticalServiceYear')->middleware('auth:api');
Route::post('detailservice','Api\ServiceController@detailService')->middleware('auth:api');

Route::apiResource('supplier','Api\SupplierController')->middleware('auth:api');
Route::apiResource('sales','Api\PurchasingController')->middleware('auth:api');

Route::apiResource('handleservice','Api\ServiceHandle')->middleware('auth:api');


Route::apiResource('upload','Api\UploadImageController')->middleware('auth:api');

Route::apiResource('role','Api\RoleController')->middleware('auth:api');


Route::get('alltype','Api\TypeMachineController@getAll')->middleware('auth:api');

Route::get('alldepartment','Api\DepartmentController@getAll')->middleware('auth:api');

Route::get('allsupplier','Api\SupplierController@getAll')->middleware('auth:api');

Route::get('alluser','Api\UserController@getAll')->middleware('auth:api');

Route::get('countdevice','Api\DeviceController@countAll')->middleware('auth:api');

Route::get('allservice','Api\ServiceHandle@getAll')->middleware('auth:api');

Route::get('deviceall','Api\DeviceController@getAll')->middleware('auth:api');

Route::get('partnerall','Api\PartnerController@getAll')->middleware('auth:api');

Route::get('allpur','Api\PurchasingController@getAll')->middleware('auth:api');

Route::get('userlogin','Api\ClientController@getUserLogin')->middleware('auth:api');
Route::get('huhu','Api\ClientController@getDataDevice')->middleware('auth:api');

Route::put('clientupdate/{id}','Api\ClientController@update')->middleware('auth:api');
