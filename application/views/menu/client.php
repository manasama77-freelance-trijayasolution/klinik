	<?php
		$id = $this->uri->segment(3);
		if ($id=="ok"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Input Client
		</div>
	<?php
		} else if ($id=="add") {
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Add Client
	    </div>
	<?php
		} else if ($id=="upd") {
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Update Client
	    </div>
	<?php
		} else if ($id=="del") {
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Delete Client
		</div>
	<?php
		}
	?>		
<script>
	  function undisableTxt() {
		<?php
			$x = 7; 
			while($x <= 19) {
			echo "document.getElementById('".$x."').disabled = false;";
			$x++;
			} 
			echo "document.getElementById('dept1').disabled = false;";

		?>
	  }
	  
	  function goBack() {
	  	window.history.back();
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
								

<script language="javascript">
    function addRow_lab(tableID){
		var table 		= document.getElementById(tableID);
        var rowCount 	= table.rows.length;
        var row 		= table.insertRow(rowCount);
        var jumlah 		= document.getElementById('jumlah');
  
        console.log(rowCount);
		if (rowCount > 5){
			alert("Sorry, you have only 5 inputs"); 
		}else{
	        var cell2 		= row.insertCell(0);
	        cell2.innerHTML = rowCount + 1-1;
	        var cell3 		= row.insertCell(1);
			cell3.innerHTML = "<td><select id='dept"+cell2.innerHTML+"' name='dept"+cell2.innerHTML+"' required><option value=''>- Choose Lab Group -</option><?php foreach($dept->result() as $rows){ ?> <option value='<?=$rows->skey?>' align='justify'><?=$rows->svalue?></option><?php } ?></select></td>";
	        var cell3 		= row.insertCell(2);
			cell3.innerHTML =  "<td><input class='input-xlarge focused' name='namepic"+cell2.innerHTML+"' type='text' autocomplete='off' required></td>";
			var cell4 		= row.insertCell(3);
			cell4.innerHTML = "<td><input class='input-xlarge focused' name='piccont"+cell2.innerHTML+"' placeholder='0812-3456-7890' type='tel' minlength='9' maxlength='14' autocomplete='off' required></td>";
			var cell5 		= row.insertCell(4);
			cell5.innerHTML = "<td><textarea name='picother"+cell2.innerHTML+"'></textarea></td>";
			jumlah.value 	= cell2.innerHTML;
		}
		
    }
	
	function deleteRow_lab(tableID) {
		var table = document.getElementById(tableID);
		var rowCount = table.rows.length;	
		table.deleteRow(rowCount -1);
	}


    function add_sysparam(group){
		window.open("<?php echo base_url();?>master/add_sysparam/"+group+"","Popup","height=610, width=980, top=50, left=210 ");
    }


	function add_dept(id){
		var selectBox 		= document.getElementById("dept"+id+"");
    	if (selectBox.value == "add") {
    	window.open("<?php echo base_url();?>master/input_sysparam/dept_client/"+id+"","Popup","height=610, width=980, top=50, left=210 ");
    	}
	}
</script>
                    <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
								<div class="muted pull-left"><b>New Company</b></div>
                            </div>
							<div class="form-actions">
								<button onclick="undisableTxt()" class="btn btn-primary">Start</button>   
								<button class="btn btn-warning" onclick="goBack()">Back</button>
								<div class="btn-group">
											<button data-toggle="dropdown" class="btn btn-info dropdown-toggle"><i class="icon-th"></i> Menu <span class="caret"></span></button>
											<ul class="dropdown-menu">
												<li><a href="<?php echo base_url();?>client/list_company"><i class="icon-th-large"></i>  List Company</a></li>
												<li><a href="#"><i class="icon-th-large"></i> Something else here</a></li>
											</ul>
											</div>
							</div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                      <fieldset>
																			 
										<form class="form-horizontal" action="<?php echo base_url();?>client/save_client" method="post" name="mst_client">		
																												
										<!-- <div style="float:right;">
										<b>Manual Book : New Company</b></br>
										<iframe style="border-radius:8px;" width="185px" height="184px" src="https://www.yumpu.com/id/embed/view/cjyoWeK9rL0npFH7" frameborder="0" allowfullscreen="true" allowtransparency="true"></iframe>
										</div> -->
										
										<div style="float:left;">
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Company Name</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="client_name" type="text" id="8" disabled autocomplete="off" required placeholder="Klinik drg. Magista Lutfia" >
                                          </div>
                                        </div>
                                        
										<!-- 
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">PIC Name</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="picname" type="text" id="3" disabled autocomplete="off" required>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Finance Contact</label>
                                          <div class="controls">
											<input type="text" name="pat_contact_home" maxlength="4" id="4" style="width:45px" placeholder="0XXX" disabled> - <input type="text" id="5" name="client_contact_name" style="width:118px" maxlength="10" placeholder="XXXX XXXX" disabled>
                                          </div>
                                        </div>																				
										
										<div class="control-group">                                          
										  <label class="control-label" for="focusedInput">Marketing Contact</label>                                          
											<div class="controls">										   
												<input type="text" name="client_phone" maxlength="4" id="6" style="width:45px" placeholder="08XX" disabled> - <input type="text" name="client_phone2" style="width:45px" maxlength="4" id="7" placeholder="XXXX" disabled> - <input type="text" name="client_phone3" style="width:45px" maxlength="4" id="8" placeholder="XXXX" disabled>                                          
											</div>                                        
										</div>
										 -->
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Address 1</label>
                                          <div class="controls">
                                            <!-- <input class="input-xlarge focused" name="client_address1" type="text" id="9" disabled autocomplete="off" required> -->
                                            <textarea name="client_address1" id="9" disabled autocomplete="off" placeholder="Wisma Keiai Lantai 6, Jl. Jend. Sudirman Kav. 3-4, RT.10/RW.11, Karet Tengsin, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10250" required></textarea>

                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Address 2</label>
                                          <div class="controls">
                                            <!-- <input class="input-xlarge focused" name="client_address2" type="text" id="10" disabled autocomplete="off" required> -->
                                            <textarea name="client_address2" id="10" disabled autocomplete="off" placeholder="Wisma Keiai Lantai 6, Jl. Jend. Sudirman Kav. 3-4, RT.10/RW.11, Karet Tengsin, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10250" required></textarea>
                                          </div>
										</div>

										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Fax</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="client_fax" type="text" id="11"  autocomplete="off" disabled placeholder="021-5724-330" minlength="9" maxlength="14">
                                          </div>
                                        </div>

										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Phone</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="client_mobile" type="text" id="12" autocomplete="off" disabled placeholder="021-5724-330" minlength="9" maxlength="14">
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Other Information</label>
                                          <div class="controls">
                                            <textarea name="other" autocomplete="off" id="7" disabled></textarea>
                                          </div>
                                        </div>
										</div>

		<div style="width:100%; height:100%	; overflow: auto; float:center;">
		<input class="btn btn-success" disabled type="button" value="Add" onclick="addRow_lab('example4')" id="13"/>
		<input class="btn btn-danger" disabled id="14" type="button" value="Delete" onclick="deleteRow_lab('example4');"/>
		</br>
		</br>
		<table class="table table-hover" id="example4">
		    <thead>
            <tr class="odd gradeX">
				<th align="center">No</th>
				<th align="center">Dept</th>
				<th align="center">PIC Name</th>
				<th align="center">PIC Contact</th>
				<th align="center">Other Information</th>
			</tr>
			</thead>
			<tbody>
			<input name="rowC" id="jumlah" value="1" type="hidden">
			<tr>
				<td>1</td>
				<td>
					<!-- <select id="18" name="dept()" class="chzn-select"  required> -->
					<select name="dept1" id="dept1" onchange="add_dept(1)" disabled required>
					<option value="">- Choose Departement -</option>
					<option value="add">- Add Departement -</option>
					<?php 
					foreach($dept->result() as $rows){
					?>
					<option value='<?=$rows->skey?>' align='justify'><?=$rows->svalue?></option>
					<?php
					}
					?>
					</select>
				</td>
				<td><input class="input-xlarge focused" name="namepic1" type="text" id="15" disabled autocomplete="off" required></td>
				<td><input class="input-xlarge focused" name="piccont1" type="tel" minlength="9" maxlength="14" id="18" disabled autocomplete="off" placeholder="0812-3456-7890" required></td>
				<td><textarea name="picother1" id="19" disabled></textarea></td>
			</tr>
			</tbody>
		</table>		
		<input class="btn btn-success" disabled type="button" value="Add" onclick="addRow_lab('example4')" id="16"/>
		<input class="btn btn-danger" disabled id="17" type="button" value="Delete" onclick="deleteRow_lab('example4');"/>			
		</div>

		
										</fieldset>   



                                </div>
                            </div>
								<div class="form-actions">
								<input type="submit" class="btn btn-success" value="Submit">
                                </div>
                        </div>

									</form>
                        
                        <!-- /block -->
                    </div>
		<!--/.fluid-container-->
        <!-- <link href="<?php echo base_url();?>design/vendors/datepicker.css" rel="stylesheet" media="screen">
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
	<script src="<?php echo base_url();?>design/assets/scripts.js"></script> -->
	<!--/.fluid-container-->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

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
		<script>
		function popup(b_id){
			var id3 = "<?=$id;?>" ;

			if (id3 == "ok") {
				window.location = "<?php echo base_url();?>registration/reg_patien";
			}

			var myWindow = window.open("<?php echo base_url();?>patient/data_patient", "", "width=1350px, height=500px, top=70, left=2.5");
		}
		
		function newclient(b_id){
			var myWindow = window.open("<?php echo base_url();?>client/add_client", "", "width=1200px, height=500px, top=70, left=80");
		}
		
		function popup_s(id){
			var myWindow = window.open("<?php echo base_url();?>patient/find_patient_data", "", "width=1200px, height=500px, top=70, left=70");
		}
		
		function popup_camera(id){
			var myWindow = window.open("<?php echo base_url();?>registration/add_camera/"+id+"", "", "width=950px, height=500px, top=70, left=80");
		}
		
		function finger(id){
			var myWindow = window.open("<?php echo base_url();?>registration/add_fingerid/"+id+"", "", "width=1200px, height=500px, top=70, left=80");
			
			// window.open("<?php echo base_url();?>registration/add_fingerid/"+id+"","Popup","height=800px,width=700px,scrollbars=1,"+ 
                        // "directories=1,location=1,menubar=1," + 
                        //  "resizable=1 status=1,history=1 top = 50 left = 100");
		}

		function showapp(){
			window.open("<?php echo base_url();?>Registration/reg_app","Popup","height=800px,width=700px,scrollbars=1,"+ 
                        "directories=1,location=1,menubar=1," + 
                         "resizable=1 status=1,history=1 top=50 left = 100");
		}
		</script>
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
		<script>
        $(function() {
            $('.tooltip').tooltip();	
			$('.tooltip-left').tooltip({ placement: 'left' });	
			$('.tooltip-right').tooltip({ placement: 'right' });	
			$('.tooltip-top').tooltip({ placement: 'top' });	
			$('.tooltip-bottom').tooltip({ placement: 'bottom' });

			$('.popover-left').popover({placement: 'left', trigger: 'hover'});
			$('.popover-right').popover({placement: 'right', trigger: 'hover'});
			$('.popover-top').popover({placement: 'top', trigger: 'hover'});
			$('.popover-bottom').popover({placement: 'bottom', trigger: 'hover'});

			$('.notification').click(function() {
				var $id = $(this).attr('id');
				switch($id) {
					case 'notification-sticky':
						$.jGrowl("Stick this!", { sticky: true });
					break;

					case 'notification-header':
						$.jGrowl("A message with a header", { header: 'Important' });
					break;

					default:
						$.jGrowl("Hello world!");
					break;
				}
			});
        });
        </script>
</html>