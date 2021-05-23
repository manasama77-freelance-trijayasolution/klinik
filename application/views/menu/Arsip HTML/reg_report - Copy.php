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
	<script>
	  function undisableTxt() {
			document.getElementById("id_pat").disabled = false;
			document.getElementById("reg_date").disabled = false;
			document.getElementById("reference").disabled = false;
			document.getElementById("notes").disabled = false;
			document.getElementById("pat_sign").disabled = false;
			document.getElementById("reg_type").disabled = false;
			document.getElementById("myText05").disabled = false;
			document.getElementById("myText06").disabled = false;
			document.getElementById("myText07").disabled = false;
			document.getElementById("myText08").disabled = false;
			document.getElementById("myText09").disabled = false;
			document.getElementById("myText10").disabled = false;
			document.getElementById("myText11").disabled = false;
			document.getElementById("myText12").disabled = false;
			document.getElementById("1").disabled = false;
			document.getElementById("package").disabled = false;
	  }
	  function undisablenonepackage() {
			document.getElementById("nonepackage").disabled = false;
	  }
	  function undisablepackage() {
			document.getElementById("package").disabled = false;
	  }
	  
	  function goBack() {
	  	window.history.back();
	  }
	  
	</script>
<script type="text/javascript">
	function DisableKey(e,type) {    var desimal = e.charCode? e.charCode : e.keyCode;     if(type == 'alphabet'){    if((desimal==34 || desimal==8 || desimal==9 || desimal==32) || (desimal==45 || desimal==46 || desimal==47) ){ 
    return true;    }else{    if ((desimal<65||desimal>90) && (desimal<97||desimal>122)) { //jika bukan huruf
    return false;     }    }                                        
    }else{          if((desimal==45 || desimal==46) || (desimal==8 || desimal==9)){ // jika menekan tombol Backspace, Tab dan titik diperbolehkan
    return true;    }else{    if (desimal<48 || desimal>57) { //jika bukan angka
    return false; //matikan tombol
    }
    }
    }
   }
