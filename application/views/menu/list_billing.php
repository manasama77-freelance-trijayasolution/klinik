				<script type="text/javascript">
					function closeit(val){
					var mystr = val;
					var myarr = mystr.split(":");
					var myvar = myarr[1] + ":" + myarr[2];
					window.opener.document.forms['mark_mcu'].elements['pat_name'].value=myarr[0];
					window.opener.document.forms['mark_mcu'].elements['id_pat'].value=myarr[1];
					window.opener.document.forms['mark_mcu'].elements['id_reg'].value=myarr[2];
					window.opener.document.forms['mark_mcu'].elements['age'].value=myarr[3];
					window.opener.document.forms['mark_mcu'].elements['client_name'].value=myarr[4];
					window.opener.document.forms['mark_mcu'].elements['id_client'].value=myarr[5];
					window.opener.document.forms['mark_mcu'].elements['package_name'].value=myarr[6];
					window.opener.document.forms['mark_mcu'].elements['id_package'].value=myarr[7];
					window.opener.document.forms['mark_mcu'].elements['bill_no'].value=myarr[8];
					window.opener.document.forms['mark_mcu'].elements['id_billing'].value=myarr[9];
					window.opener.document.forms['mark_mcu'].elements['id_bh'].value=myarr[10];
					window.close(this);
						}
				</script>
				<?php
				function findage_detail($dob){
						$interval = date_diff(date_create(), date_create($dob));
						echo $interval->format(" %Y Year");
						// echo $interval->format(" %Y Year, %M Months");
					}
				?>
                <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Find Billing Patient</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">                                   
  									<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
										<thead>
											<tr>
											    <th>No</th>
												<th nowrap>Billing Number</th>
												<th nowrap>ID Registration</th>
												<th nowrap>Name Patient</th>
												<th>Company Name</th>
												<th>Charge Rule</th>
												<th>Outstanding</th>
												<!-- <th>Gender</th> -->
												<!-- <th>Marital Status</th> -->
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
												<td><?php echo $row->bill_no;?></td>
												<td><?php echo $row->id_reg;?></td>
												<td><?php echo $row->pat_name;?></td>
												<td><?php echo $row->client_name;?></td>
												<td><?php echo $row->price_type;?></td>
												<td><?php echo number_format($row->outstanding,2);?></td>
												<!-- <td><?php echo $row->gender;?></td> -->
												<!--<td><?php echo $row->marital_status;?></td> -->
												<td><a href="" onclick="closeit('<?=$row->pat_name;?>:<?=$row->id_Pat;?>:<?=$row->id_reg;?>:<?php echo $row->pat_dob;?> / <?php echo $row->pat_pob;?> / Age <?=findage_detail($row->pat_dob);?>:<?=$row->client_name?>:<?=$row->id_client?>:<?=$row->package_name?>:<?=$row->id_package?>:<?=$row->bill_no?>:<?=$row->id_billing?>:<?=$row->id_bh?>');"><button type="submit" class="btn btn-mini"><i class="icon-plus-sign"></i></button></a></td>
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