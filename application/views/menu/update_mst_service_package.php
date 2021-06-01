				<?php
				$id = $this->uri->segment(3);
				if ($id=="ok"){
				?>
			    <div class="alert alert-success">
					 <button class="close" data-dismiss="alert">&times;</button>
					 <strong>Success!</strong> Update Services Package
				</div>
				<?php
				} else if ($id=="add") {
				?>
			    <div class="alert alert-success">
					 <button class="close" data-dismiss="alert">&times;</button>
					 <strong>Success!</strong> Add New User
				</div>
				<?php
				} else if ($id=="del") {
				?>
			    <div class="alert alert-success">
					 <button class="close" data-dismiss="alert">&times;</button>
					 <strong>Success!</strong> Delete User
				</div>
				<?php
				}
			
				
				$row_cnt = $data->num_rows();
				$dataarray = array();
				foreach($detail->result() as $rowd){
					$dataarray['id_service'][$rowd->id_service] = $rowd->id_service;
				}
					// echo $dataarray['id_service']; 

					


				foreach($list->result() as $rowx){}
				?>		
	<script src="<?php echo base_url();?>design/assets/acc_2.js"></script>
	<script>
	  function undisableTxt() {
			document.getElementById("0").disabled = false;
			document.getElementById("1").disabled = false;
			document.getElementById("2").disabled = true;
			document.getElementById("3").disabled = false;
			document.getElementById("4").disabled = false;
			document.getElementById("5").disabled = false;
	  }
	  
	  function goBack() {
	  	window.history.back();
	  }
	  
      function addRow(tableID) {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;
            var row = table.insertRow(rowCount);
            var cell1 = row.insertCell(0);
			cell1.innerHTML = rowCount + 1-1;        
            var cell2 = row.insertCell(1);
			cell2.innerHTML = "<input type='text' name='service["+cell1.innerHTML+"]'>";
 
			var cell3 = row.insertCell(2);
			cell3.innerHTML = "<input type='text' name='price["+cell1.innerHTML+"]' id='qty' required>";
 
            var cell4 = row.insertCell(3);
		    cell4.innerHTML = "<a href='#.' onclick='popup("+cell1.innerHTML+");'><li><i class='icon-search'></i></li></a>";
			
		    var cell5 = row.insertCell(4);
			cell5.innerHTML = "<input type='hidden' name='id["+cell1.innerHTML+"]'>";
			
			var cell6 = row.insertCell(5);
			cell6.innerHTML = "<input type='hidden' name='rowcount' value='"+cell1.innerHTML+"'>";
			
			var cell7 = row.insertCell(6);
			cell7.innerHTML = "<input type='hidden' name='seq["+cell1.innerHTML+"]'>";
        }
 
        function deleteRow(tableID) {
            try {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;
 
            for(var i=2; i<rowCount; i++) {
                var row = table.rows[i];
                var butt = row.cells[3].childNodes[0];
                if(null != butt ) {
                    table.deleteRow(i);
                    rowCount--;
                    i--;
                }
            }
            }catch(e) {
                alert(e);
            }
        }
		
		function popup(b_id){
            window.open("find_services/"+b_id+"","Popup","height=auto,width=auto,scrollbars=yes,"+ 
                        "directories=yes,location=yes,menubar=yes," + 
                         "resizable=yes,status=yes,history=yes,top=50,left=100");
            }
			
	function checkTotal(val) {
		var mystr = val;
		//alert (mystr);
		document.quotation.p_pbase.value = '';
		var sum = 0;
		for (i=0;i<<?=$row_cnt;?>;i++) {
		  if (document.quotation.choice[i].checked) {
		  	sum = sum+parseFloat(document.quotation.choice[i].value);
			//alert(sum);	
		  }
		}
		document.quotation.p_pbase_2.value 	= accounting.formatMoney(sum);
		document.quotation.p_pbase.value 	= sum;
		
	}


		$(document).ready(function() {
		  $(window).keydown(function(event){
		    if(event.keyCode == 13) {
		      event.preventDefault();
		      return false;
		    }
		  });
		});
		
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
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><b>Form Update Service Package</b></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                      <fieldset>
										 <div class="form-actions">
										 <button onclick="undisableTxt()" class="btn btn-primary">Start</button>										 
										 <button class="btn btn-warning" onclick="goBack()">Back</button>
										 </div>
										 
										<form class="form-horizontal" action="<?php echo base_url();?>marketing/progress_update_mst_service_package" method="post" name="quotation">
                                        
										<div class="control-group">
                                          <label class="control-label" for="focusedInput"></label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" type="hidden" name="id_package" type="text" value="<?=$rowx->id_package?>" autocomplete="off" required>
                                          </div>
                                        </div>

										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Package Name</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="p_name" type="text" id="1" value="<?=$rowx->package_name?>" disabled autocomplete="off" required>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Package Price Base</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="p_pbase_2" id="2" value="Rp. <?=number_format($rowx->package_price_base)?>" disabled autocomplete="off" required type="text">
											<input type="hidden" name="p_pbase" value="<?=$rowx->package_price_base?>">
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Package Price Standart</label>
                                          <div class="controls">
                                            <input class="input-xlarge-i focused" name="p_pstandart" id="3" type="text" style="text-align:right" autocomplete="off" value="<?=$rowx->package_price_std?>" disabled>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Package Price Japan</label>
                                          <div class="controls">
                                            <input class="input-xlarge-i focused" name="p_pjapan" type="text" id="4" value="<?=$rowx->package_price_jpn?>" style="text-align:right" autocomplete="off" disabled>
                                          </div>
                                        </div>
							
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Package Price Company</label>
                                          <div class="controls">
                                            <input class="input-xlarge-i focused" name="p_pcompany" type="text" value="<?=$rowx->package_price_comp?>" id="5" style="text-align:right" autocomplete="off" disabled>
                                          </div>
                                        </div>
										
										<div class="row-fluid">
										<!-- block -->
										<div class="block">
												<div class="navbar navbar-inner block-header">
													<div class="muted pull-left"><b>Service Package</b></div>
												</div>
												<div class="block-content collapse in">
													<div class="span12">
														<table class="table table-hover table-bordered" id="example3">
															<thead>
																<tr>
																	<th>No</th>
																	<th>Group Name</th>
																	<th>Services</th>
																	<th>Price</th>
																	<th>Action</th>
																</tr>
															</thead>
															<tbody>
															<?php
															$x=1;
															$i=1;
															$current_cat = null;															
															?>
															<?php
															foreach($data->result() as $row){
																if (in_array($row->id_service, $dataarray['id_service']))
																  {
																	$checked = "checked";
																  }
																else
																  {
																	$checked = "";
																  }

																  // echo $checked;
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
																	<td><?php echo $row->serv_name;?></td>
																	<td>Rp. <?php echo number_format($row->serv_price_comp,2);?></td>
																	<td>
																	<input type="checkbox" <?=$checked;?> style="width:20px; height:20px;" name="serv[<?=$x++;?>]" id="choice" value="<?=$row->serv_price_comp;?>:<?=$row->id_service;?>:<?=$row->serv_seq_no;?>:<?=$row->order_id;?>:<?=$row->KET;?>:<?=$row->group_name;?>" onchange="checkTotal(<?=$row->serv_price_comp;?>)" ></td>
																</tr>
															<?php
															}
															?>
															</tbody>
														</table>
														<input type="hidden" name="rowC" value="<?=$row_cnt;?>">
													</div>
												</div>
											</div>
										<!-- /block -->
										</div>
										<div class="form-actions">
										<input type="submit" class="btn" value="Update" id="0" disabled>
                                        </div>
									<legend></legend>
									</form>
									</fieldset>                          							
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
		<!--/.fluid-container-->
<!--/.fluid-container-->
        <script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>
		<link href="<?php echo base_url();?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
        <script src="<?php echo base_url();?>design/assets/scripts.js"></script>
        <script src="<?php echo base_url();?>design/assets/DT_bootstrap.js"></script>

</html>