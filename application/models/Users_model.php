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
	
}