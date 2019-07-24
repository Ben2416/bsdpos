<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stocks_model extends CI_Model{
	
	private $table = "stocks";
	
	public function getWarehouses(){
		if($this->session->user_role != 1 )
			$this->db->where('warehouse_id', $this->session->user_warehouse);
		$query = $this->db->get('warehouses');
		return $query->result_array();
	}
	
	public function getStocks(){
		$this->db->join('products', $this->table.'.stock_product=products.product_id');
		if($this->session->user_role != 1 )
			$this->db->where('stock_warehouse', $this->session->user_warehouse);
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
	
	public function getProducts(){
		if($this->session->user_role != 1 )
			$this->db->where('product_warehouse', $this->session->user_warehouse);
		$query = $this->db->get('products');
		return $query->result_array();
	}
	
	public function stockTransfer($stock_transfer){
		$this->db->trans_start();
		
		foreach($stock_transfer as $st){
			//log stock transfers
			$data = array(
				'stock_transfer_date' => date('d-m-Y'),//$st['stock_date'],
				'stock_transfer_product' => $st['stock_product'],
				'stock_transfer_quantity' => $st['stock_quantity'],
				'stock_transfer_price' => $st['stock_price'],
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
	
	public function stockReturn($invoice){
		$this->db->trans_start();
		//add stock return
		$stock_return = array(
			'stock_return_invoice' => $invoice['invoice_txn_id'],
			'stock_return_sold' => $this->input->post('return_amount'), 
			'stock_return_amount' => $invoice['invoice_total'],
			'stock_return_date' => $this->input->post('return_date'),
			'stock_return_warehouse' => $invoice['invoice_warehouse']
		);
		$this->db->insert('stock_returns', $stock_return);
		
		//add stock return items
		$items = count($this->input->post('item[]'));
		for($i=0; $i<$items; $i++){
			$stock_return_items[] = array(
				'stock_return_item_invoice' => $invoice['invoice_txn_id'],
				'stock_return_item' => $this->input->post('item[]')[$i],
				'stock_return_item_rate' => $this->input->post('rate[]')[$i],
				'stock_return_item_supplied' => $this->input->post('quantity[]')[$i],
				'stock_return_item_returned' => $this->input->post('returned[]')[$i],
				'stock_return_item_amount' => $this->input->post('total[]')[$i],
			);
		}
		$this->db->insert_batch('stock_return_items', $stock_return_items);
		
		//update stocks
		for($j=0; $j<$items; $j++){
			$this->db->set('stock_quantity', 'stock_quantity+'.$this->input->post('returned[]')[$j], FALSE);
			$this->db->where('stock_product', $this->input->post('item[]')[$j]);
			$this->db->where('stock_warehouse', $invoice['invoice_warehouse']);
			$this->db->update($this->table);
		}
		
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE) return false;
		else return true;
	}

	
	public function getStockReturns(){
		$this->db->join('invoices', 'stock_returns.stock_return_invoice=invoices.invoice_txn_id');
		$this->db->join('customers', 'invoices.invoice_client=customers.customer_id');
		if($this->session->user_role != 1 )
			$this->db->where('stock_return_warehouse', $this->session->user_warehouse);
		$query = $this->db->get('stock_returns');
		return $query->result_array();
	}
	
	public function getStockTransfers(){
		$this->db->select('stock_transfers.*, products.product_name, products.product_supply_price, w1.warehouse_name as warehouse_from, w2.warehouse_name as warehouse_to');
		$this->db->join('warehouses as w1', 'stock_transfers.stock_transfer_from=w1.warehouse_id');
		$this->db->join('warehouses as w2', 'stock_transfers.stock_transfer_to=w2.warehouse_id');
		$this->db->join('products', 'stock_transfers.stock_transfer_product=products.product_id');
		if($this->session->user_role != 1 ){
			$this->db->where('stock_transfer_from', $this->session->user_warehouse);
			$this->db->or_where('stock_transfer_to', $this->session->user_warehouse);
		}
		$query = $this->db->get('stock_transfers');
		return $query->result_array();
	}
	
	
	public function getReturnInvoice($invoice_id){
		$this->db->join('invoices', 'stock_returns.stock_return_invoice=invoices.invoice_txn_id');
		$this->db->join('customers', 'invoices.invoice_client=customers.customer_id');
		$this->db->join('warehouses', 'invoices.invoice_warehouse=warehouses.warehouse_id');
		$this->db->where('stock_return_invoice', $invoice_id);
		if($this->session->user_role != 1 )
			$this->db->where('stock_return_warehouse', $this->session->user_warehouse);
		$this->db->limit(1);
		$query = $this->db->get('stock_returns');
		return $query->result_array();
	}
	
	public function getReturnInvoiceItems($invoice_id){
		$this->db->join('products', 'stock_return_items.stock_return_item=products.product_id');
		$this->db->where('stock_return_item_invoice', $invoice_id);
		$query = $this->db->get('stock_return_items');
		return $query->result_array();
	}
	
	public function updateStock($product, $warehouse, $quantity){
		$this->db->set('stock_quantity', $quantity);
		$this->db->where('stock_product', $product);
		$this->db->where('stock_warehouse', $warehouse);
		return $this->db->update($this->table);
	}
	
	public function deleteStock($product, $warehouse){
		$this->db->where('stock_product', $product);
		$this->db->where('stock_warehouse', $warehouse);
		return $this->db->delete($this->table);
	}
	
}