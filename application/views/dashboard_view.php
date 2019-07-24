<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> 
		<a href="<?=base_url('dashboard')?>" title="Go to Dashboard" class="tip-bottom">
			<i class="icon-home"></i> Dashboard</a>
	</div>
  </div>
<!--End-breadcrumbs-->

<div class="container-fluid">
	
	<!-- ACTIONS BUTTONS SUMMARY -->
	<div class="quick-actions_homepage">
		<ul class="quick-actions">
			<li class="bg_lb "><a><i class="icon-copy"></i> <span class="label label-important"><?=$invoices_today?></span> Invoices/Receipts Today</a></li>
			<li class="bg_lg "><a><i class="icon-book"></i> <span class="label label-warning"><?=$invoices_month?></span> Invoices/Receipts This Month</a></li>
			<li class="bg_ly span2"><a><i class="icon-shopping-cart"></i> <span class="label label-success">&#8358; <?=number_format($sales_today, 2, '.',',')?></span> Sales Today</a></li>
			<li class="bg_lr "><a><i class="icon-truck"></i> <span class="label label-info">&#8358; <?=number_format($sales_month, 2, '.',',')?></span> Sales This Month</a></li>
			<li class="bg_ls span2"><a><i class="icon-money"></i> <span class="label label-important">&#8358; <?=number_format($expenses_today, 2, '.',',')?></span>Expenses Today</a></li>
		</ul>
	</div>
	
	<!-- INVOICES AND STOCKS ROW -->
	<div class="row-fluid">
		<div class="span7">
			<div class="widget-box">
				<div class="widget-title">
					<span class="icon"><i class="icon-reorder"></i></span>
					<h5>Recent Invoices and Receipts</h5>
				</div>
				<div class="widget-content nopadding style="height:320px;overflow:auto;"">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Date</th>
								<th>Number</th>
								<th>Category</th>
								<th>Customer Name</th>
								<th>Amount</th>
								<!--<th>Action</th>-->
							</tr>
						</thead>
						<tbody>
							<?php foreach($invoices as $invoice): ?>
							<tr>
								<td><?=$invoice['invoice_issue_date']?></td>
								<td><a href="<?=base_url('invoice/get/').$invoice['invoice_txn_id']?>/<?=$invoice['invoice_type']?>"><?=($invoice['invoice_type']=='CREDIT')?'Invoice':'Receipt'?> - <?=$invoice['invoice_txn_id']?></a></td>
								<td><?=ucfirst($invoice['invoice_category'])?></td>
								<td><?=$invoice['customer_name']?></td>
								<td>&#8358; <?=number_format($invoice['invoice_total'], 2, '.', ',')?></td>
								<!--<td><a href="<?=base_url('invoice/edit/').$invoice['invoice_id']?>"><i class="icon icon-edit"></i> Edit</a> | <a href="<?=base_url('invoice/get/').$invoice['invoice_id']?>"><i class="icon icon-trash"></i> Remove</a></td>-->
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="span5">
			<div class="widget-box">
				<div class="widget-title">
					<span class="icon"><i class="icon-tasks"></i></span>
					<h5>Stocks</h5>
				</div>
				<div class="widget-content nopadding" style="height:320px;overflow:auto;">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Product</th>
								<th>Quantity</th>
								<th>Worth</th>
								<!--<th>Action</th>-->
							</tr>
						</thead>
						<tbody>
							<?php foreach($stocks as $stock): 
								//if($stock['stock_warehouse'] != $warehouses[$i]['warehouse_id'])
								//	continue;
							?>
							<tr>
								<td><?=$stock['product_name']?></td>
								<td><?=$stock['stock_quantity']?></td>
								<td>&#8358; <?=number_format(($stock['stock_quantity']*$stock['product_wholesale_price']),2,'.',',')?></td>
								<!--<td><a href="#">Edit</a> | <a href="#">Remove</a></td>-->
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	
	<!-- INCOME, EXPENSES AND SALES SUMMARY -->
	<div class="widget-box widget-plain">
      <div class="center">
        <ul class="stat-boxes2">
          <li>
            <div class="left peity_bar_neutral"><span><span style="display: none;">2,4,9,7,12,10,12</span>
              <canvas width="50" height="24"></canvas>
              </span>+10%</div>
            <div class="right"> <strong>&#8358; 0.00</strong> Income (Week) </div>
          </li>
          <li>
            <div class="left peity_line_neutral"><span><span style="display: none;">10,15,8,14,13,10,10,15</span>
              <canvas width="50" height="24"></canvas>
              </span>10%</div>
            <div class="right"> <strong>&#8358; <?=number_format($expenses_week, 2, '.', ',')?></strong> Expenses (week)</div>
          </li>
          <li>
            <div class="left peity_bar_bad"><span><span style="display: none;">3,5,6,16,8,10,6</span>
              <canvas width="50" height="24"></canvas>
              </span>-40%</div>
            <div class="right"> <strong>&#8358; <?=number_format($pos_sales_week, 2, '.',',')?></strong> POS Sales (week)</div>
          </li>
          <li>
            <div class="left peity_bar_good"><span>12,6,9,23,14,10,13,2,5,1</span>+30%</div>
            <div class="right"> <strong>&#8358; <?=number_format($credit_sales_week, 2, '.',',')?></strong> Credit Sales (week)</div>
          </li>
		  <!--<li>
            <div class="left peity_line_good"><span><span style="display: none;">12,6,9,23,14,10,17</span>
              <canvas width="50" height="24"></canvas>
              </span>+60%</div>
            <div class="right"> <strong>&#8358; 0.00</strong> Total Sales (Week) </div>
          </li>-->
          
        </ul>
      </div>
    </div>


</div>