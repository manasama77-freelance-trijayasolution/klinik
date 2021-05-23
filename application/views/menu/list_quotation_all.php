				<?php
				$id  = $this->uri->segment(3);
				$idx = $this->uri->segment(4);
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
				function goBack(){
					window.history.back();
				}
				
				function print_client(id) {
					var myWindow = window.open("<?php echo base_url();?>marketing/print_client/"+id+"", "", "width=845px, height=650px");
				}
				
				function print_excel_client(id) {
					var myWindow = window.open("<?php echo base_url();?>marketing/print_excel_client/"+id+"", "", "width=845px, height=650px");
				}
				
				function sales_contract(id) {
					var myWindow = window.open("<?php echo base_url();?>marketing/sales_contract_print/"+id+"", "", "width=845px, height=650px");
				}
				
				function print_orderform(id, val) {
					var myWindow = window.open("<?php echo base_url();?>marketing/print_orderform/"+id+"/"+val+"", "", "width=845px, height=650px");
				}
				
				function myFunction(id) {
					var myWindow = window.open("<?php echo base_url();?>marketing/list_detail_quotation/"+id+"", "", "width=845px, height=650px");
				}

				function myFunction_2(id) {
					var myWindow = window.open("<?php echo base_url();?>marketing/update_detail_quotation/"+id+"", "", "");
				}
				
				function myFunction_up(id) {
					var myWindow = window.open("<?php echo base_url();?>marketing/update_detail_quotation/"+id+"/edit", "", "");
				}

				function myFunction_3(id) {
					var r = confirm("Are You Sure ?");
					if (r == true) {
					x = window.location = "<?php echo base_url();?>marketing/delete_package/"+id+"";
					} else {
					x = "You pressed Cancel!";
					}
				}
				
				function posting(id,val) {
					var r = confirm("Are You Sure, Post Package "+val+" ?");
					if (r == true) {
					x = window.location = "<?php echo base_url();?>marketing/posting_package/"+id+"";
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
				<script>
				function myFunction_app(id) {
					var myWindow = window.open("<?php echo base_url();?>marketing/p_app_client/"+id+"", "", "width=845px, height=650px");
				}
				
				function myFunction_app3(id) {
					var person = prompt("Notes for Approved by Client "+id+" ");
					if (person != null) {
						
						var variableToSend = person;
						alert(variableToSend);
						$.post("app_client/"+id+"",{variable: variableToSend});
						alert('Success Approved by Client, Thank You.');
						}else{
						alert("Cancel, Please check again.");
					}
				}
				
				function myFunction_dec(id) {
					var person = prompt("Notes for Declined by Client");
					if (person != null) {
					var variableToSend = person;
						alert(variableToSend);
						$.post("dec_client/"+id+"",{variable: variableToSend});
						alert('Success Approved by Client, Thank You.');
						}else{
						alert("Cancel, Please check again.");
					}
				}

				function Set_approve(id) {
					var myWindow = window.open("<?php echo base_url();?>marketing/list_detail_quotation_app/"+id+"", "Popup", "width=845px, height=650px");
				}
				
				</script>
                     <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><b>My Quotation</b></div>
                            </div>
							 <div class="form-actions">	
								<div class="btn-group">
								<button data-toggle="dropdown" class="btn btn-info btn-large dropdown-toggle"><b>Menu</b> <span class="caret"></span></button>
								<ul class="dropdown-menu">
								<li><a href="<?php echo base_url();?>marketing/quotation"><i class="icon-plus"></i> Add Quotation</a></li>
								<li><a href="<?php echo base_url();?>marketing/order_form"><i class="icon-plus"></i> Add Order Form</a></li>
								<li><a href="<?php echo base_url();?>marketing/sales_contract"><i class="icon-plus"></i> Add Sales Contract</a></li>
								<li class="divider"></li>
								<li><a href="<?php echo base_url();?>marketing/my_order_form"><i class="icon-file"></i> My Order Form</a></li>
								<li><a href="<?php echo base_url();?>marketing/my_sales_contract"><i class="icon-file"></i> My Sales Contract</a></li>
								</ul>
								</div>
							 </div>
				 
                            <div class="block-content collapse in">

                              <div class="btn-group pull-right">
                                 <button data-toggle="dropdown" class="btn btn-warning dropdown-toggle">
                                 <?php if ($id=="1") { ?><i class="icon-exclamation-sign"></i> <b>Waiting</b><?php }?> 
                                 <?php if ($id=="2") { ?><i class="icon-exclamation-sign"></i> <b>Read</b><?php }?>
                                 <?php if ($id=="3") { ?><i class="icon-ok-sign"></i> <b>Approve</b><?php }?> 
                                 <?php if ($id=="4") { ?><i class="icon-remove-sign"></i> <b>Reject</b><?php }?> 
                                 <?php if ($id=="5") { ?><i class="icon-exclamation-sign"></i> <b>Post</b><?php }?> 
                                 <?php if ($id=="6") { ?><i class="icon-ok-sign"></i> <b>Approve by Client</b><?php }?> 
                                 <?php if ($id=="7") { ?><i class="icon-remove-sign"></i> <b>Decline by Client</b><?php }?> 
                                 <?php if ($id=="all") { ?><b>All</b><?php }?> 
                                 <span class="caret"></span>
                                 </button>
                                 <ul class="dropdown-menu">
									<li><a href="<?php echo base_url();?>marketing/list_quotation_all/1"><i class="icon-exclamation-sign"></i> <b>Waiting</b></a></li>
									<li><a href="<?php echo base_url();?>marketing/list_quotation_all/2"><i class="icon-folder-open"></i> <b>Read</b></a></li>
									<li><a href="<?php echo base_url();?>marketing/list_quotation_all/5"><i class="icon-exclamation-sign"></i> <b>Post</b></a></li>
                                    <li><a href="<?php echo base_url();?>marketing/list_quotation_all/3"><i class="icon-bell"></i> <b>Approve</b></a></li>
                                    <li><a href="<?php echo base_url();?>marketing/list_quotation_all/6"><i class="icon-ok-sign"></i> <b>Approve by Client</b></a></li>
									<li><a href="<?php echo base_url();?>marketing/list_quotation_all/4"><i class="icon-exclamation-sign"></i> <b>Reject</b></a></li>
									<li><a href="<?php echo base_url();?>marketing/list_quotation_all/all"><b>All</b></a></li>
                                 </ul>
                              </div>	
                              		       
                                   <div class="table-toolbar">
                                      <!-- <div class="btn-group pull-right">
                                         <button data-toggle="dropdown" class="btn dropdown-toggle"><i class="icon-th"></i> Tools <span class="caret"></span></button>
                                         <ul class="dropdown-menu">
											<li><a href="<?php echo base_url();?>inv/export_excel_listpr"><i class="icon-list-alt"></i> Export to Excel</a></li>
											<li><a href="<?php echo base_url();?>inv/print_pdf_listpr"><i class="icon-print"></i> Print to PDF</a></li>
                                         </ul>
                                      </div> -->
									  </br>
									  </br>
                                   </div> 
								   <div style="overflow-y: auto; height:auto; position: relative;">
								   
                                   <table cellpadding="0" cellspacing="0" border="0" class="table table-hover table-bordered" id="example2" style="font-size: 13px;font-weight: normal;">
                                        <thead>
                                            <tr>
												<th>No</th>
												<th>No Quotation</th>
												<th>Package Name</th>
												<th>Status</th>
												<th>Valid Date</th>
												<th>Expired Date</th>
												<th>Notes</th>
												<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
										$i=1;		
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
										
										foreach($list->result() as $row){
										$params="info";
										
										if($row->sisa <= 0 | $row->is_finalised==4){
										$params="error";
										}else if($row->is_finalised==5 || $row->is_finalised==1){
										$params="info";
										}else{
										$params="success";
										}
										?>
										   <input type="hidden" id="pesan" name="notes">
										   <input type="hidden" id="angka" name="angka">
										   <input type="hidden" id="pesan" name="idx" value="<?=$row->id_quot?>">
											
                                           <tr class="<?=$params;?>">
												<td><?=$i++;?></td>
												<td><?php echo $row->qout_id;?> 
												
												<?php if($row->quot_revision>=1){ echo "Rev-".$row->quot_revision;} ?>
												<?php
												if($row->is_finalised==1){
												?>
												</br>
												<button style="width:120px;" class="btn btn-warning btn-mini" title="Update Package" onclick="myFunction_up('<?php echo $row->id_quot;?>');"><div align="left"><i class="icon-edit"></i> <b>Open Save File</b></div></button>&nbsp;
												<?php 
												}
												?>
												<hr><i><?php echo time_elapsed_string45($row->quot_date_create);?></i>
												</td>
												<td><?php echo $row->quot_name.' </br></br> Created By '.$row->fullname;?></td>
												<td><?php echo $row->lvalue;?> </td>
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
												<td align="center"><div style="align:center;"><textarea style="width:120px; height:55px;" readonly><?php echo $row->notes;?></textarea></div></td>
												
												<td>
												
												<div class="btn-group">

												<?php if ($row->is_finalised == 1) { ?>
												<button class="btn btn-info btn-large dropdown-toggle" onclick="Set_approve(<?php echo $row->id_quot;?>)"><b>Open File</b></button>&nbsp;&nbsp;&nbsp;
												<?php }else{ ?>
												<button class="btn btn-info btn-large dropdown-toggle" onclick="myFunction(<?php echo $row->id_quot;?>)"><b>View</b></button>&nbsp;&nbsp;&nbsp;
												<?php } ?>
												<button data-toggle="dropdown" class="btn btn-info btn-large dropdown-toggle"><span class="caret"></span></button>
												<ul class="dropdown-menu">
													<!-- <li><a href="#">Cancel</a></li> -->
												
												
											  	

												<!-- <button style="width:150px; align:left;" class="btn btn-info btn-mini" title="Detail Package" onclick="myFunction('<?php echo $row->id_quot;?>');"><div align="left"><i class="icon-folder-open"></i> <b>View</b></div></button>&nbsp;
												</br>
												</br> -->
												<?php foreach($sales->result() as $roa){ ?>
												<?php if($roa->id_quot==$row->id_quot){ ?>
													<button style="width:150px; align:left;" class="btn btn-info btn-mini" title="Detail Package" onclick="sales_contract('<?php echo $row->id_quot;?>');"><div align="left"><i class="icon-print"></i> <b>Sales Contract</b></div></button>&nbsp;
														</br>
												</br>
												<?php } ?>
												<?php } ?>		
												
												<?php 
												if($row->is_finalised==6 || $row->is_finalised==5){
												$coba 	= explode("/",$row->qout_id);
												$coba1 	= explode("/",$row->id_quot);
												?>	
										
												<div class="btn-group">
												<button style="width:150px; align:left;" data-toggle="dropdown" title="Order Form" class="btn btn-success btn-mini dropdown-toggle"><div align="left"><i class="icon-print"></i> <b>Print</b> <span class="caret"></span></div></button>
												<ul class="dropdown-menu" style="position: relative;">
											  	<li><a onclick="print_client('<?php echo $row->id_quot;?>');"><i class="icon-print"></i> Print Specification</a></li>
												<?php foreach($order->result() as $rowi){ ?>
												<?php
												if($rowi->quot_id==$row->id_quot){
													if($row->id_order_form!=""){
												?>
												<li><a onclick="print_orderform('<?php echo $row->id_quot;?>', '<?php echo $rowi->of_type;?>');" href=""><i class="icon-print"></i> <?php echo  str_pad($coba[0], 3, "0", STR_PAD_LEFT);?>/<?php if($rowi->of_type==1){echo "OPS";}else{echo "FIN";} ?>-<?php echo $coba[1] ;?>/<?php echo $coba[2] ;?>/<?php echo $coba[3] ;?></a></li>
												<?php
													}
												}
												?>
												<?php } ?>
												</ul>
												</div>&nbsp;
												<?php 
												}else{
												?>
												<!-- <button style="width:150px; align:left;" class="btn btn-info btn-mini" title="Detail Package" onclick="print_client('<?php echo $row->id_quot;?>');"><div align="left"><i class="icon-print"></i> <b>Print</b></div></button>&nbsp; -->

												<li><a href="#" onclick="print_client('<?php echo $row->id_quot;?>');">Print</a></li>

												<?php 
												}
												if($row->is_finalised==4 && $row->revised==0 && $row->sisa >= 1){
												?>
												</br></br><button style="width:150px;" class="btn btn-warning btn-mini" title="Update Package" onclick="myFunction_2('<?php echo $row->id_quot;?>');"><div align="left"><i class="icon-edit"></i> <b>Update</b></div></button>&nbsp;

												<li><a href="#" onclick="myFunction_2('<?php echo $row->id_quot;?>');">Update</a></li>

												<?php
												}
												?>
												
												<?php
												if($row->is_finalised==7 && $row->revised==0 && $row->sisa >= 1){
												?>
												<!-- </br></br><button style="width:150px;" class="btn btn-warning btn-mini" title="Update Package" onclick="myFunction_2('<?php echo $row->id_quot;?>');"><div align="left"><i class="icon-edit"></i> <b>Update</b></div></button>&nbsp; -->

												<li><a href="#" onclick="myFunction_2('<?php echo $row->id_quot;?>');">Update</a></li>

												<?php 
												}
												?>
												
												<?php 
												if($row->is_finalised==1){
												?>
												<!-- </br></br><button style="width:150px;" class="btn btn-danger btn-mini" title="Delete Package" onclick="myFunction_3('<?php echo $row->id_quot;?>');"><div align="left"><i class="icon-trash"></i> <b>Delete</b></div></button>&nbsp; -->
												
												<li><a href="#" onclick="myFunction_3('<?php echo $row->id_quot;?>');">Delete</a></li>

												<?php 
												}
												?>
												<?php 
												if($row->is_finalised==3){
												?>
												</br></br><button style="width:150px;" class="btn btn-success btn-mini" title="Posting Package" onclick="myFunction_app('<?php echo $row->id_quot;?>','<?php echo $row->qout_id;?><?php if($row->quot_revision>1){ echo "/Rev-".$row->quot_revision;} ?>');"><div align="left"><i class="icon-ok-circle"></i> <b>Approved by Client</b></div></button></br></br><button style="width:150px;" class="btn btn-danger btn-mini" title="Posting Package" onclick="myFunction_dec('<?php echo $row->id_quot;?>','<?php echo $row->qout_id;?><?php if($row->quot_revision>1){ echo "/Rev-".$row->quot_revision;} ?>');"><div align="left"><i class="icon-ban-circle"></i> <b>Declined by Client</b></div></button>
												
												<li><a href="#" onclick="myFunction_app('<?php echo $row->id_quot;?>','<?php echo $row->qout_id;?><?php if($row->quot_revision>1){ echo "/Rev-".$row->quot_revision;} ?>');">Approved by Client</a></li>
												<li><a href="#" onclick="myFunction_dec('<?php echo $row->id_quot;?>','<?php echo $row->qout_id;?><?php if($row->quot_revision>1){ echo "/Rev-".$row->quot_revision;} ?>');">Declined by Client</a></li>

												<?php 
												}
												?>
												<?php 
												if($row->is_finalised==6){
												?>
												<!-- </br></br><button style="width:150px;" class="btn btn-success btn-mini" title="Delete Package" onclick="posting('<?php echo $row->id_quot;?>', '<?php echo $row->qout_id;?><?php if($row->quot_revision>=1){ echo "/Rev-".$row->quot_revision;} ?>');"><div align="left"><i class="icon-envelope"></i> <b>Posting Package</b></div></button>&nbsp;
												 -->
												<li><a href="#" onclick="posting('<?php echo $row->id_quot;?>', '<?php echo $row->qout_id;?><?php if($row->quot_revision>=1){ echo "/Rev-".$row->quot_revision;} ?>');">Posting Package</a></li>

												<?php 
												}
												?>
												<!-- </br></br>
												<a href="<?php echo base_url();?>marketing/print_excel_client/<?php echo $row->id_quot;?>"><button style="width:150px; align:left;" class="btn btn-success btn-mini" title="Detail Package"><div align="left"><i class="icon-folder-open"></i> <b>Export Excel</b></div></button></a>&nbsp; -->

												<li><a href="<?php echo base_url();?>marketing/print_excel_client/<?php echo $row->id_quot;?>">Export Excel</a></li>


												</ul>
												</div>
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