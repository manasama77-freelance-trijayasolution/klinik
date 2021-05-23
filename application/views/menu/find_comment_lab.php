				<?php
				$link 		= $this->uri->segment(3);
				$item[]		="";
				
				if (isset($_POST['comment_lab'])) {
					$hasil_comment_lab = "";
					$cars = $this->input->post('comment_lab');
					if (isset($cars)){
						$hasil_comment_lab = implode(', ', $cars);
					}
					echo  "<script type='text/javascript'>";
					echo "window.opener.document.forms['mark_mcu'].elements['comment_lab_".$link."'].value='".$hasil_comment_lab."';";
					echo "window.close();";
					echo "</script>";
				}
				
				?>
                <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">. . .</div>
                            </div>
                            <div class="block-content collapse in">
          					<div class="span12">                                  
          					<form method="POST" action="">
          					<div id="" style="overflow-y: auto; height:150px;">
          					<div class="control-group">
                              <label class="control-label" for="focusedInput"><b>Typing a Comment : </b></label>
                              <div class="controls">
								<select multiple="multiple" id="multiSelect" name="comment_lab[]" class="chzn-select" style="width: 250px;">
								<?php foreach($comment_doc->result() as $row_com){ echo "<option value='".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140)."'>".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140)." | ".str_replace(" ","",$row_com->code_comment)."</option>"; }?>
								</select>
							  <!-- <input type="submit" onclick="closeit();" value="save"> -->
							  <a href=""><button type="submit" class="btn btn-success btn-mini"><i class="icon-ok"></i></button></a>
                              </div>
                            </div>
                            </div>
                           </form>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>				
       <script>
        $(function() {
            $(".datepicker").datepicker();
            $(".uniform_on").uniform();
            $(".chzn-select").chosen();
            $('.textarea').wysihtml5();
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
        <script src="<?php echo base_url();?>design/vendors/wysiwyg/wysihtml5.js"></script>
        <script src="<?php echo base_url();?>design/vendors/wysiwyg/bootstrap-wysihtml5.js"></script>
        <script src="<?php echo base_url();?>design/vendors/wizard/jquery.bootstrap.wizard.min.js"></script>	
		<script type="text/javascript" src="<?php echo base_url();?>design/vendors/jquery-validation/dist/jquery.validate.min.js"></script>
		<script src="<?php echo base_url();?>design/assets/form-validation.js"></script>	
		<script src="<?php echo base_url();?>design/assets/scripts.js"></script>