        		<!--/.fluid-container-->
        <script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>
		<link href="<?php echo base_url();?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
        <script src="<?php echo base_url();?>design/assets/scripts.js"></script>
        <script src="<?php echo base_url();?>design/assets/DT_bootstrap.js"></script>

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
	<script>
	  function undisableTxt(){
		document.getElementById("myText123").disabled = false;
	  }
	  
	  function goBack(){
	  	window.history.back();
	  }
	  
	  function popup(b_id){
        window.open("<?php echo base_url();?>patient/find_patient","Popup","height=auto,width=auto,scrollbars=1,"+ 
                        "directories=1,location=1,menubar=1," + 
                         "resizable=1 status=1,history=1 top = 50 left = 100");
      }
	  
	  function popup_edit(b_id){
        window.open("<?php echo base_url();?>patient/find_patient_mcu","Popup","height=auto,width=auto,scrollbars=1,"+ 
                        "directories=1,location=1,menubar=1," + 
                         "resizable=1 status=1,history=1 top = 50 left = 100");
      }
	  
	  function btntest_onclick(){
		window.location.href = "<?php echo base_url();?>lab/order_lab/edit";
	  }

	</script>
<script type="text/javascript">
	function DisableKey(e,type) {    var desimal = e.charCode? e.charCode : e.keyCode;     if(type == 'alphabet'){    if((desimal==34 || desimal==8 || desimal==9 || desimal==32) || (desimal==45 || desimal==46 || desimal==47) ){ 
    return true;    }else{    if ((desimal<65||desimal>90) && (desimal<97||desimal>122)) { //jika bukan huruf
    return false;     }    }                                        
    }else{          if((desimal==45 || desimal==46) || (desimal==8 || desimal==9)){ // jika menekan tombol Backspace, Tab dan titik diperbolehkan
    return true;    }else{    if (desimal<48 || desimal>57) { //jika bukan angka
    return false; //matikan tombol
    }
    }
    }
   }
</script>
	<?php
	include './design/koneksi/file.php';
	$query 		="SELECT cast(right(id_reg,4) as decimal) id,cast(left(id_reg,3) as decimal) dt FROM trx_registration ORDER BY id_pat DESC LIMIT 1";  
    if($result 	=mysqli_query($con,$query))
    {
		$date	=date('ym');
        $row 	=mysqli_fetch_assoc($result);
        $count 	=$row['id'];
		$dater 	=$row['dt'];
		if ($dater == $date) {
			$count = $count+1; 	
		}else{
			$count = 1;
		}
        $code_no = str_pad($count, 4, "0", STR_PAD_LEFT);
    }
	$session_data 	 = $this->session->userdata('logged_in');
    $data['username'] 	 = $session_data['username'];
	$loc 	 = $session_data['location'];
	$id = $this->uri->segment(3);
	
