<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Warehouse extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model("Warehouse_model", "warehouse");
	}
	
	public function index(){
		$data['active'] = 'warehouse';
		$data['warehouses'] = $this->warehouse->getWarehouses();
		$this->load->view("header_view", $data);
		$this->load->view("sidebar_view");
		$this->load->view("warehouses_view");
		$this->load->view("footer_view");
	}
	
	public function add(){
		$data['active'] = 'warehouse';
		
		$this->form_validation->set_error_delimiters('','');
		$this->form_validation->set_rules('warehouse_name', "Warehouse name", 'trim|required');
		$this->form_validation->set_rules('warehouse_address', "Warehouse Address", 'trim|required');
		
		if($this->form_validation->run() == FALSE){
			$this->load->view("header_view", $data);
			$this->load->view("sidebar_view");
			$this->load->view("warehouse_add_view");
			$this->load->view("footer_view");
		}else{
			$add_warehouse = $this->warehouse->addWarehouse();
			if($add_warehouse){
				$this->session->set_flashdata('success', 'Warehouse added successfully.');
				redirect(base_url('warehouse'), 'refresh');
			}else{
				$this->session->set_flashdata('error', 'Warehouse not added');
				redirect(base_url('warehouse'), 'refresh');
			}
				
		}
	}
	
	public function edit($id){
		
	}
	
	public function remove($id){
		
	}
	
	public function warehouses(){
		
	}
	
}