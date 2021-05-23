<script type="text/javascript">
// window.print();

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

table.altrowstable18 {
	font-family: verdana,arial,sans-serif;
	font-size:12px;
	color:#333333;
	border-width: 0px;
	border-color: #a9c6c9;
	border-collapse: collapse;
}
table.altrowstable18 th {
	border-width: 0px;
	padding: 3px;
	border-style: solid;
	border-color: #a9c6c9;
}
table.altrowstable18 td {
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
  font-family: verdana,arial,sans-serif;
  src: url('<?php echo base_url();?>design/font/IDAutomationHC39M.ttf');
}

@page {
  @bottom-right {
    content: counter(page) " of " counter(pages);
  }
}
</style>
	<head>
        <title>Medical Check UP Print | <?=$id_regist;?> </title>
	</head>
<?php

	foreach($data->result() as $row){}					
	foreach($find->result() as $row_2){}
	foreach($radp->result() as $row_pap){}
	foreach($radb->result() as $row_breast){}
	foreach($get_data_lock->result() as $row_lock){}


function findage_detail($dob){
		$interval = date_diff(date_create(), date_create($dob));
		echo $interval->format("%Y");
}

function array_combine_($keys, $values){
    $result = array();
    foreach ($keys as $i => $k) {
        $result[$k][] = $values[$i];
    }
    array_walk($result, create_function('&$v', '$v = (count($v) == 1)? array_pop($v): $v;'));
    return    $result;
}


	$reg_date 		=array();
	$package_name 	=array();
	$reg_date1 		=array();
	$reg_date2 		=array();
	$reg_date3 		=array();
	$reg_id1		=array();
	$reg_id2		=array();
	$reg_id3		=array();
	$qout_name1 	=array();
	$qout_name2 	=array();
	$qout_name3 	=array();
	
	// variable disini...
	$reg_date_previos 		= null;
	$package_name_previos 	= null;
	$height_previos 		= null;
	
	$package_name_last 		= null;
	$height_last			= null;
	$current_cat 			= null;
	$current_cat1 			= null;

	$arr_qout_name0			= null;
	$arr_qout_name1			= null;
	$arr_qout_name2			= null;
	$jml_grade0				= 0;
	$jml_grade1				= 0;
	$jml_grade2				= 0;

// Data Now ...	
if ($package0->num_rows() > 0) {
	foreach ($package0->result() as $value) {
		$reg_id0[] 		= $value->id_reg;
		$reg_date0[] 	= $value->reg_date;
		$qout_name0[] 	= $value->quot_name;
	}
	$arr_qout_name0		= count($qout_name0); 
}	

foreach ($all_data_grade0->result() as $row_grade0) {}
$jml_grade0 = $all_data_grade0->num_rows();

// Data Previous...
if ($arr_reg_id > 1) {
	foreach ($package1->result() as $value) {
		$reg_id1[] 		= $value->id_reg;
		$reg_date1[] 	= $value->reg_date;
		$qout_name1[] 	= $value->quot_name;
	}
	$arr_qout_name1		= count($qout_name1); 

	foreach ($all_data_grade1->result() as $row_grade1) {}
	$jml_grade1 = $all_data_grade1->num_rows();


	// print_r($reg_date1); echo "<br>";
	// print_r($qout_name1); echo "<br>";
}

// Data Last...
if ($arr_reg_id > 2) {
	foreach ($package2->result() as $value) {
		$reg_id2[] 		= $value->id_reg;
		$reg_date2[] 	= $value->reg_date;
		$qout_name2[] 	= $value->quot_name;
	}
	$arr_qout_name2		= count($qout_name2); 

	foreach ($all_data_grade2->result() as $row_grade2) {}
	$jml_grade2 = $all_data_grade2->num_rows();

	// print_r($reg_date2); echo "<br>";
	// print_r($qout_name2); echo "<br>";
}


$judul 					= "";
$content_h 				= array();
$content_d 				= array();
$now 					= array();
$previous 				= array();
$last 					= array();
$unit 					= array();
$stdvalue_fisik			= array();
$is_normal_fisik1		= array();
$is_normal_fisik2		= array();
$is_normal_fisik3		= array();

foreach($data_fisik->result() as $row_isis){
	$content_h[]		= $row_isis->content_h;
	$content_d[]		= $row_isis->content_d;
	$stdvalue_fisik[]	= $row_isis->stdvalue;
	$now[]				= $row_isis->now;
	$previous[]			= $row_isis->previous;
	$last[]				= $row_isis->last;
	$unit[]				= $row_isis->unit;
	$is_normal_fisik1[]	= $row_isis->is_normal_now;
	$is_normal_fisik2[]	= $row_isis->is_normal_previous;
	$is_normal_fisik3[]	= $row_isis->is_normal_last;
}

$arr_jml				= count($content_h); 

// -----------------------------MENDAPATKAN COMMENT------------------------------------------

$arr_idgroupservice 	= array();
$arr_unumber 			= array();
$arr_nama_comment		= array();
$arr_coment 			= array();

foreach ($list_comment->result() as $row_comment_fisik) {
	$id_mcu_result			= $row_comment_fisik->id_mcu_result;
	$id_reg					= $row_comment_fisik->id_reg;
	$arr_idgroupservice[]	= $row_comment_fisik->id_group_service;
	$arr_unumber[]			= $row_comment_fisik->unumber;
	$arr_nama_comment[]		= $row_comment_fisik->nama_comment;
	$comment				= $row_comment_fisik->comment;
	$arr_coment[] 			= $row_comment_fisik->comment;
	$created_date			= $row_comment_fisik->created_date;
	$created_by				= $row_comment_fisik->created_by;
}

$jml_arr_nama_comment		= count($arr_nama_comment); 
$arr_gabunga_deh 			= array_combine_($arr_nama_comment,$arr_coment);



// ---------------------------MENDAPAT KAN COMENT LAB------------------------------------------
$judul_lab			= "";
$content_h_lab 		= array();
$content_d_lab 		= array();
$now_lab			= array();
$previous_lab 		= array();
$last_lab 			= array();
$unit_lab 			= array();
$stdvalue_lab		= array();
$is_normal_lab1		= array();
$is_normal_lab2		= array();
$is_normal_lab3		= array();

foreach($data_lab->result() as $row_isis){
	$content_h_lab[]	= $row_isis->content_h;
	$content_d_lab[]	= $row_isis->content_d;
	$stdvalue_lab[]		= $row_isis->stdvalue;
	$now_lab[]			= $row_isis->now;
	$previous_lab[]		= $row_isis->previous;
	$last_lab[]			= $row_isis->last;
	$is_normal_lab1[]	= $row_isis->is_normal_now;
	$is_normal_lab2[]	= $row_isis->is_normal_previous;
	$is_normal_lab3[]	= $row_isis->is_normal_last;

	if (isset($row_isis->unitxx)) {
		$unit_lab[]			= $row_isis->unitxx;
	}else{
		$unit_lab[]			= $row_isis->unit;
	}
}


$arr_jml_lab		= count($content_h_lab); 


// ---------------------------MENDAPAT KAN COMENT RAD------------------------------------------
$judul_rad		= "";
$content_h_rad 	= array();
$content_d_rad 	= array();
$now_rad		= array();
$previous_rad 	= array();
$last_rad 		= array();
$unit_rad 		= array();
$stdvalue_rad 	= array();

foreach($data_rad->result() as $row_isis){
	$content_h_rad[]	= $row_isis->content_h;
	$content_d_rad[]	= $row_isis->content_d;
	$stdvalue_rad[]		= $row_isis->stdvalue;
	$now_rad[]			= $row_isis->now;
	$previous_rad[]		= $row_isis->previous;
	$last_rad[]			= $row_isis->last;
	$unit_rad[]			= $row_isis->unit;
}


$arr_jml_rad		= count($content_h_rad); 
// ---------------------------MENDAPAT KAN COMENT Dental------------------------------------------
	

	// print_r($arr_content_d); echo "<br>";
	// print_r($arr_now); echo "<br>";
	// print_r($arr_previous); echo "<br>";
	// print_r($arr_last); echo "<br>";
	if ($jml_dental > 0) { // masukan data dental ke array ...

		$arr_now_dental		 	= array_combine_($arr_content_d,$arr_now);
		$arr_previous_dental 	= array_combine_($arr_content_d,$arr_previous);
		$arr_last_dental 		= array_combine_($arr_content_d,$arr_last);
		
	}

