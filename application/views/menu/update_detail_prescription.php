					<script src="<?php echo base_url();?>design/assets/acc.js"></script>
					<script>	     
					    function popup_r(b_id,jml){
					      	var drug_id = document.getElementById('drug_id'+b_id+'').value;
					        window.open("<?php echo base_url();?>Pharmacy/find_werehouse_list/"+b_id+"/"+drug_id+"/"+jml+"","Popup","height=550, width=880, top=70, left=180 ");
					    }

					    function loadgrandtotal(tableID){
							var table 		= document.getElementById(tableID);
				            var rowCount 	= table.rows.length-1;
							var i;
							var text 		= "";
							//alert(rowCount); ///LOOPING PAKE TO	
							for (i = 1; i <= rowCount; i++) { 
								text += document.getElementById('total2['+i+']').value.replace(",|.","")-1;
								text++;
								//text += parseFloat(text);
							}
							var result 		= document.getElementById('grand');
							result.value 	= accounting.formatMoney(text);
							
							var ppn 		= document.getElementById('ppn');
							var ppn2 		= document.getElementById('ppn2');
							ppn.value 		= accounting.formatMoney(text * 10/100);
							ppn2.value 		= text * 10/100;
							
							var glendotan	= document.getElementById('total');
							glendotan.value = accounting.formatMoney(parseFloat(text) + parseFloat(ppn2.value));
							//alert(text);
							//document.getElementById("grand").innerHTML = text;
							//var sum1 = document.getElementById('total[1]').value;
							//$('.input-xlarge-i').each(function () {
							//var prodprice = Number($(this).text());
							//sum2 = sum1 + prodprice;
							//alert(sum1);
						//});
						//$("#sum").text(sum2.toFixed(2));
						}
						
						function totalise(b_id){    
							var qtd   		= document.getElementById('jml'+b_id+'').value;
							var price 		= document.getElementById('unit['+b_id+']').value;
							var disc 		= document.getElementById('disc['+b_id+']').value;
							var besarDiskon = price.replace(",","") * qtd * (disc/100);
							var result 		= document.getElementById('total['+b_id+']');
							var result_2 	= document.getElementById('total2['+b_id+']');
							var amount 	    = document.getElementById('disc_2['+b_id+']');
							result.value 	= accounting.formatMoney(price.replace(",","") * qtd - besarDiskon);	
							result_2.value 	= price.replace(",","") * qtd - besarDiskon;
							amount.value 	= parseInt(besarDiskon);

							var table 		= document.getElementById("jengkol");
				            var rowCount 	= table.rows.length-1;
							var i;
							var text 		= "";
							//alert(rowCount); ///LOOPING PAKE TO	
							for (i = 1; i <= rowCount; i++) { 
								text += document.getElementById('total2['+i+']').value.replace(",|.","")-1;
								text++;
								//text += parseFloat(text);
							}
							var result 		= document.getElementById('grand');
							result.value 	= accounting.formatMoney(text);
							
							var ppn 		= document.getElementById('ppn');
							var ppn2 		= document.getElementById('ppn2');
							ppn.value 		= accounting.formatMoney(text * 10/100);
							ppn2.value 		= text * 10/100;
							
							var glendotan	= document.getElementById('total');
							glendotan.value = accounting.formatMoney(parseFloat(text) + parseFloat(ppn2.value));
						}

						function totalise2(b_id){    
							var qtd   		= document.getElementById('jml'+b_id+'').value;
							var price 		= document.getElementById('unit['+b_id+']').value;
							var disc_2 		= document.getElementById('disc_2['+b_id+']').value;
							var besarDiskon = price.replace(",","") * qtd * (disc_2/100);
							var result 		= document.getElementById('total['+b_id+']');
							var result_2 	= document.getElementById('total2['+b_id+']');
							var disc_3		= document.getElementById('disc['+b_id+']');
							result.value 	= accounting.formatMoney(price.replace(",","") * qtd - parseInt(disc_2.replace(",","")));	
							result_2.value 	= price.replace(",","") * qtd - disc_2.replace(",","");
							disc_3.value  	= Math.ceil(parseInt(disc_2.replace(",",""))/parseInt(price.replace(",","")*qtd)*100);

							var table 		= document.getElementById("jengkol");
				            var rowCount 	= table.rows.length-1;
							var i;
							var text 		= "";
							//alert(rowCount); ///LOOPING PAKE TO	
							for (i = 1; i <= rowCount; i++) { 
								text += document.getElementById('total2['+i+']').value.replace(",|.","")-1;
								text++;
								//text += parseFloat(text);
							}
							var result 		= document.getElementById('grand');
							result.value 	= accounting.formatMoney(text);
							
							var ppn 		= document.getElementById('ppn');
							var ppn2 		= document.getElementById('ppn2');
							ppn.value 		= accounting.formatMoney(text * 10/100);
							ppn2.value 		= text * 10/100;
							
							var glendotan	= document.getElementById('total');
							glendotan.value = accounting.formatMoney(parseFloat(text) + parseFloat(ppn2.value));
						}

						function myFunction(val) {
						    var qty 	= document.getElementById('qty['+val+']').value;
						    document.forms['quesioner_mcu'].elements['jml'+val+''].value=qty; 

						    	$('#myCheck'+val+'').hover(function(){
								    if (this.checked) {
						   				// alert(qty);
										document.getElementById('jml'+val+'').readOnly = true;
								    }else{
								    	document.getElementById('jml'+val+'').readOnly = false;
								    }
								})

						    	var qtd   		= document.getElementById('jml'+val+'').value;
								var price 		= document.getElementById('unit['+val+']').value;
								var disc 		= document.getElementById('disc['+val+']').value;
								var besarDiskon = price.replace(",","") * qtd * (disc/100);
								var result 		= document.getElementById('total['+val+']');
								var result_2 	= document.getElementById('total2['+val+']');
								var amount 	    = document.getElementById('disc_2['+val+']');
								result.value 	= accounting.formatMoney(price.replace(",","") * qtd - besarDiskon);	
								result_2.value 	= price.replace(",","") * qtd - besarDiskon;
								amount.value 	= parseInt(besarDiskon);

								var table 		= document.getElementById("jengkol");
					            var rowCount 	= table.rows.length-1;
								var i;
								var text 		= "";
								//alert(rowCount); ///LOOPING PAKE TO	
								for (i = 1; i <= rowCount; i++) { 
									text += document.getElementById('total2['+i+']').value.replace(",|.","")-1;
									text++;
									//text += parseFloat(text);
								}
								var result 		= document.getElementById('grand');
								result.value 	= accounting.formatMoney(text);
								
								var ppn 		= document.getElementById('ppn');
								var ppn2 		= document.getElementById('ppn2');
								ppn.value 		= accounting.formatMoney(text * 10/100);
								ppn2.value 		= text * 10/100;
								
								var glendotan	= document.getElementById('total');
								glendotan.value = accounting.formatMoney(parseFloat(text) + parseFloat(ppn2.value));					 
						}

						function toggle(source) {
							  checkboxes = document.getElementsByName('foo');
							  var val=1;

							  for(var i=0, n=checkboxes.length;i<n;i++){
							    checkboxes[i].checked = source.checked;
							   	var qty 	= document.getElementById('qty['+val+']').value;
							   	var complete 	= document.getElementById('optionsCheckbox').value;
							    document.forms['quesioner_mcu'].elements['jml'+val+''].value=qty; 
								document.getElementById('jml'+val+'').readOnly = true;

								var qtd   		= document.getElementById('jml'+val+'').value;
								var price 		= document.getElementById('unit['+val+']').value;
								var disc 		= document.getElementById('disc['+val+']').value;
								var besarDiskon = price.replace(",","") * qtd * (disc/100);
								var result 		= document.getElementById('total['+val+']');
								var result_2 	= document.getElementById('total2['+val+']');
								var amount 	    = document.getElementById('disc_2['+val+']');
								result.value 	= accounting.formatMoney(price.replace(",","") * qtd - besarDiskon);	
								result_2.value 	= price.replace(",","") * qtd - besarDiskon;
								amount.value 	= parseInt(besarDiskon);
							   	val++;
							    }

							var table 		= document.getElementById("jengkol");
				            var rowCount 	= table.rows.length-1;
							var i;
							var text 		= "";
							//alert(rowCount); ///LOOPING PAKE TO	
							for (i = 1; i <= rowCount; i++) { 
								text += document.getElementById('total2['+i+']').value.replace(",|.","")-1;
								text++;
								//text += parseFloat(text);
							}
							var result 		= document.getElementById('grand');
							result.value 	= accounting.formatMoney(text);
							
							var ppn 		= document.getElementById('ppn');
							var ppn2 		= document.getElementById('ppn2');
							ppn.value 		= accounting.formatMoney(text * 10/100);
							ppn2.value 		= text * 10/100;
							
							var glendotan	= document.getElementById('total');
							glendotan.value = accounting.formatMoney(parseFloat(text) + parseFloat(ppn2.value));
						}
					</script>
					<!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><b>Prescription Drug(s)</b></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                    <fieldset>
									<!-- <form class="form-horizontal" action="" method="post" name="quesioner_mcu"> -->
									<form class="form-horizontal" action="<?php echo base_url();?>Pharmacy/update_trx_pharmacy" method="post" name="quesioner_mcu">
										<div class="row-fluid">

