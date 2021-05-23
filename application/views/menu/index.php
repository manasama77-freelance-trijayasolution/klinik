<script>
	(function() {
		setInterval(function() {
			$.ajax({
				async: true,
				dataType: 'html',
				type: 'GET',
				url: './design/files/execute_query.php',
				success: function(data) {
					console.log(data);
					$('#test').html(data);
				}
			});
		}, 200);
	}());
</script>
<style>
	p.hi {
		color: black;
		font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
		font-size: 16px;
		margin: 10px 0 0 10px;
		white-space: nowrap;
		overflow: hidden;
		width: 30em;
		animation: type 4s steps(60, end);
	}

	p.hi:nth-child(2) {
		animation: type2 8s steps(60, end);
	}

	span.hi {
		animation: blink 1s infinite;
	}

	@keyframes type {
		from {
			width: 0;
		}
	}

	@keyframes type2 {
		0% {
			width: 0;
		}

		50% {
			width: 0;
		}

		100% {
			width: 100;
		}
	}

	@keyframes blink {
		to {
			opacity: .0;
		}
	}
</style>
<!--
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
-->
<script type="text/javascript" src="<?php echo base_url(); ?>design/chat/chat.js"></script>
<script type="text/javascript">
	<?php
	$data_user 	= ucwords($fullname);
	$split_user	= explode(" ", $data_user)
	?>
	name = "<?= $split_user[0]; ?>";
	name = name.replace(/(<([^>]+)>)/ig, "");
	var chat = new Chat();
	$(function() {
		chat.getState();
		// watch textarea for key presses
		$("#sendie").keydown(function(event) {

			var key = event.which;

			//all keys including return.  
			if (key >= 33) {

				var maxLength = $(this).attr("maxlength");
				var length = this.value.length;

				// don't allow new content if length is maxed out
				if (length >= maxLength) {
					event.preventDefault();
				}
			}
		});
		// watch textarea for release of key press
		$('#sendie').keyup(function(e) {

			if (e.keyCode == 13) {

				var text = $(this).val();
				var maxLength = $(this).attr("maxlength");
				var length = text.length;

				// send 
				if (length <= maxLength + 1) {
					chat.send(text, name);
					$(this).val("");
				} else {
					$(this).val(text.substring(0, maxLength));
				}
			}
		});

	});
</script>

<?php
$Hour = date('G');
$msg  = "";
if ($Hour >= 5 && $Hour <= 10) {
	$msg = "Good Morning";
} else if ($Hour >= 10 && $Hour <= 17) {
	$msg = "Good Afternoon";
} else if ($Hour >= 17 || $Hour <= 4) {
	$msg = "Good Evening, Enjoy your Night";
}
?>
<div class="container-fluid">
	<div style="float: left; text-align: left;">
		<p class="hi">Hi <?= ucwords($fullname); ?>, <?= $msg; ?> <span class="hi"><i class="icon-leaf"></i></span></p>
	</div>

	<section id="appointments" style="margin-top: 50px;">
		<div class="row-fluid">
			<div class="span12" style="background: #fff;">
				<div class="accordion" id="accordion2">
					<div class="accordion-group">
						<div class="accordion-heading">
							<h4 class="accordion-toggle" style="cursor: auto;">Appointment with Patient</h4>
						</div>
						<div id="collapseOne" class="accordion-body collapse in">
							<div class="accordion-inner">
								<table class="table table-striped table-bordered">
									<thead>
										<tr>
											<th style="text-align: center;">Patient Name</th>
											<th style="text-align: center;">Registration Date</th>
											<th style="text-align: center;">Appointment Date</th>
											<th style="text-align: center;">Appointment Time</th>
										</tr>
									</thead>
									<tbody>
										<?php if ($arr_appointment->num_rows() == 0) { ?>
											<tr>
												<td class="text-error" colspan="4" style="text-align: center;">No Appointment Data</td>
											</tr>
										<?php } else { ?>
											<?php foreach ($arr_appointment->result() as $key) { ?>
												<tr>
													<td style="text-align: center;"><?= $key->patient_name; ?></td>
													<td style="text-align: center;"><?= $key->registration_date; ?></td>
													<td style="text-align: center;"><?= $key->appointment_date; ?></td>
													<td style="text-align: center;"><?= $key->appointment_time; ?></td>
												</tr>
											<?php } ?>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<script>
	$(function() {
		$('.tooltip').tooltip();
		$('.tooltip-left').tooltip({
			placement: 'left'
		});
		$('.tooltip-right').tooltip({
			placement: 'right'
		});
		$('.tooltip-top').tooltip({
			placement: 'top'
		});
		$('.tooltip-bottom').tooltip({
			placement: 'bottom'
		});
	});
</script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<link href="<?php echo base_url(); ?>design/vendors/datepicker.css" rel="stylesheet" media="screen">
<link href="<?php echo base_url(); ?>design/vendors/uniform.default.css" rel="stylesheet" media="screen">
<link href="<?php echo base_url(); ?>design/vendors/chosen.min.css" rel="stylesheet" media="screen">
<link href="<?php echo base_url(); ?>design/vendors/wysiwyg/bootstrap-wysihtml5.css" rel="stylesheet" media="screen">
<script src="<?php echo base_url(); ?>design/vendors/jquery-1.9.1.js"></script>
<script src="<?php echo base_url(); ?>design/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>design/vendors/jquery.uniform.min.js"></script>
<script src="<?php echo base_url(); ?>design/vendors/chosen.jquery.min.js"></script>
<script src="<?php echo base_url(); ?>design/vendors/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>design/vendors/wysiwyg/wysihtml5.js"></script>
<script src="<?php echo base_url(); ?>design/vendors/wysiwyg/bootstrap-wysihtml5.js"></script>
<script src="<?php echo base_url(); ?>design/vendors/wizard/jquery.bootstrap.wizard.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>design/vendors/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>design/assets/form-validation.js"></script>
<script src="<?php echo base_url(); ?>design/assets/scripts.js"></script>