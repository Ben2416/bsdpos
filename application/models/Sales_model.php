<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales_model extends CI_Model{
	
	private $table = "sales";
	
	public function getWarehouses(){
		if($this->session->user_role != 1 )
			$this->db->where('warehouse_id', $this->session->user_warehouse);
		$query = $this->db->get('warehouses');
		return $query->result_array();
	}
	
	public function getInvoices($sales_type){
		$this->db->join('customers', 'invoices.invoice_client=customers.customer_id');
		$this->db->join('warehouses', 'invoices.invoice_warehouse=warehouses.warehouse_id');
		$this->db->where('invoices.invoice_type', $sales_type);
		if($this->session->user_role != 1 )
			$this->db->where('invoice_warehouse', $this->session->user_warehouse);
		$this->db->order_by('invoice_id', 'DESC');
		$query = $this->db->get('invoices');
		return $query->result_array();
	}
	
	public function getInvoicesInDates($sales_type, $from, $to){
		$this->db->join('customers', 'invoices.invoice_client=customers.customer_id');
		$this->db->join('warehouses', 'invoices.invoice_warehouse=warehouses.warehouse_id');
		$this->db->where('invoices.invoice_type', $sales_type);
		$this->db->where("STR_TO_DATE(invoice_issue_date,'%d-%m-%Y') BETWEEN STR_TO_DATE('".$from."', '%d-%m-%Y') AND STR_TO_DATE('".$to."', '%d-%m-%Y')", "", FALSE);
		if($this->session->user_role != 1 )
			$this->db->where('invoice_warehouse', $this->session->user_warehouse);
		$this->db->order_by('invoice_id', 'DESC');
		$query = $this->db->get('invoices');
		return $query->result_array();
	}
	
}