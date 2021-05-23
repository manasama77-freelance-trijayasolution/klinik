	<?php
	include './design/koneksi/file.php';
	$query 		="SELECT cast(right(id_reg,4) as decimal) id,cast(substr(id_reg,2,4) as decimal) dt FROM trx_registration ORDER BY id_reg DESC LIMIT 1";  
    if($result 	=mysqli_query($con,$query))
    {
		$date	=date('ym');
        $row 	=mysqli_fetch_assoc($result);
        $count 	=$row['id'];
		$dater 	=$row['dt'];
		if ($dater == $date) {
			$count = $count+1; 	
		}else{
			$count = 1;
		}
        $code_no = str_pad($count, 4, "0", STR_PAD_LEFT);
    }
	$session_data 	 = $this->session->userdata('logged_in');
    $data['username'] 	 = $session_data['username']; 
	$loc 	 = $session_data['location'];
	$_SESSION["regsession"]=$_SERVER['REQUEST_URI'];

		$id = $this->uri->segment(3);
		$id_reg = $this->uri->segment(4);
		$pat_name = $this->uri->segment(5);
		if ($id=="ok"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Input Registration
		</div>
		<?php
		}
		if($id_reg) {?>
<script>
window.open("<?php echo base_url();?>registration/print_detail_regpatient/<?php echo $id_reg;?>", "", "width=700, height=550");
</script>
			<?php
		}
	?>
	
                      <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><b>Upload Image Result</b></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
								<div id="" style="overflow-y: auto; height:auto;">
                                      <fieldset>
										<dl>
    <dt>
 
        File Name:
 
    </dt>
 
    <dd>
 
        <?php echo $uploadInfo['file_name'];?>
 
    </dd>
 
    <dt>
 
        File Size:
 
    </dt>
 
    <dd>
 
        <?php echo $uploadInfo['file_size'];?>
 
    </dd>
 
    <dt>
 
        File Extension:
 
    </dt>
 
    <dd>
 
        <?php echo $uploadInfo['file_ext'];?>
 
    </dd>
 
    <br />
 
    <p>The Image:</p>
 
    <img alt="Your uploaded image" src="<?=base_url(). 'design/file/' . $uploadInfo['file_name'];?>"> 
 
    <p>The Image:</p> 
 
    <img alt="Your Thumbnail image" src="<?=base_url(). 'design/file/' . $thumbnail_name;?>">  
 
</dl>
<div>
<object data="<?=base_url(). 'design/file/' . $uploadInfo['file_name'];?>" type="application/pdf" width="300" height="200">
alt : <a href="<?=base_url(). 'design/file/' . $uploadInfo['file_name'];?>">  <?php echo $uploadInfo['file_name'];?></a>
</object>
</div>
                                      </fieldset>
                                </div>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
   	            <!-- /wizard -->
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
		<script>
		function undisableTxt(){
			document.getElementById("myText123").disabled = false;
		}
		
		function goBack(){
			window.history.back();
		}
		
		function popup(b_id){
			var myWindow = window.open("<?php echo base_url();?>patient/data_patient", "", "width=1200px, height=500px, top=70, left=80");
		}
		
		function newclient(b_id){
			var myWindow = window.open("<?php echo base_url();?>client/add_client", "", "width=1200px, height=500px, top=70, left=80");
		}
		
		function popup_s(id){
			var myWindow = window.open("<?php echo base_url();?>patient/find_patient_data", "", "width=1200px, height=500px, top=70, left=80");
		}
		
		function btntest_onclick(){
			window.location.href = "<?php echo base_url();?>patient/quesioner_patient_mcu/edit";
		}
		</script>
		<script>
		  function undisableTxt() {
				document.getElementById("pat_mrn").disabled = false;
				document.getElementById("reg_date").disabled = false;
				document.getElementById("reference").disabled = false;
				document.getElementById("notes").disabled = false;
				document.getElementById("pat_sign").disabled = false;
				document.getElementById("reg_type").disabled = false;
				document.getElementById("payment_type").disabled = false;
				document.getElementById("selectError2").disabled = false;
				document.getElementById("selectError").disabled = false;
		  }
		  function undisableservice() {
				document.getElementById("selectError").disabled = false;
				document.getElementById("selectError2").disabled = true;
		  }
		  function undisablepackage() {
				document.getElementById("selectError2").disabled = false;
				document.getElementById("selectError").disabled = true;
		  }
		  
		  function goBack() {
			window.history.back();
		  }
		  	  function showapp(){
        window.open("<?php echo base_url();?>Registration/reg_app","Popup","height=800px,width=700px,scrollbars=1,"+ 
                        "directories=1,location=1,menubar=1," + 
                         "resizable=1 status=1,history=1 top = 50 left = 100");
    }
	</script>
	<script>
	$(function() {
		$(".datepicker").datepicker();
		$(".uniform_on").uniform();
		//$(".chzn-select").chosen();
		$('.textarea').wysihtml5();
	});
	</script>
</html>