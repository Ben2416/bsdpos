<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> 
		<a href="<?=base_url('dashboard')?>" title="Go to Users" class="tip-bottom">
			<i class="icon-home"></i> Dashboard</a>
		<a href="<?=base_url('warehouse')?>" > Warehouse</a>
		<a href="" class="current"> Add</a>
	</div>
	<h1>Warehouse</h1>
  </div>
<!--End-breadcrumbs-->

<div class="container-fluid">
	
	<hr>
	<div class="row-fluid">
		<div class="span12">
		
			<div class="widget-box">
				<div class="widget-title">
					<span class="icon"><i class="icon-th"></i></span>
					<h5>Add Warehouse</h5>
				</div>
				<div class="widget-content nopadding">
				
					<form action="<?=base_url('warehouse/add')?>" method="post" class="form-horizontal">
						
						<div class="control-group">
							<?=validation_errors()?>
						</div>
						
						<div class="control-group">
							<label class="control-label">Warehouse Name : </label>
							<div class="controls">
								<input type="text" class="span11" placeholder="Warehouse name" name="warehouse_name" value="<?=set_value('warehouse_name')?>" >
							</div>
						</div>
						
						
						<div class="control-group">
							<label class="control-label">Warehouse Address :</label>
							<div class="controls">
								<textarea class="span11" placeholder="Warehouse Address" name="warehouse_address"><?=set_value('warehouse_address')?></textarea>
							</div>
						</div>
						
						<div class="form-actions">
							<button type="submit" class="btn btn-success"> Add </button>
						</div>
						

					</form>
					
				</div>
			</div>
			
		</div>
	</div>
	
</div>

