<?php
$tipe_1 		= 0;
$tipe_2 		= 0;
$tipe_3 		= 0;
$tipe_5 		= 0;
$ket 			= 0;
$id_price_1		= 0;
$id_price_2		= 0;
$id_price_3		= 0;
$id_price_4		= 0;

		// print_r($price_type_arr); echo "<br>";
		// print_r($price_arr); echo "<br>";
		// print_r($id_price_arr); echo "<br>";
		// echo $jml_arr; echo "<br>";
		// exit();	

if ($jml_arr > 0) {
	$ket 			= 1;
	for ($i=0; $i < $jml_arr; $i++) { 
		if ($price_type_arr[$i] == 1) {$tipe_1 =$price_arr[$i]; $id_price_1 =$id_price_arr[$i];}
		if ($price_type_arr[$i] == 2) {$tipe_2 =$price_arr[$i]; $id_price_2 =$id_price_arr[$i];}
		if ($price_type_arr[$i] == 3) {$tipe_3 =$price_arr[$i]; $id_price_3 =$id_price_arr[$i];}
		if ($price_type_arr[$i] == 5) {$tipe_5 =$price_arr[$i]; $id_price_4 =$id_price_arr[$i];}
	}
}
?>	
	<script>

	    function undisableTxt(){
		 
		<?php
			$x = 4; 
			while($x <= 8) {
			echo "document.getElementById('".$x."').disabled = false;";
			$x++;
			}	
			$y = 4; 
			while($y <= 7) {
			echo "document.getElementById('".$y."b').disabled = false;";
			$y++;
			}	
		?>
	  }
	 
	  function goBack(){
	  	window.history.back();
	  }
	  function popup_2(){
        window.open("<?php echo base_url();?>patient/find_lab","Popup","height=550, width=880, top=70, left=250 ");
      }
	  function popup_3(){
        window.open("<?php echo base_url();?>patient/find_radiology","Popup","height=550, width=880, top=70, left=250 ");
      }
	  function list_service(){
		window.open("<?php echo base_url();?>marketing/list_service","Popup","height=550, width=880, top=70, left=250 ");
	  }
	  function fetch_select(val){
		$.ajax({
			type: 'post',
			url: 'fetch_item',
			data: {
			get_option:val
			},
			success: function (response) {
			document.getElementById("new_select").innerHTML=response; 
			}
		});
	  }
	</script>
	<script src="<?php echo base_url();?>design/assets/acc.js"></script>
	<script type="text/javascript">
	function setBlurFocus(id) {
		var tampil 		= document.getElementById(id+'b');
		var bayangan	= document.getElementById(id);
		bayangan.value	= tampil.value;

		var user_input 	= accounting.formatMoney(document.getElementById(id+'b').value);
		document.getElementById(id+'b').value = user_input;


	}
	</script>
                    <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><b>Master Item Price</b></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                    <fieldset>
									<div class="form-actions">
									<button onclick="undisableTxt()" class="btn btn-primary"><i class="icon-th"></i> Start</button>
									</div>
									<form class="form-horizontal" action="<?php echo base_url();?>inv/save_mst_items_price3" method="post" name="mst_service">
                                 
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Items Name</label>
                                          <div class="controls">
                                          <select  class="chzn-select" name="id_item" id="2"  required>
                                              <option value="">- Choose -</option>
                                              <?php 
											  foreach($item_all->result() as $rows){
											  ?>
											  <option value="<?=$rows->id_item?>" <?php if ($id == $rows->id_item) { echo "selected"; }?> align="justify"><?=$rows->item_name?></option>
											  <?php
											  }
											  ?>
                                              </select>     
                                          </div>
                                        </div>
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Branch</label>
                                          <div class="controls">
                                              <!-- <select name="branch" id="cv" required> -->
                                               <select class="chzn-select" name="branch" id="3"  required>
                                              <option value="">- Choose -</option>
                                              <?php 
											  foreach($branch->result() as $rows){
											  ?>
											  <option value="<?=$rows->kode_branch?>" <?php if ($id_branch == $rows->kode_branch) { echo "selected"; }?> align="justify"><?=$rows->nama_branch?></option>
											  <?php
											  }
											  ?>
                                              </select>
                                          </div>
                                        </div>
										
										  <div class="control-group">
										  	<label class="control-label" for="typeahead">Base / Employee</label>
										  	<div class="controls">
										  	<div id="dynamicInput">
                                            <input type="hidden" name="id_notif" value="<?=$id_notif;?>">
                                            <input type="hidden" name="jumlah" value="<?=$ket;?>">
                                            <input type="hidden" name="curr_type_1" value="IDR">
										    <input class="input-xlarge-i focused" name="price_1b" onchange="setBlurFocus(4);" value="<?=number_format($tipe_1,2);?>" type="text" id="4b" autocomplete="off" style="text-align:right" disabled required >
										    <input class="input-xlarge-i focused" name="price_1" value="<?=$tipe_1;?>" type="hidden" id="4" autocomplete="off" style="text-align:right" disabled required >
                                            <input type="hidden" name="type_1" value="1">
                                            <input type="hidden" name="id_price_1" value="<?=$id_price_1;?>">
											</br>											  
										  	</div>
											</br>
										  	</div>

											<label class="control-label" for="typeahead">Normal / Local</label>
										  	<div class="controls">
										  	<div id="dynamicInput">
                                            <input type="hidden" name="curr_type_2" value="IDR">
										    <input class="input-xlarge-i focused" name="price_2b" value="<?=number_format($tipe_2,2);?>" onchange="setBlurFocus(5);" type="text" id="5b" autocomplete="off" style="text-align:right" disabled required>
										    <input class="input-xlarge-i focused" name="price_2" value="<?=$tipe_2;?>" type="hidden" id="5" autocomplete="off" style="text-align:right" disabled required>
                                            <input type="hidden" name="type_2" value="2">
                                            <input type="hidden" name="id_price_2" value="<?=$id_price_2;?>">
											</br>											  
										  	</div>
											</br>
										  	</div>
											
											<label class="control-label" for="typeahead">Insurance / Japanese</label>
										  	<div class="controls">
										  	<div id="dynamicInput">
                                            <input type="hidden" name="curr_type_3" value="IDR">
										    <input class="input-xlarge-i focused" name="price_3b" value="<?=number_format($tipe_3,2);?>" onchange="setBlurFocus(6);" type="text" id="6b" autocomplete="off" style="text-align:right" disabled required>
										    <input class="input-xlarge-i focused" name="price_3" value="<?=$tipe_3;?>" type="hidden" id="6" autocomplete="off" style="text-align:right" disabled required>
                                            <input type="hidden" name="type_3" value="3">
                                            <input type="hidden" name="id_price_3" value="<?=$id_price_3;?>">
											</br>											  
										  	</div>
											</br>
										  	</div>
											
											<label class="control-label" for="typeahead">Company / Japanese Non Insurance</label>
										  	<div class="controls">
										  	<div id="dynamicInput">
                                            <input type="hidden" name="curr_type_4" value="IDR">
										    <input class="input-xlarge-i focused" name="price_4b" value="<?=number_format($tipe_5,2);?>" onchange="setBlurFocus(7);" type="text" id="7b" autocomplete="off" style="text-align:right" disabled required>
										    <input class="input-xlarge-i focused" name="price_4" value="<?=$tipe_5;?>" type="hidden" id="7" autocomplete="off" style="text-align:right" disabled required>
                                            <input type="hidden" name="type_4" value="5">
                                            <input type="hidden" name="id_price_4" value="<?=$id_price_4;?>">
											</br>											  
										  	</div>
											</br>
										  	</div>
											
										  </div>
										  
											<!--
												<input style="width:517px;" class="btn btn-success btn-mini" id="butt" disabled type="button" value="Add Price" onClick="addInput('dynamicInput');">
											-->										  
										<div id="myAlert" class="modal hide">
											<div class="modal-header">
												<button data-dismiss="modal" class="close" type="button">&times;</button>
												<h5>Alert!</h5>
											</div>
											<div class="modal-body">
												<p>Are you sure ? [close] button to check again...</p>
											</div>
											<div class="modal-footer">
												<input type="submit" class="btn btn-success" value="Save" id="8" disabled>
												<a data-dismiss="modal" class="btn btn-warning" href="#">Close</a>
											</div>
										</div>
										<div class="form-actions">
										<a href="#myAlert" data-toggle="modal" class="btn btn-success">Submit</a>
										<button class="btn btn-warning" type="reset">Reset</button>
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
            $(".uniform_on").uniform();
            $(".chzn-select").chosen();
            $('.textarea').wysihtml5();
        });
    </script>
</html>