<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
    <li class="<?=($active=='dashboard'?'active':'')?>"><a href="<?=base_url('dashboard')?>"><i class="icon icon-dashboard"></i> <span>Dashboard</span></a> </li>
    <li class="submenu <?=($active=='sales' || $active=='invoice'?'active':'')?>"> 
		<a href="#"><i class="icon icon-shopping-cart"></i> <span>Sales</span> <span class="label label-important">2</span></a> 
		<ul>
			<li><a href="<?=base_url('sales/index/CREDIT')?>"><span>Invoices</span></a></li>
			<li><a href="<?=base_url('sales/index/POS')?>"><span>Receipts</span></a></li>
		</ul>
	</li>
    <li class="submenu <?=($active=='stocks'?'active':'')?>"> 
		<a href="#"><i class="icon icon-tasks"></i> <span>Stocks</span> <span class="label label-important">3</span></a> 
		<ul>
			<li><a href="<?=base_url('stocks/index')?>"><span>Stocks</span></a></li>
			<li><a href="<?=base_url('stocks/transfer')?>"><span>Stocks Transfer</span></a></li>
			<li><a href="<?=base_url('stocks/returns')?>"><span>Stocks Returns</span></a></li>
		</ul>
	</li>
    <li class="<?=($active=='warehouse'?'active':'')?>"><a href="<?=base_url('warehouse/index')?>"><i class="icon icon-home"></i> <span>Warehouses</span></a></li>
    <li class="<?=($active=='users'?'active':'')?>"><a href="<?=base_url('users/index')?>"><i class="icon icon-group"></i> <span>Users</span></a></li>
    <li class="<?=($active=='products'?'active':'')?>"><a href="<?=base_url('products/index')?>"><i class="icon icon-th-large"></i> <span>Products</span></a></li>
    <li class="<?=($active=='expenses'?'active':'')?>"><a href="<?=base_url('expenses/index')?>"><i class="icon icon-bar-chart"></i> <span>Expenses</span></a></li>
    <!--<li class="<?=($active=='income'?'active':'')?>"><a href="<?=base_url('income/index')?>"><i class="icon icon-credit-card"></i> <span>Income</span></a></li>-->
    <li class="<?=($active=='supplies'?'active':'')?>"> <a href="<?=base_url('supplies/index')?>"><i class="icon icon-truck"></i> <span>Purchases</span></a></li>
    <!--<li class="<?=($active=='invoice'?'active':'')?>"> <a href="<?=base_url('invoice/index')?>"><i class="icon icon-info-sign"></i> <span>Invoices</span></a></li>-->
    <li class="<?=($active=='accounts'?'active':'')?>"> <a href="<?=base_url('accounts/index')?>"><i class="icon icon-money"></i> <span>Accounts</span></a></li>
  </ul>
</div>
<!--sidebar-menu-->

<!--main-container-part-->
<div id="content">

<?php if ($this->session->flashdata('success') 
		&& $this->session->flashdata('success') != ""): ?>
	<div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
		<h4 class="alert-heading">Success!</h4>
		<?php echo $this->session->flashdata('success');?>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('error') 
		&& $this->session->flashdata('erro') != ""): ?>
	<div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
		<h4 class="alert-heading">Error!</h4>
        <?php echo $this->session->flashdata('error');?>
    </div>
<?php endif; ?>
