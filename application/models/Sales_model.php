<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales_model extends CI_Model{
	
	private $table = "sales";
	
	public function getWarehouses(){
		$query = $this->db->get('warehouses');
		return $query->result_array();
	}
	
	public function getInvoices(){
		$this->db->join('customers', 'invoices.invoice_client=customers.customer_id');
		$this->db->join('warehouses', 'invoices.invoice_warehouse=warehouses.warehouse_id');
		$this->db->order_by('invoice_id', 'DESC');
		$query = $this->db->get('invoices');
		return $query->result_array();
	}
	
}