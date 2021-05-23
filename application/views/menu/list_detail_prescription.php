					<script src="<?php echo base_url();?>design/assets/acc.js"></script>
					<script>	     
					    function popup_r(b_id,jml){
					      	var drug_id = document.getElementById('drug_id'+b_id+'').value;
					        window.open("<?php echo base_url();?>Pharmacy/find_werehouse_list/"+b_id+"/"+drug_id+"/"+jml+"","Popup","height=550, width=880, top=70, left=180 ");
					    }

					    function tampilppn(){
					    	$('#ppncek').hover(function(){
								    if (this.checked) {
										var ppncek		= document.getElementById('ppncek').value;
										var result 		= document.getElementById('grandasli').value;
										var ppn 		= document.getElementById('ppn');
										var ppn2 		= document.getElementById('ppn2');
										ppn.value 		= accounting.formatMoney(result * 10/100);
										ppn2.value 		= result * 10/100;
										var glendotan	= document.getElementById('total');
										glendotan.value = accounting.formatMoney(parseFloat(result) + parseFloat(ppn2.value));
										console.log(ppn);
								    }else{
										var ppncek		= document.getElementById('ppncek').value;
										var result 		= document.getElementById('grandasli').value;
										var ppn 		= document.getElementById('ppn');
										var ppn2 		= document.getElementById('ppn2');
										ppn.value 		= accounting.formatMoney(result * 0);
										ppn2.value 		= result * 0;
										var glendotan	= document.getElementById('total');
										glendotan.value = accounting.formatMoney(parseFloat(result) + parseFloat(ppn2.value));
										console.log(ppn);
								    }
								})
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
							var grandasli	= document.getElementById('grandasli');
							grandasli.value = text;

							var result 		= document.getElementById('grand');
							result.value 	= accounting.formatMoney(text);
							
							var ppn 		= document.getElementById('ppn');
							var ppn2 		= document.getElementById('ppn2');
							ppn.value 		= accounting.formatMoney(text * 0);
							ppn2.value 		= text * 0;
							
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
							var grandasli	= document.getElementById('grandasli');
							grandasli.value = text;

							var result 		= document.getElementById('grand');
							result.value 	= accounting.formatMoney(text);
							
							var ppn 		= document.getElementById('ppn');
							var ppn2 		= document.getElementById('ppn2');
							ppn.value 		= accounting.formatMoney(text * 0);
							ppn2.value 		= text * 0;
							
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
							var grandasli	= document.getElementById('grandasli');
							grandasli.value = text;

							var result 		= document.getElementById('grand');
							result.value 	= accounting.formatMoney(text);
							
							var ppn 		= document.getElementById('ppn');
							var ppn2 		= document.getElementById('ppn2');
							ppn.value 		= accounting.formatMoney(text * 0);
							ppn2.value 		= text * 0;
							
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
							var grandasli	= document.getElementById('grandasli');
							grandasli.value = text;
							var result 		= document.getElementById('grand');
							result.value 	= accounting.formatMoney(text);

							var ppn 		= document.getElementById('ppn');
							var ppn2 		= document.getElementById('ppn2');
							ppn.value 		= accounting.formatMoney(text * 0);
							ppn2.value 		= text * 0;
							
							var glendotan	= document.getElementById('total');
							glendotan.value = accounting.formatMoney(parseFloat(text) + parseFloat(ppn2.value));
						}


						function myFunction(val) {
						    var qty 	= document.getElementById('qty['+val+']').value;
						    document.forms['quesioner_mcu'].elements['jml'+val+''].value=qty; 
								document.getElementById('jml'+val+'').readOnly = true;
						    //Jika Checklist maka readonly....
					    	$('#myCheck'+val+'').click(function(){
							    if (this.checked) {
									document.getElementById('jml'+val+'').readOnly = true;
							    }else{
							    	document.getElementById('jml'+val+'').readOnly = false;
							    }
							})

						}

						// function toggle(source) {
						//   checkboxes = document.getElementsByName('foo');
						//   var val=1;

						//   for(var i=0, n=checkboxes.length;i<n;i++){
						//     checkboxes[i].checked = source.checked;
						//    	var qty 	= document.getElementById('qty['+val+']').value;
						//    	var complete 	= document.getElementById('optionsCheckbox').value;
						//     document.forms['quesioner_mcu'].elements['jml'+val+''].value=qty; 
						// 	document.getElementById('jml'+val+'').readOnly = true;
						//    	val++;
						//   }
						// }

					</script>
					<body onload="startTime()">
					<!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><b>Prescription Drug</b></div>
							<div class="muted pull-right" id="txt" style="font-weight: bold;"></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                    <fieldset>
									<!-- <form class="form-horizontal" action="" method="post" name="quesioner_mcu"> -->
									<form class="form-horizontal" action="<?php echo base_url();?>Pharmacy/save_trx_pharmacy" method="post" name="quesioner_mcu">
										<div class="row-fluid">

