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
        <title>Laboratorium View from IP : <?=$_SERVER['REMOTE_ADDR'];?></title>
	</head>
				<p align="center"><b><u>LABORATORIUM RESULT</u></b></p>
				
				<?php
				function findage_detail($dob){
						$interval = date_diff(date_create(), date_create($dob));
						echo $interval->format("%Y Year, %M Months");
					}
				foreach($data->result() as $row){}
				?>
				<table class="altrowstable3" id="alternatecolor3" width="100%">
					<tr>
						<td valign="top">Name</td>
						<td valign="top"><?=$row->pat_name;?>, <?=$row->title_desc;?></td>
						<td valign="top">Date of Birth</td>
						<td valign="top"><?=$row->pat_dob;?> (<?=findage_detail($row->pat_dob);?>)</td>
					</tr>
					<tr>
						<td valign="top">ID Registration</td>
						<td valign="top"><?=$this->uri->segment(3);?></td>
						<td valign="top">Clinical Pathologist</td>
						<td valign="top"><b>Dr. Susana Somali SpPK</b></td>
					</tr>
					<tr>
						<td valign="top">Exam Type</td>
						<td valign="top">-</td>
						<td valign="top"></td>
						<td valign="top"></td>
					</tr>
				</table>
				</br>
				<table class="altrowstable2" id="alternatecolor2" width="100%">
					<tr>
						<td align="center"><b>Name of Examination</b></td>
						<td align="center"><b>Result</b></td>
						<td align="center"><b>Range of Normal</b></td>
						<td align="center"><b>Remarks</b></td>
					</tr>
					<?php
					$i=1; 
					$current_cat 	= null;
					$row_cnt 		= $detail->num_rows();
					?>
					<input type="hidden" name="rowC" value="<?=$row_cnt;?>">
					<?php
					foreach($detail->result() as $row){
					?>
					<tr>
						<td>
						<?php
						if ($row->group_name != $current_cat){
						$current_cat = $row->group_name;
						echo "<b><u>". $row->group_name . "</u></b></br>-". $row->lab_item_desc;
						}else{ echo "-".$row->lab_item_desc;}
						?>
						</td>
						<td valign="bottom"><?php echo $row->result_value;?><font color="red"><?php if ($row->is_normal == 1) { if($row->ref_no == "0 - 0"){echo " (+)";}else{echo "*";} } ?></font></td>
						<td valign="bottom">

						<?php
						if($row->ref_no == "0 - 0"){
						echo "Negative";
						}else{
						echo $row->ref_no;
						}
						?>
						</td>
						<td valign="bottom"><?php echo $row->remarks;?></td>
					</tr>
					<?php
					}
					?>
				</table>
				</br>
				