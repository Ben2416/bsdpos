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
								<p> <?=$warehouses[$i]['warehouse_name']?></p>
								<div class="widget-box">
									<div class="widget-title">
										<span class="icon"><i class="icon-th"></i></span>
										<h5>Supplies</h5>
									</div>
									<div class="widget-content nopadding">
										<table class="table table-bordered data-table">
											<thead>
												<tr>
													<th>Item Name</th>
													<th>Quantity</th>
													<th>Rate</th>
													<th>Amount</th>
												</tr>
											</thead>
											<tbody>
											<?php foreach($supplies as $supply): ?>
												<tr>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
												</tr>
											<?php endforeach; ?>
											</tbody>
										</table>
									</div>
								</div>
								<div class="">
									
									<a class="btn btn-primary" href="#addSupply<?=$i?>" data-toggle="modal"><i class="icon icon-plus"></i> Add Supplies</a>
									<div id="addSupply<?=$i?>" class="modal hide">
										<div class="modal-header">
											<button data-dismiss="modal" class="close" type="button">×</button>
											<h3>New Supply</h3>
										</div>
										<div class="modal-body">
											<table>
												<thead>
													<th>Item Name</th>
													<th>Quantity</th>
													<th>Rate</th>
													<th>Amount</th>
												</thead>
												<tbody>
													<tr>
														<td><input type="text" name="item_name[]" class="span12" /></td>
														<td><input type="text" name="item_quantity[]" class="span12" /></td>
														<td><input type="text" name="item_rate[]" class="span12" /></td>
														<td><input type="text" name="item_amount[]"  class="span12" /></td>
														<td><a title="Remove" class="tip-bottom"><i class="icon icon-trash"></i></a></td>
													</tr>
												</tbody>
											</table>
											<div class="">
												<button class="btn btn-success"><i class="icon icon-plus"></i> Add Product</button>
											</div>
										</div>
										<div class="modal-footer"> 
											<a href="<?=base_url('supplies/add')?>" class="btn btn-primary" >Add Supply</a> 
											<a data-dismiss="modal" class="btn" href="#">Cancel</a> 
										</div>
									</div>
									
									
								</div>
							</div>
							<?php endfor;?>
							<?php if(count($warehouses)>0):?>
								<div id="tab<?=count($warehouses)?>" class="tab-pane">
								<p> Summation</p>
								<div class="widget-box">
									<div class="widget-title">
										<span class="icon"><i class="icon-th"></i></span>
										<h5>Supplies</h5>
									</div>
									<div class="widget-content nopadding">
										<table class="table table-bordered data-table">
											<thead>
												<tr>
													<th>Item Name</th>
													<th>Quantity</th>
													<th>Rate</th>
													<th>Amount</th>
												</tr>
											</thead>
											<tbody>
											<?php foreach($supplies as $supply): ?>
												<tr>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
												</tr>
											<?php endforeach; ?>
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