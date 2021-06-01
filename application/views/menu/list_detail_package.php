	<?php
		$id = $this->uri->segment(3);
	?>
	<script>
	  function undisableTxt(){
		  if (0 == <?=$id;?>) {
		window.location.href = "<?php echo base_url();?>inv/inv_item";
		};
		    
		<?php
			$x = 1; 
			while($x <= 13) {
			echo "document.getElementById('".$x."').disabled = false;";
			$x++;
			}	
		?>
	  }
	  
	  function goBack(){
	  	window.history.back();
	  }
	</script>
	<script type="text/javascript" src="http://rawgit.com/BobKnothe/autoNumeric/master/autoNumeric.js"></script>
	<script type="text/javascript">
	jQuery(function($) {
		$('.input-xlarge-i').autoNumeric('init');
	});
	</script>
	
                    <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block --> 
                       
					<div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><b>My Quotation File</b></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                   <!--<div class="table-toolbar">
                                       <div class="btn-group pull-right">
                                         <button data-toggle="dropdown" class="btn dropdown-toggle"><i class="icon-file"></i> Export Data <span class="caret"></span></button>
                                         <ul class="dropdown-menu">
											<li><a href="<?php echo base_url();?>radiology/radiology_job/1">Excel</a></li>
                                         </ul>
                                      </div>
									  </br>
									  </br>
                                   </div>  -->
								   <div id="" style="overflow-y: auto; height:auto;">
                                   <table class="table table-hover">
                                        <thead>
											<tr>
												<th>No</th>
												<th>Group Name</th>
												<th>Services</th>
												<th>Price</th>
											</tr>
										</thead>
										<tbody>
										<?php
										$x=1;
										$i=1;
										$jumlah = 0;
										$current_cat = null;
										$count = $data->num_rows();
										// echo $count;
										?>
										<?php
										foreach($data->result() as $row){
											$jumlah = $jumlah + $row->price
										?>
											<tr>
											<td><?=$i++;?></td>
												<?php
												if ($row->group_name != $current_cat){
												$current_cat = $row->group_name;
												echo "<td valign='top'><b><u>". $current_cat . "</u></b></td>";
												}else{
												?>	
												<td></td>
												<?php
												}
												?>
												<td><?php echo $row->service_name;?></td>
												<td><div align="right"><?php echo number_format($row->price,2);?></div></td>
										
											</tr>
										<?php
										}
										?>
											<tr class="odd gradeX">
												<td  colspan="3"><b>Cost</b></td>
												<td><div align="right"><?php echo number_format($row->amount_total,2); ?></div></td>
											</tr>
											<tr class="odd gradeX">
												<td  colspan="3"><b>Margin</b></td>
												<td><div align="right"><?php echo $row->persen_margin; ?>% &nbsp;&nbsp;<?php echo number_format($row->adjust,2); ?></div></td>
											</tr>
											<tr class="odd gradeX">
												<td  colspan="3"><b>Sell Price</b></td>
												<td><div align="right"><?php echo number_format($row->sell_price,2); ?></div></td>
											</tr>
											<tr class="odd gradeX">
												<td  colspan="3"><b>Estimate Gross Income</b></td>
												<td><div align="right"><?php echo number_format($row->grand_total,2); ?></div></td>
											</tr>
                                        </tbody>
                                   </table>
								   </div>
								      
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
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
	<script src="<?php echo base_url();?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>
	<link href="<?php echo base_url();?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
	<script src="<?php echo base_url();?>design/assets/DT_bootstrap.js"></script>
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
</html>