// -----------------------------------------------------------------------

// print_r($arr_gabunga_deh); echo "<br>";
// for($x = 0; $x < $arr_jml_lab; $x++) {
// 	echo $x." - ";
// 	echo $content_h_lab[$x]; 
// 	if (array_key_exists($content_h_lab[$x], $arr_gabunga_deh)) {
// 		echo " *** masuk *** ";
// 	}
// 	echo "<br>";
// }
// exit();

// echo "<pre>".print_r($is_normal_fisik)."</pre>";
// print_r($arr_gabunga_deh['Eyes test']); echo "<br>";
// print_r($arr_gabunga_deh['Anthropometry']); echo "<br>";
// echo join(", ", $arr_gabunga_deh['Anthropometry']); echo "<br>";
// echo count($arr_gabunga_deh['Eyes test']); echo "<br>";

	// $gabung_arr = array_merge((array)$arr_nama_comment, (array)$arr_coment);
	// $gabung_arr = array_merge($arr_nama_comment, $arr_coment);
	// $gabung_arr = array_combine($arr_nama_comment, $arr_coment);
	// print_r($arr_unumber); echo "<br>";
	// print_r($arr_nama_comment); echo "<br>";
	// print_r($arr_coment); echo "<br>";
	// print_r($gabung_arr); echo "<br>";
	// print_r(array_values($arr_nama_comment), "Anthropometry"); echo "<br>";
	// print_r(array_values($arr_nama_comment, "Anthropometry ")); echo "<br>";
	// var_dump(array_value_recursive('Anthropometry', $arr_nama_comment));  echo "<br>";


// print_r($arr_gabunga_deh); echo "<br>";
// echo var_dump(array_value_recursive('Anthropometry', $arr_gabunga_deh));
 // print_r(array_keys($arr_gabunga_deh, "Anthropometry")); echo "<br>";s

// $array = array("blue", "red", "green", "blue", "blue");
// print_r(array_keys($array, "blue"));

// exit();
// -----------------------------------------------------------------------
foreach ($buka_fisik->result() as $row_bf) {}
?>
<center>
<img src="<?=base_url();?>design/images/logo.png" alt="Klinik drg. Magista LutfiaS" style="width:300px;height:200px;">
</center>
<table border="0" align="center" width="750px">
<tr>
	<td>
<div style="width:700px; font-family: 'Times New Roman', Times, serif; font-size: 10px; padding-left:20px;">
<table class="altrowstable18" width="100%">
	<tr>
		<td colspan="4" align="center"><b>PHYSICAL EXAMINATION</b></td>
	</tr>
	<tr>
		<td>Name</td>
		<td> : <b> <?php echo $row->pat_name;?>, <?php echo $row->title_desc;?></b></td>
		<td>Date Of Medical Check-Up</td>
		<td>: <?php echo date("d-m-Y", strtotime($reg_date_now));?></td>
	</tr>
	<tr>
		<td>Date Of Birth</td>
		<td> : <?php echo date("d-m-Y", strtotime($row->pat_dob));?></td>
		<td>ID. Number</td>
		<td>: <?php echo $row->id_reg;?></td>
	</tr>
	<tr>
		<td>Job Position</td>
		<td>: <?php if (isset($job[0])) { echo $job[0]; }  ?></td>
		<td></td>
		<td></td>
	</tr>
</table>
</br>
<table class="altrowstable3" id="alternatecolor3" width="100%">
<thead>
	<tr>
	<th>Contents</th>
	<th>Value</th>
	<th>Result</th>
	</tr>
</thead>
<?php $nomor =1;?>
	<tr>
		<td valign="top" rowspan="4">♦ <b>Vital Sign</b></td>
		<td><?=$nomor++;?>. Pulse Rate</td>
		<td> <?=$row_bf->pulse_rate;?> /menit</td>
	</tr>
	<tr>
		<td><?=$nomor++;?>. Breathing</td>
		<td><?=$row_bf->breathing;?> /menit</td>
	</tr>
	<tr>
		<td><?=$nomor++;?>. Blood Pressure</td>
		<td><?=$row_bf->vital_sign_bp;?> /mmHg</td>
	</tr>
	<tr>
		<td><?=$nomor++;?>. Temperature</td>
		<td><?=$row_bf->temperatur;?> &#8451;</td>
	</tr>
	<tr>
		<td valign="top" rowspan="3">♦ <b>Eyes</b></td>
	</tr>
	<tr>
		<td><?=$nomor++;?>. Anterior Chamber</td>
		<td><?=$row_bf->anteriorc;?> </td>
	</tr>
	<tr>
		<td><?=$nomor++;?>. Visual Examination</td>
		<td><?=$row_bf->eyes_visual_exam;?> </td>
	</tr>
	<tr>
		<td>&rArr; Comments</td>
		<td colspan="2"><?=$row_bf->eyes_comment;?> </td>
	</tr>
	<tr>
		<td valign="top" rowspan="3">♦ <b>Ear</b></td>
	</tr>
	<tr>
		<td><?=$nomor++;?>. Right ear</td>
		<td><?=$row_bf->ear_right;?> </td>
	</tr>
	<tr>
		<td><?=$nomor++;?>. Left ear</td>
		<td><?=$row_bf->ear_left;?> </td>
	</tr>
	<tr>
		<td valign="top" rowspan="4">♦ <b>Nose</b></td>
	</tr>
	<tr>
		<td><?=$nomor++;?>. Septum</td>
		<td><?=$row_bf->nose_septum;?> </td>
	</tr>
	<tr>
		<td><?=$nomor++;?>. Polyps</td>
		<td><?=$row_bf->nose_polyps;?></td>
	</tr>
	<tr>
		<td><?=$nomor++;?>. Conchac</td>
		<td><?=$row_bf->nose_conchae;?></td>
	</tr>
	<tr>
		<td>&rArr; Comments</td>
		<td colspan="2"><?=$row_bf->nose_comment;?></td>
	</tr>
	<tr>
		<td valign="top">♦ <b>Dental</b></td>
		<td colspan="2"> <?=$row_bf->dental;?> </td>
	</tr>
	<tr>
		<td valign="top" rowspan="3">♦ <b>Throat</b></td>
	</tr>
	<tr>
		<td><?=$nomor++;?>. Pharynx</td>
		<td><?=$row_bf->throat_pharynx;?></td>
	</tr>
	<tr>
		<td><?=$nomor++;?>. Tonsil</td>
		<td><?=$row_bf->throat_tonsil;?></td>
	</tr>
	<tr>
		<td>&rArr; Comments</td>
		<td colspan="2">
		<?=$row_bf->throat_comment;?>
		</td>
	</tr>
	<tr>
		<td valign="top" rowspan="3">♦ <b>Neck</b></td>
	</tr>
	<tr>
		<td><?=$nomor++;?>. Thyroid</td>
		<td><?=$row_bf->neck_thyroid;?></td>
	</tr>
	<tr>
		<td><?=$nomor++;?>. Lymph Node</td>
		<td> <?=$row_bf->neck_lymph;?></td>
	</tr>
	<tr>
		<td>&rArr; Comments</td>
		<td colspan="2">
		<?=$row_bf->neck_comment;?>
		</td>
	</tr>
	<tr>
		<td valign="top" rowspan="3">♦ <b>Cardiac</b></td>
	</tr>
	<tr>
		<td><?=$nomor++;?>. JVP</td>
		<td><?=$row_bf->cardiac_jvp;?> </td>
	</tr>
	<tr>
		<td><?=$nomor++;?>. Heart Sound</td>
		<td><?=$row_bf->cardiac_heartsound;?> </td>
	</tr>
	<tr>
		<td>&rArr; Comments</td>
		<td colspan="2">
		<?=$row_bf->cardiac_comment;?>
		</td>
	</tr>
	<tr>
		<td valign="top" rowspan="2">♦ <b>Breast </b></td>
	</tr>
	<tr>
		<td><?=$nomor++;?>. Breast Glands</td>
		<td><?=$row_bf->breast_glands;?> </td>
	</tr>
	<tr>
		<td>&rArr; Comments</td>
		<td colspan="2"><?=$row_bf->breast_glands_comment;?> </td>
	</tr>
	<tr>
		<td valign="top" rowspan="2">♦ <b>Respiratory system</b></td>
	</tr>
	<tr>
		<td><?=$nomor++;?>. Lung Sound</td>
		<td><?=$row_bf->respiratory;?> </td>
	</tr>
	<tr>
		<td>&rArr; Comments</td>
		<td colspan="2"><?=$row_bf->respiratory_comment;?> </td>
	</tr>
	<tr>
		<td valign="top">♦ <b>Abdomen general condition</b></td>
		<td colspan="2"><?=$row_bf->abdomen_general;?> </td>
	</tr>
	<tr>
		<td valign="top" rowspan="5">♦ <b>Abdomen</b></td>
	</tr>
	<tr>
		<td><?=$nomor++;?>. Liver</td>
		<td><?=$row_bf->abdomen_liver;?> </td>
	</tr>
	<tr>
		<td><?=$nomor++;?>. Spleen</td>
		<td><?=$row_bf->abdomen_spleen;?> </td>
	</tr>
	<tr>
		<td><?=$nomor++;?>. Kidney</td>
		<td><?=$row_bf->abdomen_kidney;?> </td>
	</tr>
	<tr>
		<td><?=$nomor++;?>. Rectal Screening</td>
		<td><?=$row_bf->abdomen_rectal;?> </td>
	</tr>
	<tr>
		<td>&rArr; Comments</td>
		<td colspan="2">
		<?=$row_bf->abdomen_comment;?>
		</td>
	</tr>
	<tr>
		<td valign="top">♦ <b>Spine</b></td>
		<td colspan="2"><?=$row_bf->spine;?> </td>
	</tr>
	<tr>
		<td valign="top">♦ <b>Skin</b></td>
		<td colspan="2"><?=$row_bf->skin;?> </td>
	</tr>	<tr>
		<td valign="top">♦ <b>Musculoskeletal disease</b></td>
		<td colspan="2"></td>
	</tr>
	<tr>
		<td valign="top" rowspan="4">♦ <b>Genitourinary</b></td>
	</tr>
	<tr>
		<td><?=$nomor++;?>. Hernia</td>
		<td><?=$row_bf->genitourinary_hernia;?> </td>
	</tr>
	<tr>
		<td><?=$nomor++;?>. Inguinal Nodes</td>
		<td><?=$row_bf->genitourinary_inguinal;?> </td>
	</tr>
	<tr>
		<td><?=$nomor++;?>. Hemorhoid</td>
		<td><?=$row_bf->genitourinary_hemorrhoid;?> </td>
	</tr>
	<tr>
		<td>&rArr; Comments</td>
		<td colspan="2"><?=$row_bf->genitourinary_comment;?></td>
	</tr>
	<tr>
		<td valign="top" rowspan="5">♦ <b>Neurologi</b></td>
	</tr>
	<tr>
		<td><?=$nomor++;?>. Motor system</td>
		<td><?=$row_bf->neurological_motor;?> </td>
	</tr>
	<tr>
		<td><?=$nomor++;?>. Sensory system</td>
		<td> <?=$row_bf->neurological_sensory;?></td>
	</tr>
	<tr>
		<td><?=$nomor++;?>. Reflexes</td>
		<td> <?=$row_bf->neurological_reflexes;?></td>
	</tr>
	<tr>
		<td><?=$nomor++;?>. Others</td>
		<td><?=$row_bf->neurological_other;?> </td>
	</tr>
	<tr>
		<td>&rArr; Comments</td>
		<td colspan="2">
		<?=$row_bf->vital_sign_bp;?> 
		</td>
	</tr>
	<tr>
		<td valign="top">♦ <b>Fungsi Luhur</b></td>
		<td colspan="2"><?=$row_bf->fungsi_luhur;?> </td>
	</tr>
	<tr>
		<td valign="top">♦ <b>Physician comments</b></td>
		<td colspan="2"><?=$row_bf->physician;?> </td>
	</tr>
