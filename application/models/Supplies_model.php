<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplies_model extends CI_Model{
	
	private $table = "supplies";
	
	public function getWarehouses(){
		$query = $this->db->get('warehouses');
		return $query->result_array();
	}
	
	public function getSupplies(){
		$this->db->join('products', $this->table.'.supply_item=products.product_id');
		$this->db->join('suppliers', $this->table.'.supply_supplier=suppliers.supplier_id');
		$this->db->order_by('supply_batch_id', 'DESC');
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
	
	public function getLastSupplyBatchId(){
		$this->db->select('supply_batch_id');
		$this->db->from($this->table);
		$this->db->order_by('supply_id', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		if($query->num_rows() > 0)
			return $query->row()->supply_batch_id;
		else
			return 1000000;
	}
	
	public function addSupplies($warehouse_id){
		$this->db->trans_start();
		
		$items = count($this->input->post("supply_item[]"));
		$supply_items = array();
		$stock_updates = array();
		$supplier = array(
			'supplier_name' => $this->input->post('supplier_name', true),
			'supplier_phone' => $this->input->post('supplier_phone', true),
			'supplier_email' => $this->input->post('supplier_email', true),
			'supplier_address' => $this->input->post('supplier_address', true)
		);
		$udata = array();
		foreach($supplier as $k=>$v){
			$udata[] = $k.'='."'".$v."'"; 
		}
		$sql = $this->db->insert_string('suppliers', $supplier)." ON DUPLICATE KEY UPDATE ".implode(', ', $udata);
		$insert = $this->db->query($sql);
		//$this->db->insert('suppliers', $supplier);
		$supplier_id = $this->db->insert_id();
		
		for($i=0; $i<$items; $i++){
			$supply_items[] = array(
				'supply_date' => $this->input->post('supply_date', true),
				'supply_item' => $this->input->post('supply_item', true)[$i],
				'supply_quantity' => $this->input->post('supply_quantity', true)[$i],
				'supply_rate' => $this->input->post('supply_rate', true)[$i],
				'supply_amount' => $this->input->post('supply_amount', true)[$i],
				'supply_warehouse' => $warehouse_id,
				'supply_supplier' => $supplier_id,
				'supply_batch_id' => $this->getLastSupplyBatchId()+1
			);
			
			$stock_updates[] = array(
				'stock_product' => $this->input->post('supply_item', true)[$i],
				'stock_quantity' => $this->input->post('supply_quantity')[$i],
				'stock_warehouse' => $warehouse_id
			);
		}
		
		$this->db->insert_batch($this->table, $supply_items);
		
		//update stocks
		foreach($stock_updates as $su){
			$this->db->set('stock_quantity', 'stock_quantity+'.$su['stock_quantity'], FALSE);
			$this->db->where('stock_product', $su['stock_product']);
			$this->db->where('stock_warehouse', $su['stock_warehouse']);
			$update = $this->db->update('stocks');
			if($this->db->affected_rows() == 0){
				$this->db->set('stock_quantity', $su['stock_quantity']);
				$this->db->set('stock_product', $su['stock_product']);
				$this->db->set('stock_warehouse', $su['stock_warehouse']);
				$this->db->insert('stocks');
			}
		}
		
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE) return false;
		else return true;
	}
	
}