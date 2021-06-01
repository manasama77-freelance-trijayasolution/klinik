	
	<script>


	  function goBack(){
	  	window.history.back();
	  }  
	  

    function add_sysparam(group){
		window.open("<?php echo base_url();?>master/add_sysparam/"+group+"","Popup","height=610, width=980, top=50, left=210 ");
    }

    function update_sysparam(id){
		window.open("<?php echo base_url();?>master/update_sysparam/"+id+"","Popup","height=610, width=980, top=50, left=210 ");
    }

    function delete_action(id,group) {
		var r = confirm("Are You Sure ?");
		if (r == true) {
			x = window.location = "<?php echo base_url();?>master/update_status/"+id+"/"+group+"";
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
                            <div class="muted pull-left"><b>Parameter <?=$isi;?> </b></div>
                            </div>
							
                            <div class="block-content collapse in">
                                <div class="span12">           
                                      <fieldset>
									<div class="table-toolbar">
                                      
										<div class="form-actions">
										<button class="btn btn-warning" onclick="goBack()" type="button"> Back </button>
										<button class="btn btn-success" onclick="add_sysparam('<?=$isi;?>')" type="button"><i class="icon-plus icon-white"></i> Add </button>
                                        </div>


                                   	</div> 

								   <div id="" style="overflow-y: auto; height:auto;">
									
									<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
										<thead>
											<tr>
												<th>No.</th>
												<th>sgroup</th>
												<th>skey</th>
												<th>svalue</th>
												<th>lvalue</th>
												<th>remark</th><!-- 
												<th>created_time</th>
												<th>created_by</th>
												<th>updated_time</th>
												<th>updated_by</th> -->
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
										<?php
										$i=1;
										foreach($find->result() as $row){
										?>
										<tr class="odd gradeX">
											<td><?=$i++?></td>
											<td><?php echo $row->sgroup;?></td>
											<td><?php echo $row->skey;?></td>
											<td><?php echo $row->svalue;?></td>
											<td><?php echo $row->lvalue;?></td>
											<td><?php echo $row->remark;?></td><!-- 
											<td><?php echo $row->created_time;?></td>
											<td><?php echo $row->created_by;?></td>
											<td><?php echo $row->updated_time;?></td>
											<td><?php echo $row->updated_by;?></td> -->
											<td class=" ">
													<button onclick="update_sysparam(<?php echo $row->id;?>);" class="btn btn-warning btn-mini"><i class="icon-edit"></i></button>
													<button class="btn btn-danger btn-mini" onclick="delete_action('<?php echo $row->id;?>','<?php echo $row->sgroup;?>');"><i class="icon-trash"></i></button>
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