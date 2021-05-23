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
<?php

function kekata($x){
$x = abs($x);
$angka = array("", "satu", "dua", "tiga", "empat", "lima",
"enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
$temp = " ";
if ($x <12) {
$temp = " ". $angka[$x];
} else if ($x <20) {
$temp = kekata($x - 10). " belas";
} else if ($x <100) {
$temp = kekata($x/10)." puluh". kekata($x % 10);
} else if ($x <200) {
$temp = " seratus" . kekata($x - 100);
} else if ($x <1000) {
$temp = kekata($x/100) . " ratus" . kekata($x % 100);
} else if ($x <2000) {
$temp = " seribu" . kekata($x - 1000);
} else if ($x <1000000) {
$temp = kekata($x/1000) . " ribu" . kekata($x % 1000);
} else if ($x <1000000000) {
$temp = kekata($x/1000000) . " juta" . kekata($x % 1000000);
} else if ($x <1000000000000) {
$temp = kekata($x/1000000000) . " milyar" . kekata(fmod($x,1000000000));
} else if ($x <1000000000000000) {
$temp = kekata($x/1000000000000) . " trilyun" . kekata(fmod($x,1000000000000));
}
return $temp;
}

function terbilang($x, $style=3){
	if($x<0){
		$hasil = "minus ". trim(kekata($x));
	} else {
		$poin  = trim(tkoma($x));
		$hasil = trim(kekata($x));
		
		if ($poin=="nol nol"){
			$poin="";
		}else{
			$poin=$poin;
		}
		
	}
	
	switch($style){
		case 1:
		if($poin){
				$hasil = strtoupper($hasil) . ' KOMA ' . strtoupper($poin) .' Sen';		
		} else { $hasil = strtoupper($hasil); }
		break;
		case 2:
		if($poin){
				$hasil = strtolower($hasil) . ' koma ' .strtolower($poin) .' Sen';		
		} else { $hasil = strtolower($hasil); }
		break;
		case 3:
		if($poin){
				$hasil = ucwords($hasil) . ' Koma ' .ucwords($poin) .' Sen';		
		} else { $hasil = ucwords($hasil); }
		break;
		default:
		if($poin){
			$hasil = ucfirst($hasil) . ' koma ' .$poin .' Sen';
		} else { $hasil = ucfirst($hasil); }
		break;
	}
	return $hasil;
}

function tkoma($x){
	$x 		= stristr($x,'.');
	$y		= substr($x, 1,2);
	//echo $y;
	$temp = kekata($y);
	/*
	$angka  = array("nol", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan");
	
	$temp = " ";
	$pjg  = strlen($x);
	$pos  = 1;
	
	while ($pos < $pjg) {
		$char = substr($x, $pos,1);
		$pos++;
		$temp .= " " . $angka[$char];
	}
	*/
	
	return $temp;
}
?>
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
.evenrowcolor4{
	background-color:#c3dde0;
}
.oddrowcolor4{
	background-color:#d4e3e5;
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
        <title>KYOAI HEALTHCARE | PURCHASE ORDER</title>
	</head>
				<?php
				foreach($data->result() as $row){
				?>
				<table class="altrowstable3" id="alternatecolor3" width="100%">
					<tr>
						<td valign="top" rowspan="5"><img src="<?php echo base_url();?>design/images/logokyoai.png"height="55" width="120"></br>Kepada Yth. </br><?php echo $row->supp_name;?></br><?php echo $row->supp_address1;?> Phone. <?php echo $row->supp_contact1;?></td>
						<td colspan="2"><b><u>PURCHASE ORDER</u></b></td>
					</tr>
					<tr>
						<td valign="top">No</td>
						<td valign="top"><?php echo $row->po_no;?></td>
						
					</tr>
					<tr>
						<td valign="top">Date</td>
						<td valign="top"><?php echo date("d/m/Y",strtotime($row->po_date));?></td>
					</tr>
					<tr>
						<td valign="top">Currency</td>
						<td valign="top">IDR</td>
					</tr>
					<tr>
						<td valign="top">Department</td>
						<td valign="top">-</td>
					</tr>
				</table>
				<?php
				}
				?>
				<table class="altrowstable2" id="alternatecolor2" width="100%">
					<tr>
						<td align="center" width="1%"><b>No.</b></td>
						<td align="center" width="28%"><b>Description</b></td>
						<td align="center" width="8%"><b>Qty</b></td>
						<td align="center" width="10%"><b>Unit Price</b></td>
						<td align="center" width="8%"><b>Disc</b></td>
						<td align="center" width="10%"><b>Amount</b></td>
					</tr>
					<?php
					$i=1;
					foreach($main->result() as $row){
					?>
					<tr>
						<td valign="top"><?=$i++;?>.</td>
						<td valign="top"><?php echo $row->item_name;?></td>
						<td valign="top" align="right"><?php echo $row->qtys;?> <?php echo $row->baseunit;?></td>
						<td valign="top" align="right"><?php echo number_format($row->price,2);?></td>
						<td valign="top" align="center"><?php echo $row->item_disc;?> %</td>
						<td valign="top" align="right"><?php echo number_format($row->item_amount,2);?></td>
					</tr>
					<?php
					}
					?>
					<?php
					foreach($grand->result() as $row_grand){
					?>
					<tr>
						<td valign="top" align="left" colspan="4" rowspan="3">Terbilang : <?php echo terbilang($row_grand->grand_amount); ?>  IDR</td>
						<td valign="top" align="right"><b>Total Amount</b></td>
						<td valign="top" align="right"><?php echo number_format($row_grand->total_amount,2);?></td>
					</tr>
					<tr>
						<td valign="top" align="right"><b>PPN</b></td>
						<td valign="top" align="right"><?php echo number_format($row_grand->ppn_amount,2);?></td>
					</tr>
					<tr>
						<td valign="top" align="right"><b>Total PO</b></td>
						<td valign="top" align="right"><b><?php echo number_format($row_grand->grand_amount,2);?></b></td>
					</tr>
					<?php
					}
					?>
				</table>
				<table class="altrowstable4" id="alternatecolor4" width="100%">
					<tr>
						<td width="25%" align="center">Term Of Payment</td>
						<td width="25%" align="center">Delivery Time</td>
						<td width="45%" align="center">Delivery Address</td>
					</tr>
					<?php
					foreach($footer->result() as $row_footer){
					?>
					<tr>
						<td width="25%" align="center"><?php echo $row_footer->term_payment;?> Hari setelah barang diterima</td>
						<td width="25%" align="center"><?php echo date("d/m/Y",strtotime($row_footer->delivery_date));?></td>
						<td width="45%" align="left"><?php echo $row_footer->delivery_address;?></td>
					</tr>
					<?php
					}
					?>
				</table>
				<table class="altrowstable3" id="alternatecolor3" width="100%">
					<tr>
						<td width="45%">NOTE :</br>*Submit all supporting documents (ie, invoice, DO, etc) directly to finance Dept. at above address for Payment purpose</br>*Quote our P.O Number to all billing documents.</br>*Please provide and update Material Safety Data Sheet (MSDS) for Purchase of Chemical items.</br>*Please return this P.O upon sightingwithin 7 (seven) days Otherwise it is considered that seller agreed to the above order.</td>
						<td valign="top" align="center">Agreed By,</br></br></br></br></br></br></br>____________</td>
						<td valign="top" align="center">Approved By,</br></br></br></br></br></br></br>____________</td>
						<td valign="top" align="center">Purchased By,</br></br></br></br></br></br></br>____________</td>
					</tr>
				</table>
				<span class="pagebreak"></span>