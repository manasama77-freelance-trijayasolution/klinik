<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=List Language.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<h1 align="center">List Language</h1>
<?php echo date('Y-m-d H:i:s'); ?>

<table border='1' width="70%">
<thead>
	<tr>
		<th>No</th>
		<th>English</th>
		<th>Japan</th>
	</tr>
</thead>
<?php
$i=1;
foreach($find->result() as $row){
?>
<tr class="odd gradeX">
	<td><?=$i;?></td>
	<td><?php echo $row->nama_value;?></td>
	<td><?php echo $row->nama_value_j;?></td>
</tr>
<?php
$i++;
}
?>
</table>


