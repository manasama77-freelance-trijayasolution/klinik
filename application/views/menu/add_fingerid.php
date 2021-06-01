<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?php echo base_url();?>design/fingers/assets/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>design/fingers/assets/js/jquery.timer.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url();?>design/fingers/assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>design/fingers/assets/js/ajaxmask.js"></script>
<script src="<?php echo base_url();?>design/fingers/assets/js/custom.js"></script>
	<?php
	    include './design/fingers/global.php';
    	include './design/fingers/function.php';
		$id = $this->uri->segment(3);
		$del= $this->uri->segment(4);

		if ($del ==  "del") {
			mysqli_query($conn, "DELETE FROM demo_finger WHERE user_id='$id';");
			redirect(base_url() . 'registration/add_fingerid/'.$id);
			die();
		}
		if ($id=="ok"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Input Finger ID
		</div>
	<?php
		} else if ($id=="change") {
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Update Finger ID
	    </div>
	<?php
		} else if ($id=="del") {
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Delete Finger ID
		</div>
	<?php
		}
		//Logic Parameter Button
		if ($id=="ok"){
			$id="0";
		}elseif ($id==""){
			$id="1";
		}elseif ($id=="edit"){
			$id="2";
		}else{
			$id=$id;
		}
$url_register		= base64_encode($base_path."register.php?user_id=".$id);
	?>		
	<script>
	  function undisableTxt(){
		  if (0 == <?=$id;?>) {
		window.location.href = "<?php echo base_url();?>Lab/mst_lab_group";
		};
		    
		<?php
			$x = 1; 
			while($x <= 3) {
			echo "document.getElementById('".$x."').disabled = false;";
			$x++;
			}	
		?>
	  }
	  
	  function goBack(){
	  	window.history.back();
	  }

	    function finger(){

			 setTimeout(function(){
			   window.location.reload(1);
			}, 8000);
		}
	</script>
	
                    <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><b>Finger ID</b></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">           
                                      <fieldset>
										<form class="form-horizontal" action="<?php echo base_url();?>inv/save_g" method="post" name="mst_service">
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Registration ID</label>
                                          <div class="controls">
										  <input class="input-xlarge focused" name="g_item" type="text" id="1" value="<?=$id;?>" autocomplete="off" readonly required>
										  <a href="finspot:FingerspotReg;<?=$url_register;?>"><button type="button" onclick="finger(<?=$id;?>)" class="btn btn-info"><i class="icon-thumbs-up"></i> <b>Registration Here !</b></button></a>
                                          </div>
                                        </div>                        
										</form>
									
									<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example3">
										<thead>
											<tr>
												<th>No</th>
												<th>ID</th>
												<th>Action</th>				
											</tr>
										</thead>
										<tbody>
						<?php
						$i 				= 1;
						$sql 			= "SELECT * FROM demo_finger WHERE user_id=$id;";
						$query 			= mysqli_query($conn, $sql);
						while($row = $query->fetch_array()){	 
						$url_verification	= base64_encode($base_path."verification.php?user_id=".$row['user_id']);
						?>
											<tr class="odd gradeX">
												<td><?php echo $i++;?></td>
												<td><?php echo $row['user_id'];?> | <b>Success Registration</b></td>		
												<td><a href="finspot:FingerspotVer;<?=$url_verification;?>" tittle="check finger id"><button type="button" id="button_login" class="btn btn-success"><i class="icon-user"></i> <b>Check</b></button></a>
												<a href="<?php echo base_url();?>registration/add_fingerid/<?php echo $row['user_id'];?>/del">
												<button onclick="myFunction(<?php echo $row['user_id'];?>);" class="btn btn-danger "><i class="icon-trash"></i> <b>Remove</b></button></a>
												</td>		
											</tr>
										</form>
						<?php
						}
						?>
										</tbody>
									</table>
									
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