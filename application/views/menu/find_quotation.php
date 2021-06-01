				<script type="text/javascript">
					function closeit(val){
					var mystr = val;
					var myarr = mystr.split(":");
					var myvar = myarr[1] + ":" + myarr[2];
					window.opener.document.forms['quotation'].elements['idx'].value=myarr[0];
					window.opener.document.forms['quotation'].elements['no_quot'].value=myarr[1];
					window.opener.document.forms['quotation'].elements['pack_name'].value=myarr[2];
					window.opener.document.forms['quotation'].elements['kompeni'].value=myarr[3];
					window.opener.document.forms['quotation'].elements['idy'].value=myarr[4];
					window.close(this);
					}
				</script>
                <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><b>Find My Quotation Files</b></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">                                   
  									<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
										<thead>
											<tr>
												<th>No</th>
												<th>Quotation No.</th>
												<th>Package Name</th>
												<th>Price</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
										<?php
										$i=1;
										foreach($find->result() as $row){
										$is = explode("/",$row->qout_id);
										?>
											<tr class="odd gradeX">
												<td><?=$i++;?></td>
												<td><?php echo $row->qout_id;?><?php if($row->quot_revision>=1){ echo "/Rev-".$row->quot_revision;} ?></td>
												<td><?php echo $row->quot_name;?></td>
												<td><div  style="float:right;"><?php echo number_format($row->grand_price,2);?></div></td>
												<td><a href="" onclick="closeit('<?=$row->id_quot;?>:<?=$row->qout_id;?>:<?=$row->quot_name;?>:<?=$row->client_name;?>:<?=$is[1];?>/<?=$is[2];?>/<?=$is[3];?>');"><button class="btn btn-info btn-mini"><i class="icon-file"></i></button></a></td>
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