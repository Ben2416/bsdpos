<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expenses_model extends CI_Model{
	
	private $table = "expenses";
	
	public function getWarehouses(){
		$query = $this->db->get('warehouses');
		return $query->result_array();
	}
	
	public function getExpenses(){
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
	
	public function addExpense(){
		if(array_key_exists('new_expense_item', $this->input->post()))
			$expense_item = $this->input->post('new_expense_item', true);
		else
			$expense_item = $this->input->post('expense_item', true);
		$data = array(
			'expense_date' => $this->input->post('expense_date', true),
			'expense_warehouse' => $this->input->post('expense_warehouse', true),
			'expense_class' => $this->input->post('expense_class', true),
			'expense_item' => $expense_item,
			'expense_amount' => $this->input->post('expense_amount', true)
		);
		return $this->db->insert($this->table, $data);
	}
	
	public function getExpenseItems($cat){
		$this->db->select("distinct(expense_item)");
		$this->db->where('expense_class', $cat);
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
	
}