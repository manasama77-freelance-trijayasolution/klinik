	<?php
		$id = $this->uri->segment(3);
		if ($id=="ok"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Input Master Services
		</div>
	<?php
		}elseif($id=="upd"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Update Master Services
		</div>
	<?php
		}elseif($id=="del"){
	?>
		<div class="alert alert-info">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Delete Master Services
		</div>
	<?php
	}
	?>
	<script>
	  function undisableTxt(){
		document.getElementById('zz').disabled = false;
		document.getElementById('cv').disabled = false;
		document.getElementById('yy').readOnly = false;
		document.getElementById('xx').readOnly = false;

		document.getElementById('ee').disabled = false;
		document.getElementById('curr').disabled = false;
	  }
	  
	  function goBack(){
	  	window.history.back();
	  }
	  
	  function popup_2(){
        window.open("<?php echo base_url();?>marketing/list_service","Popup","height=550, width=880, top=70, left=250 ");
      }
	  
	  function popup_3(){
        window.open("<?php echo base_url();?>patient/find_radiology","Popup","height=550, width=880, top=70, left=250 ");
      }
	  
	  function popup_4(){ 
		id 	= document.forms['mst_service'].elements['serv_typ'].value
        window.open("<?php echo base_url();?>docter/find_services_2/"+id+"","Popup","height=550, width=880, top=70, left=250 ");
      }
	  
	  function list_service(){
		window.open("<?php echo base_url();?>marketing/list_service","","height=550, width=880, top=70, left=250 ");
	  }
	  
	  function group_service(){
		window.open("<?php echo base_url();?>marketing/list_service_price");
	  }
	  
	function showDiv(elem){
	var spl = elem.split(":"),
	low 	= spl[0];
	//alert(low)
		if(low == 0){
			document.getElementById('hidden_div').style.display = "none";
			document.getElementById('hidden_div_4').style.display = "none";
			document.getElementById('xx').readOnly = false;
			document.forms['mst_service'].elements['serv_typ'].value=0;
			document.forms['mst_service'].elements['serv_id'].value=0;
		}else if(low == 1){
			document.getElementById('hidden_div').style.display = "";
			document.getElementById('hidden_div_2').style.display = "none";
			document.getElementById('hidden_div_4').style.display = "none";
			document.getElementById('xx').readOnly = true;
			document.forms['mst_service'].elements['serv_typ'].value=1;
		}else if(low == 2){
			document.getElementById('hidden_div').style.display = "none";
			document.getElementById('hidden_div_2').style.display = "";
			document.getElementById('hidden_div_4').style.display = "none";
			document.getElementById('xx').readOnly = true;
			document.forms['mst_service'].elements['serv_typ'].value=2;
		}else{
			document.getElementById('hidden_div_2').style.display = "none";
			document.getElementById('hidden_div').style.display = "none";
			document.getElementById('hidden_div_4').style.display = "";
			document.getElementById('xx').readOnly = true;
			document.forms['mst_service'].elements['serv_typ'].value=low;
		}
	}
	</script>
	<script src="<?php echo base_url();?>design/assets/acc.js"></script>
	<script type="text/javascript">
	function setBlurFocus(id) {
		var user_input = accounting.formatMoney(document.getElementById(id+'b').value);
		document.getElementById(id+'b').value = user_input;
	}


    function update_service(id){
		window.open("<?php echo base_url();?>marketing/update_mst_service/"+id+"","Popup","height=610, width=980, top=50, left=210 ");
    }

	</script>
                    <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><b>Master Services</b></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                    <fieldset>
									<div class="form-actions">
									<button onclick="undisableTxt()" class="btn btn-primary"><i class="icon-th"></i> Start</button>								 
									<div class="btn-group">
									 <button data-toggle="dropdown" class="btn btn-info dropdown-toggle"><i class="icon-th"></i> Menu <span class="caret"></span></button>
									 <ul class="dropdown-menu">
										<li><a href="#" onclick="popup_2();"><i class="icon-th-large"></i> List Services</a></li>
										<!-- <li><a href="#" onclick="group_service()" ><i class="icon-th-large"></i> Group Services Price</a></li>
										<li><a href="#"><i class="icon-th-large"></i> Another action</a></li>
										<li><a href="#"><i class="icon-th-large"></i> Something else here</a></li> -->
									 </ul>
									</div>
									</div>
									<form class="form-horizontal" action="<?php echo base_url();?>marketing/save_mst_service" method="post" name="mst_service">



										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Services Name</label>
                                          <div class="controls">
                                            <input name="serv_name" onclick="if(this.value!='') this.value='';" onblur="javascript: if(this.value==''){this.value=this.value;}" type="text" id="xx" autocomplete="off" readonly required> 
                                            <input type="hidden" name="grp_services" id="zz" value="0:2">
                                            <input type="hidden" name="branch" id="cv" value="01">
                                            <input type="hidden" name="i_coa" id="77" value="0">
                                            <input type="hidden" name="serv_code" id="yy" value="0">
											<input type="hidden" name="serv_id" value="0" autocomplete="off">
											<input type="hidden" name="serv_typ" id="serv_typ"   value="0" autocomplete="off">
                                            <!-- <button id="hidden_div" type="button" onclick="popup_2();" class="btn btn-success btn-mini" style="display: none;"><i class="icon-search"></i></button>
                                            <button id="hidden_div_2" type="button" onclick="popup_3();" class="btn btn-success btn-mini" style="display: none;"><i class="icon-search"></i></button>
                                            <button id="hidden_div_4" type="button" onclick="popup_4();" class="btn btn-success btn-mini" style="display: none;"><i class="icon-search"></i></button> -->
                                          </div>
                                        </div>

										<div class="control-group">
                                          <label class="control-label" for="typeahead">Price</label>
                                          <div class="controls">
                                            <input type="hidden" name="curr_type_1" id="curr" value="IDR">
                                            <input type="hidden" name="price_1" id="1b" value="" class="input-xlarge-i focused" autocomplete="off" style="text-align:right">
                                            <input type="hidden" name="type_1" id="tae" value="1">

                                            <input type="hidden" name="curr_type_2" id="curr" value="IDR">
                                            <input type="text" name="price_2" id="2b" onclick="if(this.value!='') this.value='';" onblur="javascript: if(this.value==''){this.value=this.value;}"  value="0.00" class="input-xlarge-i focused" autocomplete="off" style="text-align:right">
                                            <input type="hidden" name="type_2" id="tae" value="2">

                                            <input type="hidden" name="curr_type_3" id="curr" value="IDR">
                                            <input type="hidden" name="price_3" id="3b" value="" class="input-xlarge-i focused" autocomplete="off" style="hidden-align:right">
                                            <input type="hidden" name="type_3" id="tae" value="3">

                                            <input type="hidden" name="curr_type_4" id="curr" value="IDR">
                                            <input type="hidden" name="price_4" id="4b" value="" class="input-xlarge-i focused" autocomplete="off" style="hidden-align:right">
                                            <input type="hidden" name="type_4" id="tae" value="4">

                                          </div>
                                        </div>                                        
