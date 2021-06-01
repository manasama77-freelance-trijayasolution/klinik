					<script>
					function totalise(b_id){    
						var input   	= document.getElementById('input_2['+b_id+']').value;
						var qty 		= document.getElementById('input['+b_id+']').value;
						var jumlah 		= input * qty;
						var result 		= document.getElementById('amount['+b_id+']');
						result.value 	= jumlah;	
					}
					</script>
				   <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><b>Return Items</b></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                    <fieldset>
									<form class="form-horizontal" action="<?php echo base_url();?>inv/save_update_return" method="post" name="quesioner_mcu">
										<div class="row-fluid">
											<!-- block -->
											<?php
											include './design/koneksi/file.php';
											$query 		="SELECT id_retur dt FROM trx_item_return_h ORDER BY id_retur DESC LIMIT 1";  
											if($result 	=mysqli_query($con,$query))
											{
													//$date	=date('ym');
												$row 	=mysqli_fetch_assoc($result);
												$count 	=$row['dt'];
													//$counts	=substr($count, 1, strlen($count)-1);
													//$dater 	=$row['dt'];
													//if ($dater == $date) {
													$count = $count+1; 	
													//}else{
													//	$count = 1;
													//}
													
												$code_no = str_pad($count, 5, "0", STR_PAD_LEFT);
											}
											?>
											<div class="block">
												<div class="navbar navbar-inner block-header">
													<div class="muted pull-left"><b>Return of Goods</b></div>
												</div>
												<div class="block-content collapse in">
													<div class="span12">
													<div id="" style="overflow-y: auto; height:auto;">
<table class="table table-hover table-bordered" id="example3">	
<b>No. <?="RT/".date('Y')."/".date('m')."/".$code_no;?></b> 
<INPUT name="no_receive" type="hidden" value="<?="RT/".date('Y')."/".date('m')."/".$code_no;?>" style="width:85px"/>
<thead>
<tr>
	<th>No</th>
	<th>Product</th>
	<th>Date</th>
	<th>Amount</th>
	<th>Qty Order</th>
	<th>Received Item</th>
</tr>
</thead>					
<tbody>		
<?php
	$fisik=1;
	$exp=1;
	$doses=1;
	$suhu=1;

	$batch_date=1;
	$expired_date=1;
	$batch_code=1;
	$id_base=1;
	$i		=1;
	$amount	=1;
	$qty	=1;
	$input	=1;
	$inputt	=1;
	$inputtt=1;
	$total	=1;
	$totall	=1;
	$item_id=1;
	$amount_1	=1;
	$qty_1		=1;
	$input_1	=1;
	$dates	=1;
	$dates_1	=1;
	$id_detail_rcv	=1;
	$id_return_d	=1;
	$id_return_h	=1;

	$row_cnt = $list->num_rows();
?>
<?php
	foreach($list->result() as $row){
?>
<tr class="odd gradeX">
	<td><?=$i++;?></td>
	<td><u><b><?php echo $row->item_name;?></b></u></br></td>
	<td>
		<input class="input-xlarge datepicker" style="width: 80px;" id="[<?=$dates++;?>]" name="dates[<?=$dates_1++;?>]" value="<?php echo $row->return_date;?>" type="text"></td>		
	<td>
		<INPUT id="amount[<?=$amount++;?>]" name="amount[<?=$amount_1++;?>]" type="text" value="0" style="width:85px" readonly/> <?php echo $row->source;?></td>
	<td>
		<INPUT id="qty[<?=$qty++;?>]" name="qty[<?=$qty_1++;?>]" type="text" value="<?php echo $row->qty_rev;?>" style="width:35px" readonly/><?php echo $row->unit;?>
	</td>
	<td><INPUT id="input[<?=$input++;?>]" name="input[<?=$input_1++;?>]" type="number" onkeyup="totalise(<?=$total++;?>);" value="<?php echo $row->conv_factor;?>" style="width:45px" readonly/> <?php echo $row->source;?> - <INPUT id="input_2[<?=$inputt++;?>]" name="input_2[<?=$inputtt++;?>]" type="number" onkeyup="totalise(<?=$totall++;?>);" value="0" min="0" max="<?php echo $row->qty_rev;?>" style="width:45px"/> <?php echo $row->unit;?>
		<INPUT name="id_detail_rcv[<?=$id_detail_rcv++?>]" type="hidden"  style="width:45px" value="<?php echo $row->id_detail_rcv;?>"/>
		<INPUT name="id_return_d[<?=$id_return_d++?>]" type="hidden"  style="width:45px" value="<?php echo $row->id_return_d;?>"/>
	</td>
	<INPUT name="id_retur" type="hidden"  style="width:45px" value="<?php echo $row->id_retur;?>"/>
	<INPUT type="hidden" name="rowCount" value="<?php echo $row_cnt;?>"/>
	<INPUT name="sup" type="hidden" value="<?php echo $row->supplier_id;?>"/>
	<INPUT name="po_date" type="hidden" value="<?php echo $row->po_date;?>"/>
	<INPUT name="id_po" type="hidden" value="<?php echo $row->id_po;?>"/>
	<INPUT name="item_id[<?=$item_id++?>]" type="hidden" value="<?php echo $row->item_id;?>"/>
	<INPUT name="id_base_dest[<?=$id_base++?>]" type="hidden" value="<?php echo $row->id_dest;?>"/>
</tr>								
<?php
}
?>
</tbody>
</table>
														</div>
																<div class="span12">
											 					Comment :
																</div>
																<div class="span12">
											 					<textarea name="comment" id="comment" style="width: 950px; height: 100px;"><?php echo $row->return_remarks;?></textarea>
														</div>
													</div>
												</div>
											</div>
											<!-- /block -->
										</div>				
				
										<div id="myAlert" class="modal hide">
											<div class="modal-header">
												<button data-dismiss="modal" class="close" type="button">&times;</button>
												<h3>Check Again</h3>
											</div>
											<div class="modal-body">
												<p>Are You Sure ?</p>
											</div>
											<div class="modal-footer">
												<input type="submit" class="btn" value="Save" id="myText123" >
												<a data-dismiss="modal" class="btn" href="#">Cancel</a>
											</div>
										</div>
										
										<div class="form-actions">
										<a href="#myAlert" data-toggle="modal" class="btn btn-success">Save</a>
										<button class="btn btn-primary" type="reset">Reset</button>
											<div style="align:right; float:right;">
												<input style="width:15px; height:20px;" type="checkbox" id="optionsCheckbox" onClick="toggle(this)" name="complete" value="1"> <b><font color="red">Completed</font></b>
											</div>
                                        </div>
									<legend></legend>
									</form>
									</fieldset>                     						
                                </div>
                            </div>
                        </div>
                        <!-- /block -->	
		<!--/.fluid-container-->
		<script>
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

			$('.notification').click(function() {
				var $id = $(this).attr('id');
				switch($id) {
					case 'notification-sticky':
						$.jGrowl("Stick this!", { sticky: true });
					break;

					case 'notification-header':
						$.jGrowl("A message with a header", { header: 'Important' });
					break;

					default:
						$.jGrowl("Hello world!");
					break;
				}
			});
        });
        </script>
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