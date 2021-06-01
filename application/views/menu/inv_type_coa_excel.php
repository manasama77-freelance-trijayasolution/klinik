<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Master Type Coa.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<h1 align="center">Master Type Coa</h1>
<?php echo date('Y-m-d H:i:s'); ?>

<table border='1' width="70%">
<tr>
	<th>No</th>
	<th>Account ID</th>
	<th>Desc 1</th>
	<th>Desc 2</th>												
</tr>
<?php
$i=1;
foreach($hasil->result() as $row){
?>
	<tr class="odd gradeX">
		<td><?=$i++;?></td>
		<td><?php echo $row->id_coa;?></td>
		<td><?php echo $row->desc1;?></td>		
		<td><?php echo $row->desc2;?></td>		
	</tr>
<?php
}
?>
</table>


