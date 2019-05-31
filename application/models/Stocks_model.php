<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stocks_model extends CI_Model{
	
	private $table = "stocks";
	
	public function getWarehouses(){
		$query = $this->db->get('warehouses');
		return $query->result_array();
	}
	
	public function getStocks(){
		//join products table for product name, price
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
	
	public function getProducts(){
		$query = $this->db->get('products');
		return $query->result_array();
	}
	
}