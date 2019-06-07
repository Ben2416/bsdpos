<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model("Products_model", "products");
	}
	
	public function index(){
		$data['active'] = 'products';
		$data['products'] = $this->products->getProducts();
		$this->load->view("header_view", $data);
		$this->load->view("sidebar_view");
		$this->load->view("products_view");
		$this->load->view("footer_view");
	}
	
	public function add(){
		$data['active'] = 'products';
		$data['warehouses'] = $this->products->getWarehouses();
		
		$this->form_validation->set_error_delimiters('<div class="alert alert-error"><button class="close" data-dismiss="alert">×</button>','</div>');
		$this->form_validation->set_rules('product_name', "Product name", 'trim|required');
		$this->form_validation->set_rules('product_description', "Product Description", 'trim|required');
		$this->form_validation->set_rules('wholesale_price', "Wholesale Price", 'trim|required');
		$this->form_validation->set_rules('supply_price', "Supply Price", 'trim|required');
		$this->form_validation->set_rules('retail_price', "Retail Price", 'trim|required');
		$this->form_validation->set_rules('product_quantity', "Product Quantity", 'trim|required');
		$this->form_validation->set_rules('product_warehouse', "Product Warehouse", 'trim|required');
		
		if($this->form_validation->run() == FALSE){
			$this->load->view("header_view", $data);
			$this->load->view("sidebar_view");
			$this->load->view("products_add_view");
			$this->load->view("footer_view");
		}else{
			$add_product = $this->products->addProduct();
			if($add_product){
				$this->session->set_flashdata('success', 'Product added successfully!');
				redirect(base_url('products'), 'refresh');
			}else{
				$this->session->set_flashdata('error', 'Product not added');
				redirect(base_url('products'), 'refresh');
			}
		}
	}
	
	public function edit($product_id){
		$data['active'] = 'products';
		$data['warehouses'] = $this->products->getWarehouses();
		$data['product'] = $this->products->getProduct($product_id)[0];
		$data['product_id'] = $product_id;
		
		
		$this->form_validation->set_error_delimiters('<div class="alert alert-error"><button class="close" data-dismiss="alert">×</button>','</div>');
		$this->form_validation->set_rules('product_name', "Product name", 'trim|required');
		$this->form_validation->set_rules('product_description', "Product Description", 'trim|required');
		//$this->form_validation->set_rules('product_price', "Product Price", 'trim|required');
		$this->form_validation->set_rules('wholesale_price', "Wholesale Price", 'trim|required');
		$this->form_validation->set_rules('supply_price', "Supply Price", 'trim|required');
		$this->form_validation->set_rules('retail_price', "Retail Price", 'trim|required');
		$this->form_validation->set_rules('product_quantity', "Product Quantity", 'trim|required');
		$this->form_validation->set_rules('product_warehouse', "Product Warehouse", 'trim|required');
		
		if($this->form_validation->run() == FALSE){
			$this->load->view("header_view", $data);
			$this->load->view("sidebar_view");
			$this->load->view("products_edit_view");
			$this->load->view("footer_view");
		}else{
			$edit_product = $this->products->editProduct($product_id);
			if($edit_product){
				$this->session->set_flashdata('success', 'Product edited successfully!');
				redirect(base_url('products'), 'refresh');
			}else{
				$this->session->set_flashdata('error', 'Product not edited');
				redirect(base_url('products'), 'refresh');
			}
		}
	}
	
	public function delete($product_id){
		$delete_product = $this->products->deleteProduct($product_id);
		if($delete_product){
			$this->session->set_flashdata('success', 'Product deleted successfully!');
			redirect(base_url('products'), 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Product not deleted');
			redirect(base_url('products'), 'refresh');
		}
	}
	
	//auto complete
	public function getProduct(){
		echo json_encode( $this->products->getProductsWhere( $this->input->post('product', true) )  );
	}
	
	//auto complete
	public function getProductWithStock(){
		echo json_encode( $this->products->getProductsWithStockWhere( $this->input->post('product', true), $this->input->post('warehouse', true) )  );
	}
	
}