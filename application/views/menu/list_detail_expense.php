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
        <title>KLINIK | EXPENSE</title>
	</head>
				<p align="center"><b><u>EXPENSE</u></b></p>
				
				<?php
				foreach($data->result() as $row){
					$total 	= $row->total_amount;
					$ppn 	= $row->ppn_amount;
				?>
				<table class="altrowstable3" id="alternatecolor3" width="100%">
					<tr>
						<td valign="top">No</td>
						<td valign="top"><?php echo $row->po_no;?></td>
						
					</tr>
					<tr>
						<td valign="top">Date</td>
						<td valign="top"><?php echo date("d.m.Y",strtotime($row->po_date));?></td>						
					</tr>
					<tr>
						<td valign="top">Supplier</td>
						<td valign="top"><?php echo $row->supplier_id;?></td>
						
					</tr>
				</table>
				<?php
				}
				?>
				<br>
				<table class="altrowstable2" id="alternatecolor2" width="100%">
					<tr>
						<td align="center"><b>No</b></td>
						<td align="center"><b>Name of Product</b></td>
						<td align="center"><b>Qty</b></td>
						<td align="center"><b>Unit Price</b></td>
						<td align="center"><b>Disc</b></td>
						<td align="center"><b>Amount</b></td>
					</tr>
					<?php
					$no =1;
					foreach($main->result() as $row){
					?>
					<tr>
						<td valign="bottom"><?php echo $no++;?></td>
						<td valign="bottom"><?php echo $row->item_id;?></td>
						<td align="center"><?php echo $row->item_qty;?></td>
						<td><div align="right"><?php echo number_format($row->item_price,2);?></div></td>	
						<td><div align="right"><?php echo number_format($row->item_disc_am,2);?></div></td>	
						<td><div align="right"><?php echo number_format($row->item_amount,2);?></div></td>	
					</tr>
					<?php
					}
					?>
					<tr>
						<td align="center" colspan="5"><b>TOTAL</b></td>
						<td><div align="right"><?php echo number_format($total,2);?></div></td>	
					</tr>
				</table>
				<span class="pagebreak"></span>