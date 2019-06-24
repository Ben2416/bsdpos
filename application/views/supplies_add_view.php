<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> 
		<a href="<?=base_url('dashboard')?>" title="Go to Users" class="tip-bottom">
			<i class="icon-home"></i> Dashboard</a>
		<a href="<?=base_url('supplies')?>" class=""> Purchases</a>
		<a href="" class="current"> Add</a>
	</div>
	<h1>Add Purchases</h1>
  </div>
<!--End-breadcrumbs-->

<div class="container-fluid">
	
	<hr>
	<div class="row-fluid">
		<div class="span12">
		
			<div class="widget-box">
				<div class="widget-title">
					<span class="icon"><i class="icon-th"></i></span>
					<h5>Warehouse Purchases</h5>
				</div>
				<div class="widget-content">
					<form name="form" class="form-horizontal" method="post" action="<?=base_url('supplies/add/'.$warehouse_id)?>">
						<?=validation_errors();?>
						<div class="control-group">
							<label class="control-label"> Date: </label>
							<div class="controls">
								<input type="text" name="supply_date" class="datepicker" data-date-format="dd-mm-yyyy" value="<?=date('d-m-Y')?>" />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label"> Supplier Name : </label>
							<div class="controls">
								<input type="text" name="supplier_name" required />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label"> Supplier Phone : </label>
							<div class="controls">
								<input type="text" name="supplier_phone" required />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label"> Supplier Email : </label>
							<div class="controls">
								<input type="email" name="supplier_email" required />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Supplier Address : </label>
							<div class="controls">
								<textarea name="supplier_address" required></textarea>
							</div>
						</div>
						
						<div class="control-group">
							<table class="table" id="supply_table">
								<thead>
									<th>Item Name</th>
									<th>Quantity</th>
									<th>Rate</th>
									<th>Amount</th>
									<th></th>
								</thead>
								<tbody>
									<!--<tr>
										<td><input type="text" name="supply_item[]" class="span12" /></td>
										<td><input type="number" name="supply_quantity[]" min="0" class="span12" /></td>
										<td><input type="number" name="supply_rate[]" min="0" class="span12" /></td>
										<td><input type="number" name="supply_amount[]" min="0"  class="span12" /></td>
										<td><a title="Remove" class="tip-bottom btn btn-danger"><i class="icon icon-trash"></i></a></td>
									</tr>-->
								</tbody>
							</table>
							<a class="btn btn-warning" id="add_item"><i class="icon icon-plus"></i> Add Item</a>
						</div>
						
						<div class="form-actions">
							<button class="btn btn-success pull-right"><i class="icon icon-save"></i> Add Purchase</button>
						</div>
		
					</form>	
				</div>
			
			</div>
		
		
		</div>
	
	</div>

</div>