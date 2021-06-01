<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Report Expense.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<h1 align="center">Report Expense</h1>
<h3 align="center">Periode <?php echo $datereg1 . " s/d " . $datereg2; ?></h3>

<table border='1' width="100%" align="center">
	<tr style="background-color:#A29D9B">
		<th style="width:30px">No</th>
		<th>Tgl Expense</th>
		<th>Nama Barang</th>
		<th>Nama Supplier</th>
		<th>Qty</th>
		<th>Harga</th>
		<th>Biaya Tambahan</th>
		<th>Total</th>
	</tr>
	<?php
	$i = 1;
	$grand_total = 0;
	foreach ($data->result() as $row) {
		$grand_total = $grand_total + $row->sub_total;
	?>
		<tr class="odd gradeX">
			<td><?= $i++; ?></td>
			<td><?= $row->created_at; ?></td>
			<td><?= $row->nama_barang; ?> </td>
			<td><?= $row->nama_supplier; ?> </td>
			<td align="right"><?= number_format($row->qty, 0); ?></td>
			<td align="right"><?= number_format($row->harga, 0); ?></td>
			<td align="right"><?= number_format($row->biaya_tambahan, 0); ?></td>
			<td align="right"><?= number_format($row->sub_total, 0); ?></td>
		</tr>
	<?php
	}
	?>
	<tr>
		<td align="right" colspan="7"><b>GRAND TOTAL</b></td>
		<td align="right"><b><?= number_format($grand_total, 0); ?></b></td>
	</tr>
</table>