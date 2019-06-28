<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stocks extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model("Stocks_model", "stocks");
		$this->load->model("Invoice_model", "invoice");
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
		
		$data['stock_transfers'] = $this->stocks->getStockTransfers();
		//print_r($data['stock_transfers'][0]);exit;
		
		$this->form_validation->set_error_delimiters('<div class="alert alert-error"><button class="close" data-dismiss="alert">×</button>','</div>');
		//$this->form_validation->set_rules('transfer_date', 'Transfer Date', 'trim|required');
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
					//'stock_date' => $this->input->post('transfer_date', true),
					'stock_product' => $this->input->post('product[]', true)[$i],
					'stock_quantity' => $this->input->post('product_quantity[]', true)[$i],
					'stock_price' => $this->input->post('price[]', true)[$i],
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
	
	public function returns(){
		$data['active'] = 'stocks';
		
		$data['stock_returns'] = $this->stocks->getStockReturns();
		
		$this->load->view('header_view', $data);
		$this->load->view('sidebar_view');
		$this->load->view('stock_returns_view');
		$this->load->view('footer_view');
	}
	
	public function return($invoice_id){
		$data['active'] = 'stocks';
		$data['page'] = 'return';
		$data['invoice_id'] = $invoice_id;
		
		$data['invoice'] = $this->invoice->getInvoice($invoice_id)[0];
		$data['invoice_items'] = $this->invoice->getInvoiceItems($invoice_id);
		
		$this->form_validation->set_error_delimiters('<div class="alert alert-error"><button class="close" data-dismiss="alert">×</button>','</div>');
		$this->form_validation->set_rules('return_date', 'Stock Return Date', 'trim|required');
		$this->form_validation->set_rules('return_amount', 'Stock Return Date', 'trim|required');
		
		if($this->form_validation->run() == FALSE){
			$this->load->view('header_view', $data);
			$this->load->view('sidebar_view');
			$this->load->view('stocks_return_view');
			$this->load->view('footer_view');
		}else{
			$stock_return = $this->stocks->stockReturn($data['invoice']);
			if($stock_return){
				$this->session->set_flashdata('success', 'Stock returned successfully.');
				redirect(base_url('stocks'), 'refresh');
			}else{
				$this->session->set_flashdata('error', 'Error: Stock not returned.');
				redirect(base_url('stocks'), 'refresh');
			}
		}
	}
	
	public function returninvoice($invoice_id){
		$data['active'] = 'stocks';
		$data['invoice_id'] = $invoice_id;
		
		$data['return_invoice'] = $this->stocks->getReturnInvoice($invoice_id)[0];
		$data['return_invoice_items'] = $this->stocks->getReturnInvoiceItems($invoice_id);
		
		$this->load->view('header_view', $data);
		$this->load->view('sidebar_view');
		$this->load->view('stocks_return_invoice_view');
		$this->load->view('footer_view');
	}
	
	public function update($product, $warehouse){
		$this->form_validation->set_rules('stock_quantity', 'Stock Quantity', 'trim|required');
		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('error', 'Stock Quantity is required.');
			redirect(base_url('stocks/index'), 'refresh');
		}else{
			$quantity = $this->input->post("stock_quantity", true);
			$update_stock = $this->stocks->updateStock($product, $warehouse, $quantity);
			if($update_stock){
				$this->session->set_flashdata('success', 'Stock updated successfully!');
				redirect(base_url('stocks/index'), 'refresh');
			}else{
				$this->session->set_flashdata('error', 'Stock not updated');
				redirect(base_url('stocks/index'), 'refresh');
			}
		}
	}
	
	public function delete($product, $warehouse){
		$delete_stock = $this->stocks->deleteStock($product, $warehouse);
		if($delete_stock){
			$this->session->set_flashdata('success', 'Stock deleted successfully!');
			redirect(base_url('stocks/index'), 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Stock not deleted');
			redirect(base_url('stocks/index'), 'refresh');
		}
	}
	
}