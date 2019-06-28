<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> 
		<a href="<?=base_url('dashboard')?>" title="Go to Users" class="tip-bottom">
			<i class="icon-home"></i> Dashboard</a>
		<a href="" class="current"> Users</a>
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
					<h5>Users</h5>
				</div>
				<div class="widget-content nopadding">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Name</th>
								<th>Role</th>
								<th>Email</th>
								<th>Mobile</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($users as $user): ?>
							<tr>
								<td><?=$user['user_firstname'].' '.$user['user_lastname']?></td>
								<td><?=$user['role_name']?></td>
								<td><?=$user['user_email']?></td>
								<td><?=$user['user_phone']?></td>
								<td>
									<a href="#editUser<?=$user['user_id']?>" data-toggle="modal">Edit</a>
									<div id="editUser<?=$user['user_id']?>" class="modal hide">
										<form class="form-horizontal" action="<?=base_url('users/edit/'.$user['user_id'])?>" method="post">
										<div class="modal-header">
											<button data-dismiss="modal" class="close" type="button">×</button>
											<h3>Edit User</h3>
										</div>
										<div class="modal-body">
											<p>
												<div class="control-group">
													<label class="control-label span4">Role : </label>
													<div class="controls">
														<!--<select name="user_role" class="span8">
														<?php foreach($roles as $role):?>
															<option value="<?=$role['role_id']?>" <?=set_select('user_role', $role['role_id'])?>><?=$role['role_name']?></option>
														<?php endforeach;?>
														</select>-->
														<?php foreach($roles as $role):?>
															<label>
															<input type="radio" name="user_role" value="<?=$role['role_id']?>" <?=set_radio('user_role', $role['role_id'], ($user['user_role']==$role['role_id'])?TRUE:FALSE)?>><?=$role['role_name']?></label>
														<?php endforeach;?>
													</div>
												</div>
												<div class="control-group">
													<label class="control-label span4">First Name : </label>
													<div class="controls">
														<input type="text" name="user_firstname" class="span8" value="<?=$user['user_firstname']?>" />
													</div>
												</div>
												<div class="control-group">
													<label class="control-label span4">Last Name : </label>
													<div class="controls">
														<input type="text" name="user_lastname" class="span8" value="<?=$user['user_lastname']?>" />
													</div>
												</div>
												<div class="control-group">
													<label class="control-label span4">Email : </label>
													<div class="controls">
														<input type="email" name="user_email" class="span8" value="<?=$user['user_email']?>" />
													</div>
												</div>
												<div class="control-group">
													<label class="control-label span4">Phone : </label>
													<div class="controls">
														<input type="text" name="user_phone" class="span8" value="<?=$user['user_phone']?>" />
													</div>
												</div>
												<div class="control-group">
													<label class="control-label span4">Address : </label>
													<div class="controls">
														<textarea name="user_address" class="span8"><?=$user['user_address']?></textarea>
													</div>
												</div>
												<div class="control-group">
													<label class="control-label span4">Warehouse : </label>
													<div class="controls">
														<?php foreach($warehouses as $warehouse):?>
															<label>
															<input type="radio" name="user_warehouse" value="<?=$warehouse['warehouse_id']?>" <?=set_radio('user_warehouse', $warehouse['warehouse_id'], ($user['user_warehouse']==$warehouse['warehouse_id'])?TRUE:FALSE)?>><?=$warehouse['warehouse_name']?></label>
														<?php endforeach;?>
														<label>
															<input type="radio" name="user_warehouse" value="0" <?=set_radio('user_warehouse', '0', ($user['user_warehouse']=='0')?TRUE:FALSE)?>>All</label>
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
									<a href="#deleteUser<?=$user['user_id']?>" data-toggle="modal">Remove</a>
									<div id="deleteUser<?=$user['user_id']?>" class="modal hide">
										<div class="modal-header">
											<button data-dismiss="modal" class="close" type="button">×</button>
											<h3>Confirm User Delete</h3>
										</div>
										<div class="modal-body">
											<p>Are you sure you want to delete this User (<?=$user['user_firstname'].' '.$user['user_lastname']?>)?<br/>
												User is a <i>"<?=$user['role_name']?>"</i>.
											</p>
										</div>
										<div class="modal-footer"> 
											<a href="<?=base_url('users/remove/'.$user['user_id'])?>" class="btn btn-primary" >Confirm</a> 
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
				<a href="<?=base_url('users/add')?>" class="btn btn-primary"><i class="icon-plus"></i> Add User</a>
			</div>
		</div>
		
		
	</div>
	
</div>

