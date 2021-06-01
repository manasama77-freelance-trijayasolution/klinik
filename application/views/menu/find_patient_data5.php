				<script type="text/javascript">
					function closeit(val){
					var mystr = val;
					var myarr = mystr.split(":");
					var myvar = myarr[1] + ":" + myarr[2];
					window.opener.document.forms['quesioner_mcu'].elements['pat_mrn'].value=myarr[0];
					window.opener.document.forms['quesioner_mcu'].elements['id_pat'].value=myarr[1];
					window.opener.document.forms['quesioner_mcu'].elements['id_reg'].value=myarr[2];
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
                                <div class="muted pull-left"><b>Find Patient</b></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">                                   
  									<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
										<thead>
											<tr>
												<th>No</th>
												<th>ID Reg.</th>
												<th>Date</th>
												<th>Name</th>
												<th>Date of Birth</th>
												<th>Company</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
										<form method="post">
										<?php
										$i=1;
										foreach($find->result() as $row){
										?>
											<tr class="odd gradeX">
											<input style="display:none;" name="dataku" value="10">
												<td><?=$i++;?></td>
												<td><?=$row->id_reg;?></td>
												<td><?=date("d.m.Y",strtotime($row->reg_date));?> - <?=date("H:i:s",strtotime($row->create_date));?></td>
												<td><?php echo $row->pat_name;?>, <?php echo $row->title_desc;?></td>
												<td><?=date("d.m.Y",strtotime($row->pat_dob));?></td>
												<td><?php echo $row->client_name;?></td>
												<td><a href="" onclick="closeit('<?=$row->pat_name;?>:<?=$row->id_Pat;?>:<?=$row->id_reg;?>');"><button class="btn btn-info btn-mini"><i class="icon-plus-sign"></i></button></a></td>
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