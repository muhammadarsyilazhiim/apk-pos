<!DOCTYPE html>
<html>
<head>
</head>
<body>

  <h1>Laporan Pasok</h1>
  <br>
<table id="customers" border="1">
  <tr>
    <th style="background-color: #1c45ef; text-align: center; color:white; width: 200%;"><b>Kode Barang</b></th>
    <th style="background-color: #1c45ef; text-align: center; color:white; width: 200%;"><b>Nama Barang</b></th>
    <th style="background-color: #1c45ef; text-align: center; color:white; width: 200%;"><b>merek</b></th>
    <th style="background-color: #1c45ef; text-align: center; color:white; width: 200%;"><b>Jumlah</b></th>
    <th style="background-color: #1c45ef; text-align: center; color:white; width: 200%;"><b>Harga Beli</b></th>
    <th style="background-color: #1c45ef; text-align: center; color:white; width: 200%;"><b>Pemasok</b></th>
  </tr>
  <?php $totalHargaBeli = 0; ?>
  @foreach ($supplies as $supply)     
  <tr>
    <td style="text-align: right;">{{ $supply->kode_barang }}</td>
    <td>{{ $supply->nama_barang }}</td>
    <td>{{ $supply->merek }}</td>
    <td style="text-align: right;">{{ $supply->jumlah }}</td>
    <td style="text-align: right;">Rp. {{ number_format($supply->harga_beli) }}</td>
    <td>{{ $supply->pemasok }}</td>
  </tr>
  <?php
    $totalHargaBarang = $supply->harga_beli * $supply->jumlah;
    $totalHargaBeli += $totalHargaBarang;
  ?>
  @endforeach

  <tr>
    <td colspan="5" rowspan="2" style="text-align: right;"><b>Total Pengeluaran:</b></td>
    <td rowspan="2" style="text-align: right;">Rp. {{ number_format($totalHargaBeli) }}</td>
  </tr>
</table>

</body>
</html>

