	<?php
		$id = $this->uri->segment(3);
		if ($id=="ok"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Input Client
		</div>
	<?php
		} else if ($id=="add") {
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Add Client
	    </div>
	<?php
		} else if ($id=="upd") {
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Update Client
	    </div>
	<?php
		} else if ($id=="del") {
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Delete Client
		</div>
	<?php
		}
	?>		
<script>
	  function undisableTxt() {
		<?php
			$x = 1; 
			while($x <= 12) {
			echo "document.getElementById('".$x."').disabled = false;";
			$x++;
			} 
		?>
	  }
	  
	  function goBack() {
	  	window.history.back();
	  }

	function closeit(){
		// cara mendapatkan uri segment di javascript
		document.getElementById("sysparam").submit();
		var url 		= $(location).attr('href').split("/").splice(0, 10).join("/");
		var segments 	= url.split( '/' );
		var action 		= segments[3];
		var id 			= segments[7];
		alert (id);
		// var mystr = val;
		// var myarr 	= mystr.split(":");
		// var obat	= myarr[2]+" "+myarr[1];
		// var obat	= myarr[1]+" Day";
		// alert(obat);
		var skey 		= document.getElementById("3").value;
		var lvalue 		= document.getElementById("4").value;
		alert (skey);
		window.opener.document.getElementById("dept"+id+"").options[1] = new Option(lvalue,skey);
		document.getElementById("dept"+id+"").options[1].selected = true;
		// window.opener.document.forms['mst_client'].elements['dept'+id+''].value=skey;
		window.close(this);
	}	

</script>
<?php
	include './design/koneksi/file.php';
	$query 		="SELECT id_Client id,cast(left(id_Client,4) as decimal) dt FROM mst_client ORDER BY id_Client DESC LIMIT 1";  
    if($result 	=mysqli_query($con, $query))
    {
        $row 	=mysqli_fetch_assoc($result);
        $count 	=$row['id'];
		$count = $count+1; 	
        $code_no = str_pad($count, 0, "0", STR_PAD_LEFT);
    }
?>
                    <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
								<div class="muted pull-left"><b>Add Parameter <?=$isi;?> </b></div>
                            </div>
							<div class="form-actions">
								<button onclick="undisableTxt()" class="btn btn-primary">Start</button>   
								<button class="btn btn-warning" onclick="goBack()">Back</button>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                      <fieldset>
																			 
										<form id="sysparam" class="form-horizontal" action="<?php echo base_url();?>master/save_add_new_sysparam2" method="post" name="sysparam" >		
									
										
										<input class="input-xlarge focused" name="sgroup" type="hidden" id="1" value="<?=$isi;?>" readonly>
										<input class="input-xlarge focused" name="sgroup2" type="hidden" id="2" value="<?=$isi;?>" readonly>
																		
										<div style="float:left;">
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">sgroup</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="sgroupxx" type="text" value="<?=$isi;?>" disabled >
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">skey</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="skey" type="text" id="3" value="<?=$jml;?>" disabled autocomplete="off" required>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">svalue</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="svalue" type="text" id="4" disabled autocomplete="off" required>
                                          </div>
                                        </div>																				
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">lvalue</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="lvalue" type="text" id="5" disabled autocomplete="off" required>
                                          </div>
                                        </div>																				
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">remark</label>
                                          <div class="controls">
                                            <textarea name="remark" id="6" disabled autocomplete="off" required></textarea>
                                          </div>
                                        </div>
										</div>

									</fieldset>                     						
                                </div>
                            </div>
								<div class="form-actions">
								<input type="submit" class="btn btn-success" value="Submit" onclick="closeit();">
                                </div>
                        </div>
									</form>
                        
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
</html>