<!-- 
                                        <div class="control-group">
                                          <label class="control-label" for="focusedInput">Group Services</label>
                                          <div class="controls">
                                              <select class="chzn-select" onchange="showDiv(this.value)" name="grp_services" id="zz" required>
                                              <option value="">- Choose -</option>
                                              <?php 
											  foreach($sv_group->result() as $rows){
											  ?>
												<option value="<?=$rows->id_serv_group?>:<?=$rows->group_seq_no?>" align="justify"><?=$rows->group_desc?></option>
											  <?php
											  }
											  ?>
                                              </select>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Branch</label>
                                          <div class="controls">
                                              <select class="chzn-select" name="branch" id="cv" required>
                                              <option value="">- Choose -</option>
                                              <?php 
											  foreach($branch->result() as $rows){
											  ?>
												<option value="<?=$rows->kode_branch?>" align="justify"><?=$rows->nama_branch?></option>
											  <?php
											  }
											  ?>
                                              </select>
                                          </div>
                                        </div>

										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Sales Account<span class="required"></span></label>
                                          <div class="controls">
                                           <select class="chzn-select" name="i_coa" id="77" title="Choose Sales Account." required>
                                              <option value="">- Choose -</option>
											  <option value="0">No Choose</option>
                                              <?php 
											  foreach($accno->result() as $rowss){
											  ?>
												<option value="<?=$rowss->order?>" align="justify"><?=$rowss->id_coa?> - <?=$rowss->desc1?></option>
											  <?php
											  }
											  ?>
                                           </select>
										   <span for="77" class="help-inline"></span>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Services Code</label>
                                          <div class="controls">
                                            <input  name="serv_code" type="text" id="yy" autocomplete="off" readonly> <font color="red">* Optional</font>
                                          </div>
                                        </div>
										  <script>
										  var counter_ant 	= 2;
										  var limit_ant	 	= 20;
										  function addInput(divName){
										  	if (counter_ant == limit_ant)  {
										  		alert("Sorry, you have only " + counter_ant + " inputs");
										  	}
										  	else {
										  		var newdiv = document.createElement('div');
										  		newdiv.innerHTML = "<select class='chzn-select' name='curr_type_"+counter_ant+"' id='curr' style='width: 128px;' required><option value=''>- Currency -</option><option value='IDR'>IDR </option><option value='USD'>USD</option><option value='JPY'>JPY</option></select> <input type='text' style='text-align:right;' onchange='setBlurFocus("+counter_ant+");' class='input-xlarge-i focused' name='price_"+counter_ant+"' id='"+counter_ant+"b' autocomplete='off'> <select style='width: 160px;' class='chzn-select'  name='type_"+counter_ant+"'><option value=''>- Type -</option><?php foreach($pay_type->result() as $rows){ ?> <option value='<?=$rows->id_price_type?>' align='justify'><?=$rows->price_type?></option><?php } ?></select><input type='hidden' name='count_ant' value='"+counter_ant+"'>";
										  		document.getElementById(divName).appendChild(newdiv);
										  		counter_ant++;
										  	}
										  }
										  </script>

										  <div class="control-group">
										  	<label class="control-label" for="typeahead">Price</label>
										  	<div class="controls">
										  	<div id="dynamicInput">
											<select class="chzn-select" name="curr_type_1" id="curr" style="width: 128px;" required>
											  <option value="">- Currency -</option>
											  <option value="IDR" selected>IDR</option>
											  <option value="USD">USD</option>
											  <option value="JPY">JPY</option>
                                            </select>
											
										    <input class="input-xlarge-i focused" name="price_1" onchange="setBlurFocus(1);" type="text" id="1b" value="0.00" autocomplete="off" style="text-align:right">
												
											<select class="chzn-select"  name="type_1" id="tae" style="width: 160px;">
                                              <option value="">- Type -</option>
                                              <?php 
												foreach($pay_type->result() as $rows){
											  ?>
												<option value="<?=$rows->id_price_type?>" <?php if($rows->id_price_type=="1"){ echo "selected";} ?> align="justify"><?=$rows->price_type?></option>
											  <?php
												}
											  ?>
                                              </select>	
											</br>											  
										  	</div>
											</br>	
											<div id="dynamicInput">
											<select class="chzn-select" name="curr_type_2" id="curr" style="width: 128px;"  required>
											  <option value="">- Currency -</option>
											  <option value="IDR" selected>IDR</option>
											  <option value="USD">USD</option>
											  <option value="JPY">JPY</option>
                                            </select>
											
										    <input class="input-xlarge-i focused" name="price_2" onchange="setBlurFocus(2);" type="text" id="2b" autocomplete="off" value="0.00" style="text-align:right">
												
											<select class="chzn-select"  name="type_2" id="tae" style="width: 160px;">
                                              <option value="">- Type -</option>
                                              <?php 
												foreach($pay_type->result() as $rows){
											  ?>
												<option value="<?=$rows->id_price_type?>" <?php if($rows->id_price_type=="2"){ echo "selected";} ?> align="justify"><?=$rows->price_type?></option>
											  <?php
												}
											  ?>
                                              </select>	
											</br>											  
										  	</div>
											</br>	
											<div id="dynamicInput">
											<select class="chzn-select" name="curr_type_3" id="curr" style="width: 128px;" required>
											  <option value="">- Currency -</option>
											  <option value="IDR" selected>IDR</option>
											  <option value="USD">USD</option>
											  <option value="JPY">JPY</option>
                                            </select>
											
										    <input class="input-xlarge-i focused" name="price_3" onchange="setBlurFocus(3);" type="text" id="3b" value="0.00" autocomplete="off" style="text-align:right">
												
											<select class="chzn-select"  name="type_3" id="tae" style="width: 160px;">
                                              <option value="">- Type -</option>
                                              <?php 
												foreach($pay_type->result() as $rows){
											  ?>
												<option value="<?=$rows->id_price_type?>" <?php if($rows->id_price_type=="3"){ echo "selected";} ?> align="justify"><?=$rows->price_type?></option>
											  <?php
												}
											  ?>
                                              </select>	
											</br>											  
										  	</div>
											</br>	
											<div id="dynamicInput">
											<select class="chzn-select" name="curr_type_4" id="curr" style="width: 128px;" required>
											  <option value="">- Currency -</option>
											  <option value="IDR" selected>IDR</option>
											  <option value="USD">USD</option>
											  <option value="JPY">JPY</option>
                                            </select>
											
										    <input class="input-xlarge-i focused" name="price_4" onchange="setBlurFocus(4);" type="text" id="4b" value="0.00" autocomplete="off" style="text-align:right">
												
											<select class="chzn-select"  name="type_4" id="tae" style="width: 160px;">
                                              <option value="">- Type -</option>
                                              <?php 
												foreach($pay_type->result() as $rows){
											  ?>
												<option value="<?=$rows->id_price_type?>" <?php if($rows->id_price_type=="5"){ echo "selected";} ?> align="justify"><?=$rows->price_type?></option>
											  <?php
												}
											  ?>
                                              </select>	
											</br>											  
										  	</div>
											</br>	
											<div id="dynamicInput">
											<select class="chzn-select" name="curr_type_5" id="curr" style="width: 128px;" required>
											  <option value="">- Currency -</option>
											  <option value="IDR" selected>IDR</option>
											  <option value="USD">USD</option>
											  <option value="JPY">JPY</option>
                                            </select>
											
										    <input class="input-xlarge-i focused" name="price_5" onchange="setBlurFocus(5);" type="text" id="5b" value="0.00" autocomplete="off" style="text-align:right">
												
											<select class="chzn-select"  name="type_5" id="tae" style="width: 160px;">
                                              <option value="">- Type -</option>
                                              <?php 
												foreach($pay_type->result() as $rows){
											  ?>
												<option value="<?=$rows->id_price_type?>" <?php if($rows->id_price_type=="6"){ echo "selected";} ?> align="justify"><?=$rows->price_type?></option>
											  <?php
												}
											  ?>
                                              </select>	
											</br>											  
										  	</div>
 -->				


											<!--
											</br>
										  	<input style="width:517px;" class="btn btn-success btn-mini" id="butt" disabled type="button" value="Add Price" onClick="addInput('dynamicInput');">		
											-->

											
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
										<a href="#myAlert" data-toggle="modal" class="btn btn-success">Submit</a>
										<!-- <button class="btn btn-warning" type="reset">Reset</button> -->
                                        </div>		
									<legend></legend>
									</form>
									</fieldset>                     						
                               <div class="row-fluid">
                        <!-- block 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><b>List Services</b></div>
                            </div>

                            <div class="block-content collapse in">
                                <div class="span12">
                                   <div class="table-toolbar">
                                      <div class="btn-group pull-right">
                                         <button data-toggle="dropdown" class="btn dropdown-toggle"><i class="icon-th"></i> Tools <span class="caret"></span></button>
                                         <ul class="dropdown-menu">
											<li><a href="<?php echo base_url();?>marketing/mst_service_excel"><i class="icon-list-alt"></i> Export to Excel</a></li>
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
												<th>Group</th>
												<th>Services Name</th>
												<th>Type</th>
												<th>Price</th>
												<th>Action</th>
											</tr>
                                        </thead>
                                        <tbody>
										<?php
										$i=1;
										foreach($find->result() as $row){
										?>
											<tr class="odd gradeX">
												<td><?=$i++;?></td>
												<td><?php echo $row->group_name;?></td>		
												<td><?php echo $row->serv_name;?></td>			
												<td><?php echo $row->price_type;?></td>			
												<td><?php echo number_format($row->price,2);?></td>	
												<td>
													<button class="btn btn-warning btn-mini" title="Update Service" onclick="update_service(<?php echo $row->dodol;?>);"><i class="icon-edit"></i></button>
													<button class="btn btn-danger btn-mini" onclick="delete_service(<?php echo $row->dodol;?>);"><i class="icon-trash"></i></button>
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
        });
    </script>
</html>