</table>
</br>
</br>
<div class="page-break"></div>

				<table class="altrowstable3" id="alternatecolor3" width="100%">
					<tr>
						<td valign="top" width="180px">Name</td>
						<td valign="top" colspan="2"><b><?php echo $row->pat_name;?>, <?php echo $row->title_desc;?></b></td>
						<td valign="top" colspan="2"><?php echo $row->gender;?></td>
						<td valign="top" ><?=findage_detail($row->pat_dob);?></td>
					</tr>
				</table>
				<table class="altrowstable3" id="alternatecolor3" width="100%">
					<tr>
						<td valign="top" width="180px">Date of Birth</td>
						<td valign="top" colspan="2"><?php echo date("d-m-Y", strtotime($row->pat_dob));?></td>
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
						<td valign="top" align="center"><?php echo date("d-m-Y", strtotime($reg_date_now));?></td>
						<td valign="top" align="center"><?php echo $reg_date_previous;?></td>
						<td valign="top" align="center"><?php echo $reg_date_last;?></td>
						<td valign="top" align="center"><?php echo $jml_jack;?></td>						
					</tr>
					<tr>
						<td valign="top" width="180px">Type of Check up</td>
						<td valign="top" align="center">
						<?php 
							for($x = 0; $x < $arr_qout_name0; $x++) {
							    echo $qout_name0[$x];
							    echo "<br>";
							}
						?>
						</td>
						<td valign="top" align="center">
						<?php 
							for($x = 0; $x < $arr_qout_name1; $x++) {
							    echo $qout_name1[$x];
							    echo "<br>";
							}
						?>
						</td>
						<td valign="top" align="center">
						<?php 
							for($x = 0; $x < $arr_qout_name2; $x++) {
							    echo $qout_name2[$x];
							    echo "<br>";
							}
						?>
						</td>
						<td valign="top" align="center"></td>
					</tr>
					<tr>
						<td valign="top" width="180px">Job Position</td>
						<td valign="top" align="center"><?php if (isset($job[0])) { echo $job[0]; }  ?></td>
						<td valign="top" align="center"><?php if (isset($job[1])) { echo $job[1]; }  ?></td>
						<td valign="top" align="center"><?php if (isset($job[2])) { echo $job[2]; }  ?></td>
						<td valign="top" align="center"></td>
					</tr>
				</table>

</div>
	</td>
