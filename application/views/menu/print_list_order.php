<!-- Javascript goes in the document HEAD -->
<script type="text/javascript">
	function altRows2(id) {
		if (document.getElementsByTagName) {
			var table = document.getElementById(id);
			var rows = table.getElementsByTagName("tr");
			for (i = 0; i < rows.length; i++) {
				if (i % 2 == 0) {
					rows[i].className = "evenrowcolor2";
				} else {
					rows[i].className = "oddrowcolor2";
				}
			}
		}
	}

	window.onload = function() {
		altRows2('alternatecolor2');
		altRows2('alternatecolor3');
		altRows2('alternatecolor4');
		altRows2('alternatecolor5');
		altRows2('alternatecolor6');
		altRows2('alternatecolor7');
		altRows2('alternatecolor8');
	}
</script>
<!-- CSS goes in the document HEAD or added to your external stylesheet -->
<style>
	a:link,
	a:visited {
		background-color: #f44336;
		color: white;
		padding: 5px 15px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
	}


	a:hover,
	a:active {
		background-color: red;
	}
</style>
<style type="text/css">
	@media print {

		.no-print,
		.no-print * {
			display: none !important;
		}
	}

	table.altrowstable3 {
		font-family: verdana, arial, sans-serif;
		font-size: 11px;
		color: #333333;
		border-width: 1px;
		border-color: #a9c6c9;
		border-collapse: collapse;
	}

	table.altrowstable3 th {
		border-width: 1px;
		padding: 8px;
		border-style: solid;
		border-color: #a9c6c9;
	}

	table.altrowstable3 td {
		border-width: 1px;
		padding: 8px;
		border-style: solid;
		border-color: #a9c6c9;
	}

	.oddrowcolor3 {
		background-color: #d4e3e5;
	}

	.evenrowcolor3 {
		background-color: #c3dde0;
	}

	.oddrowcolor2 {
		background-color: #d4e3e5;
	}

	.evenrowcolor2 {
		background-color: #c3dde0;
	}

	table.altrowstable2 {
		font-family: verdana, arial, sans-serif;
		font-size: 11px;
		color: #333333;
		border-width: 1px;
		border-color: #a9c6c9;
		border-collapse: collapse;
	}

	table.altrowstable2 th {
		border-width: 1px;
		padding: 8px;
		border-style: solid;
		border-color: #a9c6c9;
	}

	table.altrowstable2 td {
		border-width: 1px;
		padding: 8px;
		border-style: solid;
		border-color: #a9c6c9;
	}

	@font-face {
		font-family: IDAutomationHC39M;
		src: url('<?php echo base_url(); ?>design/font/IDAutomationHC39M.ttf');
	}
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<head>
	<title>Marking Sheet Doctor Order | Print From IP : <?= $_SERVER['REMOTE_ADDR']; ?></title>
	<p align="center"><b><u>Klinik drg. Magista Lutfia</u></b></br>
		<font style="font-family: 'helvetica', helvetica, serif; font-size: 12px;"><b>Marking Sheet Doctor Order</b></font></br>
	</p>
	<?php
	function findage_detail($dob)
	{
		$interval = date_diff(date_create(), date_create($dob));
		echo $interval->format("%Y Year, %M Months");
	}
	foreach ($data->result() as $row) {
	}
	?>
</head>

