<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplies extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model("Supplies_model", "supplies");
	}
	
	public function index(){
		$data['active'] = 'supplies';
		
		$data['warehouses'] = $this->supplies->getWarehouses();
		
		$data['supplies'] = $this->supplies->getSupplies();
		
		$this->load->view('header_view', $data);
		$this->load->view('sidebar_view');
		$this->load->view('supplies_view');
		$this->load->view('footer_view');
	}
	
	public function add($warehouse_id){
		$data['active'] = 'supplies';
		$data['warehouse_id'] = $warehouse_id;
		
		$this->form_validation->set_error_delimiters('<div class="alert alert-error"><button class="close" data-dismiss="alert">×</button>','</div>');
		$this->form_validation->set_rules('supply_date', 'Supply Date', 'trim|required');
		$this->form_validation->set_rules('supplier_name', 'Supplier Name', 'trim|required');
		$this->form_validation->set_rules('supplier_phone', 'Supplier Phone', 'trim|required');
		$this->form_validation->set_rules('supplier_email', 'Supplier Email', 'trim|required');
		$this->form_validation->set_rules('supplier_address', 'Supplier Address', 'trim|required');
		$this->form_validation->set_rules('supply_item[]', 'Supply Item', 'trim|required');
		$this->form_validation->set_rules('supply_quantity[]', 'Supply Quantity', 'trim|required');
		$this->form_validation->set_rules('supply_rate[]', 'Supply Rate', 'trim|required');
		$this->form_validation->set_rules('supply_amount[]', 'Supply Amount', 'trim|required');
		
		if($this->form_validation->run() == FALSE){
			$this->load->view('header_view', $data);
			$this->load->view('sidebar_view');
			$this->load->view('supplies_add_view');
			$this->load->view('footer_view');
		}else{
			$add_supplies = $this->supplies->addSupplies($warehouse_id);
			if($add_supplies){
				$this->session->set_flashdata('success', 'Supplies have been added successfully');
				redirect(base_url('supplies'), 'refresh');
			}else{
				$this->session->set_flashdata('error', 'Supplies not added');
				redirect(base_url('supplies'), 'refresh');
			}
		}
	}
	
	
}