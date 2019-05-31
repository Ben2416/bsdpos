<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stocks extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model("Stocks_model", "stocks");
	}
	
	public function index(){
		$data['active'] = 'stocks';
		
		$data['warehouses'] = $this->stocks->getWarehouses();
		$data['stocks'] = $this->stocks->getStocks();
		
		$this->load->view('header_view', $data);
		$this->load->view('sidebar_view');
		$this->load->view('stocks_view');
		$this->load->view('footer_view');
	}
	
	public function transfer(){
		$data['active'] = 'stocks';
		$data['warehouses'] = $this->stocks->getWarehouses();
		$data['products'] = $this->stocks->getProducts();
		$this->load->view('header_view', $data);
		$this->load->view('sidebar_view');
		$this->load->view('stocks_transfer_view');
		$this->load->view('footer_view');
	}
	
	public function return(){
		$data['active'] = 'stocks';
		
		$data['warehouses'] = $this->stocks->getWarehouses();
		$data['products'] = $this->stocks->getProducts();
		
		$this->load->view('header_view', $data);
		$this->load->view('sidebar_view');
		$this->load->view('stocks_return_view');
		$this->load->view('footer_view');
	}
}