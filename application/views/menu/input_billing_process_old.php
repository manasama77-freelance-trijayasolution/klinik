	
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

	function undisableTxt(){
		document.getElementById("myText123").disabled = false;
	}
	  
	function goBack(){
	 	window.history.back();
	}
	
	function loadtotalamount(val){
        var sum = 0;

	   	if (val == 1) {

	    	var cost 			= document.getElementsByName('amount_total[]');
			var result 			= document.getElementById('benerbenergrand');
	    	var amount_total 	= document.getElementById('jumlah');
	    	var disc 			= document.getElementById('disc').value;
		    var disc2 			= document.getElementById('totdisc1');
		    var jmldisc 		= document.getElementById('jmldisc1');
		    var total 			= document.getElementById('total');
		    var sumtot 			= document.getElementById('sumtot1');
		    var sumharga		= document.getElementById('sumharga1');
		    var hasil 			= document.getElementById('totdisc1').value.replace(",","");
		    
		};
		if (val == 2) {

	    	var cost		= document.getElementsByName('amount_total2[]');
			var result 		= document.getElementById('benerbenergrand2');
		    var disc 		= document.getElementById('discb').value;
		    var disc2 		= document.getElementById('totdisc2');
		    var jmldisc 	= document.getElementById('jmldisc2');
		    var total 		= document.getElementById('total2');
		    var sumtot		= document.getElementById('sumtot2');
		    var sumharga	= document.getElementById('sumharga2');
		    var hasil		= document.getElementById('totdisc2').value.replace(",","");

		};
		if (val == 3) {

	    	var cost		= document.getElementsByName('amount_total3[]');
			var result 		= document.getElementById('benerbenergrand3');
		    var disc 		= document.getElementById('discc').value;
		    var disc2 		= document.getElementById('totdisc3');
		    var jmldisc 	= document.getElementById('jmldisc3');
		    var total 		= document.getElementById('total3');
		    var sumtot		= document.getElementById('sumtot3');
		    var sumharga	= document.getElementById('sumharga3');
		    var hasil		= document.getElementById('totdisc3').value.replace(",","");

		};

	    for (var i = 0; i < cost.length; i++){
	        sum += parseFloat(cost[i].value);
	    }

	    sumharga.value		= parseFloat(sum);
		jmldisc.value		= parseFloat(hasil.replace(",","").replace(",","").replace(",","").replace(",",""));
	    result.value 		= accounting.formatMoney(sum);
	    sumtot.value		= sum - hasil;
	    total.value			= accounting.formatMoney(sum - hasil);
	}

	function hitungdisc(val){
		var sum = 0;

	   	if (val == 1) {

	    	var cost 			= document.getElementsByName('amount_total[]');
			var result 			= document.getElementById('benerbenergrand');
		    var amount_total 	= document.getElementById('jumlah');
		    var disc 			= document.getElementById('disc').value;
		    var disc2 			= document.getElementById('totdisc1');
		    var jmldisc 		= document.getElementById('jmldisc1');
		    var total 			= document.getElementById('total');
		    var sumtot			= document.getElementById('sumtot1');

		};
		if (val == 2) {

	    	var cost 			= document.getElementsByName('amount_total2[]');
			var result 			= document.getElementById('benerbenergrand2');
		    var amount_total 	= document.getElementById('jumlah2');
		    var disc 			= document.getElementById('discb').value;
		    var disc2 			= document.getElementById('totdisc2');
		    var jmldisc 		= document.getElementById('jmldisc2');
		    var total 			= document.getElementById('total2');
		    var sumtot			= document.getElementById('sumtot2');

		};
		if (val == 3) {

	    	var cost 			= document.getElementsByName('amount_total3[]');
			var result 			= document.getElementById('benerbenergrand3');
		    var amount_total 	= document.getElementById('jumlah3');
		    var disc 			= document.getElementById('discc').value;
		    var disc2 			= document.getElementById('totdisc3');
		    var jmldisc 		= document.getElementById('jmldisc3');
		    var total 			= document.getElementById('total3');
		    var sumtot			= document.getElementById('sumtot3');
		    
		};
	   
	    for (var i = 0; i < cost.length; i++) {
	        sum += parseFloat(cost[i].value);
	    }
	    // console.log(sum);

	    var hasil 			= sum * (disc/100);
		jmldisc.value		= hasil;
	    result.value 		= accounting.formatMoney(sum);
	    disc2.value 		= accounting.formatMoney(hasil);
	    total.value			= accounting.formatMoney(sum - hasil);
	    sumtot.value		= sum - hasil;
	}

	function hitungpersen(val){
		var sum = 0;

	   	if (val == 1) {

	    	var cost 			= document.getElementsByName('amount_total[]');
		    var result 			= document.getElementById('benerbenergrand');
		    var amount_total 	= document.getElementById('jumlah');
		    var disc 			= document.getElementById('disc').value;
		    var disc_3 			= document.getElementById('disc');
		    var disc2 			= document.getElementById('totdisc1').value;
		    var teler 			= document.getElementById('totdisc1');
		    var jmldisc 		= document.getElementById('jmldisc1');
		    var total 			= document.getElementById('total');
		    var sumtot			= document.getElementById('sumtot1');

		};
		if (val == 2) {

	    	var cost 			= document.getElementsByName('amount_total2[]');
			var result 			= document.getElementById('benerbenergrand2');
		    var amount_total 	= document.getElementById('jumlah2');
		    var disc 			= document.getElementById('discb').value;
		    var disc_3 			= document.getElementById('discb');
		    var disc2 			= document.getElementById('totdisc2').value;
		    var teler 			= document.getElementById('totdisc2');
		    var jmldisc 		= document.getElementById('jmldisc2');
		    var total 			= document.getElementById('total2');
		    var sumtot			= document.getElementById('sumtot2');

		};
		if (val == 3) {

	    	var cost 			= document.getElementsByName('amount_total3[]');
			var result 			= document.getElementById('benerbenergrand3');
		    var amount_total 	= document.getElementById('jumlah3');
		    var disc 			= document.getElementById('discc').value;
		    var disc_3 			= document.getElementById('discc');
		    var disc2 			= document.getElementById('totdisc3').value;
		    var teler 			= document.getElementById('totdisc3');
		    var jmldisc 		= document.getElementById('jmldisc3');
		    var total 			= document.getElementById('total3');
		    var sumtot			= document.getElementById('sumtot3');
		    
		};

	    for (var i = 0; i < cost.length; i++) {
	        sum += parseFloat(cost[i].value);
	    }

	    jmldisc.value		= disc2;
		disc_3.value  		= Math.ceil(disc2/sum*100);
	    result.value 		= accounting.formatMoney(sum);
	    total.value			= accounting.formatMoney(sum - disc2);
	    sumtot.value		= sum - disc2;	    
	    teler.value			= accounting.formatMoney(disc2);
	}



	function resetbill(){
	 	if (window.confirm('Are you sure, want Reset Billing ?')) {
	 		if (window.confirm('If you Reset billing cant back again, make sure you Reset  ?')) {
				if (window.confirm('Please, Make sure there is correct selections  ?')) {
        			return true; 	
        		}else{ return false;  }
			}else{ return false;  }	    	
		}else{ return false;  }	    	
	}

	
	function UpgradeBilling(id_bh,id_price_type) { 
      if (window.confirm('Are you sure, want Change Rule this Billing ?')){
			if (window.confirm('If you split billing cant back again, make sure you split  ?')) {
				if (window.confirm('Please, Make sure there is correct selections  ?')) {
	         			window.location.href = ("<?php echo base_url();?>cashier/upgrade_billing/"+id_bh+"/"+id_price_type+"");
			         }else{
			        	return false; 	
			         }

	         }else{
	        	return false; 	
	         }
	     }else{
	        return false;
	     }
	}

	function SplitBilling(id_bh,id_price_type,split){
		 if (window.confirm('Are you sure, want split Billing ?')){
 			if (window.confirm('If you split billing cant back again, make sure you split  ?')) {
 				if (window.confirm('Please, Make sure there is correct selections  ?')) {
					    var cost = document.getElementsByName('foo[]');
					    for (var i = 0; i < cost.length; i++){
					    	if (cost[i].checked){
						        var id_bd = cost[i].value;
								var http = new XMLHttpRequest();
							    http.open("POST", "<?php echo base_url();?>cashier/split_billing", true);
							    http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
							    var params = "params=" + id_bd +","+ id_price_type+","+ split+","+ id_bh;  
							    http.send(params);
							    // http.onload = function() {
							    //     alert(http.responseText);
							    // }
					    	}
					    }
					    alert("Data has been updated please check again !");
					    alert("Please Refresh if split not correct !!");
					    location.reload();
					    location.reload();
				}else{ return false;  }
			}else{ return false;  }	    	
		}else{ return false;  }

	}

	function add_other(id_reg,id_split,id_billing){
		window.open("<?php echo base_url();?>cashier/bill_other/"+id_reg+"/"+id_split+"/"+id_billing+"","","height=600, width=1500, top=70, left=180 ");
	}

	function BukaHarga(){
    	
    	var price 		= document.getElementsByName('price[]');
    	var price2 		= document.getElementsByName('price2[]');
    	var price3 		= document.getElementsByName('price3[]');

		for (var i = 0; i < price.length; i++){
	        price[i].readOnly = false;
	    }

		for (var i = 0; i < price2.length; i++){
	        price2[i].readOnly = false;
	    }

		for (var i = 0; i < price3.length; i++){
	        price3[i].readOnly = false;
	    }

		document.getElementById('simpanharga').disabled = true;
		document.getElementById('ubahharga').disabled = false;


	}

	function UbahHarga(val){
		
		var sum = 0;

	   	if (val == 1) {

	   		var price 			= document.getElementsByName('price[]');
	    	var cost 			= document.getElementsByName('amount_total[]');
		    var result 			= document.getElementById('benerbenergrand');
		    var amount_total 	= document.getElementById('jumlah');
		    var disc 			= document.getElementById('disc').value;
		    var disc_3 			= document.getElementById('disc');
		    var disc2 			= document.getElementById('totdisc1').value;
		    var teler 			= document.getElementById('totdisc1');
		    var jmldisc 		= document.getElementById('jmldisc1');
		    var total 			= document.getElementById('total');
		    var sumharga		= document.getElementById('sumharga1');
		    var sumtot			= document.getElementById('sumtot1');
		    var hasil 			= document.getElementById('totdisc1').value.replace(",","");

		};
		if (val == 2) {

	    	var price 			= document.getElementsByName('price2[]');
	    	var cost			= document.getElementsByName('amount_total2[]');
			var result 			= document.getElementById('benerbenergrand2');
		    var amount_total 	= document.getElementById('jumlah2');
		    var disc 			= document.getElementById('discb').value;
		    var disc_3 			= document.getElementById('discb');
		    var disc2 			= document.getElementById('totdisc2').value;
		    var teler 			= document.getElementById('totdisc2');
		    var jmldisc 		= document.getElementById('jmldisc2');
		    var total 			= document.getElementById('total2');
		    var sumharga		= document.getElementById('sumharga2');
		    var sumtot			= document.getElementById('sumtot2');
		    var hasil 			= document.getElementById('totdisc2').value.replace(",","");

		};
		if (val == 3) {

	    	var price 			= document.getElementsByName('price3[]');
	    	var cost			= document.getElementsByName('amount_total3[]');
			var result 			= document.getElementById('benerbenergrand3');
		    var amount_total 	= document.getElementById('jumlah3');
		    var disc 			= document.getElementById('discc').value;
		    var disc_3 			= document.getElementById('discc');
		    var disc2 			= document.getElementById('totdisc3').value;
		    var teler 			= document.getElementById('totdisc3');
		    var jmldisc 		= document.getElementById('jmldisc3');
		    var total 			= document.getElementById('total3');
		    var sumharga		= document.getElementById('sumharga3');
		    var sumtot			= document.getElementById('sumtot3');
		    var hasil 			= document.getElementById('totdisc3').value.replace(",","");
		    
		};

		for (var i = 0; i < price.length; i++){
	        cost[i].value = parseFloat(price[i].value.replace(",","").replace(",","").replace(",","").replace(",",""));
	    }

	    for (var a = 0; a < cost.length; a++) {
	        sum += parseFloat(cost[a].value);
	    }

	    sumharga.value		= parseFloat(sum);
		jmldisc.value		= parseFloat(hasil.replace(",","").replace(",","").replace(",","").replace(",",""));
	    result.value 		= accounting.formatMoney(sum);
	    sumtot.value		= sum - hasil;
	    total.value			= accounting.formatMoney(sum - hasil);

	    for (var d = 0; d < price.length; d++){
	        price[d].value = accounting.formatMoney(cost[d].value);
	    }
	    
	}

	</script>
                    <!-- morris stacked chart -->
                    <div class="row-fluid" onmouseover="loadtotalamount(1);loadtotalamount(2);loadtotalamount(3);">
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><b>Billing</b></div>
                            <div class="muted pull-right" id="txt" style="font-weight: bold;"></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                	<form class="form-horizontal" name="uguu" id="uguu" onsubmit="return confirm('Do you really want to submit the form?');" method="post" action="<?php echo base_url();?>cashier/save_bill" >
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
                                          <label class="control-label" for="focusedInput">Patient Name</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="pat_name" value="<?=$pat_name;?>" type="text" id="myText02" readonly autocomplete="off" required>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Age</label>
                                          <div class="controls">
											<input class="input-xlarge focused" name="age" value="<?=$age;?>" type="text" id="" readonly autocomplete="off" required> 	
                                          </div>
                                        </div>		

									  </div>
									  <!-- BAGIAN KANAN -->
									  <div style="width:50%; float:right;">
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


						  				</div>
										<legend></legend>
										</div>

				  									                          
				<?php 

					
					$bill_date1 = date("m/d/Y",strtotime($bill_date1)); 
					$bill_date2 = date("m/d/Y",strtotime($bill_date2)); 
					$bill_date3 = date("m/d/Y",strtotime($bill_date3));
					// Tampilkan jumlah split
					foreach($get_max_split_trx_bd->result() as $rowsd){
						$split_trxbd 	= $rowsd->split;
					}

					// Tampilakan semua data pada registration
					foreach($giant->result() as $rows){
						$id_bh 				= $rows->id_bh;
						$id_reg_bh 			= $rows->id_reg;
						$disc 				= $rows->disc;
						$grand_total 		= $rows->grand_total;
						$tax 				= $rows->tax;
						$other_charge 		= $rows->other_charge;
						$status 			= $rows->status;
						$create_by 			= $rows->create_by;
						$create_date 		= $rows->create_date;
					}
					
					// Tampilkan Order Type pada billing..
					foreach($get_order_type->result() as $rowx){
						$split				= $rowx->split;
						$type_charge_rule	= $rowx->type_charge_rule;
						$price_type			= $rowx->price_type;
					}
						$countxx			= $get_order_type->num_rows();
				?>

				<div id="rootwizard">
				    <div class="navbar">
				      <div class="navbar-inner">
				        <div class="container">
				    <ul class="nav nav-pills">
				    	<?php 
				    	$nomor		=1;
				    	$active		="active";
				    	foreach($get_order_type->result() as $rowx){ 
				    		
				    		$split				= $rowx->split;
							$type_charge_rule	= $rowx->type_charge_rule;	
							$price_type			= $rowx->price_type;		
				    		
				    		if ($nomor > 1) {
				    			$active		="";
				    		}

				    	?>
				        <li class="<?php echo $active;?>" onclick="loadtotalamount(<?php echo $nomor;?>);"><a href="#tab<?php echo $nomor;?>" data-toggle="tab">Billing <?php echo $nomor;?></a></li>
				        <?php $nomor=$nomor+1; 
				    	} 

				    	foreach($get_order_type_urut->result() as $rowx){ 
				    		
				    		$split				= $rowx->split;
							$type_charge_rule	= $rowx->type_charge_rule;	
							$price_type			= $rowx->price_type;	

				    	}

				    	?>
				    </ul>
				     </div>
				      </div>
				    </div>
				    
				    <div class="tab-content">
					<div class="tab-pane active" id="tab1" onmouseover="loadtotalamount(1);">
			              <fieldset>
			               
			                 <div class="control-group">
			                <label class="control-label" for="focusedInput">Change Rule</label>
			                <div class="controls">
			              <input class="input-xlarge focused" name="price_type1" value="<?php echo $price_type;?>" type="text" id="price_type1" readonly >  
			              

			              <?php if ($status == 0) { ?>
			              <!-- Hanya dapat diubah ketika status tidak lagi menjadi 0 -->
			                  <div class="btn-group">
			                <button class="btn btn-primary">Change</button>
			                <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle"><span class="caret"></span></button>
			                <ul class="dropdown-menu">
			                <?php 
			                $nomor =1;
			                foreach($get_charge_rule->result() as $rows){
			                ?>
			                <li><a href="javascript:void(0);" onclick="UpgradeBilling(<?php echo $id_bh;?>,<?=$rows->id_price_type;?>);"><?=$rows->price_type?></a></li>
			                <?php } ?>
			                </ul>
			              </div>
			              <?php } ?> 
			              

						<?php 
						if ($status <> 4) { 
							if ($split_trxbd  == 1) { 
						?>
			              <div class="btn-group">
			                <button type="submit" class="btn btn-warning">Split</button>
			                <button data-toggle="dropdown" class="btn btn-warning dropdown-toggle"><span class="caret"></span></button>
			                <ul class="dropdown-menu">
			                <?php 
			                $nomor =1;

			                foreach($get_charge_rule->result() as $rows){
			                ?>
			                <li><a href="javascript:void(0);" onclick="SplitBilling(<?php echo $id_bh;?>,<?=$rows->id_price_type;?>,<?php echo $split_trxbd;?>);"><?=$rows->price_type?></a></li>
			                <?php } ?>
			                </ul>
			              </div>
			            <?php } 
			        			} ?> 

			              <input class="input-xlarge focused" name="id_package" value="<?=$id_package;?>" type="hidden" >
			                </div>
			              </div>

			            <div class="control-group">
			            <label class="control-label" for="focusedInput">Billing Number</label>
			            <div class="controls">
			              <input class="input-xlarge focused" name="bill_no1" value="<?=$bill_no1;?>" type="text" id="bill_no1" readonly >  
			              <input class="input-xlarge focused" name="id_billing1" value="<?=$id_billing1;?>" type="hidden" id="id_billing1" readonly >  
			            </div>
			           	</div>

			            <div class="control-group">
			            <label class="control-label" for="focusedInput">Billing Date</label>
			            <div class="controls">
			            <input class="input-xlarge datepicker" id="3" name="bill_date1" id="bill_date1" value="<?=$bill_date1?>" type="text" autocomplete="off" required=""> <i class="icon-calendar"></i> 
			            </div>
			           	</div>
						
						<?php if ($status_bh == 4) {
							  if ($userlevel == 'master' || $userlevel == 'supervisor') { 
						?>
			           	<div style="float:right;">
						<button type="button" class="btn btn-success" name="update" id="openharga" Onclick="BukaHarga();" value="save" />Open</button>
						</div>
						<?php } } ?>

			            <table class="table table-hover" id="jengkol">
			            <thead>
			            <tr>
			              <th>Number</th>
			              <th>Group Name</th>
			              <th></th>
			              <th>Service Name</th>
			              <th><div align="right">Amount</div></th>
			            </tr>
			            </thead>          
			            <tbody>   
			            <?php
			              $nomor 	= 1;
			              foreach ($get_billing_mcu_list->result() as $row) {
			            ?>
			            <tr class="odd gradeX">
			              <td><?php echo $nomor;?></td>
			              <td>Medical Check Up</td>
			              <!-- <td><input type="checkbox" id="myCheck<?php echo $nomor;?>" name="foo[]" style="width:15px; height:15px;"></td> -->
			              <td></td>
			              <td><?=$row->package_name;?></td>
			              <td>
			                <div align="right">
			                <input class="input-xlarge-in focused" name="price[]" onchange="UbahHarga(1);" value="<?=number_format($row->grand_total,2);?>" style="width:145px; text-align:right" type="text" readonly>
			                <input class="input-xlarge-in focused"  name="amount_total[]" id="1"  style="width:145px; text-align:right" type="hidden" value="<?=$row->grand_total;?>" />
			                </div>
			              </td>

			            </tr> 

			            <?php 
			              $nomor=$nomor+1;
			              }
			              
			              foreach ($fisik_billing->result() as $row_fisik) { 
			            ?>


			            <tr class="odd gradeX">
			              <td><?php echo $nomor;?></td>
			              <td>Fisik</td>
			              <td><input type="checkbox" id="myCheck<?php echo $nomor;?>" name="foo[]" value="<?=$row_fisik->id_bd?>" style="width:15px; height:15px;"></td>
			              <td><?=$row_fisik->serv_name;?></td>
			              <td>
			                <div align="right">
			                <input class="input-xlarge-in focused" name="price[]" id="2" onchange="UbahHarga(1);"  style="width:145px; text-align:right" type="text" readonly value="<?=number_format($row_fisik->harga,2);?>" />
			                <input class="input-xlarge-in focused" name="amount_total[]" value="<?=$row_fisik->harga;?>" type="hidden">
			                </div>
			              </td>

			            </tr> 
			            <?php 
			            $nomor=$nomor+1;
			            }   
			              foreach ($lab_billing->result() as $row_lab) { 
			            ?>
			            <tr class="odd gradeX">
			              <td><?php echo $nomor;?></td>
			              <td>Lab</td>
			              <td><input type="checkbox" id="myCheck<?php echo $nomor;?>" value="<?=$row_lab->id_bd?>" name="foo[]" style="width:15px; height:15px;"></td>
			              <td><?=$row_lab->serv_name;?></td>
			              <td>
			                <div align="right">
			                <input class="input-xlarge-in focused"  name="price[]" onchange="UbahHarga(1);" value="<?=number_format($row_lab->harga,2);?>" style="width:145px; text-align:right" type="text" readonly>
			                <input class="input-xlarge-in focused"  name="amount_total[]" value="<?=$row_lab->harga;?>" type="hidden" >
			                </div>
			              </td>

			            </tr> 
			            <?php 
			            $nomor=$nomor+1;
			            } 
			              foreach ($rad_billing->result() as $row_rad) { 
			            ?>
			            <tr class="odd gradeX">
			              <td><?php echo $nomor;?></td>
			              <td>Radiology</td>
			              <td><input type="checkbox" id="myCheck<?php echo $nomor;?>" name="foo[]" value="<?=$row_rad->id_bd?>" style="width:15px; height:15px;"></td>
			              <td><?=$row_rad->serv_name;?></td>
			              <td>
			                <div align="right">
			                <INPUT class="input-xlarge-in focused" name="price[]" onchange="UbahHarga(1);" value="<?=number_format($row_rad->harga,2);?>" style="width:145px; text-align:right" type="text" readonly>
			                <INPUT class="input-xlarge-in focused" name="amount_total[]" value="<?=$row_rad->harga;?>"  type="hidden" >
			                </div>
			              </td>
			              
			            </tr> 
			            <?php 
			            $nomor=$nomor+1;
			            } 
			              foreach ($pharmacy->result() as $row_pharmacy) { 
			            ?>
			            <tr class="odd gradeX">
			              <td><?php echo $nomor;?></td>
			              <td>Pharmacy</td>
			              <td><input type="checkbox" id="myCheck<?php echo $nomor;?>" name="foo[]" value="<?=$row_pharmacy->id_bd?>" style="width:15px; height:15px;"></td>
			              <td><?=$row_pharmacy->serv_name;?> x <?=$row_pharmacy->drug_qty;?> </td>
			              <td>
			                <div align="right">
			                <INPUT class="input-xlarge-in focused" name="price[]" onchange="UbahHarga(1);" value="<?=number_format($row_pharmacy->harga,2);?>" style="width:145px; text-align:right" type="text" readonly>
			                <INPUT class="input-xlarge-in focused" name="amount_total[]" value="<?=$row_pharmacy->harga;?>"  type="hidden" >
			                </div>
			              </td>
			              
			            </tr> 
			            <?php $nomor=$nomor+1; }    
			            foreach ($lain->result() as $row_lain) { 
			            ?>
			            <tr class="odd gradeX">
			              <td><?php echo $nomor;?></td>
			              <td>Other</td>
			              <td></td>
			              <td><?=$row_lain->serv_name;?></td>
			              <td>
			                <div align="right">
			                <INPUT class="input-xlarge-in focused" name="price[]" onchange="UbahHarga(1);" value="<?=number_format($row_lain->harga,2);?>" style="width:145px; text-align:right" type="text" readonly>
			                <INPUT class="input-xlarge-in focused" name="amount_total[]" value="<?=$row_lain->harga;?>"  type="hidden" >
			                </div>
			              </td>
			              
			            </tr> 
			            <?php $nomor=$nomor+1; } 
			            foreach ($other->result() as $row_other) { 
			            ?>
			            <tr class="odd gradeX">
			              <td><?php echo $nomor;?></td>
			              <td>Other</td>
			              <td></td>
			              <td><?=$row_other->name_service;?></td>
			              <td>
			                <div align="right">
			                <INPUT class="input-xlarge-in focused" name="price[]" onchange="UbahHarga(1);" value="<?=number_format($row_other->price,2);?>" style="width:145px; text-align:right" type="text" readonly>
			                <INPUT class="input-xlarge-in focused" name="amount_total[]" value="<?=$row_other->price;?>"  type="hidden" >
			                </div>
			              </td>
			              
			            </tr> 
			            <?php $nomor=$nomor+1; } ?>

			            </tbody>
			            </table>
			            
			            <div class="control-group">
			            <button type="button" onclick="add_other(<?php echo $id_reg; ?>,1,<?=$id_billing1;?>);" class="btn btn-success" name="simpan" value="save">Add Other Charge</button>
			        	</div>


			            <table class="table table-bordered">
			                <tr class="odd gradeX">
			                  <td>
			                    <div align="right"><b>Total Amount</b> 
			                    <input class="input-xlarge-in focused"  id="benerbenergrand"  name="grand_total" style="width:145px; text-align:right" type="text" readonly> <input class="input-xlarge-in focused"  id="sumharga1"  name="sumharga1" style="width:145px; text-align:right" type="hidden" > 
			                    </div>
			                  </td>
			                </tr>
			                <tr class="odd gradeX">
			                <td><div align="right"><b>Disc</b> <input id="disc" name="disc" type="number" max="100" min="0"value="0" style="width:40px" onkeyup="hitungdisc(1);" onclick="if(this.value==0) this.value='';" onblur="javascript: if(this.value==''){this.value=0;}"/> % <input id="totdisc1" name="totdisc1" class="input-xlarge-i focused" type="text" style="width:145px; text-align:right" value="0" onchange="hitungpersen(1);"  onclick="if(this.value==0) this.value='';" onblur="javascript: if(this.value==''){this.value=0;}"/> <input class="input-xlarge-i focused" style="width:145px; text-align:right" id="jmldisc1" name="jmldisc1" type="hidden" value="0"/> </div></td>
			                </tr> 
			                <tr class="odd gradeX">
			                <td><div align="right"><b>Grand Total</b> <input class="input-xlarge-in focused" id="total"  name="amount_grand" value="0" style="width:145px; text-align:right" type="text" readonly> <input class="input-xlarge-in focused" id="sumtot1"  name="sumtot1" value="0" style="width:145px; text-align:right" type="hidden" > </div></td>
			                </tr>
			            </table>

			            <!-- TUTUP -->

			              </fieldset>
			        </div>

			        <?php
			        if ($split_trxbd > 1) {
			        	foreach($get_order_type_urut2->result() as $rowx){ 
				    		
				    		$split				= $rowx->split;
							$type_charge_rule	= $rowx->type_charge_rule;	
							$price_type			= $rowx->price_type;	

				    	}
					?>
					<div class="tab-pane" id="tab2" onmouseover="loadtotalamount(2);">
			              <fieldset>
			               
			              <!-- BUKA  -->
			                 <div class="control-group">
			                <label class="control-label" for="focusedInput">Change Rule</label>
			                <div class="controls">
			              <input class="input-xlarge focused" name="package_name" value="<?php echo $price_type;?>" type="text" id="package_name" readonly >  
			              
			            <?php if ($split_trxbd  == 2) { ?>
			              <div class="btn-group">
			                <button type="submit" class="btn btn-warning">Split</button>
			                <button data-toggle="dropdown" class="btn btn-warning dropdown-toggle"><span class="caret"></span></button>
			                <ul class="dropdown-menu">
			                <?php 
			                $nomor =1;
			                foreach($get_charge_rule->result() as $rows){
			                ?>
			                <li><a href="javascript:void(0);" onclick="SplitBilling(<?php echo $id_bh;?>,<?=$rows->id_price_type;?>,<?php echo $split_trxbd;?>);"><?=$rows->price_type?></a></li>
			                <?php } ?>
			                </ul>
			              </div>
			            <?php } ?> 

			              <input class="input-xlarge focused" name="id_package" value="<?=$id_package;?>" type="hidden" >   
			                </div>
			              </div>

			            <div class="control-group">
			            <label class="control-label" for="focusedInput">Billing Number</label>
			            <div class="controls">
			              <input class="input-xlarge focused" name="bill_no2" value="<?=$bill_no2;?>" type="text" id="price_type1" readonly >  <input class="input-xlarge focused" name="id_billing2" value="<?=$id_billing2;?>" type="hidden" id="id_billing2" readonly >  
			            </div>
			           	</div>

			            <div class="control-group">
			            <label class="control-label" for="focusedInput">Billing Date</label>
			            <div class="controls">
			            <input class="input-xlarge datepicker" id="3" name="bill_date2" value="<?=$bill_date2?>" type="text" autocomplete="off" required=""> <i class="icon-calendar"></i> 
			            </div>
			           	</div>
						
						<?php if ($status_bh == 4) {
							  if ($userlevel == 'master' || $userlevel == 'supervisor') { 
						?>
			           	<div style="float:right;">
						<button type="button" class="btn btn-success" name="update" id="openharga" Onclick="BukaHarga();" value="save" />Open</button>
						</div>
						<?php } } ?>

			              <table class="table table-hover" id="jengkol">
			            <thead>
			            <tr>
			              <th>Number</th>
			              <th>Group Name</th>
			              <th></th>
			              <th>Service Name</th>
			              <th><div align="right">Amount</div></th>
			            </tr>
			            </thead>          
			            <tbody>   
			          	<?php
			              $nomor 	= 1;
			              foreach ($fisik_billing2->result() as $row_fisik) { 
			            ?>


			            <tr class="odd gradeX">
			              <td><?php echo $nomor;?></td>
			              <td>Fisik</td>
			              <td><input type="checkbox" id="myCheck<?php echo $nomor;?>" name="foo[]" value="<?=$row_fisik->id_bd?>" style="width:15px; height:15px;"></td>
			              <td><?=$row_fisik->serv_name;?></td>
			              <td>
			                <div align="right">
			                <INPUT class="input-xlarge-in focused" name="price2[]" id="2" onchange="UbahHarga(2);" value="<?=number_format($row_fisik->harga,2);?>" style="width:145px; text-align:right" type="text" readonly>
			                <INPUT class="input-xlarge-in focused" name="amount_total2[]" value="<?=$row_fisik->harga;?>" type="hidden">
			                </div>
			              </td>

			            </tr> 
			            <?php 
			            $nomor=$nomor+1;
			            }   
			              foreach ($lab_billing2->result() as $row_lab) { 
			            ?>
			            <tr class="odd gradeX">
			              <td><?php echo $nomor;?></td>
			              <td>Lab</td>
			              <td><input type="checkbox" id="myCheck<?php echo $nomor;?>" value="<?=$row_lab->id_bd?>" name="foo[]" style="width:15px; height:15px;"></td>
			              <td><?=$row_lab->serv_name;?></td>
			              <td>
			                <div align="right">
			                <INPUT class="input-xlarge-in focused"  name="price2[]"  onchange="UbahHarga(2);" value="<?=number_format($row_lab->harga,2);?>" style="width:145px; text-align:right" type="text" readonly>
			                <INPUT class="input-xlarge-in focused"  name="amount_total2[]" value="<?=$row_lab->harga;?>" type="hidden" >
			                </div>
			              </td>

			            </tr> 
			            <?php 
			            $nomor=$nomor+1;
			            } 
			              foreach ($rad_billing2->result() as $row_rad) { 
			            ?>
			            <tr class="odd gradeX">
			              <td><?php echo $nomor;?></td>
			              <td>Radiology <?=$row_rad->id_bd?></td>
			              <td><input type="checkbox" id="myCheck<?php echo $nomor;?>" name="foo[]" value="<?=$row_rad->id_bd?>" style="width:15px; height:15px;"></td>
			              <td><?=$row_rad->serv_name;?></td>
			              <td>
			                <div align="right">
			                <INPUT class="input-xlarge-in focused" name="price2[]"  onchange="UbahHarga(2);" value="<?=number_format($row_rad->harga,2);?>" style="width:145px; text-align:right" type="text" readonly>
			                <INPUT class="input-xlarge-in focused" name="amount_total2[]" value="<?=$row_rad->harga;?>"  type="hidden" >
			                </div>
			              </td>
			              
			            </tr> 
			            <?php 
			            $nomor=$nomor+1;
			            } 
			              foreach ($pharmacy2->result() as $row_pharmacy) { 
			            ?>
			            <tr class="odd gradeX">
			              <td><?php echo $nomor;?></td>
			              <td>Pharmacy</td>
			              <td><input type="checkbox" id="myCheck<?php echo $nomor;?>" name="foo[]" value="<?=$row_pharmacy->id_bd?>" style="width:15px; height:15px;"></td>
			              <td><?=$row_pharmacy->serv_name;?></td>
			              <td>
			                <div align="right">
			                <INPUT class="input-xlarge-in focused" name="price2[]"  onchange="UbahHarga(2);" value="<?=number_format($row_pharmacy->harga,2);?>" style="width:145px; text-align:right" type="text" readonly>
			                <INPUT class="input-xlarge-in focused" name="amount_total2[]" value="<?=$row_pharmacy->harga;?>"  type="hidden" >
			                </div>
			              </td>
			              
			            </tr> 
			            <?php $nomor=$nomor+1; } 
			              foreach ($lain2->result() as $row_lain) { 
			            ?>
			            <tr class="odd gradeX">
			              <td><?php echo $nomor;?></td>
			              <td>Other</td>
			              <td></td>
			              <td><?=$row_lain->serv_name;?></td>
			              <td>
			                <div align="right">
			                <INPUT class="input-xlarge-in focused" name="price2[]"  onchange="UbahHarga(2);" value="<?=number_format($row_lain->harga,2);?>" style="width:145px; text-align:right" type="text" readonly>
			                <INPUT class="input-xlarge-in focused" name="amount_total2[]" value="<?=$row_lain->harga;?>"  type="hidden" >
			                </div>
			              </td>
			              
			            </tr> 
			               <?php $nomor=$nomor+1; } 
			            foreach ($other2->result() as $row_other) { 
			            ?>
			            <tr class="odd gradeX">
			              <td><?php echo $nomor;?></td>
			              <td>Other</td>
			              <td></td>
			              <td><?=$row_other->name_service;?></td>
			              <td>
			                <div align="right">
			                <INPUT class="input-xlarge-in focused" name="price2[]"  onchange="UbahHarga(2);" value="<?=number_format($row_other->price,2);?>" style="width:145px; text-align:right" type="text" readonly>
			                <INPUT class="input-xlarge-in focused" name="amount_total2[]" value="<?=$row_other->price;?>"  type="hidden" >
			                </div>
			              </td>
			              
			            </tr> 
			            <?php $nomor=$nomor+1; } ?>

			            </tbody>
			            </table>

			            <div class="control-group">
			            <button type="button" onclick="add_other(<?php echo $id_reg; ?>,2,<?=$id_billing2;?>);" class="btn btn-success" name="simpan" value="save">Add Other Charge</button>
			        	</div>

			            <table class="table table-bordered">
			                <tr class="odd gradeX">
			                  <td>
			                    <div align="right"><b>Total Amount</b> 
			                    <input class="input-xlarge-in focused"  id="benerbenergrand2"  name="grand_total2" style="width:145px; text-align:right" type="text" readonly> <input class="input-xlarge-in focused"  id="sumharga2"  name="sumharga2" style="width:145px; text-align:right" type="hidden" > 
			                    </div>
			                  </td>
			                </tr>
			                <tr class="odd gradeX">
			                <td><div align="right"><b>Disc</b> <input id="discb" name="discb" type="number" max="100" min="0" value="0" style="width:40px" onkeyup="hitungdisc(2);" onclick="if(this.value==0) this.value='';" onblur="javascript: if(this.value==''){this.value=0;}"/> % <input id="totdisc2" name="totdisc2" class="input-xlarge-i focused" type="text" style="width:145px; text-align:right" value="0"  onchange="hitungpersen(2);" onclick="if(this.value==0) this.value='';" onblur="javascript: if(this.value==''){this.value=0;}"/> <input class="input-xlarge-i focused" style="width:145px; text-align:right" id="jmldisc2" name="jmldisc2" type="hidden" value="0"/> </div></td>
			                </tr>
			                <tr class="odd gradeX">
			                <td><div align="right"><b>Grand Total</b> <INPUT class="input-xlarge-in focused" id="total2"  name="amount_grand" value="0" style="width:145px; text-align:right" type="text" readonly> <input class="input-xlarge-in focused" id="sumtot2"  name="sumtot2" value="0" style="width:145px; text-align:right" type="hidden" ></div></td>
			                </tr>
			            </table>

			            <!-- TUTUP -->



			              </fieldset>
			        </div>

					<?php
			        	if ($split_trxbd > 2) {
							foreach($get_order_type_urut3->result() as $rowx){ 
				    		
				    		$split				= $rowx->split;
							$type_charge_rule	= $rowx->type_charge_rule;	
							$price_type			= $rowx->price_type;	

				    		}
					?>
					<div class="tab-pane" id="tab3" onmouseover="loadtotalamount(3);">
			              <fieldset>
			               
			              <!-- BUKA  -->
			                 <div class="control-group">
			                <label class="control-label" for="focusedInput">Change Rule</label>
			                <div class="controls">
			              <input class="input-xlarge focused" name="package_name" value="<?php echo $price_type;?>" type="text" id="package_name" readonly >  

			              <input class="input-xlarge focused" name="id_package" value="<?=$id_package;?>" type="hidden" >   
			                </div>
			              </div>

			            <div class="control-group">
			            <label class="control-label" for="focusedInput">Billing Number</label>
			            <div class="controls">
			              <input class="input-xlarge focused" name="bill_no3" value="<?=$bill_no3;?>" type="text" id="bill_no3" readonly >  <input class="input-xlarge focused" name="id_billing3" value="<?=$id_billing3;?>" type="hidden" id="id_billing3" readonly >  
			            </div>
			           	</div>

			            <div class="control-group">
			            <label class="control-label" for="focusedInput">Billing Date</label>
			            <div class="controls">
			            <input class="input-xlarge datepicker" id="3" name="bill_date3" value="<?=$bill_date3?>" type="text" autocomplete="off" required=""> <i class="icon-calendar"></i> 
			            </div>
			           	</div>
						
						<?php if ($status_bh == 4) {
							  if ($userlevel == 'master' || $userlevel == 'supervisor') { 
						?>
			           	<div style="float:right;">
						<button type="button" class="btn btn-success" name="update" id="openharga" Onclick="BukaHarga();" value="save" />Open</button>
						</div>
						<?php } } ?>

			              <table class="table table-hover" id="jengkol">
			            <thead>
			            <tr>
			              <th>Number</th>
			              <th>Group Name</th>
			              <th></th>
			              <th>Service Name</th>
			              <th><div align="right">Amount</div></th>
			            </tr>
			            </thead>          
			            <tbody>   
			          	<?php
			              foreach ($fisik_billing3->result() as $row_fisik) { 
			            ?>


			            <tr class="odd gradeX">
			              <td><?php echo $nomor;?></td>
			              <td>Fisik</td>
			              <td><input type="checkbox" id="myCheck<?php echo $nomor;?>" name="foo[]" value="<?=$row_fisik->id_bd?>" style="width:15px; height:15px;"></td>
			              <td><?=$row_fisik->serv_name;?></td>
			              <td>
			                <div align="right">
			                <INPUT class="input-xlarge-in focused" name="price3[]" id="2" onchange="UbahHarga(3);" value="<?=number_format($row_fisik->harga,2);?>" style="width:145px; text-align:right" type="text" readonly>
			                <INPUT class="input-xlarge-in focused" name="amount_total3[]" value="<?=$row_fisik->harga;?>" type="hidden">
			                </div>
			              </td>

			            </tr> 
			            <?php 
			            $nomor=$nomor+1;
			            }   
			              foreach ($lab_billing3->result() as $row_lab) { 
			            ?>
			            <tr class="odd gradeX">
			              <td><?php echo $nomor;?></td>
			              <td>Lab</td>
			              <td><input type="checkbox" id="myCheck<?php echo $nomor;?>" value="<?=$row_lab->id_bd?>" name="foo[]" style="width:15px; height:15px;"></td>
			              <td><?=$row_lab->serv_name;?></td>
			              <td>
			                <div align="right">
			                <INPUT class="input-xlarge-in focused"  name="price3[]"  onchange="UbahHarga(3);" value="<?=number_format($row_lab->harga,2);?>" style="width:145px; text-align:right" type="text" readonly>
			                <INPUT class="input-xlarge-in focused"  name="amount_total3[]" value="<?=$row_lab->harga;?>" type="hidden" >
			                </div>
			              </td>

			            </tr> 
			            <?php 
			            $nomor=$nomor+1;
			            } 
			              foreach ($rad_billing3->result() as $row_rad) { 
			            ?>
			            <tr class="odd gradeX">
			              <td><?php echo $nomor;?></td>
			              <td>Radiology</td>
			              <td><input type="checkbox" id="myCheck<?php echo $nomor;?>" name="foo[]" value="<?=$row_rad->id_bd?>" style="width:15px; height:15px;"></td>
			              <td><?=$row_rad->serv_name;?></td>
			              <td>
			                <div align="right">
			                <INPUT class="input-xlarge-in focused" name="price3[]" onchange="UbahHarga(3);" value="<?=number_format($row_rad->harga,2);?>" style="width:145px; text-align:right" type="text" readonly>
			                <INPUT class="input-xlarge-in focused" name="amount_total3[]" value="<?=$row_rad->harga;?>"  type="hidden" >
			                </div>
			              </td>
			              
			            </tr> 
			            <?php 
			            $nomor=$nomor+1;
			            } 
			              foreach ($pharmacy3->result() as $row_pharmacy) { 
			            ?>
			            <tr class="odd gradeX">
			              <td><?php echo $nomor;?></td>
			              <td>Pharmacy</td>
			              <td><input type="checkbox" id="myCheck<?php echo $nomor;?>" name="foo[]" value="<?=$row_pharmacy->id_bd?>" style="width:15px; height:15px;"></td>
			              <td><?=$row_pharmacy->serv_name;?></td>
			              <td>
			                <div align="right">
			                <INPUT class="input-xlarge-in focused" name="price3[]" onchange="UbahHarga(3);" value="<?=number_format($row_pharmacy->harga,2);?>" style="width:145px; text-align:right" type="text" readonly>
			                <INPUT class="input-xlarge-in focused" name="amount_total3[]" value="<?=$row_pharmacy->harga;?>"  type="hidden" >
			                </div>
			              </td>
			              
			            </tr> 
			            <?php $nomor=$nomor+1; } 
			               foreach ($lain3->result() as $row_lain) { 
			            ?>
			            <tr class="odd gradeX">
			              <td><?php echo $nomor;?></td>
			              <td>Other</td>
			              <td></td>
			              <td><?=$row_lain->serv_name;?></td>
			              <td>
			                <div align="right">
			                <INPUT class="input-xlarge-in focused" name="price3[]" onchange="UbahHarga(3);" value="<?=number_format($row_lain->harga,2);?>" style="width:145px; text-align:right" type="text" readonly>
			                <INPUT class="input-xlarge-in focused" name="amount_total3[]" value="<?=$row_lain->harga;?>"  type="hidden" >
			                </div>
			              </td>
			              
			            </tr> 
			               <?php $nomor=$nomor+1; } 
			            foreach ($other3->result() as $row_other) { 
			            ?>
			            <tr class="odd gradeX">
			              <td><?php echo $nomor;?></td>
			              <td>Other</td>
			              <td></td>
			              <td><?=$row_other->name_service;?></td>
			              <td>
			                <div align="right">
			                <INPUT class="input-xlarge-in focused" name="price[]" value="<?=number_format($row_other->price,2);?>" style="width:145px; text-align:right" type="text" readonly>
			                <INPUT class="input-xlarge-in focused" name="amount_total[]" value="<?=$row_other->price;?>"  type="hidden" >
			                </div>
			              </td>
			              
			            </tr> 
			            <?php $nomor=$nomor+1; } ?>

			            </tbody>
			            </table>
			            
			            <div class="control-group">
			            <button type="button" onclick="add_other(<?php echo $id_reg; ?>,3,<?=$id_billing3;?>);" class="btn btn-success" name="simpan" value="save">Add Other Charge</button>
			        	</div>

			            <table class="table table-bordered">
			                <tr class="odd gradeX">
			                  <td>
			                    <div align="right"><b>Total Amount</b> 
			                    <input class="input-xlarge-in focused"  id="benerbenergrand3"  name="grand_total3" style="width:145px; text-align:right" type="text" readonly> <input class="input-xlarge-in focused"  id="sumharga3"  name="sumharga3" style="width:145px; text-align:right" type="hidden" > 
			                    </div>
			                  </td>
			                </tr>
			                <tr class="odd gradeX">
			                <td><div align="right"><b>Disc</b> <input id="discc" name="discc" type="number" max="100" min="0"value="0" style="width:40px" onkeyup="hitungdisc(3);" onclick="if(this.value==0) this.value='';" onblur="javascript: if(this.value==''){this.value=0;}"/> % <input id="totdisc3" name="totdisc3" class="input-xlarge-i focused" type="text" style="width:145px; text-align:right" value="0" onchange="hitungpersen(3);" onclick="if(this.value==0) this.value='';" onblur="javascript: if(this.value==''){this.value=0;}"/> <input class="input-xlarge-i focused" style="width:145px; text-align:right" id="jmldisc3" name="jmldisc3" type="hidden" value="0"/> </div></td>
			                </tr>
			                <tr class="odd gradeX">
			                <td><div align="right"><b>Grand Total</b> <INPUT class="input-xlarge-in focused" id="total3"  name="amount_grand" value="0" style="width:145px; text-align:right" type="text" readonly> <input class="input-xlarge-in focused" id="sumtot3"  name="sumtot3" value="0" style="width:145px; text-align:right" type="hidden" > </div></td>
			                </tr>
			            </table>

			            <!-- TUTUP -->



			              </fieldset>
			        </div>
					<?php

						}
			        }
			        ?>
									<div class="form-actions">
									<button type="submit" class="btn btn-success" name="simpan" id="simpanharga" Onclick="payment();" value="save" />Save</button>
									<button type="submit" class="btn btn-success" name="simpan" id="ubahharga" Onclick="payment();" value="update" disabled />Update</button>
                                    </div>
        					</form>


