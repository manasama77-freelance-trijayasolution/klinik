				<?php
			    $id 					 = $this->uri->segment(3);
				?>
				<script type="text/javascript">
					function closeit(val){
					var mystr = val;
					var myarr = mystr.split(":");
					var myvar = myarr[1] + ":" + myarr[2];
					window.opener.document.getElementById("a<?=$id;?>").value=myarr[0];
					window.opener.document.forms['quotation'].elements['id_service[<?=$id;?>]'].value=myarr[1];
					window.opener.document.forms['quotation'].elements['group[<?=$id;?>]'].value=myarr[2];
					window.close(this);
					}
				</script>
                <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><b>Find Services</b></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">                                   
  									<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
										<thead>
											<tr>
												<th>No</th>
												<th>Services Name</th>
												<th>Group</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
										<?php
										$i=1;
										foreach($find->result() as $row){
										?>
											<tr class="odd gradeX">
												<td><?=$i++;?></td>
												<td><?php echo $row->serv_name;?></td>
												<td>[<?php echo $row->group_name;?>]</td>
												<td><a href="" onclick="closeit('<?=$row->serv_name;?>:<?=$row->id_service;?>:<?=$row->id_group_serv;?>');"><button class="btn btn-success btn-mini"><i class="icon-tags"></i></button></a></td>
											</tr>
										</form>
										<?php
										}
										?>
										</tbody>
									</table>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>				
        <script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>
		<link href="<?php echo base_url();?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
        <script src="<?php echo base_url();?>design/assets/scripts.js"></script>
        <script src="<?php echo base_url();?>design/assets/DT_bootstrap.js"></script>