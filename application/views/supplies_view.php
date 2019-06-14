<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> 
		<a href="<?=base_url('dashboard')?>" title="Go to Users" class="tip-bottom">
			<i class="icon-home"></i> Dashboard</a>
		<a href="" class="current"> Supplies</a>
	</div>
	<h1>Supplies</h1>
  </div>
<!--End-breadcrumbs-->

<div class="container-fluid">
	
	<hr>
	<div class="row-fluid">
		<div class="span12">
		
			<div class="widget-box">
				<div class="widget-title">
					<span class="icon"><i class="icon-th"></i></span>
					<h5>Warehouse Supplies</h5>
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
								
								<div class="">
									<a href="<?=base_url('supplies/add/'.$warehouses[$i]['warehouse_id'])?>" class="btn btn-primary" ><i class="icon icon-plus"></i> Add Supply</a> 
								</div>
								
								<div class="widget-box">
									<div class="widget-title">
										<span class="icon"><i class="icon-th"></i></span>
										<h5>Supplies</h5>
									</div>
									<div class="widget-content nopadding">
										<table class="table table-bordered">
											<thead>
												<tr>
													<th>Date</th>
													<th>Batch</th>
													<th></th>
												</tr>
											</thead>
											<tbody>
											<?php $is_first = true; $prev = null; 
												foreach($supplies as $supply): 
													if($supply['supply_warehouse'] != $warehouses[$i]['warehouse_id'])
														continue;
													
													if($is_first == true || $supply['supply_batch_id']!=$prev['supply_batch_id']):
														if($is_first == true):
											?>
												<tr>
													<td><?=$supply['supply_date']?></td>
													<td><?=$supply['supply_batch_id']?></td>
													<td>
														<a href="#supplyModel<?=$supply['supply_batch_id'].$i?>" data-toggle="Modal" class="">
															<i class="icon icon-list-alt"></i> Supply Details</a></a>

														<div id="supplyModal<?=$supply['supply_batch_id'].$i?>" class="modal ">
															<div class="modal-header">
																<button data-dismiss="modal" class="close" type="button">×</button>
																<h3>Batch <?=$supply['supply_batch_id']?>: Stock Transfered on <?=$supply['supply_date']?></h3>
															</div>
															<div class="modal-body">
																
																<table class="table table-bordered">
																	<thead>
																		<tr>
																			<th>Date</th>
																			<th>Item Name</th>
																			<th>Quantity</th>
																			<th>Rate</th>
																			<th>Amount</th>
																		</tr>
																	</thead>
																	<tbody>
																		<tr>
																			<td><?=$supply['supply_date'].$supply['supply_batch_id']?></td>
																			<td><?=$supply['product_name']?></td>
																			<td><?=$supply['supply_quantity']?></td>
																			<td>&#8358; <?=$supply['supply_rate']?></td>
																			<td>&#8358; <?=$supply['supply_amount']?></td>
																		</tr>
												<?php 	else: ?>
																	</tbody>
																</table>
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td><?=$supply['supply_date']?></td>
													<td><?=$supply['supply_batch_id']?></td>
													<td>
														<a href="#supplyModel<?=$supply['supply_batch_id'].$i?>" data-toggle="Modal" class="">
															<i class="icon icon-list-alt"></i> Supply Details</a></a>

														<div id="supplyModal<?=$supply['supply_batch_id'].$i?>" class="modal hide">
															<div class="modal-header">
																<button data-dismiss="modal" class="close" type="button">×</button>
																<h3>Batch <?=$supply['supply_batch_id']?>:: Stock Transfered on <?=$supply['supply_date']?></h3>
															</div>
															<div class="modal-body">
																
																<table class="table table-bordered">
																	<thead>
																		<tr>
																			<th>Date</th>
																			<th>Item Name</th>
																			<th>Quantity</th>
																			<th>Rate</th>
																			<th>Amount</th>
																		</tr>
																	</thead>
																	<tbody>
																		<tr>
																			<td><?=$supply['supply_date'].$supply['supply_batch_id']?></td>
																			<td><?=$supply['product_name']?></td>
																			<td><?=$supply['supply_quantity']?></td>
																			<td>&#8358; <?=$supply['supply_rate']?></td>
																			<td>&#8358; <?=$supply['supply_amount']?></td>
																		</tr>
											<?php 		endif;
													else:
											?>
																		<tr>
																			<td><?=$supply['supply_date'].$supply['supply_batch_id']?></td>
																			<td><?=$supply['product_name']?></td>
																			<td><?=$supply['supply_quantity']?></td>
																			<td>&#8358; <?=$supply['supply_rate']?></td>
																			<td>&#8358; <?=$supply['supply_amount']?></td>
																		</tr>
											<?php 
													endif;
													$prev = $supply;
													if($is_first == true){ $is_first=false; }
												endforeach; ?>
																	</tbody>
																</table>
															</div>
														</div>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<?php endfor;?>
							<!--	FOR SUMMARY -->
							<?php if(count($warehouses)>0):?>
								<div id="tab<?=count($warehouses)?>" class="tab-pane">
								<p> Summation</p>
								<div class="widget-box">
									<div class="widget-title">
										<span class="icon"><i class="icon-th"></i></span>
										<h5>Supplies</h5>
									</div>
									<div class="widget-content nopadding">
										<table class="table table-bordered">
											<thead>
												<tr>
													<th>Item Name</th>
													<th>Quantity</th>
													<th>Rate</th>
													<th>Amount</th>
												</tr>
											</thead>
											<tbody>
											<?php //foreach($supplies as $supply): ?>
												<tr>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
												</tr>
											<?php //endforeach; ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<?php endif;?>
						</div>
					</div>
				</div>
			
			</div>
		
		
		</div>
	
	</div>

</div>