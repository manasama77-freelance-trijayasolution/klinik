<?php 
foreach($header->result() as $rowh){}
$jml_from = $detail->num_rows();
?>
                    <!-- morris stacked chart -->
                    <div class="row-fluid notification" id="notification-sticky">
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><b>Transfer Items</b></div>
                            <!-- <div class="muted pull-right" id="txt" style="font-weight: bold;"></div> -->
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                	<form class="form-horizontal" name="uguu" id="uguu" onsubmit="return confirm('Do you really want to submit the form?');" method="post" action="<?php echo base_url();?>inv/save_trf_item_app" >
                                    <fieldset>
									<!-- <div class="form-horizontal" > -->
									  <!-- BAGIAN KIRI -->
									  <div style="width:50%; float:left;">
  										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Request From </label>
                                          <div class="controls">
                                            <input name="id_mi_no" id="id_mi_no" value="<?=$rowh->id_mi_no;?>" type="hidden" >
                                            <input name="jml_from" id="jml_from" value="<?=$jml_from;?>" type="hidden" >
                                            <input class="input-xlarge focused" name="nomorreg" value="<?=$rowh->fullname;?>" type="text" maxlength="0" autocomplete="off"  readonly>
										  </div>
                                        </div>
										
  										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Number </label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="nomorreg" value="<?=$rowh->mi_no;?>" type="text" maxlength="0" autocomplete="off"  readonly>
										  </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Date</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="pat_name" value="<?php echo date("d.m.Y",strtotime($rowh->mi_date));?>" type="text" id="myText02" readonly autocomplete="off" required>
                                          </div>
                                        </div>
										
									  </div>
									  <!-- BAGIAN KANAN -->
									  <div style="width:50%; float:right;">
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">From Warehouse</label>
                                          <div class="controls">
                                            <input name="from_wh" id="from_wh" value="<?=$rowh->from_wh;?>" type="hidden" >
											<input class="input-xlarge focused" name="age" value="<?=$rowh->dari_gud;?>" type="text" id="" readonly autocomplete="off" required> 	
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">To Warehouse</label>
                                          <div class="controls">
                                            <input name="to_wh" id="to_wh" value="<?=$rowh->to_wh;?>" type="hidden" >
											<input class="input-xlarge focused" name="age" value="<?=$rowh->ke_gud;?>" type="text" id="" readonly autocomplete="off" required> 	
                                          </div>
                                        </div>

						  				</div>
										<legend></legend>
										</div>

				    
			              
			           

			            <table class="table table-hover" id="jengkol">
			            <thead>
			            <tr>
			              <th>Number</th>
			              <th>Name</th>
			              <th>Stock</th>
			              <th>Qty</th>
			            </tr>
			            </thead>          
			            <tbody>   
			            <?php 
			            $nomor = 1;
			            foreach($detail->result() as $rowd){ 
			            ?>
			            <tr>
			              <td><?php echo $nomor++;?></td>
			              <td><?=$rowd->item_product;?></td>
			              <td><?=$rowd->stock;?></td>
			              <td>
			              		<?=$rowd->item_qty;?> 
			              		<input name="jumlah[]" id="jumlah" value="<?=$rowd->item_qty;?>" type="hidden" >
			              		<input name="id_item[]" id="id_item" value="<?=$rowd->id_item;?>" type="hidden" >
			              		<input name="sisa[]" id="sisa" value="<?=$rowd->sisa;?>" type="hidden" >
			              		<input name="id_wh[]" id="id_wh" value="<?=$rowd->id_wh;?>" type="hidden" >
			              		<input name="id_mi_d[]" id="id_mi_d" value="<?=$rowd->id_mi_d;?>" type="hidden" > 
			              </td>
			            </tr> 
			            <?php } ?>

			            </tbody>
			            </table>
			            

			            <!-- TUTUP -->



				<div class="form-actions">
				<div style="float:left;">
				<button type="submit" class="btn btn-success" name="simpan" id="terima" value="1" />Approve</button>
				</div>
				<div style="float:right;">
				<button type="submit" class="btn btn-danger" name="simpan" id="tolak" value="0" />Reject</button>
				</div>
                
                </div>


        	</form>

				
  
</div>
  

										

										<legend></legend>
									</fieldset>     
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
		<!--/.fluid-container-->
       
     
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