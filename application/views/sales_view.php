<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> 
		<a href="<?=base_url('dashboard')?>" title="Go to Users" class="tip-bottom">
			<i class="icon-home"></i> Dashboard</a>
		<a href="" class="current"> Sales</a>
		<a href="" class="current"> <?=($sales_type=='CREDIT')?'Invoices':'Receipts'?></a>
	</div>
	<h1>Sales</h1>
  </div>
<!--End-breadcrumbs-->

<div class="container-fluid">
	
	<hr>
	<div class="row-fluid">
		<div class="span12">
		
			<div class="widget-box">
				<div class="widget-title">
					<span class="icon"><i class="icon-th"></i></span>
					<h5>Warehouse Sales</h5>
				</div>
				<div class="widget-content nopadding">
					<div class="widget-box">
						<div class="widget-title">
							<ul class="nav nav-tabs">
								<!--<li class="active"><a data-toggle="tab" href="#tab1">Tab1</a></li>-->
								<?php for($i=0; $i<count($warehouses); $i++): // foreach($warehouses as $wh): ?>
								<li class="<?=($i==0)?'active':''?>"><a data-toggle="tab" href="#tab<?=$i?>"><?=$warehouses[$i]['warehouse_name']?></a></li>
								<?php endfor;//endforeach; ?>
								<?php if(count($warehouses)>0):?>
								<li><a data-toggle="tab" href="#tab<?=count($warehouses)?>">Summation</a></li>
								<?php endif;?>
							</ul>
						</div>
						<div class="widget-content tab-content">
							<?php for($i=0; $i<count($warehouses); $i++): ?>
							<div id="tab<?=$i?>" class="tab-pane <?=($i==0)?'active':''?>">
								<!--<p> <?=$warehouses[$i]['warehouse_name']?></p>-->
								<div class="btn-icon-pg">
								<ul class="">
									<li><a href="<?=base_url('invoice/create/supply/')?><?=($sales_type=='CREDIT')?'CREDIT':'POS'?>" ><i class="icon icon-plus"></i> Add Supply <?=($sales_type=='CREDIT')?'Invoice':'Receipt'?></a></li>
									<li><a href="<?=base_url('invoice/create/wholesale/')?><?=($sales_type=='CREDIT')?'CREDIT':'POS'?>" ><i class="icon icon-plus"></i> Add Wholesale <?=($sales_type=='CREDIT')?'Invoice':'Receipt'?></a></li>
									<li><a href="<?=base_url('invoice/create/retail/')?><?=($sales_type=='CREDIT')?'CREDIT':'POS'?>" ><i class="icon icon-plus"></i> Add Retail <?=($sales_type=='CREDIT')?'Invoice':'Receipt'?></a></li>
								</ul>
								</div>
								
								
								<div class="widget-box">
									<div class="widget-content nopadding">
										
										<form class="form-horizontal">
											<div class="controls controls-row">
												<label class="span1 m-wrap">Date</label>
												<input type="text" class="span3 m-wrap datepicker" data-date="<?=date('d-m-Y')?>" data-date-format="dd-mm-yyyy" placeholder="start date" />
												<label class="span1 m-wrap">To</label>
												<input type="text" class="span3 m-wrap datepicker" data-date="01-02-2013" data-date-format="dd-mm-yyyy" placeholder="enddate" />
												<button class="btn btn-primary span3 m-wrap">Get <?=($sales_type=='CREDIT')?'Invoices':'Receipts'?></button>
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
															<th><?=($sales_type=='CREDIT')?'Invoice':'Receipt'?> Number</th>
															<th>Category</th>
															<th>Type</th>
															<th>Customer Name</th>
															<th>Amount</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
														<?php foreach($invoices as $invoice): 
															if($invoice['invoice_warehouse'] != $warehouses[$i]['warehouse_id']) 
																continue;
														?>
														<tr>
															<td><a href="<?=base_url('invoice/get/').$invoice['invoice_txn_id']?>/<?=$sales_type?>"><?=$invoice['invoice_txn_id']?></a></td>
															<td><?=$invoice['invoice_category']?></td>
															<td><?=$invoice['invoice_type']?></td>
															<td><?=$invoice['customer_name']?></td>
															<td>&#8358; <?=number_format($invoice['invoice_total'], 2, '.', ',')?></td>
															<td>
																<a href="#"><i class="icon icon-edit"></i> Edit</a> 
																| 
																<a href="#"><i class="icon icon-trash"></i> Remove</a> 
																<?php if($sales_type=='CREDIT'):?>
																| 
																<a href="<?=base_url('stocks/return/').$invoice['invoice_txn_id']?>"><i class="icon icon-shopping-cart"></i> Stock Return</a></td>
																<?php endif;?>
														</tr>
														<?php endforeach; ?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								
								
							</div>
							<?php endfor;?>
							<?php if(count($warehouses)>0):?>
								<div id="tab<?=count($warehouses)?>" class="tab-pane">
								<p> Summation</p>
							</div>
							<?php endif;?>
						</div>
					</div>
				</div>
			
			</div>
		
		
		</div>
	
	</div>

</div>