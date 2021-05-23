	<?php
		$id = $this->uri->segment(3);
		if ($id=="ok"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Input Supplier
		</div>
	<?php
		} else if ($id=="change") {
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Update Data Master Supplier
	    </div>
	<?php
		} else if ($id=="del") {
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Delete Master Supplier
		</div>
	<?php
		}
	?>		
	<script>
	  function undisableTxt(){	    
		<?php
			$x = 1; 
			while($x <= 19) {
			echo "document.getElementById('".$x."').disabled = false;";
			$x++;
			}	
		?>
	  }
	  
	  function goBack(){
	  	window.history.back();
	  }

	function view_supplier($id_price){
		window.open("<?php echo base_url();?>inv/view_supplier/"+$id_price+"","Popup","height=610, width=980, top=50, left=210 ");
	}

	function edit_supplier($id_price){
		window.open("<?php echo base_url();?>inv/update_supplier/"+$id_price+"","Popup","height=610, width=980, top=50, left=210 ");
	}

	  function myFunction(id) {
			var r = confirm("Are You Sure Want Delete ?");
			if (r == true) {
				x = window.location = "<?php echo base_url();?>inv/delete_Supplier/"+id+"";
			} else {
				x = "You pressed Cancel!";
			}
		}



	</script>

	 <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left">Input Master Supplier</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                      <fieldset>
                                        <legend></legend>
										 <div class="form-actions">
										 <button onclick="undisableTxt()" class="btn btn-primary">Start</button> 										 
										 <button class="btn btn-warning" onclick="goBack()">Back</button>
										 </div>
										<form class="form-horizontal" action="<?php echo base_url();?>inv/save_sp" method="post" name="mst_service">
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Supplier Code</label>
                                          <div class="controls">
										  <input class="input-xlarge focused" name="s_code" type="text" id="1" autocomplete="off" disabled required>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Name</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="s_name" type="text" id="2" autocomplete="off" disabled required>
                                          </div>
                                        </div>

										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Address1</label>
                                          <div class="controls">
										  <textarea name="s_address" id="3" disabled></textarea>
                                          </div>
                                        </div>

										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Address2</label>
                                          <div class="controls">
										  <textarea name="s_address2" id="4" disabled></textarea>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="select01">Province</label>
                                          <div class="controls">
                                            <select id="5" name="pat_province"  disabled>
                                              <option value="DKI Jakarta">DKI Jakarta</option>
                                              <?php 
											  foreach($province->result() as $rows){
											  ?>
												<option value="<?=$rows->provinsi_nama?>" align="justify"><?=$rows->provinsi_nama;?></option>
											  <?php
											  }
											  ?>
                                            </select>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="">City</label>
                                          <div class="controls">
                                            <select id="6" name="city" style="width:285px" disabled>
                                              <option value="Kota Jakarta Pusat">Kota Jakarta Pusat</option>
                                              <?php 
											  foreach($city->result() as $rows){
											  ?>
												<option value="<?=$rows->nama_kota?>" align="justify"><?=$rows->nama_kota?></option>
											  <?php
											  }
											  ?>
                                            </select>
                                          </div>
                                        </div>


										<div class="control-group">
                                          <label class="control-label" for="">Nationality</label>
                                          <div class="controls">
                                            <select id="7" name="pat_nationality" style="width:285px" disabled>
                                              <option value="Indonesian">Indonesian</option>
                                              <?php 
											  foreach($national->result() as $rows){
											  ?>
												<option value="<?=$rows->nationality?>" align="justify"><?=$rows->nationality?></option>
											  <?php
											  }
											  ?>
                                            </select>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Zip Code</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="zipcode" type="text" id="8" maxlength="5" autocomplete="off" disabled required>
                                          </div>
                                        </div>
												
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Phone</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="phone" type="text" id="9" autocomplete="off" disabled required>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Fax</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="fax" type="text" id="10" autocomplete="off" disabled required>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Email</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="email" type="text" id="11" autocomplete="off" disabled required>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Term of Payment</label>
                                          <div class="controls">
										   <input class="input-mini focused" name="t_pay" type="number" id="16" value="0" autocomplete="off" disabled required> Day(s).
                                          </div>
                                        </div>

										<div class="control-group">
                                          <label class="control-label" for="focusedInput">NPWP1</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="s_npwp1" type="text" id="12" autocomplete="off" disabled required>
                                          </div>
                                        </div>
															
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">NPWP2</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="s_npwp2" type="text" id="13" autocomplete="off" disabled required>
                                          </div>
                                        </div>
														
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Contact1</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="kontak1" type="text" id="14" autocomplete="off" disabled>
                                          </div>
                                        </div>

                                        <div class="control-group">
                                          <label class="control-label" for="focusedInput">Contact2</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="kontak2" type="text" id="15" autocomplete="off" disabled>
                                          </div>
                                        </div>