<table class="table table-hover" id="jengkol">
<thead>
<tr>
	<th>No</th>
	<th>Drug Name</th>
	<th>Dosage</th>
	<th>Warehouse</th>
	<th>Order</th>
	<th>Qty</th>
	<!--
	<th>Unit Price</th>
	<th>Disc</th>
	<th>Amount</th>
	-->
	<!-- <th><input style="width:15px; height:20px;" type="checkbox" id="optionsCheckbox" onClick="toggle(this)" name="complete" value="1"></th> -->
</tr>
</thead>					
<tbody>		
<?php
	$fisik				=1;	$exp 				=1;	$doses 				=1;	$suhu 				=1;	$batch_date 		=1;	$expired_date 		=1;
	$batch_code 		=1;	$id_base 			=1;	$i					=1;	$amount				=1;	$qty				=1;	$input				=1;
	$inputt				=1;	$inputtt			=1; $totall				=1;	$item_id 			=1;	$amount_1			=1; $qty_1				=1; 
	$input_1			=1;	$cek				=1;	$xxx				=1;	$ooo				=1;	$ddd				=1;	$pop				=1;	
	$warehouse			=1;	$id_warehouse		=1;	$stock_warehouse	=1;	$toinput			=1;	$unit 				=1; $unit2 				=1; 
	$unit3 				=1; $disc 				=1; $disc2 				=1; $disc3 				=1; $discdua			=1; $discdua2			=1; 
	$discdua3 			=1; $numtotal			=1; $numtotal2			=1; $numtotal3 			=1; $drug_uom			=1; $id_manufaktur		=1;
	$numjumlah			=1; $numjumlah2			=1; $numjumlah3 		=1; $drug_id			=1; $id_phar_d			=1;

	$row_cnt 			= $list->num_rows();
	$dodol 				= "";
	foreach($list->result() as $row){
			
		if ($row->drug_qty1 == $row->drug_qty2) {
			$dodol 				= "checked";
		}

		$sisa = $row->stock - $row->drug_qty2; // hasil pengurangan stock dengan permintaan


?>

<tr class="odd gradeX">
	<td><?php echo $i++;?></td>
	<td><b><?php echo $row->item_name;?></b></td>
	<td><?php echo $row->dosage_main;?> x <?php echo $row->dosage_days;?></td>
	<td>
		<input type="text" name="warehouse<?php echo $warehouse++;?>" style="width:185px" placeholder="warehouse" id="a1" maxlength="0" value="<?=$row->warehouse_name?>" readonly/> 
		<!-- <button id="pop1" type="button" onclick="popup_r(<?php echo $pop++;?>,<?php echo $row->drug_qty1;?>);" class="btn btn-success btn-mini"><i class="icon-search"></i></button> -->
	
	</td>
	<td nowrap>
		<input id="qty[<?php echo $qty++;?>]" name="qty[<?php echo $qty_1++;?>]" type="text" value="<?php echo $row->drug_qty1;?>" style="width:35px" readonly/> <?php echo $row->baseunit;?>
	</td>

	<td>
		<input id="jml<?php echo $inputt++;?>" name="jml[]" type="number" onkeyup="totalise(<?php echo $toinput++;?>);" style="width:45px" value="<?=$row->drug_qty2?>" readonly/> 
		<input type="hidden" name="id_phar_d[]" value="<?php echo $row->id_phar_d;?>"/>
		<input type="hidden" name="id_manufaktur[]" value="<?php echo $row->id_manufaktur;?>"/>
		<input type="hidden" name="drug_uom[]" value="<?php echo $row->drug_uom;?>"/>
		<input type="hidden" name="drug_id[]" id="drug_id<?php echo $xxx++;?>" value="<?php echo $row->drug_id;?>"/>
		<input type="hidden" name="id_warehouse[]" value="<?=$row->id_warehouse?>"/> 
		<input type="hidden" name="stock_warehouse[]" value="<?=$sisa?>"/> 
	</td nowrap>

		<input type="hidden" name="rowCount" value="<?php echo $row_cnt;?>"/>
		<input type="hidden" name="id_presc" value="<?php echo $row->presc_no;?>"/>
		<input type="hidden" name="id_reg" value="<?php echo $row->id_reg;?>"/>
		<input type="hidden" name="id_pat" value="<?php echo $row->id_pat;?>"/>
		<input type="hidden" name="id_phar_h" value="<?php echo $row->id_phar_h;?>"/>


<!-- DITUTUP DIKARENAKAN TIDAK DIBUTUHKAN LIHAT HARGA DISINI..
	<td align="center">
		<INPUT class="input-xlarge-in focused" id="unit[<?php echo $unit++;?>]" name="unit[<?php echo $unit2++;?>]" onkeyup="totalise(<?php echo $unit3++;?>]);" value="<?php echo number_format($row->item_price,2);?>" style="width:75px; text-align:right" type="text" readonly/>
	</td>
	<td nowrap>
		<INPUT id="disc[<?php echo $disc++;?>]" name="disc[<?php echo $disc2++;?>]" max="99" min="1" type="text" onkeyup="totalise(<?php echo $disc3++;?>);" placeholder="0 %" style="width:25px" value="<?=$row->disc1?>" readonly/> % <INPUT id="disc_2[<?php echo $discdua++;?>]" name="disc_2[<?php echo $discdua2++;?>]" class="input-xlarge-i focused" type="text" onkeyup="totalise2(<?php echo $discdua3++;?>);" placeholder="Amount" style="width:55px; text-align:right" value="<?=number_format($row->disc2,2)?>" readonly/> IDR
	</td>
	<td nowrap>
		<div align="right"><INPUT id="total[<?php echo $numtotal++;?>]"  name="total[<?php echo $numtotal2++;?>]" style="width:145px; text-align:right" onkeydown="loadgrandtotal('jengkol');" type="text" value="<?=number_format($row->amount3,2)?>" readonly>
		<div align="right"><INPUT id="total2[<?php echo $numjumlah++;?>]"  name="total2[<?php echo $numjumlah2++;?>]" type="hidden" value="<?=$row->amount3?>" ></div>
	</td>
	
	<td>
		<input type="text" name="rowCount" value="<?php echo $row_cnt;?>"/>
		<input type="hidden" name="id_presc" value="<?php echo $row->presc_no;?>"/>
		<input type="hidden" name="id_reg" value="<?php echo $row->id_reg;?>"/>
		<input type="hidden" name="id_pat" value="<?php echo $row->id_pat;?>"/>
		<input type="hidden" name="id_phar_d<?php echo $id_phar_d++;?>" value="<?php echo $row->id_phar_d;?>"/>
		<input type="hidden" name="id_phar_h" value="<?php echo $row->id_phar_h;?>"/>
		<input type="text" name="id_manufaktur<?php echo $id_manufaktur++;?>" value="<?php echo $row->id_manufaktur;?>"/>
		<input type="hidden" name="drug_uom<?php echo $drug_uom++;?>" value="<?php echo $row->drug_uom;?>"/>
		<input type="hidden" name="drug_id<?php echo $drug_id++;?>" id="drug_id<?php echo $xxx++;?>" value="<?php echo $row->drug_id;?>"/>
	</td>

 -->
<!-- BATAS TUTUP ADA DISINI .. -->

</tr>								
<?php
	}
