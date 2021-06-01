				<script type="text/javascript">
					function closeit(val){
					var mystr = val;
					var myarr = mystr.split(":");
					var myvar = myarr[1] + ":" + myarr[2];
					console.log(myarr[1]);
					window.opener.document.forms['mst_service'].elements['id_item'].value=myarr[0];
					window.opener.document.forms['mst_service'].elements['item_name'].value=myarr[1];
					window.opener.document.forms['mst_service'].elements['unit'].value=myarr[2];
					window.opener.document.forms['mst_service'].elements['id_base'].value=myarr[3];
					window.close(this);
						}
				</script>
                <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Find Item</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">                                   
  									<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
										<thead>
											<tr>
												<th>No</th>
												<th>Group</th>
												<th>Name</th>
												<th>Remarks</th>
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
												<td><?=$row->item_group;?></td>
												<td><?=$row->item_name;?>
													<?php 
														$id_manufaktur = $row->id_manufaktur;
														if ($id_manufaktur !="0") {
														echo '<span class="badge badge-important">M</span>';
														echo '<div style="display:none;">Manufacture</div>';
														}													
													?>
												</td>
												<td>
													<?=$row->item_remarks;?>
												</td>
												<td><a href="" onclick="closeit('<?=$row->id_item;?>:<?=str_replace("'","",$row->item_name);?>:<?=$row->baseunit;?>:<?=$row->id_baseunit;?>');"><button class="btn btn-mini"><i class="icon-shopping-cart"></i></button></a></td>
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