		<script>
		(function() {
		setInterval(function() {
			$.ajax({
				async: true,
				dataType: 'html',
				type: 'GET',
				url: './design/files/execute_query.php',
				success: function(data) {
					$('#test').html(data);
				}
			});
		}, 200); 
		}());
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
		<!--
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
		-->
		<script type="text/javascript"  src="<?php echo base_url();?>design/chat/chat.js"></script>
		<script type="text/javascript">
		<?php
		$data_user 	= ucwords($fullname);
		$split_user	= explode(" ",$data_user)
		?>
    	name = "<?=$split_user[0];?>";	
    	name = name.replace(/(<([^>]+)>)/ig,"");
        var chat =  new Chat();
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
                    if (length <= maxLength + 1){
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
			if ( $Hour >= 5 && $Hour <= 10 ) {
				$msg = "Good Morning";
			} else if ( $Hour >= 10 && $Hour <= 17 ) {
				$msg = "Good Afternoon";
			} else if ( $Hour >= 17 || $Hour <= 4 ) {
				$msg = "Good Evening, Enjoy your Night";
			}
			?>
			
			<div style="float: left; align: left;">
			<p class="hi">Hi <?=ucwords($fullname);?>, <?=$msg;?> <span class="hi"><i class="icon-leaf"></i></span></p> 
			</div>

			</br>
				<!-- 	
			<hr>
			<div style="float: left; align: left;">
			

			<b>Kurs Dollar</b> | <i>Source from Bank Indonesia</i>
			<table class="table table-striped table-bordered" style="font-size:12px;width:180px;">
				<thead>
					<tr>
						<th>No</th>
						<th>Date</th>
						<th>Value</th>
						<th>Type</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$i=1;
				foreach($data->result() as $row){
				?>
					<tr class="odd gradeX">
						<td><?=$i++;?></td>
	
						<td><?php echo date("d.m.Y",strtotime($row->create_date));?></td>
						<td><?php echo number_format($row->amount,2);?></td>
						<td><?php echo $row->code;?></td>
						
					</tr>
				</form>
				<?php
				}
				?>
				</tbody>
			</table>
			
			<?php if ($agama == 1) {?>
			<p style="text-align: left;">
			<!-- <iframe src="https://jam.jadwalsholat.org/digitalclock/" frameborder="0" width="175" height="60"></iframe><br> -->
			<iframe src="https://www.jadwalsholat.org/adzan/ajax.row.php?id=310" frameborder="0" width="220" height="220"></iframe><a href="https://www.jadwalsholat.org" target="_blank">
			<!-- <img class="aligncenter" style="text-align: left;" alt="jadwal-sholat" src="https://www.jadwalsholat.org/wp-content/uploads/2013/09/jadwal-sholat.png" width="81" height="18" /> -->
			</a></p>
			<?php } ?>
			

			</div>
			
			<div style="float: right; align: right;">
			<body onload="setInterval('chat.update()', 1)">		
				<link rel="stylesheet" href="<?php echo base_url();?>design/chat/style.css" type="text/css" />
				<b> <i>Messenger</i> </b>| <b>Online</b> <span class="tooltip-bottom" data-original-title="Say hi ! there are users on dashboard" style="font-weight: bold; color: red;" id="test"></span> Users.
				<div class="muted pull-right" id="txt" style="font-weight: bold;"></div>
				<div id="chat-wrap"><div id="chat-area"></div></div>
				<form id="send-message-area">
					<p><a tabindex="-1" href="#" onclick="open_chat()"><i class="icon-comment"></i></a></p>
					<textarea id="sendie" maxlength='100' placeholder="Type a Message"></textarea>
				</form>

				

			</body>
			</div> 
-->
		<script>
        $(function() {
            $('.tooltip').tooltip();	
			$('.tooltip-left').tooltip({ placement: 'left' });	
			$('.tooltip-right').tooltip({ placement: 'right' });	
			$('.tooltip-top').tooltip({ placement: 'top' });	
			$('.tooltip-bottom').tooltip({ placement: 'bottom' });
        });
        </script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <link href="<?php echo base_url();?>design/vendors/datepicker.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url();?>design/vendors/uniform.default.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url();?>design/vendors/chosen.min.css" rel="stylesheet" media="screen">		
        <link href="<?php echo base_url();?>design/vendors/wysiwyg/bootstrap-wysihtml5.css" rel="stylesheet" media="screen">		
        <script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>design/vendors/jquery.uniform.min.js"></script>
        <script src="<?php echo base_url();?>design/vendors/chosen.jquery.min.js"></script>
        <script src="<?php echo base_url();?>design/vendors/bootstrap-datepicker.js"></script>		
        <script src="<?php echo base_url();?>design/vendors/wysiwyg/wysihtml5.js"></script>
        <script src="<?php echo base_url();?>design/vendors/wysiwyg/bootstrap-wysihtml5.js"></script>
        <script src="<?php echo base_url();?>design/vendors/wizard/jquery.bootstrap.wizard.min.js"></script>	
		<script type="text/javascript" src="<?php echo base_url();?>design/vendors/jquery-validation/dist/jquery.validate.min.js"></script>
		<script src="<?php echo base_url();?>design/assets/form-validation.js"></script>	
		<script src="<?php echo base_url();?>design/assets/scripts.js"></script>