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
		
		$data['sales_type'] = $sales_type;
		
		$this->form_validation->set_rules('start_date', 'Start Date', 'trim|required');
		$this->form_validation->set_rules('end_date', 'End Date', 'trim|required');
		
		if($this->form_validation->run() == FALSE){
			//$data['invoices'] = $this->sales->getInvoices($sales_type);
			$data['invoices'] = $this->sales->getInvoicesInDates($sales_type, date('d-m-Y', strtotime('-17 days')), date('d-m-Y') );
		}else{
			$start_date = $this->input->post('start_date', true);
			$end_date = $this->input->post('end_date', true);
			$data['invoices'] = $this->sales->getInvoicesInDates($sales_type, $start_date, $end_date);
		}
		
		
		
		
		$this->load->view('header_view', $data);
		$this->load->view('sidebar_view');
		$this->load->view('sales_view');
		$this->load->view('footer_view');
	}
	
}