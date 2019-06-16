</div>

<!--end-main-container-part-->

<!--Footer-part-->

<div class="row-fluid">
  <div id="footer" class="span12"> <?=date('Y')?> &copy; BenieTech Corporation </div>
</div>

<!--end-Footer-part-->

<script src="<?=base_url('assets/')?>js/excanvas.min.js"></script> 
<script src="<?=base_url('assets/')?>js/jquery.min.js"></script> 
<script src="<?=base_url('assets/')?>js/jquery.ui.custom.js"></script> 
<script src="<?=base_url('assets/')?>js/bootstrap.min.js"></script> 
<script src="<?=base_url('assets/')?>js/bootstrap-colorpicker.js"></script> 
<script src="<?=base_url('assets/')?>js/bootstrap-datepicker.js"></script> 
<!--<script src="<?=base_url('assets/')?>js/jquery.flot.min.js"></script> 
<script src="<?=base_url('assets/')?>js/jquery.flot.resize.min.js"></script> -->
<script src="<?=base_url('assets/')?>js/jquery.peity.min.js"></script> 
<script src="<?=base_url('assets/')?>js/fullcalendar.min.js"></script> 
<script src="<?=base_url('assets/')?>js/matrix.js"></script> 
<script src="<?=base_url('assets/')?>js/matrix.dashboard.js"></script>
<script src="<?=base_url('assets/')?>js/jquery.gritter.min.js"></script>
<script src="<?=base_url('assets/')?>js/matrix.interface.js"></script> 
<script src="<?=base_url('assets/')?>js/matrix.chat.js"></script> 
<script src="<?=base_url('assets/')?>js/jquery.validate.js"></script> 
<script src="<?=base_url('assets/')?>js/matrix.form_validation.js"></script> 
<script src="<?=base_url('assets/')?>js/jquery.wizard.js"></script> 
<script src="<?=base_url('assets/')?>js/jquery.uniform.js"></script> 
<script src="<?=base_url('assets/')?>js/select2.min.js"></script> 
<script src="<?=base_url('assets/')?>js/matrix.popover.js"></script> 
<script src="<?=base_url('assets/')?>js/jquery.dataTables.min.js"></script> 
<script src="<?=base_url('assets/')?>js/matrix.tables.js"></script>
<script src="<?=base_url('assets/')?>js/masked.js"></script> 

<script>

<?php if($active == "expenses"): ?>
	$(document).ready(function(){
	<?php if(@$sub_page == "add"): ?>
		var admin_expenses = <?=$admin_expenses?>;
		var fc_expenses = <?=$fc_expenses?>;
		var sd_expenses = <?=$sd_expenses?>;
		function expense_class(){
			$('#expense_item').empty();
			if($('#expense_class').val() == "Admin"){
				$.each(admin_expenses, function(a, b){
					$('#expense_item').append('<option>'+b.expense_item+'</option>');
				});
			}else if($('#expense_class').val() == "Finance Cost"){
				$.each(fc_expenses, function(a, b){
					$('#expense_item').append('<option>'+b.expense_item+'</option>');
				});
			}else{
				$.each(sd_expenses, function(a, b){
					$('#expense_item').append('<option>'+b.expense_item+'</option>');
				});
			}
			$('#expense_item').append('<option>Other</option>');
			$('#expense_item').trigger('change');
			//$('#expense_item').val( $('#expense_item option:first').val() );
			//$('#expense_item option:first').attr('selected', 'selected');
			//$('#expense_item option:first').prop('selected', true);
		}
		
		expense_class();
		
		$('#expense_class').on('change', function(){
			expense_class();
		});
	
		$('#expense_item').on('change', function(){
			if($('#expense_item').val() == "Other"){
				$('#new_expense_div').show();
				$('#new_expense_item').attr('disabled', false);
			}else{
				$('#new_expense_div').hide();
				$('#new_expense_item').attr('disabled', true);
			}
		});
	<?php endif; ?>
	});
<?php endif; ?>

