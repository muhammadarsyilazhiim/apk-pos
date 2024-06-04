<!DOCTYPE html>
<html>
<head>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid black;
  padding: 2px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #b68440;
  color: white;
}
table{
  margin: 20px auto;
  border-collapse: collapse;
}
table th,
table td{
  border: 5px solid #3c3c3c;
  padding: 3px 8px;

}
a{
  background: #b68440;
  color: #fff;
  padding: 8px 10px;
  text-decoration: none;
  border-radius: 2px;
}
</style>
</head>
<body>

  <h1 style="text-align: center;">Laporan Transaksi</h1>
  <br>
  <table id="customers" border="1" style="margin: 40px;">
    <tr>
      <th style="background-color: #1c45ef; text-align: center; color:white; width: 200%;"><b>Kode Transaksi</b></th>
      <th style="background-color: #1c45ef; text-align: center; color:white; width: 200%;"><b>Total</b></th>
      <th style="background-color: #1c45ef; text-align: center; color:white; width: 200%;"><b>Bayar</b></th>
      <th style="background-color: #1c45ef; text-align: center; color:white; width: 200%;"><b>Kembali</b></th>
      <th style="background-color: #1c45ef; text-align: center; color:white; width: 200%;"><b>User</b></th>
    </tr>
    <?php $TotalPemasukan = 0; ?>
    @foreach ($transactions as $transaction)     
    <tr>
      <td style="text-align: right;">{{ $transaction->kode_transaksi }}</td>
      <td style="text-align: right;">Rp. {{ number_format($transaction->total) }}</td>
      <td style="text-align: right;">Rp. {{ number_format($transaction->bayar) }}</td>
      <td style="text-align: right;">Rp. {{ number_format($transaction->kembali) }}</td>
      <td>{{ $transaction->kasir }}</td>
    </tr>
    <?php $TotalPemasukan += $transaction->total; ?>
    @endforeach

  <tr>
    <td colspan="4" rowspan="2" style="text-align: right;"><b>Total Pemasukan:</b></td>
    <td rowspan="2" style="text-align: right;">Rp. {{ number_format($TotalPemasukan) }}</td>
  </tr>
  </table>

</body>
</html>

