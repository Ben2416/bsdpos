<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Warehouse_model extends CI_Model{
	
	private $table = "warehouses";
	
	public function getWarehouses(){
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
	
	public function addWarehouse(){
		$data = array(
			'warehouse_name' => $this->input->post('warehouse_name', true),
			'warehouse_address' => $this->input->post('warehouse_address', true)
		);
		return $this->db->insert($this->table, $data);
	}
	
}