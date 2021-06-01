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

function altRows4(id){
	if(document.getElementsByTagName){  
		
		var table = document.getElementById(id);  
		var rows = table.getElementsByTagName("tr"); 
		 
		for(i = 0; i < rows.length; i++){          
			if(i % 2 == 0){
				rows[i].className = "evenrowcolor4";
			}else{
				rows[i].className = "oddrowcolor4";
			}      
		}
	}
}
window.onload=function(){
	altRows4('alternatecolor4');
}
window.onload=function(){
	altRows3('alternatecolor3');
}
window.onload=function(){
	altRows2('alternatecolor2');
}
</script>
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
	font-size:9px;
	color:#333333;
	border-width: 1px;
	border-color: #a9c6c9;
	border-collapse: collapse;
}
table.altrowstable3 th {
	border-width: 0px;
	padding: 3px;
	border-style: solid;
	border-color: #a9c6c9;
}
table.altrowstable3 td {
	border-width: 0px;
	padding: 3px;
	border-style: solid;
	border-color: #a9c6c9;
}

table.altrowstable2 {
	font-family: verdana,arial,sans-serif;
	font-size:9px;
	color:#333333;
	border-width: 1px;
	border-color: #a9c6c9;
	border-collapse: collapse;
}
table.altrowstable2 th {
	border-width: 1px;
	padding: 5px;
	border-style: solid;
	border-color: #a9c6c9;
}
table.altrowstable2 td {
	border-width: 1px;
	padding: 5px;
	border-style: solid;
	border-color: #a9c6c9;
}

