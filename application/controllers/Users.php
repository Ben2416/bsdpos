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
		$data['roles'] = $this->users->getRoles();
		$data['warehouses'] = $this->users->getWarehouses();
		
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
				//echo 'login successful';
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
		$data['warehouses'] = $this->users->getWarehouses();
		
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
			$add_user = $this->users->addUser();
			if($add_user){
				$this->session->set_flashdata('success', 'User added successfully!');
				redirect(base_url('users'), 'refresh');
			}else{
				$this->session->set_flashdata('error', 'User details not added.');
				redirect(base_url('users'), 'refresh');
			}
		}
		
		
	}
	
	public function edit($user){
		$this->form_validation->set_rules('user_firstname', 'First Name', 'trim|required');
		$this->form_validation->set_rules('user_lastname', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('user_email', 'Email', 'trim|required');
		$this->form_validation->set_rules('user_phone', 'Phone', 'trim|required');
		$this->form_validation->set_rules('user_address', 'Address', 'trim|required');
		if($this->form_validation->run() === FALSE){
			$this->session->set_flashdata('error', 'User values is required.');
			redirect(base_url('users/index'), 'refresh');
		}else{
			$edit_user = $this->users->editUser($user);
			if($edit_user){
				$this->session->set_flashdata('success', 'User edited successfully!');
				redirect(base_url('users/index'), 'refresh');
			}else{
				$this->session->set_flashdata('error', 'User details not modified');
				redirect(base_url('users/index'), 'refresh');
			}
		}
		
	}
	
	public function remove($user){
		$delete_user = $this->users->removeUser($user);
		if($delete_user){
			$this->session->set_flashdata('success', 'Warehouse deleted successfully!');
			redirect(base_url('users/index'), 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Warehouse not deleted');
			redirect(base_url('users/index'), 'refresh');
		}
	}
	
	public function logout(){
		$this->session->sess_destroy();
        $this->session->set_flashdata('info_msg', 'You have been logged out.');
        redirect(base_url(), 'refresh');
	}
	
}