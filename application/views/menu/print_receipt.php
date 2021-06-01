<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<!-- Bootstrap 3.3.2 -->
	<link href="<?php echo base_url('assets/AdminLTE-2.0.5/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
</head>

<body onload="window.print();">
	<!-- <body onload="window.print();window.close();"> -->
	<div style="font-size:6px; font-family:'Verdana'; width:50mm;">
		<label style="font-size:8px; display:block; width:x; height:y; text-align:center;"><strong>Klinik drg. Magista Lutfia</strong></label>
		<p style="text-align:center;"><strong>Jl. Merpati Blok D18 No.5, RT.007/RW.009, Gebang Raya, Periuk, Tangerang City, Banten 15132</strong></p>
		<br>
		<br>
		<table style="width:100%">
			<tr>
				<td style="width:50%"><?php echo $invno; ?></td>
				<td style="width:50%; text-align:right;"><?php echo $tgl; ?></td>
			</tr>
			<tr>
				<td style="width:50%">Pembayaran :
					<?php
					if ($trx_pat_payment_d->row()->type_payment == 0) {
						echo "Cash";
					} elseif ($trx_pat_payment_d->row()->type_payment == 1) {
						echo "Credit Card";
					} elseif ($trx_pat_payment_d->row()->type_payment == 5) {
						echo "Debit Card";
					}
					?>
				</td>
				<td style="width:50%; text-align:right;">Kasir : <?php echo $username; ?></td>
			</tr>
		</table>
		<br>
		<table style="width:100%">
			<tr>
				<td colspan="3" style="border:1px solid;"></td>
			</tr>
			<tr>
				<th style="width:30%; text-align:center;">ITEM(s)</th>
				<th style="width:35%; text-align:right;">HARGA</th>
				<th style="width:35%; text-align:right;">TOTAL</th>
			</tr>
			<tr>
				<td colspan="3" style="border:1px solid;"></td>
			</tr>
			<?php
			$jml = 0;
			foreach ($fisik_billing->result() as $row) : ?>

				<tr>
					<td colspan="3" style="width:100%"><?php echo $row->serv_name; ?></td>
				</tr>
				<tr>
					<td style="width:30%; text-align:center;">1 X</td>
					<td style="width:35%; text-align:right;"><?php echo number_format($row->harga, 0, ",", "."); ?></td>
					<td style="width:35%; text-align:right;"><?php echo number_format($row->harga, 0, ",", "."); ?></td>
				</tr>

			<?php $jml = $jml + 1;
			endforeach; ?>
			<tr>
				<td colspan="3" style="border:1px solid;"></td>
			</tr>
		</table>
		<table style="width:100%">
			<?php foreach ($total->result() as $header) : ?>

				<tr>
					<td style="width:65%; text-align:right;">JUMLAH</td>
					<td style="width:5%; text-align:right;"> : </td>
					<td style="width:30%; text-align:right;"><?php echo number_format($jml, 0, ",", "."); ?></td>
				</tr>
				<tr>
					<td style="width:65%; text-align:right;">TOTAL HARGA</td>
					<td style="width:5%; text-align:right;"> : </td>
					<td style="width:30%; text-align:right;"><?php echo number_format($header->total, 0, ",", "."); ?></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td style="width:65%; text-align:right;">BAYAR</td>
					<td style="width:5%; text-align:right;"> : </td>
					<td style="width:30%; text-align:right;"><?php echo number_format($trx_pat_payment_d->row()->bayar, 0, ",", "."); ?></td>
				</tr>
				<tr>
					<td style="width:65%; text-align:right;">DISC</td>
					<td style="width:5%; text-align:right;"> : </td>
					<td style="width:30%; text-align:right;"><?php echo number_format($header->disc, 0, ",", "."); ?></td>
				</tr>
		</table>

		<br />
		<center><label>- TERIMA KASIH -</label></center>
	<?php endforeach; ?>

	</div>
</body>

</html>