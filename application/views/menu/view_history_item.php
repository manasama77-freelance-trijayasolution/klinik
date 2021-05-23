				<body onload="startTime()">
                <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><b>History Item</b></div>
                            <div class="muted pull-right" id="txt" style="font-weight: bold;"></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">                                   
  									<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
										<thead>
											<tr>
												<th>No</th>
												<th>PO Number</th>
												<th>Invoice Number</th>
												<th>Invoice Date</th>
												<th>Curr</th>
												<th>Price</th>
												<th>Discount %</th>
												<th>Discount Amount</th>
												<th>Qty</th>
												<th>tax</th>
												<th>Supplier</th>
											</tr>
										</thead>
										<tbody>
										<?php
										$i=1;
										foreach($data->result() as $row){
										?>
											<tr class="odd gradeX">
												<td><?=$i++;?></td>
												<td><?=$row->po_no;?></td>
												<td><?=$row->receive_no;?></td>
												<td><?php echo date("d.m.Y",strtotime($row->receive_date));?></td>
												<td>IDR</td>
												<td><?=$row->item_price;?></td>
												<td><?=$row->item_disc;?></td>
												<td><?=$row->item_amount;?></td>
												<td><?=$row->item_qty;?></td>
												<td><?=$row->ppn_amount;?></td>
												<td><?=$row->supp_name;?></td>
											</tr>
										</form>
										<?php
										}
										?>
										</tbody>
									</table>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>				
        <script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>
		<link href="<?php echo base_url();?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
        <script src="<?php echo base_url();?>design/assets/scripts.js"></script>
        <script src="<?php echo base_url();?>design/assets/DT_bootstrap.js"></script>