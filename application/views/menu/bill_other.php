	
	<script>


	  function undisableTxt(){
		<?php
			$x = 1; 
			while($x <= 2) {
			echo "document.getElementById('".$x."').disabled = false;";
			$x++;
			}	
		?>
		document.getElementById("plus").disabled = false;
		document.getElementById("save").disabled = false;
		document.getElementById("negatif").disabled = false;
	  }
	  
	  function goBack(){
	  	window.history.back();
	  }
	  
	  function popup(id){

	 	document.getElementById('a'+id+'').readOnly = true;
		document.getElementById('b'+id+'').readOnly = true;
		document.getElementById('total['+id+']').readOnly = true;
		document.getElementById('cadangan['+id+']').value = "0";
		document.getElementById('total['+id+']').value = "0";

        window.open("<?php echo base_url();?>cashier/find_services/"+id+"","Popup","height=550, width=980, top=70, left=180 ");
			
			// var table 		= document.getElementById('example2');
   //          var rowCount 	= table.rows.length-1;
			// var i;
			// var text 		= "";
			// //alert(rowCount); ///LOOPING PAKE TO	
			// for (i = 1; i <= rowCount; i++) { 
			// 	text += document.getElementById('fulus['+i+']').value.replace(",|.","")-1;
			// 	text++;
			// 	//text += parseFloat(text);
			// }
			// var result 		= document.getElementById('grand');
			// result.value 	= accounting.formatMoney(text);
		
      }

      function fulus(urutan){
      	document.getElementById('fulus['+urutan+']').value = document.getElementById('total['+urutan+']').value ;
      	document.getElementById('total['+urutan+']').value = accounting.formatMoney(document.getElementById('total['+urutan+']').value) ;
      }
	</script>
	<script src="<?php echo base_url();?>design/assets/acc.js"></script>
	<script language="javascript">
        function addRow(tableID) {
            var table 		= document.getElementById(tableID);
            var rowCount 	= table.rows.length;
            var row 		= table.insertRow(rowCount);
			
            // var cell1 		= row.insertCell(0);
            // var element1 	= document.createElement("input");
            // element1.type 	= "checkbox";
            // element1.name	= "chkbox[]";
            // cell1.appendChild(element1);

            var cell2 		= row.insertCell(0);
            cell2.innerHTML = rowCount + 1-1;
			
			if (rowCount >= 50) {
				document.getElementById('plus').disabled = true;
			}

            var cell3 		= row.insertCell(1);
			cell3.innerHTML = "<input type='text' id='a"+cell2.innerHTML+"' name='service["+cell2.innerHTML+"]' placeholder='service item' style='width:200px' readonly> <button id='pop"+cell2.innerHTML+"' type='button' onclick='popup("+cell2.innerHTML+");' class='btn btn-success btn-mini'><i class='icon-search'></i></button> <button type='button' onclick='undisableTxt2("+cell2.innerHTML+");' class='btn btn-success btn-mini'><i class='icon-pencil'></i></button>";


			var cell4 		= row.insertCell(2);
			cell4.innerHTML = "<div align='right'><input class='input-xlarge-i' id='total["+cell2.innerHTML+"]' name='price["+cell2.innerHTML+"]' value='0' style='width:145px; text-align:right;' type='text' onchange='fulus("+cell2.innerHTML+");' readonly><input type='hidden' name='rowcount' value='"+cell2.innerHTML+"'><input type='hidden' name='seq["+cell2.innerHTML+"]'><input type='hidden' name='id_service["+cell2.innerHTML+"]'><input type='hidden' name='fulus["+cell2.innerHTML+"]' id='fulus["+cell2.innerHTML+"]'><input type='hidden' name='orderid["+cell2.innerHTML+"]' id='orderid["+cell2.innerHTML+"]'><input type='hidden' name='orderty["+cell2.innerHTML+"]' id='orderty["+cell2.innerHTML+"]'><input type='hidden' name='group["+cell2.innerHTML+"]' id='group["+cell2.innerHTML+"]'></div>";

			var cell5 		= row.insertCell(3);
			cell5.innerHTML = '<input id="qty['+cell2.innerHTML+']" name="qty['+cell2.innerHTML+']" style="width:55px" max="9999" min="1" onkeyup="hitungan('+cell2.innerHTML+');"  type="number" required>';

			var cell6 		= row.insertCell(4);
			cell6.innerHTML = '	<input id="amount['+cell2.innerHTML+']"  name="amount['+cell2.innerHTML+']" value="0" style="width:145px; text-align:right"  type="text" onchange="fulus('+cell2.innerHTML+');" readonly> <input id="jumlah['+cell2.innerHTML+']"  name="jumlah['+cell2.innerHTML+']" value="0" style="width:145px; text-align:right"  type="hidden" readonly>';

			var cell7 		= row.insertCell(5);
			cell7.innerHTML = '<input name="base['+cell2.innerHTML+']" style="width:75px" id="b'+cell2.innerHTML+'" type="text" readonly>';

			var cell8 		= row.insertCell(6);
			cell8.innerHTML = '<textarea name="remarks['+cell2.innerHTML+']" type="text" id="4" rows="2" cols="10" style="width: 229px;"></textarea><input type="hidden" name="cadangan['+cell2.innerHTML+']" id="cadangan['+cell2.innerHTML+']" value="0">';						
        }

		function undisableTxt2(b_id){
			var cadangan 	= document.getElementById('cadangan['+b_id+']').value;

			if (cadangan == 0) {
				
			  document.getElementById('a'+b_id+'').readOnly = false;
			  document.getElementById('b'+b_id+'').readOnly = false;
			  document.getElementById('total['+b_id+']').readOnly = false;
			  document.getElementById('cadangan['+b_id+']').value = "1";
			  document.getElementById('a'+b_id+'').value = "";
			  document.getElementById('b'+b_id+'').value = "";
			  document.getElementById('total['+b_id+']').value = 0;

			}else{

			  document.getElementById('a'+b_id+'').readOnly = true;
			  document.getElementById('b'+b_id+'').readOnly = true;
			  document.getElementById('total['+b_id+']').readOnly = true;
			  document.getElementById('cadangan['+b_id+']').value = "0";
			  document.getElementById('total['+b_id+']').value = 0;

			};

		}

 		function deleteRow(tableID) {
			var table = document.getElementById(tableID);
			var rowCount = table.rows.length;	
			table.deleteRow(rowCount -1);
		}

		function hitungan(urutan){
			var fulus			= document.getElementById('fulus['+urutan+']').value;
			var qty				= document.getElementById('qty['+urutan+']').value;
			var amount			= document.getElementById('amount['+urutan+']');
			var jumlah			= document.getElementById('jumlah['+urutan+']');
			var hasil			= fulus * qty;
			jumlah.value		= hasil;
			amount.value		= accounting.formatMoney(hasil);
			console.log(hasil);

		}

    </SCRIPT>
                    <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><b>Other Billing</b></div>
                            <div class="muted pull-right" id="txt" style="font-weight: bold;"></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                      <fieldset>

										<form class="form-horizontal" action="<?php echo base_url();?>cashier/save_other_bill" method="post" name="quotation">
										
										</br>
										<INPUT class="btn btn-success" type="button" value="Add" onclick="addRow('example2')" id="plus" />
										<INPUT class="btn btn-danger" id="negatif" type="button" value="Delete" onclick="deleteRow('example2');"/>			
										</br>
										</br>
										<div style="width:100%; height:100%	; overflow: auto; float:center;">
										<table class="table table-striped table-bordered" id="example2">
										    <thead>
                                          	<tr>
												<th>No</th>
												<th>Service</th>
												<th><div align="right">Price</div></th>
												<th>Qty</th>
												<th>Amount</th>
												<th>Unit</th>
												<th>Notes</th>
											</tr>
											</thead>
											<tbody>
											<tr class="odd gradeX" id="voucher_">
												<td>1</td>
												<td>
													<INPUT type="text" name="service[1]" style="width:200px" placeholder="service item" id="a1" readonly required autocomplete="off"/> <button id="pop1" type="button" class="btn btn-success btn-mini" onclick="popup(1);"><i class="icon-search"></i></button> <button type="button" onclick="undisableTxt2(1);" class="btn btn-success btn-mini"><i class="icon-pencil"></i></button>
												</td>
												
												<td>
													<div align="right"><input id="total[1]"  name="price[1]" value="0" style="width:145px; text-align:right"  type="text" onchange="fulus(1);" readonly>
													<input type="hidden" name="seq[1]"/> 
													<input name="id_service[1]" type="hidden">
													<input id="fulus[1]" name="fulus[1]" type="hidden">
													<input name="orderid[1]" type="hidden">
													<input id="orderty[1]" name="orderty[1]" type="hidden">
													<input name="group[1]" type="hidden">
													<input type="hidden" name="rowcount" value="1" />
													<input type="hidden" name="id_reg" value="<?php echo $id_reg;?>" />
													<input type="hidden" name="id_split" value="<?php echo $id_split;?>" />
													<input type="hidden" name="id_billing" value="<?php echo $id_billing;?>" />
													</div>
												</td>
												<td><input name="qty[1]" id="qty[1]" style="width:35px" type="text" onkeyup="hitungan(1);" required></td>
												<td>
													<input id="amount[1]"  name="amount[1]" value="0" style="width:145px; text-align:right"  type="text" onchange="fulus(1);" readonly>
													<input id="jumlah[1]"  name="jumlah[1]" value="0" style="width:145px; text-align:right"  type="hidden" onchange="fulus(1);" readonly>

												</td>
												<td><input name="base[1]" style="width:75px" id="b1" type="text" readonly></td>
												<td>
													<textarea name="remarks[1]" type="text" id="4" rows="2" cols="10" style="width: 229px;"></textarea><input type="hidden" name="cadangan[1]" id="cadangan[1]" value="0">
												</td>
											</tr>
											</tbody>
										</table>	
										</fieldset>  
									    </div>
										</div>
										
										<div id="myAlert" class="modal hide">
											<div class="modal-header">
												<button data-dismiss="modal" class="close" type="button">&times;</button>
												<h5>Alert!</h5>
											</div>
											<div class="modal-body">
												<p>Are you sure ? [close] button to check again...</p>
											</div>
											<div class="modal-footer">
												<input type="submit" class="btn btn-success" id="save" onclick="this.disabled=true;this.form.submit();" value="Save">
												<a data-dismiss="modal" class="btn btn-warning" href="#">Close</a>
											</div>
										</div>
										<div class="form-actions">
										<a href="#myAlert" data-toggle="modal" class="btn btn-success">Submit</a>
										<button class="btn btn-warning" type="reset" onclick="return confirm('Do you really want to reset the form?');">Reset</button> 
                                        </div>
										<legend></legend>
										</form>                   						
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
		<!--/.fluid-container-->
    <link href="<?php echo base_url();?>design/vendors/datepicker.css" rel="stylesheet" media="screen">
    <link href="<?php echo base_url();?>design/vendors/uniform.default.css" rel="stylesheet" media="screen">
    <link href="<?php echo base_url();?>design/vendors/chosen.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo base_url();?>design/vendors/wysiwyg/bootstrap-wysihtml5.css" rel="stylesheet" media="screen">
    <script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>
    <script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>design/vendors/jquery.uniform.min.js"></script>
    <script src="<?php echo base_url();?>design/vendors/chosen.jquery.min.js"></script>
    <script src="<?php echo base_url();?>design/vendors/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url();?>design/vendors/wysiwyg/wysihtml5-0.3.0.js"></script>
    <script src="<?php echo base_url();?>design/vendors/wysiwyg/bootstrap-wysihtml5.js"></script>
    <script src="<?php echo base_url();?>design/vendors/wizard/jquery.bootstrap.wizard.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>design/vendors/jquery-validation/dist/jquery.validate.min.js"></script>
	<script src="<?php echo base_url();?>design/assets/form-validation.js"></script>
	<script src="<?php echo base_url();?>design/assets/scripts.js"></script>
	<script>
	jQuery(document).ready(function() {   
	   FormValidation.init();
	});
        $(function() {
            $(".datepicker").datepicker();
            $(".uniform_on").uniform();
            $(".chzn-select").chosen();
            $('.textarea').wysihtml5();

            $('#rootwizard').bootstrapWizard({onTabShow: function(tab, navigation, index) {
                var $total = navigation.find('li').length;
                var $current = index+1;
                var $percent = ($current/$total) * 100;
                $('#rootwizard').find('.bar').css({width:$percent+'%'});
                // If it's the last tab then hide the last button and show the finish instead
                if($current >= $total) {
                    $('#rootwizard').find('.pager .next').hide();
                    $('#rootwizard').find('.pager .finish').show();
                    $('#rootwizard').find('.pager .finish').removeClass('disabled');
                } else {
                    $('#rootwizard').find('.pager .next').show();
                    $('#rootwizard').find('.pager .finish').hide();
                }
            }});
            $('#rootwizard .finish').click(function() {
                alert('Finished!, Starting over!');
                $('#rootwizard').find("a[href*='tab1']").trigger('click');
            });
        });
    </script>
</html>