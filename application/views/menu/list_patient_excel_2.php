<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Data Patient For Eazy.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<table border='1' width="70%">
<tr>
	<th>No Pelanggan</th>
	<th nowrap>Nama Pelanggan</th>
	<th nowrap>Tipe Pelanggan</th>
	<th>Saldo Awal</th>
	<th>Tgl. Saldo Awal</th>
	<th>Mata Uang</th>
	<th>Pajak 1</th>
	<th>Pajak 2</th>
	<th>Syarat Pembayaran</th>
	<th>Alamat 1</th>
	<th>Alamat 2</th>
	<th>Kota</th>
	<th>Propinsi</th>
	<th>Kode Pos</th>
	<th>Negara</th>
	<th>Contact</th>
	<th>No. Telp</th>
	<th>Fax</th>
	<th>Email</th>
	<th>Website</th>
	<th>NPWP 1</th>
	<th>NPWP 2</th>
	<th>Memo</th>
</tr>
<?php
$i=1;
foreach($find->result() as $row){
?>
	<tr class="odd gradeX">
		<td><?php echo $row->pat_MRN;?></td>
		<td><?php echo $row->pat_name;?>, <?php echo $row->title_desc;?></td>
		<td>Umum</td>
		<td>0</td>
		<td><?php echo date("Y-m-d");?></td>
		<td>IDR</td>
		<td>P</td>
		<td></td>
		<td>C.O.D</td>
		<td><?php echo $row->pat_address_home;?></td>
		<td><?php echo $row->pat_address_home;?></td>
		<td><?php echo $row->nama_kota;?></td>
		<td><?php echo $row->provinsi_nama;?></td>
		<td><?php echo $row->pos_code;?></td>
		<td><?php echo $row->nationality;?></td>
		<td><?php echo $row->pat_contact_misc;?> / <?php echo $row->pat_rel_contact;?></td>
		<td><?php echo $row->pat_contact_home;?></td>
		<td><?php echo $row->client_fax;?></td>
		<td><?php echo $row->pat_email;?></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
<?php
}
?>
</table>


