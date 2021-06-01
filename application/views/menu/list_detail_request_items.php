				<?php
				$id = $this->uri->segment(3);
				if ($id=="ok"){
				?>
          <div class="alert alert-success">
           <button class="close" data-dismiss="alert">&times;</button>
           <strong>Success!</strong> Delete Purchase Request
          </div>
				<?php
				}
				?>
				<script>
				function myFunction(id) {
					var r = confirm("Are You Sure ?");
					if (r == true) {
					x = window.location = "<?php echo base_url();?>inv/del_po/"+id+"";
					} else {
					x = "You pressed Cancel!";
					}
				}

        function pilih_item(){
          // var items  = document.getElementById("pilihan").value;
          var vv              = document.getElementById("vv");
          var pilihan         = document.getElementsByName('pilihan[]');
          var item_product    = document.getElementsByName('item_product[]');
          var item_uom        = document.getElementsByName('item_uom[]');
          var xx              = document.getElementsByName('id_item_request_d[]');
          for (var i = 0; i < pilihan.length; i++){
              if(pilihan[i].checked) {
                pilihan[i].disabled   = true;
                var items             = pilihan[i].value;
                var yy                = item_product[i].value;
                var zz                = item_uom[i].value;
                var pp                = xx[i].value;
              }
          }
          vv.src = "<?php echo base_url();?>inv/step_2/"+items+"/"+zz+"/"+pp+"";
        }

				function goBack(){
					window.history.back();
				}
				
				function myFunction_2(id) {
					var myWindow = window.open("<?php echo base_url();?>inv/transfer_items_warehouse/"+id+"", "", "width=1000px, height=400px");
				}

				function myFunction_3(id) {
					var myWindow = window.open("<?php echo base_url();?>inv/inv_item_warehouse/"+id+"", "", "width=1000px, height=400px");
				}
				
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
				});
				</script>
                     <div class="row-fluid">
                        <!-- block -->
                       <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Form Wizard</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                    <div id="rootwizard">
                                        <div class="navbar">
                                          <div class="navbar-inner">
                                            <div class="container">
                                        <ul class="nav nav-pills">
                                            <li class="active"><a href="#tab1" data-toggle="tab">Step 1</a></li>
                                            <li class=""><a href="#tab2" data-toggle="tab">Step 2</a></li>
                                            <li class=""><a href="#tab3" data-toggle="tab">Step 3</a></li>
                                        </ul>
                                         </div>
                                          </div>
                                        </div>
                                        <div id="bar" class="progress progress-striped active">
                                          <div class="bar" style="width: 66.6667%;"></div>
                                        </div>
                                        <div class="tab-content">

<div class="tab-pane active" id="tab1">
  <form class="form-horizontal" id="mainForm" name="mainForm">
  <fieldset>
                 
  <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example2">
      <thead>
          <tr>
              <th>No</th>
              <th>Name Item</th>
              <th>Qty</th>
              <th>Base Unit</th>
              <th>Action</th>
            </tr>
      </thead>
      <tbody>
          <?php
          $i        = 1;
          foreach($list->result() as $row){
            $checked  = "";
            if ($i == 1) {$checked  = "checked";}
          ?>
            <tr class="odd gradeX">
              <td>
                <?=$i++;?>
                <input type="hidden" name="id_item_request_d[]" id="id_item_request_d[]" value="<?php echo $row->id_item_request_d;?>" >
              </td>
              <td><input type="text" name="item_product[]" id="item_product[]" value="<?php echo $row->item_product;?>" readonly></td>   
              <td><input type="text" name="item_qty[]" id="item_qty[]" style="width: 30px; height: 30px;" value="<?php echo $row->item_qty;?>" readonly></td>   
              <td><input type="text" name="item_uom[]" id="item_uom[]" value="<?php echo $row->item_uom;?>" readonly></td>   
              <td><input type="radio" style="width: 30px; height: 30px;" id="pilihan[]" name="pilihan[]" <?php echo $checked?> value="<?php echo $row->item_product;?>"> </td> 
            </tr>
          <?php
          }
          ?>
      </tbody>
  </table>

    </fieldset>
  </form>
