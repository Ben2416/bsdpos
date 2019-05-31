<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts_model extends CI_Model{
	
	private $table = "accounts";
	
	public function getWarehouses(){
		$query = $this->db->get('warehouses');
		return $query->result_array();
	}
	
}