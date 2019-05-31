<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> 
		<a href="<?=base_url('dashboard')?>" title="Go to Users" class="tip-bottom">
			<i class="icon-home"></i> Dashboard</a>
		<a href="" class="current"> Accounts</a>
	</div>
	<h1>Accounts</h1>
  </div>
<!--End-breadcrumbs-->

<div class="container-fluid">
	
	<hr>
	<div class="row-fluid">
		<div class="span12">
		
			<div class="widget-box">
				<div class="widget-title">
					<span class="icon"><i class="icon-th"></i></span>
					<h5>Warehouse Accounts</h5>
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
								<!--<p> <?=$warehouses[$i]['warehouse_name']?></p>-->
								<div class="widget-box">
									<div class="widget-title">
										<span></span>
										<h5>Payment Confirmations</h5>
									</div>
									<div class="widget-content nopadding">
										<table class="table table-bordered">
											<thead>
												<tr>
													<th>Invoice Number</th>
													<th>Customer Info</th>
													<th>Sales Amount</th>
													<th>Payment Status</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td><a href="<?=base_url('accounts/payment_confirmation/')?>2341234">2341234</a></td>
													<td>Mr. Simeon Afolabi</td>
													<td>$12,000</td>
													<td><span class="label label-info">Partly Paid</span></td>
												</tr>
												<tr>
													<td>2341544</td>
													<td>Mr. Balogun David</td>
													<td>&#x20A6;$22,000</td>
													<td><span class="label label-important">Not Paid</span></td>
												</tr>
												<tr>
													<td>2341545</td>
													<td>Madam Betty</td>
													<td>&#8358;$54,000</td>
													<td><span class="label label-success">Fully Paid</span></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<?php endfor;?>
							<?php if(count($warehouses)>0):?>
								<div id="tab<?=count($warehouses)?>" class="tab-pane">
								<p> Summation</p>
							</div>
							<?php endif;?>
						</div>
					</div>
				</div>
			
			</div>
		
		
		</div>
	
	</div>

</div>