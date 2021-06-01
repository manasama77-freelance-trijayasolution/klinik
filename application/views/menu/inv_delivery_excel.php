<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Master Delivery Address.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<h1 align="center">Master Delivery Address</h1>
<?php echo date('Y-m-d H:i:s'); ?>

<table border='1' width="70%">
<tr>
	<th>No</th>
	<th>Delivery Address</th>
</tr>
<?php
$i=1;
foreach($data->result() as $row){
?>
	<tr class="odd gradeX">
		<td><?=$i++;?></td>
		<td><?php echo $row->delivery_address;?></td>
	</tr>
<?php
}
?>
</table>


