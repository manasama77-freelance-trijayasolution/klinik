<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Report Profit.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<h1 align="center">Report Profit</h1>
<h3 align="center">Periode <?php echo $datereg1." s/d ".$datereg2;?></h3>

<table border='1' width="100%">
<tr style="background-color:#A29D9B">
	<th style="width:30px">No.</th>
	<th>Date</th>
	<th>Item In</th>
	<th>Item Out</th>
	<th>Total</th>
	<th>Info</th>
</tr>
<?php
$i 		=1;
$total 	=0;
foreach($data->result() as $row){
	$total = $total+$row->Price;
?>
	<tr class="odd gradeX">
		<td><?php echo $i++;?></td>
		  <td><?php echo date("d.m.Y",strtotime($row->tgl));?></td> 
		<td><?php echo $row->item_in;?> </td>
		<td><?php echo $row->item_out;?> </td>
		<td align="right"><?php echo number_format($row->Price,2);?></td>
		<td><?php echo $row->ket;?> </td>
	</tr>
<?php
}
?>
	<tr>
		<td align="center" colspan="4">TOTAL</td>
		<td align="right"><?php echo number_format($total,2);?></td>
	</tr>
</table>