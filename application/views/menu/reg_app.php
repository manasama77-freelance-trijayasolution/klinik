<script>
	  function undisableTxt(){
		    if (0 == <?=$id;?>) {
		window.location.href = "<?php echo base_url();?>patient/data_patient";
		};
		<?php
			$x = 1; 
			while($x <= 28) {
			echo "document.getElementById('".$x."').disabled = false;";
			$x++;
			} 
		?>
	  }
	  
	  function goBack() {
	  	window.history.back();
	  }
	  
	  function fetch_select(val){
		$.ajax({
			type: 'post',
			url: 'fetch_prov',
			data: {
			get_option:val
			},
			success: function (response) {
			document.getElementById("new_select").innerHTML=response; 
			}
		});
	  }

</script>
<?php
	include './design/koneksi/file.php';
	$query 		="SELECT pat_mrn id,cast(left(pat_mrn,4) as decimal) dt FROM pat_data ORDER BY id_pat DESC LIMIT 1";  
    if($result 	=mysqli_query($con,$query))
    {
		//$date	=date('ym');
        $row 	=mysqli_fetch_assoc($result);
        $count 	=$row['id'];
		$counts	=substr($count, 1, strlen($count)-1);
		//$dater 	=$row['dt'];
		//if ($dater == $date) {
		$counts = $counts+1; 	
		//}else{
		//	$count = 1;
		//}
		
        $code_no = str_pad($counts, 0, "0", STR_PAD_LEFT);
    }
?>


 <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Patient Appointment</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                   <div class="table-toolbar">

                                      <div class="btn-group pull-right">
                                         <ul class="dropdown-menu">
                                            <li><a href="#">Print</a></li>
                                            <li><a href="#">Save as PDF</a></li>
                                            <li><a href="#">Export to Excel</a></li>
                                         </ul>
                                      </div>
                                   </div>
                                    
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example2">
                                        <thead>
                                            <tr>
                                                <th>Date Of Reg</th>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Doctor</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 

											  foreach($apptoday->result() as $rows){
											  ?>
										<tr class="info">
						                  <td><?=$rows->appt_date?></td>
						                  <td><?=$rows->fullname?></td>
						                  <td><?=$rows->phone?></td>
						                  <td><?=$rows->email?></td>
						                  <td><?=$rows->id_doctor?></td>
						                  <td><?=$rows->id_doctor?></td>
						                </tr>
												
											  <?php
											  }
										?>        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>            
									

        <link href="<?php echo base_url();?>design/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url();?>design/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url();?>design/assets/styles.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url();?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
		
        <script>
        $(function() {
            
        });
        </script>
											  
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
        <script src="<?php echo base_url();?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url();?>design/vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>design/vendors/jquery-validation/dist/jquery.validate.min.js"></script>
		<script src="<?php echo base_url();?>design/assets/form-validation.js"></script>       
		<script src="<?php echo base_url();?>design/assets/scripts.js"></script>
		<script src="<?php echo base_url();?>design/assets/DT_bootstrap.js"></script>
</html>