?>
</tbody>
</table>

<!--
			<table class="table table-striped table-bordered">
					<tr class="odd gradeX">
					<td><div align="right"><b>Total Amount</b> <INPUT class="input-xlarge-in focused" onkeydown="loadgrandtotal('jengkol');" id="grand"  name="amount_total" value="<?=number_format($row->amount2,2)?>" style="width:145px; text-align:right" type="text" readonly></div></td>
					</tr>
					<tr class="odd gradeX">
					<td><div align="right"><b>PPN 10%</b> <INPUT class="input-xlarge-in focused" onkeydown="loadgrandtotal('jengkol');" id="ppn" name="amount_ppn" value="<?=number_format($row->ppn,2)?>" style="width:145px; text-align:right" type="text" readonly>
					<INPUT onkeydown="loadgrandtotal('jengkol');" id="ppn2"  name="ppn2" type="hidden" ></div></td>
					</tr>
					<tr class="odd gradeX">
					<td><div align="right"><b>Grand Total</b> <INPUT class="input-xlarge-in focused" onkeydown="loadgrandtotal('jengkol');" id="total"  name="amount_grand" value="<?=number_format($row->total,2)?>" style="width:145px; text-align:right" type="text" readonly></div></td>
					</tr>
			</table>
-->

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
												<input type="submit" class="btn btn-success" value="Save">
												<a data-dismiss="modal" class="btn btn-warning" href="#">Close</a>
											</div>
										</div>
										
										<div class="form-actions">
										<a href="#myAlert" data-toggle="modal" class="btn btn-success">Dispense</a>
										<!-- <button class="btn btn-warning" type="reset">Reset</button> -->
                                        </div>
									<legend></legend>
									</form>
									</fieldset>                     						
                                </div>
                            </div>
                        </div>
                        <!-- /block -->	
		<!--/.fluid-container-->
        <script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>
		<link href="<?php echo base_url();?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
        <script src="<?php echo base_url();?>design/assets/scripts.js"></script>
        <script src="<?php echo base_url();?>design/assets/DT_bootstrap.js"></script>
</html>