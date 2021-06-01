				<?php
				$link 		= $this->uri->segment(3);
				$item[]		="";
				if (isset($_POST['items'])) {
					
					$item 	= explode(":", $_POST['items']);
					$jml 	= count($item);

					echo  "<script type='text/javascript'>";
					echo "window.opener.document.forms['mst_pr'].elements['id_item[".$link."]'].value='".$item[0]."';";
					echo "window.opener.document.forms['mst_pr'].elements['item[".$link."]'].value='".$item[1]."';";
					echo "window.opener.document.forms['mst_pr'].elements['unit[".$link."]'].value='".$item[2]."';";
					echo "window.opener.document.forms['mst_pr'].elements['id_base[".$link."]'].value='".$item[3]."';";
					echo "window.close();";
					echo "</script>";
				
				}
				?>
                <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><b>Find Item Drug</b></div>
                            </div>
                            <div class="block-content collapse in" style=" overflow-x: hidden;overflow-y: auto;padding-bottom: 140px;>
          					<div class="span12">                                  
          					<form class="form-horizontal"  method="post" action="">
							<div class="control-group">
								<label class="control-label" for="typeahead"><b>Drug Name:</b></label>
								<div class="controls">
								<input type="text" style="width: 280px;" placeholder="start typing here. . ." autocomplete="off" class="span6" id="typeahead" name="items" data-provide="typeahead" data-items="10" data-source='[<?php foreach($data->result() as $row){ echo '"'.str_replace(" ","",$row->id_item).':'.substr(htmlspecialchars(str_replace("'","",$row->item_name),ENT_QUOTES, 'UTF-8'), 0, 140).":".$row->baseunit.":".$row->id_baseunit.'",'; }?>""]'> <button type="submit" class="btn btn-success btn-mini"><i class="icon-plus"></i></button>
								</div>
							</div>				
                           </form>
                           </div>
                           </div>
                </div>
                        <!-- /block -->			
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