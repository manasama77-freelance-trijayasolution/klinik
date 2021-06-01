<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Data Patient.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<h1 align="center">Data Patient</h1>
<?php echo date('Y-m-d H:i:s'); ?>

<table border='1' width="70%">
<tr>
	<th>No</th>
	<th nowrap>Patient ID - MRN</th>
	<th nowrap>Name</th>
	<th>Date of Birth</th>
	<th>Company Name</th>
</tr>
<?php
$i=1;
foreach($find->result() as $row){
?>
	<tr class="odd gradeX">
		<td><?=$i++;?></td>	
		<td><?php echo $row->pat_MRN;?> | <?php echo $row->id_history;?></td>
		<td><?php echo $row->pat_name;?>, <?php echo $row->title_desc;?></td>
		<td><?=$row->pat_dob;?></td>
		<td><?php echo $row->client_name;?></td>
	</tr>
<?php
}
?>
</table>


