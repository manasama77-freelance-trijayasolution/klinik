	<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <style>
 @media print {

  table.report { page-break-after:auto }
  table.report tr    { page-break-inside:avoid; page-break-after:auto }
  table.report td    { page-break-inside:avoid; page-break-after:auto }
  table.report thead { display:table-header-group }
  table.report tfoot { display:table-footer-group }
 }
    </style>
</head>
	<link rel='stylesheet' type='text/css' href='<?php echo base_url();?>design/invoice/css/style.css' />
	<link rel='stylesheet' type='text/css' href='<?php echo base_url();?>design/invoice/css/print.css' media="print" />
	<script type='text/javascript' src='<?php echo base_url();?>design/invoice/js/jquery-1.3.2.min.js'></script>
	<script type='text/javascript' src='<?php echo base_url();?>design/invoice/js/example.js'></script>
    <?php
			foreach($print_h->result() as $rows){}
	?> 
	<body>
	<div id="page-wrap">
		<textarea style="height:35px;" id="header">SPECIFICATION</textarea>
		<div id="identity">
            <div id="logo">
              <div id="logoctr">
                <a href="javascript:;" id="change-logo" title="Change logo">Change Logo</a>
                <a href="javascript:;" id="save-logo" title="Save changes">Save</a>
                |
                <a href="javascript:;" id="delete-logo" title="Delete logo">Delete Logo</a>
                <a href="javascript:;" id="cancel-logo" title="Cancel changes">Cancel</a>
              </div>

              <div id="logohelp">
                <input id="imageloc" type="text" size="50" value="" /><br />
                (max width: 540px, max height: 100px)
              </div>
              <img id="image" style="width: 148px; height:75;" src="<?php echo base_url();?>design/images/logokyoai.png" alt="logo" />
            </div>
		</div>

		<div style="clear:both"><b>Klinik drg. Magista Lutfia</b></br>
		<textarea id="address">Head Office:
Prince Center 4th. Floor. Jl. Jend.Sudirman Kav.3-4, JKT.10220
Phone: (021) 573 4550</textarea>
</div>
		<div id="customer" style="float:left;">
            <table id="meta" >
				<tr>
					<td class="meta-head" style="padding: 10px;">No. Quotation</td>
					<td style="padding: 10px;"><?=$rows->qout_id?><?php if($rows->quot_revision>=1){ echo "/Rev-".$rows->quot_revision;} ?></td>
				</tr>
				<tr>
					<td class="meta-head" style="padding: 10px;">Package Name</td>
					<td style="padding: 10px;"><?=$rows->quot_name?></td>
				</tr>
				<tr>
					<td class="meta-head" style="padding: 10px;">Company</td>
					<td style="padding: 10px;"><?=$rows->client_name?></td>
				</tr>
            </table>
		</div>
		<div style="clear:both"></div>
		<?php
		$x=1;
		$i=1;
		$jumlah 		= 0;
		$current_cat 	= null;
		$count 			= $data->num_rows();
		?>

		<table id="items">		
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
		        <td style="width:1px;"><div class="delete-wpr"><a class="delete" href="javascript:;" title="Remove row">X</a></div><textarea style="width:30px;height:19px;"><?=$i++;?></textarea></td>
				<td class="item-name" valign='top'><textarea><?=$row->group_desc;?></textarea></td>
				<td class="description"><textarea><?php echo $row->serv_name;?></textarea></td>
				<td style="width:5px;"><textarea>&#10004;</textarea></td>	
		  </tr>
			<?php
				}
			?>
		  <tr id="hiderow">
		    <td colspan="4"><a id="addrow" href="javascript:;" title="Add a row">Add a row</a></td>
		  </tr>
		  
		  <tr>
		      <td colspan="1" class="blank"> </td>
		      <td colspan="2" class="total-line balance">Grand Price</td>
		      <td class="total-value balance"><div class="due"><?php echo number_format($row->grand_price,2); ?></div></td>
		  </tr>
		
		</table>
		
		<div id="terms">
		  <h5>Notes</h5>
		  <textarea>. . .</textarea>
		</div>
	</div>
</body>