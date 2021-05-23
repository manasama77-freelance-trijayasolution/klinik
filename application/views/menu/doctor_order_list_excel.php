<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=List Order.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<h1 align="center">List Order</h1>
<?php echo date('Y-m-d H:i:s'); ?>

<table border='1' width="70%">
<tr>
	<th>ID Registration</th>             
	<th>Order Date</th>						
	<th>Patient Name</th>		
	<th>Company Name</th>					
</tr>
<?php	foreach($data->result() as $row){ ?>                                           
<tr class="odd gradeX">                                                
	<td><?php echo $row->id_reg;?></td>  
	<td><?php echo $row->order_date;?></td>					
	<td><?php echo $row->pat_name;?></td>	
	<td><?php echo $row->client_name;?></td>															
</tr>										
<?php	} ?>                                        
</table>


