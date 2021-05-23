<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Export Quotation.xls");
header("Pragma: no-cache");
header("Expires: 0");
foreach($print_h->result() as $rows){}
?> 
	<body>
	
		<div id="customer" style="float:left;">
            <table border="1" >
				<tr>
					<td><b>No. Quotation</b></td>
					<td ><?=$rows->qout_id?><?php if($rows->quot_revision>=1){ echo "/Rev-".$rows->quot_revision;} ?></td>
				</tr>
				<tr>
					<td><b>Package Name</b></td>
					<td><?=$rows->quot_name?></td>
				</tr>
				<tr>
					<td><b>Company</b></td>
					<td><?=$rows->client_name?></td>
				</tr>
            </table>
		</div>
		<div></div>
		<?php
		$x=1;
		$i=1;
		$jumlah 		= 0;
		$current_cat 	= null;
		$count 			= $data->num_rows();
		?>
<br>
		<table border="1" >		
		  <thead>
		  <tr>
			  <th>No</th>
		      <th>Group</th>
		      <th>Items</th>
		      <th>Option</th>
		  </tr>
		  </thead>
			<?php
			foreach($data->result() as $row){
				$jumlah = $jumlah + $row->service_price
			?>
		  <tr class="item-row">
		        <td><?=$i++;?></td>
				<td  valign='top'><?=$row->group_desc;?></td>
				<td ><?php echo $row->serv_name;?></td>
				<td style="width:5px;">&#10004;</td>	
		  </tr>
			<?php
				}
			?>
		
	</div>
</body>