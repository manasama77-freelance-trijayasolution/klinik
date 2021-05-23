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
<?php
	foreach($data->result() as $row){}					
	foreach($find->result() as $row_2){}
	foreach($radp->result() as $row_pap){}
	foreach($radb->result() as $row_breast){}


?>
</style>
	<head>
        <title>Medical Check UP Print from IP:<?=$_SERVER['REMOTE_ADDR'];?> | <?php echo $row->id_reg;?></title>
	</head>
<?php
function findage_detail($dob){
		$interval = date_diff(date_create(), date_create($dob));
		echo $interval->format("%Y");
	}

	
// UNTUK MENGAMBIL TANGGAL PREVIOUS DAN LAST DISINI, ADD BY RANGGA 15 FEB 2016	
	// array disini...
	$reg_date=array();
	$package_name=array();
	
	// variable disini...
	$reg_date_previos=null;
	$package_name_previos=null;
	$height_previos=null;
	
	$reg_date_last=null;
	$package_name_last=null;
	$height_last=null;
	$current_cat = null;
	$current_cat1 = null;
	
	foreach($reg->result() as $row_head){
		$reg_date[]= $row_head->reg_date;
		$package_name[]= $row_head->package_name;
	}						
	if (isset($reg_date[1])){
			$reg_date_previos=date("d-m-Y", strtotime($reg_date[1]));			
			$package_name_previos=$package_name[1];	
			foreach($find1->result() as $row_previos){}			
			foreach($radp1->result() as $row_pap1){}
			foreach($radb2->result() as $row_breast1){}


			
	} 	
	if (isset($reg_date[2])){
			$reg_date_last=date("d-m-Y", strtotime($reg_date[2]));
			$package_name_last=$package_name[2];	
			foreach($find2->result() as $row_last){}			
			foreach($radp2->result() as $row_pap2){}
			foreach($radb2>result() as $row_breast2){}

			
	}
	
// Fungsi ini dibuat untuk melihat radiologi khusus Stomach, add by rangga 16 Febuari 2016
if ($rads->num_rows() > 0){
	foreach($rads->result() as $row_spb){}
} 									

// Fungsi ini dibuat untuk melihat radiologi khusus Breast Examination, add by rangga 16 Febuari 2016
if ($raddental->num_rows() > 0){
	foreach($raddental->result() as $row_dental){}
	//echo "punya data";
}

// Fungsi ini dibuat untuk melihat radiologi khusus Grade, add by rangga 16 Febuari 2016
if ($jud->num_rows() > 0){
	foreach($jud->result() as $row_grade){}
	//echo "punya data";
}

?>
<table border="0" align="center" width="750px">
<tr>
	<td>
<div style="width:700px; font-family: 'Times New Roman', Times, serif; font-size: 10px; padding-left:20px;">
</br>
</br>
				<table class="altrowstable3" id="alternatecolor3" width="100%">
					<tr>
						<td valign="top" width="180px">Name</td>
						<td valign="top" colspan="2"><?php echo $row->pat_name;?>, <?php echo $row->title_desc;?></td>
						<td valign="top" colspan="2"><?php echo $row->gender;?></td>
						<td valign="top" ><?=findage_detail($row->pat_dob);?></td>
					</tr>
				</table>
				<table class="altrowstable3" id="alternatecolor3" width="100%">
					<tr>
						<td valign="top" width="180px">Date of Birth</td>
						<td valign="top" colspan="2"><?php echo $row->pat_dob;?></td>
						<td valign="top" colspan="2">ID. Number</td>
						<td valign="top" ><?php echo $row->id_reg;?></td>
					</tr>
				</table>
				<table class="altrowstable3" id="alternatecolor3" width="100%">
					<tr>
						<td valign="top" width="180px">Office</td>
						<td valign="top" colspan="5"><?php echo $row->client_name;?></td>
					</tr>
				</table>
				<table class="altrowstable3" id="alternatecolor3" width="100%">
					<tr>
						<td valign="top" width="180px">Address</td>
						<td valign="top" colspan="5"><?php echo $row->client_address1;?></td>
					</tr>
				</table>
				<table class="altrowstable3" id="alternatecolor3" width="100%">
					<tr>
						<td valign="top" width="180px" rowspan="2">Date of Medical Check up</td>
						<td valign="top" align="center">Now</td>
						<td valign="top" align="center">Previous</td>
						<td valign="top" align="center">Last</td>
						<td valign="top" align="center">#Visit</td>
					</tr>
					<tr>
						<td valign="top" align="center"><?php echo date("d-m-Y", strtotime($row->reg_date));?></td>
						<td valign="top" align="center"><?php echo $reg_date_previos; ?></td>
						<td valign="top" align="center"><?php echo $reg_date_last;?></td>						
						<td valign="top" align="center"><?php echo $reg_all->num_rows();?></td>						
					</tr>
					<tr>
						<td valign="top" width="180px">Type of Check up</td>
						<td valign="top" align="center"><?php echo $row->package_name;?></td>
						<td valign="top" align="center"><?php echo $package_name_previos;?></td>
						<td valign="top" align="center"><?php echo $package_name_last;?></td>
						<td valign="top" align="center"></td>
					</tr>
				</table>

</br>
</br>
</div>
	</td>
</tr>
</table>
<div class="page-break"></div>
<table border="0" align="center" width="750px">
<tr>
	<td>
