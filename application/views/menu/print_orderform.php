<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>Order Form - Operations</title>
	
	<html xmlns="http://www.w3.org/1999/xhtml">
	<link rel='stylesheet' type='text/css' href='<?php echo base_url();?>design/orderform/css/style.css' />
	<link rel='stylesheet' type='text/css' href='<?php echo base_url();?>design/orderform/css/print.css' media="print" />
	<script type='text/javascript' src='<?php echo base_url();?>design/orderform/js/jquery-1.3.2.min.js'></script>
	<script type='text/javascript' src='<?php echo base_url();?>design/orderform/js/example.js'></script>
</head>

<body>
	<?php
	$id	= $this->uri->segment(4);
	foreach($list->result() as $rows){
	$coba = explode("/",$rows->qout_id);

	?> 
	<div id="page-wrap">
		<div id="identity">
            <div id="logo" style="float:left;">
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
              <img id="image" style="width: 108px; height:75;" src="<?php echo base_url();?>design/images/logokyoai.png" alt="logo" /></br>
			  MARKETING - SALES
            </div>		
		</div>
		<?php if($id=="1"){ ?>
		<textarea id="header">ORDER FORM - OPERATIONS</textarea>
		<?php }else{ ?>
		<textarea id="header">ORDER FORM - FINANCE</textarea>
		<?php } ?>
		 <table id="meta1">
                <tr>
				<?php if($id=="1"){ ?>
                    <td class="meta-head"><div style="float:left; width:50%;">Date : <?php echo date("M d, Y"); ?></div> <div style="float:right; width:50%;">No : <?=str_pad($rows->id_order_form, 3, "0", STR_PAD_LEFT)?>/OPS-<?=$coba[1];?>/<?=$coba[0];?>/<?=$coba[2];?>/<?=$coba[3];?></div></td>
				<?php }else{ ?>
					<td class="meta-head"><div style="float:left; width:50%;">Date : <?php echo date("M d, Y"); ?></div> <div style="float:right; width:50%;">No : <?=str_pad($rows->id_order_form, 3, "0", STR_PAD_LEFT)?>/FIN-<?=$coba[1];?>/<?=$coba[0];?>/<?=$coba[2];?>/<?=$coba[3];?></div></td>
				<?php } ?>
                </tr>
     
        </table>
		<div style="clear:both"></div>
		<div id="customer">
            <table id="meta">
                <tr>
                    <td class="meta-head">Company Name</td>
                    <td><textarea><?=$rows->client_name?></textarea></td>
                </tr>
                <tr>

                    <td rowspan="2" class="meta-head" style="vertical-align:top;">Attn</td>
                    <td><textarea><?=$rows->of_attn_name?> / <?=$rows->of_attn_telp?> / <?=$rows->of_attn_hp?> / email : <?=$rows->of_attn_email?></textarea></td>

                </tr>
				<tr>

                    <td><textarea><?=$rows->of_attn_name_2?> / <?=$rows->of_attn_telp_2?> / <?=$rows->of_attn_hp_2?> / email : <?=$rows->of_attn_email_2?></textarea></td>

                </tr>
                <tr>
                    <td class="meta-head" style="vertical-align:top;">Quantity</td>
                    <td><div><textarea style="height:72px;"><?=$rows->of_quantity?></textarea></div></td>
                </tr>
				<tr>
                    <td class="meta-head">Requirements</td>
                    <td><div><textarea></textarea></div></td>
                </tr>
            </table>
		</div>

		<table id="items">
		
		  <tr>
		      <th>Remarks</th>
		     
		  </tr>
		  
		  <tr class="item-row">
		      <td class="item-name"><p align="justify"><?=$rows->of_remark?></p></td>
		     
		  </tr>

		  	
		</table>
		<?php
			}
		?>
		<div id="terms">
		  <h5>Notes</h5>
		  <textarea></textarea>
		</div>
		</br>
	<table border="1" style="width:100%">
		<tr>
			<td align="center">Made by,</td>
			<td align="center">Checked by,</td>
			<td align="center">Checked by,</td>
			<td align="center">Approved by,</td>
		</tr>
		<tr style="height:80px;">
			<td align="center" style="vertical-align:bottom;"><textarea id="customer-title">Yen</textarea></td>
			<td align="center" style="vertical-align:bottom;"><textarea id="customer-title">Haryo</textarea></td>
			<td align="center" style="vertical-align:bottom;"><textarea id="customer-title">Karnawati</textarea></td>
			<td align="center" style="vertical-align:bottom;"><textarea id="customer-title">Darma Satyanegara</textarea></td>
		</tr>
		<tr>
			<td align="center"><textarea id="customer-title">Marketing Dept.</textarea></td>
			<td align="center"><textarea id="customer-title">GM - MKT & BusDev</textarea></td>
			<td align="center"><textarea id="customer-title">GM - Finance & Admin</textarea></td>
			<td align="center"><textarea id="customer-title">Direktur</textarea></td>
		</tr>
	</table>
	</div>
	
</body>

</html>