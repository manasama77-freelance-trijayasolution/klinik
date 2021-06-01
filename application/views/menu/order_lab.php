	<?php	
		$id = $this->uri->segment(3);
		if ($id=="ok"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Lab Order
		</div>
	<?php
		}
	?>
	<script>
	  function undisableTxt(){
		document.getElementById("mytext123").disabled = false;
		document.getElementById("add").disabled = false;
		document.getElementById("delete").disabled = false;
		document.getElementById("add2").disabled = false;
		document.getElementById("delete2").disabled = false;
	  }
	  
	  function goBack(){
	  	window.history.back();
	  }
	  
	  function popup(b_id){
		window.open("<?php echo base_url();?>patient/find_patient","Popup","width=1500px, height=800px, top=70, left=80");
      }
	  
	  function popup_edit(b_id){
        window.open("<?php echo base_url();?>patient/find_patient_mcu","Popup","height=auto,width=auto,scrollbars=1,"+ 
                        "directories=1,location=1,menubar=1," + 
                         "resizable=1 status=1,history=1 top = 50 left = 100");
      }
	  
	  function btntest_onclick(){
		window.location.href = "<?php echo base_url();?>lab/order_lab/edit";
	  }

	</script>
                    <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><b>Lab Order</b></div>
                            </div>
							<div class="form-actions">
							<button onclick="undisableTxt()" class="btn btn-primary btn-large"><b>Start</b></button>									 
							<button class="btn btn-warning btn-large" onclick="goBack()"><b>Back</b></button>
							</div>
                            <div class="block-content collapse in" style=" overflow-x: hidden;overflow-y: auto;padding-bottom: 50px;">
                                <div class="span12">           
                                      <fieldset>									 									 
										 <form class="form-horizontal" action="<?php echo base_url();?>lab/save_order_lab" method="post" name="quesioner_mcu">
                                         <div class="control-group">
                                          <label class="control-label" for="focusedInput">ID Registration</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="pat_mrn" type="text" id="myText01" required maxlength="0" autocomplete="off" placeholder=" ... ">
											<input name="id_reg" type="hidden" id=""  autocomplete="off" >
											<input name="id_up" type="hidden" id=""  autocomplete="off" >
											<input name="id_pat" type="hidden" id=""  autocomplete="off" >
											<?php
											if ($id=="edit") {
											?>
											&nbsp; <button type="button" onclick="popup_edit();" class="btn btn-success"><i class="icon-search"></i></button>
											<?php
											} else {
											?>
											&nbsp; <button type="button" onclick="popup();" class="btn btn-success"><i class="icon-search"></i></button>
											<?php
											}
											?>	
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Patient Name</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="pat_name" type="text" id="myText02" maxlength="0"  autocomplete="off" >
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Age</label>
                                          <div class="controls">
                                           <input class="input-xlarge focused" name="pat_age" type="text" id="myText03" maxlength="0"  autocomplete="off" >
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Company Name</label>
                                          <div class="controls">
                                           <input class="input-xlarge focused" name="client_name" type="text" id="myText03" maxlength="0"  autocomplete="off" >
                                          </div>
                                        </div>
<script language="javascript">
    function addRow_lab(tableID){
        var table 		= document.getElementById(tableID);
        var rowCount 	= table.rows.length;
        var row 		= table.insertRow(rowCount);
		
        //var cell1 		= row.insertCell(0);
        //var element1 	= document.createElement("input");
        //element1.type 	= "checkbox";
        //element1.name	= "chkbox[]";
        //cell1.appendChild(element1);

        var cell2 		= row.insertCell(0);
        cell2.innerHTML = rowCount + 1-1;
		
		if (rowCount >= 50){
			document.getElementById('plus').disabled = true;
		}

        var cell3 		= row.insertCell(1);
		cell3.innerHTML = "<input type='text' placeholder='start typing here. . .' onclick='if(this.value!=\"\") this.value=\"\";' onblur='javascript:if(this.value==\"\"){this.value=this.value;}' style='width: 550px;font-style: oblique;' class='span6' id='typeahead' name='lab_"+cell2.innerHTML+"' data-provide='typeahead' data-items='8' data-source='[<?php foreach($lab_item->result() as $row){ echo '\"'.$row->order_id.":".$row->id_service.":[ITEM] ".$row->serv_name.'\",'; }?> \"\"]\' autocomplete='off'><input type='hidden' name='rowC' value='"+cell2.innerHTML+"'>";
    }
	
	function deleteRow_lab(tableID) {
		var table = document.getElementById(tableID);
		var rowCount = table.rows.length;	
		table.deleteRow(rowCount -1);
	}
</script>
		<input class="btn btn-success" disabled type="button" value="Add" onclick="addRow_lab('example4')" id="add"/>
		<input class="btn btn-danger" disabled id="delete" type="button" value="Delete" onclick="deleteRow_lab('example4');"/>
		</br>
		</br>
		<table class="table table-striped table-bordered" id="example4">
		    <thead>
            <tr>
				<th>No</th>
				<th>Lab Service</th>
			</tr>
			</thead>
			<tbody>
			<tr class="odd gradeX" id="voucher_">
				<TD>1</TD>
				<TD><input type="text" placeholder="start typing here. . ." onclick="if(this.value!='') this.value='';" onblur="javascript: if(this.value==''){this.value=this.value;}" style="width: 550px;font-style: oblique;" class="span6" id="typeahead" name="lab_1" data-provide="typeahead" data-items="8" data-source='[<?php foreach($lab_item->result() as $row){ echo '"'.$row->order_id.":".$row->id_service.":[ITEM] ".$row->serv_name.'",'; }?>""]' autocomplete="off"></TD>
			<input name="rowC" value="1" type="hidden">
			</tr>
			</tbody>
		</table>		
		<input class="btn btn-success" disabled type="button" value="Add" onclick="addRow_lab('example4')" id="add2"/>
		<input class="btn btn-danger" disabled id="delete2" type="button" value="Delete" onclick="deleteRow_lab('example4');"/>	
										<div id="myAlert" class="modal hide">
											<div class="modal-header">
												<button data-dismiss="modal" class="close" type="button">&times;</button>
												<h5>Alert!</h5>
											</div>
											<div class="modal-body">
												<p>Are you sure ? [close] button to check again...</p>
											</div>
											<div class="modal-footer">
												<input type="submit" class="btn btn-success" id="mytext123" disabled value="Save">
												<a data-dismiss="modal" class="btn btn-warning" href="#">Close</a>
											</div>
										</div>
										

									</form>
									</fieldset>                     						
                                </div>
                            </div>
						<div class="form-actions">
						<a href="#myAlert" data-toggle="modal" class="btn btn-success">Order !</a>
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