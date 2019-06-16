<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> 
		<a href="<?=base_url('dashboard')?>" title="Go to Users" class="tip-bottom">
			<i class="icon-home"></i> Dashboard</a>
		<a href="<?=base_url('expenses')?>" class=""> Expenses</a>
		<a href="" class="current"> Add</a>
	</div>
	<h1>Expenses</h1>
  </div>
<!--End-breadcrumbs-->

<div class="container-fluid">
	
	<hr>
	<div class="row-fluid">
		<div class="span12">
			<?=validation_errors()?>
			<div class="widget-box">
				<div class="widget-title">
					<span class="icon"><i class="icon-th"></i></span>
					<h5>Add Expense</h5>
				</div>
				<div class="widget-content nopadding">
					
					<form method="post" class="form-horizontal" action="<?=base_url('expenses/add')?>">
						
						<div class="control-group">
							<label class="control-label">Date : </label>
							<div class="controls">
								<input type="text" name="expense_date" class="datepicker" date-format="dd-mm-yyyy" value="<?=date('d-m-Y')?>" />
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label">Warehouse : </label>
							<div class="controls">
								<select name="expense_warehouse">
									<?php foreach($warehouses as $wh): ?>
										<option value="<?=$wh['warehouse_id']?>"><?=$wh['warehouse_name']?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label">Class : </label>
							<div class="controls">
								<select name="expense_class" id="expense_class">
									<option>Admin</option>
									<option>Sales and Distribution</option>
									<option>Finance Cost</option>
								</select>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label">Item : </label>
							<div class="controls">
								<select name="expense_item" id="expense_item">
									<option>Electricity</option>
									<option>Transportation</option>
									<option>Fuelling</option>
									<option>Other</option>
								</select>
							</div>
						</div>
						
						<div id="new_expense_div" class="control-group hide">
							<label class="control-label">Add New Item : </label>
							<div class="controls">
								<input type="text" name="new_expense_item" id="new_expense_item" disabled="disabled" required />
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label">Amount : </label>
							<div class="controls">
								<input type="number" min="0" name="expense_amount" required />
							</div>
						</div>
						
						<div class="form-actions">
							<button type="submit" class="btn btn-success"><i class="icon icon-save"></i> Add Expense</button>
						</div>
						
					</div>
					
				</div>
			</div>
		</div>
	
	</div>

</div>