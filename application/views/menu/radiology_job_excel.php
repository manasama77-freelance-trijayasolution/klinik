<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Radiology Order List.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<h1 align="center">Radiology Order List</h1>
<?php echo date('Y-m-d H:i:s'); ?>

<table border='1' width="70%">
<tr>
	<th>No.</th>
    <th>ID Registration</th>
	<th>Order Date</th>
    <th>Patient</th>
	<th>Company Name</th>
	<th>List Exam.</th>
</tr>
<?php
$i=1;
foreach($data->result() as $row){
?>
	<tr class="odd gradeX">
		<td><?php echo $i++;?></td>
		<?php if($id==1){ ?>
	    <td><?php echo $row->id_reg;?>-<?php echo $row->id_order;?></td>
		<?php }else{ ?>
		<td><?php echo $row->id_reg;?></td>
		<?php } ?>
		<td><?=date("d.m.Y H:i:s",strtotime($row->order_date));?></td>
	    <td><?php echo $row->pat_name;?></td>
		<td><?php echo $row->client_name;?></td>
		<td><p style="font-size: 0.875em;">	<?php echo str_replace(",",".</br>",$row->items);?></p></td>
	</tr>
<?php
}
?>
</table>


