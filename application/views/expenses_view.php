<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> 
		<a href="<?=base_url('dashboard')?>" title="Go to Users" class="tip-bottom">
			<i class="icon-home"></i> Dashboard</a>
		<a href="" class="current"> Expenses</a>
	</div>
	<h1>Expenses</h1>
  </div>
<!--End-breadcrumbs-->

<div class="container-fluid">
	
	<hr>
	<div class="row-fluid">
		<div class="span12">
		
			<div class="widget-box">
				<div class="widget-title">
					<span class="icon"><i class="icon-th"></i></span>
					<h5>Warehouse Expenses</h5>
				</div>
				<div class="widget-content nopadding">
					
					<div class="" style="padding:10px;">
						<a class="btn btn-success" href="<?=base_url('expenses/add')?>"><i class="icon icon-plus"></i> Add Expense</a>
					</div>
					
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
								
								<div class="widget-box collapsible">
									<div class="widget-title"> <a data-toggle="collapse" href="#collapseOne<?=$i?>"> <span class="icon"><i class="icon-arrow-right"></i></span>
										<h5>Admin Expenses </h5>
										</a> 
									</div>
									<div id="collapseOne<?=$i?>" class="collapse in">
										<div class="widget-content"> 
											<form class="form-horizontal">
												<div class="controls controls-row">
													<label class="span1 m-wrap">Dates : </label> 
													<input type="text" placeholder="From date" data-date-format="dd-mm-yyyy" class="span3 m-wrap datepicker" /> 
													<!--<label class="span1 m-wrap"> | </label> -->
													<input type="text" placeholder="To date" data-date-format="dd-mm-yyyy" class="span3 m-wrap datepicker" /> 
													<button class="btn btn-success span3 m-wrap">Get Expenses</button>
												</div>
											</form>
											<table class="table table-bordered">
												<thead>
													<tr>
														<th>Expense Item</th>
														<th>Amount</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach($expenses as $expense): 
													if($expense['expense_warehouse'] != $warehouses[$i]['warehouse_id'])
														continue;
													if($expense['expense_class'] != 'Admin')
														continue;
													?>
													<tr>
														<td><?=$expense['expense_item']?></td>
														<td>&#8358; <?=number_format($expense['expense_amount'], '2','.',',')?></td>
													</tr>
													<?php endforeach; ?>
												</tbody>
											</table>
										</div>
									</div>
									<div class="widget-title"> <a data-toggle="collapse" href="#collapseTwo<?=$i?>"> <span class="icon"><i class="icon-arrow-right"></i></span>
										<h5>Sales and Distribution Expenses</h5>
										</a> 
									</div>
									<div id="collapseTwo<?=$i?>" class="collapse">
										<div class="widget-content"> 
											<div class="widget-content"> 
											<div class="controls controls-row">
												<label class="span1 m-wrap">Dates : </label> <input type="text" placeholder="From date" class="m-wrap datepicker" /> | 
												<input type="text" placeholder="To date" class="m-wrap datepicker" /> 
												<button class="btn btn-success m-wrap">Get Expenses</button>
											</div>
											<table class="table table-bordered">
												<thead>
													<tr>
														<th>Expense Itme</th>
														<th>Amount</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach($expenses as $expense): 
													if($expense['expense_warehouse'] != $warehouses[$i]['warehouse_id'])
														continue;
													if($expense['expense_class'] != 'Sales and Distribution')
														continue;
													?>
													<tr>
														<td><?=$expense['expense_item']?></td>
														<td>&#8358; <?=number_format($expense['expense_amount'], '2','.',',')?></td>
													</tr>
													<?php endforeach; ?>
												</tbody>
											</table>
										</div>
										</div>
									</div>
									<div class="widget-title"> <a data-toggle="collapse" href="#collapseThree<?=$i?>"> <span class="icon"><i class="icon-arrow-right"></i></span>
										<h5>Finance Cost Expenses</h5>
										</a> 
									</div>
									<div id="collapseThree<?=$i?>" class="collapse">
										<div class="widget-content"> 
										
											<div class="widget-content"> 
											<div class="controls controls-row">
												<label class="span1 m-wrap">Dates : </label> <input type="text" placeholder="From date" class="m-wrap datepicker" /> | 
												<input type="text" placeholder="To date" class="m-wrap datepicker" /> 
												<button class="btn btn-success m-wrap">Get Expenses</button>
											</div>
											<table class="table table-bordered">
												<thead>
													<tr>
														<th>Expense Itme</th>
														<th>Amount</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach($expenses as $expense): 
													if($expense['expense_warehouse'] != $warehouses[$i]['warehouse_id'])
														continue;
													if($expense['expense_class'] != 'Finance Cost')
														continue;
													?>
													<tr>
														<td><?=$expense['expense_item']?></td>
														<td>&#8358; <?=number_format($expense['expense_amount'], '2','.',',')?></td>
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