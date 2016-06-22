<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function(){
    return redirect('app/#');
});




Route::get('home', 'HomeController@index');

//get request
Route::get('api/getAllTable', 'DBcontroller@getAlltable');
Route::get('api/getCustomerByTableId/{tableid}', 'DBController@match');
Route::get('api/getAllfoodType/', 'DBController@allfoodType');
Route::get('api/getfoodByTypeId/{typeid}', 'DBController@getfoodByTypeId');

//about customer
Route::get('api/addCustomerByTableid/{tableid}', 'DBController@addCustomerByTableid');
Route::delete('api/deleteCustomerByCustomerId/{customerid}', 'DBController@deleteCustomerByCustomerId');
Route::get('api/getOrderbyCustomerId/{customer_id}', 'DBController@getOrderbyCustomerId');
//about food
Route::get('api/getFoodByOrderId/{customer_id}', 'DBController@getFoodByOrderId');
Route::get('api/newOrder/{customer_id}', 'DBController@newOrder');
Route::get('api/addFoodToOrder/{dish_id}/{order_id}', 'DBController@addFoodToOrder');
Route::delete('api/removeFoodByOrderId/{dish_id}/{order_id}', 'DBController@removeFoodByOrderId');
Route::post('api/updateServeByStatusId/{status_id}', 'DBController@updateServeByStatusId');

//updateServeByStatusId

//about order
Route::delete('api/removeFoodByDishstatusId/{dishstatus_id}', 'DBController@removeFoodByDishstatusId');
Route::delete('api/removeOrderByOrderId/{order_id}', 'DBController@removeOrderByOrderId');

//about bill
Route::get('api/getBillByCustomerId/{customer_id}', 'DBController@getBillByCustomerId');
Route::get('api/getBillByTableId/{table_id}', 'DBController@getBillByTableId');