</script>
	<?php
  include './design/koneksi/file.php';
	$query 		="SELECT cast(right(id_reg,4) as decimal) id,cast(left(id_reg,3) as decimal) dt FROM trx_registration ORDER BY id_pat DESC LIMIT 1";  
    if($result 	=mysqli_query($con,$query))
    {
		$date	=date('ym');
        $row 	=mysqli_fetch_assoc($result);
        $count 	=$row['id'];
		$dater 	=$row['dt'];
		if ($dater == $date) {
			$count = $count+1; 	
		}else{
			$count = 1;
		}
        $code_no = str_pad($count, 4, "0", STR_PAD_LEFT);
    }
	$session_data 	 = $this->session->userdata('logged_in');
    $data['username'] 	 = $session_data['username'];
	$loc 	 = $session_data['location'];

	//var_dump($loc);
	?>
		
				<script type="text/javascript">
					function closeit(val){
					var mystr = val;
					var myarr = mystr.split(":");
					var myvar = myarr[1] + ":" + myarr[2];
					window.opener.document.forms['quesioner_mcu'].elements['pat_mrn'].value=myarr[0];
					window.opener.document.forms['quesioner_mcu'].elements['pat_name'].value=myarr[1];
					window.opener.document.forms['quesioner_mcu'].elements['pat_address'].value=myarr[2];
					window.opener.document.forms['quesioner_mcu'].elements['pat_telp'].value=myarr[3];
					window.opener.document.forms['quesioner_mcu'].elements['pat_dob'].value=myarr[4];
					window.opener.document.forms['quesioner_mcu'].elements['pat_status'].value=myarr[5];
					window.opener.document.forms['quesioner_mcu'].elements['id_reg'].value=myarr[6];
					window.close(this);
						}
				</script>
				<?php
				function findage_detail($dob){
						$interval = date_diff(date_create(), date_create($dob));
						echo $interval->format(" %Y Year, %M Months, %d Days");
					}
				?>
       <!-- wizard -->
                    <div class="row-fluid section">
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
                                        <ul>
                                            <li><a href="#tab1" data-toggle="tab">Step 1</a></li>
                                            <li><a href="#tab2" data-toggle="tab">Step 2</a></li>
                                            <li><a href="#tab3" data-toggle="tab">Step 3</a></li>
                                        </ul>
                                         </div>
                                          </div>
                                        </div>
                                        <div id="bar" class="progress progress-striped active">
                                          <div class="bar"></div>
                                        </div>
                                        <div class="tab-content">
                                            <div class="tab-pane" id="tab1">
                                               <form class="form-horizontal">
                                                  <fieldset>
                                                    <div class="control-group">
                                                      <label class="control-label" for="focusedInput">Name</label>
                                                      <div class="controls">
                                                        <input class="input-xlarge focused" id="focusedInput" type="text" value="">
                                                      </div>
                                                    </div>
                                                    <div class="control-group">
                                                      <label class="control-label" for="focusedInput">Email</label>
                                                      <div class="controls">
                                                        <input class="input-xlarge focused" id="focusedInput" type="text" value="">
                                                      </div>
                                                    </div>
                                                    <div class="control-group">
                                                      <label class="control-label" for="focusedInput">Phone</label>
                                                      <div class="controls">
                                                        <input class="input-xlarge focused" id="focusedInput" type="text" value="">
                                                      </div>
                                                    </div>
                                                  </fieldset>
                                                </form>
                                            </div>
                                            <div class="tab-pane" id="tab2">
                                                <form class="form-horizontal">
                                                  <fieldset>
                                                    <div class="control-group">
                                                      <label class="control-label" for="focusedInput">Address</label>
                                                      <div class="controls">
                                                        <input class="input-xlarge focused" id="focusedInput" type="text" value="">
                                                      </div>
                                                    </div>
                                                    <div class="control-group">
                                                      <label class="control-label" for="focusedInput">City</label>
                                                      <div class="controls">
                                                        <input class="input-xlarge focused" id="focusedInput" type="text" value="">
                                                      </div>
                                                    </div>
                                                    <div class="control-group">
                                                      <label class="control-label" for="focusedInput">State</label>
                                                      <div class="controls">
                                                        <input class="input-xlarge focused" id="focusedInput" type="text" value="">
                                                      </div>
                                                    </div>
                                                  </fieldset>
                                                </form>
                                            </div>
                                            <div class="tab-pane" id="tab3">
                                                <form class="form-horizontal">
                                                  <fieldset>
                                                    <div class="control-group">
                                                      <label class="control-label" for="focusedInput">Company Name</label>
                                                      <div class="controls">
                                                        <input class="input-xlarge focused" id="focusedInput" type="text" value="">
                                                      </div>
                                                    </div>
                                                    <div class="control-group">
                                                      <label class="control-label" for="focusedInput">Contact Name</label>
                                                      <div class="controls">
                                                        <input class="input-xlarge focused" id="focusedInput" type="text" value="">
                                                      </div>
                                                    </div>
                                                    <div class="control-group">
                                                      <label class="control-label" for="focusedInput">Contact Phone</label>
                                                      <div class="controls">
                                                        <input class="input-xlarge focused" id="focusedInput" type="text" value="">
                                                      </div>
                                                    </div>
                                                  </fieldset>
                                                </form>
                                            </div>
                                            <ul class="pager wizard">
                                                <li class="previous first" style="display:none;"><a href="javascript:void(0);">First</a></li>
                                                <li class="previous"><a href="javascript:void(0);">Previous</a></li>
                                                <li class="next last" style="display:none;"><a href="javascript:void(0);">Last</a></li>
                                                <li class="next"><a href="javascript:void(0);">Next</a></li>
                                                <li class="next finish" style="display:none;"><a href="javascript:;">Finish</a></li>
                                            </ul>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
