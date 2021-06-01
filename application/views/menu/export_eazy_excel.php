<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Export Eazy.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<table border='1' width="70%"> 
<tr>
	<th>No. Barang</th>
	<th>Deskripsi</th>
	<th>Deskripsi 2</th>
	<th>Induk Barang</th>
	<th>Qty</th>
	<th>Gudang</th>
	<th>Gudang Default</th>
	<th>Pajak</th>
	<th>Unit 1</th>
	<th>Unit 2</th>
	<th>Unit 3</th>
	<th>Ratio 2</th>
	<th>Ratio 3</th>
	<th>Biaya Satuan</th>
	<th>Unit Harga</th>
	<th>Unit Harga 2</th>
	<th>Unit Harga 3</th>
	<th>Unit Harga 4</th>
	<th>Unit Harga 5</th>
	<th>Tgl Saldo Awal</th>
	<th>Periode</th>
	<th>Tahun</th>
	<th>Persediaan</th>
	<th>HPP</th>
	<th>Retur Pembelian</th>
	<th>Penjualan</th>
	<th>Retur Penjualan</th>
	<th>Penerimaan Belum Tertagih</th>
	<th>Barang Terkirim</th>
	<th>Tipe Barang</th>
	<th>Tipe Persediaan</th>
</tr>
<?php
$i=1;
foreach($data->result() as $row){
?>
	<tr class="odd gradeX">
		<td><?php echo $row->NoBarang;?></td>
		<td><?php echo $row->Deskripsi;?></td>		
		<td><?php echo $row->Deskripsi2;?></td>			
		<td><?php echo $row->IndukBarang;?></td>	
		<td><?php echo $row->qty;?></td>
		<td><?php echo $row->gudang;?></td>
		<td><?php echo $row->gdasli;?></td>
		<td><?php echo $row->pajak;?></td>
		<td><?php echo $row->Unit1;?></td>
		<td><?php echo $row->Unit2;?></td>
		<td><?php echo $row->Unit3;?></td>
		<td><?php echo $row->Ratio2;?></td>
		<td><?php echo $row->Ratio3;?></td>
		<td><?php echo $row->base;?></td>
		<td><?php echo $row->normal;?></td>
		<td><?php echo $row->insurance;?></td>
		<td><?php echo $row->company;?></td>
		<td><?php echo $row->usd;?></td>
		<td><?php echo $row->uharga5;?></td>
		<td><?php echo $row->tglsaldoawal;?></td>
		<td><?php echo $row->periode;?></td>
		<td><?php echo $row->tahun;?></td>
		<td><?php echo $row->persediaan;?></td>
		<td><?php echo $row->hpp;?></td>
		<td><?php echo $row->returpembelian;?></td>
		<td><?php echo $row->penjualan;?></td>
		<td><?php echo $row->returpenjualan;?></td>
		<td><?php echo $row->penerimaanbelumtertagih;?></td>
		<td><?php echo $row->barangterkirim;?></td>
		<td><?php echo $row->tipebarang;?></td>
		<td><?php echo $row->tipepersediaan;?></td>
	</tr>
<?php
}
?>
</table>


