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
        
        function detail_company(id){
          window.open("<?php echo base_url();?>client/detail_client/"+id+"","Popup","height=610, width=980, top=50, left=210 ");
        }

        function detail_package(id){
          window.open("<?php echo base_url();?>marketing/list_detail_quotation/"+id+"","Popup","height=610, width=980, top=50, left=210 ");
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
                                <div class="muted pull-left"><b>List Of Companies</b></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                   <div class="table-toolbar">
                                   <div class="btn-group">
                                   
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
                                                <th>Company Name</th>
                                                <th>Package Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody> 
                                      <?php
                                      $i=1;
                                      foreach($list_data->result() as $row){
                                      ?>
                                            <tr class="odd gradeX">
                                                <td><?=$i++;?></td>
                                                <td>
                                                <!-- <a href="#" title="PIC - <?=$row->client_pic;?>" onclick="detail_company(<?php echo $row->id_Client;?>);"></a> -->
                                                <?php echo $row->client_name;?> 
                                                </td>
                                                <td>
                                                 <!-- <a href="#" title="<?=$row->qout_id;?>" onclick="detail_package(<?php echo $row->id_quot;?>);">  -->
                                                <?php echo $row->quot_name;?>
                                                <!-- </a> -->
                                                </td>
                                                <td>
                                                  <button class="btn btn-success btn-mini" title="Detail Company" onclick="detail_company(<?php echo $row->id_quot;?>);"><i class="icon-folder-open"></i></button>
                                                  <button class="btn btn-warning btn-mini" title="View Year">
                                                  <a href="<?php echo base_url();?>docter/list_report_mcu_year/<?=$row->id_Client;?>/<?=$row->id_quot;?>"><i class="icon-circle-arrow-right"></i></a>
                                                  </button>
                                                  <button class="btn btn-info btn-mini" title="Detail All" >
                                                   <a href="<?php echo base_url();?>docter/list_report_mcu_detail/<?=$row->id_Client;?>/<?=$row->id_quot;?>" target="_blank">
                                                  <i class="icon-list"></i>
                                                  </a>
                                                  </button>
                                                </td>
                                            </tr>
                    <?php
                    }
                    ?>             </tbody>
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