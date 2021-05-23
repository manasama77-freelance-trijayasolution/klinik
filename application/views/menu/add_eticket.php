
	<script>
	function undisableTxt(){
		document.getElementById('pat_mrn').disabled 	= false;
		<?php
			$x = 1; 
			while($x <= 16) {
			echo "document.getElementById('".$x."').disabled = false;";
			$x++;
			}	
		?>
	}

	function popup_2(){
		var myWindow = window.open("<?php echo base_url();?>pharmacy/choose_patient_data_reg", "", "width=1200px, height=500px, top=70, left=70");
	}

	function goBack(){
		location.reload();
	}

	function print_all(id){
		var myWindow = window.open("<?php echo base_url();?>pharmacy/print_eticket/"+id+"", "", "width=1200px, height=500px, top=70, left=70");
	}

	</script>
	
                    <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block --> 
                        <div class="block">
                           
 <div class="row-fluid">
<div class="navbar navbar-inner block-header">
   <div class="muted pull-left"><b>Registration Patient</b></div>
</div>
<div class="block-content collapse in">
   <div class="span12">                                   
		<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
		<thead>
			<tr>
				<th>No.</th>
				<th>ID Registration</th>
				<th>Patient Name</th>
				<th>Date Registration</th>
				<th>Company Name</th>
				<th>Type</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$i=1;
		foreach($trx_registration->result() as $row){
		?>
			<tr class="odd gradeX">
				<td><?php echo $i++;?></td>
				<td><?php echo $row->id_reg;?></td>
				<td><?php echo $row->pat_name;?></td>
				<td><?php echo date("d.m.Y",strtotime($row->reg_date));?></td>
				<td><?php echo $row->client_name;?></td>
				<td><?php if($row->id_service==0){
					echo "MCU";
					}else{
					echo "Outpatient";
					}
					?>
				</td>
				<td>
					<button title="Print Received Items" class="btn btn-mini" title="Print" onclick="print_all('<?php echo ($row->id_reg);?>');"><i class="icon-print"></i></button>
				</td>
			</tr>
		<?php
		}
		?>
		</tbody>
	</table>
   </div>
</div>
</div>


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