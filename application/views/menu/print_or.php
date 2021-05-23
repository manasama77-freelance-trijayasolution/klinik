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
function convert_number_to_words($number) {

    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return $string;
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
        <title>KYOAI HEALTHCARE | PRINT OFFICIAL RECEIPT</title>
	</head>
	
				<table class="altrowstable3" id="alternatecolor3" width="100%">
					<tr>
						<td valign="top" rowspan="5"><img src="<?php echo base_url();?>design/images/logokyoai.png"height="55" width="120"></td>
						<td colspan="2" valign="bottom"><b><u><h3>OFFICIAL RECEIPT</h3></u></b></td>
					</tr>
				</table>
				<?php
				foreach($patient->result() as $row){}
				foreach ($total->result() as $row_total){}
				?>
				<table class="altrowstable3" id="alternatecolor3" width="100%">
				<tr>
					<td>No. </td>
					<td>: <?=$orno;?></td>
					<td>Invoice</td>
					<td>: <?=$invno;?></td>
				</tr>
				<tr>
					<td>Receipt From</td>
					<td>: <?php echo $row->pat_name;?></td>
					<td>Date</td>
					<td>: <?php echo date("d/m/Y");?></td>
				</tr>
				<tr>
					<td>Amount Paid</td>
					<td>: IDR <?php echo number_format($row_total->grand_total,2);?></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>In Words</td>
					<td>: <?php echo convert_number_to_words($row_total->grand_total);?> Rupiahs</td>
					<td></td>
					<td></td>
				</tr>

				</table>
				<br>
				<table class="altrowstable2" id="alternatecolor2" width="100%">
					<tr>
						<td align="center" width="50%"><b>Description</b></td>
						<!-- <td align="center" width="25%"><b>USD</b></td> -->
						<td align="center" width="25%"><b>IDR</b></td>
					</tr>
				 	<?php
		              foreach ($get_billing_mcu_list->result() as $row) {
		            ?>
		            <tr class="odd gradeX">
		              <td><?=$row->package_name;?></td>
		              <!-- <td valign="top" align="right"><?=number_format($row->price,2);?></td> -->
		              <td valign="top" align="right"><?=number_format($row->price,2);?></td>
		            </tr> 
		            <?php 
		              }
			          foreach ($fisik_billing->result() as $row_fisik) { 
		            ?> 
		            <tr class="odd gradeX">
			          <td><?=$row_fisik->serv_name;?></td>
		              <!-- <td valign="top" align="right"><?=number_format($row_fisik->harga,2);?></td> -->
		              <td valign="top" align="right"><?=number_format($row_fisik->harga,2);?></td>
		            </tr> 
		            <?php 
		              }
			          foreach ($lab_billing->result() as $row_lab) { 
		            ?>
		            <tr class="odd gradeX">
			          <td><?=$row_lab->serv_name;?></td>
		              <!-- <td valign="top" align="right"><?=number_format($row_lab->harga,2);?></td> -->
		              <td valign="top" align="right"><?=number_format($row_lab->harga,2);?></td>
		            </tr> 
		            <?php 
		              }
		              foreach ($rad_billing->result() as $row_rad) { 
		            ?>
		            <tr class="odd gradeX">
			          <td><?=$row_rad->serv_name;?></td>
		              <!-- <td valign="top" align="right"><?=number_format($row_rad->harga,2);?></td> -->
		              <td valign="top" align="right"><?=number_format($row_rad->harga,2);?></td>
		            </tr> 
		            <?php 
		              }
		              foreach ($pharmacy->result() as $row_pharmacy) {
		            ?>
		            <tr class="odd gradeX">
			          <td><?=$row_pharmacy->serv_name;?> x <?=$row_pharmacy->drug_qty;?></td>
		              <!-- <td valign="top" align="right"><?=number_format($row_pharmacy->harga,2);?></td> -->
		              <td valign="top" align="right"><?=number_format($row_pharmacy->harga,2);?></td>
		            </tr> 
		            <?php 
		              }
		              foreach ($lain->result() as $row_lain) { 
		            ?>
		            <tr class="odd gradeX">
			          <td><?=$row_lain->serv_name;?></td>
		              <!-- <td valign="top" align="right"><?=number_format($row_lain->harga,2);?></td> -->
		              <td valign="top" align="right"><?=number_format($row_lain->harga,2);?></td>
		            </tr> 
		            <?php 
		              }
			          foreach ($other->result() as $row_other) { 
		            ?>
		            <tr class="odd gradeX">
			          <td><?=$row_other->name_service;?></td>
		              <!-- <td valign="top" align="right"><?=number_format($row_other->price,2);?></td> -->
		              <td valign="top" align="right"><?=number_format($row_other->price,2);?></td>
		            </tr> 
		            <?php 
		              }
			          foreach ($total->result() as $row_total) { 
		            ?>
					<tr>
						<td valign="top" align="right"><b>Sub Total</b></td>
						<!-- <td valign="top" align="right"><?php echo number_format($row_total->total,2);?></td> -->
						<td valign="top" align="right"><?php echo number_format($row_total->total,2);?></td>
					</tr>
					<tr>
						<td valign="top" align="right"><b>Disc</b></td>
						<!-- <td valign="top" align="right"><?php echo number_format($row_total->disc,2);?></td> -->
						<td valign="top" align="right"><?php echo number_format($row_total->disc,2);?></td>
					</tr>
					<tr>
						<td valign="top" align="right"><b>Total</b></td>
						<!-- <td valign="top" align="right"><b><?php echo number_format($row_total->grand_total,2);?></b></td> -->
						<td valign="top" align="right"><b><?php echo number_format($row_total->grand_total,2);?></b></td>
					</tr>
					 <?php 
		              }
		            ?>
				</table>
				<?php 
				foreach ($get_kurs_dollar->result() as $dollar) {}
				?>
				<table class="altrowstable3" id="alternatecolor3" width="100%">
					<tr>
						<td width="45%">Rate IDR / USD 1 : <?=number_format($dollar->amount,2);?>
						</td>
						<td valign="bottom" align="center">Jakarta,<?php echo date("d M Y"); ?></br></br></br></br></br></br></br>____<u><?php echo $nama; ?></u>____</td>
					</tr>
					<tr>
						<td>* Payment by Cheque or Giro is valid after clearance from our bank</td>
						<td valign="top" align="center">(<?php echo $divisi; ?>)</td>
					</tr>
				</table>
				<span class="pagebreak"></span>
