		<?php
		$id = $this->uri->segment(3);
		
		?>
			<div class="row-fluid">
                <!-- block -->
                <div class="block">
                    <div class="navbar navbar-inner block-header">
                        <div class="muted pull-left">Photo Patient</div>
                    </div>
                    <div class="block-content collapse in">
                    <div class="span12" style="height: 350px;">
                           <div class="table-toolbar">
                             <div class="btn-group pull-right">
                                 <ul class="dropdown-menu">
                                    <li><a href="#">Print</a></li>
                                    <li><a href="#">Save as PDF</a></li>
                                    <li><a href="#">Export to Excel</a></li>
                                 </ul>
						   
                           </div>
                        </div>
						<iframe style="width: 100%; height: 100%;" src="<?php echo base_url();?>design/webcam/webcam.php?id=<?=$id;?>"></iframe>
                    </div>
                </div>
                <!-- /block -->
            </div>            
</html>