<!-- 
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Balance</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="balance" type="text" id="14" autocomplete="off" value="0" disabled required>
                                          </div>
                                        </div>
															
                                        <div class="control-group">
                                          <label class="control-label" for="">Date of The Balance</label>
											<div class="controls">
                                            <input type="text" name="balance_date" class="input-large datepicker" id="15" value="<?php echo date("m/d/Y");?>" disabled>
                                          </div>
                                        </div>
																			
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Memo</label>
                                          <div class="controls">
										  <textarea name="memo" id="19" disabled>-</textarea>
                                          </div>
                                        </div>
										 -->
										
												
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
									
										<div class="form-actions">
										<a href="#myAlert" data-toggle="modal" class="btn btn-success">Save</a>
                                        </div>
                        
									<legend></legend>
									</form>
									
								<div class="block-content collapse in">
                                <div class="span12">
                                   <div class="table-toolbar">
                                      <div class="btn-group pull-right">
                                         <!-- <button data-toggle="dropdown" class="btn dropdown-toggle"><i class="icon-file"></i> Export Data <span class="caret"></span></button>
                                         <ul class="dropdown-menu">
											<li><a href="<?php echo base_url();?>radiology/radiology_job/1">Excel</a></li>
                                         </ul> -->
                                          <button data-toggle="dropdown" class="btn dropdown-toggle"><i class="icon-th"></i> Tools <span class="caret"></span></button>
                                          <ul class="dropdown-menu">
											<li><a href="<?php echo base_url();?>inv/inv_supplier_excel"><i class="icon-list-alt"></i> Export to Excel</a></li>
											<li><a href="<?php echo base_url();?>inv/print_pdf_listpr"><i class="icon-print"></i> Print to PDF</a></li>
                                         </ul>
                                      </div>
									  </br>
									  </br>
                                   </div> 
								   <div id="" style="overflow-y: auto; height:auto;">
									
									<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
										<thead>
											<tr>
												<th>No</th>
												<th>Code</th>
												<th>Name</th>
												<!-- <th>Address</th>
												<th>Contact</th>
												<th>Phone</th> -->
												<th>Term of Payment</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
										<?php
										$i=1;
										foreach($data->result() as $row){
										?>
											<tr class="odd gradeX">
												<td><?=$i++;?></td>
												<td><?php echo $row->supp_code;?></td>
												<td><?php echo $row->supp_name;?></td>											
												<!-- <td><?php echo $row->supp_address1;?></td>
												<td><?php echo $row->supp_contact1;?></td>
												<td><?php echo $row->supp_phone;?></td> -->
												<td><?php echo $row->term_payment;?></td>
												<td>
													<button onclick="view_supplier(<?php echo $row->id_supplier;?>);" title="View Supplier" class="btn btn-success btn-mini"><i class="icon-info-sign"></i></button>
													<button onclick="edit_supplier(<?php echo $row->id_supplier;?>);" class="btn btn-warning btn-mini" title="Edit Supplier"><i class="icon-edit"></i></button>
													<button onclick="myFunction(<?=$row->id_supplier;?>);" class="btn btn-danger btn-mini" title="Delete Supplier"><i class="icon-trash"></i></button>
												</td>
											</tr>
										</form>
										<?php
										}
										?>
										</tbody>
									</table>
									
									</fieldset>                     						
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
		<!--/.fluid-container-->

        <script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>
		<link href="<?php echo base_url();?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
        <script src="<?php echo base_url();?>design/assets/scripts.js"></script>
        <script src="<?php echo base_url();?>design/assets/DT_bootstrap.js"></script>



	
</html>