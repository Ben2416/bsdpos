<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> 
		<a href="<?=base_url('dashboard')?>" title="Go to Users" class="tip-bottom">
			<i class="icon-home"></i> Dashboard</a>
		<a href="" class="current"> Products</a>
	</div>
	<h1>Products</h1>
  </div>
<!--End-breadcrumbs-->

<div class="container-fluid">
	
	<hr>
	<div class="row-fluid">
		<div class="span12">
		
			<div class="widget-box">
				<div class="widget-title">
					<span class="icon"><i class="icon-th"></i></span>
					<h5>Products</h5>
				</div>
				<div class="widget-content nopadding">
					<table class="table table-bordered data-table">
						<thead>
							<tr>
								<th>Warehouse</th>
								<th>Name</th>
								<th>Description</th>
								<th>Wholesale Price</th>
								<th>Supply Price</th>
								<th>Retail Price</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($products as $product): ?>
							<tr>
								<td><?=$product['warehouse_name']?></td>
								<td><?=$product['product_name']?></td>
								<td><?=$product['product_description']?></td>
								<td>&#8358; <?=$product['product_wholesale_price']?></td>
								<td>&#8358; <?=$product['product_supply_price']?></td>
								<td>&#8358; <?=$product['product_retail_price']?></td>
								<td>
									<?php if($this->session->user_role == 1 || $this->session->user_role == 2 || $this->session->user_role == 3): ?>
									<a href="<?=base_url('products/edit/'.$product['product_id'])?>"><i class="icon icon-edit"></i> Edit</a> | 
									<a href="#deleteProduct<?=$product['product_id']?>" data-toggle="modal"><i class="icon icon-trash"></i> Remove</a>
									<div id="deleteProduct<?=$product['product_id']?>" class="modal hide">
										<div class="modal-header">
											<button data-dismiss="modal" class="close" type="button">×</button>
											<h3>Confirm Product Delete</h3>
										</div>
										<div class="modal-body">
											<p>Are you sure you want to delete this product?</p>
										</div>
										<div class="modal-footer"> 
											<a href="<?=base_url('products/delete/'.$product['product_id'])?>" class="btn btn-primary" >Confirm</a> 
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
			
			<div class="">
				<a href="<?=base_url('products/add')?>" class="btn btn-primary"><i class="icon-plus"></i> Add Product</a>
			</div>
			
		</div>
		
		
	</div>
	
</div>

