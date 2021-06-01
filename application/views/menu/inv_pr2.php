	<?php
		$session_data 			= $this->session->userdata('logged_in');
		$userlvl				= $session_data['userlevel'];
		$id = $this->uri->segment(3);
		if($id=="ok"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Input Purchase Requisition
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
			while($x <= 7) {
			echo "document.getElementById('".$x."').disabled = false;";
			$x++;
			}	
		?>
	  }
	  
	  function goBack(){
	  	window.history.back();
	  }
	  
	  function popup_s(b_id){
		// document.getElementById('a'+b_id+'').readOnly = true;
		// document.getElementById('b'+b_id+'').readOnly = true;
		document.getElementById('cadangan['+b_id+']').value = "0";
        window.open("<?php echo base_url();?>inv/find_item_pr/"+b_id+"","Popup","height=650, width=980, top=10, left=180 ");
      }
	</script>
	<SCRIPT language="javascript">
        function addRow(tableID) {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;
            var row = table.insertRow(rowCount);
			
			// if (rowCount >= 10) {
			// 	document.getElementById('plus').disabled = true;
			// }
			

            var cell2 		= row.insertCell(0);
            cell2.innerHTML = rowCount + 1-1;
 
            var cell3 		= row.insertCell(1);
			cell3.innerHTML = "<input type='hidden' id='id_item["+cell2.innerHTML+"]' name='id_item["+cell2.innerHTML+"]' value='0'/><input type='text' id='a"+cell2.innerHTML+"' name='item["+cell2.innerHTML+"]' style='width:280px' readonly> <button id='pop"+cell2.innerHTML+"' type='button' onclick='popup_s("+cell2.innerHTML+");' class='btn btn-success btn-mini'><i class='icon-search'></i></button>  ";

			// cell3.innerHTML = "<input type='hidden' id='id_item["+cell2.innerHTML+"]' name='id_item["+cell2.innerHTML+"]' value='0'/><input type='text' id='a"+cell2.innerHTML+"' name='item["+cell2.innerHTML+"]' style='width:280px' readonly> <button id='pop"+cell2.innerHTML+"' type='button' onclick='popup_s("+cell2.innerHTML+");' class='btn btn-success btn-mini'><i class='icon-search'></i></button> <button type='button' onclick='undisableTxt2("+cell2.innerHTML+");' class='btn btn-success btn-mini'><i class='icon-pencil'></i></button>";

			var cell4 		= row.insertCell(2);
			cell4.innerHTML = "<input type='number' max='9999' name='qty["+cell2.innerHTML+"]' style='width:55px'>";
			
			var cell5 		= row.insertCell(3);
			cell5.innerHTML = "<select name='base[1]' required> <?php foreach($base->result() as $rows){ if ($rows->id_baseunit == 28) { $selunit ='selected'; }else{ $selunit =''; }?> <option value='<?=$rows->id_baseunit?>' align='justify' <?php echo $selunit; ?> ><?=$rows->baseunit?></option> <?php } ?> </select>";
			// cell5.innerHTML = "<input type='text' id='b"+cell2.innerHTML+"' name='base["+cell2.innerHTML+"]' style='width:75px' readonly>";
			
			var cell6 		= row.insertCell(4);
			cell6.innerHTML = "<input type='text' placeholder='0' name='stock["+cell2.innerHTML+"]' style='width:75px' readonly>";
			
			var cell7 		= row.insertCell(5);
			cell7.innerHTML = "<textarea name='remarks["+cell2.innerHTML+"]' type=text rows='2' cols='10' style='width: 229px;' required></textarea><input type='hidden' name='cadangan["+cell2.innerHTML+"]' id='cadangan["+cell2.innerHTML+"]' value='0'>";
			
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
	include './design/koneksi/file.php';
	$query 		="SELECT id_pr_no dt FROM trx_item_pr_h ORDER BY id_pr_no DESC LIMIT 1";  
    if($result 	=mysqli_query($con,$query))
    {
		//$date	=date('ym');
        $row 	=mysqli_fetch_assoc($result);
        $count 	=$row['dt'];
		//$dater 	=$row['dt'];
		if ($count != "") {
		$count = $count+1; 	
		}else{
		$count = 1;
		}
        $code_no = $count;
    }
	
	function romanic_number($integer, $upcase = true) 
		{ 
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
                            <div class="muted pull-left"><b>Purchase Requisition Entry</b></div>
                            </div>
							<div class="form-actions">
							<button onclick="undisableTxt()" class="btn btn-primary btn-large"><b>Start</b></button> 										 
							<div class="btn-group">
							 <button data-toggle="dropdown" class="btn btn-info btn-large dropdown-toggle"><b>Menu</b> <span class="caret"></span></button>
							 <ul class="dropdown-menu">
								<li><a href="<?php echo base_url();?>inv/list_pr"><i class="icon-th-large"></i> List Purchase Request</a></li>
								<li><a href="#"><i class="icon-th-large"></i> Report Purchase Request</a></li>
								<?php if ($userlvl != "user"){ ?>
								<li class="divider"></li>
								<li><a href="<?php echo base_url();?>inv/listpr_app/"><i class="icon-ok-sign"></i> Request Approval</a></li>
								<?php } ?>
							 </ul>
							</div>
							</div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                      <fieldset>
										<form class="form-horizontal" action="<?php echo base_url();?>inv/save_pr" method="post" name="mst_pr">
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">No</label>
                                          <div class="controls">
										  <input class="input-xlarge focused" name="no" type="text" autocomplete="off" value="PR/<?=$nama_dep?>/<?=romanic_number(date('m'));?>/<?=date('Y');?>/<?=$urutan;?>" readonly>
										  </div>
                                        </div>
																	
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Date</label>
                                          <div class="controls">
                                            <input class="input-xlarge datepicker" name="date" value="<?php echo date("m/d/Y");?>" type="text" autocomplete="off" disabled>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Department</label>
                                          <div class="controls">
										  <input name="department" type="hidden" value="<?=$kode_dep?>">
										  <input class="input-xlarge focused" name="department_name" type="text" value="<?=$nama_dep?>" readonly>
                                          </div>
                                        </div>
										
						<input class="btn btn-success" type="button" id="3" value="Add" onclick="addRow('example2')" id="plus" disabled/>
						<input class="btn btn-danger" type="button" id="4" value="Delete" onclick="deleteRow('example2')" disabled />			
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
												<td>
													<input type="hidden" name="id_item[1]" id="id_item[1]" value="0" />
													<input type="text" name="item[1]" style="width:280px;" id="a1" readonly/> 
													<button id="7" type="button" onclick="popup_s(1);" class="btn btn-success btn-mini" disabled><i class="icon-search"></i></button>  
													<!-- <button type="button" onclick="undisableTxt2(1);" class="btn btn-success btn-mini"><i class="icon-pencil"></i></button> -->
												</td>
												<td>
													<input name="qty[1]" style="width:55px" max="9999" min="1" type="number" required/>
												</td>
												<td>
												<!-- <input name="base[1]" style="width:75px" id="b1" type="text" readonly/> -->
		                                       	<select name="base[1]" required>
		                                          <!-- <option value="">- Choose -</option> -->
		                                          <?php 
												  foreach($base->result() as $rows){
												  	if ($rows->id_baseunit == 28) {
												  		$selunit ="selected";
												  	}else{
												  		$selunit ="";
												  	}
												  ?>
													<option value="<?=$rows->id_baseunit?>" align="justify" <?php echo $selunit; ?> ><?=$rows->baseunit?></option>
												  <?php
												  }
												  ?>
		                                       	</select>
												</td>
												<td><input name="stock[1]" placeholder="0" style="width:75px" type="text" readonly/></td>
												<td>
													<textarea name="remarks[1]" type="text" id="4" rows="2" cols="10" style="width: 229px;" required></textarea>
													<input type="hidden" name="cadangan[1]" id="cadangan[1]" value="0">
												</td>
													<td></td>
											</tr>
											</tbody>
										</table>	

						<input class="btn btn-success" type="button" id="1" value="Add" onclick="addRow('example2')" id="plus" disabled/>
						<input class="btn btn-danger" type="button" id="2" value="Delete" onclick="deleteRow('example2')" disabled/>			
									
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
												<input type="submit" class="btn btn-success" value="Save" id="5" disabled>
												<a data-dismiss="modal" class="btn btn-warning" href="#">Close</a>
											</div>
										</div>                        
										</form>                     						
                                </div>
                            </div>
							<div class="form-actions">
							<a href="#myAlert" data-toggle="modal" class="btn btn-success" id="6" >Submit</a>
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