<meta charset="shift_js">	
	<script>
	 
	  function goBack(){
	  	window.history.back();
	  }  
	  

    function cek_group(group){
		window.location.href = "<?php echo base_url();?>master/cek_sysparam/"+group+"";
    }

    function update_bahasa(id){
    	var kode_tabel 		= document.getElementById('kode_tabel'+id+'').value;
    	var nama_tabel 		= document.getElementById('nama_tabel'+id+'').value;
    	var id_service 		= document.getElementById('id_service'+id+'').value;
    	
		window.open("<?php echo base_url();?>master/update_service_japan/"+kode_tabel+"/"+nama_tabel+"/"+id_service+"","Popup","height=610, width=980, top=50, left=210 ");
    }

	</script>
                    <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><b>
                            List Sysparam
                            </b></div>
                            </div>
							
                            <div class="block-content collapse in">
                                <div class="span12">           
                                      <fieldset>

                                      <div class="table-toolbar">
                                      <div class="btn-group pull-right">
                                         <button data-toggle="dropdown" class="btn dropdown-toggle"><i class="icon-th"></i> Tools <span class="caret"></span></button>
                                         <ul class="dropdown-menu">
											<li><a href="<?php echo base_url();?>master/expoert_list_language"><i class="icon-list-alt"></i> Export to Excel</a></li>
											<li><a href="<?php echo base_url();?>master/print_pdf_listpr"><i class="icon-print"></i> Print to PDF</a></li>
                                         </ul>
                                      </div>
									  </br>
									  </br>
                                   	</div> 
								   <div id="" style="overflow-y: auto; height:auto;">

									<input type="hidden" name="jml" value="<?php echo $jml;?>">
									<!-- <table cellpadding="0" cellspacing="0" border="0" width="100%"> -->
									<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
										<thead>
											<tr>
												<th>No</th>
												<th>Group Name</th>
												<th>English</th>
												<th>Japan</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
										<?php
										$i=1;
										foreach($find->result() as $row){
										?>
										<tr class="odd gradeX">
											<td><?=$i;?></td>
											<td><?php echo $row->group_name;?></td>
											<td>
											<input type="hidden" name="kode_tabel<?php echo $i; ?>" id="kode_tabel<?php echo $i; ?>"  value="<?php echo $row->kode_tabel;?>">
											<input type="hidden" name="nama_tabel<?php echo $i; ?>" id="nama_tabel<?php echo $i; ?>"  value="<?php echo $row->nama_tabel;?>">
											<input type="hidden" name="id_service<?php echo $i; ?>" id="id_service<?php echo $i; ?>"  value="<?php echo $row->id;?>">
											<!-- <input type="text" name="inggris<?php echo $i; ?>" id="inggris<?php echo $i; ?>"  value="<?php echo $row->nama_value;?>" style="width:450px"  readonly> -->
											<?php echo $row->nama_value;?>
											</td>
											<td>
											<!-- <input type="text" name="jepang<?php echo $i; ?>" id="jepang<?php echo $i; ?>" value="<?php echo $row->nama_value_j;?>" style="width:450px"> -->
											<?php echo $row->nama_value_j;?>
											</td>
											<td>
													<button class="btn btn-info btn-mini" title="Update" onclick="update_bahasa('<?php echo $i;?>');"><i class="icon-list"></i></button>
											</td>
										</tr>
										<?php
										$i++;
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