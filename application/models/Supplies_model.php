<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplies_model extends CI_Model{
	
	private $table = "supplies";
	
	public function getWarehouses(){
		$query = $this->db->get('warehouses');
		return $query->result_array();
	}
	
	public function getSupplies(){
		$this->db->join('products', $this->table.'.supply_item=products.product_id');
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
	
	public function addSupplies($supplies, $stock_update){
		$this->db->trans_start();
		$this->db->insert_batch($this->table, $supplies);
		
		//update stocks
		foreach($stock_update as $su){
			$this->db->set('stock_quantity', 'stock_quantity+'.$su['stock_quantity'], FALSE);
			$this->db->where('stock_product', $su['stock_product']);
			$this->db->where('stock_warehouse', $su['stock_warehouse']);
			$this->db->update('stocks');
		}
		
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE) return false;
		else return true;
	}
	
}