<?php if($active=="invoice"): ?>
	$(document).ready(function(){
		
		function add_item_row(){
			$('#items_table tbody').append('<tr>'
					+'<td><input type="text" name="item_name[]" id="item_name[]" placeholder="Item name" required="required" /><input type="hidden" name="item[]" /></td>'
					+'<td><input type="number" class="qty" name="quantity[]" value="1" min="1" placeholder="Quantity" /></td>'
					+'<td class="right">'
						+'<select class="span6" name="item_price[]" id="item_price[]" required="required">'
						+'</select>  &nbsp;'
						+'<input type="text" name="rate[]" value="0" placeholder="rate" class="span6" disabled/>'
					+'</td>'
					+'<td class="right"><div id="items_amount[]"><strong>&#8358; </strong></div><input type="hidden" name="amount[]" /></td>'
					+'<td> <a name="item_remove[]" class="btn btn-danger"  onClick="//$(this).closest(\'tr\').remove();"><i class="icon icon-trash"></i></a></td>'
				+'</tr>'
			);
			cal_sum();
		}
		
		function remove_item_row(ele){
			ele.remove();
			grand_total();
		}
		
		//add_item_row();
		
		//delete append item rows to items table
		$('#add_item').click(add_item_row);
		
		//compute column data
		function cal_sum(){
			var $tblrows = $("#items_table tbody tr");
			$tblrows.each(function(index){
				var $tblrow = $(this);
				$tblrow.find('.qty').unbind('change');
				$tblrow.find('.qty').on('change', function(){
					var qty = parseFloat($tblrow.find("[name='quantity[]']").val());
					var rate = parseFloat($tblrow.find("[name='rate[]']").val());
					var amt = parseFloat(qty * rate).toFixed(2);
					$tblrow.find("[name='amount[]']").val(amt);
					$tblrow.find("[id='items_amount[]']").html('<strong>&#8358;'+amt.toLocaleString()+'</strong>');
					
					$tblrow.find("[name='item_name[]']").autocomplete({
						source: function( request, response ) {
							$.ajax({
								url: "<?=base_url('products/getproduct')?>",
								type: 'POST',
								dataType: "json",
								data: {product: request.term},
								success: function( data ) { //alert(JSON.stringify(data));
									//response( data );
									response($.map(data, function (el) {
										return {
											label: el.product_name,
											value: el.product_id,
											wholesale_price: el.product_wholesale_price,
											supply_price: el.product_supply_price,
											retail_price: el.product_retail_price
										};
									}));
								},
								error: function(a,b,c){
									alert(a+b+c);
								}
							});
						},
						select:function (e, el) {
							e.preventDefault(); 
							$tblrow.find("[name='item_name[]']").val(el.item.label);
							$tblrow.find("[name='item[]']").val(el.item.value);
							
							$tblrow.find("[name='item_price[]']").empty();
							$tblrow.find("[name='item_price[]']").append('<option value="'+el.item.retail_price+'">Retail Price</option>');
							$tblrow.find("[name='item_price[]']").append('<option value="'+el.item.wholesale_price+'">Wholesale Price</option>');
							$tblrow.find("[name='item_price[]']").append('<option value="'+el.item.supply_price+'">Supply Price</option>');
							
							$tblrow.find("[name='rate[]']").val(el.item.retail_price);
							$('.qty').trigger('change');
						},
						minLength: 1
					});
					
					$tblrow.find("[name='item_price[]'").on('change', function(){
						$tblrow.find("[name='rate[]']").val($tblrow.find("[name='item_price[]']").val());
						$('.qty').trigger('change');
					});
					
					$tblrow.find("[name='item_remove[]']").on('click', function(){
						//alert('hi');
						$tblrow.find("[name='item_remove[]']").closest('tr').remove();
						//$('.qty').trigger('change');
						grand_total();
					});
					
					grand_total();
				});
			});
			$('.qty').trigger('change');
		}cal_sum();
		
		function grand_total(){
			var $tblrows = $("#items_table tbody tr");
			var gtotal = 0.00;
			$tblrows.each(function(index){
				var $tblrow = $(this);
				var amt = parseFloat($tblrow.find("[name='amount[]']").val());
				gtotal = (parseFloat(amt)+parseFloat(gtotal)).toFixed(2);
			});
			stotal = (parseFloat(gtotal) - parseFloat($('#invoice_extra_discount').val())).toFixed(2);
			$("#stotal").html(''+gtotal.toLocaleString());
			$("#gtotal").html(''+stotal.toLocaleString());
			
			$("#invoice_subtotal").val(gtotal);
			$("#invoice_total").val(stotal);
			
		}
		
		$('#invoice_extra_discount').on('change', function(){
			grand_total();
		});$('#invoice_extra_discount').on('keyup', function(){
			grand_total();
		});
		
	});
