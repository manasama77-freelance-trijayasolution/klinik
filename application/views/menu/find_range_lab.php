				<?php
				$link 		= $this->uri->segment(3);
				?>
				<script type="text/javascript">
					function closeit(val){
					var mystr = val;
					var myarr = mystr.split(":");
					var myvar = myarr[1] + ":" + myarr[2];
					window.opener.document.forms['mst_lab'].elements['dtl'].value=myarr[0];
					window.opener.document.forms['mst_lab'].elements['std_value'].value=myarr[1];
					window.opener.document.forms['mst_lab'].elements['pat_gender'].value=myarr[2];
					window.opener.document.forms['mst_lab'].elements['range_1'].value=myarr[3];
					window.opener.document.forms['mst_lab'].elements['range_2'].value=myarr[4];
					window.opener.document.forms['mst_lab'].elements['low_limit'].value=myarr[5];
					window.opener.document.forms['mst_lab'].elements['high_limit'].value=myarr[6];
					window.opener.document.forms['mst_lab'].elements['min_limit'].value=myarr[7];
					window.opener.document.forms['mst_lab'].elements['max_limit'].value=myarr[8];
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
                                <div class="muted pull-left"><b>Find Item</b></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">                                   
  								<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
								<thead>
									<tr>
										<th>No</th>
										<th>Group</th>
										<th>Lab Item</th>
										<th>Gender</th>
										<th>Age Range</th>
										<th>Limit</th>
										<th>Extreme Limit</th>
										<th>Act</th>
									</tr>
								</thead>
								<tbody>
								<?php
								$i=1;
								foreach($data->result() as $row){
								?>
									<tr class="odd gradeX">
										<td><?=$i++;?></td>
										<td><?php echo $row->group_name;?></td>
										<td><?php echo $row->lab_item_desc;?> <i><b><?php echo $row->name_type;?></b></i></td>
										<td><?php echo $row->gender;?></td>
										<td><?php echo $row->age_range_1;?> - <?php echo $row->age_range_2;?> Months</td>
										<td><?php echo $row->low_limit;?> - <?php echo $row->high_limit;?></td>
										<td><?php echo $row->min_limit;?> - <?php echo $row->max_limit;?></td>
										<td><a href="" onclick="closeit('<?php echo rtrim($row->lab_item_desc);?>:<?php echo rtrim($row->std_value);?>:<?php echo rtrim($row->pat_gender)?>:<?php echo rtrim($row->age_range_1)?>:<?php echo rtrim($row->age_range_2)?>:<?php echo rtrim($row->low_limit)?>:<?php echo rtrim($row->high_limit)?>:<?php echo rtrim($row->min_limit)?>:<?php echo rtrim($row->max_limit)?>');"><button class="btn btn-warning btn-mini"><i class="icon-ok"></i></button></a></td>
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