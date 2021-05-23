<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Master Item.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<h1 align="center">Master Item</h1>
<?php echo date('Y-m-d H:i:s'); ?>

<table border='1' width="70%">
<tr>
	<th>No</th>
	<th>Group</th>
	<th>Name</th>
	<th>Supplier</th>
	<th>Batch Code</th>
	<th>Baseunit</th>
</tr>
<?php
$i=1;
foreach($data->result() as $row){
?>
	<tr class="odd gradeX">
		<td><?=$i++;?></td>
		<td><?php echo $row->item_group;?></td>
		<td><?php echo $row->item_name;?></td>		
		<td><?php echo $row->supp_name;?></td>			
		<td><?php echo $row->batch_code;?></td>	
		<td><?php echo $row->baseunit;?></td>
	</tr>
<?php
}
?>
</table>


