	
	<?php
		$id = $this->uri->segment(3);
		if ($id=="ok"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Input Billing
		</div>
	<?php
		} else if ($id=="update") {
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Update Billing
	    </div>
	<?php
		} else if ($id=="del") {
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Delete Billing
		</div>
	<?php
		}
	?>		
	<script src="<?php echo base_url();?>design/assets/acc.js"></script>
	<script>
	function hitungan(){
		var kurs 	= document.getElementById('kurs');
		var kursx 	= document.getElementById('kursx');
		var usdy 	= document.getElementById('usdy');
		var usd 	= document.getElementById('usd');
		var usdx 	= document.getElementById('usdx');
		var idr 	= document.getElementById('idr');
		var idrx 	= document.getElementById('idrx');
		var cc 		= document.getElementById('cc')	;
		var ccx 	= document.getElementById('ccx');
		var dc 		= document.getElementById('dc');
		var dcx 	= document.getElementById('dcx');
		var ins 	= document.getElementById('ins');
		var insx 	= document.getElementById('insx');

		usd.value	= parseFloat(kursx.value) * parseFloat(usdy.value);

		usdx.value 	= parseFloat(usd.value.replace(",","").replace(",","").replace(",","").replace(",",""));
		idrx.value 	= parseFloat(idr.value.replace(",","").replace(",","").replace(",","").replace(",",""));
		ccx.value 	= parseFloat(cc.value.replace(",","").replace(",","").replace(",","").replace(",",""));
		dcx.value 	= parseFloat(dc.value.replace(",","").replace(",","").replace(",","").replace(",",""));
		insx.value 	= parseFloat(ins.value.replace(",","").replace(",","").replace(",","").replace(",",""));

		usd.value 	= accounting.formatMoney(usd.value);
		idr.value 	= accounting.formatMoney(idr.value);
		cc.value 	= accounting.formatMoney(cc.value);
		dc.value 	= accounting.formatMoney(dc.value);
		ins.value 	= accounting.formatMoney(ins.value);
	}

	function hitjumlah(grand_total){
		var usd 			= document.getElementById('usd');
		var usdx 			= document.getElementById('usdx');
		var idr 			= document.getElementById('idr');
		var idrx		 	= document.getElementById('idrx');
		var cc 				= document.getElementById('cc')	;
		var ccx 			= document.getElementById('ccx');
		var dc 				= document.getElementById('dc');
		var dcx 			= document.getElementById('dcx');
		var ins 			= document.getElementById('ins');
		var insx 			= document.getElementById('insx');
		var jumlah 			= document.getElementById('jumlah');
		var total 			= document.getElementById('total');
		var ots 			= document.getElementById('ots');
		var outstanding 	= document.getElementById('outstanding');

		jumlah.value		= parseFloat(usdx.value) + parseFloat(idrx.value) + parseFloat(ccx.value) + parseFloat(dcx.value) + parseFloat(insx.value);
		total.value			= accounting.formatMoney(jumlah.value);
		outstanding.value	= parseFloat(grand_total) - parseFloat(jumlah.value);
		ots.value			= accounting.formatMoney(outstanding.value);

	}
	</script>
	<?php
	foreach ($bill->result() as $row_bill) {
		$tagihan	= $row_bill->grand_total;
	}
  	foreach ($ch_bill->result() as $row_bill) {
  		$type_charge_rule		= $row_bill->type_charge_rule;
  	}
  	foreach ($kurs->result() as $row_kurs) {
  		$amount 				= $row_kurs->amount;
  	}
  	// foreach ($payment->result() as $row_payment) {
  	// 	$amount 				= $row_payment->amount;
  	// }
  	
  	// tagihan untuk insurance
  	$readonly 		= "";
  	$readonly_ins 	= "readonly";
  	if ($type_charge_rule == 3) {
  		$readonly		= "readonly";
  		$readonly_ins	= "";
  	}
  	// tagihan untuk dollar (USD)
  	if ($type_charge_rule == 6) {
  		$tagihan	= $tagihan * $amount;
  	}
	?>
		  <!-- morris stacked chart -->
                    <div class="row-fluid" onmouseover="hitjumlah(<?=$tagihan;?>);">
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><b>Payment</b></div>
                            <div class="muted pull-right" id="txt" style="font-weight: bold;"></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                	<form class="form-horizontal" name="uguu" id="uguu" onsubmit="return confirm('Do you really want to submit the form?');" method="post" action="<?php echo base_url();?>cashier/save_payment" >
                                    <fieldset>
									<div class="form-horizontal" >
									  <!-- BAGIAN KIRI -->
									  <div style="width:50%; float:left;">
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">ID Registration</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="nomorreg" value="<?=$id_reg;?>" type="text" maxlength="0" autocomplete="off"  readonly>
											<input name="id_pat" type="hidden" value="<?=$id_pat;?>" autocomplete="off" >
											<input name="id_reg" type="hidden" value="<?=$id_reg;?>" autocomplete="off" >
										  </div>
                                        </div>

									  	<div class="control-group">
                                          <label class="control-label" for="focusedInput">Billing Number</label>
                                          <div class="controls">
											<input class="input-xlarge focused" name="bill_no" value="<?=$bill_no;?>" type="text" id="bill_no" readonly autocomplete="off" > 	
											<input class="input-xlarge focused" name="id_billing" id="id_billing" value="<?=$id_billing;?>" type="hidden" > 	
                                          </div>
                                        </div>

  									
									
										<?php
										foreach ($bill->result() as $row) {}
										?>
										<div class="control-group">
											<label class="control-label" for="focusedInput">Total Billing</label>
											<div class="controls">
											<input class="input-xlarge focused" name="tipeharga" value="<?=number_format($row->total,2);?>" style="text-align:right" type="text" autocomplete="off" readonly >	
											</div>
										</div>									                          
								    	<div class="control-group">
											<label class="control-label" for="focusedInput">Total Discount</label>
											<div class="controls">
											<input class="input-xlarge focused" name="tipeharga" value="<?=number_format($row->disc,2);?>" style="text-align:right" type="text" autocomplete="off" readonly >	
											</div>
										</div>									                          
								    	<div class="control-group">
											<label class="control-label" for="focusedInput">Grand Total</label>
											<div class="controls">
											<input class="input-xlarge focused" name="tipeharga" value="<?=number_format($row->grand_total,2);?>" style="text-align:right" type="text" autocomplete="off" readonly >	
											</div>
										</div>
										<?php 
									  	if ($type_charge_rule == 6) {
									  	?>
									  	<div class="control-group">
                                          <label class="control-label" for="focusedInput">Conversi</label>
                                          <div class="controls">
											<input class="input-xlarge focused" name="conversi" id="conversi" style="text-align:right" type="text" id="" readonly autocomplete="off" value="<?=number_format($tagihan,2);?>"  > 	
											<input class="input-xlarge focused" name="conversix" id="conversix" type="hidden" value="<?=$tagihan;?>"  > 	
                                          </div>
                                        </div>	
                                        <?php } ?>
									
									
									  </div>
									  <!-- BAGIAN KANAN -->
									  <div style="width:50%; float:right;">
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Patient Name</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="pat_name" value="<?=$pat_name;?>" type="text" id="myText02" readonly autocomplete="off" >
                                          </div>
                                        </div>
										
									  	<div class="control-group">
                                          <label class="control-label" for="focusedInput">Age</label>
                                          <div class="controls">
											<input class="input-xlarge focused" name="age" value="<?=$age;?>" type="text" readonly autocomplete="off" > 	
                                          </div>
                                        </div>		

									  	<?php 
									  		$jmlmcu			= $find->num_rows();
										  	foreach ($find->result() as $row) {} 
									  	?>
                                        <div class="control-group">
                                          <label class="control-label" for="focusedInput">Client Name</label>
                                          <div class="controls">
                                           <input class="input-xlarge focused" name="client_name" value="<?=$row->client_name;?>" type="text" id="myText03" readonly autocomplete="off" >
                                           <input class="input-xlarge focused" name="id_client" value="<?=$row->id_client;?>" type="hidden">
                                          </div>
                                        </div>

										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Package MCU</label>
                                          <div class="controls">
											<input class="input-xlarge focused" name="package_name" value="<?=$row->package_name;?>" type="text" id="" readonly autocomplete="off" > 	
											<input class="input-xlarge focused" name="id_package" value="<?=$row->id_package;?>" type="hidden" > 	
                                          </div>
                                        </div>
										
                                     	<div class="control-group">
                                          <label class="control-label" for="focusedInput">Patient Charge Rule</label>
                                          <div class="controls">
											<input class="input-xlarge focused" name="tipeharga" value="<?=$row->price_type;?>" type="text" id="" readonly autocomplete="off" > 	
											<input class="input-xlarge focused" name="price_type" value="<?=$row->price_type;?>" type="hidden" > 	
                                          </div>
                                        </div>
										<?php 
										  	foreach ($ch_bill->result() as $row) {} 
									  	?>
									  	<div class="control-group">
                                          <label class="control-label" for="focusedInput">Charge Rule</label>
                                          <div class="controls">
											<input class="input-xlarge focused" name="tipeharga" value="<?=$row->price_type;?>" type="text" id="" readonly autocomplete="off" > 	
											<input class="input-xlarge focused" name="price_type" value="<?=$row->price_type;?>" type="hidden" > 	
                                          </div>
                                        </div>
                                      

						  				</div>
										<legend></legend>
										</div>
