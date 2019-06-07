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
				<div class="widget-title"> <span class="icon"> <i class="icon-briefcase"></i> </span>
					<h5>EDDINHO INTERNATIONAL</h5>
				</div>
				<div class="widget-content">
					<div class="row-fluid">
						<div class="span6">
							<table class="">
								<tbody>
									<tr>
										<td><h4>Eddinho International</h4></td>
									</tr>
									<tr>
										<td>Abuja</td>
									</tr>
									<tr>
										<td>Federal Capital Territory</td>
									</tr>
									<tr>
										<td>Mobile Phone: +4530422244</td>
									</tr>
									<tr>
										<td >sales@eddinho.com</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="span6">
							<table class="table table-bordered table-invoice">
								<tbody>
									<tr>
										<tr>
											<td class="width30">Invoice ID:</td>
											<td class="width70"><strong><?=$invoice['invoice_txn_id']?></strong></td>
										</tr>
										<tr>
											<td>Issue Date:</td>
											<td><strong><?=$invoice['invoice_issue_date']?></strong></td>
										</tr>
										<tr>
											<td>Due Date:</td>
											<td><strong><?=$invoice['invoice_due_date']?></strong></td>
										</tr>
										<td class="width30">Client Address:</td>
											<td class="width70"><i class="icon icon-list-alt"></i> Name: <strong><?=$invoice['customer_name']?></strong> <br>
											<i class="icon icon-home"></i> Address: <?=$invoice['customer_address']?> <br/>
											<i class="icon icon-phone"></i> Phone: <?=$invoice['customer_phone']?> <br/>
											<i class="icon icon-envelope"></i> Email: <?=$invoice['customer_email']?> <br/>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span12">
							<table class="table table-bordered table-invoice-full">
								<thead>
									<tr>
										<th class="head0">Item</th>
										<th class="head1">Quantity</th>
										<th class="head0 right">Rate</th>
										<th class="head1 right">Amount</th>
									</tr>
								</thead>
							<tbody>
								<?php foreach($invoice_items as $ii): ?>
								<tr>
									<td><?=$ii['product_name']?></td>
									<td><?=$ii['invoice_item_quantity']?></td>
									<td class="right">&#8358; <?=$ii['invoice_item_price']?></td>
									<td class="right"><strong>&#8358; <?=$ii['invoice_item_total']?></strong></td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
						<table class="table table-bordered table-invoice-full">
							<tbody>
								<tr>
									<td class="msg-invoice" width="70%"><h4>Payment Terms: </h4>
										<?=($invoice['invoice_payterms']==1)?'Payment on Delivery':'Payment on return'?>
									</td>
									<td class="right" width="12%"><strong>Subtotal</strong> <br>
										<strong>Tax </strong> <br>
										<strong>Discount</strong>
									</td>
									<td class="right" width="18%"><strong>&#8358; <?=$invoice['invoice_subtotal']?> <br>
										&#8358; <?=$invoice['invoice_tax']?> <br>
										&#8358; <?=$invoice['invoice_discount']?></strong>
									</td>
								</tr>
							</tbody>
						</table>
						<div class="pull-right">
							<h4><span>Grand Total:</span> &#8358; <?=$invoice['invoice_total']?></h4>
						</div>
					</div>
				</div>
			</div>

			
			
		</div>
		
		
	</div>
	
</div>

