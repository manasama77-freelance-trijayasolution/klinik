<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Master Items Group.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<h1 align="center">Master Items Group</h1>
<?php echo date('Y-m-d H:i:s'); ?>

<table border='1' width="70%">
<tr>
	<th>No</th>
	<th>Group Name</th>
	<th>Description</th>				
</tr>
<?php
$i=1;
foreach($data->result() as $row){
?>
	<tr class="odd gradeX">
		<td><?=$i++;?></td>
		<td><?php echo $row->item_group;?></td>
		<td><?php echo $row->remarks;?></td>		
	</tr>
<?php
}
?>
</table>


