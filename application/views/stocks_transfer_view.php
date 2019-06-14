<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> 
		<a href="<?=base_url('dashboard')?>" title="Go to Dashboard" class="tip-bottom">
			<i class="icon-home"></i> Dashboard</a>
		<a href="<?=base_url('stocks')?>" title="Go to Stocks" class="tip-bottom"> Stocks</a>
		<a href="" class="current"> Transfer</a>
	</div>
	<h1>Stocks Transfer</h1>
  </div>
<!--End-breadcrumbs-->

<div class="container-fluid">
	
	<hr>
	<div class="row-fluid">
		<div class="span12">
		
			<div class="widget-box">
				<div class="widget-title">
					<span class="icon"><i class="icon-th"></i></span>
					<h5>Tansfer</h5>
				</div>
				<div class="widget-content">
					<?=validation_errors()?>
					<form class="form-horizontal" method="post" action="<?=base_url('stocks/transfer')?>">
						<!--<div class="control-group">
							<label class="control-label"> Date : </label>
							<div class="controls">
								<input type="text" required name="transfer_date" class="datepicker" data-date-format="dd-mm-yyyy" />
							</div>
						</div>-->
						<div class="control-group">
							<label class="control-label">From :</label>
							<div class="controls">
								<select id="from_warehouse" name="from_warehouse" class="span6">
								<?php foreach($warehouses as $wh): ?>
									<option value="<?=$wh['warehouse_id']?>"><?=$wh['warehouse_name']?></option>
								<?php endforeach; ?>
								</select>
								<span class="help-block">Warehouse to transfer stock from</span>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">To :</label>
							<div class="controls">
								<select id="to_warehouse" name="to_warehouse" class="span6">
								<?php //foreach($warehouses as $wh): ?>
									<!--<option value="<?=$wh['warehouse_id']?>"><?=$wh['warehouse_name']?></option>-->
								<?php //endforeach; ?>
								</select>
								<span class="help-block">Warehouse to transfer stock to</span>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Product(s) :</label>
							<div class="controls">
								<table id="st_table" class="table">
									<thead>
										<tr>
											<th>Product</th>
											<th>Quantity</th>
											<th>Available</th>
											<th>Remove</th>
										</tr>
									</thead>
									<tbody>
										<!--<tr>
											<td><input name="product_name[]" class="span12"></td>
											<td><input type="number" min="1" class="" name="product_quantity[]" placeholder="product quantity" /></td>
											<td><span class="span12" id="product_available[]">0</span></td>
											<td><a class="btn btn-danger" onclick="$(this).closest('tr').remove();"><i class="icon icon-trash"></i></a></td>
										</tr>-->
									</tbody>
								</table>
								<div class="">
									<a class="btn btn-primary" id="add_product"><i class="icon icon-plus"></i> Add Product</a>
								</div>
							</div>
						</div>
						
						<div class="form-actions">
							<button type="submit" class="btn btn-success">Transfer Stock</button>
						</div>

					</form>
				</div>
			</div>
			
			<div class="widget-box">
				<div class="widget-title">
					<span class="icon"><i class="icon-th"></i></span>
					<h5>Stock Transfers</h5>
				</div>
				<div class="widget-content">
					<table class="table table-bordered data-table">
						<thead>
							<tr>
								<th>Transfer Date</th>
								<th>Transferred From</th>
								<th>Transferred To</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php $is_first = true; $prev = null;
							foreach($stock_transfers as $st): 
								if($is_first == true || 
									$st['stock_transfer_date']!=$prev['stock_transfer_date'] ):
									
									if($is_first == true):
							?>
										<tr>
											<td><?=$st['stock_transfer_date']?></td>
											<td><?=$st['warehouse_from']?></td>
											<td><?=$st['warehouse_to']?></td>
											<td>
												<a href="#myModal<?=$st['stock_transfer_id']?>" data-toggle="modal" class="btn btn-info">
													<i class="icon icon-list-alt"></i> Details</a>

												<div id="myModal<?=$st['stock_transfer_id']?>" class="modal hide">
													<div class="modal-header">
														<button data-dismiss="modal" class="close" type="button">×</button>
														<h3>Stock Transfered on <?=$st['stock_transfer_date']?></h3>
													</div>
													<div class="modal-body">
														<table class="table table-bordered">
															<thead>
																<tr><th>Product Name</th><th>Product Quantity</th></tr>
															</thead>
															<tbody>
																<tr><td><?=$st['product_name']?></td><td><?=$st['stock_transfer_quantity']?></td></tr>
													
							<?php 	else: ?>
															</tbody>
														</table>
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td><?=$st['stock_transfer_date']?></td>
											<td><?=$st['warehouse_from']?></td>
											<td><?=$st['warehouse_to']?></td>
											<td>
												<a href="#myModal<?=$st['stock_transfer_id']?>" data-toggle="modal" class="btn btn-info">
													<i class="icon icon-list-alt"></i> Details</a>

												<div id="myModal<?=$st['stock_transfer_id']?>" class="modal hide">
													<div class="modal-header">
														<button data-dismiss="modal" class="close" type="button">×</button>
														<h3>Stock Transfered on <?=$st['stock_transfer_date']?></h3>
													</div>
													<div class="modal-body">
														<table class="table table-bordered">
															<thead>
																<tr><th>Product Name</th><th>Product Quantity</th></tr>
															</thead>
															<tbody>
																<tr><td><?=$st['product_name']?></td><td><?=$st['stock_transfer_quantity']?></td></tr>
													
							<?php	endif;
								else:
							?>
																<tr><td><?=$st['product_name']?></td><td><?=$st['stock_transfer_quantity']?></td></tr>
							<?php
								endif; 
								$prev = $st;
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
		
		
	</div>
	
</div>

