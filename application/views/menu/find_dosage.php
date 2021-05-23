				<?php
				$link 		= $this->uri->segment(3);
				$id_item	= $this->uri->segment(4);
				$item[]		="";
				
				if (isset($_POST['items'])) {
			
					$item 	= explode(":", $_POST['items']);
					$jml 	= count($item);
					echo  "<script type='text/javascript'>";
					echo "window.opener.document.forms['mst_pr'].elements['dosage[".$link."]'].value='".$item[0]." (".$item[2].")';";
					echo "window.opener.document.forms['mst_pr'].elements['id_drug_dosage[".$link."]'].value='".$item[1]."';";
					echo "window.close();";
					echo "</script>";
				
				}
				
				function findage_detail($dob){
						$interval = date_diff(date_create(), date_create($dob));
						echo $interval->format("%Y Year, %M Months");
					}
				?>
                <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Find Item</div>
                            </div>
                            <div class="block-content collapse in">
          					<div class="span12">                                  
          					
          					<form method="POST" action="">
          					<div id="" style="overflow-y: auto; height:250px;">
          					<div class="control-group">
                              <label class="control-label" for="focusedInput">Drug Name</label>
                              <div class="controls">
							  <input type="text" style="width: 300px;" autocomplete="off" class="span6" id="typeahead" name="items" data-provide="typeahead" data-items="6" data-source='[<?php foreach($data->result() as $row){ echo '"'.substr(htmlspecialchars($row->drug_name,ENT_QUOTES, 'UTF-8'), 0, 140).":".$row->id_drug_dosage.":".str_replace(" ","",$row->dosage_main).'x'.$row->dosage_days.'",'; }?>""]' >
							  <button type="submit" class="btn btn-mini"><i class="icon-plus"></i></button>
                              </div>
                            </div>
                            </div>
                           </form>

                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>				
        <script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>
		<link href="<?php echo base_url();?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
        <script src="<?php echo base_url();?>design/assets/scripts.js"></script>
        <script src="<?php echo base_url();?>design/assets/DT_bootstrap.js"></script>