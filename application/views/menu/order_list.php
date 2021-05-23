				<div  id="content">
				<script>
				function myFunction_1(id) {
					var myWindow = window.open("<?php echo base_url();?>docter/print_list_order/"+id+"","Popup", "width=750, height=700, top=0, left=320");
				}
				function myFunction_2(id) {
					var myWindow = window.open("<?php echo base_url();?>docter/view_list_order/"+id+"", "", "width=1000, height=700");
				}
				</script>
				<script> 
				$(function() {
				$( "#datepicker1" ).datepicker({				
					changeMonth: true,				
					changeYear: true,				
				dateFormat: "yy-mm-dd", 				
				timeFormat: "HH:mm:ss"				
				});				
				});
				</script>								        
				<div class="row-fluid">                        <!-- block -->                        
				<div class="block">                            
				<div class="navbar navbar-inner block-header">                               
				<div class="muted pull-left"><b>Doctor Order List</b></div> 
				<div class="muted pull-right"><b>Manual Book : <a href="https://www.yumpu.com/id/embed/view/PWNcg1kzmLE9x8Ge" target="_blank">Click Here</a></b></div>				
				</div>                            
				<div class="block-content collapse in">      
								<div class="span12">         
                                 <div class="table-toolbar">
                                      <div class="btn-group pull-right">
                                         <button data-toggle="dropdown" class="btn dropdown-toggle"><i class="icon-th"></i> Tools <span class="caret"></span></button>
                                         <ul class="dropdown-menu">
											<li><a href="<?php echo base_url();?>docter/doctor_order_list_excel"><i class="icon-list-alt"></i> Export to Excel</a></li>
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
				<th>No.</th>
				<th>ID REG</th>             
				<th>Order Date</th>						
				<th>Patient Name</th>		
				<th>Company Name</th>					
				<th>Action</th>                                            
				</tr>                                     
				</thead>                                   
				<tbody>										
				<?php $a=1;	foreach($data->result() as $row){ ?>                                           
				<tr class="odd gradeX">   
				<td><?php echo $a++;?></td>  				
				<td><?php echo $row->id_reg;?></td>  
				<td><?php echo $row->order_date;?></td>					
				<td><?php echo $row->pat_name;?></td>	
				<td><?php echo $row->client_name;?></td>															
				<td>												
				<div class="btn-group">												
				<button class="btn btn-info" onclick="myFunction_1('<?php echo $row->id_reg;?>')"><b>View Data</b></button>												
				</div>
				</td>                                           
				</tr>										
				<?php	} ?>                                        
				</tbody>                                   
				</table>							
				</div>                            
				</div>                        
				</div>                        <!-- /block -->                
				</div>				
				<script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>				
				<script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>				
				<script src="<?php echo base_url();?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>				
				<link href="<?php echo base_url();?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">				
				<script src="<?php echo base_url();?>design/assets/scripts.js"></script>				
				<script src="<?php echo base_url();?>design/assets/DT_bootstrap.js"></script>