	<?php
		$session_data 			= $this->session->userdata('logged_in');
		$userlvl				= $session_data['userlevel'];
		$id = $this->uri->segment(3);
		if($id=="ok"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Transfer items
		</div>
	<?php
		}elseif($id=="change"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Update Transfer items
	    </div>
	<?php
		}elseif($id=="del"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Delete Transfer items
		</div>
	<?php }	?>		
	<script>
		function undisableTxt(){
			<?php
				$x = 1; 
				while($x <= 5) {
				echo "document.getElementById('".$x."').disabled = false;";
				$x++;
				}	
			?>
			document.getElementById('tobsave').disabled = false;
			document.getElementById('pop1').disabled = false;
			document.getElementById('fromwh').disabled = false;
			document.getElementById('towh').disabled = false;
			document.getElementById('plus').disabled = false;
			document.getElementById('deleterow').disabled = false;
		}

		function popup_d(id){
		var myWindow = window.open("<?php echo base_url();?>inv/find_werehouse2", "", "width=1200px, height=500px, top=70, left=80");
		}

		function popup_e(id){
		var myWindow = window.open("<?php echo base_url();?>inv/find_werehouse3", "", "width=1200px, height=500px, top=70, left=80");
		}

		function goBack(){
			window.history.back();
		}

		function popup_s(b_id){
			var id_warehouse = document.getElementById('move').value
			document.getElementById('a'+b_id+'').readOnly = true;
			document.getElementById('b'+b_id+'').readOnly = true;
			document.getElementById('cadangan['+b_id+']').value = "0";
			window.open("<?php echo base_url();?>inv/find_item_mi/"+b_id+"/"+id_warehouse+"","Popup","height=600, width=1800, top=20, left=180 ");
		}

	</script>
	<SCRIPT language="javascript">
        function addRow(tableID) {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;
            var row = table.insertRow(rowCount);
			
			if (rowCount >= 10) {
				document.getElementById('plus').disabled = true;
			}
			

            var cell2 		= row.insertCell(0);
            cell2.innerHTML = rowCount + 1-1;
 
            var cell3 		= row.insertCell(1);
			cell3.innerHTML = "<input type='hidden' id='id_item"+cell2.innerHTML+"' name='id_item["+cell2.innerHTML+"]'> <input type='text' id='a"+cell2.innerHTML+"' name='item["+cell2.innerHTML+"]' style='width:280px' readonly> <button id='pop"+cell2.innerHTML+"' type='button' onclick='popup_s("+cell2.innerHTML+");' class='btn btn-success btn-mini'><i class='icon-search'></i></button> ";

			var cell4 		= row.insertCell(2);
			cell4.innerHTML = "<input type='number' max='99' name='qty["+cell2.innerHTML+"]' style='width:55px'>";
			
			var cell5 		= row.insertCell(3);
			cell5.innerHTML = "<input type='text' id='b"+cell2.innerHTML+"' name='base["+cell2.innerHTML+"]' style='width:75px' readonly>";
			
			var cell6 		= row.insertCell(4);
			cell6.innerHTML = "<input type='text' placeholder='0' name='stock["+cell2.innerHTML+"]' style='width:75px' readonly>";
			
			var cell7 		= row.insertCell(5);
			cell7.innerHTML = "<textarea name='remarks["+cell2.innerHTML+"]' type=text rows='2' cols='10' style='width: 229px;'></textarea><input type='hidden' name='cadangan["+cell2.innerHTML+"]' id='cadangan["+cell2.innerHTML+"]' value='0'>";
			
			var cell8= row.insertCell(6);
			cell8.innerHTML = "<input type='hidden' name='rowcount' value='"+cell2.innerHTML+"'>";
        }
		
		function undisableTxt2(b_id){
			var cadangan 	= document.getElementById('cadangan['+b_id+']').value;

			if (cadangan == 0) {
				
			  document.getElementById('a'+b_id+'').readOnly = false;
			  document.getElementById('b'+b_id+'').readOnly = false;
			  document.getElementById('cadangan['+b_id+']').value = "1";
			  document.getElementById('a'+b_id+'').value = "";
			  document.getElementById('b'+b_id+'').value = "";
			  //document.getElementById('pop'+b_id+'').disabled = true;

			}else{

			  document.getElementById('a'+b_id+'').readOnly = true;
			  document.getElementById('b'+b_id+'').readOnly = true;
			  document.getElementById('cadangan['+b_id+']').value = "0";
			  //document.getElementById('pop'+b_id+'').disabled = true;
			};

		}
 
        function deleteRow(tableID){
        var table = document.getElementById(tableID);
		var rowCount = table.rows.length;	
		table.deleteRow(rowCount -1);
        }
    </SCRIPT>
	<?php
		function romanic_number($integer, $upcase = true) { 
				$table = array('M'=>1000, 'CM'=>900, 'D'=>500, 'CD'=>400, 'C'=>100, 'XC'=>90, 'L'=>50, 'XL'=>40, 'X'=>10, 'IX'=>9, 'V'=>5, 'IV'=>4, 'I'=>1); 
				$return = ''; 
				while($integer > 0) 
				{ 
					foreach($table as $rom=>$arb) 
					{ 
						if($integer >= $arb) 
						{ 
							$integer -= $arb; 
							$return .= $rom; 
							break; 
						} 
					} 
				} 
				return $return; 
		} 
	?>
                    <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><b>Input Item Request</b></div>
                            </div>
							<div class="form-actions">
							<button onclick="undisableTxt()" class="btn btn-primary"><b>Start</b></button> 										 
							<div class="btn-group">
							 <button data-toggle="dropdown" class="btn btn-info dropdown-toggle"><b>Menu</b> <span class="caret"></span></button>
							 <ul class="dropdown-menu">
								<li><a href="<?php echo base_url();?>inv/list_mi"><i class="icon-list"></i> List Item Request</a></li>
								<li><a href="<?php echo base_url();?>inv/list_mi"><i class="icon-list"></i> List Item </a></li>
								<?php if ($userlvl != "user"){ ?>
								<li class="divider"></li>
								<li><a href="<?php echo base_url();?>inv/listmi_app/"><i class="icon-ok-sign"></i> Request Approval</a></li>
								<?php } ?>
							 </ul>
							</div>
							</div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                      <fieldset>
										<form class="form-horizontal" action="<?php echo base_url();?>inv/save_mi" method="post" name="mst_pr">
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">No</label>
                                          <div class="controls">
                                          <span class="input-xlarge uneditable-input">RI/<?=date('Y');?>/<?=romanic_number(date('m'));?>/<?=$urutan;?></span>
										  <input class="input-xlarge focused" name="no" type="hidden" id="1" autocomplete="off" value="RI/<?=date('Y');?>/<?=romanic_number(date('m'));?>/<?=$urutan;?>" readOnly required>
										  <input type="hidden" name="nomortrf" value="RI/<?=date('Y');?>/<?=romanic_number(date('m'));?>/<?=$urutan;?>" >
                                          </div>
                                        </div>
																	
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Date</label>
                                          <div class="controls">
                                          	<span class="input-xlarge uneditable-input"><?php echo date("m/d/Y");?></span>
                                            <input class="input-xlarge datepicker" id="2" name="date" value="<?php echo date("m/d/Y");?>" type="hidden" autocomplete="off" required>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">From Warehouse</label>
                                          <div class="controls">
                                            <input class="input-small focused" name="move" id="move" type="hidden">
                                            <input class="input-small focused" name="from_dept" id="from_dept" type="hidden">
                                            <input class="input-xlarge focused" name="move_name" type="text" id="3" autocomplete="off" disabled maxlength="0" required>
                                   			<button type="button" onclick="popup_d();" class="btn btn-success btn-mini" id="fromwh" disabled><i class="icon-search" ></i></button>
                                   			<!-- 
                                   			Jika tidak ada itemnya maka harus cek group pada table sysparam
                                   			sekarang sudah mudah hanya dengan input pada sistem di menu list parameter
                                   			http://10.17.44.11/ci/master/cek_sysparam/item_request_group
                                   			Setelah itu cari sgroup 'item_request_group' 
                                   			-->
                                          </div>
                                        </div>

										<div class="control-group">
                                          <label class="control-label" for="focusedInput">To Warehouse</label>
                                          <div class="controls">
                                            <input class="input-small focused" name="to_wh" id="to_wh" type="hidden">
                                            <input class="input-small focused" name="to_dep" id="to_dep" type="hidden">
                                            <input class="input-xlarge focused" name="towhname" type="text" id="5" autocomplete="off" disabled maxlength="0" required>
                                   			<button type="button" onclick="popup_e();" class="btn btn-success btn-mini" id="towh" disabled><i class="icon-search"></i></button>
                                          </div>
                                        </div>
										
										<INPUT class="btn btn-success" type="button" value="Add" onclick="addRow('example2')" id="plus" disabled />
										<INPUT class="btn btn-danger" type="button" value="Delete" onclick="deleteRow('example2')" id="deleterow" disabled />			
										</br></br>
										
										<table class="table table-striped table-bordered" id="example2">
										    <thead>
                                          	<tr>
												<th>No</th>
												<th>Name of Product</th>
												<th>Qty</th>
												<th>Unit</th>
												<th>Stock</th>
												<th>Notes</th>
											</tr>
											</thead>
											<tbody>
											<tr class="odd gradeX">
												<td>1</td>
												<td><input type="hidden" name="id_item[1]" id="id_item1"/> <input type="text" name="item[1]" style="width:280px;" id="a1" readonly/> <button id="pop1" type="button" onclick="popup_s(1);" class="btn btn-success btn-mini" disabled><i class="icon-search"></i></button> 
											<!-- 
                                   			Jika tidak ada itemnya maka harus cek group pada table sysparam
                                   			sekarang sudah mudah hanya dengan input pada sistem di menu list parameter
                                   			http://10.17.44.11/ci/master/cek_sysparam/item_request_group
                                   			Setelah itu cari sgroup 'item_request_group' 
                                   			-->													
												</td>
												<td><input name="qty[1]" id="qty[1]" style="width:55px" min="1" type="number" /> </td>
												<td><input name="base[1]" style="width:75px" id="b1" type="text" readonly/></td>
												<td><input name="stock[1]" id="stock[1]" placeholder="0" style="width:75px" type="text" readonly/></td>
												<td><textarea name="remarks[1]" type="text" id="4" rows="2" cols="10" style="width: 229px;"></textarea>
													<input type="hidden" name="cadangan[1]" id="cadangan[1]" value="0"></td>
													<td></td>
											</tr>
											</tbody>
										</table>	
										</fieldset>
										
										<div id="myAlert" class="modal hide">
											<div class="modal-header">
												<button data-dismiss="modal" class="close" type="button">&times;</button>
												<h5>Alert!</h5>
											</div>
											<div class="modal-body">
												<p>Are you sure ? [close] button to check again...</p>
											</div>
											<div class="modal-footer">
												<input type="submit" class="btn btn-success" value="Save" id="tobsave" disabled>
												<a data-dismiss="modal" class="btn btn-warning" href="#">Close</a>
											</div>
										</div>                        
										</form>                     						
                                </div>
                            </div>
							<div class="form-actions">
							<a href="#myAlert" data-toggle="modal" class="btn btn-success">Submit</a>
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