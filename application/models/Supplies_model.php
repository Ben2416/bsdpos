<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplies_model extends CI_Model{
	
	private $table = "supplies";
	
	public function getWarehouses(){
		$query = $this->db->get('warehouses');
		return $query->result_array();
	}
	
}