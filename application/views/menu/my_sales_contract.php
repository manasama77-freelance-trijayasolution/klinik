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
				function goBack(){
					window.history.back();
				}
				
				function print_client(id) {
					var myWindow = window.open("<?php echo base_url();?>marketing/print_client/"+id+"", "", "width=845px, height=650px");
				}
				
				function sales_contract(id) {
					var myWindow = window.open("<?php echo base_url();?>marketing/sales_contract_print/"+id+"", "", "width=845px, height=650px");
				}
				
				function update_sales_contract(id) {
					var myWindow = window.open("<?php echo base_url();?>marketing/update_sales_contract/"+id+"", "", "width=1215px, height=650px");
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
					var person = prompt("Notes for Approved by Client");
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
				</script>
                     <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><b>My Sales Contract</b></div>
                            </div>
							 <div class="form-actions">	
								<div class="btn-group">
								<button data-toggle="dropdown" class="btn btn-info btn-large dropdown-toggle"><b>Menu</b> <span class="caret"></span></button>
								<ul class="dropdown-menu">
								<li><a href="<?php echo base_url();?>marketing/quotation"><i class="icon-plus"></i> Add Quotation</a></li>
								<li><a href="<?php echo base_url();?>marketing/order_form"><i class="icon-plus"></i> Add Order Form</a></li>
								<li><a href="<?php echo base_url();?>marketing/sales_contract"><i class="icon-plus"></i> Add Sales Contract</a></li>
								<li class="divider"></li>
								<li><a href="<?php echo base_url();?>marketing/list_quotation"><i class="icon-file"></i> My Quotation</a></li>
								<li><a href="<?php echo base_url();?>marketing/order_form"><i class="icon-file"></i> My Order Form</a></li>
								<li><a href="<?php echo base_url();?>marketing/my_sales_contract"><i class="icon-file"></i> My Sales Contract</a></li>
								</ul>
								</div>
							 </div>
                            <div class="block-content collapse in">
       
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
								   <div style="overflow-y: auto; height:auto; position: relative;">
								   
                                   <table cellpadding="0" cellspacing="0" border="0" class="table table-hover table-bordered" id="example2" style="font-size: 13px;font-weight: normal;">
                                        <thead>
                                            <tr>
												<th>No</th>
												<th>No Contract</th>
												<th>Company Name</th>
												<th>Create Date</th>
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
										
										function romanic_number($integer, $upcase = true) 
										{ 
											$table = array('M'=>1000, 'CM'=>900, 'D'=>500, 'CD'=>400, 'C'=>100, 'XC'=>90, 'L'=>50, 'XL'=>40, 'X'=>10, 'IX'=>9, 'V'=>5, 'IV'=>4, 'I'=>1); 
											$return = ''; 
											while($integer > 0) 
											{ 
												foreach($table as $rom=>$arb) 
												{ 
													if($integer >= $arb) 
													{ 
														$integer -= $arb; 
														$return .= $rom; 
														break; 
													} 
												} 
											} 
											return $return; 
										} 
										
										foreach($list->result() as $row){


										?>
										   <input type="hidden" id="pesan" name="notes">
										   <input type="hidden" id="angka" name="angka">
										   <input type="hidden" id="pesan" name="idx" value="<?=$row->id_quot?>">
                                           <tr class="">
												<td><?=$i++;?></td>
												<td><?php echo str_pad($row->id_sc, 3, "0", STR_PAD_LEFT);?>/SC/<?=romanic_number(date("m",strtotime($row->created_date)));?>/<?=date("Y",strtotime($row->created_date));?><hr><i><?php echo date("d M Y",strtotime($row->created_date));?>, <?php echo time_elapsed_string45($row->created_date);?></i></td>
												<td><?php echo $row->client_name;?></td>
												<td><?=$row->created_date?></td>
												<td><button style="width:150px; align:left;" class="btn btn-success btn-mini" title="Detail Package" onclick="sales_contract('<?php echo $row->id_quot;?>');"><div align="left"><i class="icon-print"></i> <b>Sales Contract</b></div></button></br><button style="width:150px; align:left;" class="btn btn-warning btn-mini" title="Detail Package" onclick="update_sales_contract('<?php echo $row->id_sc;?>');"><div align="left"><i class="icon-edit"></i> <b>Update Sales Contract</b></div></button></td>	
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