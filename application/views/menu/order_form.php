	<?php
		$id						= $this->uri->segment(3);
		$session_data 			= $this->session->userdata('logged_in');
		$userlvl				= $session_data['userlevel'];
		if($id=="ok"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Added Order Form, Check your files in <b>My Quotation</b> Menu.
		</div>
	<?php
		}elseif($id=="change"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Update Data Master Services
	    </div>
	<?php
		}elseif($id=="del"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Delete Master Services
		</div>
	<?php
		}

	?>	
	<script>
	  function undisableTxt(){
		document.getElementById("locked").style.display = "";
		document.getElementById("lock").style.display = "none";
	  }
	  
	  function goBack(){
	  	window.history.back();
	  }
	  
	  function popup(){
        window.open("<?php echo base_url();?>marketing/find_quotation/","Popup","height=550, width=980, top=70, left=180 ");
      }
	</script>
	<style>
.tg-list {
  text-align: center;
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
  -webkit-align-items: center;
      -ms-flex-align: center;
          align-items: center;
}

.tg-list-item {
  margin: 0 2em;
}

.tgl {
  display: none;
}
.tgl, .tgl:after, .tgl:before, .tgl *, .tgl *:after, .tgl *:before, .tgl + .tgl-btn {
  box-sizing: border-box;
}
.tgl::-moz-selection, .tgl:after::-moz-selection, .tgl:before::-moz-selection, .tgl *::-moz-selection, .tgl *:after::-moz-selection, .tgl *:before::-moz-selection, .tgl + .tgl-btn::-moz-selection {
  background: none;
}
.tgl::selection, .tgl:after::selection, .tgl:before::selection, .tgl *::selection, .tgl *:after::selection, .tgl *:before::selection, .tgl + .tgl-btn::selection {
  background: none;
}
.tgl + .tgl-btn {
  outline: 0;
  display: block;
  width: 4em;
  height: 2em;
  position: relative;
  cursor: pointer;
  -webkit-user-select: none;
     -moz-user-select: none;
      -ms-user-select: none;
          user-select: none;
}
.tgl + .tgl-btn:after, .tgl + .tgl-btn:before {
  position: relative;
  display: block;
  content: "";
  width: 50%;
  height: 100%;
}
.tgl + .tgl-btn:after {
  left: 0;
}
.tgl + .tgl-btn:before {
  display: none;
}
.tgl:checked + .tgl-btn:after {
  left: 50%;
}

.tgl-light + .tgl-btn {
  background: #f0f0f0;
  border-radius: 2em;
  padding: 2px;
  -webkit-transition: all .4s ease;
  transition: all .4s ease;
}
.tgl-light + .tgl-btn:after {
  border-radius: 50%;
  background: #fff;
  -webkit-transition: all .2s ease;
  transition: all .2s ease;
}
.tgl-light:checked + .tgl-btn {
  background: #9FD6AE;
}

.tgl-ios + .tgl-btn {
  background: #fbfbfb;
  border-radius: 2em;
  padding: 2px;
  -webkit-transition: all .4s ease;
  transition: all .4s ease;
  border: 1px solid #e8eae9;
}
.tgl-ios + .tgl-btn:after {
  border-radius: 2em;
  background: #fbfbfb;
  -webkit-transition: left 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275), padding 0.3s ease, margin 0.3s ease;
  transition: left 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275), padding 0.3s ease, margin 0.3s ease;
  box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.1), 0 4px 0 rgba(0, 0, 0, 0.08);
}
.tgl-ios + .tgl-btn:hover:after {
  will-change: padding;
}
.tgl-ios + .tgl-btn:active {
  box-shadow: inset 0 0 0 2em #e8eae9;
}
.tgl-ios + .tgl-btn:active:after {
  padding-right: .8em;
}
.tgl-ios:checked + .tgl-btn {
  background: #86d993;
}
.tgl-ios:checked + .tgl-btn:active {
  box-shadow: none;
}
.tgl-ios:checked + .tgl-btn:active:after {
  margin-left: -.8em;
}

