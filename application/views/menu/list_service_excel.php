<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Master Service Price.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<h1 align="center">Master Service Price</h1>
<?php echo date('Y-m-d H:i:s'); ?>

<table border='1' width="70%">
<tr>
	<th>No.</th>
	<th>Group</th>
	<th>Services Name</th>
	<th>Type</th>
	<th>Price</th>
</tr>
<?php
$i=1;
foreach($data->result() as $row){
?>
	<tr class="odd gradeX">
		<td><?=$i++;?></td>
		<td><?php echo $row->group_item_name;?> - <?php echo $row->group_name;?></td>
		<td><?php echo $row->serv_name;?></td>
		<td>[<?php echo $row->price_type;?>]</td>
		<td><div align="right"><?php echo number_format($row->price,2);?></div></td>	
	</tr>
<?php
}
?>
</table>


