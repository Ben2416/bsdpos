<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> 
		<a href="<?=base_url('dashboard')?>" title="Go to Users" class="tip-bottom">
			<i class="icon-home"></i> Dashboard</a>
		<a href="" class="current"> Invoices</a>
	</div>
	<h1>Invoices</h1>
  </div>
<!--End-breadcrumbs-->

<div class="container-fluid">
	
	<hr>
	<div class="row-fluid">
		<div class="span12">
		
			<div class="widget-box">
				<div class="widget-title">
					<span class="icon"><i class="icon-th"></i></span>
					<h5>Invoices</h5>
				</div>
				<div class="widget-content">
					
					<form class="form-horizontal">
						<div class="controls controls-row">
							<label class="span1 m-wrap">Date</label>
							<input type="text" class="span3 m-wrap datepicker" data-date="<?=date('d-m-Y')?>" data-date-format="dd-mm-yyyy" placeholder="start date" />
							<label class="span1 m-wrap">To</label>
							<input type="text" class="span3 m-wrap datepicker" data-date="01-02-2013" data-date-format="dd-mm-yyyy" placeholder="enddate" />
							<button class="btn btn-primary span3 m-wrap">Get Invoices</button>
						</div>
					</form>
									
					<div class="widget-box">
						<div class="widget-title">
							<span></span>
						</div>
						<div class="widget-content nopadding">
							<table class="table table-bordered data-table">
								<thead>
									<tr>
										<th>Invoice Number</th>
										<th>Category</th>
										<th>Customer Name</th>
										<th>Amount</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($invoices as $invoice): ?>
									<tr>
										<td><a href="<?=base_url('invoice/get/').$invoice['invoice_txn_id']?>"><?=$invoice['invoice_txn_id']?></a></td>
										<td><?=$invoice['invoice_category']?></td>
										<td><?=$invoice['customer_name']?></td>
										<td>&#8358; <?=number_format($invoice['invoice_total'], 2, '.', ',')?></td>
										<td><a href="<?=base_url('invoice/edit/').$invoice['invoice_id']?>"><i class="icon icon-edit"></i> Edit</a> | <a href="<?=base_url('invoice/get/').$invoice['invoice_id']?>"><i class="icon icon-trash"></i> Remove</a></td>
									</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			
		</div>
		
		
	</div>
	
</div>

