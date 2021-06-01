	<?php
	    include './design/fingers/global.php';
    	include './design/fingers/function.php';
		$id = $this->uri->segment(3);
		if ($id=="ok"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Input Marking Sheet Medical Check Up
		</div>
	<?php
		} else if ($id=="update") {
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Update Marking Sheet Medical Check Up
	    </div>
	<?php
		} else if ($id=="del") {
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Delete User
		</div>
	<?php
		}
	?>		
	<script>
	  function goBack(){
	  	window.history.back();
	  }
	  
	  function popup(b_id){
        window.open("<?php echo base_url();?>patient/find_patient_mark","","height=700,width=525,scrollbars=1,"+ 
                        "directories=1,location=1,menubar=1," + 
                         "resizable=1 status=1,history=1 top = 50 left = 100");
      }
	  
	  function popup_edit(b_id){
        window.open("<?php echo base_url();?>patient/find_patient_mark","","height=700,width=525,scrollbars=1,"+ 
                        "directories=1,location=1,menubar=1," + 
                         "resizable=1 status=1,history=1 top = 50 left = 100");
      }
	  
	  function btntest_onclick(){
		window.location.href = "<?php echo base_url();?>patient/quesioner_patient_mcu/edit";
	  }
	  
      function myFunction(id) {
		var myWindow = window.open("<?php echo base_url();?>patient/print_mark_sheet/"+id+"", "", "width=680, height=650");
	 }
	 
	 function myFunction2(id) {
		 window.location.href = "<?php echo base_url();?>patient/mark_sheet_mcu/xxx/"+id+"";
	 }

      function finger(){
       setTimeout(function(){
         window.location.reload(1);
      }, 10000);
	  }
	</script>
					<body onload="startTime()">
                    <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><b>Result Dental Medical Check Up</b></div>
							<div class="muted pull-right" id="txt" style="font-weight: bold;"></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                    <fieldset>
                                        <div style="float:left;"></div><div style="float:right;"><button class="btn btn-success btn-mini" onclick="myFunction2('<?=$_POST['id_reg'];?>')"><i class="icon-lock"></i> <b>Unlock Form</b></button> <button class="btn btn-info btn-mini" onclick="myFunction('<?=$_POST['id_reg'];?>')"> <i class="icon-print"></i> <b>Print</b></button></div>
										</br>
										<form class="form-horizontal" action="<?php echo base_url();?>patient/save_mark_mcu" method="post" name="mark_mcu">
                                        <div class="control-group">
                                          <label class="control-label" for="focusedInput">ID Registration</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="pat_mrn" type="text" value="<?=$_POST['pat_mrn'];?>" id="" readonly autocomplete="off" placeholder=" ... ">
											<input name="id_reg" type="hidden" value="<?=$_POST['id_reg'];?>" id=""  autocomplete="off" >
											<input name="id_up" type="hidden" id=""  autocomplete="off" >
											<input name="id_pat" type="hidden" id="" value="<?=$_POST['id_pat'];?>"  autocomplete="off" >
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Patient Name</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="pat_name" type="text" id="myText02" value="<?=$_POST['pat_name'];?>" readonly autocomplete="off" required>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Age</label>
                                          <div class="controls">
											<input class="input-xlarge focused" name="age" type="text" id="" value="<?=$_POST['age'];?>" readonly autocomplete="off" required> 	
                                          </div>
                                        </div>

										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Company Name</label>
                                          <div class="controls">
                                           <input class="input-xlarge focused" name="client_name" type="text" value="<?=$_POST['client_name'];?>"  id="myText03" maxlength="0" autocomplete="off" readonly>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Package MCU</label>
                                          <div class="controls">
											<input class="input-xlarge focused" name="pat_mcu" type="text" value="<?=$_POST['pat_mcu'];?>" readonly autocomplete="off" required> 	
                                          </div>
                                        </div>
								
										<div class="row-fluid">
											<!-- block -->
											<div class="block" style="width: auto; float: center;">
												<div class="navbar navbar-inner block-header">
													<div class="muted pull-left"><b>Dental Result</b></div>
												</div>
												<div class="block-content collapse in" style="overflow-x:scroll;overflow-y:scroll; height:auto; width:auto; overflow:hidden;">
													<div class="span12">
														<table class="table table-hover">
															<thead>
																<tr>
																	<th>Contents</th>
																	<th></th>
																	<th>Result</th>
																</tr>
															</thead>
															<tbody>
															<?php
															$row_cnt = $find_left->num_rows();
															?>
															<input type="hidden" name="rowC" value="<?=$row_cnt;?>">
																<?php 
																$current_cat = null;
																$x			 = 1; $o			 = 1;
																$y			 = 1;
																$z			 = 1;
																$v			 = 1;	
																foreach($find_left->result() as $row_isi){
																?>
																
																<tr>
																	<td><?php 
																	if($row_isi->serv_name != $current_cat){
																		$current_cat = $row_isi->serv_name;
																		echo "<b>".$o++.". ".$current_cat."</b>";
																	}else{
																		echo "";
																	}
																	?></td>
																	<td><b><?=$v++;?>.</b> <?=$row_isi->nama_value;?></td>
																	<td><input type="text" style="width: 185px;" size="10" name="result_<?=$x++;?>" value="<?=$row_isi->result;?>" autocomplete="off"></td>
																	<input type="hidden" name="id_serv_<?=$y++;?>" value="<?=$row_isi->serpis;?>">
																	<input type="hidden" name="id_value_<?=$z++;?>" value="<?=$row_isi->id;?>">
																</tr>
																<?php
																}
																?>
															</tbody>
														</table>
													</div>
												</div>
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
												<input type="submit" class="btn btn-success" value="Save">
												<a data-dismiss="modal" class="btn btn-warning" href="#">Close</a>
											</div>
										</div>
										
									</fieldset>     
                                </div>
                            </div>
							<div class="form-actions" >
							<a href="#myAlert" data-toggle="modal" class="btn btn-success"><b>Submit</b></a>
							<button class="btn btn-danger" type="reset"><b>Reset</b></button>
							<div style="align:right; float:right;">
							<input style="width:15px; height:20px;" type="checkbox" id="optionsCheckbox" name="complete" value="1"> <b><font color="red">Completed</font></b>
							</div>
                            </div>
							</form>
                        </div>
                        <!-- /block -->
                    </div>
					</body>
		<!--/.fluid-container-->
        <script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>
		<link href="<?php echo base_url();?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
        <script src="<?php echo base_url();?>design/assets/scripts.js"></script>
        <script src="<?php echo base_url();?>design/assets/DT_bootstrap.js"></script>
</html>