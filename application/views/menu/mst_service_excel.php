<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Master Service Price.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<h1 align="center">Report Registration</h1>
<?php echo date('Y-m-d H:i:s'); ?>

<table border='1' width="70%">
<tr>
	<th>No</th>
	<th>Group</th>
	<th>Services Name</th>
	<th>Type</th>
	<th>Price</th>
</tr>
<?php
$i=1;
foreach($find->result() as $row){
?>
	<tr class="odd gradeX">
		<td><?=$i++;?></td>
		<td><?php echo $row->group_name;?></td>		
		<td><?php echo $row->serv_name;?></td>			
		<td><?php echo $row->price_type;?></td>			
		<td><?php echo $row->price;?></td>	
	</tr>
<?php
}
?>
</table>


