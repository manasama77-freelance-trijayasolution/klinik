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
        <title>KYOAI HEALTHCARE | RECEIVED ITEM</title>
	</head>
				<?php
				foreach($data->result() as $row){
				?>
				<table class="altrowstable3" id="alternatecolor3" width="100%">
					<tr>
						<td valign="top" colspan="2" width="50%"><img src="<?php echo base_url();?>design/images/logokyoai.png"height="55" width="120"></td>
						<td valign="top" colspan="2" width="50%"><b><u>BUKTI PENERIMAAN BARANG</u></b></td>
					</tr>
					<tr>
						<td width="10%" valign="top">Terima dari</td>
						<td valign="top">: <?php echo $row->supp_name;?> </td>
						<td width="10%" valign="top">No.</td>
						<td valign="top">: <?php echo $row->po_no;?> </td>
					</tr>
					<tr>
						<td width="10%" valign="top">No. PO</td>
						<td valign="top">: <?php echo $row->po_no;?> </td>
						<td width="10%" valign="top">Tanggal</td>
						<td valign="top">: <?php echo date("d.m.Y") ; ?> </td>
					</tr>
				</table>
				<?php
				}
				?>
				<table class="altrowstable2" id="alternatecolor2" width="100%">
					<tr>
						<td valign="bottom" align="center" width="1%" rowspan="2"><b>No.</b></td>
						<td valign="bottom" align="center" width="45%" rowspan="2"><b>Nama Produk</b></td>
						<td valign="bottom" align="center" width="35%" colspan="4"><b>Pemeriksaan</b></td>
						<td valign="bottom" align="center" width="10%" rowspan="2"><b>Jumlah</b></td>
						<td valign="bottom" align="center" width="8%" rowspan="2"><b>Satuan</b></td>
						<td valign="bottom" align="center" width="10%" rowspan="2"><b>Keterangan</b></td>
					</tr>
					<tr>
						<td align="center" width="5%">A</td>
						<td align="center" width="5%">B</td>
						<td align="center" width="5%">C</td>
						<td align="center" width="5%">D</td>
					</tr>
					<?php
					$i=1;
					$j=1;
					$k=1;
					foreach($main->result() as $row){
					?>
						<script type="text/javascript">
						 function showhide(<?=$k++;?>) {
						    var e = document.getElementById(id);
						    e.style.display = (e.style.display == 'block') ? 'none' : 'block';
						 }
						</script>
					<div id="uniquename" style="display:none;">
					<tr>
						<td valign="top" align="center"><?=$i++;?>.</td>
						<td valign="top" ><?php echo $row->item_name;?></td>
						<td valign="top" align="center"><?php if ($row->receive_fisik == 1) { echo "&#10004;";						
						} ?></td>
						<td valign="top" align="center"><?php if ($row->receive_expired == 1) { echo "&#10004;";						
						} ?></td>
						<td valign="top" align="center"><?php if ($row->receive_dosis == 1) { echo "&#10004;";						
						} ?></td>
						<td valign="top" align="center"><?php if ($row->receive_suhu == 1) { echo "&#10004;";						
						} ?></td>
						<td valign="top" align="right"><?php echo $row->qtys;?></td>
						<td valign="top" align="right"><?php echo $row->baseunit;?></td>
						<td valign="top" align="right"><?php echo number_format($row->item_amount,2);?></td>
					</tr>
					</div>
					<?php
					}
					?>
				</table>
				
				<table class="altrowstable3" id="alternatecolor3" width="100%">
					<tr>
						<td colspan="2">Spesifikasi Pemeriksaan</td>
					</tr>
					<tr>
						<td width="15%" valign="top">A. Kondisi Fisik</td>
						<td width="88%" valign="top">: Kemasan tersegel (untuk barang yang dibeli utuh 1 box); tidak dalam keadaan rusak atau sobek.</td>
					</tr>
					<tr>
						<td width="15%" valign="top">B. Tanggal Daluarsa</td>
						<td width="88%" valign="top">: Tanggal penerimaan barang tidak melewati dari tanggal daluarsa yang tertera di kemasan.</td>
					</tr>
					<tr>
						<td width="15%" valign="top">C. Dosis</td>
						<td width="88%" valign="top">: Dosis barang yang datang sesuai dengan nama produk yang dipesan, misal : 2 mg, 5 mg, dll.</td>
					</tr>
					<tr>
						<td width="15%" valign="top">D. Suhu Penyimpanan</td>
						<td width="88%" valign="top">: Khusus untuk vaksin dan reagent yang harus disimpan dalam kondisi dingin, suhu penyimpanan selama proses pengantaran adalah 2-8 C (dapat dilihat dari thermometer cooler box yang dibawa oleh pengantar barang).</td>
					</tr>
				</table>
				<div class="page-break"></div>