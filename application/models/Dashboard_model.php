<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model{
	
	public function getInvoices(){
		$this->db->join('customers','invoices.invoice_client=customers.customer_id');
		if($this->session->user_role != 1)
			$this->db->where('invoice_warehouse', $this->session->user_warehouse);
		$this->db->order_by('invoice_id', 'DESC');
		$this->db->limit(10);
		$query = $this->db->get('invoices');
		return $query->result_array();
	}
	
	public function getStocks(){
		$this->db->join('products', 'stocks.stock_product=products.product_id');
		if($this->session->user_role != 1)
			$this->db->where('stock_warehouse', $this->session->user_warehouse);
		$this->db->order_by('stock_id', 'DESC');
		//$this->db->limit(10);
		$query = $this->db->get('stocks');
		return $query->result_array();
	}
	
	public function getInvoicesToday($day){
		$this->db->where('invoice_issue_date', $day);
		if($this->session->user_role != 1)
			$this->db->where('invoice_warehouse', $this->session->user_warehouse);
		$query = $this->db->get('invoices');
		return $query->num_rows();
	}
	
	public function getInvoicesMonth($month){
		$this->db->like('invoice_issue_date', $month);
		if($this->session->user_role != 1)
			$this->db->where('invoice_warehouse', $this->session->user_warehouse);
		$query = $this->db->get('invoices');
		//echo $this->db->last_query();exit;
		return $query->num_rows();
	}
	
	public function getSalesToday($day){
		$this->db->select('SUM(invoice_total) as sales_today');
		$this->db->where('invoice_issue_date', $day);
		if($this->session->user_role != 1)
			$this->db->where('invoice_warehouse', $this->session->user_warehouse);
		$query = $this->db->get('invoices');
		return $query->row()->sales_today;
	}
	
	public function getSalesMonth($month){
		$this->db->select('SUM(invoice_total) as sales_month');
		$this->db->like('invoice_issue_date', $month);
		if($this->session->user_role != 1)
			$this->db->where('invoice_warehouse', $this->session->user_warehouse);
		$query = $this->db->get('invoices');
		return $query->row()->sales_month;
	}
	
	public function getPosSalesWeek($from, $to){
		$this->db->select('SUM(invoice_total) as pos_sales_Week');
		$this->db->from('invoices');
		$this->db->where('invoice_type !=', 'CREDIT');
		$this->db->where("STR_TO_DATE(invoice_issue_date,'%d-%m-%Y') BETWEEN STR_TO_DATE('".$from."', '%d-%m-%Y') AND STR_TO_DATE('".$to."', '%d-%m-%Y')", "", FALSE);
		if($this->session->user_role != 1)
			$this->db->where('invoice_warehouse', $this->session->user_warehouse);
		$query = $this->db->get();
		return $query->row()->pos_sales_Week;
	}
	
	public function getCreditSalesWeek($from, $to){
		$this->db->select('SUM(invoice_total) as credit_sales_week');
		$this->db->from('invoices');
		$this->db->where('invoice_type', 'CREDIT');
		$this->db->where("STR_TO_DATE(invoice_issue_date,'%d-%m-%Y') BETWEEN STR_TO_DATE('".$from."', '%d-%m-%Y') AND STR_TO_DATE('".$to."', '%d-%m-%Y')", "", FALSE);
		if($this->session->user_role != 1)
			$this->db->where('invoice_warehouse', $this->session->user_warehouse);
		$query = $this->db->get();//echo $this->db->last_query();
		//print_r($query->row());exit;
		return $query->row()->credit_sales_week;
	}
	
	public function getExpensesToday($date){
		$this->db->select('SUM(expense_amount) as expenses_today');
		$this->db->where('expense_date', $date);
		if($this->session->user_role != 1)
			$this->db->where('expense_warehouse', $this->session->user_warehouse);
		$query = $this->db->get('expenses');
		return $query->row()->expenses_today;
	}
	
	public function getExpensesWeek($from, $to){
		$this->db->select('SUM(expense_amount) as expenses_week');
		$this->db->where("STR_TO_DATE(expense_date,'%d-%m-%Y') BETWEEN STR_TO_DATE('".$from."', '%d-%m-%Y') AND STR_TO_DATE('".$to."', '%d-%m-%Y')", "", FALSE);
		if($this->session->user_role != 1)
			$this->db->where('expense_warehouse', $this->session->user_warehouse);
		$query = $this->db->get('expenses');
		return $query->row()->expenses_week;
	}
	
}