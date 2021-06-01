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
	<style>
	@media print {
    .myDivToPrint {
        background-color: white;
        height: 100%;
        width: 96%;
        position: fixed;
        top: 30px;
        left: 0;
        margin: 12px;
        padding: 8px;
        font-size: 14px;
        line-height: 16px;
		.table-hover{
				width: 50%;
			}
		}
	}
	</style>
	<body onload="startTime()">
	<div class="myDivToPrint" style="align:center;">
                    <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block --> 
                      	<?php
							foreach($print_h->result() as $rows){}
						?> 
					<div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><b>e-Quotation | <?=$rows->fullname?> </b></div>
								<div class="muted pull-right" id="txt" style="font-weight: bold;"></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                   <div class="table-toolbar">
								   <hr>
								   <table border="0">
									<tr>
										<td style="padding: 5px;" width="20%">No. Quotation</td>
										<td style="padding: 5px;" width="40%">: <?=$rows->qout_id?><?php if($rows->quot_revision>=1){ echo "/Rev-".$rows->quot_revision;} ?></td>
										<td align="right" width="50%" rowspan="6"><img src="https://chart.googleapis.com/chart?chs=100x100&cht=qr&chl=<?=$rows->qout_id?><?php if($rows->quot_revision>=1){ echo "/Rev-".$rows->quot_revision;} ?>&choe=UTF-8" title="Kyoai Medical Services" /></td>
									</tr>
									<tr>
										<td style="padding: 5px;">Package Name</td>
										<td style="padding: 5px;">: <?=$rows->quot_name?></td>
									</tr>
									<tr>
										<td style="padding: 5px;">Company</td>
										<td style="padding: 5px;">: <?=$rows->client_name?></td>
									</tr>
									<tr>
										<td style="padding: 5px;">Package Valid</td>
										<td style="padding: 5px;">: <b><?=date("d M Y",strtotime($rows->quot_date_valid))?></b></td>
									</tr>
									<tr>
										<td style="padding: 5px;">Package Expired</td>
										<td style="padding: 5px;">: <b><?=date("d M Y",strtotime($rows->quot_date_end))?></b></td>
									</tr>
									<tr>
										<td style="padding: 5px;">Quantity Estimate</td>
										<td style="padding: 5px;">: <?=$rows->qty_estimate?> <i class="icon-user"></i> <b>Pax</b></td>
									</tr>
								   </table>
								   <hr>	
                                   </div> 
								   <div id="" style="overflow-y: auto; height:auto;">
                                   <table class="table table-hover" style="width:100%;">
                                        <thead>
											<tr>
												<th>No</th>
												<th>Group Name</th>
												<th>Services</th>
												<th><div align="right">Price</div></th>
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
											$jumlah = $jumlah + $row->service_price
										?>
											<tr>
											<td valign="top"><?=$i++;?></td>
												<?php
												if ($row->group_desc != $current_cat){
												$current_cat = $row->group_desc;
												echo "<td valign='top'><b><u>". $current_cat . "</u></b></td>";
												}else{
												?>	
												<td></td>
												<?php
												}
												?>
												<td><?php echo $row->serv_name;?> <!--<hr><b>Notes :</b></br> <i><?php echo $row->notes_service;?></i> <hr>--><div style="float:left"><?php if($row->service_tax !=0){ echo "<font size='2mm'><i>Tax ".$row->service_tax."% </br>before tax ".number_format(intval($row->before_tax),2)."</i></font>"; };?></div></td>
												<td><div style="float:left"><b>Rp. </div> <div style="float:right"><?php echo number_format($row->service_price,2);?></b></div></td>						
											</tr>
										<?php
										}
										?>
											<tr class="success">
												<td  colspan="3"><b>Cost</b></td>
												<td><div style="float:left"><b>Rp. </div><div align="right"><?php echo number_format($row->total_price,2); ?></b></div></td>
											</tr>
											<tr class="info">
												<td  colspan="3"><b>Margin</b></td>
												<td><div align="right"><b><?php echo $row->margin; ?>%</b> ~ <?php echo number_format($row->margin_amount,2); ?></div></td>
											</tr>
											<tr class="success">
												<td  colspan="3"><b>Sell Price</b></td>
												<td><div style="float:left"><b>Rp. </div> <div align="right"><?php echo number_format($row->grand_price,2); ?></b></div></td>
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
                        <!-- /block -->
	</body>
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