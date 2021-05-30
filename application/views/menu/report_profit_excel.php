<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Report Profit.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<h1 align="center">Report Profit</h1>
<h3 align="center">Periode <?php echo $datereg1 . " s/d " . $datereg2; ?></h3>

<table border='1' width="100%" align="center" style="font-size: 18px;">
	<thead>
		<tr style="background-color:#A29D9B">
			<th style="width:30px">No.</th>
			<th>Date</th>
			<th>Item In</th>
			<th>Item Out</th>
			<th>Price In</th>
			<th>Price Out</th>
			<th>Total</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$i         = 1;
		$total     = $arr_data['total'];
		foreach ($arr_data['result'] as $key) {
		?>
			<tr class="odd gradeX">
				<td><?= $i++; ?></td>
				<td><?= $key['date']; ?></td>
				<td><?= $key['in']; ?> </td>
				<td><?= $key['out']; ?> </td>
				<td align="right"><?= number_format((int)$key['price_in'], 0); ?></td>
				<td align="right"><?= number_format((int)$key['price_out'], 0); ?></td>
				<td align="right"><?= number_format((int)$key['total'], 0); ?></td>
			</tr>
		<?php
		}
		?>
	</tbody>
	<tfoot>
		<tr>
			<td align="center" colspan="6"><b>TOTAL</b></td>
			<td align="right"><b><?= number_format($total, 0); ?></b></td>
		</tr>
	</tfoot>
</table>