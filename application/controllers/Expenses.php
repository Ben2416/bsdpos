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
		
		$this->load->view('header_view', $data);
		$this->load->view('sidebar_view');
		$this->load->view('expenses_view');
		$this->load->view('footer_view');
	}
	
}