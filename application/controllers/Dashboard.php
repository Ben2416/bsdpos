<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model("Dashboard_model", "dashboard");
	}
	
	public function index(){
		//print_r($this->session->userdata());
		$data['active'] = 'dashboard';
		$data['invoices'] = $this->dashboard->getInvoices();
		$data['stocks'] = $this->dashboard->getStocks();
		$data['invoices_today'] = $this->dashboard->getInvoicesToday(date('d-m-Y'));
		$data['invoices_month'] = $this->dashboard->getInvoicesMonth(date('m-Y'));
		$data['sales_today'] = $this->dashboard->getSalesToday(date('d-m-Y'));
		$data['sales_month'] = $this->dashboard->getSalesMonth(date('m-Y'));
		$data['expenses_today'] = $this->dashboard->getExpensesToday(date('d-m-Y'));		
		
		
		$data['expenses_week'] = $this->dashboard->getExpensesWeek( date('d-m-Y', strtotime('-7 days')), date('d-m-Y') );
		
		//date('Y-m-d', strtotime('-7 days'))
		$data['pos_sales_week'] = $this->dashboard->getPosSalesWeek( date('d-m-Y', strtotime('-7 days')), date('d-m-Y') );
		$data['credit_sales_week'] = $this->dashboard->getCreditSalesWeek( date('d-m-Y', strtotime('-7 days')), date('d-m-Y') );
		//print_r($data['credit_sales_week']);exit;
		
		$this->load->view("header_view", $data);
		$this->load->view("sidebar_view");
		$this->load->view("dashboard_view");
		$this->load->view("footer_view");
	}
	
}