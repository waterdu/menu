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
		$alltable = DB::select('SELECT t.table_id, t.table_size, t.isAvailable, count(c.table_id) as
        								customer_number from dining_table t left join customer c on t.table_id = c.table_id group by table_id;');
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
	public function getfoodByTypeId($typeid) {
		$command = 'select * from dish d where d.food_type = ' . $typeid;
		$allinType = DB::select($command);
		return response() -> json($allinType);
	}



//about customer
	public function addCustomerByTableid($tableid) {
		$newCustomer = DB::insert('insert into customer (table_id) values (?)', [$tableid]);
		return response() -> json($newCustomer);
	}
	public function deleteCustomerByCustomerId($customerid) {
    		$command = DB::delete('delete from customer where customer_id = ' . $customerid . ';');
    		return response() -> json($command);
    }
	public function getOrderbyCustomerId($customerid) {
    		$command = DB::select('select so.order_id from single_order so where so.customer_id = ' . $customerid . ';');
    		return response() -> json($command);
    }
//about food
	public function getFoodByOrderId($orderid) {
		$command = DB::select('select d.dish_id, sec2.status_id, d.dish_name, d.price, hasServed from dish d, (select dish_id, id as status_id, hasServed from dish_status where dish_status.order_id =' . $orderid .') as sec2 where sec2.dish_id = d.dish_id;');
        return response() -> json($command);
	}
	public function newOrder($customerid) {
    		$hasPlaced = false;
    		$hasAllServed = false;
    		$place = DB::insert('insert into single_order (customer_id, hasPlaced, hasAllServed) values (?, ?, ?)', [$customerid, $hasPlaced, $hasAllServed]);
    		return response() -> json($place);
    }
    public function removeOrderByOrderId($orderid){
	$command = DB::delete('delete from single_order where order_id = ' . $orderid . ';');
    		return response() -> json($command);
    }

	public function addFoodToOrder($dish_id,$order_id) {
    		$hasServed = false;
    		$place = DB::insert('insert into dish_status (dish_id, order_id, hasServed) values (?, ?, ?)', [$dish_id, $order_id, $hasServed]);
    		return response() -> json($place);
    }
    public function removeFoodByOrderId($dish_id,$order_id) {

            $command = DB::delete('delete from dish_status where dish_status.dish_id = ' . $dish_id . ' and dish_status.order_id = ' . $order_id .';');
            return response() -> json($command);
    }
    public function removeFoodByDishstatusId($dishstatus_id) {

                $command = DB::delete('delete from dish_status where id = ' . $dishstatus_id . ';');
                return response() -> json($command);
      }
public function updateServeByStatusId($status_id) {
		$command = DB::update('UPDATE dish_status set dish_status.hasServed = case
    when dish_status.hasServed = 1 Then 0
    when dish_status.hasServed = 0 Then 1
    End
    where id = ' . $status_id . ';');
		return response() -> json($command);
	}

    public function getBillByCustomerId($customerid) {
		$command = 'select sum(d.price) as total from dish d, (select dish_id from single_order so, dish_status ds where so.order_id = ds.order_id and customer_id =' . $customerid . ') as group2 where d.dish_id = group2.dish_id;';
		$Allin = DB::select($command);
		return response() -> json($Allin);
	}
	public function getBillByTableId($tableid) {
    		$command = DB::select('select sum(d.price) as  total from dish d,
    				(select ds.dish_id from dish_status ds,
    				(select so.order_id from single_order so,
    				(select c.customer_id from customer c where c.table_id = ' . $tableid . ') as group1
    				where group1.customer_id = so.customer_id) as group2
    				where ds.order_id = group2.order_id) as group3
    				where d.dish_id = group3.dish_id;');
    		return response() -> json($command);
    }



}
