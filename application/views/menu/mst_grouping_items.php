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
	  }
	  
	  function goBack(){
	  	window.history.back();
	  }
	  
	  function popup(id){
        window.open("<?php echo base_url();?>marketing/find_lab_group/"+id+"","Popup","height=550, width=980, top=70, left=180 ");
			
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
		function setBlurFocus(id) {
		var user_input = accounting.formatMoney(document.getElementById(id+'b').value);
		var c = accounting.formatMoney(document.getElementById(id+'c').value);
		var d = accounting.formatMoney(document.getElementById(id+'d').value);
		var e = accounting.formatMoney(document.getElementById(id+'e').value);
		document.getElementById(id+'b').value = user_input;
		document.getElementById(id+'c').value = c;
		document.getElementById(id+'d').value = d;
		document.getElementById(id+'e').value = e;
		}
		
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
			cell3.innerHTML = "<input type='text' id='a"+cell2.innerHTML+"' name='service[]' placeholder='service item' style='width:585px' readonly> <button id='pop"+cell2.innerHTML+"' type='button' onclick='popup("+cell2.innerHTML+");' class='btn btn-success btn-mini'><i class='icon-search'></i></button><input type='hidden' name='group["+cell2.innerHTML+"]' id='b"+cell2.innerHTML+"'><input type='hidden' name='id_service["+cell2.innerHTML+"]' id='c"+cell2.innerHTML+"'><input type='hidden' name='rowcount' value='"+cell2.innerHTML+"'>";

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
    </script>
				<body onload="startTime()">
                    <!-- morris stacked chart -->
                    <div class="row-fluid" >
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><b>Grouping Items</b></div>
							<div class="muted pull-right" id="txt" style="font-weight: bold;"></div>
                            </div>
							<div class="form-actions">
							 
							<div class="btn-group">
							 <button data-toggle="dropdown" class="btn btn-info dropdown-toggle"><i class="icon-th"></i> Menu <span class="caret"></span></button>
							 <ul class="dropdown-menu">
								<li><a href="<?php echo base_url();?>marketing/list_group_items"><i class="icon-th-large"></i> List Grouping Items</a></li>
							 </ul>
							</div>
							</div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                      <fieldset>

										<form class="form-horizontal" action="<?php echo base_url();?>marketing/save_items_group" method="post" name="quotation">
										<!--<div id="" style="overflow-y: scroll; height:260px;">-->
										</br>

										<div style="width:100%; height:100%	; overflow: auto; float:center;">
										<table class="table table-striped table-bordered" id="example2">
										    <thead>
                                          	<tr>
												<th>No</th>
												<th>Service</th>
											</tr>
											</thead>
											<tbody>
											<tr class="odd gradeX" id="voucher_">
												<TD>1</TD>
												<TD><input type="text" name="service[]" style="width:585px" placeholder="service item" id="a1" readonly required/> <button id="pop1" type="button" onclick="popup(1);" class="btn btn-success btn-mini"><i class="icon-search"></i></button></TD>
												<input type="hidden" name="group[1]" id="b1">
												<input type="hidden" name="id_service[1]" id="c1">
												<input type="hidden" name="rowcount" value="1">
											</tr>
											</tbody>
										</table>	
										</br>
										<INPUT class="btn btn-success" type="button" value="Add" onclick="addRow('example2')" id="plus" />
										<INPUT class="btn btn-danger" id="negatif" type="button" value="Delete" onclick="deleteRow('example2'); loadgrandtotal('example2');"/>
										</fieldset>  
										<table class="table table-striped table-bordered">
											<tr class="odd gradeX">
											<td><div align="right"><b>Base / Employee</b> <INPUT class="input-xlarge-in focused" id="0b" name="base_price" placeholder="0" onchange="setBlurFocus(0);" style="width:145px; text-align:right" type="text" required></div></td>
											</tr>
											<tr class="odd gradeX">
											<td><div align="right"><b>Normal / Local</b> <INPUT class="input-xlarge-in focused" onchange="setBlurFocus(0);" id="0c" name="normal_local" placeholder="0" style="width:145px; text-align:right" type="text" required></div></td>
											</tr>
											<tr class="odd gradeX">
											<td><div align="right"><b>Insurance / Japanese</b> <INPUT class="input-xlarge-in focused" name="insurance_japan" id="0d" placeholder="0" style="width:145px; text-align:right" onchange="setBlurFocus(0);" type="text" required></div></td>
											</tr>
											<tr class="odd gradeX">
											<td><div align="right"><b>Company / Japanese Non Insurance</b> <INPUT class="input-xlarge-in focused" id="0e" name="company_japan" placeholder="0" style="width:145px; text-align:right" onchange="setBlurFocus(0);" type="text" required></div></td>
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
												<input type="submit" class="btn btn-success" id="save" value="Save">
												<a data-dismiss="modal" class="btn btn-warning" href="#">Close</a>
											</div>
										</div>
										<div class="form-actions">
										<div style="float:left;">
										<a href="#myAlert" data-toggle="modal" class="btn btn-success">Submit</a>
										</div>
										<div style="float:right;">
										<button class="btn btn-danger" type="reset">Reset</button> 
										</div>
                                        </div>	
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