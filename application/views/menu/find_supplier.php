				<script type="text/javascript">
					function closeit(val){
						var mystr = val;
						var myarr = mystr.split(":");
						var myvar = myarr[1] + ":" + myarr[2];
					 	// alert(myarr[0]);
						window.opener.document.forms['mst_pr'].elements['id_supplier'].value=myarr[0];
						window.opener.document.forms['mst_pr'].elements['name_supplier'].value=myarr[1];
						window.opener.document.forms['mst_pr'].elements['spcode'].value=myarr[2];
						window.opener.document.forms['mst_pr'].elements['term'].value=myarr[3];
						window.close(this);
					}

					// function closeit(val){
					// alert(val);
					// // console.log(val);
					// // window.stop();
					// // watch.Stop();
					// var mystr = val;
					// var myarr = mystr.split(":");
					// var myvar = myarr[1] + ":" + myarr[2];
					// window.opener.document.forms['mst_pr'].elements['id_supplier'].value=myarr[0];
					// window.opener.document.forms['mst_pr'].elements['name_supplier'].value=myarr[1];
					// window.opener.document.forms['mst_pr'].elements['supplier'].value=myarr[2];
					// window.opener.document.forms['mst_pr'].elements['contacts'].value=myarr[3];
					// window.opener.document.forms['mst_pr'].elements['term'].value=myarr[4];
					// window.close(this);
					// 	}
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
                                <div class="muted pull-left">Find Supplier</div>
                            </div>
                        	 

                            <div class="block-content collapse in">
                                <div class="span12">   
								
								<div class="form-actions">
                        	 	<button onclick="window.open('', '_self', ''); window.close();" class="btn btn-danger btn-large"><i class="icon-off"></i> Close</button>	
                                </div>                                
                                
  									<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
										<thead>
											<tr>
												<th>No</th>
												<th>Supplier Code</th>
												<th>Name</th>
												<th>Address</th>
												<th>Contact</th>
												<th>Phone</th>
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
												<td><?=$row->supp_code;?></td>
												<td><?=$row->supp_name;?></td>
												<td><?php echo $row->supp_address1;?></td>
												<td><?php echo $row->supp_contact1;?></td>
												<td><?php echo $row->supp_phone;?></td>
												<td>
												<a href="" onclick="closeit('<?=$row->id_supplier;?>:<?=$row->supp_name;?>:<?=$row->supp_code;?>:<?php echo $row->term_payment;?>');"><button class="btn btn-mini"><i class="icon-plus-sign"></i></button></a>
												<!-- <a href="" onclick="closeit('<?=$row->id_supplier;?>:<?=$row->supp_name;?> \n<?=$row->supp_address1;?> \n\n<?php echo $row->supp_contact1;?>:<?php echo $row->term_payment;?>');"><button class="btn btn-mini"><i class="icon-plus-sign"></i></button></a> -->
												
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
		<link href="<?php echo base_url();?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
        <script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url();?>design/assets/scripts.js"></script>
        <script src="<?php echo base_url();?>design/assets/DT_bootstrap.js"></script>