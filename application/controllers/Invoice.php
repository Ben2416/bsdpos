<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model("Invoice_model", "invoice");
	}
	
	public function index(){
		$data['active'] = 'invoice';
		
		$data['invoices'] = array();
		
		$this->load->view('header_view', $data);
		$this->load->view('sidebar_view');
		$this->load->view('invoice_view');
		$this->load->view('footer_view');
	}
	
	public function get(){
		$data['active'] = 'invoice';
		
		$this->load->view('header_view', $data);
		$this->load->view('sidebar_view');
		$this->load->view('invoice_get_view');
		$this->load->view('footer_view');
	}
	
	public function create(){
		$data['active'] = 'invoice';
		$data['warehouses'] = $this->invoice->getWarehouses();
		
		$this->load->view('header_view', $data);
		$this->load->view('sidebar_view');
		$this->load->view('invoice_create_view');
		$this->load->view('footer_view');
	}
	
}