</tr>
</table>
<!-- <div class="page-break"></div> -->
<?php
if ($jml_fisik > 0) {
	# bagian fisik di bawah sini ... 
?>
<table border="0" align="center" width="750px">
<tr>
	<td>
<div style="width:700px; font-family: 'Times New Roman', Times, serif; font-size: 10px; padding-left:20px;">
<!-- </br> -->
		
				<table class="altrowstable3" id="alternatecolor3" width="100%">
					<thead>
					<tr>
						<th valign="center" align="middle" width="150px" rowspan="3"><?=$konten;?></th>
						<th valign="center" align="middle" width="100px" rowspan="3"><?=$std;?></th>
						<th valign="center" align="middle" colspan="3"><?=$dor;?></th>
						<th valign="center" align="middle" rowspan="3"><?=$u;?></th>
					</tr>
					<tr>
						<th valign="top" align="center"><?=$n;?></th>
						<th valign="top" align="center"><?=$p;?></th>
						<th valign="top" align="center"><?=$l;?></th>
					</tr>
					<tr>
						<th valign="top" align="center"><?php echo date("d-m-Y", strtotime($row->reg_date));?></th>
						<th valign="top" align="center"><?php echo $reg_date_previous; ?></th>
						<th valign="top" align="center"><?php echo $reg_date_last;?></th>
					</tr>
					</thead>
<?php
for($x = 0; $x < $arr_jml; $x++) {
	$bintang1 = "";
	$bintang2 = "";
	$bintang3 = "";
	if ($is_normal_fisik1[$x] == 1) {$bintang1 = '<font color="red">*</font>';}
	if ($is_normal_fisik2[$x] == 1) {$bintang2 = '<font color="red">*</font>';}
	if ($is_normal_fisik3[$x] == 1) {$bintang3 = '<font color="red">*</font>';}
	$z	= $x+1;
	if ($x == 0) {
		$y	= $x;
?>
					<tr>
						<td valign="top" colspan="6">&#9830; <b><?=$content_h[$x];?></b></td>
					</tr>
<?php
	}else{
		$y	= $x-1;
	}

	if ($z == $arr_jml) { $z = $x;}

	if ($content_h[$x] == $content_h[$y]) {
		# code...
	}else{
?>
					<tr>
						<td valign="top" colspan="6">&#9830; <b><?=$content_h[$x];?></b></td>
					</tr>
	<?php } ?>
					<tr>
						<td valign="top"><?=$content_d[$x];?></td>
						<td valign="top"><?=$stdvalue_fisik[$x];?></td>
						<td valign="top" align="middle"><?php echo $bintang1; echo $now[$x];?></td>
						<td valign="top" align="middle"><?php echo $bintang2; echo $previous[$x];?></td>
						<td valign="top" align="middle"><?php echo $bintang3; echo $last[$x];?></td>
						<td valign="top"><?=$unit[$x];?></td>
					</tr>
	<?php 
$komentarx = "";
$komentary = "";
if (array_key_exists($content_h[$x], $arr_gabunga_deh)) {	
	$jml_komentarx	= count($arr_gabunga_deh[$content_h[$x]]);
	if ($jml_komentarx > 1) {
		$komentarx 		= join(", ", $arr_gabunga_deh[$content_h[$x]]);
	}else{
		$komentarx 		= $arr_gabunga_deh[$content_h[$x]];
	}
}

if (array_key_exists($content_h[$y], $arr_gabunga_deh)) {	

	$jml_komentary	= count($arr_gabunga_deh[$content_h[$y]]);
	if ($jml_komentary > 1) {
		$komentary 		= join(", ", $arr_gabunga_deh[$content_h[$y]]);
	}else{
		$komentary 		= $arr_gabunga_deh[$content_h[$y]];
	}	

}

	if ($content_h[$x] != $content_h[$z]) {
	?>					
					<tr>
						<td valign="top" >&rArr; <?=$g_Comments;?></td>
						<td valign="top" colspan="5"><?=$komentarx;?></td>
					</tr>
<?php 
	}
}
?>					
					<tr>
						<td valign="top" >&rArr; <?=$g_Comments;?></td>
						<td valign="top" colspan="5"><?=$komentary;?></td>
						<!-- // <td valign="top" colspan="5"><?=join(", ", $arr_gabunga_deh[$content_h[$y]]);?></td> -->
					</tr>
					
				</table>
<!-- </br> -->
</div>
	</td>
</tr>
</table>
<!-- <div class="page-break"></div> -->
<?php
 }	# batas bagian fisik di bawah sini ...
if ($jml_lab > 0) {
	# bagian lab di bawah sini ... 
?>
<table border="0" align="center" width="750px">
<tr>
	<td>
<div style="width:700px; font-family: 'Times New Roman', Times, serif; font-size: 10px; padding-left:20px;">
<!-- </br> -->
		
				<table class="altrowstable3" id="alternatecolor3" width="100%">
					<thead>
					<tr>
						<th valign="center" align="middle" width="150px" rowspan="3"><?=$konten;?></th>
						<th valign="center" align="middle" width="100px" rowspan="3"><?=$std;?></th>
						<th valign="center" align="middle" colspan="3"><?=$dor;?></th>
						<th valign="center" align="middle" rowspan="3"><?=$u;?></th>
					</tr>
					<tr>
						<th valign="top" align="center"><?=$n;?></th>
						<th valign="top" align="center"><?=$p;?></th>
						<th valign="top" align="center"><?=$l;?></th>
					</tr>
					<tr>
						<th valign="top" align="center"><?php echo date("d-m-Y", strtotime($row->reg_date));?></th>
						<th valign="top" align="center"><?php echo $reg_date_previous; ?></th>
						<th valign="top" align="center"><?php echo $reg_date_last;?></th>
					</tr>
					</thead>
<?php
for($x = 0; $x < $arr_jml_lab; $x++) {
	$bintang_lab1 = "";
	$bintang_lab2 = "";
	$bintang_lab3 = "";
	if ($is_normal_lab1[$x] == 1) {$bintang_lab1 = '<font color="red">*</font>';}
	if ($is_normal_lab2[$x] == 1) {$bintang_lab2 = '<font color="red">*</font>';}
	if ($is_normal_lab3[$x] == 1) {$bintang_lab3 = '<font color="red">*</font>';}
	$z	= $x+1;
	$z	= $x+1;
	if ($x == 0) {
		$y	= $x;
?>
					<tr>
						<td valign="top" colspan="6">&#9830; <b><?=$content_h_lab[$x];?></b></td>
					</tr>
<?php
	}else{
		$y	= $x-1;
	}

	if ($z == $arr_jml_lab) { $z = $x;}

	if ($content_h_lab[$x] == $content_h_lab[$y]) {
		# code...
	}else{
?>
					<tr>
						<td valign="top" colspan="6">&#9830; <b><?=$content_h_lab[$x];?></b></td>
					</tr>
	<?php } ?>
					<tr>
						<td valign="top"><?=$content_d_lab[$x];?></td>
						<td valign="top"><?=$stdvalue_lab[$x];?></td>
						<td valign="top" align="middle"><?php echo $bintang_lab1; echo $now_lab[$x];?></td>
						<td valign="top" align="middle"><?php echo $bintang_lab2; echo $previous_lab[$x];?></td>
						<td valign="top" align="middle"><?php echo $bintang_lab3; echo $last_lab[$x];?></td>
						<td valign="top"><?=$unit_lab[$x];?></td>
					</tr>
	<?php 
$komentar_lab = "";
$komentar_lab2 = "";

if (array_key_exists($content_h_lab[$x], $arr_gabunga_deh)) {
	
	$jml_komentarx	= count($arr_gabunga_deh[$content_h_lab[$x]]);
	if ($jml_komentarx > 1) {
		$komentar_lab 		= join(", ", $arr_gabunga_deh[$content_h_lab[$x]]);
	}else{
		$komentar_lab 		= $arr_gabunga_deh[$content_h_lab[$x]];
	}
}

if (array_key_exists($content_h_lab[$y], $arr_gabunga_deh)) {
	$jml_komentary	= count($arr_gabunga_deh[$content_h_lab[$y]]);
	if ($jml_komentary > 1) {
		$komentar_lab2 		= join(", ", $arr_gabunga_deh[$content_h_lab[$y]]);
	}else{
		$komentar_lab2 		= $arr_gabunga_deh[$content_h_lab[$y]];
	}	
}
	if ($content_h_lab[$x] != $content_h_lab[$z]) {

	?>					
					<tr>
						<td valign="top" >&rArr; <?=$g_Comments;?></td>
						<td valign="top" colspan="5"><?=$komentar_lab;?></td>
					</tr>
<?php 
	}
}
?>					
					<tr>
						<td valign="top" >&rArr; <?=$g_Comments;?></td>
						<td valign="top" colspan="5"><?=$komentar_lab2;?></td>
					</tr>
					
				</table>
<!-- </br> -->
</div>
	</td>
</tr>
</table>
<!-- <div class="page-break"></div> -->
<?php }	# batas bagian lab di bawah sini ... ?>

<table border="0" align="center" width="750px">
<tr>
	<td>
