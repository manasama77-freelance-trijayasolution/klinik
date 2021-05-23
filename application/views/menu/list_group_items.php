        <?php
        $id = $this->uri->segment(3);
        if ($id=="upd"){
        ?>
          <div class="alert alert-success">
           <button class="close" data-dismiss="alert">&times;</button>
           <strong>Success!</strong> Upadate Company
        </div>
        <?php
        }elseif ($id=="del") {
        ?>
          <div class="alert alert-danger">
           <button class="close" data-dismiss="alert">&times;</button>
           <strong>Success!</strong> Delete Company
        </div>
        <?php }  ?>
        <script>
        function del_data(id) {
          var r = confirm("Are You Sure ?");
          if (r == true) {
          x = window.location = "<?php echo base_url();?>inv/del_po/"+id+"";
          } else {
          x = "You pressed Cancel!";
          }
        }
        </script>
        <script>    
        function goBack(){
          window.history.back();
        }
        
        function update_company(id){
          window.open("<?php echo base_url();?>client/update_client/"+id+"","Popup","height=610, width=980, top=50, left=210 ");
        }

        function detail_company(id){
          window.open("<?php echo base_url();?>client/detail_client/"+id+"","Popup","height=610, width=980, top=50, left=210 ");
        }


      function delete_company(id){
        var r = confirm("Are You Sure, Delete This Company ?");
        if (r == true) {
          x = window.location = "<?php echo base_url();?>client/del_company/"+id+"";
        } else {
          x = "You pressed Cancel!";
        }
      }
        
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
        });
        </script>
                    
<div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><b>List of Grouping Items</b></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                   <div class="table-toolbar">
                                   <div class="btn-group">
                                         <a href="<?php echo base_url(); ?>marketing/mst_grouping_items"><button class="btn btn-success"><i class="icon-plus icon-white"></i> Add New</button></a>
                                      </div>
                                      <div class="btn-group pull-right">
                                         <button data-toggle="dropdown" class="btn dropdown-toggle"><i class="icon-th"></i> Tools <span class="caret"></span></button>
                                         <ul class="dropdown-menu">
                                            <li><a href="<?php echo base_url();?>inv/export_excel_listpr"><i class="icon-list-alt"></i> Export to Excel</a></li>
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
                                                <th>Item Name</th>
                                                <th>Price</th>
                                                <th>Create By</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
										$i=1;
										foreach($data->result() as $row){
										?>
											<tr>
												<td><?=$i++;?></td>
												<td><?php echo $row->name_service;?></td>
												<td>Base Price : <?php echo number_format($row->base_price);?><br>Normal Price : <?php echo number_format($row->normal_price);?><br>Insurance Price : <?php echo number_format($row->insurance_price);?><br>Company Price : <?php echo number_format($row->company_price);?></td>
												<td><?php echo $row->fullname;?> | <?php echo $row->create_date;?></td>
												<td></td>
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
                        <!-- /block -->
                    </div>
        <script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>
        <link href="<?php echo base_url();?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
        <script src="<?php echo base_url();?>design/assets/scripts.js"></script>
        <script src="<?php echo base_url();?>design/assets/DT_bootstrap.js"></script>