				<script type="text/javascript">
					function closeit(val){

					// cara mendapatkan uri segment di javascript
					var url = $(location).attr('href').split("/").splice(0, 10).join("/");
					var segments = url.split( '/' );
					var action = segments[3];
					var id = segments[6];
					// alert (id);
					var mystr = val;
					var myarr 	= mystr.split(":");
					// var obat	= myarr[2]+" "+myarr[1];
					var obat	= myarr[1]+" Day";
					// alert(obat);
					window.opener.document.forms['mst_pr'].elements['id_drug_dosage['+id+']'].value=myarr[0];
					window.opener.document.forms['mst_pr'].elements['dosage['+id+']'].value=obat;
					window.close(this);
						}
				</script>
				<?php
				$val 	= $this->uri->segment(3);
				$id 	= $this->uri->segment(4);
				function findage_detail($dob){
						$interval = date_diff(date_create(), date_create($dob));
						echo $interval->format(" %Y Year, %M Months");
					}
				?>
                <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><b>Find Dosage</b></div>
                            </div>
							 <div class="form-actions">	
								<a href="<?php echo base_url();?>Pharmacy/add_dosage/<?=$val;?>/<?=$id;?>"><button class="btn btn-success"><i class="icon-plus"></i> Add Dosage</button></a>							 
							 </div>
                            <div class="block-content collapse in">
                                <div class="span12">                                   
  									<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
										<thead>
											<tr>
											    <th>No</th>
												<th nowrap>Drug Name</th>
												<th>Times</th>
												<th>Days</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
										<?php
										$i=1;
										foreach($data->result() as $row){
											$cara = $row->dosage_main." x ".$row->dosage_days;
										?>
											<tr class="odd gradeX">
												<td><?=$i++;?></td>	
												<td><?php echo $row->drug_name;?></td>
												<td><?php echo $row->dosage_main;?></td>
												<td><?php echo $row->dosage_days;?></td>
												<td><a href="" onclick="closeit('<?=$row->id_drug_dosage;?>:<?=$cara;?>:<?=$row->drug_name;?>');"><button type="submit" class="btn btn-mini"><i class="icon-plus-sign"></i></button></a></td>
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