	<div class="span9" id="content">	
	<?php
		$id = $this->uri->segment(3);
		if ($id=="ok"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Input Radiology Item
		</div>
	<?php
		} else if ($id=="change") {
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Update Data Master Services
	    </div>
	<?php
		} else if ($id=="del") {
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Delete Master Services
		</div>
	<?php
		}
		//Logic Parameter Button
		if ($id=="ok"){
			$id="0";
		}elseif ($id==""){
			$id="1";
		}elseif ($id=="edit"){
			$id="2";
		}elseif ($id=="del"){
			$id="0";
		}else{
			$id=$id;
		}

	?>		
	<script type="text/javascript">
	
	  function fetch_select(val)
	  {
	  $.ajax({
	  	type: 'post',
	  	url: 'fetch_data_rad',
	  	data: {
	  	get_option:val
	  	},
	  	success: function (response) {
	  	document.getElementById("new_select").innerHTML=response; 
	  	}
	  });
	  }

	  function undisableTxt(){
		  if (0 == <?=$id;?>) {
		window.location.href = "<?php echo base_url();?>radiology/input_radiology_items";
		};
		    
		<?php
			$x = 1; 
			while($x <= 10) {
			echo "document.getElementById('".$x."').disabled = false;";
			$x++;
			}	
		?>
	  }
	  
	  function goBack(){
	  	window.history.back();
	  }
	  
	  function popup(b_id){
        window.open("<?php echo base_url();?>patient/find_patient","Popup","height=auto,width=auto,scrollbars=1,"+ 
                        "directories=1,location=1,menubar=1," + 
                         "resizable=1 status=1,history=1 top = 50 left = 100");
      }
	  
	  function btntest_onclick(){
		window.location.href = "<?php echo base_url();?>radiology/input_radiology_items/edit";
	  }

	  function myFunction(id) {
			var r = confirm("Are You Sure ?");
			if (r == true) {
			x = window.location = "<?php echo base_url();?>radiology/delete_items/"+id+"";
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
                            <div class="muted pull-left">Input Radiology Item Form</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                      <fieldset>
									  <legend></legend>
										 <div class="form-actions">
										 <button onclick="undisableTxt()" class="btn btn-primary">Start</button>									 
										 <button class="btn btn-warning" onclick="goBack()">Back</button>
										 </div>
										 
										<?php
										if ($id != "2") {
										?>
										<form class="form-horizontal" action="<?php echo base_url();?>radiology/save_item" method="post" name="mst_service">
										<?php
										} else {
										?>
										<form class="form-horizontal" action="<?php echo base_url();?>radiology/update_item" method="post" name="mst_service">
										<?php
										}
										?>
										 
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Item Description</label>
                                          <div class="controls">
										  <textarea name="lab_item_desc" id="1" disabled></textarea>
                                          </div>
                                        </div>
													
									    <div class="control-group">
                                          <label class="control-label" for="select01">Item Group</label>
                                          <div class="controls">
                                            <select class="chzn-select" name="item_group" id="2" onchange="fetch_select(this.value);"  required disabled>
                                              <option value="">- Choose -</option>
                                              <?php 
											  foreach($data->result() as $rows){
											  ?>
												<option value="<?=$rows->id_rad_group?>"><?=$rows->group_desc?></option>
											  <?php
											  }
											  ?>
                                            </select>
                                          </div>
                                        </div>
																				
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Item Seq No</label>
                                          <div class="controls" id="new_select">
                                            
                                          </div>
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
												<input type="submit" class="btn" value="Save" id="3" disabled>
												<a data-dismiss="modal" class="btn" href="#">Cancel</a>
											</div>
										</div>
									
										<div class="form-actions">
										<a href="#myAlert" data-toggle="modal" class="btn btn-success">Save</a>
                                        </div>
                        
									<legend></legend>
									</form>

									<div class="table-toolbar">
                                      <div class="btn-group pull-right">
                                         <button data-toggle="dropdown" class="btn dropdown-toggle"><i class="icon-th"></i> Tools <span class="caret"></span></button>
                                         <ul class="dropdown-menu">
											<li><a href="<?php echo base_url();?>radiology/input_radiology_items_excel"><i class="icon-list-alt"></i> Export to Excel</a></li>
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
												<th>Group Name</th>
												<th>Option</th>
												<th>Radiology Item</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
										<?php
										$i=1; 	$cc=1;
										$aa=1;	$dd=1;
										$bb=1;
										foreach($item->result() as $row){
										?>
											<script>
												function updateArea<?=$aa++;?>(id){
													$.post("update_rad_2/<?=$row->id_rad_item;?>/"+id+"", $("#console").serialize());
												}
											</script>
											<tr class="odd gradeX">
												<td><?=$i++;?></td>
												<td><b><?php echo $row->group_desc;?></b></td>
												<td><select class="chzn-select" name="dat<?=$dd++;?>" onChange="updateArea<?=$bb++;?>(this.value);" id="">
												<option value="">- Choose -</option>
												<?php foreach($data->result() as $rows){ ?>
												<option value="<?=$rows->id_rad_group?>"><?=$rows->group_desc?></option>
												<?php }	?>
												</select></td>
												<td><?php echo $row->rad_item;?></td>
												<td><button onclick="myFunction(<?php echo $row->id_rad_item;?>);" class="btn btn-danger btn-mini"><i class="icon-trash"></i></button></td>
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
                </div>
		<!--/.fluid-container-->
        <script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>
		<link href="<?php echo base_url();?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
        <script src="<?php echo base_url();?>design/assets/scripts.js"></script>
        <script src="<?php echo base_url();?>design/assets/DT_bootstrap.js"></script>
</html>