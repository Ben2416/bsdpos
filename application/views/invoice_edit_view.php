<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> 
		<a href="<?=base_url('dashboard')?>" title="Go to Users" class="tip-bottom">
			<i class="icon-home"></i> Dashboard</a>
		<a href="" class="current"> <?=($invoice_type=='CREDIT')?'Invoices':'Receipts'?></a>
	</div>
	<h1><?=($invoice_type=='CREDIT')?'Invoices':'Receipts'?></h1>
  </div>
<!--End-breadcrumbs-->

<div class="container-fluid">
	
	<hr>
	<div class="row-fluid">
		<div class="span12">
		
			<form method="post" action="<?=base_url('invoice/edit/').$invoice_category.'/'.$invoice_type.'/'.$invoice_receipt_id?>" >
			
			<?php echo validation_errors(); ?>
			
			<div class="widget-box">
				<div class="widget-title"> <span class="icon"> <i class="icon-briefcase"></i> </span>
					<h5><?=($invoice_type=='CREDIT')?'Invoice':'Receipt'?></h5>
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
											<select class="" name="invoice_warehouse">
												<option value="<?=$invoicee['warehouse_id']?>"><?=$invoicee['warehouse_name']?></option>
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
										<td class="width30"><?=($invoice_type=='CREDIT')?'Invoice':'Receipt'?> ID:</td>
										<td class="width70"><strong><input type="text" name="invoice_id" placeholder="invoice_id" value="<?=$invoice_receipt_id?>" disabled /></strong></td>
									</tr>
									<tr>
										<td>Issue Date:</td>
										<td><strong><input type="text" name="invoice_issue_date" class="datepicker" data-date="<?=date('d-m-Y')?>" data-date-format="dd-mm-yyyy" placeholder="issue date" value="<?=(empty(set_value('invoice_issue_date')) ? $invoicee['invoice_issue_date']:set_value('invoice_issue_date'))?>" requried/></strong></td>
									</tr>
									<tr>
										<td>Due Date:</td>
										<td><strong><input type="text" name="invoice_due_date" class="datepicker" data-date="<?=date('d-m-Y')?>" data-date-format="dd-mm-yyyy" placeholder="due date" value="<?=(empty(set_value('invoice_due_date')) ? $invoicee['invoice_due_date']:set_value('invoice_due_date'))?>" required/></strong></td>
									</tr>
									<tr>
										<td class="width30">Client Address:</td>
										<td class="width70">
											<table class="">
												<tbody>
													<tr><td>Name: </td><td><strong><input type="text" name="invoice_customer_name" placeholder="Customer" value="<?=(empty(set_value('invoice_customer_name')) ? $invoicee['customer_name']:set_value('invoice_customer_name'))?>" required /></strong> </td></tr>
													<tr><td>Phone: </td><td><input type="text" name="invoice_customer_phone" placeholder="Phone" value="<?=(empty(set_value('invoice_customer_phone')) ? $invoicee['customer_phone']:set_value('invoice_customer_phone'))?>" required /> </td></tr>
													<tr><td>Email: </td><td><input type="email" name="invoice_customer_email" placeholder="email" value="<?=(empty(set_value('invoice_customer_email')) ? $invoicee['customer_email']:set_value('invoice_customer_email'))?>" required /> </td></tr>
													<tr><td>Address: </td><td><textarea name="invoice_customer_address" placeholder="address" required><?=(empty(set_value('invoice_customer_address')) ? $invoicee['customer_address']:set_value('invoice_customer_address'))?></textarea> </td></tr>
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
							<?php foreach($invoicee_items as $ii): ?>
								<tr>
									<td><input type="text" name="item_name[]" id="item_name[]" placeholder="Item name" required="required" value="<?=$ii['product_name']?>" /><input type="hidden" name="item[]" value="<?=$ii['product_id']?>" /></td>
									<td><input type="number" class="qty" name="quantity[]" value="<?=$ii['invoice_item_quantity']?>" min="1" placeholder="Quantity" /></td>
									<td class="right">
										<select class="span6" name="item_price[]" id="item_price[]" required="required">
											<option value="<?=$ii['product_retail_price']?>" <?=($ii['product_retail_price']==$ii['invoice_item_price'])?'selected':''?>>Retail Price</option>
											<option value="<?=$ii['product_wholesale_price']?>" <?=($ii['product_wholesale_price']==$ii['invoice_item_price'])?'selected':''?>>Wholesale Price</option>
										</select>  &nbsp;
										<input type="text" name="rate[]" placeholder="rate" value="<?=$ii['invoice_item_price']?>" class="span6" disabled/>
									</td>
									<td class="right"><div id="items_amount[]"><strong>&#8358; </strong></div><input type="hidden" name="amount[]" /></td>
									<td> <a name="item_remove[]" class="btn btn-danger"  onClick="//$(this).closest(\'tr\').remove();"><i class="icon icon-trash"></i></a></td>
								</tr>
							<?php endforeach; ?>
							
							
								<!--<tr>
									<td><input type="text" name="item_name[]" id="item_name[]" placeholder="Item name" /><input type="hidden" name="item[]" /></td>
									<td><input type="number" class="qty" name="quantity[]" value="1" min="1" placeholder="Quantity" /></td>
									<td class="right">
										<select class="span6" name="item_price[]" id="item_price[]">
										</select>  &n`````````bsp;
										<input type="text" name="rate[]" value="0" placeholder="rate" class="span6" disabled/>
									</td>
									<td class="right"><div id="items_amount[]"><strong>$ </strong></div><input type="hidden" name="amount[]" /></td>
									<td> <a class="btn btn-danger"  onClick="$(this).closest('tr').remove();"><i class="icon icon-trash"></i></a></td>
								</tr>-->
							</tbody>
						</table>
						<div class="controls controls-row">
							<button class="btn btn-primary" id="add_item" ><i class="icon icon-plus"></i> Add Item to List</button>
						</div>
						<hr>
						<table class="table table-bordered table-invoice-full">
							<tbody>
								<tr>
									<td class="msg-invoice" width="70%">
										<?php if($invoice_type == "CREDIT"): ?>
										<h4>Payment Terms: </h4>
												<select name="invoice_payment_term">
													<option value="<?=$invoicee['invoice_payterms']?>"><?=($invoicee['invoice_payterms']==1)?'Payment on Delivery':'Payment on return'?></option>
													<option value="1" <?=set_select('myselect', '1'); ?>>Payment on Delivery</option>
													<option value="2" <?=set_select('myselect', '2'); ?>>Payment on return</option>
												</select>
										<?php endif; ?>
									</td>
									<td class="right" width="13%"><strong>Subtotal</strong> <br>
										<strong>Discount</strong> <br>
										<strong>Extra Discount</strong>
									</td>
									<td class="right"><strong> &#8358; <span id="stotal">0.00</span> <br>
										&#8358; 0.00 <br>
										&#8358; </strong><input type="number" name="invoice_extra_discount" id="invoice_extra_discount" min="0" value="0" class="span6 m-wrap" />
									</td>
								</tr>
							</tbody>
						</table>
						<div class="pull-right">
							<h4><span>Grand Total:</span> &#8358; <span id="gtotal">0.00</span></h4>
							<br>
							<button type="submit" class="btn btn-primary btn-large pull-right">Edit <?=($invoice_type=='CREDIT')?'Invoice':'Receipt'?></button> </div>
						</div>
					</div>
				</div>
			</div>
			
			<input type="hidden" name="invoice_subtotal" id="invoice_subtotal" />
			<input type="hidden" name="invoice_total" id="invoice_total" />

			</form>
			
		</div>
		
		
	</div>
	
</div>

