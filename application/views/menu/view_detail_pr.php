<!-- Javascript goes in the document HEAD -->
<script type="text/javascript">

function altRows2(id){
	if(document.getElementsByTagName){  
		
		var table = document.getElementById(id);  
		var rows = table.getElementsByTagName("tr"); 
		 
		for(i = 0; i < rows.length; i++){          
			if(i % 2 == 0){
				rows[i].className = "evenrowcolor2";
			}else{
				rows[i].className = "oddrowcolor2";
			}      
		}
	}
}
window.onload=function(){
	altRows3('alternatecolor3');
}
window.onload=function(){
	altRows2('alternatecolor2');
}
</script>

<!-- CSS goes in the document HEAD or added to your external stylesheet -->
<style type="text/css">
table.altrowstable3 {
	font-family: verdana,arial,sans-serif;
	font-size:11px;
	color:#333333;
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
.oddrowcolor3{
	background-color:#d4e3e5;
}
.evenrowcolor3{
	background-color:#c3dde0;
}
.pagebreak { page-break-before: always; }
.oddrowcolor2{
	background-color:#d4e3e5;
}
.evenrowcolor2{
	background-color:#c3dde0;
}
table.altrowstable2 {
	font-family: verdana,arial,sans-serif;
	font-size:11px;
	color:#333333;
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
  src: url('<?php echo base_url();?>design/font/IDAutomationHC39M.ttf');
}
</style>
	<head>
        <title>KYOAI HEALTHCARE | PURCHASE REQUISITION</title>
	</head>
	<body>
		
		<button onclick="window.open('', '_self', ''); window.close();" class="btn btn-danger btn-large"><i class="icon-off"></i> Close</button>

				<p align="center"><b><u>PURCHASE REQUISITION</u></b>
				<br><br><br>
				<!-- <b>Branch : </b></p> -->
				
				<?php
				foreach($data->result() as $row){
					$pr_id = $row->id_pr_no;
					$pr_no = $row->pr_no;
				?>
				<table class="altrowstable3" id="alternatecolor3" width="100%">
					<tr>
						<td valign="top">No</td>
						<td valign="top"><?php echo $row->pr_no;?></td>
						
					</tr>
					<tr>
						<td valign="top">Date</td>
						<td align="top"><?php echo date("d.m.Y",strtotime($row->pr_date));?></td>
						
					</tr>
					<tr>
						<td valign="top">Department</td>
						<td valign="top"><?php echo $row->nama_dep;?></td>
						
					</tr>
				</table>
				<?php
				}
				?>
				<hr>
				</hr>

				<form action="<?php echo base_url();?>master/del_pr_item" method="post" id="purchase">

				<input type="hidden" name="pr_id" value="<?php echo $pr_id;?>">
				<input type="hidden" name="pr_no" value="<?php echo $pr_no;?>">
				<table class="altrowstable2" id="alternatecolor2" width="100%">
					<tr>
						<td align="center"></td>
						<td align="center"><b>Name of Product</b></td>
						<td align="center"><b>Qty</b></td>
						<td align="center"><b>Unit</b></td>
						<td align="center"><b>Delivery Date</b></td>
						<td align="center"><b>Notes</b></td>
					</tr>
					<?php
					foreach($main->result() as $row){
					?>
					<tr>
						<td valign="bottom">
							<input class="uniform_on" type="checkbox" id="cekid_pr_d[]" name="id_pr_d[]" value="<?php echo $row->id_pr_d;?>" >
						</td>
						<td valign="bottom">
						<?php 
							echo $lvalue[$row->is_status]."&nbsp";
							echo $row->item_product; 
						?> 
						</td>
						<td valign="bottom"><?php echo $row->item_qty;?></td>
						<td valign="bottom"><?php echo $row->item_uom;?></td>
						<td align="center"><?php echo date("d.m.Y",strtotime($row->delevery_date));?></td>
						<td valign="bottom"><?php echo $row->remarks;?></td>
					</tr>
					<?php
					}
					?>
				</table>
				</br></br>
				<h1>NOTES</h1>
				<textarea name="notes" id="ckeditor_full" ><?php echo $note;?></textarea>
				</br></br>
				
				<?php if ($level != 'user') { ?>
				<input class="btn btn-danger" type="submit" value="Delete" />			
				<?php } ?>
					
				</form>
				

				<span class="pagebreak"></span>
	</body>
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
</html>				