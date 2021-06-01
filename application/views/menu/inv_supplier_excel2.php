<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Master Supplier.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<table border='1' width="70%">
<tr>
	<th>No. Pemasok</th>
	<th>Nama</th>
	<th>Saldo Awal</th>
	<th>Tgl Saldo Awal</th>
	<th>Mata Uang</th>
	<th>Pajak 1</th>
	<th>Pajak 2</th>
	<th>Syarat Pembayaran</th>
	<th>Alamat 1</th>
	<th>Alamat 2</th>
	<th>Kota</th>
	<th>Provinsi</th>
	<th>Kode Pos</th>
	<th>Negara</th>
	<th>Contact</th>
	<th>No Telp</th>
	<th>Fax</th>
	<th>Email</th>
	<th>Website</th>
	<th>NPWP 1</th>
	<th>NPWP 2</th>
	<th>Memo</th>
</tr>
<?php
$i=1;
foreach($data->result() as $row){
?>
	<tr class="odd gradeX">
		<td><?php echo $row->id_supplier;?></td> 
		<td><?php echo $row->supp_name;?></td>											
		<td><?php echo $row->supp_balance;?></td>
		<td><?php echo date("Y-m-d");?></td>
		<td>IDR</td>
		<td>P</td>
		<td>P</td>
		<td><?php 
			if ($row->term_payment > 0) {
				echo "NET".$row->term_payment;
			}else{
				echo $row->term_payment;
			}
		?></td>
		<td><?php echo $row->supp_address1;?></td>
		<td><?php echo $row->supp_address2;?></td>
		<td><?php echo $row->supp_city;?></td>
		<td><?php echo $row->supp_province;?></td>
		<td><?php echo $row->supp_pos_code;?></td>
		<td><?php echo $row->supp_nationality;?></td>
		<td><?php echo $row->supp_contact1;?></td>
		<td><?php echo $row->supp_phone;?></td>
		<td><?php echo $row->supp_fax;?></td>
		<td><?php echo $row->supp_email;?></td>
		<td><?php echo $row->supp_website;?></td>
		<td><?php echo $row->supp_npwp1;?></td>
		<td><?php echo $row->supp_npwp2;?></td>
		<td><?php echo $row->memo;?></td>
	</tr>
<?php
}
?>
</table>


