<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=ReportFO.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<h1 align="center">Report FO</h1>
<?php echo date('Y-m-d H:i:s'); ?>

<table border='1' width="70%">
<tr>
	<td>No.</td>
	<td>ID Registration</td>
	<td>Patient Name</td>
	<td>Date Registration</td>
	<td>Company Name</td>
	<td>Type</td>
	<td>User</td>
	<td>Create Date</td>
</tr>
<?php
$i=1;
foreach($trx_registration->result() as $row){
?>
	<tr class="odd gradeX">
		<td><?php echo $i++;?></td>
		<td><?php echo $row->id_reg;?><div style="float:right;"></td>
		<td><?php echo $row->pat_name;?> <div style="float:right;"></td>
		<td><?php echo date("d.m.Y",strtotime($row->reg_date));?></td>
		<td><?php echo $row->client_name;?></td>
		<td><?php if($row->id_service==0){
			echo "MCU";
			}else{
			echo "Outpatient";
			}
			?>
		</td>
		<td><?php echo strtoupper($row->fullname);?></td>
		<td><?php echo $row->create_date;?></td>
	</tr>
<?php
}
?>
</table>


