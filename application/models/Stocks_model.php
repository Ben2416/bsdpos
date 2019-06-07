<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stocks_model extends CI_Model{
	
	private $table = "stocks";
	
	public function getWarehouses(){
		$query = $this->db->get('warehouses');
		return $query->result_array();
	}
	
	public function getStocks(){
		$this->db->join('products', $this->table.'.stock_product=products.product_id');
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
	
	public function getProducts(){
		$query = $this->db->get('products');
		return $query->result_array();
	}
	
	public function stockTransfer($stock_transfer){
		$this->db->trans_start();
		
		foreach($stock_transfer as $st){
			//log stock transfers
			$data = array(
				'stock_transfer_date' => $st['stock_date'],
				'stock_transfer_product' => $st['stock_product'],
				'stock_transfer_quantity' => $st['stock_quantity'],
				'stock_transfer_from' => $st['from_warehouse'],
				'stock_transfer_to' => $st['to_warehouse']
			);
			$this->db->insert('stock_transfers', $data);
			
			//remove from warehouse
			$this->db->set('stock_quantity', 'stock_quantity-'.$st['stock_quantity'], FALSE);
			$this->db->where('stock_warehouse', $st['from_warehouse']);
			$this->db->where('stock_product', $st['stock_product']);
			$this->db->update($this->table);
			
			//add to warehouse
			
			$idata = array(
				'stock_product' => $st['stock_product'],
				'stock_quantity' => $st['stock_quantity'],
				'stock_warehouse' => $st['to_warehouse']
			);
			$udata = array();
			foreach($idata as $k=>$v){
				if($k == 'stock_quantity')
					$udata[] = $k.'='."stock_quantity+".$v; 
				else
					$udata[] = $k.'='."'".$v."'"; 
			}
			$sql = $this->db->insert_string($this->table,$idata)." ON DUPLICATE KEY UPDATE ".implode(', ',$udata) ;
			$this->db->query($sql);
		}
		
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE) return false;
		else return true;
	}
	
}