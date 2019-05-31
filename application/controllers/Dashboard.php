<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		//print_r($this->session->userdata());
		$data['active'] = 'dashboard';
		$this->load->view("header_view", $data);
		$this->load->view("sidebar_view");
		$this->load->view("dashboard_view");
		$this->load->view("footer_view");
	}
	
}