<div style="width:700px; font-family: 'Times New Roman', Times, serif; font-size: 10px; padding-left:20px;">
</br>
</br>
		
				<table class="altrowstable3" id="alternatecolor3" width="100%">
					<tr>
						<td valign="center" align="middle" width="150px" rowspan="3">Content</td>
						<td valign="center" align="middle" width="100px" rowspan="3">Std.Value</td>
						<td valign="center" align="middle" colspan="3">Date of Result</td>
						<td valign="center" align="middle" rowspan="3">Unit</td>
					</tr>
					<tr>
						<td valign="top" align="center">Now</td>
						<td valign="top" align="center">Previous</td>
						<td valign="top" align="center">Last</td>
					</tr>
					<tr>
						<td valign="top" align="center"><?php echo date("d-m-Y", strtotime($row->reg_date));?></td>
						<td valign="top" align="center"><?php echo $reg_date_previos; ?></td>
						<td valign="top" align="center"><?php echo $reg_date_last;?></td>
					</tr>
					<tr>
						<td valign="top" colspan="6">&#9830; <b>Anthropometry</b></td>
					</tr>
					<tr>
						<td valign="top">Height</td>
						<td valign="top" align="middle"></td>
						<td valign="top" align="middle"><?php echo $row_2->height;?></td>
						<td valign="top" align="middle"><?php if (isset($reg_date[1])){echo $row_previos->height;} else {}?></td>
						<td valign="top" align="middle"><?php if (isset($reg_date[2])){echo $row_last->height;} else {}?></td>
						<td valign="top">Cm</td>
					</tr>
					<tr>
						<td valign="top">Weight</td>
						<td valign="top" align="middle"></td>
						<td valign="top" align="middle"><?php echo $row_2->weight;?></td>
						<td valign="top" align="middle"><?php if (isset($reg_date[1])){echo $row_previos->weight;} else {}?></td>
						<td valign="top" align="middle"><?php if (isset($reg_date[2])){echo $row_last->weight;} else {}?></td>
						<td valign="top">Kg</td>
					</tr>
					<tr>
						<td valign="top">Standard Weight</td>
						<td valign="top" align="middle"></td>
						<td valign="top" align="middle"><?php echo $row_2->std_weight;?></td>
						<td valign="top" align="middle"><?php if (isset($reg_date[1])){echo $row_previos->std_weight;} else {}?></td>
						<td valign="top" align="middle"><?php if (isset($reg_date[2])){echo $row_last->std_weight;} else {}?></td>
						<td valign="top">Kg</td>
					</tr>
					<tr>
						<td valign="top">Obese index</td>
						<td valign="top" align="middle"></td>
						<td valign="top" align="middle"><?php echo $row_2->obe_index;?></td>
						<td valign="top" align="middle"><?php if (isset($reg_date[1])){echo $row_previos->obe_index;} else {}?></td>
						<td valign="top" align="middle"><?php if (isset($reg_date[2])){echo $row_last->obe_index;} else {}?></td>						
						<td valign="top">%</td>
					</tr>
					<tr>
						<td valign="top">BMI</td>
						<td valign="top" align="middle"></td>
						<td valign="top" align="middle"><?php echo $row_2->bmi;?></td>
						<td valign="top" align="middle"><?php if (isset($reg_date[1])){echo $row_previos->bmi;} else {}?></td>
						<td valign="top" align="middle"><?php if (isset($reg_date[2])){echo $row_last->bmi;} else {}?></td>						
						<td valign="top">%</td>
					</tr>
					<tr>
						<td valign="top">FAT</td>
						<td valign="top" align="middle"></td>
						<td valign="top" align="middle"><?php echo $row_2->fat_percent;?></td>
						<td valign="top" align="middle"><?php if (isset($reg_date[1])){echo $row_previos->fat_percent;} else {}?></td>
						<td valign="top" align="middle"><?php if (isset($reg_date[2])){echo $row_last->fat_percent;} else {}?></td>						
						<td valign="top">%</td>
					</tr>
					<tr>
						<td valign="top">Abdominal Girth</td>
						<td valign="top" align="middle"></td>
						<td valign="top" align="middle"><?php echo $row_2->abd_girth;?></td>
						<td valign="top" align="middle"><?php if (isset($reg_date[1])){echo $row_previos->abd_girth;} else {}?></td>
						<td valign="top" align="middle"><?php if (isset($reg_date[2])){echo $row_last->abd_girth;} else {}?></td>						
						<td valign="top">Cm</td>
					</tr>
					<tr>
						<td valign="top" >&rArr; Comments</td>
						<td valign="top" colspan="5"><?php echo str_replace(";",", ",$row_2->ant_comment);?></td>
					</tr>
					<tr>
						<td valign="top" colspan="6">&#9830; <b>Eyes Test</b></td>
					</tr>
					<tr>
						<td valign="top">Glass off – Right</td>
						<td valign="top" align="middle"></td>
						<td valign="top" align="middle"><?php echo $row_2->glasses_off_right;?></td>
						<td valign="top" align="middle"><?php if (isset($reg_date[1])){echo $row_previos->glasses_off_right;} else {}?></td>
						<td valign="top" align="middle"><?php if (isset($reg_date[2])){echo $row_last->glasses_off_right;} else {}?></td>						
						<td valign="top"></td>
					</tr>
					<tr>
						<td valign="top">Glass off – Left</td>
						<td valign="top" align="middle"></td>
						<td valign="top" align="middle"><?php echo $row_2->glasses_off_left;?></td>
						<td valign="top" align="middle"><?php if (isset($reg_date[1])){echo $row_previos->glasses_off_left;} else {}?></td>
						<td valign="top" align="middle"><?php if (isset($reg_date[2])){echo $row_last->glasses_off_left;} else {}?></td>			
						<td valign="top"></td>
					</tr>
					<tr>
						<td valign="top">Glass on – Right</td>
						<td valign="top" align="middle"></td>
						<td valign="top" align="middle"><?php echo $row_2->glasses_plus_right;?></td>
						<td valign="top" align="middle"><?php if (isset($reg_date[1])){echo $row_previos->glasses_plus_right;} else {}?></td>
						<td valign="top" align="middle"><?php if (isset($reg_date[2])){echo $row_last->glasses_plus_right;} else {}?></td>	
						<td valign="top" align="middle"></td>
					</tr>
					<tr>
						<td valign="top">Glass on – Left</td>
						<td valign="top" align="middle"></td>
						<td valign="top" align="middle"><?php echo $row_2->glasses_plus_left;?></td>
						<td valign="top" align="middle"><?php if (isset($reg_date[1])){echo $row_previos->glasses_plus_left;} else {}?></td>
						<td valign="top" align="middle"><?php if (isset($reg_date[2])){echo $row_last->glasses_plus_left;} else {}?></td>	
						<td valign="top"></td>
					</tr>
					<tr>
						<td valign="top">Ocular Tension-Right</td>
						<td valign="top" align="middle"></td>
						<td valign="top" align="middle"><?php echo $row_2->ocular_right;?></td>
						<td valign="top" align="middle"><?php if (isset($reg_date[1])){echo $row_previos->ocular_right;} else {}?></td>
						<td valign="top" align="middle"><?php if (isset($reg_date[2])){echo $row_last->ocular_right;} else {}?></td>
						<td valign="top">mmHg</td>
					</tr>
					<tr>
						<td valign="top">Ocular Tension-Left</td>
						<td valign="top" align="middle"></td>
						<td valign="top" align="middle"><?php echo $row_2->ocular_left;?></td>
						<td valign="top" align="middle"><?php if (isset($reg_date[1])){echo $row_previos->ocular_left;} else {}?></td>
						<td valign="top" align="middle"><?php if (isset($reg_date[2])){echo $row_last->ocular_left;} else {}?></td>
						<td valign="top">mmHg</td>
					</tr>
					<tr>
						<td valign="top">Color Blindness</td>
						<td valign="top" align="middle"></td>
						<td valign="top" align="middle"><?php echo $row_2->color_blind;?></td>
						<td valign="top" align="middle"><?php if (isset($reg_date[1])){echo $row_previos->color_blind;} else {}?></td>
						<td valign="top" align="middle"><?php if (isset($reg_date[2])){echo $row_last->color_blind;} else {}?></td>
						<td valign="top"></td>
					</tr>
					<tr>
						<td valign="top" colspan="6">&#9830; <b>Refraction</b></td>
					</tr>
					<tr>
						<td valign="top">Refraction - Right</td>
						<td valign="top" align="middle"></td>
						<td valign="top" align="middle"><?php echo $row_2->ref_right;?></td>
						<td valign="top" align="middle"><?php if (isset($reg_date[1])){echo $row_previos->ref_right;} else {}?></td>
						<td valign="top" align="middle"><?php if (isset($reg_date[2])){echo $row_last->ref_right;} else {}?></td>
						<td valign="top"></td>
					</tr>
					<tr>
						<td valign="top">Refraction - Left</td>
						<td valign="top" align="middle"></td>
						<td valign="top" align="middle"><?php echo $row_2->ref_left;?></td>
						<td valign="top" align="middle"><?php if (isset($reg_date[1])){echo $row_previos->ref_left;} else {}?></td>
						<td valign="top" align="middle"><?php if (isset($reg_date[2])){echo $row_last->ref_left;} else {}?></td>
						<td valign="top"></td>
					</tr>
					<tr>
						<td valign="top">Fundus Scheie H</td>
						<td valign="top" align="middle"></td>
						<td valign="top" align="middle"><?php echo $row_2->fundus_H;?></td>
						<td valign="top" align="middle"><?php if (isset($reg_date[1])){echo $row_previos->fundus_H;} else {}?></td>
						<td valign="top" align="middle"><?php if (isset($reg_date[2])){echo $row_last->fundus_H;} else {}?></td>
						<td valign="top"></td>
					</tr>
					<tr>
						<td valign="top">Fundus Scheie S</td>
						<td valign="top" align="middle"></td>
						<td valign="top" align="middle"><?php echo $row_2->fundus_S;?></td>
						<td valign="top" align="middle"><?php if (isset($reg_date[1])){echo $row_previos->fundus_S;} else {}?></td>
						<td valign="top" align="middle"><?php if (isset($reg_date[2])){echo $row_last->fundus_S;} else {}?></td>
						<td valign="top"></td>
					</tr>
					<tr>
						<td valign="top" >&rArr; Comments</td>
						<td valign="top" colspan="5"><?php echo $row_2->ref_comment;?></td>
					</tr>
					<tr>
						<td valign="top" colspan="6">&#9830; <b>ENT/THT</b> <?php echo $row_2->tht_comment;?></td>
					</tr>
					<tr>
						<td valign="top" colspan="6">&#9830; <b>Hearing</b></td>
					</tr>
					<tr>
						<td valign="top">1000HZ - Right</td>
						<td valign="top" align="middle"></td>
						<td valign="top" align="middle"><?php echo $row_2->audio_right_1k;?></td>
						<td valign="top" align="middle"><?php if (isset($reg_date[1])){echo $row_previos->audio_right_1k;} else {}?></td>
						<td valign="top" align="middle"><?php if (isset($reg_date[2])){echo $row_last->audio_right_1k;} else {}?></td>
						<td valign="top">d b</td>
					</tr>
					<tr>
						<td valign="top">1000HZ - Left</td>
						<td valign="top" align="middle"></td>
						<td valign="top" align="middle"><?php echo $row_2->audio_left_1k;?></td>
						<td valign="top" align="middle"><?php if (isset($reg_date[1])){echo $row_previos->audio_left_1k;} else {}?></td>
						<td valign="top" align="middle"><?php if (isset($reg_date[2])){echo $row_last->audio_left_1k;} else {}?></td>
						<td valign="top">d b</td>
					</tr>
					<tr>
						<td valign="top">4000HZ - Right</td>
						<td valign="top" align="middle"></td>
						<td valign="top" align="middle"><?php echo $row_2->audio_right_4k;?></td>
						<td valign="top" align="middle"><?php if (isset($reg_date[1])){echo $row_previos->audio_right_4k;} else {}?></td>
						<td valign="top" align="middle"><?php if (isset($reg_date[2])){echo $row_last->audio_right_4k;} else {}?></td>
						<td valign="top">d b</td>
					</tr>
					<tr>
						<td valign="top">4000HZ - Left</td>
						<td valign="top" align="middle"></td>
						<td valign="top" align="middle"><?php echo $row_2->audio_left_4k;?></td>
						<td valign="top" align="middle"><?php if (isset($reg_date[1])){echo $row_previos->audio_left_4k;} else {}?></td>
						<td valign="top" align="middle"><?php if (isset($reg_date[2])){echo $row_last->audio_left_4k;} else {}?></td>
						<td valign="top">d b</td>
					</tr>
					<tr>
						<td valign="top" >&rArr; Comments</td>
						<td valign="top" colspan="5"><?php echo $row_2->aud_comment;?></td>
					</tr>
					<tr>
						<td valign="top" colspan="6">&#9830; <b>Blood Pressure</b></td>
					</tr>
					<tr>
						<td valign="top">Systolic</td>
						<td valign="top" align="middle"></td>
						<td valign="top" align="middle"><?php echo $row_2->bp_systolic;?></td>
						<td valign="top" align="middle"><?php if (isset($reg_date[1])){echo $row_previos->bp_systolic;} else {}?></td>
						<td valign="top" align="middle"><?php if (isset($reg_date[2])){echo $row_last->bp_systolic;} else {}?></td>
						<td valign="top">mmHg</td>
					</tr>
					<tr>
						<td valign="top">Diastolic</td>
						<td valign="top" align="middle"></td>
						<td valign="top" align="middle"><?php echo $row_2->bp_diastolic;?></td>
						<td valign="top" align="middle"><?php if (isset($reg_date[1])){echo $row_previos->bp_diastolic;} else {}?></td>
						<td valign="top" align="middle"><?php if (isset($reg_date[2])){echo $row_last->bp_diastolic;} else {}?></td>
						<td valign="top">mmHg</td>
					</tr>
					<tr>
						<td valign="top" >&rArr; Comments</td>
						<td valign="top" colspan="5"><?php echo $row_2->bp_diastolic;?></td>
					</tr>
				</table>
