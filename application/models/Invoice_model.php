<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice_model extends CI_Model{
	
	private $table = "invoices";
	
	public function getWarehouses(){
		$query = $this->db->get('warehouses');
		return $query->result_array();
	}
	
	public function getInvoices(){
		$this->db->join('customers', $this->table.'.invoice_client=customers.customer_id');
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
	
	public function getInvoice($invoice_id){
		$this->db->join('customers', $this->table.'.invoice_client=customers.customer_id');
		$this->db->join('warehouses', $this->table.'.invoice_warehouse=warehouses.warehouse_id');
		//$this->db->join('invoice_items', $this->table.'.invoice_txn_id=invoice_items.invoice_item_invoice');
		$this->db->where('invoice_txn_id', $invoice_id);
		$this->db->limit(1);
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
	
	public function getInvoiceItems($invoice_id){
		$this->db->join('products', 'invoice_items.invoice_item_product=products.product_id');
		$this->db->where('invoice_item_invoice', $invoice_id);
		$query = $this->db->get('invoice_items');
		return $query->result_array();
	}
	
	public function getLastInvoice(){
		$this->db->select('invoice_txn_id');
		$this->db->from($this->table);
		$this->db->order_by('invoice_id', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		if($query->num_rows() > 0)
			return $query->row()->invoice_txn_id;
		else
			return 10000;
	}
	
	public function addInvoice($customer, $invoice, $invoice_items){
		$this->db->trans_start();//(TRUE);for test purposes
		
		$this->db->insert('customers',$customer);
		$invoice['invoice_client']=$this->db->insert_id();//add customer id to invoice
		$this->db->insert($this->table, $invoice);
		$this->db->insert_batch('invoice_items', $invoice_items);
		
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE) return false;
		else return true;
	}
	
}