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
								<td><a href="#">Edit</a> | <a href="#">Remove</a></td>
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

