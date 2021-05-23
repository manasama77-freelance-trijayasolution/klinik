<!-- Javascript goes in the document HEAD -->
<script type="text/javascript">
window.print();

function altRows2(id){
  if(document.getElementsByTagName){  
    var table = document.getElementById(id);  
    var rows = table.getElementsByTagName("tr"); 
    for(i = 0; i < rows.length; i++){          
      if(i % 2 == 0){
        rows[i].className = "evenrowcolor2";
      }else{
        rows[i].className = "oddrowcolor2";
      }      
    }
  }
}
window.onload=function(){
  altRows3('alternatecolor3');
}
window.onload=function(){
  altRows2('alternatecolor2');
}
</script>
<style> 
p.test {
    width: 45em; 
    border: 0px solid #000000;
    word-wrap: break-word;
}
p.tost {
    width: 20em; 
    border: 0px solid #000000;
    word-wrap: break-word;

</style>
<style>
@media all
{
  .page-break  { 
  display:none;
   }
  .isi {
    font-size:14px;
    font-weight:bold;
    }
}
@media print
{
  .page-break  { display:block; page-break-before:always; }
}

@media print {
  footer {page-break-after: always;}
}
</style>
<!-- CSS goes in the document HEAD or added to your external stylesheet -->
<style type="text/css">
table.altrowstable3 {
  font-family: verdana,arial,sans-serif;
  font-size:12px;
  color:#333333;
  border-width: 1px;
  border-color: #a9c6c9;
  border-collapse: collapse;
}
table.altrowstable3 th {
  border-width: 1px;
  padding: 3px;
  border-style: solid;
  border-color: #a9c6c9;
}
table.altrowstable3 td {
  border-width: 1px;
  padding: 3px;
  border-style: solid;
  border-color: #a9c6c9;
}
.oddrowcolor3{
  background-color:#d4e3e5;
}
.evenrowcolor3{
  background-color:#c3dde0;
}
.oddrowcolor2{
  background-color:#d4e3e5;
}
.evenrowcolor2{
  background-color:#c3dde0;
}
table.altrowstable2 {
  font-family: verdana,arial,sans-serif;
  font-size:12px;
  color:#333333;
  border-width: 1px;
  border-color: #a9c6c9;
  border-collapse: collapse;
}
table.altrowstable2 th {
  border-width: 1px;
  padding: 3px;
  border-style: solid;
  border-color: #a9c6c9;
}
table.altrowstable2 td {
  border-width: 1px;
  padding: 3px;
  border-style: solid;
  border-color: #a9c6c9;
}
@font-face {
  font-family: IDAutomationHC39M;
  src: url('<?php echo base_url();?>design/font/IDAutomationHC39M.ttf');
}

</style>
  <head>
        <title>Report MCU </title>
  </head>     
                    
<div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                   <div class="table-toolbar">
                                   <div class="btn-group">
                                   
                                      </div>
                                 
</br>
</br>
</br>
<div style="width:1000px; font-family: 'Times New Roman', Times, serif; font-size: 10px; padding-left:20px;">
        <table class="altrowstable3" id="alternatecolor3" width="100%">
          <tr>
            <td valign="top" width="180px">Company Name</td>
            <td valign="top" colspan="2"><?=$client_name;?></td>
            <td valign="top" width="180px">Name Package</td>
            <td valign="top" colspan="2"><?=$quot_name;?></td>
          </tr>
           <tr>
            <td valign="top" width="180px">PIC Name</td>
            <td valign="top" colspan="2"><?=$client_pic;?></td>
            <td valign="top" width="180px">No. Quotation</td>
            <td valign="top" colspan="2"><?=$qout_id;?></td>
          </tr>
           <tr>
            <td valign="top" width="180px">Address 1</td>
            <td valign="top" colspan="2"><?=$client_address1;?></td>
            <td valign="top" width="180px">Package Valid</td>
            <td valign="top" colspan="2"><?=date("d M Y",strtotime($quot_date_valid))?></td>
          </tr>
           <tr>
            <td valign="top" width="180px">Address 2</td>
            <td valign="top" colspan="2"><?=$client_address2;?></td>
            <td valign="top" width="180px">Package Expired</td>
            <td valign="top" colspan="2"><?=date("d M Y",strtotime($quot_date_end))?></td>
          </tr>
           <tr>
            <td valign="top" width="180px">Other Information</td>
            <td valign="top" colspan="2"><?=$client_other;?></td>
            <td valign="top" width="180px">Quantity Estimate</td>
            <td valign="top" colspan="2"><?=$qty_estimate;?> <i class="icon-user"></i> <b>Pax</b></td>
          </tr>
        </table>
</div>


                                  </br>
                                  </br>
                                   </div> 
									<div id="" style="overflow-y: auto; height:auto;">          
                                    <table class="altrowstable3" id="alternatecolor3" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Register Number</th>
                                                <?php
                                                print_r($reg_id);
                                                for ($i=0; $i <$arr_jml; $i++) { 
                                                  $colom_name = $arr_service_other[$i];
                                                  echo "<th>".$colom_name."</th>";
                                                  // if (isset($arr_nama_value[$i])) {$colom_name = $arr_nama_value[$i];} 
                                                  // if (isset($arr_name_type[$i])) {$colom_name = $arr_name_type[$i];} 
                                                }
                                                ?>
                                            </tr>
                                        </thead>
                                        <tbody> 
                                           <tr class="odd gradeX">
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
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