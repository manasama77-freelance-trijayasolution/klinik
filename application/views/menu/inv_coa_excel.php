<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Master Coa.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<table border='1' width="70%">
<tr>
	<th>No. Akun</th>
	<th>Nama</th>
	<th>Nama</th>												
	<th>Mata Uang</th>												
	<th>Tipe Akun</th>												
	<th>Induk Akun</th>												
	<th>Tahun</th>												
</tr>
<?php
$i=1;
foreach($hasil->result() as $row){
?>
	<tr class="odd gradeX">
		<td><?php echo $row->id_coa;?></td>
		<td><?php echo $row->desc1;?></td>		
		<td><?php echo $row->desc2;?></td>		
		<td><?php echo $row->matauang;?></td>		
		<td><?php echo $row->tipe;?></td>		
		<td><?php echo $row->group;?></td>		
		<td><?php echo $row->year;?></td>		
	</tr>
<?php
}
?>
</table>


