<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=List Lab Item.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<h1 align="center">List Lab Item</h1>
<?php echo date('Y-m-d H:i:s'); ?>

<table border='1' width="70%">
	<tr>
		<th>No.</th>
		<th>Item Description</th>
		<th>Item Abbr</th>
		<th>Unit</th>
		<th>Result Type</th>
		<th>Group</th>
	</tr>
<?php
$i=1;
foreach($data->result() as $row){
?>
	<tr class="odd gradeX">
		<td><?=$i++;?></td>
		<td><?php echo $row->lab_item_desc;?></td>
		<td><?php echo $row->lab_item_abbr;?></td>
		<td><?php echo $row->lab_item_unit;?></td>
		<td>
		<?php 
		if ($row->lab_item_case == 0) {
			echo "Range Normal";
		}else{
			echo "Kombinasi Karakter";
		}
		?>
			

		</td>
		<td><?php echo $row->group_name;?></td>
	</tr>
<?php
}
?>
</table>


