				<?php
				$link 		= $this->uri->segment(3);
				?>
				<script type="text/javascript">
					function closeit(val){
					var mystr = val;
					var myarr = mystr.split(":");
					var myvar = myarr[1] + ":" + myarr[2];
					window.opener.document.forms['mst_service'].elements['serv_name'].value=myarr[0];
					window.opener.document.forms['mst_service'].elements['serv_id'].value=myarr[1];
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
                                <div class="muted pull-left"><b>Find Lab Item</b></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">                                   
  									<table class="table table-hover table-bordered" id="example2">
															<thead>
																<tr>
																	<th>No</th>
																	<th>Group</th>
																	<th>Subject</th>
																	<th>Action</th>
																</tr>
															</thead>
															<tbody>

															<?php
															$current_cat = null;
														    $i=1; 
															$x=1;
															$row_cnt = $data->num_rows();
															?>
															
															<?php
															foreach($data->result() as $row){
															?>
																<tr>
																<td><?=$i++;?></td>
																<?php
																if ($row->group_name != $current_cat){
																$current_cat = $row->group_name;
																echo "<td><b><u>". $row->group_name . "</u></b>";
																}else{
																?>	
																	<td></td>
																<?php
																}
																?>
																	<input type="hidden" name="rowC" value="<?=$row_cnt;?>">
																	<td><?php echo $row->lab_item_desc;?></td>
																	<td><a href="" onclick="closeit('<?=rtrim($row->lab_item_desc);?>:<?=$row->id_lab_item;?>');"><button class="btn btn-mini"><i class=" icon-tint"></i></button></a>
																	<font style="display:none;"><?php echo $row->group_name;?>;<?php echo $row->lab_item_desc;?></font>
																	</td>
																</tr>
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