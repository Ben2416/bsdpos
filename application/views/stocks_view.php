<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> 
		<a href="<?=base_url('dashboard')?>" title="Go to Users" class="tip-bottom">
			<i class="icon-home"></i> Dashboard</a>
		<a href="" class="current"> Stocks</a>
	</div>
	<h1>Stocks</h1>
  </div>
<!--End-breadcrumbs-->

<div class="container-fluid">
	
	<hr>
	<div class="row-fluid">
		<div class="span12">
		
			<div class="widget-box">
				<div class="widget-title">
					<span class="icon"><i class="icon-th"></i></span>
					<h5>Warehouse Stocks</h5>
				</div>
				<div class="widget-content nopadding">
					<div class="widget-box">
						<div class="widget-title">
							<ul class="nav nav-tabs">
								<!--<li class="active"><a data-toggle="tab" href="#tab1">Tab1</a></li>-->
								<?php for($i=0; $i<count($warehouses); $i++): // foreach($warehouses as $wh): ?>
								<?php if($this->session->user_warehouse != 0 && $warehouses[$i]['warehouse_id'] != $this->session->user_warehouse)continue; ?>
								<li class="<?=($i==0)?'active':''?>"><a data-toggle="tab" href="#tab<?=$i?>"><?=$warehouses[$i]['warehouse_name']?></a></li>
								<?php endfor;//endforeach; ?>
								<?php if(count($warehouses)>1):?>
								<?php if($this->session->user_role ==1 || $this->session->user_role == 2): ?>
								<li><a data-toggle="tab" href="#tab<?=count($warehouses)?>">Summation</a></li>
								<?php endif;?>
								<?php endif;?>
							</ul>
						</div>
						<div class="widget-content tab-content">
							<?php for($i=0; $i<count($warehouses); $i++): ?>
							<?php if($this->session->user_warehouse != 0 && $warehouses[$i]['warehouse_id'] != $this->session->user_warehouse)continue; ?>
							<div id="tab<?=$i?>" class="tab-pane <?=($i==0)?'active':''?>">
								
								<div class="widget-box">
									<div class="widget-title">
										<span class="icon"><i class="icon-th"></i></span>
										<h5><?=$warehouses[$i]['warehouse_name']?> Stocks</h5>
									</div>
									<div class="widget-content nopadding">
										<table class="table table-bordered data-table">
											<thead>
												<tr>
													<th>Product</th>
													<th>Quantity</th>
													<th>Worth</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($stocks as $stock): 
													if($stock['stock_warehouse'] != $warehouses[$i]['warehouse_id'])
														continue;
												?>
												<tr>
													<td><?=$stock['product_name']?></td>
													<td><?=$stock['stock_quantity']?></td>
													<td>&#8358; <?=number_format(($stock['stock_quantity']*$stock['product_wholesale_price']),2,'.',',')?></td>
													<td>
													<?php if($this->session->user_role == 1 || $this->session->user_role == 2): ?>
														<a href="#editStock<?=$stock['stock_id']?>" data-toggle="modal">Edit</a>
														<div id="editStock<?=$stock['stock_id']?>" class="modal hide">
															<div class="modal-header">
																<button data-dismiss="modal" class="close" type="button">×</button>
																<h3>Edit Stock</h3>
															</div>
															<form name="form" action="<?=base_url('stocks/update/'.$stock['product_id'].'/'.$warehouses[$i]['warehouse_id'])?>" method="post">
															<div class="modal-body">
																<p>
																	<div class="control-group">
																		<label class="control-label span4">Product Name : </label>
																		<div class="controls">
																			<input type="text" class="span8" value="<?=$stock['product_name']?>" disabled />
																		</div>
																	</div>
																	<div class="control-group">
																		<label class="control-label span4">Product Warehouse : </label>
																		<div class="controls">
																			<input type="text" class="span8" value="<?=$warehouses[$i]['warehouse_name']?>" disabled />
																		</div>
																	</div>
																	<div class="control-group">
																		<label class="control-label span4">Product Quantity : </label>
																		<div class="controls">
																			<input type="number" min="0" class="span8" value="<?=$stock['stock_quantity']?>" name="stock_quantity" />
																		</div>
																	</div>
																</p>
															</div>
															<div class="modal-footer"> 
																<button type="submit" class="btn btn-primary">Confirm</button> 
																<a data-dismiss="modal" class="btn" href="#">Cancel</a> 
															</div>
															</form>
														</div>
														| 
														<a href="#deleteStock<?=$stock['stock_id']?>" data-toggle="modal">Remove</a>
														<div id="deleteStock<?=$stock['stock_id']?>" class="modal hide">
															<div class="modal-header">
																<button data-dismiss="modal" class="close" type="button">×</button>
																<h3>Confirm Stock Delete</h3>
															</div>
															<div class="modal-body">
																<p>Are you sure you want to delete this Stock (<?=$stock['product_name']?>)?</p>
															</div>
															<div class="modal-footer"> 
																<a href="<?=base_url('stocks/delete/'.$stock['product_id'].'/'.$warehouses[$i]['warehouse_id'])?>" class="btn btn-primary" >Confirm</a> 
																<a data-dismiss="modal" class="btn" href="#">Cancel</a> 
															</div>
														</div>
													<?php else: ?>
														<span class="help-text">None</span>
													<?php endif; ?>
													
													</td>
												</tr>
												<?php endforeach; ?>
											</tbody>
										</table>
									</div>
								</div>
								
							</div>
							<?php endfor;?>
							<?php if(count($warehouses)>1):?>
							<?php if($this->session->user_role ==1 || $this->session->user_role == 2): ?>
							<div id="tab<?=count($warehouses)?>" class="tab-pane">
								<p> Summation</p>
							</div>
							<?php endif;?>
							<?php endif;?>
						</div>
					</div>
				</div>
			
			</div>
		
		
		</div>
	
	</div>

</div>