<table class="table table-hover" id="jengkol">
<thead>
<tr>
	<th>No</th>
	<th>Drug Name</th>
	<th>Dosage</th>
	<th>Warehouse</th>
	<th>Request Order</th>
	<th>Qty</th>
<!--<th>Unit Price</th>
	<th>Disc</th>
	<th>Amount</th> -->
	<th><input style="width:15px; height:20px;" type="checkbox" id="optionsCheckbox" onClick="toggle(this)" name="complete" value="1"></th>
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
	$numjumlah			=1; $numjumlah2			=1; $numjumlah3 		=1; $drug_id			=1;

	$row_cnt 			= $list->num_rows();
		$nilai="";
		$param=null;
	foreach($list->result() as $row){

	if($row->drug_group!=0){
	if($row->drug_group != $param){
			$param=$row->drug_group;
			$nilai="success";
	}else{
			$nilai="";
	}
	}
?>
<tr class="<?=$nilai;?>">
	<td><?php echo $i++;?></td>
	<td><i>[<?=$row->drug_group;?>]</i> <b><?php echo $row->item_name;?></b><?php if($row->drug_potekan!=0){ ?></br><p><?=$row->drug_potekan;?> Tablet <?=$row->drug_dtd;?>  d.t.d</p><?php }?></td>
	<?php
		if($row->dosage_main!=""){
			$war=$row->dosage_main." x ".$row->dosage_days;
		}else{
			$war="Manufacture Drug";
		}
	?>
	<td><?php echo $war;?> Day</td>
	<td>
		<?php  if ($row->id_manufaktur == 0) { ?>
		
		<input type="text" name="warehouse<?php echo $warehouse++;?>" style="width:185px" placeholder="warehouse" id="a1" maxlength="0" required/> 
		<button id="pop1" type="button" onclick="popup_r(<?php echo $pop++;?>,<?php echo $row->drug_qty;?>);" class="btn btn-success btn-mini"><i class="icon-search"></i></button>
		<input type="hidden" name="id_warehouse<?php echo $id_warehouse++;?>"/> 
		<input type="hidden" name="stock_warehouse<?php echo $stock_warehouse++;?>"/> 

		<?php }else{ ?>

		<input type="text" name="warehouse<?php echo $warehouse++;?>" style="width:185px" placeholder="warehouse" id="a1" maxlength="0" value="<?=$row->warehouse_name?>" readonly/> 
		<input type="hidden" name="id_warehouse<?php echo $id_warehouse++;?>" value="<?=$row->warehouse_id?>"/> 
		<input type="hidden" name="stock_warehouse<?php echo $stock_warehouse++;?>" value="0"/> 


			
		<?php } ;?>

	</td>
	<td nowrap>
		<input id="qty[<?php echo $qty++;?>]" name="qty[<?php echo $qty_1++;?>]" type="text" value="<?php echo $row->drug_qty;?>" style="width:35px" readonly/> <?php echo $row->baseunit;?>
	</td>
	<td>
		<input id="jml<?php echo $inputt++;?>" name="jml<?php echo $inputtt++;?>" type="number" onkeyup="totalise(<?php echo $toinput++;?>);" value="0" style="width:45px" step="any"/>
	</td nowrap>
	<!-- <td align="center"> -->
		<input class="input-xlarge-in focused" id="unit[<?php echo $unit++;?>]" name="unit[<?php echo $unit2++;?>]" onkeyup="totalise(<?php echo $unit3++;?>]);" value="<?php echo number_format($row->item_price,2);?>" style="width:75px; text-align:right" type="hidden" readonly/>
	<!-- </td> -->
	<!-- <td nowrap> -->
		<input id="disc[<?php echo $disc++;?>]" name="disc[<?php echo $disc2++;?>]" type="hidden" max="100" min="0"  onkeyup="totalise(<?php echo $disc3++;?>);" value="0" style="width:40px"/> 
		<!-- %  -->
		<input id="disc_2[<?php echo $discdua++;?>]" name="disc_2[<?php echo $discdua2++;?>]" class="input-xlarge-i focused" type="hidden" onkeyup="totalise2(<?php echo $discdua3++;?>);" placeholder="Amount" style="width:55px; text-align:right" value="0"/> 
		<!-- IDR -->
	<!-- </td> -->
	<!-- <td nowrap> -->
		<div align="right"><input id="total[<?php echo $numtotal++;?>]"  name="total[<?php echo $numtotal2++;?>]" placeholder="0" style="width:145px; text-align:right" onkeydown="loadgrandtotal('jengkol');" type="hidden" readonly>
		<div align="right"><input id="total2[<?php echo $numjumlah++;?>]"  name="total2[<?php echo $numjumlah2++;?>]" type="hidden"></div>
	<td>
		<input type="checkbox" id="myCheck<?php echo $cek++;?>" name="foo" value="" onclick="myFunction(<?php echo $ddd++;?>);" style="width:15px; height:15px;">
		<input type="hidden" name="rowCount" value="<?php echo $row_cnt;?>"/>
		<input type="hidden" name="id_presc" value="<?php echo $row->id_presc;?>"/>
		<input type="hidden" name="id_reg" value="<?php echo $row->id_reg;?>"/>
		<input type="hidden" name="id_pat" value="<?php echo $row->id_pat;?>"/>
		<input type="hidden" name="id_manufaktur<?php echo $id_manufaktur++;?>" value="<?php echo $row->id_manufaktur;?>"/>
		<input type="hidden" name="drug_uom<?php echo $drug_uom++;?>" value="<?php echo $row->drug_uom;?>"/>
		<input type="hidden" name="drug_id<?php echo $drug_id++;?>" id="drug_id<?php echo $xxx++;?>" value="<?php echo $row->drug_id;?>"/>
	</td>
</tr>								
<?php
	}
