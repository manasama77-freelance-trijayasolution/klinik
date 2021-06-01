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


	function edit_conversion($id){
		window.open("<?php echo base_url();?>inv/update_coa/"+$id+"","Popup","height=610, width=980, top=50, left=210 ");
	}

	function delete_conversion(id) {
		var r = confirm("Are You Sure Want Delete ?");
		if (r == true) {
			x = window.location = "<?php echo base_url();?>inv/delete_coa/"+id+"";
		} else {
			x = "You pressed Cancel!";
		}
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
										 <div class="form-actions">
										 <button onclick="undisableTxt()" class="btn btn-primary">Start</button> 										 
										 <button class="btn btn-warning" onclick="goBack()">Back</button>
											<div class="btn-group">
												<button data-toggle="dropdown" class="btn btn-info dropdown-toggle"><i class="icon-th"></i> Menu <span class="caret"></span></button>
												<ul class="dropdown-menu">
													<li><a href="<?php echo base_url();?>inv/inv_group_coa"><i class="icon-th-large"></i>  Input Type Coa </a></li>
													<li><a href="#"><i class="icon-th-large"></i> Something else here</a></li>
												</ul>
											</div>
										 </div>
										<form class="form-horizontal" action="<?php echo base_url();?>inv/save_coa" method="post" name="mst_service">
						
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Account ID</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="idakun" type="text" id="1" autocomplete="off" disabled required>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Desc 1</label>
                                          <div class="controls">
                                            <textarea id="2" name="desc1" disabled></textarea>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Desc 2</label>
                                          <div class="controls">
                                            <textarea id="3" name="desc2" disabled></textarea>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Type</label>
                                          <div class="controls">
                                           <select name="tipe" id="4" disabled required>
                                              <option value="">- Choose -</option>
                                              <?php 
											  foreach($group_coa->result() as $rows){
											  ?>
												<option value="<?=$rows->skey?>" align="justify"><?=$rows->svalue?></option>
											  <?php
											  }
											  ?>
                                           </select>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Currency</label>
                                          <div class="controls">
                                           <select name="matauang" id="5" disabled required>
                                              <option value="">- Choose -</option>
                                              <?php 
											  foreach($matauang->result() as $rows){
											  ?>
												<option value="<?=$rows->skey?>" align="justify"><?=$rows->svalue?> - <?=$rows->lvalue?></option>
											  <?php
											  }
											  ?>
                                           </select>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Parent Account</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="ortu" type="text" id="6" autocomplete="off" disabled required>
                                          </div>
                                        </div>

										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Year</label>
                                          <div class="controls">
                                            <input class="input-small" name="tahun" type="text" id="7" autocomplete="off" disabled required>
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
												<input type="submit" class="btn btn-success" id="8" value="Save" disabled>
												<a data-dismiss="modal" class="btn btn-warning" href="#">Close</a>
											</div>
										</div>
									
										<div class="form-actions">
										<a href="#myAlert" data-toggle="modal" class="btn btn-success">Submit</a>
                                        </div>
                        
									<legend></legend>
									</form>
					<div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">COA List </div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                   <div class="table-toolbar">
                                      <div class="btn-group pull-right">
                                        <!--  <button data-toggle="dropdown" class="btn dropdown-toggle"><i class="icon-file"></i> Export Data <span class="caret"></span></button>
                                         <ul class="dropdown-menu">
											<li><a href="<?php echo base_url();?>radiology/radiology_job/1">Excel</a></li>
                                         </ul> -->
                                          <button data-toggle="dropdown" class="btn dropdown-toggle"><i class="icon-th"></i> Tools <span class="caret"></span></button>
                                          <ul class="dropdown-menu">
											<li><a href="<?php echo base_url();?>inv/inv_coa_excel"><i class="icon-list-alt"></i> Export to Excel</a></li>
											<li><a href="<?php echo base_url();?>inv/print_pdf_listpr"><i class="icon-print"></i> Print to PDF</a></li>
                                         </ul>
                                      </div>
									  </br>
									  </br>
                                   </div> 
								   <div id="" style="overflow-y: auto; height:auto;">
                                   <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example2">
                                        <thead>
                                          	<tr>
												<th>No</th>
												<th>Account ID</th>
												<th>Desc 1</th>
												<th>Desc 2</th>
												<th>Action</th>												
											</tr>
                                        </thead>
                                        <tbody>
										<?php
										$i=1;
										foreach($coa_list->result() as $row){
										?>
											<tr class="odd gradeX">
												<td><?=$i++;?></td>
												<td><?php echo $row->id_coa;?></td>
												<td><?php echo $row->desc1;?></td>		
												<td><?php echo $row->desc2;?></td>		
												<td>
													<button onclick="edit_conversion(<?php echo $row->order;?>);" class="btn btn-warning btn-mini"><i class="icon-edit"></i></button>
													<button onclick="delete_conversion(<?php echo $row->order;?>);" class="btn btn-danger btn-mini"><i class="icon-trash"></i></button>
												</td>											
											</tr>
										</form>
										<?php
										}
										?>
                                        </tbody>
                                   </table>
								   </div>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
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