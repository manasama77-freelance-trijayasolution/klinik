<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Master Lab Group.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<h1 align="center">Master Lab Group</h1>
<?php echo date('Y-m-d H:i:s'); ?>

<table border='1' width="70%">
<tr>
	<th>No</th>
	<th>Group Name</th>
	<th>Sequence Number</th>
</tr>
<?php
$i=1;
foreach($data->result() as $row){
?>
	<tr class="odd gradeX">
		<td><?=$i++;?></td>
		<td><?php echo $row->group_name;?></td>
		<td><?php echo $row->group_seq_no;?></td>
	</tr>
<?php
}
?>
</table>