.tgl-skewed + .tgl-btn {
  overflow: hidden;
  -webkit-transform: skew(-10deg);
          transform: skew(-10deg);
  -webkit-backface-visibility: hidden;
          backface-visibility: hidden;
  -webkit-transition: all .2s ease;
  transition: all .2s ease;
  font-family: sans-serif;
  background: #888;
}
.tgl-skewed + .tgl-btn:after, .tgl-skewed + .tgl-btn:before {
  -webkit-transform: skew(10deg);
          transform: skew(10deg);
  display: inline-block;
  -webkit-transition: all .2s ease;
  transition: all .2s ease;
  width: 100%;
  text-align: center;
  position: absolute;
  line-height: 2em;
  font-weight: bold;
  color: #fff;
  text-shadow: 0 1px 0 rgba(0, 0, 0, 0.4);
}
.tgl-skewed + .tgl-btn:after {
  left: 100%;
  content: attr(data-tg-on);
}
.tgl-skewed + .tgl-btn:before {
  left: 0;
  content: attr(data-tg-off);
}
.tgl-skewed + .tgl-btn:active {
  background: #888;
}
.tgl-skewed + .tgl-btn:active:before {
  left: -10%;
}
.tgl-skewed:checked + .tgl-btn {
  background: #86d993;
}
.tgl-skewed:checked + .tgl-btn:before {
  left: -100%;
}
.tgl-skewed:checked + .tgl-btn:after {
  left: 0;
}
.tgl-skewed:checked + .tgl-btn:active:after {
  left: 10%;
}

.tgl-flat + .tgl-btn {
  padding: 2px;
  -webkit-transition: all .2s ease;
  transition: all .2s ease;
  background: #fff;
  border: 4px solid #f2f2f2;
  border-radius: 2em;
}
.tgl-flat + .tgl-btn:after {
  -webkit-transition: all .2s ease;
  transition: all .2s ease;
  background: #f2f2f2;
  content: "";
  border-radius: 1em;
}
.tgl-flat:checked + .tgl-btn {
  border: 4px solid #7FC6A6;
}
.tgl-flat:checked + .tgl-btn:after {
  left: 50%;
  background: #7FC6A6;
}

