<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model("Invoice_model", "invoice");
	}
	
	
	//show all invoices
	public function index(){
		$data['active'] = 'invoice';
		
		$data['invoices'] = $this->invoice->getInvoices();
		
		$this->load->view('header_view', $data);
		$this->load->view('sidebar_view');
		$this->load->view('invoice_view');
		$this->load->view('footer_view');
	}
	
	
	//get an invoice
	public function get($invoice_id, $invoice_type){
		$data['active'] = 'invoice';
		$data['invoice_type'] = $invoice_type;
		//print_r($data['invoice_items']);exit;
		
		$this->load->view('header_view', $data);
		$this->load->view('sidebar_view');
		$this->load->view('invoice_get_view');
		$this->load->view('footer_view');
	}
	
	
	//create an invoice
	public function create($invoice_category, $invoice_type=''){
		$data['active'] = 'invoice';
		$data['invoice_category'] = $invoice_category;
		$data['invoice_type'] = $invoice_type;
		$data['warehouses'] = $this->invoice->getWarehouses();
		$data['last_invoice'] = $this->invoice->getLastInvoice();
		
		$this->form_validation->set_error_delimiters('<div class="alert alert-error"><button class="close" data-dismiss="alert">×</button>','</div>');
		$this->form_validation->set_rules('invoice_id', 'Invoice ID', 'trim');
		$this->form_validation->set_rules('invoice_issue_date', 'Invoice Issue Date', 'trim|required');
		$this->form_validation->set_rules('invoice_due_date', 'Invoice Due Date', 'trim|required');
		
		$this->form_validation->set_rules('invoice_customer_name', 'Invoice Customer Name', 'trim|required');
		$this->form_validation->set_rules('invoice_customer_phone', 'Invoice Customer Phone', 'trim|required');
		$this->form_validation->set_rules('invoice_customer_email', 'Invoice Customer Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('invoice_customer_address', 'Invoice Customer Address', 'trim|required');
		
		$this->form_validation->set_rules('invoice_subtotal', 'Invoice Subtotal', 'trim|required');
		$this->form_validation->set_rules('invoice_extra_discount', 'Invoice Discount', 'trim');
		$this->form_validation->set_rules('invoice_total', 'Invoice Total', 'trim|required');
		
		$this->form_validation->set_rules('item_name[]', 'Invoice Item', 'trim|required');
		
		if($this->form_validation->run() == FALSE){
			$this->load->view('header_view', $data);
			$this->load->view('sidebar_view');
			$this->load->view('invoice_create_view');
			$this->load->view('footer_view');
		}else{
			$invoice_id = $this->invoice->getLastInvoice()+1;
			
			$customer = array(
				'customer_name' => $this->input->post('invoice_customer_name', true),
				'customer_phone' => $this->input->post('invoice_customer_phone', true),
				'customer_email' => $this->input->post('invoice_customer_email', true),
				'customer_address' => $this->input->post('invoice_customer_address', true)
			);
			
			$payment_terms = ($invoice_type=='CREDIT')?$this->input->post('invoice_payment_term', true):'Cash';
			$invoice = array(
				'invoice_txn_id' => $invoice_id,
				'invoice_category' => $invoice_category,
				'invoice_type' => $invoice_type,
				'invoice_issue_date' => $this->input->post('invoice_issue_date', true),
				'invoice_due_date' => $this->input->post('invoice_due_date', true),
				'invoice_subtotal' => $this->input->post('invoice_subtotal', true),
				'invoice_tax' => 0.00,
				'invoice_discount' => $this->input->post('invoice_extra_discount', true),
				'invoice_total' => $this->input->post('invoice_total', true),
				'invoice_payterms' => $payment_terms,
				//'invoice_client' => 1001,//get from customer (customer insert id)
				'invoice_warehouse' => $this->input->post('invoice_warehouse')
			);
			
			$invoice_items = array();
			for($i=0; $i<count( $this->input->post('item_name[]')); $i++){
				$invoice_items[] = array(
					'invoice_item_invoice' => $invoice_id,
					'invoice_item_product' => $this->input->post('item')[$i],
					'invoice_item_quantity' => $this->input->post('quantity')[$i],
					'invoice_item_price' => $this->input->post('item_price')[$i],
					'invoice_item_total' => $this->input->post('amount')[$i]
				);
			}
			
			$add_invoice = $this->invoice->addInvoice($customer, $invoice, $invoice_items);
			if($add_invoice){
				$this->session->set_flashdata('success', "Invoice was generated successfully.");
				redirect(base_url('sales/index/'.$invoice_type), 'refresh');
			}else{
				$this->session->set_flashdata('error', "Failed to generate invoice.");
				redirect(base_url('sales/index/'.$invoice_type), 'refresh');
			}
			
		}
	}
	
	
	//edit an invoice
	public function edit($invoice_category, $invoice_type='', $invoice_receipt_id){
		$data['active'] = 'invoice';
		$data['invoice_category'] = $invoice_category;
		$data['invoice_type'] = $invoice_type;
		$data['warehouses'] = $this->invoice->getWarehouses();
		
		$data['invoice_receipt_id'] = $invoice_receipt_id;
		$data['invoicee'] = $this->invoice->getInvoice($invoice_receipt_id)[0];
		$data['invoicee_items'] = $this->invoice->getInvoiceItems($invoice_receipt_id);
		
		//hold all product keys; this can be used in removing products not in update
		$oldproducts = array();
		foreach($data['invoicee_items'] as $is){
			$oldproducts[] = $is['invoice_item_product'];
		}
		$oldproducts[]= 43;
		
		$this->form_validation->set_error_delimiters('<div class="alert alert-error"><button class="close" data-dismiss="alert">×</button>','</div>');
		$this->form_validation->set_rules('invoice_id', 'Invoice ID', 'trim');
		$this->form_validation->set_rules('invoice_issue_date', 'Invoice Issue Date', 'trim|required');
		$this->form_validation->set_rules('invoice_due_date', 'Invoice Due Date', 'trim|required');
		
		$this->form_validation->set_rules('invoice_customer_name', 'Invoice Customer Name', 'trim|required');
		$this->form_validation->set_rules('invoice_customer_phone', 'Invoice Customer Phone', 'trim|required');
		$this->form_validation->set_rules('invoice_customer_email', 'Invoice Customer Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('invoice_customer_address', 'Invoice Customer Address', 'trim|required');
		
		$this->form_validation->set_rules('invoice_subtotal', 'Invoice Subtotal', 'trim|required');
		$this->form_validation->set_rules('invoice_extra_discount', 'Invoice Discount', 'trim');
		$this->form_validation->set_rules('invoice_total', 'Invoice Total', 'trim|required');
		
		$this->form_validation->set_rules('item_name[]', 'Invoice Item', 'trim|required');
		
		if($this->form_validation->run() == FALSE){
			$this->load->view('header_view', $data);
			$this->load->view('sidebar_view');
			$this->load->view('invoice_edit_view');
			$this->load->view('footer_view');
		}else{
			$invoice_id = $invoice_receipt_id;
			
			$customer = array(
				'customer_id' => $data['invoicee']['customer_id'],
				'customer_name' => $this->input->post('invoice_customer_name', true),
				'customer_phone' => $this->input->post('invoice_customer_phone', true),
				'customer_email' => $this->input->post('invoice_customer_email', true),
				'customer_address' => $this->input->post('invoice_customer_address', true)
			);
			
			$payment_terms = ($invoice_type=='CREDIT')?$this->input->post('invoice_payment_term', true):'Cash';
			$invoice = array(
				//'invoice_txn_id' => $invoice_id,
				'invoice_category' => $invoice_category,
				'invoice_type' => $invoice_type,
				'invoice_issue_date' => $this->input->post('invoice_issue_date', true),
				'invoice_due_date' => $this->input->post('invoice_due_date', true),
				'invoice_subtotal' => $this->input->post('invoice_subtotal', true),
				'invoice_tax' => 0.00,
				'invoice_discount' => $this->input->post('invoice_extra_discount', true),
				'invoice_total' => $this->input->post('invoice_total', true),
				'invoice_payterms' => $payment_terms,
				//'invoice_client' => 1001,//get from customer (customer insert id)
				'invoice_warehouse' => $this->input->post('invoice_warehouse')
			);
			
			$newproducts = array();//hold new products to be compared with oldproducts to remove the non-recurrent products
			$invoice_items = array();
			for($i=0; $i<count( $this->input->post('item_name[]')); $i++){
				$invoice_items[] = array(
					'invoice_item_invoice' => $invoice_id,
					'invoice_item_product' => $this->input->post('item')[$i],
					'invoice_item_quantity' => $this->input->post('quantity')[$i],
					'invoice_item_price' => $this->input->post('item_price')[$i],
					'invoice_item_total' => $this->input->post('amount')[$i]
				);
				$newproducts[] = $this->input->post('item')[$i];
			}
			
			$invalidproducts = array_diff($oldproducts, $newproducts);//contains values in previous item list not in new list
			
			$edit_invoice = $this->invoice->editInvoice($invoice_receipt_id, $customer, $invoice, $invoice_items, $invalidproducts);
			if($edit_invoice){
				$this->session->set_flashdata('success', "Invoice was edited successfully.");
				redirect(base_url('sales/index/'.$invoice_type), 'refresh');
			}else{
				$this->session->set_flashdata('error', "Failed to edit invoice.");
				redirect(base_url('sales/index/'.$invoice_type), 'refresh');
			}
			
		}
	}
	
	//delete an invoice
	public function delete($invoice_type, $invoice_id){
		$delete_invoice = $this->invoice->deleteInvoice($invoice_id);
		if($delete_invoice){
			$this->session->set_flashdata('success', 'Invoice deleted successfully!');
			redirect(base_url('sales/index/'.$invoice_type), 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Invoice not deleted');
			redirect(base_url('sales/index/'.$invoice_type), 'refresh');
		}
	}
	
}