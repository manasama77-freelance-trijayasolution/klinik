<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Report User List.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<h1 align="center">Report User List</h1>
<?php echo date('Y-m-d H:i:s'); ?>

<table border='1' width="70%">
<tr>
	<th>User ID</th>
	<th>User Name</th>
	<th>User Level</th>
	<th>Full Name</th>
</tr>
<?php
$i=1;
foreach($list->result() as $row){
?>
	<tr class="odd gradeX">
		<td><?php echo $row->id;?></td>
        <td><?php echo $row->username;?></td>
        <td><?php echo $row->userlevel;?></td>
        <td><?php echo $row->fullname;?></td>
	</tr>
<?php
}
?>
</table>


