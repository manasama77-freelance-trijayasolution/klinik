<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Report Registration.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<h1 align="center">Report Registration</h1>
<?php echo date('Y-m-d H:i:s'); ?>

<table border='1' width="70%">
<tr>
	<th>No.</th>
	<th>ID Registration</th>
	<th>Patient Name</th>
	<th>Date Registration</th>
	<th>Company Name</th>
	<th>Type</th>
</tr>
<?php
$i=1;
foreach($data->result() as $row){
?>
	<tr class="odd gradeX">
		<td><?php echo $i++;?></td>
		<td><?php echo $row->id_reg;?></td>
		<td><?php echo $row->pat_name;?> </td>
		<td><?php echo $row->reg_date;?></td>
		<td><?php echo $row->client_name;?></td>
		<td><?php 
			if($row->id_service==0){
				echo "MCU";
			}else{
				echo "Outpatient";
			}
			?>
		</td>
	</tr>
<?php
}
?>
</table>