<?php endif; ?>

<?php if($active=="stocks"): 
		if(@$page != "return"):
	$wh_json = json_encode($warehouses);
?>
$(document).ready(function(){
	var wh_json = <?=$wh_json?>;
	function add_st_product(){
		$("#st_table tbody").append('<tr>'
			+'<td><input name="product_name[]" class="span12"><input type="hidden" name="product[]" /></td>'
			+'<td><input type="number" min="1" class="" name="product_quantity[]" placeholder="product quantity" /></td>'
			+'<td><span class="span12" id="products_available[]">0</span><input type="hidden" name="price[]" /></td>'
			+'<td><a class="btn btn-danger" onclick="$(this).closest(\'tr\').remove();"><i class="icon icon-trash"></i></a></td>'
		+'</tr>');
		prep_rows();
	}
	
	$("#add_product").click(add_st_product);
	
	function prep_rows(){
		var $tblrows = $("#st_table tbody tr");
		$tblrows.each(function(index){
			var $tblrow = $(this);
			//stock transfer item autocomplete
			$tblrow.find("[name='product_name[]']").autocomplete({
				source: function( request, response ) {
					$.ajax({
						url: "<?=base_url('products/getproductwithstock')?>",
						type: 'POST',
						dataType: "json",
						data: {product: request.term, warehouse: $("#from_warehouse").val()},
						success: function( data ) {
							response($.map(data, function (el) {
								return {
									label: el.product_name,
									value: el.product_id,
									quantity: el.stock_quantity,
									price: el.product_supply_price
								};
							}));
						},
						error: function(a,b,c){
							alert(a+b+c);
						}
					});
				},
				select:function (e, el) {
					e.preventDefault(); 
					$tblrow.find("[name='product_name[]']").val(el.item.label);
					$tblrow.find("[name='product[]']").val(el.item.value);
					$tblrow.find("[name='product_quantity[]']").attr('max', el.item.quantity);
					$tblrow.find("[id='products_available[]']").html(el.item.quantity);
					$tblrow.find("[name='price[]']").val(el.item.price);
					//$('.qty').trigger('change');
				},
				minLength: 1
			});
		});
	}//end of prep
	
	$("#from_warehouse").on('change', function(){
		$("#to_warehouse").empty();
		$.each(wh_json, function(a, b){
			if($("#from_warehouse").val() == b.warehouse_id)
				return true;
			$("#to_warehouse").append('<option selected value="'+b.warehouse_id+'">'+b.warehouse_name+'</option>');
		});
		$("#to_warehouse").val($("#to_warehouse option:first").val()).change();
		$("#st_table tbody").empty();
	});
	$("#from_warehouse").trigger('change');
});

<?php elseif(@$page == "return"): ?>
	$(document).ready(function(){
		function init_rows(){
			var $tblrows = $("#sr_table tbody tr");
			$tblrows.each(function(index){
				var $tblrow = $(this);
				$tblrow.find('.ifr').on('change',function(){
					var qty = parseFloat($tblrow.find("[name='quantity[]']").val());
					var rate = parseFloat($tblrow.find("[name='rate[]']").val());
					var fr = qty - $tblrow.find("[name='returned[]']").val();
					$tblrow.find("[id='asold[]']").html(fr);
					$tblrow.find("[id='itotal[]']").html((fr*rate).toFixed(2));
					$tblrow.find("[name='total[]']").val((fr*rate).toFixed(2));
					r_total();
				});
			});
		}
		init_rows();
		
		function r_total(){
			var $tblrows = $("#sr_table tbody tr");
			var gtotal = 0.00;
			$tblrows.each(function(index){
				var $tblrow = $(this);
				var amt = parseFloat($tblrow.find("[name='total[]']").val());
				gtotal = (parseFloat(amt)+parseFloat(gtotal)).toFixed(2);
			});
			$("#rtotal").html(''+gtotal.toLocaleString());
			$("#return_total").val(gtotal);
		}
	});
		
