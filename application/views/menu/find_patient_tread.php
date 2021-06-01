				<script type="text/javascript">
					function closeit(val){
					var mystr = val;
					var myarr = mystr.split(":");
					var myvar = myarr[1] + ":" + myarr[2];
					window.opener.document.forms['quesioner_mcu'].elements['pat_mrn'].value=myarr[0];
					window.opener.document.forms['quesioner_mcu'].elements['pat_name'].value=myarr[1];
					window.opener.document.forms['quesioner_mcu'].elements['pat_address'].value=myarr[2];
					window.opener.document.forms['quesioner_mcu'].elements['pat_telp'].value=myarr[3];
					window.opener.document.forms['quesioner_mcu'].elements['pat_dob'].value=myarr[4];
					window.opener.document.forms['quesioner_mcu'].elements['pat_status'].value=myarr[5];
					window.opener.document.forms['quesioner_mcu'].elements['id_reg'].value=myarr[6];
					window.opener.document.forms['quesioner_mcu'].elements['bp'].value=myarr[7];
					window.opener.document.forms['quesioner_mcu'].elements['hr'].value=myarr[8];
					window.opener.document.forms['quesioner_mcu'].elements['cp'].value=myarr[9];
					window.opener.document.forms['quesioner_mcu'].elements['hb'].value=myarr[10];
					window.opener.document.forms['quesioner_mcu'].elements['ch'].value=myarr[11];
					window.opener.document.forms['quesioner_mcu'].elements['fi'].value=myarr[12];
					window.opener.document.forms['quesioner_mcu'].elements['id_up'].value=myarr[13];
					window.close(this);
						}
				</script>
				<div class="span9" id="content">
                <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Find Patient Medical Check Up</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">                                   
  									<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
										<thead>
											<tr>
												<th>Patient MRN</th>
												<th>Name</th>
												<th>Birth Date & Place</th>
												<th>Gender</th>
												<th>Marital Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
										<?php
										foreach($find->result() as $row){
										?>
											<tr class="odd gradeX">
												<td><?php echo $row->pat_MRN;?>-<?=$row->id_treadmill_qst;?>-<?=$row->id_reg;?></td>
												<td><?php echo $row->pat_name;?></td>
												<td><?php echo $row->pat_dob;?> / <?php echo $row->pat_pob;?></td>
												<td><?php echo $row->gender;?></td>
												<td><?php echo $row->marital_status;?></td>
												<td><a href="" onclick="closeit('<?=$row->pat_MRN;?>:<?=$row->pat_name;?>:<?=$row->pat_address_home;?>:<?=$row->pat_contact_home;?>:<?php echo $row->pat_dob;?> / <?php echo $row->pat_pob;?>:<?=$row->marital_status;?>:<?=$row->id_reg;?>:<?=$row->tread_high_bp;?>:<?=$row->tread_high_hr;?>:<?=$row->tread_chest_pain;?>:<?=$row->tread_hard_breath;?>:<?=$row->tread_cardio_hist;?>:<?=$row->tread_foot_injury;?>:<?=$row->id_treadmill_qst;?>');"><li><i class="icon-ok"></i></li></a></td>
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
                </div>
        <script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>
		<link href="<?php echo base_url();?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
        <script src="<?php echo base_url();?>design/assets/scripts.js"></script>
        <script src="<?php echo base_url();?>design/assets/DT_bootstrap.js"></script>