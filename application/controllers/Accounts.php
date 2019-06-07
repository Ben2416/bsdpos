<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model("Accounts_model", "accounts");
	}
	
	public function index(){
		$data['active'] = 'accounts';
		$data['invoices'] = $this->accounts->getInvoices();
		$data['warehouses'] = $this->accounts->getWarehouses();
		
		$this->load->view('header_view', $data);
		$this->load->view('sidebar_view');
		$this->load->view('accounts_view');
		$this->load->view('footer_view');
	}
	
	public function payment_confirmation($invoice_id){
		$data['active'] = 'accounts';
		$data['invoice_id'] = $invoice_id;
		$data['invoice'] = $this->accounts->getInvoice($invoice_id)[0];
		$data['payments'] = $this->accounts->getPayments($invoice_id);
		$data['amount_paid'] = $this->accounts->getAmountPaid($invoice_id)+0;
		$data['balance'] = $data['invoice']['invoice_total'] - $data['amount_paid'];
		
		$this->form_validation->set_error_delimiters('<div class="alert alert-error"><button class="close" data-dismiss="alert">×</button>','</div>');
		$this->form_validation->set_rules('payment_type', 'Payment Type', 'trim|required');
		$this->form_validation->set_rules('payment_amount', 'Payment Amount', 'trim|required');
		
		if($this->form_validation->run() == FALSE){
			$this->load->view('header_view', $data);
			$this->load->view('sidebar_view');
			$this->load->view('accounts_payment_confirmation_view');
			$this->load->view('footer_view');
		}else{
			
			$payment_details = array(
				'payment_invoice' => $invoice_id,
				'payment_date' => $this->input->post('payment_date', true),
				'payment_type' => $this->input->post('payment_type', true),
				'payment_amount' => $this->input->post('payment_amount', true),
				'payment_warehouse' => $data['invoice']['invoice_warehouse']
			);
			
			$add_payment = $this->accounts->addPayment($payment_details);
			if($add_payment){
				if($data['invoice']['invoice_total'] == $this->accounts->getAmountPaid($invoice_id))
					$this->accounts->updateInvoice($invoice_id, 2);
				else
					$this->accounts->updateInvoice($invoice_id, 1);
				$this->session->set_flashdata('success', 'Payment added successfully.');
				redirect(base_url('accounts/payment_confirmation/'.$invoice_id), 'refresh');
			}else{
				$this->session->set_flashdata('error', 'Error in adding payment.');
				redirect(base_url('accounts/payment_confirmation/'.$invoice_id), 'refresh');
			}
			
		}
		
		
	}
	
}