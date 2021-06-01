		<script>
		$(function() {
		$(".datepicker").datepicker();
		});
		
		function undisableTxt(){ 
		document.getElementById("View").disabled        = false;
		document.getElementById("Print").disabled       = false;
		document.getElementById("datepicker").disabled  = false;
		document.getElementById("datepicker1").disabled = false;
		document.getElementById("nama").disabled = false;
		document.getElementById("divisi").disabled = false;
		}

		function popup(b_id){
			var myWindow = window.open("<?php echo base_url();?>registration/reg_update/"+b_id, "", "width=1200px, height=500px, top=70, left=80");
		}

		function Print_invoice(id_bh,id_billing,nama,divisi) {
					var myWindow = window.open("<?php echo base_url();?>cashier/print_invoice/"+id_bh+"/"+id_billing+"/"+nama+"/"+divisi+"", "", "width=800px, height=400px");
		}

		function Print_OR(id_bh,id_billing,nama,divisi) {
					var myWindow = window.open("<?php echo base_url();?>cashier/print_or/"+id_bh+"/"+id_billing+"/"+nama+"/"+divisi+"", "", "width=800px, height=400px");
		}
		
		function Print_Receipt(id_bh,id_billing,nama,divisi) {
					var myWindow = window.open("<?php echo base_url();?>cashier/print_receipt/"+id_bh+"/"+id_billing+"/"+nama+"/"+divisi+"", "", "width=800px, height=400px");
		}
  		
  		function Pay_invoice(id) {
			var r = confirm("Are You Sure ?");
			if (r == true) {
				x = window.location = "<?php echo base_url();?>cashier/pay_invoice/"+id+"";
			} else {
				x = "You pressed Cancel!";
			}
		}
		
		</script>
        <link href="<?php echo base_url();?>design/vendors/datepicker.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url();?>design/vendors/uniform.default.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url();?>design/vendors/chosen.min.css" rel="stylesheet" media="screen">
		
        <script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>design/vendors/jquery.uniform.min.js"></script>
        <script src="<?php echo base_url();?>design/vendors/chosen.jquery.min.js"></script>
        <script src="<?php echo base_url();?>design/vendors/bootstrap-datepicker.js"></script>
		
        <script src="<?php echo base_url();?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>
		<link href="<?php echo base_url();?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
        <script src="<?php echo base_url();?>design/assets/DT_bootstrap.js"></script>

        <script src="<?php echo base_url();?>design/vendors/wizard/jquery.bootstrap.wizard.min.js"></script>	
		<script src="<?php echo base_url();?>design/assets/scripts.js"></script>
			<div  id="content">										
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
			<div class="navbar navbar-inner block-header">
			<div class="muted pull-left"><b>Invoice & Official Receipt</b></div>
			</div>
			<div class="form-actions">
			<button onclick="undisableTxt()" class="btn btn-primary btn-large"><b>Start</b></button> 										 
			</div>
			<form class="form-horizontal" action="<?php echo base_url();?>cashier/invoice_list" method="post" name="mst_service">
				<hr>
				<div class="control-group">
				  <div class="controls">
				  <p><b>Input Name & Department</b></p>
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" for="focusedInput">Name</label>
				  <div class="controls">
				   <input  class="input-medium" name="bf" id="bf" type="hidden" value="1">
				   <input  class="input-large" name="nama" id="nama" type="text" autocomplete="off" value="<?=$nama;?>" disabled>
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" for="focusedInput">Department</label>
				  <div class="controls">
				   <input class="input-large" name="divisi" id="divisi" type="text" autocomplete="off" value="<?=$divisi;?>" disabled>
				  </div>
				</div>
				</br>
				<hr>
				<div class="control-group">
				  <label class="control-label" for="focusedInput">Date of Reg</label>
				  <div class="controls">
				   <input  class="input-medium datepicker"  disabled name="datereg1" type="text" id="datepicker" autocomplete="off" value="<?=$tglawal;?>">
				   to		 
				   <input  class="input-medium datepicker"  disabled name="datereg2" type="text" id="datepicker1" autocomplete="off" value="<?=$tglakhir;?>">
				  </div>
				</div>
				<div class="form-actions">
				<input type="submit" name="act"  disabled id="View" class="btn btn-success" value="View">
				<input type="submit" name="act" disabled id="Print" class="btn btn-success" value="Print All" formaction="<?php echo base_url();?>cashier/print_invoice_all">
				</div>
				</form>
               <div class="row-fluid">
                           <div class="navbar navbar-inner block-header">
                               <div class="muted pull-left"><b>List Invoice</b></div>
                           </div>
                           <div class="block-content collapse in">
                               <div class="span12">                                   
  								<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
									<thead>
										<tr>
											<th>No.</th>
											<th>Invoice Number</th>
											<th>OR Number</th>
											<th>ID Registration</th>
											<th>Patient Name</th>
											<th>Date</th>
											<th>Company Name</th>
											<th>Paid</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php 
									$no = 1;
									if ($jml == 1) {
										foreach ($list_invoice->result() as $row) {
											$invno 		= "";
											$orno 		= "";

											if ($row->id_invoice != "") {$invno = $row->inv_no."".str_pad($row->id_invoice, 4, "0", STR_PAD_LEFT);}
											if ($row->id_or != "") {$orno  	= $row->or_no."".str_pad($row->id_or, 4, "0", STR_PAD_LEFT);}
									?>
										<tr class="odd gradeX">
											<td><?php echo $no; ?></td>
											<td><?php echo $invno; ?></td>
											<td><?php echo $orno; ?></td>
											<td><?php echo $row->dodol; ?></td>
											<td><?php echo $row->pat_name; ?></td>
											<td><?=date("d.m.Y",strtotime($row->reg_date));?></td>
											<td><?php echo $row->client_name; ?></td>
											<td>
											<?php 
											// echo $row->id_or;
											if ($row->id_or != "") { 
											?>
												<button class="btn btn-mini" onclick="Print_OR(<?php echo $row->id_bh;?>,<?php echo $row->id_billing;?>,'<?=$nama;?>','<?=$divisi;?>')"> <i class="icon-print"></i> Paid</button></td>
											<?php }else{ ?>
												<button class="btn btn-danger btn-mini" onclick="Pay_invoice(<?php echo $row->id_bh;?>,<?php echo $row->id_billing;?>,'<?=$nama;?>','<?=$divisi;?>')"> <i class="icon-ok"></i> Paid</button><br>
											<?php } ?>
											</td>
											<td>
												<button class="btn btn-mini" onclick="Print_invoice(<?php echo $row->id_bh;?>,<?php echo $row->id_billing;?>,'<?=$nama;?>','<?=$divisi;?>')"> <i class="icon-print"></i> Invoice</button><br>
											<?php if ($row->id_or != "") { ?>
												<button class="btn btn-mini" onclick="Print_OR(<?php echo $row->id_bh;?>,<?php echo $row->id_billing;?>,'<?=$nama;?>','<?=$divisi;?>')"> <i class="icon-print"></i> OR</button><br>
												<button class="btn btn-mini" onclick="Print_Receipt(<?php echo $row->id_bh;?>,<?php echo $row->id_billing;?>,'<?=$nama;?>','<?=$divisi;?>')"> <i class="icon-print"></i> Receipt</button><br>
											<?php } ?>
											</td>
										</tr>
									<?php $no = $no + 1; } } ?>
									</tbody>
								</table>
                               </div>
                           </div>
                   </div>				 
                   </div>				 
                   </div>				 
            </div>				 