<body>
	<table class="altrowstable3" id="alternatecolor3" width="100%">
		<thead>
			<tr>
				<td valign="top">ID Registration</td>
				<td valign="top" colspan="2"><?php echo $row->id_reg; ?></td>
				<td valign="top">Date of Birth</td>
				<td valign="top"><?= date("d.m.Y", strtotime($row->pat_dob)); ?></td>
			</tr>
			<tr>
				<td valign="top">Company Name</td>
				<td valign="top" colspan="2"><?php echo $row->client_name; ?></td>
				<td valign="top">Age</td>
				<td valign="top" colspan="2"><?= findage_detail($row->pat_dob); ?></td>
			<tr>
				<?php
				$parampa	= "";
				if ($row->idx == "1") {
					$parampa	= "<i>Outpatient</i>";
				} else {
					$parampa	= "<i>Medical Check Up</i>";
				}
				?>
				<td valign="top">Date of Registration</td>
				<td valign="top" colspan="2"><?= date("d.m.Y", strtotime($row->reg_date)); ?> - <?= date("H:i:s", strtotime($row->create_date)); ?></td>
				<td valign="top">Type of Registration</td>
				<td valign="top" colspan="5"><b>Outpatient</b></td>
			</tr>
			</tr>
			<tr>
				<td valign="top">Patient Name</td>
				<td valign="top" colspan="2"><?php echo $row->pat_name; ?>, <?php echo $row->title_desc; ?></td>
				<td valign="top"></td>
				<td valign="top"></td>
			</tr>
		</thead>
	</table>
	<br>
	<table class="altrowstable2" width="100%">
		<thead>
			<tr>
				<th colspan="2" style="text-align: left;">ODONTOGRAM</th>
			</tr>
			<tr>
				<th style="text-align: center; width: 100px;">No Gigi</th>
				<th style="text-align: left;">Detail</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($arr_odo->result() as $key) : ?>
				<tr>
					<td style="text-align: center;"><?= $key->odo_value; ?></td>
					<td style="text-align: left;"><?= $key->odo_desc; ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<br>
	<div class="block" style="width: 100%; float: left;">

		<table class="altrowstable2" id="alternatecolor4" width="100%">
			<thead>
				<tr>
					<td align="left" colspan="4"><b>SERVICES</b></td>
				</tr>
			</thead>
			<script>
				function ser_cancel(upin, ipin) {
					var txt;
					var r = confirm("Are you sure ?");
					if (r == true) {
						$.post("../update_lab/" + upin + "/" + ipin + "", $("#console").serialize());
						//throw new Error("Something went badly wrong!");
						window.location.reload();
					} else {
						txt = "You pressed Cancel!";
					}
				}
			</script>
			<?php
			foreach ($detailother->result() as $row3) {
			?>
				<tr>
					<?php
					$isi	= "";
					if ($row3->mcu == "1") {
						$isi	= ", [<b>MCU</b>]";
					} else {
						$isi	= "";
					}
					?>
					<?php
					if ($row3->order_status == "1" && $row3->mcu != "1") {
					?>
						<td valign="bottom"><a href="#" onclick="ser_cancel(<?php echo $row3->id_service; ?>, <?php echo $row3->id_order; ?>);" class='no-print'>[Cancel Order]</a> <?php echo $row3->group_desc; ?></td>
					<?php
					} else {
					?>
						<td valign="bottom"><?php echo $row3->group_desc; ?></td>
					<?php
					}
					?>
					<td valign="bottom"><?php echo $row3->order_date; ?></td>
					<td valign="bottom"><?php echo $row3->serv_name; ?><?= $isi; ?></td>
				</tr>
			<?php
			}
			?>

			<?php
			foreach ($detailgrp->result() as $rowgrp) {
			?>
				<tr>
					<td valign="bottom"><a href="#" onclick="ser_cancel(<?php echo $rowgrp->id_service; ?>, <?php echo $rowgrp->id_order; ?>);" class='no-print'>[Cancel Order]</a> <?php echo $rowgrp->group_desc; ?></td>
					<td valign="bottom"><?php echo $rowgrp->order_date; ?></td>
					<td valign="bottom"><?php echo $rowgrp->name_service; ?></td>
				</tr>
			<?php
			}
			?>

			<script>
				function lab_cancel(upin, ipin) {
					var txt;
					var r = confirm("Are you sure ?");
					if (r == true) {
						$.post("../update_lab/" + upin + "/" + ipin + "", $("#console").serialize());
						//throw new Error("Something went badly wrong!");
						window.location.reload();
					} else {
						txt = "You pressed Cancel !";
					}
				}
			</script>
		</table>


</body>
</div>