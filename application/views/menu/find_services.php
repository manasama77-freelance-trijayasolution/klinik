				<?php
			    $id 					 = $this->uri->segment(3);
				?>
				<script type="text/javascript">
					function closeit(val){
					var mystr = val;
					var myarr = mystr.split(":");
					var myvar = myarr[1] + ":" + myarr[2];
					window.opener.document.forms['quotation'].elements['service[<?=$id;?>]'].value=myarr[0];
					window.opener.document.forms['quotation'].elements['price[<?=$id;?>]'].value=myarr[1];
					window.opener.document.forms['quotation'].elements['id_service[<?=$id;?>]'].value=myarr[2];
					window.opener.document.forms['quotation'].elements['seq[<?=$id;?>]'].value=myarr[3];
					window.opener.document.forms['quotation'].elements['fulus[<?=$id;?>]'].value=myarr[4];
					window.opener.document.forms['quotation'].elements['orderid[<?=$id;?>]'].value=myarr[5];
					window.opener.document.forms['quotation'].elements['orderty[<?=$id;?>]'].value=myarr[6];
					window.opener.document.forms['quotation'].elements['group[<?=$id;?>]'].value=myarr[7];
					window.close(this);
					}
				</script>
                <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><b>Find Services</b></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">                                   
  									<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
										<thead>
											<tr>
												<th>No</th>
												<th>Services Name</th>
												<th>Type</th>
												<th>Price</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
										<?php
										$i=1;
										foreach($find->result() as $row){
										?>
											<tr class="odd gradeX">
												<td><?=$i++;?></td>
												<td><?php echo $row->serv_name;?> <?php if($row->type_lab==1){ ?><readonly data-html="true" button class="btn-mini tooltip-top" data-original-title="<?=str_replace(",",",",$row->detail);?>"><i class="icon-question-sign"></i></button> 
												<?php } ?>
												</td>
												<td>[<?php echo $row->price_type;?>]</td>
												<td><div style="float:left;"><?php echo $row->currency;?></div><div  style="float:right;"><?php echo number_format($row->price,2);?></div></td>
												<td><a href="" onclick="closeit('<?=$row->serv_name;?>:<?=number_format($row->price,2);?>:<?=$row->id_service;?>:<?=$row->id_service;?>:<?=$row->price;?>:<?=$row->order_id;?>:<?=$row->order_type;?>:<?=$row->group_name;?>:<?=str_replace(",",", ",$row->detail);?>');"><button class="btn btn-success btn-mini"><i class="icon-tags"></i></button></a></td>
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
		<script>
        $(function() {
            $('.tooltip').tooltip();	
			$('.tooltip-left').tooltip({ placement: 'left' });	
			$('.tooltip-right').tooltip({ placement: 'right' });	
			$('.tooltip-top').tooltip({ placement: 'top' });	
			$('.tooltip-bottom').tooltip({ placement: 'bottom' });

			$('.popover-left').popover({placement: 'left', trigger: 'hover'});
			$('.popover-right').popover({placement: 'right', trigger: 'hover'});
			$('.popover-top').popover({placement: 'top', trigger: 'hover'});
			$('.popover-bottom').popover({placement: 'bottom', trigger: 'hover'});

			$('.notification').click(function() {
				var $id = $(this).attr('id');
				switch($id) {
					case 'notification-sticky':
						$.jGrowl("Stick this!", { sticky: true });
					break;

					case 'notification-header':
						$.jGrowl("A message with a header", { header: 'Important' });
					break;

					default:
						$.jGrowl("Hello world!");
					break;
				}
			});
        });
        </script>					
        <script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>
		<link href="<?php echo base_url();?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
        <script src="<?php echo base_url();?>design/assets/scripts.js"></script>
        <script src="<?php echo base_url();?>design/assets/DT_bootstrap.js"></script>