<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model("Accounts_model", "accounts");
	}
	
	public function index(){
		$data['active'] = 'accounts';
		
		$data['warehouses'] = $this->accounts->getWarehouses();
		
		$this->load->view('header_view', $data);
		$this->load->view('sidebar_view');
		$this->load->view('accounts_view');
		$this->load->view('footer_view');
	}
	
	public function payment_confirmation($invoice_id){
		$data['active'] = 'accounts';
		
		$data['invoice_id'] = $invoice_id;
		
		$this->load->view('header_view', $data);
		$this->load->view('sidebar_view');
		$this->load->view('accounts_payment_confirmation_view');
		$this->load->view('footer_view');
	}
	
}