<div style="width:700px; font-family: 'Times New Roman', Times, serif; font-size: 10px; padding-left:20px;">
<?php
for($x = 0; $x < $jml_rad; $x++) {

$komentar_rad = "";

if (array_key_exists($content_h_rad[$x], $arr_gabunga_deh)) {
	
	$jml_komentarx	= count($arr_gabunga_deh[$content_h_rad[$x]]);
	if ($jml_komentarx > 1) {
		$komentar_rad 		= join(", ", $arr_gabunga_deh[$content_h_rad[$x]]);
	}else{
		$komentar_rad 		= $arr_gabunga_deh[$content_h_rad[$x]];
	}
}

if (isset($content_d_rad[$x])) {
	$radiology_nama = $content_d_rad[$x];
}else{
	$radiology_nama = $content_h_rad[$x];
}

?>
				<table class="altrowstable3" id="alternatecolor3" width="100%">
					<thead>
					<tr>
						<th valign="top" colspan="6">&#9830; <b><?=$radiology_nama;?></b></th>
					</tr>
					</thead>
					<tr>
						<td valign="top" width="140px"><?=$n;?></td>						
						<td valign="top">
						<?=$now_rad[$x];?>
						</td>
					</tr>
					<tr>
						<td valign="top" width="140px"><?=$p;?></td>
						<td valign="top">
						<?=$previous_rad[$x];?>				
						</td>
					</tr>
					<tr>
						<td valign="top" width="140px"><?=$l;?></td>
						<td valign="top">
						<?=$last_rad[$x];?>
						</td>
					</tr>
					<tr>
						<td valign="top" width="140px">&rArr; <?=$g_Comments;?></td>
						<td valign="top"><?=$komentar_rad;?></td>
					</tr>
				</table>

			</br>
<?php } 
// echo "<pre>";print_r($arr_now_dental);echo "</pre>";
?>			
</table>
			<!-- </br> -->
		

<?php
if ($jml_usg > 0) {
?>
<table border="0" align="center" width="750px">
<tr>
	<td>
<div style="width:700px; font-family: 'Times New Roman', Times, serif; font-size: 10px; padding-left:20px;">
<!-- </br> -->
		
				<table class="altrowstable3" id="alternatecolor3" width="100%">
					<thead>
					<tr>
						<th valign="center" align="middle" width="150px" rowspan="3"><?=$konten;?></th>
						<th valign="center" align="middle" width="100px" rowspan="3"><?=$std;?></th>
						<th valign="center" align="middle" colspan="3"><?=$dor;?></th>
						<th valign="center" align="middle" rowspan="3"><?=$u;?></th>
					</tr>
					<tr>
						<th valign="top" align="center"><?=$n;?></th>
						<th valign="top" align="center"><?=$p;?></th>
						<th valign="top" align="center"><?=$l;?></th>
					</tr>
					<tr>
						<th valign="top" align="center"><?php echo date("d-m-Y", strtotime($row->reg_date));?></th>
						<th valign="top" align="center"><?php echo $reg_date_previous; ?></th>
						<th valign="top" align="center"><?php echo $reg_date_last;?></th>
					</tr>
					</thead>
<?php
for($x = 0; $x < $arr_jml_usg; $x++) {
	$z	= $x+1;
	if ($x == 0) {
		$y	= $x;
?>
					<tr>
						<td valign="top" colspan="6">&#9830; <b><?=$content_h_usg[$x];?></b></td>
					</tr>
<?php
	}else{
		$y	= $x-1;
	}

	if ($z == $arr_jml) { $z = $x;}

	if ($content_h_usg[$x] == $content_h_usg[$y]) {
		# code...
	}else{
?>
					<tr>
						<td valign="top" colspan="6">&#9830; <b><?=$content_h_usg[$x];?></b></td>
					</tr>
	<?php } ?>
					<tr>
						<td valign="top"><?=$content_d_usg[$x];?></td>
						<td valign="top"><?=$stdvalue_fisik_usg[$x];?></td>
						<td valign="top" align="middle"><?=$now_usg[$x];?></td>
						<td valign="top" align="middle"><?=$previous_usg[$x];?></td>
						<td valign="top" align="middle"><?=$last_usg[$x];?></td>
						<td valign="top"><?=$unit_usg[$x];?></td>
					</tr>
	<?php 
$komentarx = "";
$komentary = "";
if (array_key_exists($content_h[$x], $arr_gabunga_deh)) {	
	$jml_komentarx	= count($arr_gabunga_deh[$content_h[$x]]);
	if ($jml_komentarx > 1) {
		$komentarx 		= join(", ", $arr_gabunga_deh[$content_h[$x]]);
	}else{
		$komentarx 		= $arr_gabunga_deh[$content_h[$x]];
	}
}

if (array_key_exists($content_h[$y], $arr_gabunga_deh)) {	

	$jml_komentary	= count($arr_gabunga_deh[$content_h[$y]]);
	if ($jml_komentary > 1) {
		$komentary 		= join(", ", $arr_gabunga_deh[$content_h[$y]]);
	}else{
		$komentary 		= $arr_gabunga_deh[$content_h[$y]];
	}	

}

	if ($content_h[$x] != $content_h[$z]) {
	?>					
					<tr>
						<td valign="top" >&rArr; <?=$g_Comments;?></td>
						<td valign="top" colspan="5"><?=$komentarx;?></td>
					</tr>
<?php 
	}
}
?>					
					<tr>
						<td valign="top" >&rArr; <?=$g_Comments;?></td>
						<td valign="top" colspan="5"><?=$komentary;?></td>
						<!-- // <td valign="top" colspan="5"><?=join(", ", $arr_gabunga_deh[$content_h[$y]]);?></td> -->
					</tr>
					
				</table>
<!-- </br> -->
</div>
	</td>
</tr>
</table>
<?php 
	}
?>


<table border="0" align="center" width="750px">
<tr>
	<td>