if ($id=="lab") {
$style = "cursor: pointer;";
}
elseif($id=="Rontgen") {
	

}
	//var_dump($loc);
	?>
	
				<?php
				function findage_detail($dob){
						$interval = date_diff(date_create(), date_create($dob));
						echo $interval->format(" %Y Year, %M Months, %d Days");
					}
				?>
       <!-- wizard -->
								<legend>	
								<?php
								if ($id=="edit") {
								?>
								<font color="red">Edit Data</font>
								<?php
								}
								?>	Order Doctor
								</legend>
										 <div class="form-actions">
										 <button onclick="undisableTxt()" class="btn btn-primary">Start</button>
										 <button id="btntest" onclick="return btntest_onclick()" class="btn btn-info">Edit</button>   										 
										 <button class="btn btn-warning" onclick="goBack()">Back</button>
										 </div>
										 
									<?php
									if ($id != "edit") {
									?>
									<form class="form-horizontal" action="<?php echo base_url();?>docter/save_order_lab" method="post" name="quesioner_mcu">
									<?php
									} else {
									?>
									<?php
									}
									?>	
                                        <div class="control-group">
                                          <label class="control-label" for="focusedInput">Patient MRN</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="pat_mrn" type="text" id="myText01" readonly autocomplete="off" placeholder=" ... ">
											<input name="id_reg" type="hidden" id=""  autocomplete="off" >
											<?php
											if ($id=="edit") {
											?>
											&nbsp; <button type="button" onclick="popup_edit();" class="btn btn-success"><li><i class="icon-search"></i></li></button>
											<?php
											}
											

											else {
											?>
											&nbsp; <button type="button" onclick="popup();" class="btn btn-success"><li><i class="icon-search"></i></li></button>
											<?php
											}
											?>	
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Patient Name</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="pat_name" type="text" id="myText02" readonly autocomplete="off" >
											&nbsp; Birth Date & Place &nbsp;<input class="input-xlarge focused" name="pat_dob" type="text" id="myText03" readonly autocomplete="off" >
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Address</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="pat_address" type="text" id="myText05" readonly autocomplete="off" >
											&nbsp; Marital Status &nbsp; &nbsp; &nbsp; &nbsp; <input class="input-xlarge focused" name="pat_status" type="text" id="myText06" readonly autocomplete="off" >
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Telephone</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="pat_telp" type="text" id="myText07" readonly autocomplete="off" >
                                          </div>
                                        </div>
							
                                         <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
							

							
                       <div class="muted pull-left"><a href="lab" style=" border: 2px solid #a1a1a1;    padding: 10px 40px;     background: #dddddd;    width: 300px;    border-radius: 10px;">Lab</a></div>
                                <div class="muted pull-left"><a href="Rontgen" style=" border: 2px solid #a1a1a1;    padding: 10px 40px;     background: #dddddd;    width: 300px;    border-radius: 10px;">Rontgen</a></div>
                                <div class="muted pull-left"><a href="Pharmacy" style=" border: 2px solid #a1a1a1;    padding: 10px 40px;     background: #dddddd;    width: 300px;    border-radius: 10px;">Pharmacy</a></div>
                                <div class="muted pull-left"><a href="Other" style=" border: 2px solid #a1a1a1;    padding: 10px 40px;     background: #dddddd;    width: 300px;    border-radius: 10px;">Other</a></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
									<?php
									if ($id=="lab") {	
										?>
										<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
										<thead>
											<tr>
												<th>No</th>
												<th>Group Lab</th>
												<th>Subject</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
										
													<?php
															$current_cat = null;
														    $order_type = 1; // order type relation to mst_order_type where lab = 1
														    $i=1; 
															$x=1;
															$row_cnt = $lab_item->num_rows();
															?>
															
															<?php
															foreach($lab_item->result() as $row){
															?>
																<tr>
																<td><?=$i++;?></td>
																<?php
																if ($row->group_name != $current_cat){
																$current_cat = $row->group_name;
																echo "<td><b><u>". $row->group_name . "</u></b>";
																}else{
																?>	
																	<td></td>
																<?php
																}
																?>
																	<input type="hidden" name="rowC" value="<?=$row_cnt;?>">
																	<input type="hidden" name="order_type" value="<?=$order_type;?>">
																	<td><?php echo $row->lab_item_desc;?></td>
																	<td><input type="checkbox" name="lab[<?=$x++;?>]" value="<?=$row->id_lab_item;?>:<?=$row->lab_item_seq_no;?>" ></td>
																</tr>
															<?php
															}
															?>
											
										</tbody>
									</table>
										<?php												
											}

									elseif ($id=="Rontgen") {	
									?>
									
																			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
										<thead>
											<tr>
												<th>No</th>
												<th>Group Radiology</th>
												<th>Subject</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>				<?php
															$current_cat = null;
														    $order_type = 2; // order type relation to mst_order_type when rothgen = 2
														    $i=1; 
															$x=1;
															$row_cnt = $rad_item->num_rows();
													
															foreach($rad_item->result() as $row){
															?>
																<tr>
																<td><?=$i++;?></td>
																<?php
																if ($row->group_desc != $current_cat){
																$current_cat = $row->group_desc;
																echo "<td><b><u>". $row->group_desc . "</u></b>";
																}else{
																?>	
																	<td></td>
																<?php
																}
																?>
																	<input type="hidden" name="rowC" value="<?=$row_cnt;?>">
																	<input type="hidden" name="order_type" value="<?=$order_type;?>">
																	<td><?php echo $row->rad_item;?></td>
																	<td><input type="checkbox" name="lab[<?=$x++;?>]" value="<?=$row->rad_item;?>:<?=$row->rad_item;?>" ></td>
																</tr>
															<?php
															}
															?>
															
															
															
											
										</tbody>
									</table>
									<?php
									}
									?>
  								
									<div id="myAlert" class="modal hide">
											<div class="modal-header">
												<button data-dismiss="modal" class="close" type="button">&times;</button>
												<h3>Check Again</h3>
											</div>
											<div class="modal-body">
												<p>Are You Sure ?</p>
											</div>
											<div class="modal-footer">
												<input type="submit" class="btn" value="Save" id="myText123" disabled>
												<a data-dismiss="modal" class="btn" href="#">Cancel</a>
											</div>
										</div>
										</div>
										<div class="form-actions">
										<a href="#myAlert" data-toggle="modal" class="btn btn-success">Save</a>
                                        </div>
									</form>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
