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
Route::get('api/getOrderbyCustomerId/{customerid}', 'DBController@orderbyid');
Route::get('api/getAllfoodType/', 'DBController@allfoodType');

Route::get('api/getfoodByTypeId/{typeid}', 'DBController@allTypedFood');
Route::get('api/addCustomerByTableid/{tableid}', 'DBController@addCustomerByTableid');


//Route::get('api/insertFood/{orderid}/{foodid}', 'DBController@addFoodInCurrentOrder');


//Route::get('api/addNewOrder/{customerid}', 'DBController@addNewOrder');

//Route::get('api/deleteFood/{dishname}', 'DBController@deleteFoodInCurrentOrder');

// to add food in the current order according to the given food id
//Route::get('api/insertFood/{orderid}/{foodid}', 'DBController@addFoodInCurrentOrder'); //--------

// to create a new order for the customer of the given id
//Route::get('api/addNewOrder/{customerid}', 'DBController@addNewOrder'); // --------

// to add customer to the table according to the given table id
//Route::get('api/addCustomerByTableid/{tableid}', 'DBController@addNewCustomerInTable'); // --------

//to delete the customer whose id is the given customer id
//Route::get('api/deleteCustomerByCustomerId/{customerid}', 'DBController@deleteCustomerByCID');

// to delete the dish from the order according to the given dish name
//Route::get('api/deleteFood/{orderid}/{dishname}', 'DBController@deleteFoodInCurrentOrder');

//----------------------------------
//return the total amount of money that the customer with the given id will pay
//Route::get('api/getBillByCustomerID/{customerid}', 'DBController@whose_bill');

// to return the total bill in the table of the given table id
//Route::get('api/getBillByTableID/{tableid}', 'DBController@table_bill');

// to return the food in the order according to the order id
//Route::get('api/getFoodByOrderId/{Orderid}', 'DBController@allFoodInOrder');

