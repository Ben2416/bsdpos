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

<?php if($active=="invoice"): ?>
	$(document).ready(function(){
		
		//delete append item rows to items table
		$('#add_item').click(
			function(){
				$('#items_table tbody').append('<tr>'
						+'<td><input type="text" name="item_name[]" placeholder="Item name" /><input type="hidden" name="item[]" /></td>'
						+'<td><input type="number" class="qty" name="quantity[]" value="1" min="1" placeholder="Quantity" /></td>'
						+'<td class="right">'
							+'<select class="span6" name="item_price[]">'
								+'<option>retail price</option>'
								+'<option>wholesale price</option>'
								+'<option>supply price</option>'
							+'</select>  &nbsp;'
							+'<input type="text" name="rate[]" value="0" placeholder="rate" class="span6" disabled/>'
						+'</td>'
						+'<td class="right"><div id="items_amount[]"><strong>$ </strong></div><input type="hidden" name="amount[]" /></td>'
						+'<td> <a class="btn btn-danger"  onClick="$(this).closest(\'tr\').remove();"><i class="icon icon-trash"></i></a></td>'
					+'</tr>');
				
				cal_sum();
			}
		);
		
		//compute column data
		function cal_sum(){
			var $tblrows = $("#items_table tbody tr");
			$tblrows.each(function(index){
				var $tblrow = $(this);
				$tblrow.find('.qty').unbind('change');
				$tblrow.find('.qty').on('change', function(){
					var qty = $tblrow.find("[name='quantity[]']").val();
					var rate = $tblrow.find("[name='rate[]']").val();
					var amt = qty * rate;
					$tblrow.find("[name='amount[]']").val(amt);
					$tblrow.find("[id='items_amount[]']").html('<strong>$'+amt.toLocaleString()+'</strong>');
					
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
											price: el.product_price
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
							$tblrow.find("[name='rate[]']").val(el.item.price);
							$('.qty').trigger('change');
						},
						minLength: 2
					});
					
					grand_total();
				});
			});
			$('.qty').trigger('change');
		}cal_sum();
		
		function grand_total(){
			var $tblrows = $("#items_table tbody tr");
			var gtotal = 0;
			$tblrows.each(function(index){
				var $tblrow = $(this);
				var amt = $tblrow.find("[name='amount[]']").val();
				gtotal += parseInt(amt);
			});
			$("#gtotal").html(''+gtotal.toLocaleString());
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
