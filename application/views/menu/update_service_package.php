	<?php
		$id						= $this->uri->segment(3);
		$session_data 			= $this->session->userdata('logged_in');
		$userlvl				= $session_data['userlevel'];
		if($id=="ok"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Input Master Package
		</div>
	<?php
		}elseif($id=="change"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Update Data Master Services
	    </div>
	<?php
		}elseif($id=="del"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Delete Master Services
		</div>
	<?php
		}

	?>	
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
		document.getElementById("qty").disabled = false;
	  }
	  
	  function goBack(){
	  	window.history.back();
	  }
	  
	  function popup(id){
        window.open("<?php echo base_url();?>marketing/find_servicesn/"+id+"","Popup","height=700, width=1400, top=50, left=10 ");
			
			var table 		= document.getElementById('example2');
            var rowCount 	= table.rows.length-1;
			var i;
			var text 		= "";
			//alert(rowCount); ///LOOPING PAKE TO	
			for (i = 1; i <= rowCount; i++) { 
				text += document.getElementById('fulus['+i+']').value.replace(",|.","")-1;
				text++;
				//text += parseFloat(text);
			}
			var result 		= document.getElementById('grand');
			result.value 	= accounting.formatMoney(text);
		
      }
	</script>
	<script src="<?php echo base_url();?>design/assets/acc.js"></script>
	<script language="javascript">
        function addRow(tableID) {
            var table 		= document.getElementById(tableID);
            var rowCount 	= table.rows.length;
            var row 		= table.insertRow(rowCount);
			
            var cell2 		= row.insertCell(0);
            cell2.innerHTML = rowCount + 1-1;
			
			if (rowCount >= 50) {
				document.getElementById('plus').disabled = true;
			}

            var cell3 		= row.insertCell(1);
			cell3.innerHTML = "<input type='text' id='a"+cell2.innerHTML+"' name='service["+cell2.innerHTML+"]' placeholder='service item' style='width:585px' required> <button id='pop"+cell2.innerHTML+"' type='button' onclick='popup("+cell2.innerHTML+");' class='btn btn-success btn-mini'><i class='icon-search'></i></button>";

			var cell4 		= row.insertCell(2);
			cell4.innerHTML = "<div align='right'><input class='input-xlarge-i' id='total["+cell2.innerHTML+"]' onchange='setBlurFocus("+cell2.innerHTML+");' name='price["+cell2.innerHTML+"]' placeholder='0' style='width:145px; text-align:right;' type='text'><input type='hidden' name='rowcount' value='"+cell2.innerHTML+"'><input type='text' name='seq["+cell2.innerHTML+"]'><input type='text' name='id["+cell2.innerHTML+"]'><input type='text' name='fulus["+cell2.innerHTML+"]' id='fulus["+cell2.innerHTML+"]'><input type='text' name='orderid["+cell2.innerHTML+"]' id='orderid["+cell2.innerHTML+"]'><input type='text' name='id_service["+cell2.innerHTML+"]' id='id_service["+cell2.innerHTML+"]'><input type='text' name='orderty["+cell2.innerHTML+"]' id='orderty["+cell2.innerHTML+"]'><input type='text' name='group["+cell2.innerHTML+"]' id='group["+cell2.innerHTML+"]'></div>";
        }

		function loadgrandtotal(tableID){
			var table 		= document.getElementById(tableID);
            var rowCount 	= table.rows.length-1;
			var i;
			var text 		= "";
			//alert(rowCount); ///LOOPING PAKE TO	
			for (i = 1; i <= rowCount; i++) { 
				text += document.getElementById('fulus['+i+']').value.replace(",|.","")-1;
				text++;
				//text += parseFloat(text);
			}
			var adjs_baru			= document.getElementById('adjs_amt').value.replace(",",""); 	
			var result 				= document.getElementById('grand');
			// var baby 				= document.getElementById('grand').value.replace(",","");
			var result_2			= document.getElementById('grandma');
			var adjs 				= document.getElementById('adjs').value;
			var adjs_a 				= document.getElementById('adjs_amt');
			result.value 			= accounting.formatMoney(text);
			result_2.value 			= text;
			
			var goblin				= text * (adjs/100);
			console.log(goblin);
			adjs_a.value			= accounting.formatMoney(text * adjs/100);
			var glendotan			= document.getElementById('peka');
			glendotan.value 		= accounting.formatMoney(text + goblin);
			//console.debug(result_2.value)
		}

			function loadgrandtotal2(tableID){
			var table 		= document.getElementById(tableID);
            var rowCount 	= table.rows.length-1;
			var i;
			var text 		= 0;

			//alert(rowCount); ///LOOPING PAKE TO	
			for (i = 1; i <= rowCount; i++) { 

			var total 		= document.getElementById('total['+i+']');
			var fulus 		= document.getElementById('fulus['+i+']');

			fulus.value		= total.value.replace(",","").replace(",","").replace(",","").replace(",","")


			if (document.getElementById('id_service['+i+']').value==0){
				text += document.getElementById('fulus['+i+']').value.replace(",","")-1;
				//console.log("a");
				
			}else{
				text += document.getElementById('fulus['+i+']').value.replace(",","")-1;
				//console.log("b");
			}
			console.log(text);
				text++;
				//text += parseFloat(text);
			}
			
			var adjs_baru			= document.getElementById('adjs_amt').value.replace(",",""); 	
			var result 				= document.getElementById('grand');
			// var baby 				= document.getElementById('grand').value.replace(",","");
			var result_2			= document.getElementById('grandma');
			var adjs 				= document.getElementById('adjs');
			var adjs_a 				= document.getElementById('adjs_amt').value.replace(",","").replace(",","");
			var disc_3				= document.getElementById('adjs');
			//console.log(adjs_a);
			//adjs.value				= accounting.formatMoney(text * adjs/100);
			var glendotan			= document.getElementById('peka');
			glendotan.value 		= accounting.formatMoney(parseInt(text) + parseInt(adjs_a));
			var glendotanx			= glendotan.value.replace(",","").replace(",","");
			// console.log(glendotanx);
			//adjs.value				= text * (adjs/100);
			//alert(result.value);

			disc_3.value  			= Math.round(parseInt(adjs_a)/parseInt(glendotan.value.replace(",","").replace(",",""))*100);
			// disc_3.value  			= Math.round(parseInt(adjs_a)/parseInt(glendotanx)*100);
			
			var goblin				= text * (adjs/100);
	
			//console.debug(result_2.value)
		}

		function loadgrandtotal3(){
			var grand		= document.getElementById("grand").value.replace(",","").replace(",","");
			var margin1		= document.getElementById("adjs");
			var margin2		= document.getElementById("adjs_amt");
			var sell 		= document.getElementById("peka").value.replace(",","").replace(",","");
			var cost 		= document.getElementById("grand").value.replace(",","").replace(",","");

			margin2.value	= accounting.formatMoney(sell - cost);
			margin1.value 	= Math.round(parseInt(margin2.value.replace(",","").replace(",",""))/parseInt(grand)*100);
			// margin1.value 	= Math.round(parseInt(margin2.value)/parseInt(sell)*100);
		}
		
		function loadgrandtotal4(){
			var qty			= document.getElementById("qty").value;
			var sell 		= document.getElementById("peka").value.replace(",","").replace(",","");
			var margin2		= document.getElementById("pekas");
			margin2.value	= accounting.formatMoney(sell * qty);
		}
		
		function margins(){
			var qty			= document.getElementById("adjs").value;
			var sell 		= document.getElementById("grand").value.replace(",","").replace(",","");
			var margin2		= document.getElementById("adjs_amt");
			margin2.value	= accounting.formatMoney(sell * qty / 100);
		}

		function persen_adm(id){
			var qty			= document.getElementById("persen_adm["+id+"]").value;
			var sell 		= document.getElementById("peka").value.replace(",","").replace(",","");
			var margin2		= document.getElementById("total["+id+"]");
			margin2.value	= accounting.formatMoney(sell * qty / 100);
		}

		function persen_adm2(id){
			var qty			= document.getElementById("peka").value.replace(",","").replace(",","");
			var sell 		= document.getElementById("total["+id+"]").value;
			var margin2		= document.getElementById("persen_adm["+id+"]");
			console.log(sell);
			margin2.value	= parseInt((sell / qty) * 100);
		}
		
		function undisableTxt2(b_id){
			if(document.getElementById('a'+b_id+'').readOnly == true){
			document.getElementById('a'+b_id+'').readOnly = false;
			}else{
			document.getElementById('a'+b_id+'').readOnly = true;
			}
		}
		
		function undisableTxt1(){
			document.getElementById('f').readOnly = false;
		}
 
        function deleteRow(tableID){
			var table = document.getElementById(tableID);
			var rowCount = table.rows.length;	
			table.deleteRow(rowCount-1);
        }
			
		function setBlurFocus(id) {
			var total		= document.getElementById('total['+id+']');
			var fulus		= document.getElementById('fulus['+id+']');
			fulus.value = total.value ;
			var user_input 	= accounting.formatMoney(document.getElementById('total['+id+']').value);
			document.getElementById('total['+id+']').value = user_input;
		}

		$(document).ready(function() {
		  $(window).keydown(function(event){
		    if(event.keyCode == 13) {
		      event.preventDefault();
		      return false;
		    }
		  });
		});


    </script>
				<body onload="startTime()">
                    <!-- morris stacked chart -->
                    <div class="row-fluid" onmouseover="loadgrandtotal('example2'); loadgrandtotal4();">
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><b>Update Service Package</b></div>
							<div class="muted pull-right" id="txt" style="font-weight: bold;"></div>
                            </div>
							<div class="form-actions">
							<button onclick="undisableTxt()" class="btn btn-primary btn-large">Start</button>
							</div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                      <fieldset>

                                      	<?php  foreach($list->result() as $rlist){} ?>
										<form class="form-horizontal" action="<?php echo base_url();?>marketing/save_s_package" method="post" name="quotation">
										<!--<div id="" style="overflow-y: scroll; height:260px;">-->
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Package Name</label>
                                          <div class="controls">
										  <input class="input-xlarge focused" name="p_name" type="text" id="1" autocomplete="off" value="<?=$rlist->package_name?>" disabled required>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="select01">Company</label>
                                          <div class="controls">
                                            <select class="chzn-select" id="id_client" name="p_client" required>
                                              <option value="">- Choose Company Name -</option>
                                              <?php 
                                              $id_client = $rlist->id_client;
											  foreach($get_client->result() as $rows){
											  	if ($id_client == $rows->id_Client) {
											  		$pilih = "selected";
											  	}else{
											  		$pilih = "";
											  	}
											  ?>
												<option value="<?=$rows->id_Client?>" <?=$pilih?> align="justify"><?=$rows->client_name?></option>
											  <?php
											  }
											  ?>
                                            </select>
                                          </div>
                                        </div>
																	
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Qty. Estimate</label>
                                          <div class="controls">
                                            <input class="input-xlarge datepicker" id="2" name="p_exp" placeholder="Click Here ..." type="hidden" autocomplete="off" disabled required> 
                                            <!-- <i class="icon-calendar"></i>  -->
                                            <input class="input-small" name="qty" id="qty" onkeyup="loadgrandtotal4();" type="number" value="<?=$rlist->qty?>" autocomplete="off" disabled required> <i class="icon-user"></i> <b>Pax</b>
                                          </div>
                                        </div>
										
										</br>
										<input class="btn btn-success" type="button" value="Add" onclick="addRow('example2')" id="plus" />
										<input class="btn btn-danger" id="negatif" type="button" value="Delete" onclick="deleteRow('example2'); loadgrandtotal('example2');"/>			
										</br>
										</br>
										<div style="width:100%; height:100%	; overflow: auto; float:center;">
										<table class="table table-striped table-bordered" id="example2">
										    <thead>
                                          	<tr>
												<th>No</th>
												<th>Service</th>
												<th><div align="right">Price</div></th>
											</tr>
											</thead>
											<tbody>
											<?php
											$nomor = 1;
											foreach($detail->result() as $rowd){
											?>
											<tr class="odd gradeX" id="voucher_">
												<td><?=$nomor++;?></td>
												<td>
													<input type="text" name="service[1]" style="width:585px" value="<?=$rowd->service_name?>" placeholder="service item" id="a1" required/>
													<button id="pop1" type="button" onclick="popup(1); loadgrandtotal('example2');" class="btn btn-success btn-mini"><i class="icon-search"></i></button>
												</td>
												<td>
												<div align="right">
												<input id="total[1]" name="price[1]" placeholder="0" autocomplete="off" style="width:145px; text-align:right" onchange="setBlurFocus(1);" type="text" value="<?=$rowd->price?>">

												<input name="rowcount" id="rowcount" type="hidden" value="<?=$nomor++;?>">
												<input name="seq[1]" type="text"/> 
												<input name="id[1]" id="id[1]" type="text">
												<input name="id_service[1]" id="id_service[1]" type="text">
												<input name="fulus[1]" id="fulus[1]" type="text">
												<input name="orderid[1]" id="orderid[1]" type="text">
												<input name="orderty[1]" id="orderty[1]" type="text">
												<input name="group[1]" id="group[1]" type="text">
												</div>
												</td>
											</tr>
											<?php 
											
											} 
											?>
											</tbody>
										</table>	
										<input class="btn btn-success" type="button" value="Add" onclick="addRow('example2')" id="plus" />
										<input class="btn btn-danger" id="negatif" type="button" value="Delete" onclick="deleteRow('example2'); loadgrandtotal('example2');" />	
										</fieldset>  
										<table class="table table-striped table-bordered">
											<tr class="odd gradeX">
												<td>
													<div align="right"><b>Cost</b> <input class="input-xlarge-in focused" onkeyup="loadgrandtotal('example2');" id="grand" name="amount_total" value="0" style="width:145px; text-align:right" type="text" readonly></div>
												</td>
											</tr>
											<tr class="odd gradeX">
												<td><div align="right"><b>Margin</b> <input class="input-xlarge-in focused" id="adjs" name="adjs_amount" value="0" style="width:45px; text-align:right" autocomplete="off" max="100" type="number" onkeyup="margins();"> <b>%</b> <input class="input-xlarge-in focused" autocomplete="off"  id="adjs_amt" name="adjs_nominal" value="0" onkeyup="loadgrandtotal2('example2');" style="width:145px; text-align:right" type="text" readonly><input id="grandma" type="hidden"></div></td>
											</tr>
											<tr class="odd gradeX">
											<td><div align="right"><b>Sell Price</b> <input class="input-xlarge-in focused" id="peka" onkeyup="loadgrandtotal3();" name="sell_price" value="0" style="width:145px; text-align:right" type="text"></div></td>
											</tr>
											<tr class="odd gradeX">
											<td><div align="right"><b>Estimate Gross Income</b> <input class="input-xlarge-in focused" id="pekas" name="egi" value="0.00" style="width:145px; text-align:right" type="text"></div></td>
											</tr>

										</table>
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
												<input type="submit" class="btn btn-success" disabled id="save" value="Save">
												<a data-dismiss="modal" class="btn btn-warning" href="#">Close</a>
											</div>
										</div>
										<div class="form-actions">
										<a href="#myAlert" data-toggle="modal" class="btn btn-success">Submit</a>
										<!-- <button class="btn btn-warning" type="reset">Reset</button>  -->
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
</body>