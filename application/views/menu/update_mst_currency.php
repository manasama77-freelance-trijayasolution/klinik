	<?php
		$id = $this->uri->segment(3);
		if ($id=="ok"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Input Master Currency
		</div>
	<?php
		} else if ($id=="change") {
	?>
		<div class="alert alert-info">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Update Master Currency
	    </div>
	<?php
		} else if ($id=="del") {
	?>
		<div class="alert alert-info">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Delete Master Currency
		</div>
	<?php
		}
		//Logic Parameter Button
		if ($id=="ok"){
			$id="0";
		}elseif ($id==""){
			$id="1";
		}elseif ($id=="edit"){
			$id="2";
		}else{
			$id=$id;
		}
	?>		
	<script>
	  function undisableTxt(){
		  if (0 == <?=$id;?>) {
		window.location.href = "<?php echo base_url();?>Lab/mst_lab_group";
		};
		    
		<?php
			$x = 1; 
			while($x <= 7) {
			echo "document.getElementById('".$x."').disabled = false;";
			echo "document.getElementById('".$x."').required = true;";
			$x++;
			}	
		?>
	  }
	  
	  function goBack(){
	  	window.history.back();
	  }  
	  

    function update_currency(id){
		window.open("<?php echo base_url();?>marketing/update_mst_currency/"+id+"","Popup","height=610, width=980, top=50, left=210 ");
    }


      function delete_currency(id){
  		var r = confirm("Are You Sure Want Delete  ?");
		if (r == true) {
			// x = window.location = "<?php echo base_url();?>marketing/delete_currency/"+id+"";
			$.post("delete_currency/"+id+"", $("#console").serialize()); // silent delete..
			document.getElementById("del"+id+"").disabled = true;
		} else {
			x = "You pressed Cancel!";
		}
      }

	</script>
                    <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><b>Master Lab Group</b></div>
                            </div>
								<div class="form-actions">
								 <button onclick="undisableTxt()" class="btn btn-primary">Start</button>
								</div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                      <fieldset>
										<form class="form-horizontal" action="<?php echo base_url();?>marketing/proses_update_mst_currency" method="post" name="mst_service">
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Date</label>
                                          <div class="controls">
                                          	<input type="hidden" name="id_currency" value="<?=$id_currency;?>">
											<input type="text" name="tanggal" class="input-large datepicker" id="reg_date" value="<?=$create_date;?>" readonly><readonly button class="btn-mini tooltip-right" data-original-title="Date of Registration adalah tanggal kunjungan pasien pada hari ini, namun bisa disesuaikan tanggalnya."><i class="icon-question-sign"></i></button>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Value</label>
                                          <div class="controls">
										  <input class="input-xlarge focused" name="nilai" type="text" id="1" value="<?=$amount;?>" autocomplete="off" disabled>
                                          </div>
                                        </div>

                                        <?php
                                        $x = "";
                                        $y = "";
                                        if ($code == "USD") {
                                        	$x = "selected";
                                        }else{
                                        	$y = "selected";
                                        }
                                        ?>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Type</label>
                                          <div class="controls">
                                            <select class="chzn-select" name="tipe" id="2" disabled >
											  <option value="">- Choose Currency -</option>
											  <option value="USD" <?php echo $x;?> >USD</option>
											  <option value="JPY" <?php echo $y;?> >JPY</option>
			                                 </select>
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
												<input type="submit" class="btn btn-success" id="3" value="Save">
												<a data-dismiss="modal" class="btn btn-warning" href="#">Close</a>
											</div>
										</div>
									
										<div class="form-actions">
										<a href="#myAlert" data-toggle="modal" class="btn btn-success"><b>Submit</b></a>
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
        <script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>
		<link href="<?php echo base_url();?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
        <script src="<?php echo base_url();?>design/assets/scripts.js"></script>
        <script src="<?php echo base_url();?>design/assets/DT_bootstrap.js"></script>