<div style="width:700px; font-family: 'Times New Roman', Times, serif; font-size: 10px; padding-left:20px;">
<!-- </br> -->
<?php 
if ($jml_dental > 0) {
	// echo "<pre>";print_r($arr_now_dental);echo "</pre>";exit();
?>

				<table class="altrowstable3" id="alternatecolor3" width="100%">
					<thead>
					<tr>
						<th valign="top" colspan="6">&#9830; <b><?php echo $h_dental;?></b></th>
					</tr>
					</thead>
					<tr>
						<th valign="top" width="140px"></th>
						<th valign="top" width="140px"><?php echo $h_now;?></th>
						<th valign="top" width="140px"><?php echo $h_Previous;?></th>
						<th valign="top" width="140px"><?php echo $h_Last;?></th>
					</tr>
					<tr>
						<td valign="top"><?php echo $h_dental;?></td>
						<td valign="top"><?php if ($jml_dental == 0) {echo " - ";}else{echo $arr_now_dental[$h_dental];} ?></td>
						<td valign="top"><?php if ($jml_dental == 0) {echo " - ";}else{echo $arr_previous_dental[$h_dental];} ?></td>
						<td valign="top"><?php if ($jml_dental == 0) {echo " - ";}else{echo $arr_last_dental[$h_dental];} ?></td>
					</tr>
					<tr>
						<td valign="top"><?php echo $h_Extra_Oral;?></td>
						<td valign="top"><?php if ($jml_dental == 0) {echo " - ";}else{echo $arr_now_dental[$h_Extra_Oral];} ?></td>
						<td valign="top"><?php if ($jml_dental == 0) {echo " - ";}else{echo $arr_previous_dental[$h_Extra_Oral];} ?></td>
						<td valign="top"><?php if ($jml_dental == 0) {echo " - ";}else{echo $arr_last_dental[$h_Extra_Oral];} ?></td>
					</tr>
					<tr>
						<td valign="top" colspan="4"><?php echo $h_panoramic;?></td>
					</tr>
					<tr>
						<td valign="top" align="center" colspan="4"><img src='<?php echo base_url();?>design/images/fotogigi.png' style="width: 600px;"></td>
					</tr>
					<tr>
						<td valign="top"><?php echo $h_intra;?></td>
						<td valign="top"><?php if ($jml_dental == 0) {echo " - ";}else{echo $arr_now_dental[$h_intra];} ?></td>
						<td valign="top"><?php if ($jml_dental == 0) {echo " - ";}else{echo $arr_previous_dental[$h_intra];} ?></td>
						<td valign="top"><?php if ($jml_dental == 0) {echo " - ";}else{echo $arr_last_dental[$h_intra];} ?></td>
					</tr>
					<tr>
						<td valign="top"><?php echo $h_Impaction;?></td>
						<td valign="top"><?php if ($jml_dental == 0) {echo " - ";}else{echo $arr_now_dental[$h_Impaction];} ?></td>
						<td valign="top"><?php if ($jml_dental == 0) {echo " - ";}else{echo $arr_previous_dental[$h_Impaction];} ?></td>
						<td valign="top"><?php if ($jml_dental == 0) {echo " - ";}else{echo $arr_last_dental[$h_Impaction];} ?></td>
					</tr>
					<tr>
						<td valign="top"><?php echo $h_Broken;?></td>
						<td valign="top"><?php if ($jml_dental == 0) {echo " - ";}else{echo $arr_now_dental[$h_Broken];} ?></td>
						<td valign="top"><?php if ($jml_dental == 0) {echo " - ";}else{echo $arr_previous_dental[$h_Broken];} ?></td>
						<td valign="top"><?php if ($jml_dental == 0) {echo " - ";}else{echo $arr_last_dental[$h_Broken];} ?></td>
					</tr>
					<tr>
						<td valign="top"><?php echo $h_Cyst;?></td>
						<td valign="top"><?php if ($jml_dental == 0) {echo " - ";}else{echo $arr_now_dental[$h_Cyst];} ?></td>
						<td valign="top"><?php if ($jml_dental == 0) {echo " - ";}else{echo $arr_previous_dental[$h_Cyst];} ?></td>
						<td valign="top"><?php if ($jml_dental == 0) {echo " - ";}else{echo $arr_last_dental[$h_Cyst];} ?></td>
					</tr>
					<tr>
						<td valign="top"><?php echo $h_Mobilization;?></td>
						<td valign="top"><?php if ($jml_dental == 0) {echo " - ";}else{echo $arr_now_dental[$h_Mobilization];} ?></td>
						<td valign="top"><?php if ($jml_dental == 0) {echo " - ";}else{echo $arr_previous_dental[$h_Mobilization];} ?></td>
						<td valign="top"><?php if ($jml_dental == 0) {echo " - ";}else{echo $arr_last_dental[$h_Mobilization];} ?></td>
					</tr>
					<tr>
						<td valign="top"><?php echo $h_Calculus;?></td>
						<td valign="top"><?php if ($jml_dental == 0) {echo " - ";}else{echo $arr_now_dental[$h_Calculus];} ?></td>
						<td valign="top"><?php if ($jml_dental == 0) {echo " - ";}else{echo $arr_previous_dental[$h_Calculus];} ?></td>
						<td valign="top"><?php if ($jml_dental == 0) {echo " - ";}else{echo $arr_last_dental[$h_Calculus];} ?></td>
					</tr>
					<tr>
						<td valign="top"><?php echo $h_Caries;?></td>
						<td valign="top"><?php if ($jml_dental == 0) {echo " - ";}else{echo $arr_now_dental[$h_Caries];} ?></td>
						<td valign="top"><?php if ($jml_dental == 0) {echo " - ";}else{echo $arr_previous_dental[$h_Caries];} ?></td>
						<td valign="top"><?php if ($jml_dental == 0) {echo " - ";}else{echo $arr_last_dental[$h_Caries];} ?></td>
					</tr>
					<tr>
						<td valign="top"><?php echo $h_Filling;?></td>
						<td valign="top"><?php if ($jml_dental == 0) {echo " - ";}else{echo $arr_now_dental[$h_Filling];} ?></td>
						<td valign="top"><?php if ($jml_dental == 0) {echo " - ";}else{echo $arr_previous_dental[$h_Filling];} ?></td>
						<td valign="top"><?php if ($jml_dental == 0) {echo " - ";}else{echo $arr_last_dental[$h_Filling];} ?></td>
					</tr>
					<tr>
						<td valign="top"><?php echo $h_Missing;?></td>
						<td valign="top"><?php if ($jml_dental == 0) {echo " - ";}else{echo $arr_now_dental[$h_Missing];} ?></td>
						<td valign="top"><?php if ($jml_dental == 0) {echo " - ";}else{echo $arr_previous_dental[$h_Missing];} ?></td>
						<td valign="top"><?php if ($jml_dental == 0) {echo " - ";}else{echo $arr_last_dental[$h_Missing];} ?></td>
					</tr>
					<tr>
						<td valign="top" width="140px">&rArr; <?=$g_Comments;?></td>
						<td valign="top" colspan="3" > 

							<?php
							// $jmlc_dental = count($arr_gabunga_deh["Dental Exam."]);
							if (!isset($arr_gabunga_deh["Dental Exam."])) {
								echo "-";
							}else{
								$arr_gabunga_deh["Dental Exam."];
							}
							

							?> 

						</td>
					</tr>
				</table>
<?php } ?>				
<!-- </br> -->
</div>
	</td>
</tr>
</table>
<!-- <div class="page-break"></div> -->
<table border="0" align="center" width="750px">
<tr>
	<td>
