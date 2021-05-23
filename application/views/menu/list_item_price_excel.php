<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Master Item Price.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<h1 align="center">Master Item Price</h1>
<?php echo date('Y-m-d H:i:s'); ?>

<table border='1' width="70%">
<tr>
	<th>No</th>
	<th>Item Code</th>
	<th>Name</th>
	<th>Currency</th>
	<th>Price</th>
	<th>Type</th>
	<th>Branch</th>
	<th>Urutan</th>
</tr>
<?php
$i=1;
foreach($data->result() as $row){
?>
	<tr class="odd gradeX">
		<td><?=$i++;?></td>
		<td><?php echo $row->code_item;?></td>		
		<td><?php echo $row->item_name;?></td>		
		<td><?php echo $row->Currency;?></td>			
		<td><?php echo number_format($row->Price,2);?></td>	
		<td><?php echo $row->price_type;?></td>
		<td><?php echo $row->nama_branch;?></td>
		<td><?php echo $row->id_price;?></td>
	</tr>
<?php
}
?>
</table>


