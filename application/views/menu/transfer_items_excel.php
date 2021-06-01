<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Request Items.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<h1 align="center">Request Items</h1>
<?php echo date('Y-m-d H:i:s'); ?>

<table border='1' width="70%">
<tr>
	<th>No</th>
	<th>Source</th>
	<th>Code</th>
	<th>Items</th>
	<th>Create By</th>
	<th>Create Date</th>
</tr>
<?php
$i=1;
foreach($list->result() as $row){
?>
	<tr class="odd gradeX">
		<td><?=$i++;?></td>
		<td><?php echo $row->source;?></td>		
		<td><?php echo $row->pr_no;?></td>		
		<td><?php echo $row->jml;?></td>		
		<td><?php echo $row->fullname;?></td>		
		<td><?php echo $row->create_date;?></td>		
	</tr>
<?php
}
?>
</table>


