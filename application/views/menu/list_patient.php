<?php
		$id = $this->uri->segment(3);
		if ($id=="ok"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Input Patient
		</div>
	<?php
		} else if ($id=="add") {
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Add New User
	    </div>
	<?php
		} else if ($id=="del") {
	?>
		<div class="alert alert-danger">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Delete Patient
		</div>
	<?php
		}
	?>

					<script type="text/javascript">
					// function closeit(val){
					// var mystr = val;
					// var myarr = mystr.split(":");
					// var myvar = myarr[1] + ":" + myarr[2];
					// window.opener.document.forms['quesioner_mcu'].elements['pat_mrn'].value=myarr[0];
					// window.opener.document.forms['quesioner_mcu'].elements['id_pat'].value=myarr[1];
					// window.close(this);
					// 	}

					function change_pat(b_id){
						var myWindow = window.open("<?php echo base_url();?>registration/pat_update/"+b_id, "", "width=1200px, height=500px, top=70, left=80");
					}

				function delete_pat(id) {
					var r = confirm("Are You Sure ?");
					if (r == true) {
					x = window.location = "<?php echo base_url();?>patient/delete_pat/"+id+"";
					} else {
					x = "You pressed Cancel!";
					}
				}
				</script>
				<?php
				function findage_detail($dob){
						$interval = date_diff(date_create(), date_create($dob));
						echo $interval->format(" %Y Year, %M Months");
					}
				?>
                <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><b>Data Patient</b></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">         
                                 <div class="table-toolbar">
                                      <div class="btn-group pull-right">
                                         <button data-toggle="dropdown" class="btn dropdown-toggle"><i class="icon-th"></i> Tools <span class="caret"></span></button>
                                         <ul class="dropdown-menu">
											<li><a href="<?php echo base_url();?>patient/list_patient_excel"><i class="icon-list-alt"></i> Export to Excel</a></li>
											<li><a href="<?php echo base_url();?>patient/list_patient_excel_for_eazy"><i class="icon-list-alt"></i> Export For Eazy Accounting</a></li>
											<li><a href="<?php echo base_url();?>inv/print_pdf_listpr"><i class="icon-print"></i> Print to PDF</a></li>
                                         </ul>
                                      </div>
									  </br>
									  </br>
                                   	</div> 
								   <div id="" style="overflow-y: auto; height:auto;">

								                             
  									<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
										<thead>
											<tr>
											    <th>No</th>
												<th nowrap>Patient ID - MRN</th>
												<th nowrap>Name</th>
												<th>Date of Birth</th>
												<th>Company Name</th>
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
												<td><?php echo $row->pat_MRN;?> | <?php echo $row->id_history;?></td>
												<td><?php echo $row->pat_name;?>, <?php echo $row->title_desc;?></td>
												<td><?=date("d.m.Y",strtotime($row->pat_dob));?></td>
												<td><?php echo $row->client_name;?></td>
												<td>
												<button onclick="change_pat('<?=$row->pat_MRN;?>');" class="btn btn-info btn-mini"><i class=" icon-edit"></i></button>
												<button onclick="delete_pat('<?=$row->id_Pat;?>');" class="btn btn-danger btn-mini"><i class="icon-trash"></i></button>
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