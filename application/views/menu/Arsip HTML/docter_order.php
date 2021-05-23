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
	$id="";
	//var_dump($loc);
	?>
	
				<?php
				function findage_detail($dob){
						$interval = date_diff(date_create(), date_create($dob));
						echo $interval->format(" %Y Year, %M Months, %d Days");
					}
				?>
       <!-- wizard -->
                    <div class="row-fluid section">
                         <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Form Order Doctor</div>
                            </div>

                            <div class="block-content collapse in">
                                <div class="span12">
								     <fieldset>
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
									<form class="form-horizontal" action="<?php echo base_url();?>lab/save_order_lab" method="post" name="quesioner_mcu">
									<?php
									} else {
									?>
									<form class="form-horizontal" action="<?php echo base_url();?>lab/update_order_lab" method="post" name="quesioner_mcu">
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
											} else {
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
										<div id="rootwizard">
                                        <div class="navbar">
                                          <div class="navbar-inner">
                                            <div class="container">
                                        <ul>
                                            <li><a href="#tab1" data-toggle="tab">Lab</a></li>
                                            <li><a href="#tab2" data-toggle="tab">Rontgen</a></li>
                                            <li><a href="#tab3" data-toggle="tab">Pharmacy</a></li>
                                            <li><a href="#tab4" data-toggle="tab">Other</a></li>
                                        </ul>
                                         </div>
                                          </div>
                                        </div>
                                        <div id="bar" class="progress progress-striped active">
                                          <div class="bar"></div>
                                        </div>
                                        <div class="tab-content">
                                            <div class="tab-pane" id="tab1">
												<div class="block-content collapse in">
													<div class="span12">
														<table class="table table-hover table-bordered" id="example3">
															<thead>
																<tr>
																	<th>No</th>
																	<th>Group</th>
																	<th>Subject</th>
																	<th>Action</th>
																</tr>
															</thead>
															<tbody>

															<?php
															$current_cat = null;
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
																	<td><?php echo $row->lab_item_desc;?></td>
																	<td><input type="checkbox" name="lab[<?=$x++;?>]" value="<?=$row->id_lab_item;?>:<?=$row->lab_item_seq_no;?>" ></td>
																</tr>
															<?php
															}
															?>
															</tbody>
														</table>
													</div>
												</div>
                                            </div>
                                            <div class="tab-pane" id="tab2">
                                                <form class="form-horizontal">
                                                  <fieldset>
                                                    <table class="table table-hover table-bordered" id="example3">
															<thead>
																<tr>
																	<th>No</th>
																	<th>Group</th>
																	<th>Subject</th>
																	<th>Action</th>
																</tr>
															</thead>
															<tbody>

															<?php
															$current_cat = null;
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
																	<td><?php echo $row->lab_item_desc;?></td>
																	<td><input type="checkbox" name="lab[<?=$x++;?>]" value="<?=$row->id_lab_item;?>:<?=$row->lab_item_seq_no;?>" ></td>
																</tr>
															<?php
															}
															?>
															</tbody>
														</table>
                                                  </fieldset>
                                                </form>
                                            </div>

                                        </div> 
				
                                    </div>
												
											</div>
											<!-- /block -->
										</div>				
				
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
									
										<div class="form-actions">
										<a href="#myAlert" data-toggle="modal" class="btn btn-success">Save</a>
                                        </div>
										</form>
									<legend></legend>
				
									</fieldset>  

                                </div>
                            </div>
                        </div>
						
                        <!-- /block -->
                    </div>
