				<?php
				$id = $this->uri->segment(3);
				if ($id=="ok"){
				?>
			    <div class="alert alert-success">
					 <button class="close" data-dismiss="alert">&times;</button>
					 <strong>Success!</strong> Delete Purchase Request
				</div>
				<?php
				}
				?>
				<script>
				function myFunction(id) {
					var r = confirm("Are You Sure ?");
					if (r == true) {
					x = window.location = "<?php echo base_url();?>inv/del_po/"+id+"";
					} else {
					x = "You pressed Cancel!";
					}
				}
				</script>
				<script>	  
				function goBack(){
					window.history.back();
				}
				
				function myFunction(id) {
					var myWindow = window.open("<?php echo base_url();?>marketing/list_detail_quotation_app/"+id+"", "", "width=845px, height=650px");
				}
				
				function myFunction_view(id) {
					var myWindow = window.open("<?php echo base_url();?>marketing/list_detail_quotation_view/"+id+"", "", "width=845px, height=650px");
				}

				function myFunction_2(id) {
					var myWindow = window.open("<?php echo base_url();?>marketing/update_detail_quotation/"+id+"", "", "");
				}
			
				function myFunction_3(id) {
					var r = confirm("Are You Sure ?");
					if (r == true) {
					x = window.location = "<?php echo base_url();?>marketing/delete_package/"+id+"";
					} else {
					x = "You pressed Cancel!";
					}
				}
				
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
                     <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><b>List Quotation Approval</b></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                   <div class="table-toolbar">
                                      <div class="btn-group pull-right">
                                         <button data-toggle="dropdown" class="btn dropdown-toggle"><i class="icon-th"></i> Tools <span class="caret"></span></button>
                                         <ul class="dropdown-menu">
											<li><a href="<?php echo base_url();?>inv/export_excel_listpr"><i class="icon-list-alt"></i> Export to Excel</a></li>
											<li><a href="<?php echo base_url();?>inv/print_pdf_listpr"><i class="icon-print"></i> Print to PDF</a></li>
                                         </ul>
                                      </div>
									  </br>
									  </br>
                                   </div> 
								   <div id="" style="overflow-y: auto; height:auto;">
								   
                                   <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example2">
                                        <thead>
                                            <tr>
												<th>No</th>
												<th>No Quotation</th>
												<th>Package Name</th>
												<th>Status</th>
												<th>Valid Date</th>
												<th>Expired Date</th>
												<th>Notes from Staff</th>
												<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
										function time_elapsed_string45($datetime, $full = false){
											$now 		= new DateTime;
											$ago 		= new DateTime($datetime);
											$diff 		= $now->diff($ago);
											$diff->w 	= floor($diff->d / 7);
											$string = array(
												'y' => 'year',
												'm' => 'month',
												'w' => 'week',
												'd' => 'day',
												'h' => 'hour',
												'i' => 'minute',
												's' => 'second',
											);
											foreach ($string as $k => &$v) {
												if ($diff->$k) {
													$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
												} else {
													unset($string[$k]);
												}
											}
											if (!$full) $string = array_slice($string, 0, 1);
											return $string ? implode(', ', $string) . ' ago' : 'just now';
										}
										
										$i=1;										
										foreach($list->result() as $row){
										
										if($row->sisa <= 0 | $row->is_finalised==4){
										$params="error";
										}else if($row->is_finalised==5 || $row->is_finalised==1){
										$params="info";
										}else{
										$params="success";
										}
										?>
                                           <tr class="<?=$params;?>">
												<td><?=$i++;?></td>
												<td><?php echo $row->qout_id;?><?php if($row->quot_revision>=1){ echo "/Rev-".$row->quot_revision;} ?><hr><i><?php echo time_elapsed_string45($row->quot_date_create);?></i></td>
												<td><?php echo $row->quot_name.' </br></br> Created By '.$row->fullname;?></td>
												<!-- <td><?php echo $row->quot_name;?></td> -->
												<td><?php echo $row->lvalue;?></td>
												<td><?php echo date("d M Y",strtotime($row->quot_date_valid));?></td>
												<?php
												if($row->sisa <= 0 ){
												?>
												<td><?php echo date("d M Y",strtotime($row->quot_date_end));?>, <b><font color="red">EXPIRED</font></b></td>
												<?php
												}else{																					
												?>
												<td><?php echo date("d M Y",strtotime($row->quot_date_end));?>, <?php echo $row->sisa;?> More Days</td>
												
												<?php
												}
												?>
												<td align="center"><div style="align:center;"><textarea style="width:120px; height:55px;" readonly><?php echo $row->notes_client;?></textarea></div></td>
												<td>
												<?php 
												if($row->is_finalised==1){
												?>
												<button class="btn btn-info btn-mini" title="Detail Package" onclick="myFunction('<?php echo $row->id_quot;?>');"><i class="icon-envelope"></i> <b>Open File</b></button>&nbsp;
												<?php 
												}else{
												?>
												<button class="btn btn-success btn-mini" title="Detail Package" onclick="myFunction_view('<?php echo $row->id_quot;?>');"><i class="icon-envelope"></i> <b>Open File</b></button>&nbsp;
												<?php } ?>
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
                        </div>
                        <!-- /block -->
                    </div>

				<script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>
				<script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
				<script src="<?php echo base_url();?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>
				<link href="<?php echo base_url();?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
				<script src="<?php echo base_url();?>design/assets/scripts.js"></script>
				<script src="<?php echo base_url();?>design/assets/DT_bootstrap.js"></script>