.tgl-flip + .tgl-btn {
  padding: 1px;
  -webkit-transition: all .2s ease;
  transition: all .2s ease;
  font-family: sans-serif;
  -webkit-perspective: 100px;
          perspective: 100px;
}
.tgl-flip + .tgl-btn:after, .tgl-flip + .tgl-btn:before {
  display: inline-block;
  -webkit-transition: all .4s ease;
  transition: all .4s ease;
  width: 105px;
  text-align: center;
  position: absolute;
  line-height: 2em;
  font-weight: bold;
  color: #fff;
  position: absolute;
  top: 0;
  left: 0;
  -webkit-backface-visibility: hidden;
          backface-visibility: hidden;
  border-radius: 4px;
}
.tgl-flip + .tgl-btn:after {
  content: attr(data-tg-on);
  background: #02C66F;
  -webkit-transform: rotateY(-180deg);
          transform: rotateY(-180deg);
}
.tgl-flip + .tgl-btn:before {
  background: #FF1959;
  content: attr(data-tg-off);
}
.tgl-flip + .tgl-btn:active:before {
  -webkit-transform: rotateY(-20deg);
          transform: rotateY(-20deg);
}
.tgl-flip:checked + .tgl-btn:before {
  -webkit-transform: rotateY(180deg);
          transform: rotateY(180deg);
}
.tgl-flip:checked + .tgl-btn:after {
  -webkit-transform: rotateY(0);
          transform: rotateY(0);
  left: 0;
  background: #0095FF;
}
.tgl-flip:checked + .tgl-btn:active:after {
  -webkit-transform: rotateY(20deg);
          transform: rotateY(20deg);
}
	</style>
		<script>
			function getComboA(sel) {
				var value = sel;  
				document.getElementById('a'+sel+'').readOnly = false;
				document.getElementById('total['+sel+']').readOnly = false;
				document.getElementById('pop'+sel+'').disabled = true;
						document.getElementById('fulus['+sel+']').value = 0;
						document.getElementById('total['+sel+']').value = 0;
						document.getElementById('id_service['+sel+']').value = 0;
						document.getElementById('a'+sel+'').value = "";
				$('#cbx_'+sel+'').click(function(){
					if (this.checked) {	
						document.getElementById('a'+sel+'').readOnly = false;
						document.getElementById('total['+sel+']').readOnly = false;
						document.getElementById('pop'+sel+'').disabled = true;
						document.getElementById('fulus['+sel+']').value = 0;
						document.getElementById('total['+sel+']').value = 0;
						document.getElementById('id_service['+sel+']').value = 0;
						document.getElementById('a'+sel+'').value = "";
					}else{
						document.getElementById('a'+sel+'').readOnly = true;
						document.getElementById('pop'+sel+'').disabled = false;
						document.getElementById('total['+sel+']').readOnly = true;
					}
				}) 
			}
		</script>
	<?php
	function romanic_number($integer, $upcase = true) 
	{ 
		$table = array('M'=>1000, 'CM'=>900, 'D'=>500, 'CD'=>400, 'C'=>100, 'XC'=>90, 'L'=>50, 'XL'=>40, 'X'=>10, 'IX'=>9, 'V'=>5, 'IV'=>4, 'I'=>1); 
		$return = ''; 
		while($integer > 0) 
		{ 
			foreach($table as $rom=>$arb) 
			{ 
				if($integer >= $arb) 
				{ 
					$integer -= $arb; 
					$return .= $rom; 
					break; 
				} 
			} 
		} 
		return $return; 
	} 
	?>
	<script src="<?php echo base_url();?>design/assets/acc.js"></script>
	<script language="javascript">
	function showDiv(elem, val){
	var spl = elem.split(":"),
	low 	= spl[0];
	//alert(low)
		if(low == 0 || low == 3){
			document.getElementById('cc'+val+'').style.display = "";
		}else{
			document.getElementById('cc'+val+'').style.display = "none";
		}
		
		if(low == 1){
			document.getElementById('aa'+val+'').style.display = "";
			document.getElementById('dd'+val+'').style.display = "";
		}else{
			document.getElementById('dd'+val+'').style.display = "none";
			document.getElementById('aa'+val+'').style.display = "none";
		}
		
		if(low == 2 || low == 6){
			document.getElementById('bb'+val+'').style.display = "";
		}else{
			document.getElementById('bb'+val+'').style.display = "none";
		}
		
		if(low == 4){
			document.getElementById('cby_'+val+'').style.display = "";
		}else{
			document.getElementById('cby_'+val+'').style.display = "none";
		}
	}
    </script>
	<script src="<?php echo base_url();?>design/assets/acc.js"></script>
	<script type="text/javascript">
	function setBlurFocus(id) {
		var user_input = accounting.formatMoney(document.getElementById('total['+id+']').value);
		document.getElementById('total['+id+']').value = user_input;
	}
	</script>
	<style>
			p.hi{
				color: black; 
				font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
				font-size: 16px;
				margin: 10px 0 0 10px;
				white-space: nowrap;
				overflow: hidden;
				width: 30em;
				animation: type 4s steps(60, end); 
			}
			p.hi:nth-child(2){
				animation: type2 8s steps(60, end);
			}	
			span.hi{
				animation: blink 1s infinite;
			}
			@keyframes type{ 
				from { width: 0; } 
			} 			
			@keyframes type2{
				0%{width: 0;}
				50%{width: 0;}
				100%{ width: 100; } 
			} 
			@keyframes blink{
				to{opacity: .0;}
			}
	</style>
				<body onload="startTime()">
                    <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><b>New Order Form</b></div>
							<div class="muted pull-right" id="txt" style="font-weight: bold;"></div>
                            </div>
							<div class="form-actions">									 
							<div class="btn-group">
							 <button data-toggle="dropdown" class="btn btn-info btn-large dropdown-toggle"><b>Menu</b> <span class="caret"></span></button>
							 <ul class="dropdown-menu">
								<li><a href="<?php echo base_url();?>marketing/list_quotation"><i class="icon-th-large"></i> My Quotation</a></li>
								<li><a href="<?php echo base_url();?>marketing/group_package"><i class="icon-th-large"></i> Master Group Package</a></li>
							 </ul>
							</div>
							</div>
      
                                      <fieldset>
										<form class="form-horizontal" action="<?php echo base_url();?>marketing/save_order_form" method="post" name="quotation">
										<!--<div id="" style="overflow-y: scroll; height:260px;">-->
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">No. Quotation</label>
                                          <div class="controls">
										  <input class="input-xlarge focused" name="no_quot" type="text" id="0" autocomplete="off" value="" required readonly> <button type="button" onclick="popup();" class="btn btn-success btn-mini"><i class="icon-search"></i> <b>Find</b></button>
										  <input type="hidden" name="idx">
										   <input type="hidden" name="idy">
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Package Name</label>
                                          <div class="controls">
										  <input class="input-xlarge focused" name="pack_name" type="text" id="1" autocomplete="off" value="" required readonly>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="select01">Company</label>
                                          <div class="controls">
											<input class="input-xlarge focused" name="kompeni" type="text" autocomplete="off" value="" required readonly>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Attn</label>
                                          <div class="controls">
                                            1. <input class="input-xlarge focused" name="pic_name" placeholder="PIC Name" type="text" autocomplete="off" value="" required> <input class="input-small focused" placeholder="Telephone" name="pic_telp" type="text" autocomplete="off" value="" required> <input placeholder="Mobile Phone" class="input-small focused" name="pic_hp" type="text" autocomplete="off" value="" required> <input placeholder="Email" class="input-medium focused" name="pic_email" type="text" autocomplete="off" value="" required></br></br>
											2. <input class="input-xlarge focused" name="pic_name_2"  placeholder="PIC Name" type="text" autocomplete="off" value="" required> <input class="input-small focused" name="pic_telp_2" placeholder="Telephone" type="text" autocomplete="off" value="" required> <input class="input-small focused" placeholder="Mobile Phone" name="pic_hp_2" type="text" autocomplete="off" value="" required> <input placeholder="Email" class="input-medium focused" name="pic_email_2" type="text" autocomplete="off" value="" required>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="select01">Quantity</label>
                                          <div class="controls">
											<textarea name="qty"></textarea>
                                          </div>
                                        </div>

										
										<div class="span12" id="content">
											<div class="row-fluid">
												<!-- block -->
												<div class="block">
													<div class="navbar navbar-inner block-header">
														<div class="muted pull-left"><b>Remarks - Operations</b></div>
													</div>
													<div class="block-content collapse in">
														<textarea name="r_o" id="ckeditor_full"></textarea>
													</div>
												</div>
												<!-- /block -->
											</div>
										</div>
										
										<div class="span12" id="content">
											<div class="row-fluid">
												<!-- block -->
												<div class="block">
													<div class="navbar navbar-inner block-header">
														<div class="muted pull-left"><b>Remarks - Finance</b></div>
													</div>
													<div class="block-content collapse in">
														<textarea name="r_f" id="ckeditor_full"></textarea>
													</div>
												</div>
												<!-- /block -->
											</div>
										</div>

										
										<div id="myAlert" class="modal hide">
											<div class="modal-header">
												<button data-dismiss="modal" class="close" type="button">&times;</button>
												<h5>Alert!</h5>
											</div>
											<div class="modal-body">
												<p>Are you sure ? [close] button to check again...</p>
											</div>
											<div class="modal-footer">
												<input type="submit" class="btn btn-success" id="save" value="Save">
												<a data-dismiss="modal" class="btn btn-warning" href="#">Close</a>
											</div>
										</div>
										
										<hr></hr>
										<div class="form-actions">
										<div style="float: left;">
										<a href="#myAlert" data-toggle="modal" class="btn btn-large btn-success"><b>Submit</b></a>
										</div>
										
										<div style="float:right;">
										<button class="btn btn-large btn-danger" type="reset"><b>Reset</b></button> 
										</div>
                                        </div>
									
										</form>                   						
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
		<script src="<?php echo base_url();?>design/vendors/ckeditor/ckeditor.js"></script>
		<script src="<?php echo base_url();?>design/vendors/ckeditor/adapters/jquery.js"></script>

		<script type="text/javascript" src="<?php echo base_url();?>design/vendors/tinymce/js/tinymce/tinymce.min.js"></script>

        <script src="<?php echo base_url();?>design/assets/scripts.js"></script>
        <script>
        $(function() {
            // Bootstrap
            $('#bootstrap-editor').wysihtml5();

            // Ckeditor standard
            $( 'textarea#ckeditor_standard' ).ckeditor({width:'98%', height: '150px', toolbar: [
				{ name: 'document', items: [ 'Source', '-', 'NewPage', 'Preview', '-', 'Templates' ] },	// Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
				[ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],			// Defines toolbar group without name.
				{ name: 'basicstyles', items: [ 'Bold', 'Italic' ] }
			]});
            $( 'textarea#ckeditor_full' ).ckeditor({width:'98%', height: '150px'});
        });

        // Tiny MCE
        tinymce.init({
		    selector: "#tinymce_basic",
		    plugins: [
		        "advlist autolink lists link image charmap print preview anchor",
		        "searchreplace visualblocks code fullscreen",
		        "insertdatetime media table contextmenu paste"
		    ],
		    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
		});

		// Tiny MCE
        tinymce.init({
		    selector: "#tinymce_full",
		    plugins: [
		        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
		        "searchreplace wordcount visualblocks visualchars code fullscreen",
		        "insertdatetime media nonbreaking save table contextmenu directionality",
		        "emoticons template paste textcolor"
		    ],
		    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
		    toolbar2: "print preview media | forecolor backcolor emoticons",
		    image_advtab: true,
		    templates: [
		        {title: 'Test template 1', content: 'Test 1'},
		        {title: 'Test template 2', content: 'Test 2'}
		    ]
		});

        </script>
</body>