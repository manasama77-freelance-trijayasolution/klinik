	<?php
		$id = $this->uri->segment(3);
		if($id=="ok"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Input Data Coa
		</div>
	<?php
		}elseif($id=="change"){
	?>
		<div class="alert alert-info">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Update Data Coa
	    </div>
	<?php
		}elseif($id=="del"){
	?>
		<div class="alert alert-error">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Delete Coa
		</div>
	<?php
		}
	?>		
	<script>
	  function undisableTxt(){
   
		<?php
			$x = 1; 
			while($x <= 13) {
			echo "document.getElementById('".$x."').disabled = false;";
			$x++;
			}	
		?>
	  }
	  
	  function goBack(){
	  	window.history.back();
	  }


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
                            <div class="muted pull-left"><b>Input COA</b></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                      <fieldset>
                                        <legend></legend>
										 
										<form class="form-horizontal" action="<?php echo base_url();?>inv/update_coa_process" method="post" name="mst_service">
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Account ID</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="idakun" type="text" id="1" autocomplete="off" value="<?=$id_coa;?>" required>
                                            <input  name="urutan" type="hidden" value="<?=$order;?>">
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Desc 1</label>
                                          <div class="controls">
                                            <textarea id="2" name="desc1"><?=$desc1;?></textarea>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Desc 2</label>
                                          <div class="controls">
                                            <textarea id="3" name="desc2" ><?=$desc2;?></textarea>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Type</label>
                                          <div class="controls">
                                           <select name="tipe" id="4"  required>
                                              <option value="">- Choose -</option>
                                              <?php 
											  foreach($group_coa->result() as $rows){
											  	if ($rows->skey == $type) {
											  		$ikan ="selected";
											  	}else{
											  		$ikan ="";
											  	}
											  ?>
												<option value="<?=$rows->skey?>" align="justify" <?php echo $ikan; ?> ><?=$rows->svalue?></option>
											  <?php
											  }
											  ?>
                                           </select>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Currency</label>
                                          <div class="controls">
                                           <select name="matauang" id="5"  required>
                                              <option value="">- Choose -</option>
                                              <?php 
											  foreach($matauang->result() as $rows){
											  	if ($rows->skey == $currency) {
											  		$kucing ="selected";
											  	}else{
											  		$kucing ="";
											  	}
											  ?>
												<option value="<?=$rows->skey?>" align="justify" <?php echo $kucing; ?> ><?=$rows->svalue?> - <?=$rows->lvalue?></option>
											  <?php
											  }
											  ?>
                                           </select>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Parent Account</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="ortu" type="text" id="6" autocomplete="off" value="<?=$group;?>" required>
                                          </div>
                                        </div>

										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Year</label>
                                          <div class="controls">
                                            <input class="input-small" name="tahun" type="text" id="7" autocomplete="off" value="<?=$year;?>" required>
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
												<input type="submit" class="btn btn-success" id="8" value="Save" >
												<a data-dismiss="modal" class="btn btn-warning" href="#">Close</a>
											</div>
										</div>
									
										<div class="form-actions">
										<a href="#myAlert" data-toggle="modal" class="btn btn-success"> Update </a>
                                        </div>
                        
									<legend></legend>
									</form>
					<div class="row-fluid">
                        
                    </div>
									</fieldset>                     						
                                </div>
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
	<script src="<?php echo base_url();?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>
	<link href="<?php echo base_url();?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
	<script src="<?php echo base_url();?>design/assets/DT_bootstrap.js"></script>
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