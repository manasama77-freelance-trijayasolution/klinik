<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Master Conversion.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<h1 align="center">Master Conversion</h1>
<?php echo date('Y-m-d H:i:s'); ?>

<table border='1' width="70%">
<tr>
	<th>No</th>
	<th>Source Base Unit</th>
	<th>Conv. Faktor</th>
	<th>Dest Base Unit</th>
	<th>Remark</th>												
</tr>
<?php
$i=1;
foreach($conversion_base->result() as $row){
?>
	<tr class="odd gradeX">
		<td><?=$i++;?></td>
		<td><?php echo $row->baseunit;?></td>
		<td><?php echo $row->conv_factor;?></td>		
		<td><?php echo $row->xx;?></td>	
		<td><?php echo $row->remarks;?></td>	
	</tr>
<?php
}
?>
</table>