<?php if ($userlevel == 'master' || $userlevel == 'supervisor') { ?>
<form method="POST" action="<?php echo base_url();?>cashier/reset_billing" onsubmit="resetbill();">
	<div class="control-group">
	<label class="control-label" for="focusedInput"><b> NOTE : </b></label>	
	<div class="controls">
	Reset Billing akan mengubah ulang semua billing dari no registrasi <?=$id_reg;?> dan tidak dapat dikembalikan lagi, mohon dapat memastikan kembali jika ingin reset. Dan jika ada billing yang sudah dibayar mohon dapat diingat agar dapat dibuatkan yang sama dan dilakukan pembayaran kembali !
	</div>
	</div>
	
	<div class="control-group">
	<label class="control-label" for="focusedInput">Reset Reason :</label>
	<div class="controls">
	<textarea name="alasan" id="alasan" required=""></textarea>
	<input name="id_reg" type="hidden" value="<?=$id_reg;?>" autocomplete="off" >
	</div>
	</div>

	<div class="form-actions">
	<!-- <button type="button" Onclick="resetbill(<?=$id_reg;?>);" class="btn btn-danger" name="simpan" value="reset">Reset Billing</button> -->
	<button type="submit" class="btn btn-danger" name="simpan" value="reset">Reset Billing</button>
	</div>
</form>
<?php } ?>        					
  
</div>
  

										

										<legend></legend>
									</fieldset>     
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
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