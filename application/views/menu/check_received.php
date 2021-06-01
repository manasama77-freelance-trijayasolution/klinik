					<script>
					function totalise(b_id){    
						var sum 		= 0;
						var sumtothrg 	= document.getElementById('sumtothrg');
						var rowCount 	= document.getElementById('rowCount').value;
						var item_price 	= document.getElementById('item_price['+b_id+']').value;
						var item_disc 	= document.getElementById('item_disc['+b_id+']').value;
						var totalhrg 	= document.getElementById('totalhrg['+b_id+']');
						var input   	= document.getElementById('input_2['+b_id+']').value;
						var qty 		= document.getElementById('input['+b_id+']').value;
						var jumlah 		= input * qty;
						var result 		= document.getElementById('amount['+b_id+']');
						result.value 	= jumlah;	
						totalhrg.value	= (item_price - item_disc) * input;

						for (var i = 1; i <= rowCount; i++){
							sum += parseFloat(document.getElementById('totalhrg['+i+']').value);
						}

						sumtothrg.value = sum;
					}
					</script>
					<script>
						function myFunction(val) {
						    var qty 	= document.getElementById('qty['+val+']').value;
						   	//alert(qty);
						    document.forms['quesioner_mcu'].elements['input_2['+val+']'].value=qty; 
						    var input   	= document.getElementById('input_2['+val+']').value;
							var qty 		= document.getElementById('input['+val+']').value;
							var jumlah 		= input * qty;
							var result 		= document.getElementById('amount['+val+']');
							result.value 	= jumlah;

							document.getElementById('input_2['+val+']').readOnly = true;

							 $('#myCheck'+val+'').click(function(){
								    if (this.checked) {
										document.getElementById('input_2['+val+']').readOnly = true;
								    }else{
								    	document.getElementById('input_2['+val+']').readOnly = false;
								    }
								})
						}

						 function toggle(source) {
						  checkboxes = document.getElementsByName('foo');
						  var val=1;
						  for(var i=0, n=checkboxes.length;i<n;i++) {
						    checkboxes[i].checked = source.checked;
						   	// alert(val);

						   	var qty 	= document.getElementById('qty['+val+']').value;
						   	//alert(qty);
						    document.forms['quesioner_mcu'].elements['input_2['+val+']'].value=qty; 
						    var input   	= document.getElementById('input_2['+val+']').value;
							var qty 		= document.getElementById('input['+val+']').value;
							var jumlah 		= input * qty;
							var result 		= document.getElementById('amount['+val+']');
							result.value 	= jumlah;
							document.getElementById('input_2['+val+']').readOnly = true;
						   	val++;
						  }
						}
					</script>
					<!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><b>Checklist items</b></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                    <fieldset>
									<form class="form-horizontal" action="<?php echo base_url();?>inv/save_received" method="post" name="quesioner_mcu">
										<div class="row-fluid">
											<!-- block -->
											<?php
											include './design/koneksi/file.php';
											$query 		="SELECT id_receive_h dt FROM trx_item_receive_h ORDER BY id_receive_h DESC LIMIT 1";  
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
													<div class="muted pull-left"><b>Receipt of Goods</b></div>
												</div>
												<div class="block-content collapse in">
													<div class="span12">
													<div id="" style="overflow-y: auto; height:auto;">
<?php 
foreach($header->result() as $row_header){
	$wkt 	= $row_header->term_payment;
	$date 	= $row_header->po_date;
	$tempo	= date('Y-m-d', strtotime($date. ' + '.$wkt.' days'));
	// $tempo	= date('d-m-Y', strtotime($date. ' + '.$wkt.' days'));
}
?>													
<table class="table table-hover table-bordered" id="example3">	
<b>No.</b> <input name="no_receive" type="text" value="PJV-<?=$code_no;?>" style="width:85px"/>
<input name="term" type="hidden" value="<?=$tempo;?>" />
<thead>
<tr>
	<th>No</th>
	<th>Product</th>
	<th style="text-align: center;">Inspection</th>
	<th>Amount</th>
	<th>Qty Purchase Order</th>
	<th>Received Item</th>
	<!-- <th><input style="width:20px; height:20px;" type="checkbox" id="optionsCheckbox" onClick="toggle(this)" name="complete" value="1"> </th> -->
