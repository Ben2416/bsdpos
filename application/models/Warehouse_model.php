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
	
	public function editWarehouse($warehouse){
		$this->db->set('warehouse_name', $this->input->post('warehouse_name', true));
		$this->db->set('warehouse_address', $this->input->post('warehouse_address', true));
		$this->db->where('warehouse_id', $warehouse);
		return $this->db->update($this->table);
	}
	
	public function removeWarehouse($warehouse){
		$this->db->trans_start();
		
		$this->db->where('warehouse_id', $warehouse);
		$this->db->delete($this->table);
		
		
		
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE) return false;
		else return true;
	}
	
}