</div>

                    <div class="tab-pane" id="tab2">
                        <form class="form-horizontal">
                          <fieldset>
                              <iframe id="vv" style="width: 100%; height: 400px;"></iframe>
                          </fieldset>
                        </form>
                    </div>


<div class="tab-pane" id="tab3">
    <form class="form-horizontal">
      <fieldset>
        <iframe src="<?php echo base_url();?>inv/mst_item_price" style="width: 100%; height: 400px;"></iframe>
      </fieldset>
    </form>
</div>
                                            <ul class="pager wizard">
                                                <li class="previous first" style="display:none;"><a href="javascript:void(0);">First</a></li>
                                                <li class="previous"><a href="javascript:void(0);">Previous</a></li>
                                                <li class="next last" style="display: inline;"><a href="javascript:void(0);">Last</a></li>
                                                <li class="next" style="display: inline;"><a href="javascript:void(0);" onclick="pilih_item();"
                                                >Next</a></li>
                                                <li class="next finish" style="display: none;"><a href="javascript:;">Finish</a></li>
                                            </ul>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>



        <!--/.fluid-container-->
<link href="<?php echo base_url();?>design/vendors/datepicker.css" rel="stylesheet" media="screen">
<link href="<?php echo base_url();?>design/vendors/uniform.default.css" rel="stylesheet" media="screen">
<link href="<?php echo base_url();?>design/vendors/chosen.min.css" rel="stylesheet" media="screen">
<link href="<?php echo base_url();?>design/vendors/wysiwyg/bootstrap-wysihtml5.css" rel="stylesheet" media="screen">
<script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>
<script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>design/vendors/jquery.uniform.min.js"></script>
<script src="<?php echo base_url();?>design/vendors/chosen.jquery.min.js"></script>
<script src="<?php echo base_url();?>design/vendors/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url();?>design/vendors/wysiwyg/wysihtml5-0.3.0.js"></script>
<script src="<?php echo base_url();?>design/vendors/wysiwyg/bootstrap-wysihtml5.js"></script>
<script src="<?php echo base_url();?>design/vendors/wizard/jquery.bootstrap.wizard.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>design/vendors/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>design/assets/form-validation.js"></script>
<script src="<?php echo base_url();?>design/assets/scripts.js"></script>
<script src="<?php echo base_url();?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>
<link href="<?php echo base_url();?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
<script src="<?php echo base_url();?>design/assets/DT_bootstrap.js"></script>
<script src="<?php echo base_url();?>design/assets/form-validation.js"></script>    
<script src="assets/scripts.js"></script>

<script>
jQuery(document).ready(function() {   
   FormValidation.init();
});


      $(function() {
          $(".datepicker").datepicker();
          $(".uniform_on").uniform();
          $(".chzn-select").chosen();
          $('.textarea').wysihtml5();

          $('#rootwizard').bootstrapWizard({onTabShow: function(tab, navigation, index) {
              var $total = navigation.find('li').length;
              var $current = index+1;
              var $percent = ($current/$total) * 100;
              $('#rootwizard').find('.bar').css({width:$percent+'%'});
              // If it's the last tab then hide the last button and show the finish instead
              if($current >= $total) {
                  $('#rootwizard').find('.pager .next').hide();
                  $('#rootwizard').find('.pager .finish').show();
                  $('#rootwizard').find('.pager .finish').removeClass('disabled');
              } else {
                  $('#rootwizard').find('.pager .next').show();
                  $('#rootwizard').find('.pager .finish').hide();
              }
          }});
          $('#rootwizard .finish').click(function() {
              alert('Finished!, Starting over!');
              $('#rootwizard').find("a[href*='tab1']").trigger('click');
          });
      });
</script>