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
							<hr>
							<table width="100%">
								<tbody>
									<tr><td><label class="control-label">Select Warehouse</label></td></tr>
									<tr>
										<td>
											<select class="">
											<?php foreach($warehouses as $wh): ?>
												<option value="<?=$wh['warehouse_id']?>"><?=$wh['warehouse_name']?></option>
											<?php endforeach; ?>
											</select>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="span6">
							<table class="table table-bordered table-invoice">
								<tbody>
									<tr>
										<td class="width30">Invoice ID:</td>
										<td class="width70"><strong><input type="text" name="invoice_id" placeholder="invoice_id" /></strong></td>
									</tr>
									<tr>
										<td>Issue Date:</td>
										<td><strong><input type="text" class="datepicker" data-date="<?=date('d-m-Y')?>" data-date-format="dd-mm-yyyy" placeholder="issue date" /></strong></td>
									</tr>
									<tr>
										<td>Due Date:</td>
										<td><strong><input type="text" class="datepicker" data-date="<?=date('d-m-Y')?>" data-date-format="dd-mm-yyyy" placeholder="due date" /></strong></td>
									</tr>
									<tr>
										<td class="width30">Client Address:</td>
										<td class="width70">
											<table class="">
												<tbody>
													<tr><td>Name: </td><td><strong><input type="text" placeholder="Customer" /></strong> </td></tr>
													<tr><td>Address: </td><td><textarea name="address" placeholder="address"></textarea> </td></tr>
													<tr><td>Contact No: </td><td><input type="text" placeholder="Phone" /> </td></tr>
													<tr><td>Email: </td><td><input type="email" placeholder="email" /> </td></tr>
												</tbody>
											</table>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span12">
							<table class="table table-bordered table-invoice-full" name="items_table" id="items_table">
								<thead>
									<tr>
										<th class="head0">Item</th>
										<th class="head1">Quantity</th>
										<th class="head0 right">Rate</th>
										<th class="head1 right">Amount</th>
										<th class="head0">Remove</th>
									</tr>
								</thead>
							<tbody>
								<tr>
									<td><input type="text" name="item_name[]" id="item_name[]" placeholder="Item name" /><input type="hidden" name="item[]" /></td>
									<td><input type="number" class="qty" name="quantity[]" value="1" min="1" placeholder="Quantity" /></td>
									<td class="right">
										<select class="span6" name="item_price[]">
											<option>retail price</option>
											<option>wholesale price</option>
											<option>supply price</option>
										</select>  &nbsp;
										<input type="text" name="rate[]" value="0" placeholder="rate" class="span6" disabled/>
									</td>
									<td class="right"><div id="items_amount[]"><strong>$ </strong></div><input type="hidden" name="amount[]" /></td>
									<td> <a class="btn btn-danger"  onClick="$(this).closest('tr').remove();"><i class="icon icon-trash"></i></a></td>
								</tr>
							</tbody>
						</table>
						<div class="controls controls-row">
							<button class="btn btn-primary" id="add_item" ><i class="icon icon-plus"></i> Add Item to List</button>
						</div>
						<hr>
						<table class="table table-bordered table-invoice-full">
							<tbody>
								<tr>
									<td class="msg-invoice" width="85%"><h4>Payment method: </h4>
										<a href="#" class="tip-bottom" title="Cash Deposit">Cash Deposit</a> |  <a href="#" class="tip-bottom" title="Bank Transfer">Bank Transfer</a> </td>
									<td class="right"><strong>Subtotal</strong> <br>
										<strong>Tax (5%)</strong> <br>
										<strong>Discount</strong></td>
									<td class="right"><strong>$16,800 <br>
										$100 <br>
										$50</strong></td>
								</tr>
							</tbody>
						</table>
						<div class="">
							<table class="table table-bordered span6">
								<tbody>
									<tr>
										<td>
											<div class="form-controls">
												<label class="control-label span12">Payment Terms: </label><br/>
												<select class="control span12">
													<option>Payment on Delivery</option>
													<option>Payment on return</option>
												</select>
											</div>
										</td>
									</tr>	
								</tbody>
							</table>
						</div>
						<div class="pull-right">
							<h4><span>Grand Total:</span> $<span id="gtotal">16,850.00<span></h4>
							<br>
							<a class="btn btn-primary btn-large pull-right" href="">Pay Invoice</a> </div>
						</div>
					</div>
				</div>
			</div>

			
			
		</div>
		
		
	</div>
	
</div>