</br>
</br>
</div>
	</td>
</tr>
</table>
<div class="page-break"></div>
<table border="0" align="center" width="750px">
<tr>
	<td>
<div style="width:700px; font-family: 'Times New Roman', Times, serif; font-size: 10px; padding-left:20px;">
</br>
</br>
				<table class="altrowstable3" id="alternatecolor3" width="100%">
					<tr>
						<td valign="center" align="middle" rowspan="3">Content</td>
						<td valign="center" align="middle" rowspan="3">Std.Value</td>
						<td valign="center" align="middle" colspan="3">Date of Result</td>
						<td valign="center" align="middle" rowspan="3">Unit</td>
					</tr>
					<tr>
						<td valign="top" align="center">Now</td>
						<td valign="top" align="center">Previous</td>
						<td valign="top" align="center">Last</td>
					</tr>
					<tr>
						<td valign="top" align="center"><?php echo date("d-m-Y", strtotime($row->reg_date));?></td>
						<td valign="top" align="center"><?php echo $reg_date_previos; ?></td>
						<td valign="top" align="center"><?php echo $reg_date_last;?></td>
					</tr>
					<tr>
						<td valign="top" colspan="6">&#9830; <b>Respiratory system</b></td>
					</tr>
					<tr>
						<td valign="top">Forced Vital Capacity</td>
						<td valign="top"></td>
						<td valign="top"><?php echo $row_2->lung_vital;?></td>
						<td valign="top"><?php if (isset($reg_date[1])){echo $row_previos->lung_vital;} else {}?></td>
						<td valign="top"><?php if (isset($reg_date[2])){echo $row_last->lung_vital;} else {}?></td>
						<td valign="top">ml</td>
					</tr>
					<tr>
						<td valign="top">% FVC</td>
						<td valign="top"></td>
						<td valign="top"><?php echo $row_2->lung_vital_percent;?></td>
						<td valign="top"><?php if (isset($reg_date[1])){echo $row_previos->lung_vital_percent;} else {}?></td>
						<td valign="top"><?php if (isset($reg_date[2])){echo $row_last->lung_vital_percent;} else {}?></td>
						<td valign="top">%</td>
					</tr>
					<tr>
						<td valign="top">FEV 1/FVC %</td>
						<td valign="top"></td>
						<td valign="top"><?php echo $row_2->lung_fev;?></td>
						<td valign="top"><?php if (isset($reg_date[1])){echo $row_previos->lung_fev;} else {}?></td>
						<td valign="top"><?php if (isset($reg_date[2])){echo $row_last->lung_fev;} else {}?></td>
						<td valign="top">%</td>
					</tr>
					<tr>
						<td valign="top">Classification of Ventilation</td>
						<td valign="top"></td>
						<td valign="top"><?php echo $row_2->class_venti;?></td>
						<td valign="top"><?php if (isset($reg_date[1])){echo $row_previos->class_venti;} else {}?></td>
						<td valign="top"><?php if (isset($reg_date[2])){echo $row_last->class_venti;} else {}?></td>
						<td valign="top">L</td>
					</tr>
					<tr>
						<td valign="top" >&rArr; Comments</td>
						<td valign="top" colspan="5"><?php echo $row_2->res_comment;?></td>
					</tr>
					
					<!-- Note data akan muncul jika data lab ada jika tidak maka dihidden -->
					<?php 	
					$current_comment 	= null;
					$current_comment_2 	= null;			
					$nilai				= null;
					$nilai_2			= null;
					$i=1;					
					foreach($lab->result() as $row_lab){
					?>

					<?php
					echo "<tr>";
					if ($row_lab->group_name != $current_cat){
						$current_cat = $row_lab->group_name;
						echo "<td valign='top' colspan='6'><b><u>". $current_cat . "</u></b>";
					}else{}
					?>					
					</tr>
					<?php if($row_lab->id_lab_item != 'comment'){?>
					<tr>
						<td valign="top">
						 <?php echo $row_lab->lab_item_desc; ?>
						 </td>
						<td valign="top"></td>
						<td valign="top"><?php echo $row_lab->now;?></td>
						<td valign="top"><?php echo $row_lab->previous;?></td>
						<td valign="top"><?php echo $row_lab->last;?></td>						
						<td valign="top"></td>
					</tr>
					<?php }?>

					
					<tr>
					<?php 
					if($row_lab->id_lab_item == 'comment'){ 
					$current_comment_2 = $row_lab->lab_item_desc;
					$nilai	= $i++;
					?>	
						<td valign="top" width="140px">&rArr; Comments</td>
						<td valign="top" colspan=5><?php echo $current_comment_2;?></td>					
					<?php }else{} ?>
					</tr>
				
					<?php 
					} 
					?>

					
					<!-- Note data akan muncul jika data radiology ada jika tidak maka dihidden -->
					<?php 
					$current_cat = null;					
					foreach($rad->result() as $row_rad){
					
					if ($row_rad->group_desc != $current_cat){
					$current_cat = $row_rad->group_desc;
					echo "<tr><td valign='top' colspan='6'><b><u>". $row_rad->group_desc . "</u></b></tr>";
					}else{
					
					}
					?>
					<tr>
						<td valign="top" width="140px" >Now</td>
						<td valign="top" colspan=5><?php echo $row_rad->rad_item;?> : <?php echo $row_rad->now;?></td>
					</tr>
					<tr>
						<td valign="top" width="140px">Previous</td>
						<td valign="top" colspan=5><?php echo $row_rad->rad_item;?> : <?php echo $row_rad->previous;?></td>
					</tr>
					<tr>
						<td valign="top" width="140px">Last</td>
						<td valign="top" colspan=5><?php echo $row_rad->rad_item;?> : <?php echo $row_rad->last;?></td>
					</tr>
					<tr>
						<td valign="top" width="140px">&rArr; Comments</td> 
						<td valign="top" colspan=5><?php echo $row_rad->comment;?></td>
					</tr>
					<?php } ?>
				</table>
