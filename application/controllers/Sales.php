<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model("Sales_model", "sales");
	}
	
	public function index($sales_type){
		$data['active'] = 'sales';
		
		$data['warehouses'] = $this->sales->getWarehouses();
		$data['invoices'] = $this->sales->getInvoices($sales_type);
		$data['sales_type'] = $sales_type;
		
		$this->load->view('header_view', $data);
		$this->load->view('sidebar_view');
		$this->load->view('sales_view');
		$this->load->view('footer_view');
	}
	
}