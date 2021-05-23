				<?php
				$link 		= $this->uri->segment(3);
				$butuh 		= $this->uri->segment(5);
				?>
				<script type="text/javascript">
					function closeit(val){
	  				var vestige 		= document.getElementById("butuh").value;
					var mystr 			= val.replace(/;/g, "\n");;
					var myarr 			= mystr.split(":");
					var myvar 			= myarr[2] + ":" + myarr[3];
					var hasil 			= vestige / myarr[2];
					var jumlah 			= Math.trunc(hasil) * myarr[2];
					window.opener.document.forms['mst_pr'].elements['base[<?=$link;?>]'].value=myarr[0];
					window.opener.document.forms['mst_pr'].elements['basename[<?=$link;?>]'].value=myarr[1];					
					window.opener.document.forms['mst_pr'].elements['conv_id[<?=$link;?>]'].value=myarr[2];					
					window.opener.document.forms['mst_pr'].elements['qty[<?=$link;?>]'].value=Math.trunc(hasil);					
					window.opener.document.forms['mst_pr'].elements['convq[<?=$link;?>]'].value=jumlah;					
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

								<div class="form-actions">
                                <button onclick="window.open('', '_self', ''); window.close();" class="btn btn-danger"><i class="icon-off"></i> Close</button>                    
								</div>

  									<input type="hidden" name="butuh" id="butuh" value="<?php echo $butuh;?>">
  									<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
										<thead>
											<tr>
												<th>No</th>
												<th>Base Unit</th>
												<th>Conv Factor</th>
												<th>Dest Unit</th>
												<th>Remark</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
										<?php
										$i=1;
										foreach($conversion_base->result() as $row){
										?>
											<tr class="odd gradeX">
												<td><?=$i++;?></td>
												<td><?php echo $row->baseunit;?></td>
												<td><?php echo $row->conv_factor;?></td>		
												<td><?php echo $row->xx;?></td>	
												<td><?php echo $row->remarks;?></td>	
												<td> <a href="" onclick="closeit('<?=$row->id_conv;?>:<?=$row->baseunit;?> (<?=$row->conv_factor;?> <?=$row->xx;?>):<?=$row->conv_factor;?>');"><button class="btn btn-mini"><i class="icon-plus-sign"></i></button></a><div style="font-size: 0.0001em; display: none;"><?=str_replace(";","",$row->files);?></div></td>
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