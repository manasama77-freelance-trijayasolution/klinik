				<?php
				$idx 			=$this->uri->segment(3);
				function findage_detail($dob){
						$interval = date_diff(date_create(), date_create($dob));
						echo $interval->format("%Y Year, %M Months");
					}
				?>

				<script>
					
				     $(document).ready(function() {
					  $(window).keydown(function(event){
					    if(event.keyCode == 13) {
					      event.preventDefault();
					      return false;
					    }
					  });
					});
				     
				</script>

                    <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block --> 
                        <div class="block">
							<?php
								foreach($data->result() as $row){}
							?>
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><b>Form Radiology - <?php echo date("d.m.Y H:i:s",strtotime($row->order_date));?></b></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                    <fieldset>
									<form class="form-horizontal" action="<?php echo base_url();?>Radiology/save_rad_act/<?=$idx;?>" method="post" name="quesioner_mcu">
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">ID Order</label>
                                          <div class="controls">
                                            <input class="input-large focused" name="pat_order" type="text" id="myText01" readonly autocomplete="off" value="<?=$row->id_order;?>">
											<input name="pat_id" type="hidden" id=""  autocomplete="off" value="<?=$row->id_Pat;?>" >
											<input name="id_up" type="hidden" id=""  autocomplete="off" >
                                          </div>
                                        </div>
										
                                        <div class="control-group">
                                          <label class="control-label" for="focusedInput">Patient Registration</label>
                                          <div class="controls">
                                            <input class="input-large focused" name="id_reg" type="text" id="myText01" readonly autocomplete="off" value="<?=$row->id_reg;?>">
                                            <input class="input-large focused" name="id_pat" type="hidden"   value="<?=$row->id_pat;?>">
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Patient Name</label>
                                          <div class="controls">
                                            <input class="input-large focused" name="pat_name" type="text" id="myText02" readonly autocomplete="off" value="<?=$row->pat_name;?>, <?=$row->title_desc;?>">
                                          </div>
                                        </div>
									
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Age</label>
                                          <div class="controls">
                                            <input class="input-large focused" name="pat_address" type="text" id="myText05" readonly autocomplete="off" value="<?=findage_detail($row->pat_dob);?>">
                                          </div>
                                        </div>
										
										<div class="row-fluid">
											<!-- block -->									
												<div class="navbar navbar-inner block-header">
													<div class="muted pull-left"><b>Radiology Order</b></div>
												</div>
												<div class="block-content collapse in">
													<div class="span12">
													<div id="" style="overflow-y: auto; height:auto;">
														<table class="table table-hover table-bordered" id="example3">
															<thead>
																<tr>
																	<th>No</th>
																	<th>Group</th>
																	<th>Items</th>
																	<th><div align="left">Result</div></th>
																</tr>
															</thead>					
															<tbody>		
															<?php
															$id          =$this->uri->segment(3);
															$h           =1; $jav_add =1; $name_rad =1;
															$i           =1; $add     =1;
															$xx          =1; $val_add =1;
															$yy          =1; $dyna	  =1;
															$j           =1; $dyna_2  =1;
															$k           =1; $satu    =1;
															$l           =1; $dua     =1;
															$m           =1; $tiga    =1;
															$cnt		 =1; $empat   =1;
															$aa			 =1; $lima    =1;
															$dr			 =1; $enam    =1;
															$current_cat =null;
															$row_cyin	 =$comment->num_rows();
															$row_cnt 	 =$detail->num_rows();
															?>
															<?php
															foreach($comment->result() as $row_1){
															?>
															<input type="text" style="display: none;" name="id_rad[<?=$xx++;?>]" value="<?php echo $row_1->id_rad_group;?>">
															<input type="text" style="display: none;" name="group_seq[<?=$yy++;?>]" value="<?php echo $row_1->group_seq_no;?>">
															<?php
															}
															?>
															<input type="hidden" name="rowC" value="<?=$row_cnt;?>">
															<input type="hidden" name="rowCyin" value="<?=$row_cyin;?>">
															
															
															<?php
															foreach($detail->result() as $row){
															?>
															<tr class="odd gradeX">
																<input type="hidden" name="id_segment" value="<?php echo $id;?>">
																<td><?=$i++;?></td>
																<?php
																if($row->group_desc != $current_cat){
																$current_cat = $row->group_desc;
																echo "<td><b>". $row->group_desc ."</b>";
																}else{
																?>	
																<td></td>
																<?php
																}
																?>
															<td><input type="text" style="display: none;" name="nama_value[<?=$name_rad++;?>]" value="<?php echo $row->rad_item;?>"><?php echo $row->rad_item;?><hr><input type="text" name="dr_<?=$dr++;?>" placeholder="Doctor Name" required></td>
															<input type="hidden" name="id_rad_item[<?=$j++;?>]" value="<?php echo $row->id_rad_item;?>">
															<input type="hidden" name="seq_no[<?=$k++;?>]" value="<?php echo $row->seq_no;?>">
															<td>
															
															<script>
															var counter_ant<?=$satu++;?> 	= 1;
															var limit_ant					= 5;
															function addInput<?=$jav_add++;?>(divName,vall){
															 if (counter_ant<?=$tiga++;?> == limit_ant)  {
																  alert("Sorry, you have only " + counter_ant<?=$lima++;?> + " inputs");
															 }else{
																  var newdiv = document.createElement('div');
																  newdiv.innerHTML = "</br><input type='hidden' name='urutan[]' id='urutan' class='urutan' value='1' ><input placeholder='Start Typing ...' type='text' style='width: 310px;' class='span6' id='typeahead' name='comment_rad_[]' data-provide='typeahead' data-items='5' data-source='[<?php foreach($comment_doc->result() as $row_com){ echo '\"'.str_replace(" ","",$row_com->code_comment).":".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140).'\",' ;} ?> \"\"]\' autocomplete='off'></br><input type='hidden' name='count_ant' value='"+counter_ant<?=$enam++;?>+"'>";
																  document.getElementById(divName).appendChild(newdiv);
																  counter_ant<?=$dua++;?>++;

																  $('.urutan').val($('.kepala').val());
																}
															}
															</script>		
															
															<div id="p_scents">
															<div id="dynamicInput<?=$dyna++;?>">
															<input placeholder="Start Typing ..." title="" type="text" style="width: 310px;" class="span6" id="typeahead" name="comment_rad_<?=$dyna_2++;?>" data-provide="typeahead" data-items="5" data-source='[<?php foreach($comment_doc->result() as $row_com){ echo '"'.str_replace(" ","",$row_com->code_comment).":".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140).'",'; }?>""]' autocomplete="off" required><input type='hidden' name='count_ant' value='0'>
															</div>
															</div>
															</br>
															<!--
															<input style="width:310px;" class="btn btn-success btn-mini" type="button" value="Add Row Comment" onClick="addInput<?=$add++;?>('dynamicInput','<?=$val_add++;?>');">			
															-->
																<!--
																<textarea id="ckeditor_standard" name="comment_rad_<?=$aa++;?>"></textarea>
																<select multiple="multiple" id="multiSelect" name="comment_rad_[]" class="chzn-select" style="width: 250px;">
																<?php foreach($comment_doc->result() as $row_com){ echo "<option value='".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140)."'>".substr(htmlspecialchars($row_com->c_1,ENT_QUOTES, 'UTF-8'), 0, 140)." | ".str_replace(" ","",$row_com->code_comment)."</option>"; }?>
																</select>
																-->
																<!--
																<textarea rows="2" class="input-xxlarge focused" name="result[<?php echo $l++;?>]"></textarea>
																-->
															</td>		
															</tr>								
															<?php
															}
															?>
															</tbody>
															</table>
														<div style="align:left; float:left;">
														<font color="red">*<b>Wajib diisi semua hasilnya</b> untuk saat ini wajib diisi secara lengkap datanya, kedepannya bisa secara parsial.</font>
														</div>
															

														<!-- <div style="align:right; float:right;">
														<input style="width:15px; height:20px;" type="checkbox" id="optionsCheckbox" name="complete" value="1" checked> <b><font color="red">Completed</font></b>
														</div> -->

														</div>
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
												<input type="submit" class="btn btn-success" value="Save">
												<a data-dismiss="modal" class="btn btn-warning" href="#">Close</a>
											</div>
										</div>
										
										<div class="form-actions">
											<div style="align:left; float:left;">
											<a href="#myAlert" data-toggle="modal" class="btn btn-success"><b>Submit</b></a>
											</div>
											<div style="align:right; float:right;">
											<button class="btn btn-danger" type="reset"><b>Reset</b></button>
											</div>
                                        </div>
											<!-- /block -->
										</div>				
									</form>
									</fieldset>                     						
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
		<!--/.fluid-container-->
		<script>
        $(function() {
            // Bootstrap
            $('#bootstrap-editor').wysihtml5();

            // Ckeditor standard
            $( 'textarea#ckeditor_standard' ).ckeditor({width:'98%', height: '150px', toolbar: [
				{ name: 'document', items: [ 'Source', '-', 'NewPage', 'Preview', '-', 'Templates' ] },	// Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
				[ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],			// Defines toolbar group without name.
				{ name: 'basicstyles', items: [ 'Bold', 'Italic' ] }
			]});
            $( 'textarea#ckeditor_full' ).ckeditor({width:'98%', height: '150px'});
        });

        // Tiny MCE
        tinymce.init({
		    selector: "#tinymce_basic",
		    plugins: [
		        "advlist autolink lists link image charmap print preview anchor",
		        "searchreplace visualblocks code fullscreen",
		        "insertdatetime media table contextmenu paste"
		    ],
		    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
		});

		// Tiny MCE
        tinymce.init({
		    selector: "#tinymce_full",
		    plugins: [
		        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
		        "searchreplace wordcount visualblocks visualchars code fullscreen",
		        "insertdatetime media nonbreaking save table contextmenu directionality",
		        "emoticons template paste textcolor"
		    ],
		    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
		    toolbar2: "print preview media | forecolor backcolor emoticons",
		    image_advtab: true,
		    templates: [
		        {title: 'Test template 1', content: 'Test 1'},
		        {title: 'Test template 2', content: 'Test 2'}
		    ]
		});

        </script>
		<script src="<?php echo base_url();?>design/vendors/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js"></script>
        <script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.min.js"></script>
        <script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url();?>design/vendors/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js"></script>

		<script src="<?php echo base_url();?>design/vendors/ckeditor/ckeditor.js"></script>
		<script src="<?php echo base_url();?>design/vendors/ckeditor/adapters/jquery.js"></script>

		<script type="text/javascript" src="<?php echo base_url();?>design/vendors/tinymce/js/tinymce/tinymce.min.js"></script>

        <script src="<?php echo base_url();?>design/assets/scripts.js"></script>
</html>