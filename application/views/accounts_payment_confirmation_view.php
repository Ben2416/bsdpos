<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> 
		<a href="<?=base_url('dashboard')?>" title="Go to Dashboard" class="tip-bottom">
			<i class="icon-home"></i> Dashboard</a>
		<a href="<?=base_url('accounts')?>" title="Accounts" class="tip-bottom"> Accounts</a>
		<a href="" class="current"> Payment Confirmation</a>
	</div>
	<h1>Payment Confirmation</h1>
  </div>
<!--End-breadcrumbs-->

<div class="container-fluid">
	
	<hr>
	<div class="row-fluid">
		<div class="span12">
			<div class="widget-box">
				<div class="widget-title">
					<span class="icon"><i class="icon-th"></i></span>
					<h5>Invoice Details</h5>
				</div>
				<div class="widget-content">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Invoice Number</th>
								<th>Customer Info</th>
								<th>Sales Amount</th>
								<th>Amount Paid</th>
								<th>Balance</th>
								<th>Remark</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><?=$invoice_id?></td>
								<td>Mr. Simeon Afolabi</td>
								<td>$12,000</td>
								<td>$2,000</td>
								<td>10,000</td>
								<td><span class="label label-info">Partly Paid</span></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span6">
		
			<div class="widget-box">
				<div class="widget-title">
					<span class="icon"><i class="icon-money"></i></span>
					<h5>Payment Confirmation</h5>
				</div>
				<div class="widget-content nopadding">
					<form class="form-horizontal">
						<div class="control-group">
							<label class="control-label">Invoice Number : </label>
							<div class="controls">
								<input type="text" class="span11" placeholder="Product name" name="product_name" value="<?=$invoice_id?>" disabled >
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Payment Type: </label>
							<div class="controls">
								<select name="payment_type">
									<option>Cash</option>
									<option>Cheque</option>
									<option>Bank Transfer</option>
									<option>Bank Deposit</option>
								</select>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Payment Amount : </label>
							<div class="controls">
								<input type="number" min="0" class="span11" placeholder="Payment Amount" name="product_name" value="" >
							</div>
						</div>
						<div class="form-actions">
							<button type="submit" class="btn btn-success">Add Payment</button>
						</div>
					</form>
				</div>
			</div>
		
		</div>
		
		<div class="span6">
			<div class="widget-box">
				<div class="widget-title">
					<span class="icon"><i class="icon-bar-chart"></i></span>
					<h5>Payment History</h5>
				</div>
				<div class="widget-content">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Date</th>
								<th>Amount Paid</th>
								<th>Mode of Payment</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>31-05-2019</td>
								<td>2,000</td>
								<td>Bank Transfer</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	
	</div>

</div>