	<?php
		$id = $this->uri->segment(3);
		if ($id=="ok"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Input Master Services
		</div>
	<?php
	}
	?>
	<script>
	  function undisableTxt(){
		document.getElementById('2b').readOnly = false;
		document.getElementById('ee').disabled = false;
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
	  
	function showDiv(elem){
	var spl = elem.split(":"),
	low 	= spl[0];
	//alert(low)
		if(low == 1){
			document.getElementById('hidden_div').style.display = "";
			document.getElementById('hidden_div_2').style.display = "none";
			document.getElementById('xx').readOnly = true;
			document.forms['mst_service'].elements['serv_typ'].value=1;
		}else if(low == 2){
			document.getElementById('hidden_div').style.display = "none";
			document.getElementById('hidden_div_2').style.display = "";
			document.getElementById('xx').readOnly = true;
			document.forms['mst_service'].elements['serv_typ'].value=2;
		}else{
			document.getElementById('hidden_div').style.display = "none";
			document.getElementById('xx').readOnly = false;
			document.forms['mst_service'].elements['serv_typ'].value=0;
			document.forms['mst_service'].elements['serv_id'].value=0;
		}
	}
	
	$(document).ready(function() {
	  $(window).keydown(function(event){
	    if(event.keyCode == 13) {
	      event.preventDefault();
	      return false;
	    }
	  });
	});
      
	</script>
	<script src="<?php echo base_url();?>design/assets/acc.js"></script>
	<script type="text/javascript">
	function setBlurFocus(id) {
		var user_input = accounting.formatMoney(document.getElementById(id+'b').value);
		document.getElementById(id+'b').value = user_input;
	}
	</script>
                    <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><b>Update Master Services</b></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                    <fieldset>
									<div class="form-actions">
									<button onclick="undisableTxt()" class="btn btn-primary"><i class="icon-th"></i> Start</button>	
										<hr></hr>									
									<form class="form-horizontal" action="<?php echo base_url();?>marketing/process_update_mst_service" method="post" name="mst_service">

										<?php 
										foreach($sv_group->result() as $rows){
											$grp_services = $rows->id_serv_group;
										}
										?>
										<input type="hidden" name="grp_services" id="zz" value="<?=$grp_services;?>">

										<?php 
										foreach($branch->result() as $rows){
											$kode_branch = $rows->kode_branch;
										}
										?>
										</select>
										<input type="hidden" name="branch" id="cv" value="<?=$kode_branch;?>">
										<input type="hidden" name="id_price" value="<?=$id_price;?>">
										<input name="serv_id" type="hidden" value="0" autocomplete="off">
										<input name="serv_typ" type="hidden"  value="0" autocomplete="off">
										<input  name="serv_code" type="hidden" id="yy" value="<?=$code_service;?>">



										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Services Name</label>
                                          <div class="controls">
                                            <input name="serv_name" value="<?=$serv_name;?>" type="text" id="xx" autocomplete="off" readonly required> <button id="hidden_div" type="button" onclick="popup_2();" class="btn btn-success btn-mini" style="display: none;"><i class="icon-search"></i></button><button id="hidden_div_2" type="button" onclick="popup_3();" class="btn btn-success btn-mini" style="display: none;"><i class="icon-search"></i></button>
                                          </div>
                                        </div>

										<div class="control-group">
                                          <label class="control-label" for="typeahead">Price</label>
                                          <div class="controls">
                                            <input type="hidden" name="curr_type_1" id="curr" value="IDR">
                                            <input type="hidden" name="price_1" id="1b" value="" class="input-xlarge-i focused" autocomplete="off" style="text-align:right">
                                            <input type="hidden" name="type_1" id="tae" value="1">

                                            <input type="hidden" name="curr_type_2" id="curr" value="IDR">
                                            <input type="text" name="price_2" id="2b" onclick="if(this.value!='') this.value='';" onblur="javascript: if(this.value==''){this.value=this.value;}"  value="<?=$price;?>" class="input-xlarge-i focused" autocomplete="off" style="text-align:right" readonly>
                                            <input type="hidden" name="type_2" id="tae" value="2">

                                            <input type="hidden" name="curr_type_3" id="curr" value="IDR">
                                            <input type="hidden" name="price_3" id="3b" value="" class="input-xlarge-i focused" autocomplete="off" style="hidden-align:right">
                                            <input type="hidden" name="type_3" id="tae" value="3">

                                            <input type="hidden" name="curr_type_4" id="curr" value="IDR">
                                            <input type="hidden" name="price_4" id="4b" value="" class="input-xlarge-i focused" autocomplete="off" style="hidden-align:right">
                                            <input type="hidden" name="type_4" id="tae" value="4">

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
												<input type="submit" class="btn btn-success" value="Save" id="ee" disabled>
												<a data-dismiss="modal" class="btn btn-warning" href="#">Close</a>
											</div>
										</div>
									
										<div class="form-actions">
										<a href="#myAlert" data-toggle="modal" class="btn btn-success">Update</a>
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
        <script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>
		<link href="<?php echo base_url();?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
        <script src="<?php echo base_url();?>design/assets/scripts.js"></script>
        <script src="<?php echo base_url();?>design/assets/DT_bootstrap.js"></script>
</html>