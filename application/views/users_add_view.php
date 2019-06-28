<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> 
		<a href="<?=base_url('dashboard')?>" title="Go to Dashboard" class="tip-bottom">
			<i class="icon-home"></i> Dashboard</a>
		<a href="<?=base_url('users')?>" title="Go to users" class="tip-bottom"> Users</a>
		<a href="" class="current"> Add</a>
	</div>
	<h1>Users</h1>
  </div>
<!--End-breadcrumbs-->

<div class="container-fluid">
	
	<hr>
	<div class="row-fluid">
		<div class="span12">
		
			<div class="widget-box">
				<div class="widget-title">
					<span class="icon"><i class="icon-th"></i></span>
					<h5>Add User</h5>
				</div>
				<div class="widget-content nopadding">
				
					<form action="<?=base_url('users/add')?>" method="post" class="form-horizontal">
						
						<div class="control-group">
							<?=validation_errors()?>
						</div>
						
						<div class="control-group">
							<label class="control-label">First Name : </label>
							<div class="controls">
								<input type="text" class="span11" placeholder="First name" name="firstname" value="<?=set_value('firstname')?>" >
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label">Last Name :</label>
							<div class="controls">
								<input type="text" class="span11" placeholder="Last name" name="lastname" value="<?=set_value('lastname')?>" />
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label">Email :</label>
							<div class="controls">
								<input type="email" class="span11" placeholder="Email" name="email" value="<?=set_value('email')?>" />
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label">Phone :</label>
							<div class="controls">
								<input type="text" class="span11" placeholder="Phone" name="phone" value="<?=set_value('phone')?>" />
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label">New Password :</label>
							<div class="controls">
								<input type="password" class="span11" placeholder="New Password" name="npassword" value="<?=set_value('npassword')?>" />
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label">Confirm Password :</label>
							<div class="controls">
								<input type="password" class="span11" placeholder="Confirm Password" name="cpassword" value="<?=set_value('cpassword')?>" />
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label">Role :</label>
							<div class="controls">
								<select name="role" class="span11">
								<?php foreach($roles as $role):?>
									<option value="<?=$role['role_id']?>" <?=set_select('role', $role['role_id'])?>><?=$role['role_name']?></option>
								<?php endforeach;?>
								</select>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label">Warehouse :</label>
							<div class="controls">
								<select name="warehouse" class="span11">
								<?php foreach($warehouses as $warehouse):?>
									<option value="<?=$warehouse['warehouse_id']?>" <?=set_select('warehouse', $warehouse['warehouse_id'])?>><?=$warehouse['warehouse_name']?></option>
								<?php endforeach;?>
									<option value="0" <?=set_select('warehouse', '0')?> >All</option>
								</select>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label">Address :</label>
							<div class="controls">
								<textarea class="span11" placeholder="address" name="address"><?=set_value('address')?></textarea>
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

