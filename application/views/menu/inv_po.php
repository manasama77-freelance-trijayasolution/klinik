	<?php
		$id						= $this->uri->segment(3);
		$session_data 			= $this->session->userdata('logged_in');
		$userlvl				= $session_data['userlevel'];
		if($id=="ok"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Input Purchase Order
		</div>
	<?php
		}
	?>

	<script>
	  function undisableTxt(){   
		<?php
			$x = 1; 
			while($x <= 4) {
			echo "document.getElementById('".$x."').disabled = false;";
			$x++;
			}	
		?>
	  }
	  
	  function goBack(){
	  	window.history.back();
	  }
	  
	  function popup(){
        window.open("<?php echo base_url();?>inv/find_supplier","Popup","height=600, width=1800, top=20, left=180 ");
      }

	  function add_sup(){
        window.open("<?php echo base_url();?>inv/add_inv_supplier","Popup","height=600, width=1800, top=20, left=180 ");
      }
	  
	  function add_alamat(){
        window.open("<?php echo base_url();?>inv/add_inv_delivery","Popup","height=600, width=1800, top=20, left=180 ");
      }
	   
	  function add_conv(){
        window.open("<?php echo base_url();?>inv/add_conversion_popup","Popup","height=600, width=1800, top=20, left=180 ");
      }
	  
	  function popup_2(){
        window.open("<?php echo base_url();?>inv/find_delivery","Popup","height=550, width=880, top=70, left=180 ");
      }
	  
	  function popup_s(b_id){
	  	var id_pr = document.getElementById("id_pr["+b_id+"]").value;
        window.open("<?php echo base_url();?>inv/find_item_by_pr/"+b_id+"/"+id_pr+"","Popup","height=700, width=1500, top=5, left=5 ");
        // window.open("<?php echo base_url();?>inv/find_item/"+b_id+"/"+id_pr+"","Popup","height=650, width=980, top=10, left=180 ");
      }
	  
	  function popup_pr(b_id){
        window.open("<?php echo base_url();?>inv/find_pr/"+b_id+"","Popup","height=550, width=880, top=70, left=180 ");
      }
	  
	  function popup_info_pr(b_id){
	  	var id_pr = document.getElementById("id_pr["+b_id+"]").value;
	  	if (id_pr == 0) {
	  		alert("Please Fill PR Number !!");
	  	}else{
	        window.open("<?php echo base_url();?>inv/find_pr_detail_info/"+id_pr+"","","height=550, width=880, top=70, left=180 ");
	  	}
      }

	  function popup_hisotry_item(b_id){
	  	// alert(b_id);
	  	var id_item = document.getElementById("his_item["+b_id+"]").value;
	  	// alert(id_item);
	  	if (id_item == 0) {
	  		alert("Please Fill PR Number !!");
	  	}else{
	        window.open("<?php echo base_url();?>inv/view_history_item/"+id_item+"","","height=700, width=1500, top=5, left=5 ");
	  	}
      }

      function popup_conversion(b_id){
	  	var vestige = document.getElementById("vestige["+b_id+"]").value;
	  	var id_base = document.getElementById("id_base["+b_id+"]").value;
	  	if (vestige == 0) {
	  		alert("Please Choose Item");
	  	}else{
        	window.open("<?php echo base_url();?>inv/find_conversion/"+b_id+"/"+id_base+"/"+vestige+"","Popup","height=550, width=880, top=70, left=180 ");
	  	}
      }

    function setBlurFocus(b_id) {
    	document.getElementById("tampil["+b_id+"]").innerHTML = "Rp "+accounting.formatMoney(document.getElementById("unit["+b_id+"]").value);
	}

	</script>
	<script src="<?php echo base_url();?>design/assets/acc.js"></script>
	<script language="javascript">
        function addRow(tableID) {
            var table 		= document.getElementById(tableID);
            var rowCount 	= table.rows.length;
            var row 		= table.insertRow(rowCount);
			
            //var cell1 		= row.insertCell(0);
            //var element1 	= document.createElement("input");
            //element1.type 	= "checkbox";
            //element1.name	= "chkbox[]";
            //cell1.appendChild(element1);

            var cell2 		= row.insertCell(0);
            cell2.innerHTML = rowCount + 1-1;
			
			if (rowCount >= 10) {
				document.getElementById('plus1').disabled = true;
				document.getElementById('plus2').disabled = true;
			}
			
			
            var cell3 		= row.insertCell(1);
			cell3.innerHTML = "<input style='width:185px' placeholder='PR Number' name='pr_no["+cell2.innerHTML+"]' type='text' autocomplete='off' maxlength='0' required onclick='popup_s("+cell2.innerHTML+");'>  <button class='btn btn-info btn-mini' type='button' onclick='popup_info_pr("+cell2.innerHTML+");'><i class='icon-info-sign'></i></button> </br> <input type='text' onclick='popup_s("+cell2.innerHTML+");' id='a"+cell2.innerHTML+"' name='item["+cell2.innerHTML+"]' placeholder='item(s) Klik Here' style='width:185px' maxlength='0' required>  <button class='btn btn-info btn-mini' type='button' onclick='popup_hisotry_item("+cell2.innerHTML+");'><i class='icon-time'></i></button>";

			var cell4 		= row.insertCell(2);
			cell4.innerHTML = "<input name='id_base["+cell2.innerHTML+"]' id='id_base["+cell2.innerHTML+"]' type='hidden' value='0'/> <input id='base["+cell2.innerHTML+"]' name='base["+cell2.innerHTML+"]' style='width:100px' type='hidden' /> </br> <input name='vestige["+cell2.innerHTML+"]' id='vestige["+cell2.innerHTML+"]' type='hidden' value='0' /> <input id='basename["+cell2.innerHTML+"]' name='basename["+cell2.innerHTML+"]' style='width:120px' placeholder='Conversion' onclick='popup_conversion("+cell2.innerHTML+");' type='text' maxlength='0' required/> <input id='conv_id["+cell2.innerHTML+"]' name='conv_id["+cell2.innerHTML+"]' style='width:45px' type='hidden' />  <button type='button' onclick='add_conv();' title='Add Conversi' class='btn btn-success btn-mini'><i class='icon-plus'></i></button> </br> <input type='text' onkeyup='totalise("+cell2.innerHTML+");loadgrandtotal(example2);' name='qty["+cell2.innerHTML+"]' id='qty["+cell2.innerHTML+"]' placeholder='Qty' style='width:45px'> <input id='convq["+cell2.innerHTML+"]' name='convq["+cell2.innerHTML+"]' onkeyup='totalise("+cell2.innerHTML+");loadgrandtotal('example2');' style='width:45px'  type='hidden' /> <input id='hasil["+cell2.innerHTML+"]' name='hasil["+cell2.innerHTML+"]' type='hidden' />  ";								
			
			var cell5 		= row.insertCell(3);
			cell5.innerHTML = "<input class='input-xlarge-in focused' type='text' id='unit["+cell2.innerHTML+"]' autocomplete='off' name='unit["+cell2.innerHTML+"]' onkeyup='totalise("+cell2.innerHTML+");loadgrandtotal(example2);setBlurFocus("+cell2.innerHTML+");' style='width:75px; text-align:right;' type='text'> <b>IDR</b> <p id='tampil["+cell2.innerHTML+"]'></p>";
													
			
			var cell6 		= row.insertCell(4);
			cell6.innerHTML = "<input id='disc["+cell2.innerHTML+"]' name='disc["+cell2.innerHTML+"]' onkeyup='totalise("+cell2.innerHTML+");' value='0' placeholder='0 %' style='width:25px' max='99' min='1' type='text'> <b>%</b> </br> <input id='disc_2["+cell2.innerHTML+"]' value='0' name='disc_2["+cell2.innerHTML+"]' onkeyup='totalise2("+cell2.innerHTML+");' placeholder='Amount' style='width:95px; text-align:right;' type='text'> <b>IDR</b>";
			
			var cell7 		= row.insertCell(5);
			cell7.innerHTML = "<div align='right'><input class='input-xlarge-i' id='total["+cell2.innerHTML+"]' name='total["+cell2.innerHTML+"]' placeholder='0' style='width:145px; text-align:right;' type='text' readonly><input class='input-xlarge-i' id='total2["+cell2.innerHTML+"]' name='total2["+cell2.innerHTML+"]' placeholder='0' style='width:145px; text-align:right;' type='hidden' ><input type='hidden' name='rowcount' value='"+cell2.innerHTML+"'><input type='hidden' name='id_item["+cell2.innerHTML+"]' value='0'><input type='hidden' name='id_pr["+cell2.innerHTML+"]' id='id_pr["+cell2.innerHTML+"]' value='0'> </div>";
        }
		
		function totalise(b_id){    
			var qtd   		= document.getElementById('qty['+b_id+']').value;
			var price 		= document.getElementById('unit['+b_id+']').value;
			var disc 		= document.getElementById('disc['+b_id+']').value;
			var besarDiskon = price.replace(",","") * qtd * (disc/100);
			var result 		= document.getElementById('total['+b_id+']');
			var result_2 	= document.getElementById('total2['+b_id+']');
			var amount 	    = document.getElementById('disc_2['+b_id+']');
			result.value 	= accounting.formatMoney(price.replace(",","") * qtd - besarDiskon);	
			result_2.value 	= price.replace(",","") * qtd - besarDiskon;
			amount.value 	= parseInt(besarDiskon);
		}
		
		function totalise2(b_id){    
			var qtd   		= document.getElementById('qty['+b_id+']').value;
			var price 		= document.getElementById('unit['+b_id+']').value;
			var disc_2 		= document.getElementById('disc_2['+b_id+']').value;
			var besarDiskon = price.replace(",","") * qtd * (disc_2/100);
			var result 		= document.getElementById('total['+b_id+']');
			var result_2 	= document.getElementById('total2['+b_id+']');
			var disc_3		= document.getElementById('disc['+b_id+']');
			result.value 	= accounting.formatMoney(price.replace(",","") * qtd - parseInt(disc_2.replace(",","")));	
			result_2.value 	= price.replace(",","") * qtd - disc_2.replace(",","");
			disc_3.value  	= Math.ceil(parseInt(disc_2.replace(",",""))/parseInt(price.replace(",","")*qtd)*100);
		}
		
		 function tampilppn(){
			$('#ppncek').hover(function(){
			    if (this.checked) {
					var result 		= document.getElementById('grandasli').value;
					var ppn 		= document.getElementById('ppn');
					var ppn2 		= document.getElementById('ppn2');
					ppn.value 		= accounting.formatMoney(result * 10/100);
					ppn2.value 		= result * 10/100;
					var glendotan	= document.getElementById('total');
					glendotan.value = accounting.formatMoney(parseFloat(result) + parseFloat(ppn2.value));
			    }else{
					var result 		= document.getElementById('grandasli').value;
					var ppn 		= document.getElementById('ppn');
					var ppn2 		= document.getElementById('ppn2');
					ppn.value 		= accounting.formatMoney(result * 0);
					ppn2.value 		= result * 0;
					var glendotan	= document.getElementById('total');
					glendotan.value = accounting.formatMoney(parseFloat(result) + parseFloat(ppn2.value));
			    }
			})
		}

		function loadgrandtotal(tableID){
			var table 		= document.getElementById("example2");
            var rowCount 	= table.rows.length-1;
			var i;
			var text 		= "";
			
			for (i = 1; i <= rowCount; i++) { 
				text += document.getElementById('total2['+i+']').value.replace(",|.","")-1;
				text++;
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

		function hitungconversi(b_id){
			var convq 		= document.getElementById('convq['+b_id+']');
			var hasil		= document.getElementById('hasil['+b_id+']');
			var conv_id 	= document.getElementById('conv_id['+b_id+']').value;
			var qty 		= document.getElementById('qty['+b_id+']').value;
			var vestige		= document.getElementById('vestige['+b_id+']').value;
			var hsl 		= qty * conv_id;
			convq.value 	= qty * conv_id;
			hasil.value 	= vestige - hsl;
		}
		
		function undisableTxt2(b_id){
			document.getElementById('a'+b_id+'').readOnly = false;
			document.getElementById('b'+b_id+'').readOnly = false;
			document.getElementById('pop'+b_id+'').disabled = true; 
		}
		
		function undisableTxt1(){
			document.getElementById('f').readOnly = false;
		}
 
		function deleteRow(tableID) {
			var table = document.getElementById(tableID);
			var rowCount = table.rows.length;	
			table.deleteRow(rowCount -1);
		}
    </SCRIPT>
	<?php
	include './design/koneksi/file.php';
	$query 		="SELECT id_po dt FROM trx_item_po_h ORDER BY id_po DESC LIMIT 1";  
    if($result 	=mysqli_query($con,$query))
    {
		//$date	=date('ym');
        $row 	=mysqli_fetch_assoc($result);
        $count 	=$row['dt'];
		//$dater 	=$row['dt'];
		if ($count != "") {
		$count = $count+1; 	
		}else{
		$count = 1;
		}
        $code_no = $count;
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
	?>
                    <body onload="startTime()">
                    <!-- morris stacked chart -->
                    <div class="row-fluid" >
                    <!-- <div class="row-fluid" onmouseover="loadgrandtotal('example2');" > -->
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><b>Purchase Order</b></div>
                            <div class="muted pull-right" id="txt" style="font-weight: bold;"></div>
                            </div>

								<div class="form-actions">
						 		 <button onclick="undisableTxt()" class="btn btn-primary">Start</button> 										 
									 <div class="btn-group">
									  <button data-toggle="dropdown" class="btn btn-info dropdown-toggle">Menu <span class="caret"></span></button>
									  <ul class="dropdown-menu">
										<li><a href="<?php echo base_url();?>inv/list_po"><i class="icon-list"></i> List Purchase Order</a></li>
										<li><a href="<?php echo base_url();?>inv/listpr_pur"><i class="icon-list"></i> List Purchase Requests</a></li>
										<?php if ($userlvl != "user"){ ?>
										<li class="divider"></li>
										<li><a href="<?php echo base_url();?>inv/listpo_app/"><i class="icon-ok-sign"></i> Request Approval</a></li>
										<?php } ?>
									  </ul>
									 </div>

								</div>

                            <div class="block-content collapse in">
                                <div class="span12">           
                                      <fieldset>

										<form class="form-horizontal" action="<?php echo base_url();?>inv/save_po" method="post" name="mst_pr">
										<!--<div id="" style="overflow-y: scroll; height:260px;">-->
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">No</label>
                                          <div class="controls">
                                          <span class="input-xlarge uneditable-input">
                                          PO/<?=date('Y');?>/<?=romanic_number(date('m'));?>/<?=$urutan;?>
                                          </span>
										  <input name="no" type="hidden" id="2" autocomplete="off" value="PO/<?=date('Y');?>/<?=romanic_number(date('m'));?>/<?=$urutan;?>">
                                          </div>
                                        </div>
																	
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">PO Date</label>
                                          <div class="controls">
                                          <span class="input-xlarge uneditable-input"><?php echo date("m/d/Y");?></span> <i class="icon-calendar"></i> 
                                          <input name="dates" value="<?php echo date("m/d/Y");?>" type="hidden">
                                            <!-- <input class="input-xlarge datepicker" id="3" name="dates" placeholder="Click Here ..." type="text"autocomplete="off" disabled required> <i class="icon-calendar"></i>  -->
                                          </div>
                                        </div>
																
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Currency</label>
                                          <div class="controls">
                                          <span class="input-xlarge uneditable-input">IDR</span>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Delivery Time</label>
                                          <div class="controls">
                                            <input class="input-xlarge datepicker" id="3" name="date_delivery" placeholder="Click Here ..." type="text" autocomplete="off" disabled required> <i class="icon-calendar"></i> 
                                          </div>
                                        </div>
										

										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Supplier Code</label>
                                          <div class="controls">
										  <input id="spcode" name="spcode" type="text" placeholder="Click Here ..." onclick="popup();" readonly>
                                          <button type="button" onclick="add_sup();" title="Add Supplier" class="btn btn-success btn-mini"><i class="icon-plus"></i></button> 
                                          <!-- <button type="button" onclick="popup();" title="Find Supplier" class="btn btn-info btn-mini"><i class="icon-search"></i></button>  -->
                                          </div>
                                        </div>

										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Supplier Name</label>
                                          <div class="controls">
										  <input id="name_supplier" name="name_supplier" type="text" readonly>
										  <input id="id_supplier" name="id_supplier" type="hidden">
                                          </div>
                                        </div>

                                        <div class="control-group">
                                          <label class="control-label" for="focusedInput">Term of Payment</label>
                                          <div class="controls">
                                        	<input class="input-small" id="4" name="term" min="1" max="999" type="number" autocomplete="off" disabled required> Day(s)
                                          </div>
                                        </div>
																			
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Delivery Address</label>
                                          <div class="controls">
										  <input id="id_address" name="id_address" type="hidden">
										  <textarea name="delivery" id="7" maxlength="0" placeholder="Click Here ..." onclick="popup_2();"  readonly required></textarea>
										  <button type="button" onclick="add_alamat();" title="Add Address" class="btn btn-success btn-mini"><i class="icon-plus"></i></button> 
										  <!-- <button type="button" onclick="popup_2();" class="btn btn-info btn-mini"><i class="icon-search"></i></button> -->
                                        </div>
                                        </div>
										<!--										
										<div style="width: 50%; float: right;">
										<textarea name="items" id="f" style="width: 240pt; height: 130pt; font-size: 9pt; font-family: Arial; border: 1px solid black;" placeholder="Purchase Order List Here ..."  readonly></textarea>
										</div>
										</div>
										-->
										</br>
										<!-- 
										<?php 
										include './design/koneksi/file.php';
										$query 		="select * from mst_baseunit";  
										$result 	=mysqli_query($con,$query)
										?> -->
			
								<input class="btn btn-success" type="button" value="Add" onclick="addRow('example2')" id="plus1" />
								<input class="btn btn-danger" type="button" value="Delete" onclick="deleteRow('example2')" />			


										</br>
										</br>
										<div style="width:100%; height:100%	; overflow: auto; float:center;">
										<table class="table table-striped table-bordered" id="example2" onkeydown="loadgrandtotal('example2');">
										    <thead>
                                          	<tr>
												<th>No</th>
												<th>Name of Product</th>
												<th>Qty</th>
												<th>Unit Price</th>
												<th>Disc</th>
												<th>Amount</th>
											</tr>
											</thead>
											<tbody>
											<tr class="odd gradeX" id="voucher_">
												<td>1</td>
												<td>
													<input style="width:185px" name="pr_no[1]" type="text" id="2" autocomplete="off" placeholder="PR Number" maxlength="0" required> 
													<!-- <input style="width:100px" onclick="popup_pr(1);" name="pr_no[1]" type="text" id="2" autocomplete="off" placeholder="PR Number" maxlength="0" required>  -->
													<button class="btn btn-info btn-mini" type="button" onclick="popup_info_pr(1);"><i class="icon-info-sign"></i></button> </br>
													<input type="text" name="item[1]" style="width:185px" onclick="popup_s(1);" placeholder="item(s) Click Here" id="a1" maxlength="0" required/>
													<button class="btn btn-info btn-mini" type="button" onclick="popup_hisotry_item(1);"><i class="icon-time"></i></button> 
												</td>
												<td>
													<input name="id_base[1]" id="id_base[1]" type="hidden" value="0"/> 
													<input name="vestige[1]" id="vestige[1]" type="hidden" value="0"/> 
													<input id="base[1]" name="base[1]" style="width:100px" type="hidden" />
													<input id="conv_id[1]" name="conv_id[1]" style="width:45px" type="hidden" /> 
													<input id="hasil[1]" name="hasil[1]" type="hidden" /> 
													
													<input onclick="popup_conversion(1);" placeholder="Conversion Click Here" id="basename[1]" name="basename[1]" style="width:120px" type="text" maxlength="0" required/>
													<button type="button" onclick="add_conv();" title="Add Conversi" class="btn btn-success btn-mini"><i class="icon-plus"></i></button>
													</br>
													<input id="qty[1]" name="qty[1]" placeholder="Qty" onkeyup="totalise(1);loadgrandtotal('example2');hitungconversi(1);" style="width:45px" type="text" />
													<input id="convq[1]" name="convq[1]" onkeyup="totalise(1);loadgrandtotal('example2');" style="width:45px" max="99" min="1" type="hidden" /> 
												</td>
												<td align="center">
													<input class="input-xlarge-in focused" id="unit[1]" name="unit[1]" autocomplete="off" onkeyup="totalise(1);loadgrandtotal('example2');setBlurFocus(1);" style="width:75px; text-align:right" type="text"/> <b>IDR</b>
													<!-- <input id="unitx[1]" name="unitx[1]" type="hidden"/> -->
													<p id="tampil[1]"></p>
												</td>
												<td>
													<input id="disc[1]" name="disc[1]" max="99" min="1" type="text" onkeyup="totalise(1);" placeholder="0 %" value="0" style="width:25px"/>  <b>%</b> </br>
													<input id="disc_2[1]" name="disc_2[1]" class="input-xlarge-i focused" type="text" onkeyup="totalise2(1);" placeholder="Amount" style="width:95px; text-align:right" value="0"/> <b>IDR</b>
												</td>
												<td>
													<div align="right"><input id="total[1]"  name="total[1]" placeholder="0" style="width:145px; text-align:right" onkeydown="loadgrandtotal('example2');" type="text" readonly><div align="right"><input id="total2[1]"  name="total2[1]" placeholder="0" style="width:145px; text-align:right" type="hidden" readonly></div>
													<input name="id_item[1]" id="id_item[1]" type="hidden" value="0"/> 
													<input name="id_pr[1]" id="id_pr[1]" type="hidden" value="0">
													
												<?php for ($i=1; $i < 11; $i++) { 
												echo "<input name='his_item[".$i."]' id='his_item[".$i."]' type='hidden' value='0'/> ";
												} ?>
												</td>
											</tr>
											</tbody>
										</table>
								
								<input class="btn btn-success" type="button" value="Add" onclick="addRow('example2')" id="plus2" />
								<input class="btn btn-danger" type="button" value="Delete" onclick="deleteRow('example2')" />										
										</fieldset>  
										<table class="table table-striped table-bordered">
											<tr class="odd gradeX">
											<td><div align="right"><b>Total Amount</b> <INPUT class="input-xlarge-in focused" onkeyup="loadgrandtotal('example2');" id="grand"  name="amount_total" placeholder="0" style="width:145px; text-align:right" type="text" readonly><input id="grandasli"  name="grandasli" type="hidden" ></div></td>
											</tr>
											<tr class="odd gradeX">
											<td><div align="right"><input type="checkbox" id="ppncek" name="ppncek" onclick="tampilppn();" style="width:35px; height:35px;  border-radius: 25px;"> <b>PPN</b> <INPUT class="input-xlarge-in focused" onkeyup="loadgrandtotal('example2');" id="ppn" name="amount_ppn" placeholder="0" style="width:145px; text-align:right" type="text" readonly>
											<INPUT onkeyup="loadgrandtotal('example2');" id="ppn2"  name="ppn2" type="hidden" ></div></td>
											</tr>
											<tr class="odd gradeX">
											<td><div align="right"><b>Grand Total</b> <INPUT class="input-xlarge-in focused" onkeyup="loadgrandtotal('example2');" id="total"  name="amount_grand" placeholder="0" style="width:145px; text-align:right" type="text" readonly></div></td>
											</tr>
										</table>
									    </div>
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
												<input type="submit" class="btn btn-success" value="Save" id="1" disabled>
												<a data-dismiss="modal" class="btn btn-warning" href="#">Close</a>
											</div>
										</div>
										
										<div class="form-actions">
										<a href="#myAlert" data-toggle="modal" class="btn btn-success">Submit</a>
                                        </div>
										<legend></legend>
										</form>                   						
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