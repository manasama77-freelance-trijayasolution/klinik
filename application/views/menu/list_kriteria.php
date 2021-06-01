	
	<script>
	 
	  function goBack(){
	  	window.history.back();
	  }  
	  

    function cek_group(group){
		window.location.href = "<?php echo base_url();?>master/cek_sysparam/"+group+"";
    }

    function add_sysparam(group){
		window.open("<?php echo base_url();?>master/add_new_kriteria","Popup","height=610, width=980, top=50, left=210 ");
    }

	</script>
                    <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><b>
                            List Kriteria
                            </b></div>
                            </div>
							
                            <div class="block-content collapse in">
                                <div class="span12">           
                                      <fieldset>
										
										<div class="form-actions">
										<button class="btn btn-success" onclick="add_sysparam()" type="button"><i class="icon-plus icon-white"></i> Add New</button>
                                        </div>
                        
									<div class="table-toolbar">
                                      <div class="btn-group pull-right">
                                         <button data-toggle="dropdown" class="btn dropdown-toggle"><i class="icon-th"></i> Tools <span class="caret"></span></button>
                                         <ul class="dropdown-menu">
											<li><a href="<?php echo base_url();?>marketing/mst_currency_excel"><i class="icon-list-alt"></i> Export to Excel</a></li>
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
												<th>No.</th>
												<th>Name</th>
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
											<td><?php echo $row->name;?></td>
											<td>
													<button class="btn btn-info btn-mini" title="View <?=$row->id;?>" onclick="cek_group('<?php echo $row->id;?>');"><i class="icon-list"></i></button>

                                                  <a href="<?php echo base_url();?>master/edit_kriteria/<?php echo $row->id;?>"><button class="btn btn-success btn-mini"><i class=" icon-edit"></i></button></a>
                                                  <a href="<?php echo base_url();?>user/del/<?php echo $row->id;?>"> <button class="btn btn-danger btn-mini"><i class="icon-remove"></i></button></a>
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