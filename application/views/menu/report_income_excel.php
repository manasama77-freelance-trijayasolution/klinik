<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Report Income.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<h1 align="center">Report Income</h1>
<?php echo date('Y-m-d H:i:s'); ?>

<table border='1' width="70%">
<tr>
	<th>No.</th>
	<th>Date Registration</th>
	<th>Patient Name</th>
	<th>Service Name</th>
	<th>Doctor Name</th>
	<th>Price</th>
</tr>
<?php
$i=1;
foreach($data->result() as $row){
?>
	<tr class="odd gradeX">
		<td><?php echo $i++;?></td>
		  <td><?php echo date("d.m.Y",strtotime($row->reg_date));?></td> 
		<td><?php echo $row->pat_name;?> </td>
		<td><?php echo $row->serv_name;?></td>
		<td>Magista Lutfia. Drg</td>
		<td>Rp <?php echo number_format($row->Price,2);?></td>
	</tr>
<?php
}
?>
</table>


