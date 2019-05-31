<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expenses_model extends CI_Model{
	
	private $table = "stocks";
	
	public function getWarehouses(){
		$query = $this->db->get('warehouses');
		return $query->result_array();
	}
	
}