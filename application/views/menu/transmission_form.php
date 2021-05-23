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
<style>
@media all
{
  .page-break  { display:none; }
}
@media print
{
  .page-break  { display:block; page-break-before:always; }
}
</style>
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
        <title>KYOAI HEALTHCARE | TRANSMISSION FORM</title>
	</head>
				<?php
				foreach($data->result() as $row){
					$term = date('m/d/Y',strtotime($row->created_date . "+".$row->term_payment." days"));
				?>
				<table class="altrowstable3" id="alternatecolor3" width="100%">
					<tr>
						<td valign="top" colspan="2" width="50%"><img src="<?php echo base_url();?>design/images/logokyoai.png"height="55" width="120"></td>
						<td valign="top" colspan="2" width="50%">
							<b><u>TRANSMISSION FORM</u></b><br>
							<?=strtoupper($row->invoice_no);?>
						</td>
					</tr>
				</table>

				<table class="altrowstable3" id="alternatecolor3" width="100%">
					<tr>
						<td width="10%" valign="top">Terima dari</td>
						<td valign="top">: <?=$row->supp_name;?> </td>
					</tr>
					<tr>
						<td width="10%" valign="top">Kwitansi No.</td>
						<td valign="top">:  </td>
					</tr>
					<tr>
						<td width="10%" valign="top">Sebesar</td>
						<td valign="top">: IDR <?=number_format($row->amount,2);?></td>
					</tr>
					<tr>
						<td width="10%" valign="top">Untuk Pembayaran</td>
						<td valign="top">: PEMBELIAN <?=$row->supp_name;?> , <?=strtoupper($row->invoice_no);?> (<?=date("d/m/Y",strtotime($row->created_date));?>,<?=$term;?>)</td>
					</tr>
				</table>

				<table class="altrowstable3" id="alternatecolor3" width="100%">
					<tr>
						<td width="45%"></br></td>
						<td valign="top" align="center">Jakarta, <?php echo date("d/m/Y H:i:s",strtotime($row->created_date));?></br>Yang Menerima</br></br></br></br></br></br>____________</td>
						<td valign="top" align="center"></td>
						<td valign="top" align="center"></td>
					</tr>
				</table>

				<div class="page-break"></div>
				<?php
				}
				?>