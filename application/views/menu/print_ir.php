<!-- Javascript goes in the document HEAD -->
<script type="text/javascript">

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
        <title>KYOAI HEALTHCARE | ITEMS REQUEST</title>
	</head>
				<p align="center"><b><u>ITEMS REQUISITION</u></b><br>
				<b>Branch : <?php echo $nama_branch;?></b></p>
				
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
						<td valign="top"><?php echo date("d.m.Y",strtotime($row->mi_date));?></td>
						
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
				
				<table class="altrowstable2" id="alternatecolor2" width="100%">
					<tr>
						<td align="center"><b>No</b></td>
						<td align="center"><b>Name of Product</b></td>
						<td align="center"><b>Qty</b></td>
						<td align="center"><b>Unit</b></td>
						<td align="center"><b>Notes</b></td>
						<td align="center"><b>Approve</b></td>
						<!-- <td align="center"><b>Delivery Date</b></td> -->
					</tr>
					<?php
					$no =1;
					foreach($main->result() as $row){
					?>
					<tr>

						<td valign="bottom"><?php echo $no++;?></td>
						<td valign="bottom"><?php echo $row->item_product;?></td>
						<td valign="bottom"><?php echo $row->item_qty;?></td>
						<td valign="bottom"><?php echo $row->item_uom;?></td>
						<td valign="bottom"><?php echo $row->remarks;?></td>
						<td valign="bottom">
							<?php 
							if ($row->approve == 0) {
								
							}else{
								echo $row->approve;
							}
							?>
						</td>
						<!-- <td align="center"><?php echo date("d.m.Y",strtotime($row->create_date));?></td> -->
					</tr>
					<?php
					}
					?>
				</table>
				<span class="pagebreak"></span>