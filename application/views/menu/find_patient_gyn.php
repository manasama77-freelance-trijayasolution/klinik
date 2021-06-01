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
					window.opener.document.forms['quesioner_mcu'].elements['id_up'].value=myarr[7];
					window.opener.document.forms['quesioner_mcu'].elements['lmp_month'].value=myarr[8];
					window.opener.document.forms['quesioner_mcu'].elements['lmp_day'].value=myarr[9];
					window.opener.document.forms['quesioner_mcu'].elements['rm'].value=myarr[10];
					window.opener.document.forms['quesioner_mcu'].elements['igb'].value=myarr[11];
					window.opener.document.forms['quesioner_mcu'].elements['vd'].value=myarr[12];
					window.opener.document.forms['quesioner_mcu'].elements['qty'].value=myarr[13];
					window.opener.document.forms['quesioner_mcu'].elements['abrt'].value=myarr[14];
					window.opener.document.forms['quesioner_mcu'].elements['spnts'].value=myarr[15];
					window.opener.document.forms['quesioner_mcu'].elements['incd'].value=myarr[16];
					window.opener.document.forms['quesioner_mcu'].elements['trpy'].value=myarr[17];
					window.opener.document.forms['quesioner_mcu'].elements['ther_med'].value=myarr[18];
					window.opener.document.forms['quesioner_mcu'].elements['deli'].value=myarr[19];
					window.opener.document.forms['quesioner_mcu'].elements['cntrp'].value=myarr[20];
					window.opener.document.forms['quesioner_mcu'].elements['con_exp'].value=myarr[21];
					window.opener.document.forms['quesioner_mcu'].elements['go'].value=myarr[22];
					window.opener.document.forms['quesioner_mcu'].elements['exp_go'].value=myarr[23];
					window.opener.document.forms['quesioner_mcu'].elements['ge_year'].value=myarr[24];
					window.opener.document.forms['quesioner_mcu'].elements['ge_month'].value=myarr[25];
					window.opener.document.forms['quesioner_mcu'].elements['actv_sex'].value=myarr[26];
					window.close(this);
						}
				</script>
				<div class="span9" id="content">
                <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Find Patient Gynecology</div>
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
												<td><?php echo $row->pat_MRN;?>-<?=$row->id_gyne_qst;?>-<?=$row->id_reg;?></td>
												<td><?php echo $row->pat_name;?></td>
												<td><?php echo $row->pat_dob;?> / <?php echo $row->pat_pob;?></td>
												<td><?php echo $row->gender;?></td>
												<td><?php echo $row->marital_status;?></td>
												<td><a href="" onclick="closeit('<?=$row->pat_MRN;?>:<?=$row->pat_name;?>:<?=$row->pat_address_home;?>:<?=$row->pat_contact_home;?>:<?php echo $row->pat_dob;?> / <?php echo $row->pat_pob;?>:<?=$row->marital_status;?>:<?=$row->id_reg;?>:<?=$row->id_gyne_qst;?>:<?=$row->gyn_last_mens_month;?>:<?=$row->gyn_last_mens_day;?>:<?=$row->gyn_reg_mens;?>:<?=$row->gyn_irr_bleeding;?>:<?=$row->gyn_discharge;?>:<?=$row->gyn_discharge_qty;?>:<?=$row->gyn_abortion;?>:<?=$row->gyn_abort_spontan;?>:<?=$row->gyn_abort_induced;?>:<?=$row->gyn_hormon_ther;?>:<?=$row->gyn_hormon_meds;?>:<?=$row->gyn_delivery;?>:<?=$row->gyn_contracept;?>:<?=$row->gyn_contracept_desc;?>:<?=$row->gyn_operation;?>:<?=$row->gyn_operation_desc;?>:<?=$row->gyn_last_exam_year;?>:<?=$row->gyn_last_exam_mo;?>:<?=$row->gyn_sexual_act;?>');"><li><i class="icon-ok"></i></li></a></td>
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