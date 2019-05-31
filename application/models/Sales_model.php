<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales_model extends CI_Model{
	
	private $table = "sales";
	
	public function getWarehouses(){
		$query = $this->db->get('warehouses');
		return $query->result_array();
	}
	
}