<?php 	endif;
	endif; ?>

<?php if($active=="supplies"): ?>
$(document).ready(function(){
	function add_supply_item(){
		$('#supply_table tbody').append('<tr>'
			+'<td><input required type="text" name="supply_name[]" class="span12" placeholder="Supply item" /><input type="hidden" name="supply_item[]" /></td>'
			+'<td><input required type="number" name="supply_quantity[]" min="1" value="1" class="span12 qty" placeholder="Supply Quantity" /></td>'
			+'<td><input required type="number" name="supply_rate[]" min="0" class="span12" placeholder="Supply rate" /></td>'
			+'<td><span id="items_amount[]"><strong>&#8358; 0</strong></span><input type="hidden" name="supply_amount[]" min="0"  class="span12" placeholder="Supply amount" /></td>'
			+'<td><a title="Remove" class="tip-bottom btn btn-danger" onClick="$(this).closest(\'tr\').remove()"><i class="icon icon-trash"></i></a></td>'
		+'</tr>');
		prep_rows();
	}
	add_supply_item();//add first row
	$('#add_item').click(add_supply_item);//add row on click
	
	function prep_rows(){
		var $tblrows = $("#supply_table tbody tr");
		$tblrows.each(function(index){
			var $tblrow = $(this);
			
			$tblrow.find('.qty').unbind('change');
			$tblrow.find('.qty').on('change', function(){
				var qty = $tblrow.find("[name='supply_quantity[]']").val();
				var rate = $tblrow.find("[name='supply_rate[]']").val();
				var amt = (qty * rate).toFixed(2);
				$tblrow.find("[name='supply_amount[]']").val(amt);
				$tblrow.find("[id='items_amount[]']").html('<strong>&#8358; '+amt.toLocaleString()+'</strong>');
			});		
			
			//supply item autocomplete
			$tblrow.find("[name='supply_name[]']").autocomplete({
				source: function( request, response ) {
					$.ajax({
						url: "<?=base_url('products/getproduct')?>",
						type: 'POST',
						dataType: "json",
						data: {product: request.term},
						success: function( data ) {
							response($.map(data, function (el) {
								return {
									label: el.product_name,
									value: el.product_id,
									supply_price: el.product_supply_price
								};
							}));
						},
						error: function(a,b,c){
							alert(a+b+c);
						}
					});
				},
				select:function (e, el) {
					e.preventDefault(); 
					$tblrow.find("[name='supply_name[]']").val(el.item.label);
					$tblrow.find("[name='supply_item[]']").val(el.item.value);
					$tblrow.find("[name='supply_rate[]']").val(el.item.supply_price);
					var qty = $tblrow.find("[name='supply_quantity[]']").val();
					var rate = $tblrow.find("[name='supply_rate[]']").val();
					var amt = (qty * rate).toFixed(2);
					$tblrow.find("[name='supply_amount[]']").val(amt);
					$tblrow.find("[id='items_amount[]']").html('<strong>&#8358; '+amt.toLocaleString()+'</strong>');
					//$('.qty').trigger('change');
				},
				minLength: 1
			});
			
			
		});
	}
	
});
<?php endif; ?>

</script>
<script src="<?=base_url('assets/')?>js/matrix.form_common.js"></script>


<script type="text/javascript">
  // This function is called from the pop-up menus to transfer to
  // a different page. Ignore if the value returned is a null string:
  function goPage (newURL) {

      // if url is empty, skip the menu dividers and reset the menu selection to default
      if (newURL != "") {
      
          // if url is "-", it is this page -- reset the menu:
          if (newURL == "-" ) {
              resetMenu();            
          } 
          // else, send page to designated URL            
          else {  
            document.location.href = newURL;
          }
      }
  }

// resets the menu selection upon entry to this page:
function resetMenu() {
	document.gomenu.selector.selectedIndex = 2;
}

</script>
</body>
</html>