</br>
</br>
</div>
	</td>
</tr>
</table>
<div class="page-break"></div>
<table border="0" align="center" width="750px">
<tr>
	<td>
<div style="width:700px; font-family: 'Times New Roman', Times, serif; font-size: 10px; padding-left:20px;">
</br>
</br>
				<table class="altrowstable3" id="alternatecolor3" width="100%">
					<tr>
						<td valign="top" colspan="6">&#9830; <b>Stomach X-ray</b></td>
					</tr>
									
					<tr>
						<td valign="top" width="140px">Now</td>						
						<td valign="top">
						<?php 
							if ($rads->num_rows() > 0){
								echo $row_spb->rad_item.'&nbsp;&nbsp;&nbsp;&nbsp;<p class="test">'.$row_spb->now;
							} else {}								
						?>						
						</td>
					</tr>
					<tr>
						<td valign="top" width="140px">Previous</td>
						<td valign="top">
						<?php 
							if ($rads->num_rows() > 0 ){
								echo $row_spb->rad_item.'&nbsp;&nbsp;&nbsp;&nbsp;<p class="test">'.$row_spb->previous;
							} else {}								
						?>						
						</td>
					</tr>
					<tr>
						<td valign="top" width="140px">Last</td>
						<td valign="top">
						<?php 
							if ($rads->num_rows() > 0){
								echo $row_spb->rad_item.'&nbsp;&nbsp;&nbsp;&nbsp;<p class="test">'.$row_spb->last;
							} else {}								
						?>			
						</td>
					</tr>
					<tr>
						<td valign="top" width="140px">&rArr; Comments</td>
						<td valign="top">
						<?php 
							if ($rads->num_rows() > 0){
								echo $row_spb->comment;
							} else {}								
						?>	
						</td>
					</tr>
				</table>
				<table class="altrowstable3" id="alternatecolor3" width="100%">
					<tr>
						<td valign="top" colspan="2">&#9830; <b>Pap Smear</b></td>
						<td valign="top" colspan="2">&#9830; <b>Breast Examination</b></td>
					</tr>
					<tr>
						<td valign="top" width="140px">Now</td>
						<td valign="top">
						<?php 
							if ($radp->num_rows() > 0){
								echo $row_pap->pap_result;
							} else {}								
						?>								
						</td>
						<td valign="top" width="140px">Now</td>
						<td valign="top">
						<?php 
							if ($radb->num_rows() > 0){
								echo $row_breast->brs_result;
							} else {}								
						?>	
						</td>
					</tr>
					<tr>
						<td valign="top" width="140px">Previous</td>
						<td valign="top"><?php if (isset($reg_date[1])){echo $row_pap1->pap_result;} else {} ?>	</td>
						<td valign="top" width="140px">Previous</td>
						<td valign="top"><?php if (isset($reg_date[1])){echo $row_breast1->brs_result;} else {} ?>	</td>
					</tr>
					<tr>
						<td valign="top" width="140px">Last</td>
						<td valign="top"><?php if (isset($reg_date[2])){echo $row_pap2->pap_result;} else {} ?>	</td>
						<td valign="top" width="140px">Last</td>
						<td valign="top"><?php if (isset($reg_date[2])){echo $row_breast2->brs_result;} else {} ?>	</td>
					</tr>
					<tr>
						<td valign="top" width="140px">&rArr; Comments</td>
						<td valign="top">
						<?php 
							if ($radp->num_rows() > 0){
								echo $row_pap->pap_comment;
							}else{}								
						?>	
						</td>
						<td valign="top" width="140px">&rArr; Comments</td>
						<td valign="top">
						<?php 
							if ($radb->num_rows() > 0){
								echo $row_breast->brs_comment;
							}else{}								
						?>	
					</td>
					</tr>
				</table>
				<table class="altrowstable3" id="alternatecolor3" width="100%">
					<tr>
						<td valign="top" colspan="6">&#9830; <b>Dental Hygiene</b></td>
					</tr>
					<tr>
						<td valign="top" width="140px"></td>
						<td valign="top" width="140px">Now</td>
						<td valign="top" width="140px">Previous</td>
						<td valign="top" width="140px">Last</td>
					</tr>
					<tr>
						<td valign="top">Dental Hygiene</td>
						<td valign="top">
						<?php
						if ($raddental->num_rows() > 0){
							echo $row_dental->now_hygn;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($raddental->num_rows() > 0){
							echo $row_dental->previous_hygn;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($raddental->num_rows() > 0){
							echo $row_dental->last_hygn;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top">Extra Oral</td>
						<td valign="top">
						<?php
						if ($raddental->num_rows() > 0){
							echo $row_dental->now_oral;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($raddental->num_rows() > 0){
							echo $row_dental->previous_oral;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($raddental->num_rows() > 0){
							echo $row_dental->last_oral;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top" colspan="4">Panoramic X-ray</td>
					</tr>
					<tr>
						<td valign="top" align="center" colspan="4"><img src='<?php echo base_url();?>design/images/fotogigi.png' style="width: 600px;"></td>
					</tr>
					<tr>
						<td valign="top">Intra oral</td>
						<td valign="top">
						<?php
						if ($raddental->num_rows() > 0){
							echo $row_dental->now_pnrm;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($raddental->num_rows() > 0){
							echo $row_dental->previous_pnrm;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($raddental->num_rows() > 0){
							echo $row_dental->last_pnrm;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top">Impaction teeth</td>
						<td valign="top">
						<?php
						if ($raddental->num_rows() > 0){
							echo $row_dental->now_impc;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($raddental->num_rows() > 0){
							echo $row_dental->previous_impc;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($raddental->num_rows() > 0){
							echo $row_dental->last_impc;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top">Broken</td>
						<td valign="top">
						<?php
						if ($raddental->num_rows() > 0){
							echo $row_dental->now_brok;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($raddental->num_rows() > 0){
							echo $row_dental->previous_brok;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($raddental->num_rows() > 0){
							echo $row_dental->last_brok;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top">Cyst/granuloma</td>
						<td valign="top">
						<?php
						if ($raddental->num_rows() > 0){
							echo $row_dental->now_cyst;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($raddental->num_rows() > 0){
							echo $row_dental->previous_cyst;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($raddental->num_rows() > 0){
							echo $row_dental->last_cyst;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top">Mobilization of teeth</td>
						<td valign="top">
						<?php
						if ($raddental->num_rows() > 0){
							echo $row_dental->now_mobi;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($raddental->num_rows() > 0){
							echo $row_dental->previous_mobi;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($raddental->num_rows() > 0){
							echo $row_dental->last_mobi;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top">Calculus/Plaque</td>
						<td valign="top">
						<?php
						if ($raddental->num_rows() > 0){
							echo $row_dental->now_calc;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($raddental->num_rows() > 0){
							echo $row_dental->previous_calc;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($raddental->num_rows() > 0){
							echo $row_dental->last_calc;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top">Caries</td>
						<td valign="top">
						<?php
						if ($raddental->num_rows() > 0){
							echo $row_dental->now_cari;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($raddental->num_rows() > 0){
							echo $row_dental->previous_cari;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($raddental->num_rows() > 0){
							echo $row_dental->last_cari;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top">Filling</td>
						<td valign="top">
						<?php
						if ($raddental->num_rows() > 0){
							echo $row_dental->now_fill;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($raddental->num_rows() > 0){
							echo $row_dental->previous_fill;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($raddental->num_rows() > 0){
							echo $row_dental->last_fill;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top">Missing</td>
						<td valign="top">
						<?php
						if ($raddental->num_rows() > 0){
							echo $row_dental->now_miss;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($raddental->num_rows() > 0){
							echo $row_dental->previous_miss;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($raddental->num_rows() > 0){
							echo $row_dental->last_miss;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top" width="140px">&rArr; Comments</td>
						<td valign="top" colspan="3" >
						<?php
						if ($raddental->num_rows() > 0){
							echo $row_dental->now_comment;
						}
						?>
						</td>
					</tr>
				</table>
</br>
</br>
</div>
	</td>
</tr>
</table>
<div class="page-break"></div>
<table border="0" align="center" width="750px">
<tr>
	<td>
<div style="width:700px; font-family: 'helvetica', helvetica, serif; font-size: 10px; padding-left:20px;">
</br>
</br>
				<table class="altrowstable3" id="alternatecolor3" width="100%">
					<tr>
						<td valign="center" align="middle" rowspan="3"><b>Content</b></td>
						<td valign="center" align="middle" colspan="3"><b>Grade</b></td>
						<td valign="center" align="middle" rowspan="3"><b>Content</b></td>
						<td valign="center" align="middle" colspan="3"><b>Grade</b></td>
					</tr>
					<tr>
						<td align="middle" rowspan="2">Now</td>
						<td align="middle" rowspan="2">Previous</td>
						<td align="middle" rowspan="2">Last</td>
					</tr>
					<tr>
						<td align="middle">Now</td>
						<td align="middle">Previous</td>
						<td align="middle">Last</td>
					</tr>
					<tr>
						<td valign="top">Obesities</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->now_Obesitas;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->previous_Obesitas;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->last_Obesitas;
						}
						?>
						</td>
						<td valign="top">Immunology test</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->now_Immunology_Test;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->previous_Immunology_Test;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->last_Immunology_Test;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top">Eyes Sight</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->now_Eyes_Sight;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->previous_Eyes_Sight;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->last_Eyes_Sight;
						}
						?>
						</td>
						<td valign="top">Diabetes Mellitus HbA1c</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->now_Diabetes_Mellitus;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->previous_Diabetes_Mellitus;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->last_Diabetes_Mellitus;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top">Ocular Tension</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->now_Ocular_Tension;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->previous_Ocular_Tension;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->last_Ocular_Tension;
						}
						?>
						</td>
						<td valign="top">Blood glucose</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->now_Blood_Glucose;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->previous_Blood_Glucose;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->last_Blood_Glucose;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top">Color Blindness</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->now_Color_Blindness;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->previous_Color_Blindness;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->last_Color_Blindness;
						}
						?>
						</td>
						<td valign="top">Urine Glucose</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->now_Urine_Glucose;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->previous_Urine_Glucose;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->last_Urine_Glucose;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top">Fundus</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->now_Fundus;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->previous_Fundus;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->last_Fundus;
						}
						?>
						</td>
						<td valign="top">Fructosamine</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->now_Fructosamine;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->previous_Fructosamine;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->last_Fructosamine;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top">Hearing</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->now_Hearing;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->previous_Hearing;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->last_Hearing;
						}
						?>
						</td>
						<td valign="top">Tumor marker</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->now_Tumor_Marker;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->previous_Tumor_Marker;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->last_Tumor_Marker;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top">Blood Pressure</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->now_Blood_Pressure;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->previous_Blood_Pressure;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->last_Blood_Pressure;
						}
						?>
						</td>
						<td valign="top">Chest X-ray</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->now_Chest_Xray;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->previous_Chest_Xray;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->last_Chest_Xray;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top">Lung Function</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->now_Lung_Function;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->previous_Lung_Function;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->last_Lung_Function;
						}
						?>
						</td>
						<td valign="top">X-ray Shadow</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->now_Xray_Shadow;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->previous_Xray_Shadow;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->last_Xray_Shadow;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top">Urine Analysis</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->now_Urine_Analysis;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->previous_Urine_Analysis;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->last_Urine_Analysis;
						}
						?>
						</td>
						<td valign="top">Sputum</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->now_Sputum;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->previous_Sputum;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->last_Sputum;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top">Urine Sediment</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->now_Urine_Sediment;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->previous_Urine_Sediment;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->last_Urine_Sediment;
						}
						?>
						</td>
						<td valign="top">ECG</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->now_ECG;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->previous_ECG;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->last_ECG;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top">OB/parasite in stool</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->now_OB;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->previous_OB;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->last_OB;
						}
						?>
						</td>
						<td valign="top">Treadmill</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->now_Treadmill;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->previous_Treadmill;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->last_Treadmill;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top">Liver function</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->now_Liver_Function;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->previous_Liver_Function;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->last_Liver_Function;
						}
						?>
						</td>
						<td valign="top">Echocardiographi</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->now_Echocardiographi;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->previous_Echocardiographi;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->last_Echocardiographi;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top">Renal</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->now_Renal;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->previous_Renal;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->last_Renal;
						}
						?>
						</td>
						<td valign="top">USG</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->now_usg;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->previous_usg;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->last_usg;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top">Pancreas</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->now_Pancreas;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->previous_Pancreas;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->last_Pancreas;
						}
						?>
						</td>
						<td valign="top">USG Prostate</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->now_usgpros;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->previous_usgpro;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->last_usgpros;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top">Uric acid</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->now_Uric_Acid;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->previous_Uric_Acid;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->last_Uric_Acid;
						}
						?>
						</td>
						<td valign="top">USG Uterus</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->now_usgut;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->previous_usgut;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->last_usgut;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top">Lipid</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->now_Lipid;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->previous_Lipid;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->last_Lipid;
						}
						?>
						</td>
						<td valign="top">USG Mammae</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->now_usgmam;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->previous_usgmam;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->last_usgmam;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top">Electrolyte</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->now_Electrolyte;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->previous_Electrolyte;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->last_Electrolyte;
						}
						?>
						</td>
						<td valign="top">Stomach X-ray</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->now_stomach;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->previous_stomach;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->last_stomach;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top">Anemia Test</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->now_Anemia_Test;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->previous_Anemia_Test;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->last_Anemia_Test;
						}
						?>
						</td>
						<td valign="top">Pap Smear</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->now_pap;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->previous_pap;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->last_pap;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top">Hematology</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->now_Hematology;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->previous_Hematology;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->last_Hematology;
						}
						?>
						</td>
						<td valign="top">Breast Examination</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->now_breast;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->previous_breast;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->last_breast;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top">WBC Classification</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->now_WBC_Classification;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->previous_WBC_Classification;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->last_WBC_Classification;
						}
						?>
						</td>
						<td valign="top">Extra Oral</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->now_Extra_Oral;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->previous_Extra_Oral;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->last_Extra_Oral;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top">Inflammation</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->now_Inflammation;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->previous_Inflammation;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->last_Inflammation;
						}
						?>
						</td>
						<td valign="top">Panoramic X-ray</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->now_panoramic;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->previous_panoramic;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->last_panoramic;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top">Syphilis</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->now_Syphilis;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->previous_Syphilis;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->last_Syphilis;
						}
						?>
						</td>
						<td valign="top">Intra oral</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->now_intra_oral;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->previous_intra_oral;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->last_intra_oral;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top">Serology Hepatitis</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->now_Serology_Hepatitis;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->previous_Serology_Hepatitis;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->last_Serology_Hepatitis;
						}
						?>
						</td>
						<td valign="top">Dental Hygiene</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->now_dental_hygn;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->previous_dental_hygn;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->last_dental_hygn;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top">Others</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->now_Others;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->previous_Others;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jud->num_rows() > 0){
							echo $row_grade->last_Others;
						}
						?>
						</td>
						<td valign="top"></td>
						<td valign="top"></td>
						<td valign="top"></td>
						<td valign="top"></td>
					</tr>
				</table>
					
				</br>
				<div style="width:700px; font-family: 'helvetica', helvetica, serif; font-size: 13px; padding-left:15px;">
				<b>Grade of Result</b></br>
				A. No Problem</br>
				B. A little problem, but not influence on daily life</br>
				BF. Same as B, but need to follow up</br>
				C. Need care on daily life</br>
				D. Need medical treatment</br>
				E. Under treatment</br>
				N. Not tested</br>
				</div>
</br>
</br>
</div>
	</td>
</tr>
</table>
<div class="page-break"></div>
<table border="0" align="center" width="750px">
<tr>
	<td>
<div style="width:700px; font-family: 'helvetica', helvetica, serif; font-size: 14px; padding-left:20px;">
</br>
<?php
if($jud->num_rows() > 0){
$cars = array("$row_grade->now_Obesitas", "$row_grade->now_Eyes_Sight", "$row_grade->now_Ocular_Tension", "$row_grade->now_Color_Blindness", "$row_grade->last_Fundus", "$row_grade->last_Hearing", "Blood Pressure", "$row_grade->now_Lung_Function", "$row_grade->now_Urine_Analysis", "$row_grade->now_Urine_Sediment", "$row_grade->now_OB", "$row_grade->now_Liver_Function", "$row_grade->now_Renal", "$row_grade->now_Pancreas", "$row_grade->now_Uric_Acid", "$row_grade->now_Lipid", "$row_grade->now_Electrolyte", "$row_grade->now_Anemia_Test", "$row_grade->now_Hematology", "$row_grade->now_WBC_Classification", "$row_grade->now_Inflammation", "$row_grade->now_Syphilis", "$row_grade->now_Serology_Hepatitis", "$row_grade->now_Others", "$row_grade->now_Immunology_Test", "$row_grade->now_Diabetes_Mellitus", "$row_grade->now_Blood_Glucose", "$row_grade->now_Urine_Glucose", "$row_grade->now_Fructosamine", "$row_grade->now_Tumor_Marker", "$row_grade->now_Chest_Xray", "$row_grade->now_Xray_Shadow", "$row_grade->now_Sputum", "$row_grade->now_ECG", "$row_grade->now_Treadmill", "$row_grade->now_Echocardiographi", "$row_grade->now_usg", "$row_grade->now_usgpros", "$row_grade->now_usgut", "$row_grade->now_usgmam", "$row_grade->now_stomach", "$row_grade->now_pap", "$row_grade->now_breast", "$row_grade->now_Extra_Oral", "$row_grade->now_panoramic", "$row_grade->now_intra_oral", "$row_grade->now_dental_hygn");
rsort($cars);
?>
<b>Grade : <?php  echo $cars[0]; ?></b></br>
<?php
}
?>
</br>
Comments</br></br>
						<?php
						if ($find->num_rows() > 0){
							echo str_replace(",",", </br>", $row_2->fitness_comment);
						}
						?>
</div>
	</td>
</tr>
</table>
<!--
<div class="page-break"></div>
<script>
window.frames["printf"].focus();
window.frames["printf"].print();
</script>
<table border="0" align="center" width="750px">
<tr>
	<td>
<iframe src="<?=base_url(). 'design/file/' . $row->id_reg. '.pdf';?>" id="printf" name="printf" title="MCU" align="top" height="100%" width="100%" frameborder="0" scrolling="auto">
</iframe> 
	<iframe src="http://docs.google.com/viewer?url=C:/Users/Administrator/Downloads/Set_Report_Title.pdf&embedded=true" width="600" height="780" style="border: none;"></iframe>	
	</td>
</tr>
</table>
-->