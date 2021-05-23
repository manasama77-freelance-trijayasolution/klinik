				<?php
			    $id 					 = $this->uri->segment(3);
					
				//function convertCurrency($from, $to){
				//$url = 'http://finance.yahoo.com/d/quotes.csv?e=.csv&f=sl1d1t1&s='. $from . $to .'=X';
				//$handle = fopen($url, 'r');
			
				//if ($handle) {
				//	$result = fgets($handle, 4096);
				//	fclose($handle);
				//}
			
				//$allData = explode(',',$result); 
				//$currencyValue = $allData[1];
				//return number_format(round($currencyValue, 3),2);}
				?>
                <div class="row-fluid">
                        <!-- block -->
						<form action="<?php echo base_url();?>marketing/save_curr" method="post" name="mst_service">
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><b>Currency</b></div>
                            </div>
							<?php
							$angka = $data->num_rows();
							?>
							<script>
							var counter_ant 	= <?=$angka+1;?>;
							var limit_ant	 	= 5;
							function addInput(divName){
								if (counter_ant == limit_ant)  {
									alert("Sorry, Limit Maximum!");
								}
								else {
									var newdiv = document.createElement('div');
									newdiv.innerHTML = "<input type='text' style='text-align:right; width: 65px;' onchange='setBlurFocus("+counter_ant+");' class='input-xlarge-i focused' name='price_"+counter_ant+"' id='"+counter_ant+"b' autocomplete='off'> <select class='chzn-select' name='curr_type_"+counter_ant+"' id='curr' style='width: 168px;' required><option value=''>- Choose Currency -</option><option value='USD'>USD</option><option value='JPY'>JPY</option></select> <input type='hidden' name='count_ant' value='"+counter_ant+"'>";
									document.getElementById(divName).appendChild(newdiv);
									counter_ant++;
								}
							}
							</script>
                            <div class="block-content collapse in">
                                <div class="span12">                                   
  								<div class="controls">
								<input type="hidden" name="count_ant" value="<?=$angka;?>">
								 <?php
									$i=1;
									$b=1;
									$c=1;
									$d=1;
									$e=1;
									$select_usd="";
									$select_jpy="";
									$select_sgd="";
									$select_aud="";
									$select_cny="";
									
									foreach($data->result() as $row){
										if ($row->code == "USD"){ $select_usd="selected"; }
								 ?>
								 <input class="input-xlarge-i focused" name="price_<?=$i++;?>" value="<?php echo number_format($row->amount,2);?>" onchange="setBlurFocus(<?=$c++;?>);" type="text" id="<?=$b++;?>b" autocomplete="off" style="text-align:right; width: 65px;">
									
								 <input type="text" style="display: none;" value="<?php echo number_format($row->amount,2);?>" name="cocok_<?=$d++;?>">
								 <input type="hidden" value="<?php echo $row->id_currency ;?>" name="id_<?=$e++;?>">
								 <select class="chzn-select" name="curr_type_1" id="curr" style="width: 168px;" required>
								  <option value="">- Choose Currency -</option>
								  <option <?=$select_usd;?> value="USD">USD</option>
								  <option <?=$select_jpy;?> value="JPY">JPY</option>
                                 </select>
								 <font color="red" size="0.8em"><b><i><?=$row->updated_date;?></i><b></font>
								 </br>
								 <?php	
									}
								 ?>
								 <div id="dynamicInput">
								 </div>
								 <input style="width:220px;" class="btn btn-info btn-mini" id="butt" type="button" value="Add Foreign Currency" onClick="addInput('dynamicInput');">	
								 <input style="width:150px;" class="btn btn-success btn-mini" type="submit" value="Save"></br>		
								 <font color="blue" size="0.8em"><b><i>Source Foreign Currency : Bank Indonesia</i><b></font>
								</div>
                                </div>
                            </div>
                        </div>
						</form>
                        <!-- /block -->
                    </div>				
		<script src="<?php echo base_url();?>design/assets/acc.js"></script>
		<script type="text/javascript">
		function setBlurFocus(id) {
		var user_input = accounting.formatMoney(document.getElementById(id+'b').value);
		document.getElementById(id+'b').value = user_input;
		}
		</script>
        <script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>
		<link href="<?php echo base_url();?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
        <script src="<?php echo base_url();?>design/assets/scripts.js"></script>
        <script src="<?php echo base_url();?>design/assets/DT_bootstrap.js"></script>