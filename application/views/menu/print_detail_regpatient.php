<?php
	$id_reg              = $this->uri->segment(3);
	$session_data 	     = $this->session->userdata('logged_in');
    $data['username'] 	 = $session_data['username'];
	$loc 	             = $session_data['location'];
 
  foreach($get_branch->result() as $rows){
  $codebranch            = $rows->kode_company;
  }
?>
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
@font-face {
  font-family: IDAutomationHC39M;
  src: url('<?php echo base_url();?>design/font/IDAutomationHC39M.ttf');
}
p {
	font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
	font-size: 12px;
}

.thumbnail {
  position: relative;
  width: 95px;
  height: 115px;
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
        <title>Registration Patient Report : <?=$_SERVER['REMOTE_ADDR'];?></title>
	</head>
	<body onload="print()">
<?php
foreach($regdetpatient->result() as $rows){
	$tanggal = $rows->reg_date;
} 
?>	
				<table  border="0" id="alternatecolor3" width="100%">
					<tr>
						<td valign="top">						
						<img src="<?php echo base_url();?>design/images/logokyoai.png" height="55px" width="115px">
						</td>
						<td align="center" colspan="2"  width="70%">
							<h2><font size="4.5em" face="Helvetica"><b>Registration Patient</b></font></h2>
						</td>
						<td align="center"  width="30%">
						<!--
							<p align="center"><img src="https://chart.googleapis.com/chart?chs=100x100&cht=qr&chl=<?=$id_reg;?>&choe=UTF-8" title="Kyoai Medical Services" /></p>
						-->
						<font size="2.5em" face="IDAutomationHC39M">*<?=$id_reg;?>*</font>
						</td>
					</tr>
				</table>
				<table border='0'  width="100%">
					<tr>
						<td valign="top"><font size="2.5em" face="Helvetica">ID Registration</font></td>
						<td valign="top">:<font size="2.5em" face="Helvetica"><?php echo $codebranch; echo "-"; echo $rows->id_reg;?></font></td>
						<td colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td valign="top"><font size="2.5em" face="Helvetica">Date of Registration</font></td>
						<td valign="top">:<font size="2.5em" face="Helvetica"><?php echo date("d/m/Y",strtotime($tanggal));?></font></td>
					</tr>

					<tr>
						<td valign="top"><font size="2.5em" face="Helvetica">Patient Name</font></td>
						<td valign="top">:<font size="2.5em" face="Helvetica"><?php echo $rows->pat_name;?></font></td>
						<td colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td valign="top"><font size="2.5em" face="Helvetica">Patient MRN</font></td>
						<td valign="top">:<font size="2.5em" face="Helvetica"><?php echo $rows->pat_MRN;?></font></td>
					</tr>
				</table>
				<hr>
				</hr><br>
				<table border="0"  width="100%">
					<tr>
						<td align=""><font size="2.5em" face="Helvetica"><b>Charge Rule</b></font></td>
						<td align="">:<font size="2.5em" face="Helvetica"><?php echo $rows->rule;?></font></td>
						<td align="left" rowspan="7" colspan="6">
						<?php if($rows->photo !=""){ ?>
						<div class="thumbnail">
							<img src="data:image/jpg;base64,<?php echo $rows->photo;?>" alt="Image" />
						</div>
						<?php } ?>
						</td>
					</tr>
					<tr>
						<td align=""><font size="2.5em" face="Helvetica"><b>Client</b></font></td>
						<td align="">:<font size="2.5em" face="Helvetica"><?php echo $rows->client_name;?></font></td>
					</tr>
					<tr>
						<td align=""><font size="2.5em" face="Helvetica"><b>Insurance</b></font></td>				
						<td align="">:<font size="2.5em" face="Helvetica"><?php echo $rows->ins_name;?></font></td>
					</tr>
					<tr>
					<?php if($rows->id_package != 0){?>
					<?php }else{ ?>
						<td align=""><font size="2.5em" face="Helvetica"><b>Doctor</b></font></td>						
						<td align="">:<font size="2.5em" face="Helvetica"><?php echo $rows->drname;?></font></td>
					<?php } ?>
					</tr>
					<tr>
					<?php if($rows->id_package != 0){?>
						<td align=""><font size="2.5em" face="Helvetica"><b>Package</b></font></td>
						<td align="">:<font size="2.5em" face="Helvetica"><?php echo $rows->package_name;?></font></td>
					<?php }else{ ?>
						<td align=""><font size="2.5em" face="Helvetica"><b>Services</b></font></td>
						<td align="">:<font size="2.5em" face="Helvetica">Outpatient</font></td>
					<?php } ?>
					</tr>
					<tr>
						<td align=""><font size="2.5em" face="Helvetica"><b>Notes</b></font></td>				
						<td align="">:<font size="2.5em" face="Helvetica"><?php echo $rows->misc_notes;?></font></td>
					</tr>
				</table>
				</br>
				<hr>
				<table border=0 width="100%">
					<tr>
						<td valign="top" align="right">
						<font size="1em" face="courier">Print By: <?php  echo $data['username']; ?>
						<?php echo date("Y-m-d h:i:s")?></font></td>				
					</tr>
				</table>
			</body>