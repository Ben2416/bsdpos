<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model{
	
	public function getInvoices(){
		$this->db->join('customers','invoices.invoice_client=customers.customer_id');
		$this->db->order_by('invoice_id', 'DESC');
		$this->db->limit(10);
		$query = $this->db->get('invoices');
		return $query->result_array();
	}
	
	public function getStocks(){
		$this->db->join('products', 'stocks.stock_product=products.product_id');
		$this->db->order_by('stock_id', 'DESC');
		$this->db->limit(10);
		$query = $this->db->get('stocks');
		return $query->result_array();
	}
	
	public function getInvoicesToday($day){
		$this->db->where('invoice_issue_date', $day);
		$query = $this->db->get('invoices');
		return $query->num_rows();
	}
	
	public function getInvoicesMonth($month){
		$this->db->like('invoice_issue_date', $month);
		$query = $this->db->get('invoices');
		//echo $this->db->last_query();exit;
		return $query->num_rows();
	}
	
	public function getSalesToday($day){
		$this->db->select('SUM(invoice_total) as sales_today');
		$this->db->where('invoice_issue_date', $day);
		$query = $this->db->get('invoices');
		return $query->row()->sales_today;
	}
	
	public function getSalesMonth($month){
		$this->db->select('SUM(invoice_total) as sales_month');
		$this->db->like('invoice_issue_date', $month);
		$query = $this->db->get('invoices');
		return $query->row()->sales_month;
	}
	
	public function getPosSalesWeek($from, $to){
		$this->db->select('SUM(invoice_total) as pos_sales_Week');
		$this->db->from('invoices');
		$this->db->where('invoice_type !=', 'CREDIT');
		$this->db->where("STR_TO_DATE(invoice_issue_date,'%d-%m-%Y') BETWEEN STR_TO_DATE('".$from."', '%d-%m-%Y') AND STR_TO_DATE('".$to."', '%d-%m-%Y')", "", FALSE);
		$query = $this->db->get();
		return $query->row()->pos_sales_Week;
	}
	
	public function getCreditSalesWeek($from, $to){
		$this->db->select('SUM(invoice_total) as credit_sales_week');
		$this->db->from('invoices');
		$this->db->where('invoice_type', 'CREDIT');
		$this->db->where("STR_TO_DATE(invoice_issue_date,'%d-%m-%Y') BETWEEN STR_TO_DATE('".$from."', '%d-%m-%Y') AND STR_TO_DATE('".$to."', '%d-%m-%Y')", "", FALSE);
		$query = $this->db->get();//echo $this->db->last_query();
		//print_r($query->row());exit;
		return $query->row()->credit_sales_week;
	}
	
}