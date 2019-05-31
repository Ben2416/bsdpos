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
	
	public function getProductsWhere($product){
		$this->db->like('product_name', $product);
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
	
	public function addProduct(){
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
		return $this->db->insert($this->table, $data);
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