<?php
	$datereg1 = $this->uri->segment(3);
	$datereg2 = $this->uri->segment(4);
	$session_data 	 = $this->session->userdata('logged_in');
    $data['username'] 	 = $session_data['username'];
	$loc 	 = $session_data['location'];
 
  foreach($get_branch->result() as $rows){
  $codebranch = $rows->kode_company;
  $nama_branch = $rows->nama_branch;
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
<style>
td.container > div { width: 100%; height: 100%; overflow:hidden; }
td.container { height: 10px; }
</style>
 
	<head>
        <title>Registration Patient Report : <?=$_SERVER['REMOTE_ADDR'];?></title>
	</head>

 	<body>  

			<table  border="0"   width="100%">
					<tr>
						<td valign="top" width="32%">	<font face="arial" size="2"> Branch : <b><?php echo $nama_branch; ?></b></font>	</td>
						<td valign="top" colspan="2"  width="45%"> </td>
						<td valign="top" colspan="2"  width="10%"></td>
					</tr>
					<tr>
						<td valign="top" width="32%"></td>
						<td valign="top" colspan="2"  width="45%">
							<h3><b>List of Registration Report</b></h3>
						</td>
						
						<td valign="top"  width="10%">
							
						</td>
					</tr>
					<tr>
						<td colspan="6"><hr></td>
					</tr>

				</table>
				<table border='0'  width="100%">
				<?php
				$current=null;
				foreach($report_reg_as_date->result() as $rows){
				//echo $id_reg; 
				?>	
					<?php 
					if($rows->id_reg != $current){  
					$current = $rows->id_reg;
					?>
					<tr>
						<td  valign="top"><font face="verdana" size="1"> ID reg </font></td>
						<td  valign="top"><font face="verdana" size="1">  : <?php echo $rows->id_reg; ?></font></td>
						<td  align=""><font face="verdana" size="1"> Client </font></td>						
						<td  valign="top"><font face="verdana" size="1">: <?php echo $rows->client_name;?> </font></td>
					</tr>

					<tr>
						<td valign="top"><font face="verdana" size="1"> Date of reg</font></td>
						<td valign="top"><font face="verdana" size="1">: <?php echo $rows->reg_date; ?></font></td>
						<td valign="top"><font face="verdana" size="1">Patient Name</font></td>
						<td valign="top"><font face="verdana" size="1">: <?php echo $rows->pat_name;?></font></td>
					</tr>
			
					<?php } ?>
					<tr height="5" >
						<td><hr></td>
						<td class="verdana" ><font face="verdana" size="1"><?php echo $rows->serv_name; ?></font></td>
						<td class="verdana" > </td>
						<td class="verdana" > </td>
						<td class="verdana" > </td>
					</tr>

				<?php  }?>

				</table>
				</br>
				</br>
				</br>
				<hr>
				
				<table border=0 width="100%">
					<tr>
						<td valign="top" align="right">
						<font size="1" face="courier">Print By : <?php  echo $data['username']; ?>
						<?php echo date("Y-m-d N:i:s")?></font></td>
						
					</tr>
				</table>
						
			
			</body>
			