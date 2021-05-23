<!DOCTYPE html>
<html>
	<head>
		<script language="JavaScript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script language="JavaScript" src="//ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>
		<script language="JavaScript" src="scriptcam.js"></script>
		<?php
		$id = $_GET['id'];
		?>
		<script language="JavaScript"> 
			$(document).ready(function() {
				$("#webcam").scriptcam({
					showMicrophoneErrors:false,
					onError:onError,
					cornerRadius:20,
					cornerColor:'e3e5e2',
					onWebcamReady:onWebcamReady,
					uploadImage:'upload.gif',
					onPictureAsBase64:base64_tofield_and_image
				});
			});
			function base64_tofield() {
				$('#formfield').val($.scriptcam.getFrameAsBase64());
			};
			function base64_toimage() {
				$('#image').attr("src","data:image/jpg;base64,"+$.scriptcam.getFrameAsBase64());
			};
			function base64_tofield_and_image(b64) {
				$('#formfield').val(b64);
				$('#image').attr("src","data:image/png;base64,"+b64);
			};
			function changeCamera() {
				$.scriptcam.changeCamera($('#cameraNames').val());
			}
			function onError(errorId,errorMsg) {
				$( "#btn1" ).attr( "disabled", true );
				$( "#btn2" ).attr( "disabled", true );
				alert(errorMsg);
			}			
			function onWebcamReady(cameraNames,camera,microphoneNames,microphone,volume) {
				$.each(cameraNames, function(index, text) {
					$('#cameraNames').append( $('<option></option>').val(index).html(text) )
				}); 
				$('#cameraNames').val(camera);
			}
			$(document).ready(function(){
				$("button").click(function(){
					$.post("save_photo.php?id=<?=$id;?>&link="+atob($("textarea").val()),
					{
					jquerypost: $("textarea").val(),
					city: "Duckburg"
					},
					function(data,status){
						alert("Photo Saved \n" + status);
					});
				});
			});
		</script>
		
	</head>
	<body>
		<div style="width:330px;float:left;">
			<div id="webcam">
			</div>
			<div style="margin:5px;">
				<img src="webcamlogo.png" style="vertical-align:text-top"/>
				<select id="cameraNames" size="1" onChange="changeCamera()" style="width:245px;font-size:10px;height:25px;">
				</select>
			</div>
		</div>
		<div style="width:155px;float:left;">
		<!--
			<p><button class="btn btn-small" id="btn1" onclick="base64_tofield()">1. Press Here First</button></p>
			<p><button class="btn btn-small" id="btn2" onclick="base64_toimage()">2. Review Image</button></p>
		-->
		</div>
		<div style="width:250px;float:right;">
			<p><textarea style="display: none;" name="code" id="formfield" style="width:190px;height:70px;"></textarea></p>
			Review image
			<p><img id="image" style="width:200px;height:153px;"></img></p>
			<button onclick="base64_tofield(); base64_toimage();">Take a Photo !</button>
		</div>
	</body>
</html>
