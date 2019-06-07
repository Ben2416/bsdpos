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
		
		$this->form_validation->set_error_delimiters('<div class="alert alert-error"><button class="close" data-dismiss="alert">×</button>','</div>');
		$this->form_validation->set_rules('transfer_date', 'Transfer Date', 'trim|required');
		$this->form_validation->set_rules('from_warehouse', 'From Warehouse', 'trim|required');
		$this->form_validation->set_rules('to_warehouse', 'To Warehouse', 'trim|required');
		$this->form_validation->set_rules('product_name[]', 'Product Name', 'trim|required');
		$this->form_validation->set_rules('product_quantity[]', 'Product Quantity', 'trim|required');
		
		if($this->form_validation->run() == FALSE){
			$this->load->view('header_view', $data);
			$this->load->view('sidebar_view');
			$this->load->view('stocks_transfer_view');
			$this->load->view('footer_view');
		}else{
			$stock_trans = array();
			$items = count($this->input->post('product_name[]', true));
			for($i=0; $i<$items; $i++){
				$stock_trans[] = array(
					'stock_date' => $this->input->post('transfer_date', true),
					'stock_product' => $this->input->post('product[]', true)[$i],
					'stock_quantity' => $this->input->post('product_quantity[]', true)[$i],
					'from_warehouse' => $this->input->post('from_warehouse', true),
					'to_warehouse' => $this->input->post('to_warehouse', true),
				);
			}
			$stock_transfer = $this->stocks->stockTransfer($stock_trans);
			if($stock_transfer){
				$this->session->set_flashdata('success', 'Stock transferred successfully.');
				redirect(base_url('stocks'), 'refresh');
			}else{
				$this->session->set_flashdata('error', 'Error: Stock not transferred.');
				redirect(base_url('stocks'), 'refresh');
			}
		}
		
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