table.altrowstable4 {
	font-family: verdana,arial,sans-serif;
	font-size:9px;
	color:#333333;
	border-width: 1px;
	border-color: #a9c6c9;
	border-collapse: collapse;
}
table.altrowstable4 th {
	border-width: 1px;
	padding: 5px;
	border-style: solid;
	border-color: #a9c6c9;
}
table.altrowstable4 td {
	border-width: 1px;
	padding: 5px;
	border-style: solid;
	border-color: #a9c6c9;
}
.pagebreak { page-break-before: always; }
@font-face {
  font-family: IDAutomationHC39M;
  src: url('<?php echo base_url();?>design/font/IDAutomationHC39M.ttf');
}
</style>
	<head>
        <title>KYOAI HEALTHCARE | PRINT INVOICE</title>
	</head>
		<table class="altrowstable3" id="alternatecolor3" width="100%">
					<tr>
						<td valign="top" rowspan="5"><img src="<?php echo base_url();?>design/images/logokyoai.png"height="55" width="120"></td>
						<td colspan="2" valign="bottom"><b><u>INVOICE</u></b></td>
					</tr>
					<tr>
						<td valign="top">IV/2016/05/0754</td>
					</tr>
				</table>
				<?php
				foreach($patient->result() as $row){
				}
				$type = "MCU";
				if ($row->id_package == 0) {
					$type = "Outpatient";
				}
				$namatamu = $row->client_name;
				if ($row->client_name == "") {
					$namatamu = $row->pat_name;
				}
				?>
				<table class="altrowstable3" id="alternatecolor3" width="100%">
				<tr>
					<td>Patient ID</td>
					<td>: <?php echo $row->id_Pat;?></td>
					<td>Date</td>
					<td>: <?php echo date("d/m/Y");?></td>
				</tr>
				<tr>
					<td>Patient Name</td>
					<td>: <?php echo $row->pat_name;?></td>
					<td>Type</td>
					<td>: <?php echo $type;?></td>
				</tr>
				<tr>
					<td>Company</td>
					<td>: <?php echo $namatamu;?></td>
					<td>Exam No.</td>
					<td>: <?php echo $row->id_reg;?></td>
				</tr>
				<tr>
					<td>Description</td>
					<td>: -</td>
				</tr>
				</table>
				<br>
				<table class="altrowstable2" id="alternatecolor2" width="100%">
					<tr>
						<td align="center" width="50%"><b>Description</b></td>
						<td align="center" width="25%"><b>USD</b></td>
						<td align="center" width="25%"><b>IDR</b></td>
					</tr>
				 	<?php
		              foreach ($get_billing_mcu_list->result() as $row) {
		            ?>
		            <tr class="odd gradeX">
		              <td><?=$row->package_name;?></td>
		              <td valign="top" align="right"><?=number_format($row->price,2);?></td>
		              <td valign="top" align="right"><?=number_format($row->price,2);?></td>
		            </tr> 
		            <?php 
		              }
			          foreach ($fisik_billing->result() as $row_fisik) { 
		            ?> 
		            <tr class="odd gradeX">
			          <td><?=$row_fisik->serv_name;?></td>
		              <td valign="top" align="right"><?=number_format($row_fisik->harga,2);?></td>
		              <td valign="top" align="right"><?=number_format($row_fisik->harga,2);?></td>
		            </tr> 
		            <?php 
		              }
			          foreach ($lab_billing->result() as $row_lab) { 
		            ?>
		            <tr class="odd gradeX">
			          <td><?=$row_lab->serv_name;?></td>
		              <td valign="top" align="right"><?=number_format($row_lab->harga,2);?></td>
		              <td valign="top" align="right"><?=number_format($row_lab->harga,2);?></td>
		            </tr> 
		            <?php 
		              }
		              foreach ($rad_billing->result() as $row_rad) { 
		            ?>
		            <tr class="odd gradeX">
			          <td><?=$row_rad->serv_name;?></td>
		              <td valign="top" align="right"><?=number_format($row_rad->harga,2);?></td>
		              <td valign="top" align="right"><?=number_format($row_rad->harga,2);?></td>
		            </tr> 
		            <?php 
		              }
		              foreach ($pharmacy->result() as $row_pharmacy) { 
		            ?>
		            <tr class="odd gradeX">
			          <td><?=$row_pharmacy->serv_name;?> x <?=$row_pharmacy->drug_qty;?></td>
		              <td valign="top" align="right"><?=number_format($row_pharmacy->harga,2);?></td>
		              <td valign="top" align="right"><?=number_format($row_pharmacy->harga,2);?></td>
		            </tr> 
		            <?php 
		              }
		              foreach ($lain->result() as $row_lain) { 
		            ?>
		            <tr class="odd gradeX">
			          <td><?=$row_lain->serv_name;?></td>
		              <td valign="top" align="right"><?=number_format($row_lain->harga,2);?></td>
		              <td valign="top" align="right"><?=number_format($row_lain->harga,2);?></td>
		            </tr> 
		            <?php 
		              }
			          foreach ($other->result() as $row_other) { 
		            ?>
		            <tr class="odd gradeX">
			          <td><?=$row_other->name_service;?></td>
		              <td valign="top" align="right"><?=number_format($row_other->price,2);?></td>
		              <td valign="top" align="right"><?=number_format($row_other->price,2);?></td>
		            </tr> 
		            <?php 
		              }
			          foreach ($total->result() as $row_total) { 
		            ?>
					<tr>
						<td valign="top" align="right"><b>Sub Total</b></td>
						<td valign="top" align="right"><?php echo number_format($row_total->total,2);?></td>
						<td valign="top" align="right"><?php echo number_format($row_total->total,2);?></td>
					</tr>
					<tr>
						<td valign="top" align="right"><b>Disc</b></td>
						<td valign="top" align="right"><?php echo number_format($row_total->disc,2);?></td>
						<td valign="top" align="right"><?php echo number_format($row_total->disc,2);?></td>
					</tr>
					<tr>
						<td valign="top" align="right"><b>Total</b></td>
						<td valign="top" align="right"><b><?php echo number_format($row_total->grand_total,2);?></b></td>
						<td valign="top" align="right"><b><?php echo number_format($row_total->grand_total,2);?></b></td>
					</tr>
					 <?php 
		              }
		            ?>
				</table>
				
				<table class="altrowstable3" id="alternatecolor3" width="100%">
					<tr>
						<td width="45%">NOTE :</br>- Price incluede VAT10% for medicine only</br>- This is not an official receipt of Payment</br>- Payment By Cheque or Giro should be on behalf PT. JKMC</br>- Bank Transfer</br>&nbsp;&nbsp;Bank : Bank Central Asia (BCA) - Indosemen </br>&nbsp;&nbsp;A/C No : 459.300.2686 (IDR Account) <br>&nbsp;&nbsp;O/B : Klinik drg. Magista Lutfia
						</td>
						<td valign="bottom" align="center">Jakarta,<?php echo date("d M Y"); ?></br></br></br></br></br></br></br>____<u><?php echo $nama; ?></u>____</td>
					</tr>
					<tr>
						<td></td>
						<td valign="top" align="center">(<?php echo $divisi; ?>)</td>
					</tr>
				</table>
				<div class="page-break"></div>
