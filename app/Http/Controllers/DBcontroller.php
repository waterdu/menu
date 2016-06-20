<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;

class DBController extends Controller {
	public function menusystem() {
		// DB 指的是连接ENV里面的指定数据库
		// 后边接着写SQL里面跑出来的代码
		$user = DB::select('SELECT * FROM app.orders;');
		return response() -> json($user);
	}
	// get entire information about customers and their orders
	// from the order system
	public function getentire() {
		$table = DB::select('select distinct c.customer_id as customer,
       o.order_id as order_id,
        d.dish_id as dish_id,
        di.dish_name as dish_name,
       ch.chef_name as chef
       from customer c, single_order o, dining_table dt, dish_status d, chef ch, dish di
       where c.table_id = dt.table_id and o.order_id = d.order_id and
       di.dish_id = d.dish_id and ch.food_type = di.food_type and
       o.customer_id = c.customer_id;');
		return response() -> json($table);
	}


	public function getAlltable() {
		$alltable = DB::select('SELECT * FROM menu.dining_table');
		return response() -> json($alltable);
	}
	// to return the id of customers who sit on the table with the given table id
	public function match($tableid) {
		$str = 'select c.customer_id from customer c where c.table_id = ' . $tableid . ';';
		$allid = DB::select($str);
		return response() -> json($allid);
	}
	public function orderbyid($customerid) {
		$command =
		'select d.dish_name, d.price from dish d,
		(select dish_id from dish_status ds where ds.order_id =
		(select o.order_id from single_order o where o.customer_id =' . $customerid . ')) as group2
		where d.dish_id = group2.dish_id;' ;
		$allOrder = DB::select($command);
		return response() ->json($allOrder);
	}
	public function allfoodType() {
		$command = 'select * from menu.food_type';
		$allFoodType = DB::select($command);
		return response() -> json($allFoodType);
	}
	public function allTypedFood($typeid) {
		$command = 'select d.dish_name, d.price, d.isProvided from dish d where d.food_type = ' . $typeid;
		$allinType = DB::select($command);
		return response() -> json($allinType);
	}

	public function addCustomerByTableid($tableid) {
		$newCustomer = DB::insert('insert into customer (table_id) values (?)', [$tableid]);
		return response() -> json($newCustomer);
	}


}
