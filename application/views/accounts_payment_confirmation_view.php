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
					<h5><?=($invoice['invoice_type']=='CREDIT')?'Invoice':'Receipt'?> Details</h5>
				</div>
				<div class="widget-content">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th><?=($invoice['invoice_type']=='CREDIT')?'Invoice':'Receipt'?> Number</th>
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
								<td><?=$invoice['customer_name']?></td>
								<td>&#8358; <?=$invoice['invoice_total']?></td>
								<td>&#8358; <?=number_format($amount_paid, 2, '.', ',')?></td>
								<td>&#8358; <?=number_format($balance, 2, '.', ',')?></td>
								<td>
								<?php if($balance == $invoice['invoice_total']){
										echo '<span class="label label-important">Not Paid</span>';
									}elseif($amount_paid > 0 && $amount_paid < $invoice['invoice_total']){
										echo '<span class="label label-info">Partly Paid</span>';
									}elseif($amount_paid == $invoice['invoice_total']){
										echo '<span class="label label-success">Fully Paid</span>';
									}?>
								</td>
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
					<form class="form-horizontal" method="post" action="<?=base_url('accounts/payment_confirmation/').$invoice_id?>">
						<?=validation_errors()?>
						<div class="control-group">
							<label class="control-label"><?=($invoice['invoice_type']=='CREDIT')?'Invoice':'Receipt'?> Number : </label>
							<div class="controls">
								<input type="text" class="span11" placeholder="Payment Invoice" name="payment_invoice" value="<?=$invoice_id?>" disabled >
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Date: </label>
							<div class="controls">
								<input type="text" name="payment_date" class="datepicker span11" data-date-format="dd-mm-yyyy" />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Payment Type: </label>
							<div class="controls">
								<select name="payment_type" class="span11">
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
								<input type="number" min="0" max="<?=($balance)?>" class="span11" placeholder="Payment Amount" name="payment_amount" value="" >
							</div>
						</div>
						<?php if($amount_paid != $invoice['invoice_total']): ?>
						<div class="form-actions">
							<button type="submit" class="btn btn-success">Add Payment</button>
						</div>
						<?php endif; ?>
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
						<?php foreach($payments as $pay): ?>
							<tr>
								<td><?=$pay['payment_date']?></td>
								<td><?=number_format($pay['payment_amount'], 2, '.', ',')?></td>
								<td><?=$pay['payment_type']?></td>
							</tr>
						<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	
	</div>

</div>