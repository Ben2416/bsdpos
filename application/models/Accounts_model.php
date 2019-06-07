<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts_model extends CI_Model{
	
	private $table = "accounts";
	
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
	
	public function getInvoice($invoice_txn_id){
		$this->db->join('customers', 'invoices.invoice_client=customers.customer_id');
		$this->db->join('warehouses', 'invoices.invoice_warehouse=warehouses.warehouse_id');
		$this->db->order_by('invoice_id', 'DESC');
		$this->db->where('invoice_txn_id', $invoice_txn_id);
		$query = $this->db->get('invoices');
		return $query->result_array();
	}
	
	public function addPayment($pay_details){
		return $this->db->insert('payments', $pay_details);
	}
	
	public function getPayments($invoice){
		$this->db->where('payment_invoice', $invoice);
		$query = $this->db->get('payments');
		return $query->result_array();
	}
	
	public function getAmountPaid($invoice){
		$this->db->select('sum(payment_amount) as amount_paid');
		$this->db->from('payments');
		$this->db->where('payment_invoice', $invoice);
		$query = $this->db->get();
		return $query->result_array()[0]['amount_paid'];
	}
	
	public function updateInvoice($invoice, $status){
		$this->db->set('invoice_status', $status);
		$this->db->where('invoice_txn_id', $invoice);
		$this->db->limit(1);
		$this->db->update('invoices');
	}
	
}