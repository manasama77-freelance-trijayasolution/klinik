<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Master Currency.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<h1 align="center">Master Currency</h1>
<?php echo date('Y-m-d H:i:s'); ?>

<table border='1' width="70%">
<tr>
	<th>No</th>
	<th>Date</th>
	<th>Value</th>
	<th>Type</th>
</tr>
<?php
$i=1;
foreach($data->result() as $row){
?>
	<tr class="odd gradeX">
		<td><?=$i++;?></td>
		<td><?php echo $row->create_date;?></td>
		<td><?php echo number_format($row->amount,2);?></td>
		<td><?php echo $row->code;?></td>
	</tr>
<?php
}
?>
</table>


