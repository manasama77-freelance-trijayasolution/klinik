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
	font-size:11px;
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
</style>

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
	<head>
        <title>Laboratorium View from IP : <?=$_SERVER['REMOTE_ADDR'];?></title>
	</head>
				<div style="float:left;"><img src="<?php echo base_url();?>design/images/logokyoai.png" height="60" width="120"></img></div>
				</br>
				<p align="center" style="top: 50px; float:center;"><b>LABORATORIUM RESULT</b></p>

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
						<td valign="top"><?=$row->pat_name;?>, <?=$row->title_desc;?></td>
						<td valign="top">Date of Birth</td>
						<td valign="top"><?=$row->pat_dob;?> (<?=findage_detail($row->pat_dob);?>)</td>
					</tr>
					<tr>
						<td valign="top">ID No.</td>
						<td valign="top"><?=$this->uri->segment(3);?></td>
						<td valign="top">Exam Date</td>
						<td valign="top"><b><font color="red"><?=$row->order_date;?></font></b></td>
					</tr>
					<tr>
						<td valign="top">Exam Type</td>
						<td valign="top">-</td>
						<td valign="top">Clinical Pathologist</td>
						<td valign="top">Dr.Susana Somali SpPK</td>
					</tr>
				</table>
				<?php
				}
				?>
				</br>
				<div class="block">
				<table class="altrowstable2" id="alternatecolor2" width="100%">
					<tr>
						<td align="center"><b>No.</b></td>
						<td align="center"><b>Name of Examination</b></td>
						<td align="center"><b>Result</b></td>
						<td align="center"><b>Range of Normal</b></td>
						<td align="center"><b>Remarks</b></td>
					</tr>
					<?php
					$i=1; 
					$current_cat = null;
					//Function Convertion Age to Months
					$birthday = new DateTime('1992-02-21');
					$diff = $birthday->diff(new DateTime());
					$months = $diff->format('%m') + 12 * $diff->format('%y');
					//echo $months;
					//End of Function
					
					$row_cnt = $detail->num_rows();
					?>
					<input type="hidden" name="rowC" value="<?=$row_cnt;?>">
					<?php
					$nxx = 1;
					foreach($detail->result() as $row){
					?>
					<tr>
						<td valign="top" align="center"><?=$nxx++;?></td>
						<td>
						<?php
						if ($row->group_name != $current_cat){
						$current_cat = $row->group_name;
						echo "<font size='1px'><b><u>". $row->group_name . "</u></b></font></br>";
						
						if($row->name_type !=""){ echo "".$row->name_type.""; }else{ echo "".$row->lab_item_abbr.""; }
						//$row->lab_item_abbr.
						
						}else{ if($row->name_type ==""){ echo "".$row->lab_item_abbr.""; }else{ echo "".$row->name_type.""; } }
						?>
						</td>
						<td valign="top" align="center"><?php echo $row->result_value;?><font color="red"><?php if ($row->is_normal == 1) { if($row->ref_no == "0 - 0"){echo " (+)";}else{echo "*";} } ?></font></td>
						<td valign="top"  align="center">

						<?php
						if($row->ref_no == "0 - 0"){
						echo $row->std_value;
						}else{
						echo $row->std_value;
						}
						?>
						</td>
						<td valign="top"><?php echo $row->remarks;?></td>
					</tr>
					<?php
					}
					?>
				</table>
				</div>
				</br>
				<table border=0 width="100%">
					<tr>
						<td><?php
				foreach($data->result() as $row){
				?>
				<p align="center"><img src="https://chart.googleapis.com/chart?chs=85x85&cht=qr&chl=<?=$row->id_reg;?>&choe=UTF-8" title="Kyoai Medical Services" /></p>
				<?php
				}
				?></td>
						<td valign="top" align="right">Jakarta,</td>
						<td width="20%" height="60"></td>
					</tr>
					<tr>
						<td></td>
						<td align="right">Doctor :</td>
						<td width="20%">_______________</td>
					</tr>
				</table>
				