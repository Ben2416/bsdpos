<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller{
	
	//1 Business Owner
	//2 Warehouse manager 
	//3 Stock manager
	//4 Accountant
	//5 Sales manager
	//6 Sales rep
	
	public function __construct(){
		parent::__construct();
		$this->load->model('Users_model', 'users');
	}
	
	public function index(){
		$data['active'] = 'users';
		$data['users'] = $this->users->getUsers();
		$this->load->view("header_view", $data);
		$this->load->view("sidebar_view");
		$this->load->view("users_view");
		$this->load->view("footer_view");
	}
	
	public function login(){
		
		$this->form_validation->set_error_delimiters('','');
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		
		if($this->form_validation->run() == FALSE ){
			$this->load->view("users_login_view");
		}else{
			$login = $this->users->login();
			if($login == 0){
				echo 'login successful';
				$user = $this->users->getUser();
				$this->session->set_userdata($user);
				$this->session->set_userdata('loggedin', true);
				$this->session->set_flashdata('info_msg', 'Welcome!');
				redirect(base_url("dashboard"));
				/*****************
				handle pages for different roles here
				**************/
			}else{
				echo 'invalid username or password';
				//redirect(base_url('users/login'), 'refresh');
			}
		}
		
		//$this->load->view("users_login_view");
	}
	
	public function add(){
		$data['active'] = 'users';
		$data['roles'] = $this->users->getRoles();
		
		$this->form_validation->set_error_delimiters('','');
		$this->form_validation->set_rules('firstname', "First name", 'trim|required');
		$this->form_validation->set_rules('lastname', "Last name", 'trim|required');
		$this->form_validation->set_rules('email', "Email", 'trim|required');
		$this->form_validation->set_rules('phone', "Phone", 'trim|required');
		$this->form_validation->set_rules('npassword', "New Password", 'trim|required');
		$this->form_validation->set_rules('cpassword', "Confirm Password", 'trim|required|matches[npassword]');
		$this->form_validation->set_rules('address', "Address", 'trim|required');
		
		if($this->form_validation->run() == FALSE){
			$this->load->view("header_view", $data);
			$this->load->view("sidebar_view");
			$this->load->view("users_add_view");
			$this->load->view("footer_view");
		}else{
			redirect(base_url('users'), 'refresh');
		}
		
		
	}
	
	public function edit($id){
		
	}
	
	public function remove($id){
		
	}
	
	public function logout(){
		$this->session->sess_destroy();
        $this->session->set_flashdata('info_msg', 'You have been logged out.');
        redirect(base_url(), 'refresh');
	}
	
}