?>
</tbody>
</table>
			<!-- <table class="table table-striped table-bordered"> -->
			<table>
					<tr class="odd gradeX">
					<td><div align="right">
						<!-- <b>Total Amount</b>  -->
						<input class="input-xlarge-in focused" onkeydown="loadgrandtotal('jengkol');" id="grand"  name="amount_total" placeholder="0" style="width:145px; text-align:right" type="hidden" readonly>
					<input id="grandasli"  name="grandasli" type="hidden" ></div></td>
					</tr>
					<tr class="odd gradeX">
					<td><div align="right">
						<!-- <input type="checkbox" id="ppncek" name="ppncek" onclick="tampilppn();" style="width:15px; height:15px;"> -->
						<!-- <b>PPN 10%</b>  -->
						<input class="input-xlarge-in focused" id="ppn" name="amount_ppn" placeholder="0" style="width:145px; text-align:right" type="hidden" readonly>
					<input id="ppn2"  name="ppn2" type="hidden" ></div></td>
					</tr>
					<tr class="odd gradeX">
					<td><div align="right">
						<!-- <b>Grand Total</b>  -->
						<input class="input-xlarge-in focused" onkeydown="loadgrandtotal('jengkol');" id="total"  name="amount_grand" placeholder="0" style="width:145px; text-align:right" type="hidden" readonly></div></td>
					</tr>
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
												<input type="submit" class="btn btn-success" value="Save">
												<a data-dismiss="modal" class="btn btn-warning" href="#">Close</a>
											</div>
										</div>
										
										<div class="form-actions">
										<div style="float:left;">
										<button class="btn btn-danger" type="reset"><b>Reset</b></button>
										</div>
										<div style="float:right;">
										<a href="#myAlert" data-toggle="modal" class="btn btn-success"><b>Submit</b></a>
										</div>
                                        </div>
									</form>
									</fieldset>                     						
                                </div>
                            </div>
                        </div>
						</body>
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
        <script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>
		<link href="<?php echo base_url();?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
        <script src="<?php echo base_url();?>design/assets/scripts.js"></script>
        <script src="<?php echo base_url();?>design/assets/DT_bootstrap.js"></script>