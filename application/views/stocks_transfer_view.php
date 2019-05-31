<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> 
		<a href="<?=base_url('dashboard')?>" title="Go to Dashboard" class="tip-bottom">
			<i class="icon-home"></i> Dashboard</a>
		<a href="<?=base_url('stocks')?>" title="Go to Stocks" class="tip-bottom"> Stocks</a>
		<a href="" class="current"> Transfer</a>
	</div>
	<h1>Stocks Transfer</h1>
  </div>
<!--End-breadcrumbs-->

<div class="container-fluid">
	
	<hr>
	<div class="row-fluid">
		<div class="span12">
		
			<div class="widget-box">
				<div class="widget-title">
					<span class="icon"><i class="icon-th"></i></span>
					<h5>Tansfer</h5>
				</div>
				<div class="widget-content nopadding">
					<form class="form-horizontal" method="post" action="<?=base_url('stocks/transfer')?>">
						<div class="control-group">
							<label class="control-label">Product :</label>
							<div class="controls">
								<table width="70%">
									<tr>
										<td>
											<select name="product_name[]" class="">
											<?php foreach($products as $pd): ?>
												<option value="<?=$pd['product_id']?>"><?=$pd['product_name']?></option>
											<?php endforeach; ?>
											</select>
										</td>
										<td>
											<input type="number" min="1" class="" name="product_quantity[]" placeholder="product quantity" />
										</td>
										<td>
											<button><i class="icon icon-trash"></i></button>
										</td>
									</tr>
								</table>
								<div>
									<button class="btn btn-primary"><i class="icon icon-plus"></i> Add Product</button>
								</div>
							</div>
							
							
						</div>
						<div class="control-group">
							<label class="control-label">From :</label>
							<div class="controls">
								<select name="from_warehouse" class="span6">
								<?php foreach($warehouses as $wh): ?>
									<option value="<?=$wh['warehouse_id']?>"><?=$wh['warehouse_name']?></option>
								<?php endforeach; ?>
								</select>
								<span class="help-block">Warehouse to transfer from</span>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">To :</label>
							<div class="controls">
								<select name="from_warehouse" class="span6">
								<?php foreach($warehouses as $wh): ?>
									<option value="<?=$wh['warehouse_id']?>"><?=$wh['warehouse_name']?></option>
								<?php endforeach; ?>
								</select>
								<span class="help-block">Warehouse to transfer to</span>
							</div>
						</div>
						<div class="form-actions">
							<button type="submit" class="btn btn-success">Transfer Stock</button>
						</div>

					</form>
				</div>
			</div>
			
		</div>
		
		
	</div>
	
</div>

