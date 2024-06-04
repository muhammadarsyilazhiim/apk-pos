<!DOCTYPE html>
<html>
<head>
</head>
<body>

  <h1>Laporan Pegawai</h1>
  <br>
<table id="customers" border="1">
  <tr>
    <th style="background-color: #1c45ef; text-align: center; color:white; width: 200%;"><b>User</b></th>
    <th style="background-color: #1c45ef; text-align: center; color:white; width: 200%;"><b>Kegiatan</b></th>
    <th style="background-color: #1c45ef; text-align: center; color:white; width: 200%;"><b>Jumlah</b></th>
  </tr>
  <?php $totalActivity = 0; ?>
  @foreach ($activities as $activity)     
  <tr>
    <td>{{ $activity->user }}</td>
    <td>{{ $activity->nama_kegiatan }}</td>
    <td>{{ $activity->jumlah }}</td>
  </tr>
  <?php $totalActivity += $activity->jumlah; ?>
  @endforeach

  <tr>
    <td colspan="4" rowspan="2" style="text-align: right;"><b>Total Aktifitas:</b></td>
    <td rowspan="2" style="text-align: right;">Rp. {{ $totalActivity }}</td>
  </tr>
</table>

</body>
</html>

