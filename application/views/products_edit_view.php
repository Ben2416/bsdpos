<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> 
		<a href="<?=base_url('dashboard')?>" title="Go to Dashboard" class="tip-bottom">
			<i class="icon-home"></i> Dashboard</a>
		<a href="<?=base_url('products')?>" > Products</a>
		<a href="" class="current"> Edit</a>
	</div>
	<h1>Products</h1>
  </div>
<!--End-breadcrumbs-->

<div class="container-fluid">
	
	<hr>
	<div class="row-fluid">
		<div class="span12">
		
			<div class="widget-box">
				<div class="widget-title">
					<span class="icon"><i class="icon-th"></i></span>
					<h5>Edit Product</h5>
				</div>
				<div class="widget-content nopadding">
				
					<form action="<?=base_url('products/edit/'.$product_id)?>" method="post" class="form-horizontal">
						
						<div class="control-group">
							<?=validation_errors()?>
						</div>
						
						<div class="control-group">
							<label class="control-label">Product Name : </label>
							<div class="controls">
								<input type="text" class="span11" placeholder="Product name" name="product_name" value="<?=$product['product_name']?>" >
							</div>
						</div>
						
						
						<div class="control-group">
							<label class="control-label">Product Description :</label>
							<div class="controls">
								<textarea class="span11" placeholder="Product Description" name="product_description"><?=$product['product_description']?></textarea>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label">Product Price</label>
							<div class="controls">
								<input type="number" class="span2" placeholder="product price" name="product_price" value="<?=$product['product_price']?>" min="0" > 
								<input type="number" class="span3" placeholder="Wholesale price" name="wholesale_price" value="<?=$product['product_wholesale_price']?>" min="0" > 
								<input type="number" class="span3" placeholder="Supply price" name="supply_price" value="<?=$product['product_supply_price']?>" min="0" > 
								<input type="number" class="span3" placeholder="Retail price" name="retail_price" value="<?=$product['product_retail_price']?>" min="0" > 
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label">Product Quantity</label>
							<div class="controls">
								<input type="number" class="span11" placeholder="product Quantity" name="product_quantity" value="<?=$product['product_quantity']?>" min="1" > 
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label">Product Warehouse</label>
							<div class="controls">
								<select name="product_warehouse" class="span11">
								<?php foreach($warehouses as $wh): ?>
									<option value="<?=$wh['warehouse_id']?>" <?=(($product['product_warehouse']==$wh['warehouse_id'])?'selected':'')?>><?=$wh['warehouse_name']?></option>
								<?php endforeach; ?>
								</select>
							</div>
						</div>
						
						<div class="form-actions">
							<button type="submit" class="btn btn-success"> <i class="icon icon-plus"></i> Edit Product </button>
						</div>
						

					</form>
					
				</div>
			</div>
			
		</div>
	</div>
	
</div>

