				<?php
				$link 		= $this->uri->segment(3);
				?>
				<script type="text/javascript">
					function closeit(val){
					var mystr = val;
					var myarr = mystr.split(":");
					var myvar = myarr[1] + ":" + myarr[2];
					window.opener.document.forms['mst_pr'].elements['item[<?=$link;?>]'].value=myarr[0];
					window.opener.document.forms['mst_pr'].elements['id_item[<?=$link;?>]'].value=myarr[1];
					window.opener.document.forms['mst_pr'].elements['id_base[<?=$link;?>]'].value=myarr[2];
					window.opener.document.forms['mst_pr'].elements['pr_no[<?=$link;?>]'].value=myarr[3];
					window.opener.document.forms['mst_pr'].elements['id_pr[<?=$link;?>]'].value=myarr[4];
					window.opener.document.forms['mst_pr'].elements['his_item[<?=$link;?>]'].value=myarr[5];
					window.opener.document.forms['mst_pr'].elements['vestige[<?=$link;?>]'].value=myarr[6];
					window.close(this);
						}
				</script>
				<?php
				function findage_detail($dob){
						$interval = date_diff(date_create(), date_create($dob));
						echo $interval->format("%Y Year, %M Months");
					}
				?>
                <body onload="startTime()">
                <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><b>Find Item</b></div>
                            <div class="muted pull-right" id="txt" style="font-weight: bold;"></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">                                   
  									<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
										<thead>
											<tr>
												<th>No</th>
												<th>PR Number</th>
												<th>Name</th>
												<th>Baseunit</th>
												<th>Qty</th>
												<th>vestige</th>
												<th>Remarks</th>
												<th>Stock</th>
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
												<td><?=$row->pr_no;?></td>
												<td><?=$row->item_name;?></td>
												<td><?=$row->baseunit;?></td>
												<td><?=$row->item_qty;?></td>
												<td><?=$row->vestige;?></td>
												<td><?=$row->item_remarks;?></td>
												<td><?=$row->item_curr_qty;?></td>
												<td>
												
												<a href="" onclick="closeit('<?=str_replace("'","",$row->item_name);?> (<?=$row->vestige;?>):<?=$row->id_item;?>:<?=$row->id_baseunit;?>:<?=$row->pr_no;?>:<?=$row->id_pr_no;?>:<?=$row->id_item;?>:<?=$row->vestige;?>');"><button class="btn btn-mini"><i class="icon-shopping-cart"></i></button></a>

												<!-- <a href="" onclick="closeit('<?=str_replace("'","",$row->item_name);?>:<?=$row->item_curr_qty;?>:<?=$row->baseunit;?>:<?=$row->id_item;?>');"><button class="btn btn-mini"><i class="icon-shopping-cart"></i></button></a> -->

												</td>
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