<?php
foreach ($bill->result() as $row) {}
?>
								                          
    <table class="table table-hover" id="jengkol">
			            <thead>
			            <tr>
			              <th>Number</th>
			              <th>Type</th>
			              <th><div align="center">...</div></th>
			              <th><div align="center">...</div></th>
			              <th><div align="right">Amount</div></th>
			            </tr>
			            </thead>          
			            <tbody>   
			           	<?php foreach ($kurs->result() as $row_kurs) {} ?>
			           	<tr class="odd gradeX">
			              <td>1</td>
			              <td>USD</td>
			              <td>
			              	<input class="input-xlarge-in focused" name="kurs" id="kurs" value="<?=number_format($row_kurs->amount,2);?>" style="width:145px; text-align:right" autocomplete="off" type="text" >
			              	<input class="input-xlarge-in focused" name="kursx" id="kursx" value="<?=$row_kurs->amount;?>" style="width:145px; text-align:right" type="hidden" >
			              </td>
			              <td>
			              	<div align="right">
			              	<input class="input-xlarge-in focused" name="usdy" id="usdy" value="0" style="width:145px; text-align:right" type="text" autocomplete="off" onkeyup="hitungan(); hitjumlah(<?=$tagihan;?>);" onclick="if(this.value==0) this.value='';" onblur="javascript: if(this.value==''){this.value=0;}" <?=$readonly;?> >
			              	</div>
			              </td>
			              <td>
			              	<div align="right">
			                <input class="input-xlarge-in focused" name="usd" id="usd" value="0" style="width:145px; text-align:right" type="text" autocomplete="off" readonly="on">
			                <input class="input-xlarge-in focused" name="usdx" id="usdx" value="0" style="width:145px; text-align:right" type="hidden">
			                </div>
			              </td>
			            </tr> 

						<tr class="odd gradeX">
			              <td>2</td>
			              <td>IDR</td>
			              <td></td>
			              <td></td>
			              <td>
			                <div align="right">
			                <input class="input-xlarge-in focused" name="idr" id="idr" value="0" style="width:145px; text-align:right" type="text"  autocomplete="off" onchange="hitungan(); hitjumlah(<?=$tagihan;?>);" onclick="if(this.value==0) this.value='';" onblur="javascript: if(this.value==''){this.value=0;}" <?=$readonly;?> >
			                <input class="input-xlarge-in focused" name="idrx" id="idrx" value="0" style="width:145px; text-align:right" type="hidden" >
			                </div>
			              </td>

			            </tr> 
			            <tr class="odd gradeX">
			              <td>3</td>
			              <td>Credit Card</td>
			              <td>
                            <select class="chzn-select" name="bank_cc" id="bank_cc"  >
                              <option value="0">- Choose Bank -</option>
                              <?php 
							  foreach($bank->result() as $rows){
							  ?>
							  <option align="justify" value="<?=$rows->id_bank?>"><?=$rows->bank_name?></option>
							  <?php
							  }
							  ?>
                            </select>
			              </td>
			              <td>
			              	<div align="right">
			                <input class="input-xlarge-in focused" name="nocc" id="nocc" placeholder="Card Number" style="width:145px; text-align:right" type="text" autocomplete="off" <?=$readonly;?> maxlength="16" >
			                </div>
						  </td>
			              <td>
			                <div align="right">
			                <input class="input-xlarge-in focused" name="cc" id="cc" value="0" style="width:145px; text-align:right" type="text"  autocomplete="off" onchange="hitungan(); hitjumlah(<?=$tagihan;?>);" onclick="if(this.value==0) this.value='';" onblur="javascript: if(this.value==''){this.value=0;}" <?=$readonly;?> >
			                <input class="input-xlarge-in focused" name="ccx" id="ccx" value="0" style="width:145px; text-align:right" type="hidden">
			                </div>
			              </td>

			            </tr> 
			            <tr class="odd gradeX">
			              <td>4</td>
			              <td>Debit Card</td>
			              <td>
			              	<select class="chzn-select" name="bank_dc" id="bank_dc"  >
                              <option value="0">- Choose Bank -</option>
                              <?php 
							  foreach($bank->result() as $rows){
							  ?>
							  <option align="justify" value="<?=$rows->id_bank?>"><?=$rows->bank_name?></option>
							  <?php
							  }
							  ?>
                            </select>
			              </td>
			              <td>
			              	<div align="right">
			                <input class="input-xlarge-in focused" name="nodc" id="nodc" placeholder="Card Number"  style="width:145px; text-align:right" type="text" autocomplete="off" <?=$readonly;?> maxlength="16" >
			                </div>
						  </td>
			              <td>
			                <div align="right">
			                <input class="input-xlarge-in focused" name="dc" id="dc" value="0" style="width:145px; text-align:right" type="text" autocomplete="off" onchange="hitungan(); hitjumlah(<?=$tagihan;?>);" onclick="if(this.value==0) this.value='';" onblur="javascript: if(this.value==''){this.value=0;}" <?=$readonly;?> >
			                <input class="input-xlarge-in focused" name="dcx" id="dcx" value="0" style="width:145px; text-align:right" type="hidden">
			                </div>
			              </td>
			              
			            </tr> 
			            <tr class="odd gradeX">
			              <td>5</td>
			              <td>Insurance</td>
			              <td>
			              	<select class="chzn-select" name="bank_ins" id="bank_ins"  >
                              <option value="0">- Choose Bank -</option>
                              <?php 
							  foreach($bank->result() as $rows){
							  ?>
							  <option align="justify" value="<?=$rows->id_bank?>"><?=$rows->bank_name?></option>
							  <?php
							  }
							  ?>
                            </select>
			              </td>
			              <td>
			              	<div align="right">
			                <input class="input-xlarge-in focused" name="noins" id="noins" placeholder="Polis Number"  style="width:145px; text-align:right" type="text" autocomplete="off" <?=$readonly_ins;?> maxlength="10" >
			                </div>
						  </td>
			              <td>
			                <div align="right">
			                <input class="input-xlarge-in focused" name="ins" id="ins" value="0" style="width:145px; text-align:right" type="text" autocomplete="off" onchange="hitungan(); hitjumlah(<?=$tagihan;?>);" onclick="if(this.value==0) this.value='';" onblur="javascript: if(this.value==''){this.value=0;}" <?=$readonly_ins;?> >
			                <input class="input-xlarge-in focused" name="insx" id="insx" value="0" style="width:145px; text-align:right" type="hidden">
			                </div>
			              </td>
			            </tr> 
			            
			            </tbody>
			            </table>

			            <table class="table table-bordered">
			                <tbody>
			                <tr class="odd gradeX">
			                	<td>
			                    	<div align="right"><b>Total Amount</b> 
			                    	<input class="input-xlarge-in focused" id="total" name="total" style="width:145px; text-align:right" type="text" autocomplete="off" readonly="on" value="0"> 
			                    	<input class="input-xlarge-in focused" id="jumlah" name="jumlah" style="width:145px; text-align:right" type="hidden" readonly="on" value="0"> 
			                    	</div>
			                  </td>
			                </tr>
			                <tr class="odd gradeX">
			                	<td>
			                		<div align="right"><b>Bill</b> <input class="input-xlarge-in focused" id="bill" name="bill" value="<?=number_format($tagihan,2);?>" style="width:145px; text-align:right" type="text" autocomplete="off" readonly="on"> <input class="input-xlarge-in focused" id="billx" name="billx" value="<?=$tagihan;?>" style="width:145px; text-align:right" type="hidden" readonly="on"> 
			                		</div>
			                	</td>
			                </tr>
			                <tr class="odd gradeX">
			                	<td>
			                		<div align="right"><b>Outstanding</b> <input class="input-xlarge-in focused" id="ots" name="ots" value="0" style="width:145px; text-align:right" type="text" autocomplete="off" readonly="on"> <input class="input-xlarge-in focused" id="outstanding" name="outstanding" value="0" style="width:145px; text-align:right" type="hidden" readonly="on"> 
			                		</div>
			                	</td>
			                </tr>
			            </tbody></table>
							
							<div class="form-actions">
							<button type="submit" class="btn btn-success" name="simpan" value="save" />Save</button>
                            </div>
        					</form>

										<legend></legend>
									</fieldset>     
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
		<!--/.fluid-container-->
       <!--/.fluid-container-->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

        <link href="<?php echo base_url();?>design/vendors/datepicker.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url();?>design/vendors/uniform.default.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url();?>design/vendors/chosen.min.css" rel="stylesheet" media="screen">
		
        <link href="<?php echo base_url();?>design/vendors/wysiwyg/bootstrap-wysihtml5.css" rel="stylesheet" media="screen">
		
        <script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>design/vendors/jquery.uniform.min.js"></script>
        <script src="<?php echo base_url();?>design/vendors/chosen.jquery.min.js"></script>
        <script src="<?php echo base_url();?>design/vendors/bootstrap-datepicker.js"></script>
		
        <script src="<?php echo base_url();?>design/vendors/wysiwyg/wysihtml5.js"></script>
        <script src="<?php echo base_url();?>design/vendors/wysiwyg/bootstrap-wysihtml5.js"></script>
        <script src="<?php echo base_url();?>design/vendors/wizard/jquery.bootstrap.wizard.min.js"></script>
		
		<script type="text/javascript" src="<?php echo base_url();?>design/vendors/jquery-validation/dist/jquery.validate.min.js"></script>
		<script src="<?php echo base_url();?>design/assets/form-validation.js"></script>
		
		<script src="<?php echo base_url();?>design/assets/scripts.js"></script>
		<script>
		function popup(b_id){
			var myWindow = window.open("<?php echo base_url();?>patient/data_patient", "", "width=1350px, height=500px, top=70, left=2.5");
		}
		
		function newclient(b_id){
			var myWindow = window.open("<?php echo base_url();?>client/add_client", "", "width=1200px, height=500px, top=70, left=80");
		}
		
		function popup_s(id){
			var myWindow = window.open("<?php echo base_url();?>patient/find_patient_data", "", "width=1200px, height=500px, top=70, left=70");
		}
		
		function popup_camera(id){
			var myWindow = window.open("<?php echo base_url();?>registration/add_camera/"+id+"", "", "width=950px, height=500px, top=70, left=80");
		}
		
		function finger(id){
			var myWindow = window.open("<?php echo base_url();?>registration/add_fingerid/"+id+"", "", "width=1200px, height=500px, top=70, left=80");
			
			// window.open("<?php echo base_url();?>registration/add_fingerid/"+id+"","Popup","height=800px,width=700px,scrollbars=1,"+ 
                        // "directories=1,location=1,menubar=1," + 
                        //  "resizable=1 status=1,history=1 top = 50 left = 100");
		}

		function showapp(){
			window.open("<?php echo base_url();?>Registration/reg_app","Popup","height=800px,width=700px,scrollbars=1,"+ 
                        "directories=1,location=1,menubar=1," + 
                         "resizable=1 status=1,history=1 top=50 left = 100");
		}
		</script>
		<script>
		jQuery(document).ready(function() {   
		FormValidation.init();
		});

		$(function() {
		$(".datepicker").datepicker();
		$(".uniform_on").uniform();
		$(".chzn-select").chosen();
		$('.textarea').wysihtml5();
		});
		</script>
</html>