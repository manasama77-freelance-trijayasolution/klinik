<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Master Warehouse.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<h1 align="center">Master Warehouse</h1>
<?php echo date('Y-m-d H:i:s'); ?>

<table border='1' width="70%">
<tr>
	<th>No</th>
	<th>Warehouse Name</th>
	<th>Warehouse Code</th>
	<th>Department</th>
</tr>
<?php
$i=1;
foreach($data->result() as $row){
?>
	<tr class="odd gradeX">
		<td><?=$i++;?></td>
		<td><?php echo $row->warehouse_name;?></td>
		<td><?php echo $row->warehouse_code;?></td>
		<td><?php echo $row->nama_dep;?></td>
	</tr>
<?php
}
?>
</table>