</tr>
</thead>					
<tbody>		
	<?php
	$fisik=1;$exp=1;$doses=1;$suhu=1;$batch_date=1;$expired_date=1;$batch_code=1;$id_base=1;$i=1;$amount=1;$qty=1;$input=1;$inputt=1;$inputtt=1;$total=1;$totall=1;$item_id=1;$amount_1=1;$qty_1=1;$input_1=1;$cek=1;$xxx=1;$ooo=1;$ddd=1;$hrg=1;$hrg2=1;
	$row_cnt = $detail->num_rows();

	foreach($detail->result() as $row){
?>

<tr class="odd gradeX">
	<td><?=$i++;?></td>
	<td><i><?php echo $row->item_name;?></i><hr>*<INPUT maxlength="10" name="batch_date[<?=$batch_date++;?>]" type="text" placeholder="Batch Date" style="width:85px"/> <span class="badge badge-important"><font size="1.5pt">YYYY - MM - DD</font></span></br></br>*<INPUT maxlength="10" name="expired_date[<?=$expired_date++;?>]" type="text" placeholder="Expired Date" style="width:85px"/> <span class="badge badge-important"><font size="1pt">YYYY - MM - DD</font></span></br></br>*<INPUT name="batch_code[<?=$batch_code++;?>]" type="text" placeholder="Batch Code" style="width:185px"/>
	</td>
	<td>
		<table style="margin:auto;border:solid; width:40%">
			<tr>
				<td><span class="btn btn-inverse btn-mini popover-top" data-original-title="Kondisi Fisik" class="badge badge-inverse">A</span></td>
				<td><span class="btn btn-inverse btn-mini popover-top" data-original-title="Tanggal Kadaluarsa" class="badge badge-inverse">B</span></td>
				<td><span class="btn btn-inverse btn-mini popover-top" data-original-title="Dosis" class="badge badge-inverse">C</span></td>
				<td><span class="btn btn-inverse btn-mini popover-top" data-original-title="Suhu Peyimpanan" class="badge badge-inverse">D</span></td>
			</tr> 
			<tr>
				<td style="text-align: center;"><input style="width:20px; height:20px;" type="checkbox" id="optionsCheckbox" name="a[<?=$fisik++;?>]" value="1"></td>
				<td style="text-align: center;"><input style="width:20px; height:20px;" type="checkbox" name="b[<?=$exp++;?>]" id="optionsCheckbox" value="1"></td>
				<td style="text-align: center;"><input style="width:20px; height:20px;" type="checkbox" id="optionsCheckbox" name="c[<?=$doses++;?>]" value="1"></td>
				<td style="text-align: center;"><input style="width:20px; height:20px;" type="checkbox" id="optionsCheckbox" name="d[<?=$suhu++;?>]" value="1"></td>
			</tr>
		</table>
	</td>
	<td>
		<input id="amount[<?=$amount++;?>]" name="amount[<?=$amount_1++;?>]" type="text" value="0" style="width:35px" readonly/> <?php echo $row->source;?><hr>*<font style="font-size: 0.9em; color:green;"><i>Conversion Factor</i> [<?php echo $row->conv_factor;?>]</font>
	</td>
	<td>
		<input id="qty[<?=$qty++;?>]" name="qty[<?=$qty_1++;?>]" type="text" value="<?php echo $row->qty;?>" style="width:35px" readonly/> <b><?php echo $row->unit;?></b>
		<input id="item_price[<?=$hrg;?>]" name="item_price[<?=$hrg;?>]" type="hidden" value="<?php echo $row->item_price;?>" /> 
		<input id="item_disc[<?=$hrg;?>]" name="item_disc[<?=$hrg;?>]" type="hidden" value="<?php echo $row->item_disc;?>" /> 
		<input id="totalhrg[<?=$hrg;?>]" name="totalhrg[<?=$hrg++;?>]" type="hidden" value="0" /> 
	</td>
	<td>
		<input id="input[<?=$input++;?>]" name="input[<?=$input_1++;?>]" type="hidden" onkeyup="totalise(<?=$total++;?>);" 	value="<?php echo $row->conv_factor;?>" style="width:45px" readonly/><input id="input_2[<?=$inputt++;?>]" name="input_2[<?=$inputtt++;?>]" type="number" step="any" max="<?php echo $row->qty;?>" onkeyup="totalise(<?=$totall++;?>);" value="0" style="width:45px"/> <b><?php echo $row->unit;?></b>
	</td>
<!--	
	<td>
		<input type="checkbox" id="myCheck<?=$cek++;?>" name="foo" value="<?php echo $row->qty;?>" onclick="myFunction(<?=$ddd++;?>);" style="width:20px; height:20px;">
	</td>
-->
	
	<input type="hidden" name="rowCount" id="rowCount" value="<?php echo $row_cnt;?>"/>
	<input name="sup" type="hidden" value="<?php echo $row->supplier_id;?>"/>
	<input name="supp_name" type="hidden" value="<?php echo $row->supp_name;?>"/>
	<input name="po_date" type="hidden" value="<?php echo $row->po_date;?>"/>
	<input name="id_po" type="hidden" value="<?php echo $row->id_po;?>"/>
	<input name="item_id[<?=$item_id++?>]" type="hidden" value="<?php echo $row->item_id;?>"/>
	<input name="id_base_dest[<?=$id_base++?>]" type="hidden" value="<?php echo $row->id_dest;?>"/>
</tr>								
<?php
	}
?>
	<input type="text" style="display:none;" name="sumtothrg" id="sumtothrg" value="0"/>
</tbody>
</table>
														</div>
													</div>
												</div>
											</div>
											<!-- /block -->
										</div>				
				
										<div id="myAlert" class="modal hide">
											<div class="modal-header">
												<button data-dismiss="modal" class="close" type="button">&times;</button>
												<h5>Alert!</h5>
											</div>
											<div class="modal-body">
												<p>Are you sure ? [close] button to check again...</p>
											</div>
											<div class="modal-footer">
												<input type="submit" class="btn btn-success" onclick="this.disabled=true;this.form.submit();" value="Save">
												<a data-dismiss="modal" class="btn btn-warning" href="#">Close</a>
											</div>
										</div>
										
										<div class="form-actions">
										<a href="#myAlert" data-toggle="modal" class="btn btn-success">Submit</a>
										<button class="btn btn-warning" type="reset">Reset</button>
											<div style="align:right; float:right;">
												<input type="checkbox" id="habis" name="habis" style="width:20px; height:20px;">
												 <b><font color="red">Completed</font></b>
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
        <script src="<?php echo base_url();?>vendors/jGrowl/jquery.jgrowl.js"></script>
        <script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>
		<link href="<?php echo base_url();?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
        <script src="<?php echo base_url();?>design/assets/scripts.js"></script>
        <script src="<?php echo base_url();?>design/assets/DT_bootstrap.js"></script>
</html>