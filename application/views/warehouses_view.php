<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> 
		<a href="<?=base_url('dashboard')?>" title="Go to Users" class="tip-bottom">
			<i class="icon-home"></i> Dashboard</a>
		<a href="" class="current"> Warehouse</a>
	</div>
	<h1>Warehouses</h1>
  </div>
<!--End-breadcrumbs-->

<div class="container-fluid">
	
	<hr>
	<div class="row-fluid">
		<div class="span12">
		
			<div class="widget-box">
				<div class="widget-title">
					<span class="icon"><i class="icon-th"></i></span>
					<h5>Warehouses</h5>
				</div>
				<div class="widget-content nopadding">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Address</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($warehouses as $warehouse): ?>
							<tr>
								<td><?=$warehouse['warehouse_id']?></td>
								<td><?=$warehouse['warehouse_name']?></td>
								<td><?=$warehouse['warehouse_address']?></td>
								<td><a href="#">Edit</a> | <a href="#">Remove</a></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
			
			<div class="">
				<a href="<?=base_url('warehouse/add')?>" class="btn btn-primary"><i class="icon-plus"></i> Add Warehouse</a>
			</div>
		</div>
		
		
	</div>
	
</div>

