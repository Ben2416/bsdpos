<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> 
		<a href="<?=base_url('dashboard')?>" title="Go to Users" class="tip-bottom">
			<i class="icon-home"></i> Dashboard</a>
		<a href="" class="<?=base_url('stock')?>"> Stock</a>
		<a href="" class="current"> Stock Returns</a>
	</div>
	<h1>Stock Returns</h1>
  </div>
<!--End-breadcrumbs-->

<div class="container-fluid">
	
	<hr>
	<div class="row-fluid">
		<div class="span12">
		
			<div class="widget-box">
				<div class="widget-title">
					<span class="icon"><i class="icon-th"></i></span>
					<h5>Stock Return Invoices</h5>
				</div>
				<div class="widget-content">
					
					<div class="widget-box">
						<div class="widget-title">
							<span></span>
						</div>
						<div class="widget-content nopadding">
							<table class="table table-bordered data-table">
								<thead>
									<tr>
										<th>Date</th>
										<th>Invoice</th>
										<th>Customer Name</th>
										<th>Amount</th>
										<th>Sold</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($stock_returns as $sr): ?>
									<tr onclick="location.href='<?=base_url('stocks/returninvoice/'.$sr['stock_return_invoice'])?>'" style="cursor:pointer;">
										<td><?=$sr['stock_return_date']?></td>
										<td><?=$sr['stock_return_invoice']?></td>
										<td><?=$sr['customer_name']?></td>
										<td>&#8358; <?=number_format($sr['stock_return_amount'], 2, '.', ',')?></td>
										<td>&#8358; <?=$sr['stock_return_sold']?></td>
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

