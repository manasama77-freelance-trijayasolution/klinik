				<?php
				$id = $this->uri->segment(3);
				// untuk alert delete
				if ($id=="ok"){
				?>
				    <div class="alert alert-success">
						 <button class="close" data-dismiss="alert">&times;</button>
						 <strong>Success!</strong> Delete Purchase Request
					</div>
				<?php
				}
				// untuk alert archived
				if ($id=="arc"){
				?>
				    <div class="alert alert-info">
						 <button class="close" data-dismiss="alert">&times;</button>
						 <strong>Success!</strong> archived 
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
				
				function myFunction_archive(id) {
					var r = confirm("Are You Sure ?");
					if (r == true) {
					x = window.location = "<?php echo base_url();?>inv/update_arc/"+id+"";
					} else {
					x = "You pressed Cancel!";
					}
				}
				
				</script>
				<script>	  
				function goBack(){
					window.history.back();
				}
				
				function myFunction_3(id) {
					var myWindow = window.open("<?php echo base_url();?>inv/print_received/"+id+"", "", "width=800px, height=400px");
				}
				
				function myFunction_4(id) {
					var myWindow = window.open("<?php echo base_url();?>inv/check_received/"+id+"", "", "width=1200px, height=600px, top=70, left=80");
				}
				
				function myFunction_5(id) {
					var myWindow = window.open("<?php echo base_url();?>inv/update_received/"+id+"", "", "width=1200px, height=400px, top=70, left=80");
				}

				function myFunction_6(id) {
					var myWindow = window.open("<?php echo base_url();?>inv/transmission_form/"+id+"", "", "width=800px, height=400px");
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
                                <div class="muted pull-left">Received Items </div>
                            </div>
							 <div class="form-actions">									 
							 <div class="btn-group">
							  <button data-toggle="dropdown" class="btn btn-info dropdown-toggle"><i class="icon-th"></i> Menu <span class="caret"></span></button>
							  <ul class="dropdown-menu">
								<li><a href="<?php echo base_url();?>inv/return_items/"><i class="icon-th-large"></i> Return Items</a></li>
								<li class="divider"></li>
								<li><a href="<?php echo base_url();?>inv/purchase_req" onclick="goBack()"><i class="icon-share-alt"></i> Back</a></li>
							  </ul>
							 </div>
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
                                                <th>PO Number</th>
												<th>Supplier</th>
                                                <th>Date</th>
												<th style="text-align: center;">Status</th>
												<th style="text-align: center;">Items</th>
												<th style="text-align: center;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
										$i=1;
										foreach($list->result() as $row){
										?>
                                            <tr class="odd gradeX">
												<td><?=$i++;?></td>
                                                <td><?=$row->po_no;?></td>
												<td><?=$row->supplier;?></td>
                                                <td><?=$row->po_date;?></td>
												<td style="text-align: center;"><?=$row->stsvalue;?></td>
												<td style="text-align: center;"><button class="btn btn-mini tooltip-left" data-html="true" data-original-title="<?=str_replace(";"," <br> ",$row->items);?>"><i class="icon-search"></i><b> <?=$row->qty;?> Items </b></button></td>
												<td style="text-align: center;">
													<?php if ($row->status == 0){ ?>
														<button title="Checklist Received Items" onclick="myFunction_4(<?=$row->id_po;?>)" class="btn btn-info btn-mini"><i class="icon-list"></i></button> 
													<?php } if ($row->status == 3){?>
														<button title="Update Received Items" onclick="myFunction_5(<?=$row->id_po;?>)" class="btn btn-warning btn-mini"><i class="icon-pencil"></i></button> 
													<?php } if ($row->status == 4){ ?>
														<button title="Archive Items" onclick="myFunction_archive(<?=$row->id_po;?>)" class="btn btn-success btn-mini"><i class="icon-folder-open"></i></button>
													<?php } ?>
														<button title="Print Received Items" class="btn btn-mini" onclick="myFunction_3(<?=$row->id_po;?>)"> <i class="icon-print"></i></button> 
														<button title="Print Transmission Form" class="btn btn-info btn-mini" onclick="myFunction_6(<?=$row->id_po;?>)"> <i class="icon-retweet"></i></button> 
													<?php if ($row->is_completed != 1){?>  
														<button disabled onclick="myFunction(<?=$row->id_po;?>);"   class="btn btn-danger btn-mini"><i class="icon-trash"></i></button>
													<?php } ?>
												<div style="font-size: 0.0001em; display: none;"><?=str_replace(";",",",$row->items);?></div></td>
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
  
     
	 <link href="<?php echo base_url();?>design/vendors/datepicker.css" rel="stylesheet" media="screen">
    <link href="<?php echo base_url();?>design/vendors/uniform.default.css" rel="stylesheet" media="screen">
    <link href="<?php echo base_url();?>design/vendors/chosen.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo base_url();?>design/vendors/wysiwyg/bootstrap-wysihtml5.css" rel="stylesheet" media="screen">
    <script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>
    <script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>design/vendors/jquery.uniform.min.js"></script>
    <script src="<?php echo base_url();?>design/vendors/chosen.jquery.min.js"></script>
    <script src="<?php echo base_url();?>design/vendors/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url();?>design/vendors/wysiwyg/wysihtml5-0.3.0.js"></script>
    <script src="<?php echo base_url();?>design/vendors/wysiwyg/bootstrap-wysihtml5.js"></script>
    <script src="<?php echo base_url();?>design/vendors/wizard/jquery.bootstrap.wizard.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>design/vendors/jquery-validation/dist/jquery.validate.min.js"></script>
	<script src="<?php echo base_url();?>design/assets/form-validation.js"></script>
	<script src="<?php echo base_url();?>design/assets/scripts.js"></script>
	<script src="<?php echo base_url();?>design/vendors/jGrowl/jquery.jgrowl.js"></script>
		<link href="<?php echo base_url();?>design/vendors/jGrowl/jquery.jgrowl.css" rel="stylesheet" media="screen">
	<script>
	jQuery(document).ready(function() {   
	   FormValidation.init();
	});
        $(function() {
            $(".datepicker").datepicker();
            $(".uniform_on").uniform();
            $(".chzn-select").chosen();
            $('.textarea').wysihtml5();

            $('#rootwizard').bootstrapWizard({onTabShow: function(tab, navigation, index) {
                var $total = navigation.find('li').length;
                var $current = index+1;
                var $percent = ($current/$total) * 100;
                $('#rootwizard').find('.bar').css({width:$percent+'%'});
                // If it's the last tab then hide the last button and show the finish instead
                if($current >= $total) {
                    $('#rootwizard').find('.pager .next').hide();
                    $('#rootwizard').find('.pager .finish').show();
                    $('#rootwizard').find('.pager .finish').removeClass('disabled');
                } else {
                    $('#rootwizard').find('.pager .next').show();
                    $('#rootwizard').find('.pager .finish').hide();
                }
            }});
            $('#rootwizard .finish').click(function() {
                alert('Finished!, Starting over!');
                $('#rootwizard').find("a[href*='tab1']").trigger('click');
            });
        });
    </script>
    <script>
        $(function() {
			$('.tooltip').tooltip();	
			$('.tooltip-left').tooltip({ placement: 'left' });	
			$('.tooltip-right').tooltip({ placement: 'right' });	
			$('.tooltip-top').tooltip({ placement: 'top' });	
			$('.tooltip-bottom').tooltip({ placement: 'bottom' });

			$('.notification').ready(function() {
				var $id = $(this).attr('id');
				switch($id) {
					case 'notification-sticky':
						$.jGrowl("<span class='label' data-original-title='You'><i class='icon-lock' ></i></span> You had locked input :</br></br>Patient Name</br>", { sticky: true });
					break;

					case 'notification-header':
						$.jGrowl("A message with a header", { header: 'Important' });
					break;

					default:
						$.jGrowl("<span class='label' data-original-title='You'><i class='icon-lock' ></i></span>  WARNING :</br></br>please contact the admin if you want to reset this billing</br>");
						<?php
					if ($disave == "disabled") {
					?>
						$.jGrowl("<span class='label' data-original-title='You'><i class='icon-lock' ></i></span> WARNING :</br></br>one of item does not have a price, please contact the admin or finance</br>", { sticky: true });
					<?php } ?>
					break;
				}
			});
        });
    </script>
</html>