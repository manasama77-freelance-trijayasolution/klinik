<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Lab Non Unit And Range.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<h1 align="center">Lab Non Unit And Range</h1>
<?php echo date('Y-m-d H:i:s'); ?>

<table border='1' width="70%">
<tr>
	<th>No.</th>
	<th>Group ID </th>
	<th>Item ID</th>
	<th>Group Name</th>
	<th>Item Name</th>
	<th>Unit</th>
	<th>Std. Value</th>
	<th>Low Limit</th>
	<th>High Limit</th>
	<th>Min Limit</th>
	<th>Max Limit</th>
	<th>Age Range 1</th>
	<th>Age Range 2</th>
	<th>Jenis Kelamin</th>
</tr>
<?php
$i=1;
foreach($data->result() as $row){
?>
	<tr class="odd gradeX">
		<td><?=$i++;?></td>
		<td><?php echo $row->id_lab_item_group;?></td>
		<td><?php echo $row->id_lab_item;?></td>
		<td><?php echo $row->group_name;?></td>
		<td><?php echo $row->lab_item_desc;?></td>
		<td><?php echo $row->lab_item_unit;?></td>
		<td>'<?php echo $row->std_value;?></td>
		<td>'<?php echo $row->low_limit;?></td>
		<td>'<?php echo $row->high_limit;?></td>
		<td>'<?php echo $row->min_limit;?></td>
		<td>'<?php echo $row->max_limit;?></td>
		<td>'<?php echo $row->age_range_1;?></td>
		<td>'<?php echo $row->age_range_2;?></td>
		<td>'<?php echo $row->pat_gender;?></td>
	</tr>
<?php
}
?>
</table>


