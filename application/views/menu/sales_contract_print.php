<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>e-Sales Contract | Kyoai Medical Services</title>
	
	<link rel='stylesheet' type='text/css' href='<?php echo base_url();?>design/salescontract/css/style.css' />
	<link rel='stylesheet' type='text/css' href='<?php echo base_url();?>design/salescontract/css/print.css' media="print" />
	<script type='text/javascript' src='<?php echo base_url();?>design/salescontract/js/jquery-1.3.2.min.js'></script>
	<script type='text/javascript' src='<?php echo base_url();?>design/salescontract/js/example.js'></script>

</head>
<style>

#printOnly {
   display : none;
}

#printOnly2{
   display : none;
}

@media print {
    footer {page-break-after: always;}
	#printOnly {
       display : block;
	   float   : right;
	}
	#printOnly2 {
       display : block;
	   float   : right;
	   page-break-after: always;
	}
}


</style>
<body>
<?php
foreach($header->result() as $rows){}
?>
	<div id="page-wrap">
		<div id="identity">
            <div id="logo">
              <div id="logoctr">
                <a href="javascript:;" id="change-logo" title="Change logo">Change Logo</a>
                <a href="javascript:;" id="save-logo" title="Save changes">Save</a>
                |
                <a href="javascript:;" id="delete-logo" title="Delete logo">Delete Logo</a>
                <a href="javascript:;" id="cancel-logo" title="Cancel changes">Cancel</a>
              </div>

              <div id="logohelp">
                <input id="imageloc" type="text" size="50" value="" /><br />
                (max width: 540px, max height: 100px)
              </div>
              <img id="image" style="width: 158px; height:80px;" src="<?php echo base_url();?>design/images/logokyoai.png" alt="logo" />			  
            </div>	
			<div style="float:right;"><img src="https://chart.googleapis.com/chart?chs=80x80&cht=qr&chl=TEST&choe=UTF-8" title="Kyoai Medical Services" /></div>
		</div>

		<div style="clear:both"></div>		
		<textarea style="width:200px;	 float:left;"><?=$rows->dates_loc?></textarea>
		<textarea style="width:200px; float:right; text-align:right;"><?=$rows->qout_id?></textarea>
		
		<div style="clear:both"></div>
				To :
		<div style="clear:both"></div>
				<textarea style="width:200px; float:left;"><?=$rows->client_name?></textarea>
		<div style="clear:both"></div>
				Attn :
		<div style="clear:both"></div>
				<textarea style="width:200px; float:left;"><?=$rows->attn_name?></textarea>
		
		<div style="clear:both"></div>
		<div>
		  <?=$rows->message?>
		</div>
		<div style="clear:both"></div>
	
		<div id="printOnly">
		<table border="1" width="8%" style="position: absolute;bottom:0px; right:12px;">
		<tr>
			<td height="20"></td>
			<td height="20"></td>
		</tr>
		</table>
		</div>
	</div>
	<footer></footer>
	<div id="page-wrap">
	<div id="identity">
           <div id="logo">
             <div id="logoctr">
               <a href="javascript:;" id="change-logo" title="Change logo">Change Logo</a>
               <a href="javascript:;" id="save-logo" title="Save changes">Save</a>
               |
               <a href="javascript:;" id="delete-logo" title="Delete logo">Delete Logo</a>
               <a href="javascript:;" id="cancel-logo" title="Cancel changes">Cancel</a>
             </div>

             <div id="logohelp">
               <input id="imageloc" type="text" size="50" value="" /><br />
               (max width: 540px, max height: 100px)
             </div>
             <img id="image" style="width: 158px; height:80px;" src="<?php echo base_url();?>design/images/logokyoai.png" alt="logo" />
           </div>		
		   <div style="float:right;"><img src="https://chart.googleapis.com/chart?chs=80x80&cht=qr&chl=TEST&choe=UTF-8" title="Kyoai Medical Services" /></div>
	</div>
	
	<?php
	include     './design/koneksi/file.php';
	$id      	=$this->uri->segment(3);
	$query 		="SELECT id_sc id FROM mkt_sales_contract where id_quot='$id' ";  
    if($result 	=mysqli_query($con, $query))
    {
		$date	=date('ymd');
        $row 	=mysqli_fetch_assoc($result);
        $count 	=$row['id'];
		
		if ($count != ""){
			$count = $count; 	
		}else{
			$count = 1;
		}
		$code_no = str_pad($count, 3, "0", STR_PAD_LEFT);
    }

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
	<textarea id="header">SALES CONTRACT</textarea>
			<div id="customer">
            <table id="meta" border="1">
                <tr>
                    <td class="meta-head">Company Name</td>
                    <td class="meta-head"><textarea><?=$rows->client_name?></textarea></td>
					<td class="meta-head">Date</td>
					<td class="meta-head"><textarea><?=date('d M Y');?></textarea></td>
                </tr>
                <tr>
				
                    <td rowspan="2" class="meta-head" style="vertical-align:top;">Contact Person</td>
                    <td class="meta-head"><textarea></textarea></td>
					<td class="meta-head">Contract No</td>
					<td class="meta-head"><textarea><?=$code_no;?>/SC/<?=romanic_number(date("m",strtotime($rows->created_date)));?>/<?=date("Y",strtotime($rows->created_date));?></textarea></td>
                </tr>
				 <tr>

                    <td class="meta-head"><textarea></textarea></td>
					<td class="meta-head">Company Address</td>
					<td class="meta-head"><textarea><?=$rows->client_address1?></textarea></td>
                </tr>
            </table>
		</div>
		</br>
		<div style="clear:both"></div>
		</br>
	<b><u>Items</u></b> :
		 <table id="meta" border="1">
                <tr>
                    <td class="meta-head">Name</td>
                    <td class="meta-head"><textarea><?=$rows->quot_name?></textarea></td>
					<td class="meta-head">Price</td>
					<td class="meta-head"><textarea><?=number_format($rows->grand_price)?></textarea></td>
                </tr>
          </table>
	</br>
		<div style="clear:both"></div>
		</br>
	<b><u>Terms and Conditions</u></b> :
		 <table id="meta" border="1">
                <tr>
                    <td class="meta-head">Payment Terms</td>
                    <td class="meta-head"><textarea></textarea></td>
                </tr>
				<tr>
                    <td class="meta-head">Remarks</td>
                    <td class="meta-head"><textarea></textarea></td>
                </tr>
            </table>
	<div style="clear:both"></div>
	<div id="terms">
		  <textarea style="text-align: justify;">1. The price is including snack.&#13;2. The price above is valid for 30 days after quotation date.&#13;3. To confirm for the requirements for the services stated in this quotation, please return the confirmation of the signed quotation.&#13;&#10;4. Result will be made in Bahasa Indonesia, result will be delivery for 7 (seven) of working days.&#13;&#10;5. Complimentary services : Executive Summary, Result Recapitulation (hard & soft copy), Management Presentation and One on One consultation (for Employee) will be given after MCU result completed.&#13;&#10;6. For on site medical check up minimum requirement is 60 participant.&#13;&#10;7. Payment should be made within 30 days after KYOAI valid invoice has been sent, 
		  Payment can be transfer to : 
		  BCA		: 459-300-2686
		  Branch		: Wisma Indocement
		  Name Acc	: Klinik drg. Magista Lutfia
		  </textarea>
	</div>
	<div style="clear:both"></div>
	<textarea style="height:20px; width:100%;"></textarea>
		 <table id="meta" border="1">
                <tr>
                    <td class="meta-head">SALES</td>
                    <td class="meta-head"><textarea><?=$rows->fullname?></textarea></td>
					<td class="meta-head">CLIENT</td>
					<td class="meta-head"><textarea></textarea></td>
                </tr>
				<tr>
                    <td colspan="2" style="height:80px; text-align: left; vertical-align: bottom;">(SIGN & STAMP)</td>
					<td colspan="2" style="height:80px; text-align: left; vertical-align: bottom;">(SIGN & STAMP)</td>
                </tr>
				<tr>
                    <td class="meta-head" colspan="4" style="text-align: center;">MANAGEMENT</td>
                </tr>
				<tr>
                    <td colspan="4" style="height:80px; text-align: center; vertical-align: bottom;">(SIGN & STAMP)</td>
                </tr>
         </table>
		
		<div style="clear:both"></div>
		<div id="printOnly2">
		<table border="1" width="8%" style="position: absolute;bottom:-1160px; right:12px; ">
		<tr>
			<td height="20"></td>
			<td height="20"></td>
		</tr>
		</table>
		</div>
		
	</div>
<footer></footer>
</body>
</html>