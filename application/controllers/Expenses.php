<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expenses extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model("Expenses_model", "expenses");
	}
	
	public function index(){
		$data['active'] = 'expenses';
		
		$data['warehouses'] = $this->expenses->getWarehouses();
		$data['expenses'] = $this->expenses->getExpenses();
		
		$this->load->view('header_view', $data);
		$this->load->view('sidebar_view');
		$this->load->view('expenses_view');
		$this->load->view('footer_view');
	}
	
	public function add(){
		$data['active'] = 'expenses';
		$data['sub_page'] = "add";
		$data['warehouses'] = $this->expenses->getWarehouses();
		$data['admin_expenses'] = json_encode($this->expenses->getExpenseItems('Admin'));
		$data['operating_expenses'] = json_encode($this->expenses->getExpenseItems('Operating'));
		
		$this->form_validation->set_error_delimiters('<div class="alert alert-error"><button class="close" data-dismiss="alert">×</button>','</div>');
		$this->form_validation->set_rules('expense_date', 'Expense Date', 'trim|required');
		$this->form_validation->set_rules('expense_warehouse', 'Expense Warehouse', 'trim|required');
		$this->form_validation->set_rules('expense_class', 'Expense Class', 'trim|required');
		$this->form_validation->set_rules('expense_item', 'Expense Item', 'trim|required');
		if(array_key_exists('new_expense_item', $this->input->post()))
			$this->form_validation->set_rules('new_expense_item', 'New Expense Item', 'trim|required');
		$this->form_validation->set_rules('expense_amount', 'Expense Amount', 'trim|required');
		
		if($this->form_validation->run() == FALSE){
			$this->load->view('header_view', $data);
			$this->load->view('sidebar_view');
			$this->load->view('expenses_add_view');
			$this->load->view('footer_view');
		}else{
			$add_expense = $this->expenses->addExpense();
			if($add_expense){
				$this->session->set_flashdata('success', 'Expense has been added successfully');
			}else{
				$this->session->set_flashdata('error', 'Error in adding expense');
			}
			redirect(base_url('expenses'));
		}
	}
	
}