<div style="width:700px; font-family: 'helvetica', helvetica, serif; font-size: 10px; padding-left:20px;">
<!-- </br> -->
				<table class="altrowstable3" id="alternatecolor3" width="100%">
					<thead>
					<tr>
						<th valign="center" align="middle" rowspan="3"><b><?=$konten;?></b></th>
						<th valign="center" align="middle" colspan="3"><b><?=$h_grade;?></b></th>
						<th valign="center" align="middle" rowspan="3"><b><?=$konten;?></b></th>
						<th valign="center" align="middle" colspan="3"><b><?=$h_grade;?></b></th>
					</tr>
					<tr>
						<th align="middle" rowspan="2"><?=$n;?></th>
						<th align="middle" rowspan="2"><?=$p;?></th>
						<th align="middle" rowspan="2"><?=$l;?></th>
					</tr>
					<tr>
						<th align="middle" rowspan="2"><?=$n;?></th>
						<th align="middle" rowspan="2"><?=$p;?></th>
						<th align="middle" rowspan="2"><?=$l;?></th>
					</tr>
					</thead>
					<tr>
						<td valign="top"><?=$g_Obesities;?></td>
						<td valign="top">
						<?php
						if ($jml_grade0 > 0){
							echo $row_grade0->Obesitas;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade1 > 0){
							echo $row_grade1->Obesitas;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade2 > 0){
							echo $row_grade2->Obesitas;
						}
						?>
						</td>
						<td valign="top"><?=$g_Immunology_test;?></td>
						<td valign="top">
						<?php
						if ($jml_grade0 > 0){
							echo $row_grade0->Immunology_Test;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade1 > 0){
							echo $row_grade1->Immunology_Test;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade2 > 0){
							echo $row_grade2->Immunology_Test;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top"><?=$g_Eyes_Sight;?></td>
						<td valign="top">
						<?php
						if ($jml_grade0 > 0){
							echo $row_grade0->Eyes_Sight;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade1 > 0){
							echo $row_grade1->Eyes_Sight;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade2 > 0){
							echo $row_grade2->Eyes_Sight;
						}
						?>
						</td>
						<td valign="top"><?=$g_dmh;?></td>
						<td valign="top">
						<?php
						if ($jml_grade0 > 0){
							echo $row_grade0->Diabetes_Mellitus;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade1 > 0){
							echo $row_grade1->Diabetes_Mellitus;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade2 > 0){
							echo $row_grade2->Diabetes_Mellitus;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top"><?=$g_Ocular;?></td>
						<td valign="top">
						<?php
						if ($jml_grade0 > 0){
							echo $row_grade0->Ocular_Tension;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade1 > 0){
							echo $row_grade1->Ocular_Tension;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade2 > 0){
							echo $row_grade2->Ocular_Tension;
						}
						?>
						</td>
						<td valign="top"><?=$g_Bloodg;?></td>
						<td valign="top">
						<?php
						if ($jml_grade0 > 0){
							// echo $row_grade0->Blood_Glucose;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade1 > 0){
							// echo $row_grade1->Blood_Glucose;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade2 > 0){
							// echo $row_grade2->Blood_Glucose;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top"><?=$g_Colorb;?></td>
						<td valign="top">
						<?php
						if ($jml_grade0 > 0){
							echo $row_grade0->Color_Blindness;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade1 > 0){
							echo $row_grade1->Color_Blindness;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade2 > 0){
							echo $row_grade2->Color_Blindness;
						}
						?>
						</td>
						<td valign="top"><?=$g_Urineg;?></td>
						<td valign="top">
						<?php
						if ($jml_grade0 > 0){
							echo $row_grade0->Urine_Glucose;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade1 > 0){
							echo $row_grade1->Urine_Glucose;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade2 > 0){
							echo $row_grade2->Urine_Glucose;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top"><?=$g_Fundus;?></td>
						<td valign="top">
						<?php
						if ($jml_grade0 > 0){
							echo $row_grade0->Fundus;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade1 > 0){
							echo $row_grade1->Fundus;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade2 > 0){
							echo $row_grade2->Fundus;
						}
						?>
						</td>
						<td valign="top"><?=$g_Fructosamine;?></td>
						<td valign="top">
						<?php
						if ($jml_grade0 > 0){
							// echo $row_grade0->Fructosamine;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade1 > 0){
							// echo $row_grade1->Fructosamine;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade2 > 0){
							// echo $row_grade2->Fructosamine;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top"><?=$g_Hearing;?></td>
						<td valign="top">
						<?php
						if ($jml_grade0 > 0){
							echo $row_grade0->Hearing;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade1 > 0){
							echo $row_grade1->Hearing;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade2 > 0){
							echo $row_grade2->Hearing;
						}
						?>
						</td>
						<td valign="top"><?=$g_Tumorm;?></td>
						<td valign="top">
						<?php
						if ($jml_grade0 > 0){
							echo $row_grade0->Tumor_Marker;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade1 > 0){
							echo $row_grade1->Tumor_Marker;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade2 > 0){
							echo $row_grade2->Tumor_Marker;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top"><?=$g_Bloodp;?></td>
						<td valign="top">
						<?php
						if ($jml_grade0 > 0){
							echo $row_grade0->Blood_Pressure;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade1 > 0){
							echo $row_grade1->Blood_Pressure;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade2 > 0){
							echo $row_grade2->Blood_Pressure;
						}
						?>
						</td>
						<td valign="top"><?=$g_Chestx;?></td>
						<td valign="top">
						<?php
						if ($jml_grade0 > 0){
							echo $row_grade0->Chest_Xray;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade1 > 0){
							echo $row_grade1->Chest_Xray;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade2 > 0){
							echo $row_grade2->Chest_Xray;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top"><?=$g_LungF;?></td>
						<td valign="top">
						<?php
						if ($jml_grade0 > 0){
							echo $row_grade0->Lung_Function;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade1 > 0){
							echo $row_grade1->Lung_Function;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade2 > 0){
							echo $row_grade2->Lung_Function;
						}
						?>
						</td>
						<td valign="top"><?=$g_XShadow;?></td>
						<td valign="top">
						<?php
						if ($jml_grade0 > 0){
							echo $row_grade0->Xray_Shadow;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade1 > 0){
							echo $row_grade1->Xray_Shadow;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade2 > 0){
							echo $row_grade2->Xray_Shadow;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top"><?=$g_UrineA;?></td>
						<td valign="top">
						<?php
						if ($jml_grade0 > 0){
							echo $row_grade0->Urine_Analysis;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade1 > 0){
							echo $row_grade1->Urine_Analysis;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade2 > 0){
							echo $row_grade2->Urine_Analysis;
						}
						?>
						</td>
						<td valign="top"><?=$g_Sputum;?></td>
						<td valign="top">
						<?php
						if ($jml_grade0 > 0){
							echo $row_grade0->Sputum;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade1 > 0){
							echo $row_grade1->Sputum;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade2 > 0){
							echo $row_grade2->Sputum;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top"><?=$g_UrineS;?></td>
						<td valign="top">
						<?php
						if ($jml_grade0 > 0){
							echo $row_grade0->Urine_Sediment;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade1 > 0){
							echo $row_grade1->Urine_Sediment;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade2 > 0){
							echo $row_grade2->Urine_Sediment;
						}
						?>
						</td>
						<td valign="top"><?=$g_ECG;?></td>
						<td valign="top">
						<?php
						if ($jml_grade0 > 0){
							echo $row_grade0->ECG;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade1 > 0){
							echo $row_grade1->ECG;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade2 > 0){
							echo $row_grade2->ECG;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top"><?=$g_OB;?></td>
						<td valign="top">
						<?php
						if ($jml_grade0 > 0){
							echo $row_grade0->OB;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade1 > 0){
							echo $row_grade1->OB;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade2 > 0){
							echo $row_grade2->OB;
						}
						?>
						</td>
						<td valign="top"><?=$g_Treadmill;?></td>
						<td valign="top">
						<?php
						if ($jml_grade0 > 0){
							echo $row_grade0->Treadmill;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade1 > 0){
							echo $row_grade1->Treadmill;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade2 > 0){
							echo $row_grade2->Treadmill;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top"><?=$g_Liverf;?></td>
						<td valign="top">
						<?php
						if ($jml_grade0 > 0){
							echo $row_grade0->Liver_Function;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade1 > 0){
							echo $row_grade1->Liver_Function;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade2 > 0){
							echo $row_grade2->Liver_Function;
						}
						?>
						</td>
						<td valign="top"><?=$g_Echocardiographi;?></td>
						<td valign="top">
						<?php
						if ($jml_grade0 > 0){
							echo $row_grade0->Echocardiographi;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade1 > 0){
							echo $row_grade1->Echocardiographi;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade2 > 0){
							echo $row_grade2->Echocardiographi;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top"><?=$g_Renal;?></td>
						<td valign="top">
						<?php
						if ($jml_grade0 > 0){
							echo $row_grade0->Renal;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade1 > 0){
							echo $row_grade1->Renal;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade2 > 0){
							echo $row_grade2->Renal;
						}
						?>
						</td>
						<td valign="top"><?=$g_USG;?></td>
						<td valign="top">
						<?php
						if ($jml_grade0 > 0){
							echo $row_grade0->USG;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade1 > 0){
							echo $row_grade1->USG;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade2 > 0){
							echo $row_grade2->USG;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top"><?=$g_Pancreas;?></td>
						<td valign="top">
						<?php
						if ($jml_grade0 > 0){
							echo $row_grade0->Pancreas;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade1 > 0){
							echo $row_grade1->Pancreas;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade2 > 0){
							echo $row_grade2->Pancreas;
						}
						?>
						</td>
						<td valign="top"><?=$g_USGP;?></td>
						<td valign="top">
						<?php
						if ($jml_grade0 > 0){
							echo $row_grade0->USG_Prostate;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade1 > 0){
							echo $row_grade1->USG_Prostate;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade2 > 0){
							echo $row_grade2->USG_Prostate;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top"><?=$g_Urica;?></td>
						<td valign="top">
						<?php
						if ($jml_grade0 > 0){
							echo $row_grade0->Uric_Acid;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade1 > 0){
							echo $row_grade1->Uric_Acid;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade2 > 0){
							echo $row_grade2->Uric_Acid;
						}
						?>
						</td>
						<td valign="top"><?=$g_USGU;?></td>
						<td valign="top">
						<?php
						if ($jml_grade0 > 0){
							echo $row_grade0->USG_Uterus;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade1 > 0){
							echo $row_grade1->USG_Uterus;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade2 > 0){
							echo $row_grade2->USG_Uterus;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top"><?=$g_Lipid;?></td>
						<td valign="top">
						<?php
						if ($jml_grade0 > 0){
							echo $row_grade0->Lipid;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade1 > 0){
							echo $row_grade1->Lipid;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade2 > 0){
							echo $row_grade2->Lipid;
						}
						?>
						</td>
						<td valign="top"><?=$g_USGM;?></td>
						<td valign="top">
						<?php
						if ($jml_grade0 > 0){
							echo $row_grade0->USG_Mammae;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade1 > 0){
							echo $row_grade1->USG_Mammae;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade2 > 0){
							echo $row_grade2->USG_Mammae;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top"><?=$g_Electrolyte;?></td>
						<td valign="top">
						<?php
						if ($jml_grade0 > 0){
							echo $row_grade0->Electrolyte;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade1 > 0){
							echo $row_grade1->Electrolyte;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade2 > 0){
							echo $row_grade2->Electrolyte;
						}
						?>
						</td>
						<td valign="top"><?=$g_StomachX;?></td>
						<td valign="top">
						<?php
						if ($jml_grade0 > 0){
							echo $row_grade0->Stomach_Xray;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade1 > 0){
							echo $row_grade1->Stomach_Xray;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade2 > 0){
							echo $row_grade2->Stomach_Xray;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top"><?=$g_AnemiaTest;?></td>
						<td valign="top">
						<?php
						if ($jml_grade0 > 0){
							// echo $row_grade0->Anemia_Test;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade1 > 0){
							// echo $row_grade1->Anemia_Test;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade2 > 0){
							// echo $row_grade2->Anemia_Test;
						}
						?>
						</td>
						<td valign="top"><?=$g_PapSmear;?></td>
						<td valign="top">
						<?php
						if ($jml_grade0 > 0){
							echo $row_grade0->Pap_Smear;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade1 > 0){
							echo $row_grade1->Pap_Smear;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade2 > 0){
							echo $row_grade2->Pap_Smear;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top"><?=$g_Hematology;?></td>
						<td valign="top">
						<?php
						if ($jml_grade0 > 0){
							echo $row_grade0->Hematology;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade1 > 0){
							echo $row_grade1->Hematology;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade2 > 0){
							echo $row_grade2->Hematology;
						}
						?>
						</td>
						<td valign="top"><?=$g_BreastE;?></td>
						<td valign="top">
						<?php
						if ($jml_grade0 > 0){
							echo $row_grade0->Breast_Examination;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade1 > 0){
							echo $row_grade1->Breast_Examination;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade2 > 0){
							echo $row_grade2->Breast_Examination;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top"><?=$g_WBC;?></td>
						<td valign="top">
						<?php
						if ($jml_grade0 > 0){
							echo $row_grade0->WBC_Classification;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade1 > 0){
							echo $row_grade1->WBC_Classification;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade2 > 0){
							echo $row_grade2->WBC_Classification;
						}
						?>
						</td>
						<td valign="top"><?=$g_ExtraOral;?></td>
						<td valign="top">
						<?php
						if ($jml_grade0 > 0){
							echo $row_grade0->Extra_Oral;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade1 > 0){
							echo $row_grade1->Extra_Oral;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade2 > 0){
							echo $row_grade2->Extra_Oral;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top"><?=$g_Inflammation;?></td>
						<td valign="top">
						<?php
						if ($jml_grade0 > 0){
							echo $row_grade0->Inflammation;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade1 > 0){
							echo $row_grade1->Inflammation;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade2 > 0){
							echo $row_grade2->Inflammation;
						}
						?>
						</td>
						<td valign="top"><?=$g_PanoramicX;?></td>
						<td valign="top">
						<?php
						if ($jml_grade0 > 0){
							echo $row_grade0->Panoramic_Xray;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade1 > 0){
							echo $row_grade1->Panoramic_Xray;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade2 > 0){
							echo $row_grade2->Panoramic_Xray;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top"><?=$g_Syphilis;?></td>
						<td valign="top">
						<?php
						if ($jml_grade0 > 0){
							echo $row_grade0->Syphilis;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade1 > 0){
							echo $row_grade1->Syphilis;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade2 > 0){
							echo $row_grade2->Syphilis;
						}
						?>
						</td>
						<td valign="top"><?=$g_Intraoral;?></td>
						<td valign="top">
						<?php
						if ($jml_grade0 > 0){
							echo $row_grade0->Intra_Oral;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade1 > 0){
							echo $row_grade1->Intra_Oral;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade2 > 0){
							echo $row_grade2->Intra_Oral;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top"><?=$g_SerologyH;?></td>
						<td valign="top">
						<?php
						if ($jml_grade0 > 0){
							echo $row_grade0->Serology_Hepatitis;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade1 > 0){
							echo $row_grade1->Serology_Hepatitis;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade2 > 0){
							echo $row_grade2->Serology_Hepatitis;
						}
						?>
						</td>
						<td valign="top"><?=$g_DentalHygiene;?></td>
						<td valign="top">
						<?php
						if ($jml_grade0 > 0){
							echo $row_grade0->Dental_Hygine;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade1 > 0){
							echo $row_grade1->Dental_Hygine;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade2 > 0){
							echo $row_grade2->Dental_Hygine;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top"><?=$g_Others;?></td>
						<td valign="top">
						<?php
						if ($jml_grade0 > 0){
							echo $row_grade0->Others;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade1 > 0){
							echo $row_grade1->Others;
						}
						?>
						</td>
						<td valign="top">
						<?php
						if ($jml_grade2 > 0){
							echo $row_grade2->Others;
						}
						?>
						</td>
						<td valign="top"></td>
						<td valign="top"></td>
						<td valign="top"></td>
						<td valign="top"></td>
					</tr>
				</table>
</div>
	</td>
</tr>
</table>

<!-- <div class="page-break"></div> -->
<table border="0" align="center" width="750px">
<tr>
	<td>
<div style="width:700px; font-family: 'helvetica', helvetica, serif; font-size: 14px; padding-left:20px;">
<b><?=$g_GradeofResult;?></b></br>
A. &emsp; <?=$g_NoProblem;?></br>
B. &emsp; <?=$g_gorb;?></br>
BF.&emsp;<?=$g_gorbf;?></br>
C. &emsp;  <?=$g_gorc;?></br>
D. &emsp; <?=$g_gord;?></br>
E. &emsp; <?=$g_gore;?></br>
N. &emsp; <?=$g_gorn;?></br>
</br>
<?php
if($all_data_grade0->num_rows() > 0){
$cars = array("$row_grade0->Obesitas", 
			"$row_grade0->Eyes_Sight", 
			"$row_grade0->Ocular_Tension", 
			"$row_grade0->Color_Blindness", 
			"$row_grade0->Fundus", 
			"$row_grade0->Hearing", 
			"$row_grade0->Blood_Pressure", 
			"$row_grade0->Lung_Function", 
			"$row_grade0->Urine_Analysis", 
			"$row_grade0->Urine_Sediment", 
			"$row_grade0->OB", 
			"$row_grade0->Liver_Function", 
			"$row_grade0->Renal", 
			"$row_grade0->Pancreas", 
			"$row_grade0->Uric_Acid", 
			"$row_grade0->Lipid", 
			"$row_grade0->Electrolyte", 
			// "$row_grade0->Anemia_Test", 
			"$row_grade0->Hematology", 
			"$row_grade0->WBC_Classification", 
			"$row_grade0->Inflammation", 
			"$row_grade0->Syphilis", 
			"$row_grade0->Immunology_Test", 
			"$row_grade0->Others", 
			"$row_grade0->Immunology_Test", 
			"$row_grade0->Diabetes_Mellitus", 
			// "$row_grade0->Blood_Glucose", 
			"$row_grade0->Urine_Glucose", 
			// "$row_grade0->Fructosamine", 
			"$row_grade0->Tumor_Marker", 
			"$row_grade0->Chest_Xray", 
			"$row_grade0->Xray_Shadow", 
			"$row_grade0->ECG", 
			"$row_grade0->Treadmill", 
			"$row_grade0->Echocardiographi", 
			"$row_grade0->USG", 
			"$row_grade0->USG_Prostate", 
			"$row_grade0->USG_Uterus", 
			"$row_grade0->USG_Mammae", 
			"$row_grade0->Stomach_Xray", 
			"$row_grade0->Pap_Smear", 
			"$row_grade0->Panoramic_Xray", 
			"$row_grade0->Intra_Oral", 
			"$row_grade0->Dental_Hygine", 
			"$row_grade0->Breast_Examination", 
			"$row_grade0->Extra_Oral"
			);
rsort($cars);
?>
<div class="page-break"></div>
<b>Grade : <?php  echo $cars[0]; ?></b></br>
<?php } ?>
</br>
<?=$g_Comments;?></br></br>
						<?php
						// if ($get_data_lock->num_rows() > 0){
						// 	echo str_replace(",",", </br>", $row_lock->fitness_comment);
						// }

						$jumlahkoment = $get_data_lock->num_rows();
						if ($jumlahkoment > 0) {
						$pecah = explode("|",$row_lock->fitness_comment);
						$jumlah = count($pecah);
						// echo $row_lock->fitness_comment." 	";

							$nomor = 1;
							for ($i=0; $i < $jumlah ; $i++) { 
								echo $nomor++.". ";
								echo $pecah[$i].", </br>";
							}
						}


						?>
</div>
	</td>
</tr>
</table>
