<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Master Supplier.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<h1 align="center">Master Supplier</h1>
<?php echo date('Y-m-d H:i:s'); ?>

<table border='1' width="70%">
<tr>
	<th>No</th>
	<th>Code</th>
	<th>Name</th>
	<th>Address</th>
	<th>Contact</th>
	<th>Phone</th>
	<th>Term of Payment</th>
</tr>
<?php
$i=1;
foreach($data->result() as $row){
?>
	<tr class="odd gradeX">
		<td><?=$i++;?></td>
		<td><?php echo $row->supp_code;?></td>
		<td><?php echo $row->supp_name;?></td>											
		<td><?php echo $row->supp_address1;?></td>
		<td><?php echo $row->supp_contact1;?></td>
		<td><?php echo $row->supp_phone;?></td>
		<td><?php echo $row->term_payment;?></td>
	</tr>
<?php
}
?>
</table>


