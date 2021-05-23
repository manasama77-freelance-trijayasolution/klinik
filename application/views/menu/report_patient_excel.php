<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Report Registration.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<h1 align="center">Report Patient</h1>
<h3 align="center">Periode <?php echo $datereg1." s/d ".$datereg2;?></h3>

<table border='1' width="100%">
<tr style="background-color:#A29D9B">
	<th style="width:30px">No.</th>
	<th>Date Registration</th>
	<th>Patient Name</th>
	<th>Service Name</th>
	<th>Doctor Name</th>
	<th>Price</th>
</tr>
<?php
$i=1;
$total = 0;
foreach($data->result() as $row){
	$total = $total+$row->Price;
?>
	<tr class="odd gradeX">
		<td><?php echo $i++;?></td>
		  <td><?php echo date("d.m.Y",strtotime($row->reg_date));?></td> 
		<td><?php echo $row->pat_name;?> </td>
		<td><?php echo $row->serv_name;?></td>
		<td>Magista Lutfia. Drg</td>
		<td align="right"><?php echo number_format($row->Price,2);?></td>
	</tr>
<?php
}
?>
	<tr>
		<td align="center" colspan="5">TOTAL</td>
		<td align="right"><?php echo number_format($total,2);?></td>
	</tr>
</table>


