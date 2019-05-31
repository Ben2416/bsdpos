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
		
		$data['supplies'] = array();
		
		$this->load->view('header_view', $data);
		$this->load->view('sidebar_view');
		$this->load->view('supplies_view');
		$this->load->view('footer_view');
	}
	
	public function add(){
		$add_supply = $this->supplies->addSupply();
		if($add_supply){
			$this->session->set_flashdata('success', 'Supplies have been added successfully');
			redirect(base_url('supplies'));
		}else{
			$this->session->set_flashdata('error', 'Supplies not added');
			redirect(base_url('supplies'));
		}
	}
	
	
}