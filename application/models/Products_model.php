<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products_model extends CI_Model{
	
	private $table = "products";
	
	public function getWarehouses(){
		$query = $this->db->get('warehouses');
		return $query->result_array();
	}
	
	public function getProducts(){
		$this->db->join('warehouses', $this->table.'.product_warehouse=warehouses.warehouse_id');
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
	
	public function getProduct($product_id){
		$this->db->where('product_id', $product_id);
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
	
	//for auto complete
	public function getProductsWhere($product){
		$this->db->like('product_name', $product);
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
	
	//for auto complete
	public function getProductsWithStockWhere($product, $warehouse){
		$this->db->like('product_name', $product);
		$this->db->where('stock_warehouse', $warehouse);
		$this->db->join('stocks', $this->table.'.product_id=stocks.stock_product');
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
	
	public function addProduct(){
		$this->db->trans_start();
		$data = array(
			'product_name' => $this->input->post('product_name', true),
			'product_description' => $this->input->post('product_description', true),
			'product_wholesale_price' => $this->input->post('wholesale_price', true),
			'product_supply_price' => $this->input->post('supply_price', true),
			'product_retail_price' => $this->input->post('retail_price', true),
			'product_quantity' => $this->input->post('product_quantity'),//can add this to the sum of products in stock
			'product_warehouse' => $this->input->post('product_warehouse')
		);
		$this->db->insert($this->table, $data);
		
		$stock = array(
			'stock_product' => $this->db->insert_id(),
			'stock_quantity' => $this->input->post('product_quantity'),
			'stock_warehouse' => $this->input->post('product_warehouse')
		);
		
		$udata = array();
		foreach($stock as $k=>$v){
			$udata[] = $k.'='."'".$v."'"; 
		}
		$sql = $this->db->insert_string('stocks',$stock)." ON DUPLICATE KEY UPDATE ".implode(', ',$udata) ;
		$insert = $this->db->query($sql);
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE) return false;
		else return true;
	}
	
	public function editProduct($product_id){
		$data = array(
			'product_name' => $this->input->post('product_name', true),
			'product_description' => $this->input->post('product_description', true),
			'product_price' => $this->input->post('product_price', true),
			'product_wholesale_price' => $this->input->post('wholesale_price', true),
			'product_supply_price' => $this->input->post('supply_price', true),
			'product_retail_price' => $this->input->post('retail_price', true),
			'product_quantity' => $this->input->post('product_quantity'),
			'product_warehouse' => $this->input->post('product_warehouse')
		);
		$this->db->where('product_id', $product_id);
		return $this->db->update($this->table, $data);
	}
	
	public function deleteProduct($product_id){
		$this->db->where('product_id', $product_id);
		return $this->db->delete($this->table);
	}
	
}