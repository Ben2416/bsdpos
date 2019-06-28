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
								<td>
									<a href="#editWarehouse<?=$warehouse['warehouse_id']?>" data-toggle="modal">Edit</a>
									<div id="editWarehouse<?=$warehouse['warehouse_id']?>" class="modal hide">
										<form action="<?=base_url('warehouse/edit/'.$warehouse['warehouse_id'])?>" method="post">
										<div class="modal-header">
											<button data-dismiss="modal" class="close" type="button">×</button>
											<h3>Edit Warehouse</h3>
										</div>
										<div class="modal-body">
											<p>
												<div class="control-group">
													<label class="control-label span4">Warehouse Name : </label>
													<div class="controls">
														<input type="text" name="warehouse_name" class="span8" value="<?=$warehouse['warehouse_name']?>" />
													</div>
												</div>
												<div class="control-group">
													<label class="control-label span4">Warehouse Address : </label>
													<div class="controls">
														<textarea name="warehouse_address" class="span8"><?=$warehouse['warehouse_address']?></textarea>
													</div>
												</div>
											</p>
										</div>
										<div class="modal-footer"> 
											<button type="submit" class="btn btn-primary" >Confirm</button> 
											<a data-dismiss="modal" class="btn" href="#">Cancel</a> 
										</div>
										</form>
									</div>
									
									| 
									<a href="#deleteWarehouse<?=$warehouse['warehouse_id']?>" data-toggle="modal">Remove</a>
									<div id="deleteWarehouse<?=$warehouse['warehouse_id']?>" class="modal hide">
										<div class="modal-header">
											<button data-dismiss="modal" class="close" type="button">×</button>
											<h3>Confirm Warehouse Delete</h3>
										</div>
										<div class="modal-body">
											<p>Are you sure you want to delete this Warehouse (<?=$warehouse['warehouse_name']?>)?<br/>
												Deleting this warehouse will remove all of its associations: Users, Products, Sales, etc
											</p>
										</div>
										<div class="modal-footer"> 
											<a href="<?=base_url('warehouse/remove/'.$warehouse['warehouse_id'])?>" class="btn btn-primary" >Confirm</a> 
											<a data-dismiss="modal" class="btn" href="#">Cancel</a> 
										</div>
									</div>
								</td>
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

