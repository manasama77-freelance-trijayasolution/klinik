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
<style>
@media all
{
  .page-break  { display:none; }
}
@media print
{
  .page-break  { display:block; page-break-before:always; }
}
</style>
<!-- CSS goes in the document HEAD or added to your external stylesheet -->
<style type="text/css">
table.altrowstable3 {
	font-family: verdana,arial,sans-serif;
	font-size:12px;
	color:#333333;
	border-width: 1px;
	border-color: #a9c6c9;
	border-collapse: collapse;
}
table.altrowstable3 th {
	border-width: 1px;
	padding: 4px;
	border-style: solid;
	border-color: #a9c6c9;
}
table.altrowstable3 td {
	border-width: 1px;
	padding: 4px;
	border-style: solid;
	border-color: #a9c6c9;
}
.oddrowcolor3{
	background-color:#d4e3e5;
}
.evenrowcolor3{
	background-color:#c3dde0;
}
.oddrowcolor2{
	background-color:#d4e3e5;
}
.evenrowcolor2{
	background-color:#c3dde0;
}
table.altrowstable2 {
	font-family: verdana,arial,sans-serif;
	font-size:12px;
	color:#333333;
	border-width: 1px;
	border-color: #a9c6c9;
	border-collapse: collapse;
}
table.altrowstable2 th {
	border-width: 1px;
	padding: 4px;
	border-style: solid;
	border-color: #a9c6c9;
}
table.altrowstable2 td {
	border-width: 1px;
	padding: 4px;
	border-style: solid;
	border-color: #a9c6c9;
	table-layout:fixed;
	width:20px;
	overflow:hidden;
	word-wrap:break-word;
}
@font-face {
  font-family: IDAutomationHC39M;
  src: url('<?php echo base_url();?>design/font/IDAutomationHC39M.ttf');
}

.thumbnail {
  position: relative;
  width: 95px;
  height: 105px;
  border-radius: 8px;	
  overflow: hidden;
}
.thumbnail img {
  position: absolute;
  left: 50%;
  top: 50%;
  height: 100%;
  width: auto;
  -webkit-transform: translate(-50%,-50%);
      -ms-transform: translate(-50%,-50%);
          transform: translate(-50%,-50%);
}
.thumbnail img.portrait {
  width: 100%;
  height: auto;
}
</style>
	<head>
        <title>Marking Sheet Print from IP : <?=$_SERVER['REMOTE_ADDR'];?></title>
	</head>
<?php 
$id_reg = $this->uri->segment(3);
$photo  = "";
	foreach($gambar->result() as $rows){
			$photo=$rows->photo;
	} 
?>
<body >
<table width="100%" border="0">
	<tr>
		<td valign="top">
			<p align="center"><b>Klinik drg. Magista Lutfia</b></br>
			<font style="font-family: 'helvetica', helvetica, serif; font-size: 16px;">Marking sheet for medical check up</font></br></p>
			<p align="center"></p>
		</td>
		<td align="center">
		<!--
		<?php if($photo != ""){ ?>
			<div class="thumbnail">
			  <img src="data:image/jpg;base64,<?php echo $photo;?>" alt="Image" />
			</div>
		<?php } ?>
		-->
		</td>
	</tr>
</table>
				<?php
				function findage_detail($dob){
						$interval = date_diff(date_create(), date_create($dob));
						echo $interval->format("%Y Year, %M Months");
					}
				foreach($data->result() as $row){
				?>
				<table class="altrowstable3" id="alternatecolor3" width="100%">
					<tr>
						<td valign="top">Name</td>
						<td valign="top" colspan="2"><?php echo $row->pat_name;?>, <?php echo $row->title_desc;?></td>
						<td valign="top" align="right" colspan="3" rowspan="2"><font size="2.5em" face="IDAutomationHC39M">*<?=$id_reg;?>*</font></td>
					</tr>
					<tr>
						<td valign="top">Company</td>
						<td valign="top" colspan="2"><?php echo $row->client_name;?></td>
					</tr>
					<tr>
						<td valign="top">Sex</td>
						<td valign="top"><?php echo $row->gender;?></td>
						<td valign="top">Date of Birth</td>
						<td valign="top"><?php echo $row->pat_dob;?></td>
						<td valign="top">Age</td>
						<td valign="top"><?=findage_detail($row->pat_dob);?></td>
					</tr>
					<tr>
						<td valign="top">Type of M.C.U</td>
						<td valign="top" colspan="5"><?php echo $row->package_name;?></td>
					</tr>
					<tr>
						<td valign="top">Date of M.C.U</td>
						<td valign="top"><?php echo $row->reg_date;?></td>
						<td valign="top">Last M.C.U</td>
						<td valign="top" colspan="3"></td>
					</tr>
				</table>
				<?php
				}
				?>
				</br>
				<div class="block" style="width: 65%; float: left;">
				<table class="altrowstable2" id="alternatecolor2" width="100%" style="font-size:10px;">
				<thead>
					<tr>
						<th align="center" width="50px;"><b>Contents</b></th>
						<th align="center"><b>Result</b></th>
					</tr>
				</thead>
					<?php 
					$current_cat 	= null;
					$current_cat_2 	= null;
					$i = 1; $c = 1; $e = 1;
					$b = 1; $d = 1; 
					foreach($find_2->result() as $row_isi){
					?>
					<tr>
						<?php 
							if($row_isi->serv_name != $current_cat_2){
								$current_cat_2 = $row_isi->serv_name;
								$d=1;	
								echo  "<td valign='top'>".$e++.".".$d++." ".$row_isi->nama_value."</td>";
							}else{
								echo  "<td valign='top'>".$e++.".".$d++." ".$row_isi->nama_value."</td>";
							}
							
						?>
						<td valign="bottom">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
					</tr>
					<?php
					}
					?>
					<tr>
						<td valign="top" height="40px"><i>Remarks</i></td>
						<td valign="top" colspan="3"></td>
					</tr>
					<tr>
						<td valign="top	" colspan="3" height="40px"><i>(Notes)</i></br></td>
					</tr>
				</table>
				</div>
				<div class="block" style="width: 34%; float: right;">
				<table class="altrowstable3" id="alternatecolor3" width="100%">
					<tr>
						<td align="center"><b>No.</b></td>
						<td align="center"><b>Contents</b></td>
						<td align="center"><b>Check</b></td>
					</tr>
					<?php
					$vv=1;
					foreach($find_right->result() as $row){
					?>
					<tr>
							<td align="right" valign="top"><?=$vv++;?></td>
							<td valign="top"><?php echo $row->serv_name;?></td>
							<td></td>
					</tr>
					<?php
					}
					?>
					<tr>
						<td></td>
						<td>Last Checker</td>
						<td></td>
					</tr>	
				</table>
				</div>
</body>