<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model{
	
	private $table = "users";
	private $user_data = array();
	
	public function login(){
		$username = $this->input->post("username", true);
		$password = $this->input->post("password", true);
		$this->db->where('user_email', $username);
		$query = $this->db->get($this->table);
		if ($query->num_rows()){
			$row = $query->row_array();
			if ($row['user_pass'] == sha1($password)){
				unset($row['user_pass']);
				$this->user_data = $row;
				return 0;
			}
			return 2;//invalid password
		} else {
			return 1;//invalid username
		}
	}
	
	public function getUser(){
		return $this->user_data;
	}
	
	public function getUsers(){
		$this->db->join('roles', $this->table.'.user_role = roles.role_id');
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
	
	public function getRoles(){
		$query = $this->db->get("roles");
		return $query->result_array();
	}
	
	public function getWarehouses(){
		$query = $this->db->get("warehouses");
		return $query->result_array();
	}
	
	public function addUser(){
		$data = array(
			'user_firstname' => $this->input->post('firstname', true),
			'user_lastname' => $this->input->post('lastname', true),
			'user_email' => $this->input->post('email', true),
			'user_phone' => $this->input->post('phone', true),
			'user_pass' => sha1($this->input->post('npassword', true)),
			'user_role' => $this->input->post('role', true),
			'user_address' => $this->input->post('address', true),
			'user_warehouse' => $this->input->post('warehouse', true),
		);
		return $this->db->insert($this->table, $data);
	}
	
	public function editUser($user){
		$this->db->set('user_firstname', $this->input->post('user_firstname', true));
		$this->db->set('user_lastname', $this->input->post('user_lastname', true));
		$this->db->set('user_email', $this->input->post('user_email', true));
		$this->db->set('user_phone', $this->input->post('user_phone', true));
		$this->db->set('user_address', $this->input->post('user_address', true));
		$this->db->set('user_role', $this->input->post('user_role', true));
		$this->db->set('user_warehouse', $this->input->post('user_warehouse', true));
		$this->db->where('user_id', $user);
		return $this->db->update($this->table);
	}
	
	public function removeUser($user){
		$this->db->trans_start();
		
		$this->db->where('user_id', $user);
		$this->db->delete($this->table);
		
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE) return false;
		else return true;
	}
	
}