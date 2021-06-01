

<!-- CSS goes in the document HEAD or added to your external stylesheet -->
<style type="text/css">
table.altrowstable3 {
	font-family: verdana,arial,sans-serif;
	font-size:11px;
	color:#333333;
	border-width: 1px;
	border-color: #a9c6c9;
	border-collapse: collapse;
}
table.altrowstable3 th {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #a9c6c9;
}
table.altrowstable3 td {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #a9c6c9;
}
.oddrowcolor3{
	background-color:#d4e3e5;
}
.evenrowcolor3{
	background-color:#c3dde0;
}
.pagebreak { page-break-before: always; }
.oddrowcolor2{
	background-color:#d4e3e5;
}
.evenrowcolor2{
	background-color:#c3dde0;
}
table.altrowstable2 {
	font-family: verdana,arial,sans-serif;
	font-size:11px;
	color:#333333;
	border-width: 1px;
	border-color: #a9c6c9;
	border-collapse: collapse;
}
table.altrowstable2 th {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #a9c6c9;
}
table.altrowstable2 td {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #a9c6c9;
}
@font-face {
  font-family: IDAutomationHC39M;
  src: url('<?php echo base_url();?>design/font/IDAutomationHC39M.ttf');
}
</style>
	<head>
        <title>KYOAI HEALTHCARE | TRANSFER ITEM REQUISITION</title>
	</head>
	<div class="form-actions">
				<p align="center"><b><u>TRANSFER ITEM REQUISITION</u></b><br>
				<b></b></p>
				
				<?php
				foreach($data->result() as $row){
				?>
				<table class="altrowstable3" id="alternatecolor3" width="100%">
					<tr>
						<td valign="top">No</td>
						<td valign="top"><?php echo $row->mi_no;?></td>
						
					</tr>
					<tr>
						<td valign="top">Date</td>
						<td valign="top"><?php echo $row->create_date;?></td>
						
					</tr>
					<tr>
						<td valign="top">Department</td>
						<td valign="top"><?php echo $row->nama_dep;?></td>
						
					</tr>
				</table>
				<?php
				}
				?>
				<hr>
				</hr>
				<form class="form-horizontal" method="post" action="<?php echo base_url();?>inv/save_appmi">
				<table class="table table-striped table-bordered" id="example2">
					<tr>
						<td align="center"><b>No</b></td>
						<td align="center"><b>Name of Product</b></td>
						<td align="center"><b>Qty</b></td>
						<td align="center"><b>Approve</b></td>
					</tr>
					<?php
					$nomor 				= 1;
					$id_mi_no			= $this->uri->segment(3);
					foreach($main->result() as $row){
					?>
					<tr>
						<td valign="bottom">
							<input name="id_mi_no" id="id_mi_no" type="hidden" value="<?php echo $id_mi_no;?>" />
							<input name="id_mi_d[]" id="id_mi_d[]" type="hidden" value="<?php echo $row->id_mi_d;?>" />
							<input name="loop" id="loop" type="hidden" value="<?=$nomor;?>" /> 
							<?=$nomor++;?>
						</td>
						<td valign="bottom"><?php echo $row->item_product;?></td>
						<td valign="bottom"><input name="qty[]" id="qty[]" style="width:45px" value="<?php echo $row->item_qty;?>" type="number" readonly/> / <?php echo $row->item_uom;?></td>
						<td valign="bottom"><input name="jml[]" id="jml[]" style="width:45px" autocomplete="off" value="0" onclick="if(this.value==0) this.value='';" onblur="javascript: if(this.value==''){this.value=0;}" required max="<?php echo $row->item_qty;?>" type="number" /> / <?php echo $row->item_uom;?>
						</td>
					</tr>
					<?php
					}
					?>
				</table>


				<div id="myAlert" class="modal hide">
					<div class="modal-header">
						<button data-dismiss="modal" class="close" type="button">&times;</button>
						<h5>Alert!</h5>
					</div>
					<div class="modal-body">
						<p>Are you sure ? [close] button to check again...</p>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-success" onclick="this.disabled=true;this.form.submit();" value="Save" id="tobsave">
						<a data-dismiss="modal" class="btn btn-warning" href="#">Close</a>
					</div>
				</div>        


				</form>

				<div class="form-actions">
				<a href="#myAlert" data-toggle="modal" class="btn btn-success">Approve</a>
                </div>
	</div>
				<span class="pagebreak"></span>

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