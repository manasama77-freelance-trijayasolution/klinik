				<?php
				$link 		= $this->uri->segment(3);
				?>
				<script type="text/javascript">
					function closeit(val){
					var mystr = val.replace(/;/g, "\n");;
					var myarr = mystr.split(":");
					var myvar = myarr[2] + ":" + myarr[3];
					window.opener.document.forms['mst_pr'].elements['pr_no[<?=$link;?>]'].value=myarr[0];
					window.opener.document.forms['mst_pr'].elements['id_pr[<?=$link;?>]'].value=myarr[1];
					window.close(this);
						}
				</script>
				<?php
				function findage_detail($dob){
						$interval = date_diff(date_create(), date_create($dob));
						echo $interval->format("%Y Year, %M Months");
					}
				?>
                <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Find Purchase Request</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">                                   
  									<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
										<thead>
											<tr>
												<th>No</th>
												<th>PR Number</th>
												<th>Department</th>
												<th>Date</th>
												<th>Qty</th>
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
												<td><?=$row->nama_dep;?></td>
												<td><?=$row->pr_date;?></td>
												<td><?=$row->qty++;?> Item(s)</td>
												<td><button class="btn btn-mini tooltip-left" data-html="true" data-original-title="<?=str_replace(";"," <br> ",$row->items);?>"><i class="icon-search"></i></button> 

												<a href="" onclick="closeit('<?=$row->pr_no;?>:<?=$row->id_pr_no;?>');"><button class="btn btn-mini"><i class="icon-plus-sign"></i></button></a><div style="font-size: 0.0001em; display: none;"><?=str_replace(";","",$row->files);?></div></td>
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
					        <script>
        $(function() {
            $('.tooltip').tooltip();	
			$('.tooltip-left').tooltip({ placement: 'left' });	
			$('.tooltip-right').tooltip({ placement: 'right' });	
			$('.tooltip-top').tooltip({ placement: 'top' });	
			$('.tooltip-bottom').tooltip({ placement: 'bottom' });

			$('.popover-left').popover({placement: 'left', trigger: 'hover'});
			$('.popover-right').popover({placement: 'right', trigger: 'hover'});
			$('.popover-top').popover({placement: 'top', trigger: 'hover'});
			$('.popover-bottom').popover({placement: 'bottom', trigger: 'hover'});
        });
        </script>
        <script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>
		<link href="<?php echo base_url();?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
        <script src="<?php echo base_url();?>design/assets/scripts.js"></script>
        <script src="<?php echo base_url();?>design/assets/DT_bootstrap.js"></script>