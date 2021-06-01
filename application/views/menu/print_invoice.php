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
        <title>KYOAI HEALTHCARE | PRINT INVOICE</title>
	</head>


<?php
if ($sts == "no") {
?>
	
	<form method="post" action="" onsubmit="return confirm('Do you really want to change?');">
		 <div class="control-group">
          <label class="control-label" for="">Date of Delivery</label>
			<div class="controls">
            <input type="text" name="dev_date" class="input-large datepicker" id="reg_date" value="<?php echo $inv_date;?>">
            <input type="hidden" name="no_invoice" value="<?=$invno;?>">
            <input type="hidden" name="nama" value="<?=$nama;?>">
            <input type="hidden" name="divisi" value="<?=$divisi;?>">
            <input type="hidden" name="id_billing" value="<?=$id_billing;?>">
            <input type="hidden" name="id_bh" value="<?=$id_bh;?>">
            <input type="hidden" name="id_reg" value="<?=$id_reg;?>">
            <input type="hidden" name="id_pat" value="<?=$id_pat;?>">
            <input type="hidden" name="age" value="<?=$age;?>">
            <input type="hidden" name="client_name" value="<?=$client_name;?>">
            <input type="hidden" name="id_client" value="<?=$id_client;?>">
            <input type="hidden" name="package_name" value="<?=$package_name;?>">
            <input type="hidden" name="id_package" value="<?=$id_package;?>">
            <input type="hidden" name="pat_name" value="<?=$pat_name;?>">
            <input type="hidden" name="orno" value="<?=$orno;?>">
            <input type="hidden" name="namatamu" value="<?=$namatamu;?>">
            <input type="hidden" name="jenis" value="<?=$type;?>">
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </div>
	</form>

<?php
}else{
?>

				<table class="altrowstable3" id="alternatecolor3" width="100%">
					<tr>
						<td valign="top" rowspan="5">
						<!-- <img height="55" width="120" src="<?php echo base_url();?>design/images/logokyoai.png"> -->
						</td>
						<td colspan="2" valign="bottom"><b><u><h3>INVOICE</h3></u></b></td>
					</tr>
				</table>
				
				<table class="altrowstable3" id="alternatecolor3" width="100%">
				<tr>
					<td>Invoice</td>
					<td>: <?=$invno;?></td>
					<td>Date</td>
					<td>: <?php echo date("d/m/Y");?></td>
				</tr>
				<tr>
					<td>Patient ID</td>
					<td>: <?php echo $id_pat;?></td>
					<td>Type</td>
					<td>: <?php echo $jenis;?></td>
				</tr>
				<tr>
					<td>Patient Name</td>
					<td>: <?php echo $pat_name;?></td>
					<td>Exam No.</td>
					<td>: <?php echo $id_reg;?></td>
				</tr>
				<tr>
					<td>Company</td>
					<td>: <?php echo $namatamu;?></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>Description</td>
					<td>: -</td>
					<td></td>
					<td></td>
				</tr>
				</table>
				<br>
				<table class="altrowstable2" id="alternatecolor2" width="100%">
					<tr>
						<td align="center" width="50%"><b>Description</b></td>
						<!--<td align="center" width="25%"><b>USD</b></td>-->
						<td align="center" width="25%"><b>IDR</b></td>
					</tr>
				 	<?php
		              foreach ($get_billing_mcu_list->result() as $row) {
		            ?>
		            <tr class="odd gradeX">
		              <td><?=$row->package_name;?></td>
		              <!--<td valign="top" align="right"><?=number_format($row->price,2);?></td>-->
		              <td valign="top" align="right"><?=number_format($row->price,2);?></td>
		            </tr> 
		            <?php 
		              }
			          foreach ($fisik_billing->result() as $row_fisik) { 
		            ?> 
		            <tr class="odd gradeX">
			          <td><?=$row_fisik->serv_name;?></td>
		              <!--<td valign="top" align="right"><?=number_format($row_fisik->harga,2);?></td>-->
		              <td valign="top" align="right"><?=number_format($row_fisik->harga,2);?></td>
		            </tr> 
		            <?php 
		              }
			          foreach ($lab_billing->result() as $row_lab) { 
		            ?>
		            <tr class="odd gradeX">
			          <td><?=$row_lab->serv_name;?></td>
		              <!--<td valign="top" align="right"><?=number_format($row_lab->harga,2);?></td>-->
		              <td valign="top" align="right"><?=number_format($row_lab->harga,2);?></td>
		            </tr> 
		            <?php 
		              }
		              foreach ($rad_billing->result() as $row_rad) { 
		            ?>
		            <tr class="odd gradeX">
			          <td><?=$row_rad->serv_name;?></td>
		              <!--<td valign="top" align="right"><?=number_format($row_rad->harga,2);?></td>-->
		              <td valign="top" align="right"><?=number_format($row_rad->harga,2);?></td>
		            </tr> 
		            <?php 
		              }
		              foreach ($pharmacy->result() as $row_pharmacy) { 
		            ?>
		            <tr class="odd gradeX">
			          <td><?=$row_pharmacy->serv_name;?> x <?=$row_pharmacy->drug_qty;?></td>
		              <!--<td valign="top" align="right"><?=number_format($row_pharmacy->harga,2);?></td>-->
		              <td valign="top" align="right"><?=number_format($row_pharmacy->harga,2);?></td>
		            </tr> 
		            <?php 
		              }
		              foreach ($lain->result() as $row_lain) { 
		            ?>
		            <tr class="odd gradeX">
			          <td><?=$row_lain->serv_name;?></td>
		              <!--<td valign="top" align="right"><?=number_format($row_lain->harga,2);?></td>-->
		              <td valign="top" align="right"><?=number_format($row_lain->harga,2);?></td>
		            </tr> 
		            <?php 
		              }
			          foreach ($other->result() as $row_other) { 
		            ?>
		            <tr class="odd gradeX">
			          <td><?=$row_other->name_service;?></td>
		              <!--<td valign="top" align="right"><?=number_format($row_other->price,2);?></td>-->
		              <td valign="top" align="right"><?=number_format($row_other->price,2);?></td>
		            </tr> 
		            <?php 
		              }
			          foreach ($total->result() as $row_total) { 
		            ?>
					<tr>
						<td valign="top" align="right"><b>Sub Total</b></td>
						<!--<td valign="top" align="right"><?php echo number_format($row_total->total,2);?></td>-->
						<td valign="top" align="right"><?php echo number_format($row_total->total,2);?></td>
					</tr>
					<tr>
						<td valign="top" align="right"><b>Disc</b></td>
						<!--<td valign="top" align="right"><?php echo number_format($row_total->disc,2);?></td>-->
						<td valign="top" align="right"><?php echo number_format($row_total->disc,2);?></td>
					</tr>
					<tr>
						<td valign="top" align="right"><b>Total</b></td>
						<!--<td valign="top" align="right"><b><?php echo number_format($row_total->grand_total,2);?></b></td>-->
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
				<span class="pagebreak"></span>
<?php } ?>

        <link href="<?php echo base_url();?>design/vendors/datepicker.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url();?>design/vendors/uniform.default.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url();?>design/vendors/chosen.min.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url();?>design/vendors/wysiwyg/bootstrap-wysihtml5.css" rel="stylesheet" media="screen">
        <script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>design/vendors/jquery.uniform.min.js"></script>
        <script src="<?php echo base_url();?>design/vendors/chosen.jquery.min.js"></script>
        <script src="<?php echo base_url();?>design/vendors/bootstrap-datepicker.js"></script>
        <script src="<?php echo base_url();?>design/vendors/wysiwyg/wysihtml5.js"></script>
        <script src="<?php echo base_url();?>design/vendors/wysiwyg/bootstrap-wysihtml5.js"></script>
        <script src="<?php echo base_url();?>design/vendors/wizard/jquery.bootstrap.wizard.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>design/vendors/jquery-validation/dist/jquery.validate.min.js"></script>
		<script src="<?php echo base_url();?>design/assets/form-validation.js"></script>
		<script>

		jQuery(document).ready(function() {   
		   FormValidation.init();
		});
		

	        $(function() {
	            $(".datepicker").datepicker();
	            $(".uniform_on").uniform();
	            $(".chzn-select").chosen();
	            $('.textarea').wysihtml5();

	            $('#rootwizard').bootstrapWizard({onTabShow: function(tab, navigation, index) {
	                var $total = navigation.find('li').length;
	                var $current = index+1;
	                var $percent = ($current/$total) * 100;
	                $('#rootwizard').find('.bar').css({width:$percent+'%'});
	                // If it's the last tab then hide the last button and show the finish instead
	                if($current >= $total) {
	                    $('#rootwizard').find('.pager .next').hide();
	                    $('#rootwizard').find('.pager .finish').show();
	                    $('#rootwizard').find('.pager .finish').removeClass('disabled');
	                } else {
	                    $('#rootwizard').find('.pager .next').show();
	                    $('#rootwizard').find('.pager .finish').hide();
	                }
	            }});
	            $('#rootwizard .finish').click(function() {
	                alert('Finished!, Starting over!');
	                $('#rootwizard').find("a[href*='tab1']").trigger('click');
	            });
	        });
        </script>