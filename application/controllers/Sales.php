<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model("Sales_model", "sales");
	}
	
	public function index(){
		$data['active'] = 'sales';
		
		$data['warehouses'] = $this->sales->getWarehouses();
		
		$this->load->view('header_view', $data);
		$this->load->view('sidebar_view');
		$this->load->view('sales_view');
		$this->load->view('footer_view');
	}
	
}