	<?php
		$id						= $this->uri->segment(3);
		$session_data 			= $this->session->userdata('logged_in');
		$userlvl				= $session_data['userlevel'];
		if($id=="ok"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Manufacture Order.
		</div>
	<?php
		}elseif($id=="change"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Update Manufacture Order
	    </div>
	<?php
		}elseif($id=="del"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Delete Manufacture Order
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
	  }
	  
	  function goBack(){
	  	window.history.back();
	  }
	  
	  function popup(){
        window.open("<?php echo base_url();?>inv/find_supplier","Popup","height=550, width=880, top=70, left=180 ");
      }
	  
	  function popup_2(){
        window.open("<?php echo base_url();?>inv/find_delivery","Popup","height=550, width=880, top=70, left=180 ");
      }
	  
	  function popup_s(b_id){
        window.open("<?php echo base_url();?>Pharmacy/find_item_drug/"+b_id+"","Popup","height=350, width=680, top=100, left=300 ");
      }

      function popup_r(b_id){
      	var id_item = document.getElementById('id_item['+b_id+']').value;
        window.open("<?php echo base_url();?>Pharmacy/find_dosage/"+b_id+"/"+id_item+"","Popup","height=550, width=880, top=70, left=180 ");
      }

      function popup_s1(id){
			var myWindow = window.open("<?php echo base_url();?>Pharmacy/find_patient_data", "", "width=1200px, height=500px, top=70, left=80");
	  }
	  
	  function popup_pr(b_id){
        window.open("<?php echo base_url();?>inv/find_pr/"+b_id+"","Popup","height=550, width=880, top=70, left=180 ");
      }

      function popup_conversion(b_id){
        window.open("<?php echo base_url();?>inv/find_conversion/"+b_id+"","Popup","height=550, width=880, top=70, left=180 ");
      }
	</script>
	<script src="<?php echo base_url();?>design/assets/acc.js"></script>
	<script language="javascript">
        function addRow(tableID) {
            var table 		= document.getElementById(tableID);
            var rowCount 	= table.rows.length;
            var row 		= table.insertRow(rowCount);
			
            var cell1 		= row.insertCell(0);
            var element1 	= document.createElement("input");
            element1.type 	= "checkbox";
            element1.name	= "chkbox[]";
            cell1.appendChild(element1);

            var cell2 		= row.insertCell(1);
            cell2.innerHTML = rowCount + 1-1;
			
			if (rowCount >= 15) {
				document.getElementById('plus').disabled = true;
			}
			
			
            var cell3 		= row.insertCell(2);
			cell3.innerHTML = "<input type='text' id='a"+cell2.innerHTML+"' name='item["+cell2.innerHTML+"]' placeholder='Drug' style='width:185px' readonly> <button id='pop"+cell2.innerHTML+"' type='button' onclick='popup_s("+cell2.innerHTML+");' class='btn btn-success btn-mini'><i class='icon-search'></i></button><INPUT type='hidden' id='id_item["+cell2.innerHTML+"]' name='id_item["+cell2.innerHTML+"]'/><INPUT type='hidden' name='id_base["+cell2.innerHTML+"]'/> ";
			// var cell4 		= row.insertCell(3);
			// cell4.innerHTML = "<INPUT type='text' name='dosage["+cell2.innerHTML+"]' style='width:185px' placeholder='Dosage' id='b"+cell2.innerHTML+"' readonly required/> <button id='ups"+cell2.innerHTML+"' type='button' onclick='popup_r("+cell2.innerHTML+");' class='btn btn-success btn-mini'><i class='icon-search'></i></button><INPUT type='hidden' name='id_drug_dosage["+cell2.innerHTML+"]'/> ";
			// var cell5 		= row.insertCell(4);
			var cell5 		= row.insertCell(3);
			cell5.innerHTML = "<input type='number' max='99' name='qty["+cell2.innerHTML+"]' value='0' id='qty["+cell2.innerHTML+"]' style='width:45px'>-<input class='input-xlarge-in focused' type='text' id='unit["+cell2.innerHTML+"]' name='unit["+cell2.innerHTML+"]' style='width:75px; text-align:right;' type='text' disabled>";
        }
		
		
		function undisableTxt2(b_id){
			document.getElementById('a'+b_id+'').readOnly = false;
			document.getElementById('b'+b_id+'').readOnly = false;
			document.getElementById('pop'+b_id+'').disabled = true;
		}
		
		function undisableTxt1(){
			document.getElementById('f').readOnly = false;
		}
 
        function deleteRow(tableID){
            try {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;
 
            for(var i=0; i<rowCount; i++) {
                var row = table.rows[i];
                var chkbox = row.cells[0].childNodes[0];
                if(null != chkbox && true == chkbox.checked){
                    table.deleteRow(i);
                    rowCount--;
                    i--;
                }
            }
            }catch(e) {
                alert(e);
            }
        }
    </SCRIPT>
	<?php
	include './design/koneksi/file.php';
	$con		=mysqli_connect($host, $user, $pass, $database);
	$query 		="SELECT id_po dt FROM trx_item_po_h ORDER BY id_po DESC LIMIT 1";  
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
                            <div class="muted pull-left"><b>Manufacture Order Form</b></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                      <fieldset>
                                      	<div class="form-actions">
										 <button onclick="undisableTxt()" class="btn btn-primary">Start</button>									 
										 <button class="btn btn-warning" onclick="goBack()">Back</button>
										 </div>
										
										<form class="form-horizontal" action="<?php echo base_url();?>Pharmacy/save_manufaktur" method="post" name="mst_pr">
										<!--<div id="" style="overflow-y: scroll; height:260px;">-->
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Name</label>
                                          <div class="controls">
                                           <input class="input-xlarge focused" name="name" type="text" id="1" disabled>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Remark</label>
                                          <div class="controls">
                                           <textarea id="2" name="remark" disabled></textarea>
                                          </div>
                                        </div>

																	
										
										</br>
										<INPUT class="btn btn-info" type="button" value="Add" onclick="addRow('example2')" id="plus" />
										<INPUT class="btn btn-danger" type="button" value="Delete" onclick="deleteRow('example2')" />			
										</br>
										</br>
										<div style="width:100%; height:100%	; overflow: auto; float:center;">
										<table class="table table-striped table-bordered" id="example2">
										    <thead>
                                          	<tr>
												<th> ... </th>
												<th>No</th>
												<th>Name of Drug(s)</th>
												<!-- <th>Dosage</th> -->
												<th>Qty</th>
											</tr>
											</thead>
											<tbody>
											<tr class="odd gradeX" id="voucher_">
												<td><INPUT type="checkbox" name="chk"/></td>
												<td>1</td>
												<td>
													<INPUT type="text" name="item[1]" style="width:185px" placeholder="Drug" id="a1" readonly required/> <button id="pop1" type="button" onclick="popup_s(1);" class="btn btn-success btn-mini"><i class="icon-search"></i></button>
													<INPUT type="hidden" name="id_item[1]" id="id_item[1]"/> 
													<INPUT type="hidden" name="id_base[1]"/> 
												</td>
<!-- 												<td>
													<INPUT type="text" name="dosage[1]" style="width:185px" placeholder="Dosage" id="a1" readonly required/> <button id="pop1" type="button" onclick="popup_r(1);" class="btn btn-success btn-mini"><i class="icon-search"></i></button>
													<INPUT type="hidden" name="id_drug_dosage[1]"/> 
												</td> -->
												<td>
													<INPUT id="qty[1]" name="qty[1]" style="width:45px" value="0" type="number" />-<INPUT class="input-xlarge-in focused" id="unit[1]" name="unit[1]" style="width:75px; text-align:right" type="text" disabled/>
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
												<input type="submit" class="btn btn-success" value="Save" onclick="this.disabled=true;this.form.submit();">
												<a data-dismiss="modal" class="btn btn-warning" href="#">Close</a>
											</div>
										</div>										
										<div class="form-actions">
										<a href="#myAlert" data-toggle="modal" class="btn btn-success">Save</a>
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