<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> 
		<a href="<?=base_url('dashboard')?>" title="Go to Users" class="tip-bottom">
			<i class="icon-home"></i> Dashboard</a>
		<a href="" class="current"> Stocks</a>
	</div>
	<h1>Stocks Returned</h1>
  </div>
<!--End-breadcrumbs-->

<div class="container-fluid">
	
	<hr>
	<div class="row-fluid">
		<div class="span12">
		
			
			
			<div class="widget-box">
				<div class="widget-title"> <span class="icon"> <i class="icon-briefcase"></i> </span>
					<h5>EDDINHO INTERNATIONAL</h5>
				</div>
				<div class="widget-content">
					<div class="row-fluid">
						<div class="span6">
							<table class="">
								<tbody>
									<tr>
										<td><h4>Eddinho International</h4></td>
									</tr>
									<tr>
										<td>Abuja</td>
									</tr>
									<tr>
										<td>Federal Capital Territory</td>
									</tr>
									<tr>
										<td>Mobile Phone: +4530422244</td>
									</tr>
									<tr>
										<td >sales@eddinho.com</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="span6">
							<table class="table table-bordered table-invoice">
								<tbody>
									<tr>
										<tr>
											<td class="width30">Invoice ID:</td>
											<td class="width70"><strong>ED-6546234</strong></td>
										</tr>
										<tr>
											<td>Issue Date:</td>
											<td><strong><?=date('M d, Y')?></strong></td>
										</tr>
										<tr>
											<td>Due Date:</td>
											<td><strong>April 01, 2021</strong></td>
										</tr>
										<td class="width30">Client Address:</td>
											<td class="width70"><strong>Torera Nigeria LTD</strong> <br>
											2 Jereton Mariere, Apo Legislative Quarters <br>
											Abuja<br>
											Contact No: 0803 000 0000 <br>
											Email: simeona@torera.com </td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span12">
							<table class="table table-bordered table-invoice-full">
								<thead>
									<tr>
										<th class="head0">Item Name</th>
										<th class="head1">Units Supplied</th>
										<th class="head0 right">Emties Returned</th>
										<th class="head0 right">Actual Units Sold</th>
										<th class="head1 right">Amount</th>
									</tr>
								</thead>
							<tbody>
								<tr>
									<td>Guiness Malt</td>
									<td>2</td>
									<td class="right">150</td>
									<td class="right"><input type="number" class="span4" /></td>
									<td class="right"><strong>$300</strong></td>
								</tr>
								<tr>
									<td>Coca Cola</td>
									<td>12</td>
									<td class="right">1000</td>
									<td class="right"><input type="number" class="span4" /></td>
									<td class="right"><strong>$1,2000</strong></td>
								</tr>
								<tr>
									<td>Miranda</td>
									<td>17</td>
									<td class="right">100</td>
									<td class="right"><input type="number" class="span4" /></td>
									<td class="right"><strong>$1,700</strong></td>
								</tr>
								<tr>
									<td>Sprite</td>
									<td>10</td>
									<td class="right">255</td>
									<td class="right"><input type="number" class="span4" /></td>
									<td class="right"><strong>$2,550</strong></td>
								</tr>
								<tr>
									<td>Beta Malt</td>
									<td>5</td>
									<td class="right">50</td>
									<td class="right"><input type="number" class="span4 m-wrap" /></td>
									<td class="right"><strong>$250</strong></td>
								</tr>
							</tbody>
						</table>
						<table class="table table-bordered table-invoice-full">
							<tbody>
								<tr>
									<td class="msg-invoice" width="85%"><h4>Payment method: </h4>
										<a href="#" class="tip-bottom" title="Wire Transfer">Cash Deposit</a> |  <a href="#" class="tip-bottom" title="Bank account">Bank Transfer</a> |  <a href="#" class="tip-bottom" title="SWIFT code">SWIFT code </a> </a></td>
									<td class="right"><strong>Subtotal</strong> <br>
										<strong>Tax (5%)</strong> <br>
										<strong>Discount</strong></td>
									<td class="right"><strong>$16,800 <br>
										$100 <br>
										$50</strong></td>
								</tr>
							</tbody>
						</table>
						<div class="">
							<table class="table table-bordered">
								<tbody>
									<tr>
										<td>
											<div class="form-controls">
												<label class="span6">Payment Method: </label>
												<select class="control span6">
													<option>Payment on Delivery</option>
													<option>Payment on return</option>
												</select>
											</div>
										</td>
									</tr>	
								</tbody>
							</table>
						</div>
						<div class="pull-right">
							<h4><span>Amount Due:</span> $16,850.00</h4>
							<br>
							<a class="btn btn-primary btn-large pull-right" href="">Pay Invoice</a> </div>
						</div>
					</div>
				</div>
			</div>

			
			
		</div>
		
		
	</div>
	
</div>

