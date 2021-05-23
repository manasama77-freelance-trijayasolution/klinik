				<div class="span9" id="content">
				<?php
        include './design/fingers/global.php';
        include './design/fingers/function.php';
        $del= $this->uri->segment(4);
				$id = $this->uri->segment(3);
				if ($id=="ok"){
				?>
			    <div class="alert alert-success">
					 <button class="close" data-dismiss="alert">&times;</button>
					 <strong>Success!</strong> Updated User
				</div>
				<?php
				} else if ($id=="add") {
				?>
			    <div class="alert alert-success">
					 <button class="close" data-dismiss="alert">&times;</button>
					 <strong>Success!</strong> Add New User
				</div>
				<?php
				} else if ($id=="del") {
				?>
			    <div class="alert alert-success">
					 <button class="close" data-dismiss="alert">&times;</button>
					 <strong>Success!</strong> Delete User
				</div>
				<?php
				}
				?>				
<script> 

      function finger(){

       setTimeout(function(){
         window.location.reload(1);
      }, 15000);
    }

</script>        
                     <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">User List</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                   <div class="table-toolbar">
                                      <div class="btn-group">
                                         <a href="<?php echo base_url();?>user/add"><button class="btn btn-success"><i class="icon-plus icon-white"></i> Add New</button></a>
                                      </div>
                                      <div class="btn-group pull-right">
                                         <button data-toggle="dropdown" class="btn dropdown-toggle">Tools <span class="caret"></span></button>
                                         <ul class="dropdown-menu">
                                            <li><a href="#">Print</a></li>
                                            <li><a href="#">Save as PDF</a></li>
                                            <li><a href="<?php echo base_url();?>user/user_excel">Export to Excel</a></li>
                                         </ul>
                                      </div>
                                   </div>                                   
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example2">
                                        <thead>
                                            <tr>
                                                <th>User ID</th>
                                                <th>User Name</th>
                                                <th>User Level</th>
                                                <th>Full Name</th>
												                        <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                  										<?php
                  										foreach($data->result() as $row){
                                                $url_register       = base64_encode($base_path."register.php?user_id=".$row->id);
                                                $url_verification   = base64_encode($base_path."verification.php?user_id=".$row->id);
                                                $user_id            = $row->id;

                  										?>
                                            <tr class="odd gradeX">
                                                <td><?php echo $row->id;?></td>
                                                <td><?php echo $row->username;?></td>
                                                <td><?php echo $row->userlevel;?></td>
                                                <td><?php echo $row->fullname;?></td>
                                                <td>
                                                  <a href="<?php echo base_url();?>user/edit/<?php echo $row->id;?>"><button class="btn btn-success btn-mini"><i class=" icon-edit"></i></button></a>
                                                  <a href="<?php echo base_url();?>user/del/<?php echo $row->id;?>"> <button class="btn btn-danger btn-mini"><i class="icon-remove"></i></button></a>
                                                  <?php if (isset($user_id) && !empty($user_id)) { ?>
                                                   <a href="finspot:FingerspotVer;<?=$url_verification;?>" tittle="check finger id"><button type="button" id="button_login" class="btn btn-success btn-mini"><i class="icon-user"></i></button></a>
                                                  <?php } else { ?>
                                                   <a href="finspot:FingerspotReg;<?=$url_register;?>"><button type="button" onclick="finger(<?=$id;?>)" class="btn btn-info btn-mini"><i class="icon-thumbs-up"></i></button></a>
                                                  <?php } ?>
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
                        <!-- /block -->
                    </div>
                </div>
				<script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>
				<script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
				<script src="<?php echo base_url();?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>
				<link href="<?php echo base_url();?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
				<script src="<?php echo base_url();?>design/assets/scripts.js"></script>
				<script src="<?php echo base_url();?>design/assets/DT_bootstrap.js"></script>