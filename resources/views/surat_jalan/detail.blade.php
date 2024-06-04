@extends('templates/main')

@section('content')
	<style>
		html{
			font-family: "Arial", sans-serif;
			margin: 0;
			padding: 0;
		}
		.header{
			background-color: #d3eafc;
			padding: 60px 90px;
		}
		.body{
			padding: 40px 90px;
		}
		/* Text */
		.text-20{
			font-size: 20px;
		}
		.text-18{
			font-size: 18px;
		}
		.text-16{
			font-size: 16px;
		}
		.text-14{
			font-size: 14px;
		}
		.text-12{
			font-size: 12px;
		}
		.text-10{
			font-size: 10px;
		}
		.font-bold{
			font-weight: bold;
		}
		.text-left{
			text-align: left;
		}
		.text-right{
			text-align: right;
		}
		.txt-dark{
			color: #5b5b5b;
		}
		.txt-dark2{
			color: #1d1d1d;
		}
		.txt-blue{
			color: #2a4df1;
		}
		.txt-light{
			color: #acacac;
		}
		.txt-green{
			color: #19d895;
		}
		p{
			margin: 0;
		}

		.d-block{
			display: block;
		}
		.w-100{
			width: 100%;
		}
		.img-td{
			width: 60px;
		}
		.img-td img{
			width: 3rem;
		}
		.mt-2{
			margin-top: 10px;
		}
		.mb-1{
			margin-bottom: 5px;
		}
		.mb-4{
			margin-bottom: 20px;
		}
		.pt-30{
			padding-top: 30px;
		}
		.pt-15{
			padding-top: 15px;
		}
		.pt-5{
			padding-top: 5px;
		}
		.pb-5{
			padding-bottom: 5px;
		}
		table{
			border-collapse: collapse;
		}
		thead tr td{
			border-bottom: 0.5px solid #d9dbe4;
			color: #7e94f6;
			font-size: 12px;
			padding: 5px;
			text-transform: uppercase;
		}
		tbody tr td{
			padding: 7px;
		}
		.border-top-foot{
			border-top: 0.5px solid #d9dbe4;
		}
		.mr-20{
			margin-right: 20px;
		}
		ul{
			padding: 0;
		}
		ul li{
			list-style-type: none;
		}
		.w-300p{
			width: 300px;
		}
		.logo1{
			color: white;
			border-radius: 100%;
			padding: 10px;
			background-color: blue;
		}
	</style>
	
	<div class="container-fluid">
		<div class="header">
			<h1 class="text-bold" style="text-align: center;">Surat Jalan</h1>
			<p class="" style="text-align: center;">nomor {{ $suratJalan->no_surat }}</p>
			<p class="" style="text-align: center;"> {{ $suratJalan->kode_transaksi }}</p>
			<table class="w-100">
				<tr>
					<td class="" style="text-align: left;">
						<p class="text-12 txt-dark d-block mb-1 text-bold"><b>{{ $market->nama_toko }}</b></p>
						<p class="text-10 txt-dark d-block">{{ $market->alamat }}</p>
						<p class="text-10 txt-dark d-block">{{ $market->no_telp }}</p>
					</td>
					<td class="" style="text-align: right;">
						<p class="text-12 txt-dark d-block" style="font-weight: bold;">Tanggal Surat : {{ $suratJalan->tgl_jalan }}</p>
						<p class="text-12 txt-dark d-block">Penerima : {{ $suratJalan->customer->nama }}</p>
						<p class="text-10 txt-dark d-block">Pengirim : {{ $user->nama }}</p>
						<p class="text-10 txt-dark d-block">Tujuan : {{ $suratJalan->customer->alamat }}</p>
						<p class="text-10 txt-dark d-block">Supir : {{ $suratJalan->supir->nama }}</p>
						<p class="text-10 txt-dark d-block">Ekpedisi : {{ $suratJalan->ekspedisi }}</p>
						<p class="text-10 txt-dark d-block">Pembayaran Via : {{ $suratJalan->transaksi->metodePem }}</p>
					</td>
				</tr>
			</table>
			
		</div>
		<div class="body">
			<ul>
				@php
				$pemasukan = 0;
				@endphp
				<table class="w-100 mb-4 table-striped">
					<thead>
						<tr>
							<td>No Surat</td>
							<td>Nama Barang</td>
							<td>Jumlah</td>
							<td>Harga</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<span class="text-12 txt-dark2 d-block">{{ $suratJalan->no_surat }}</span>
							</td>
							<td>
								<span class="text-12 txt-dark2 d-block">{{ $suratJalan->product->nama_barang }}</span>
							</td>
							<td>
								<span class="text-12 txt-dark2 d-block">{{ $suratJalan->transaksi->jumlah }}</span>
							</td>
							<td>
								<span class="text-12 txt-dark2 d-block">Rp. {{ number_format($suratJalan->transaksi->harga) }}</span>
							</td>
						</tr>
					</tbody>
				</table>
			</ul>
			<table class="w-100">
				<tfoot>
					<tr>
						<td class="border-top-foot"></td>
					</tr>
					<tr>
						<td class="text-14 pt-15 text-right">
							<span class="mr-20">Total</span>
							<span class="txt-blue font-bold">Rp. {{ number_format($suratJalan->transaksi->total) }}</span>
						</td>
					</tr>
				</tfoot>
			</table>
			<div class="">
				<div class="text-14 pt-15 text-right" style="margin-bottom: 10%; margin-top: 20%;">
					<span>Tangerang, </span>
					<span class="txt-black font-bold">{{ \Carbon\Carbon::now()->isoFormat('DD MMM, Y') }}</span>
				</div>
				<div class="text-14 pt-15 text-right">
					<span>( {{ $suratJalan->customer->nama }} )</span>
				</div>
			</div>

			<div class="">
				<div class="text-14 pt-15 text-left">
					<a href="/surat-jalan" class="btn btn-secondary me-3">Kembali</a>
					<a href="{{ route('export.sj', $suratJalan->id) }}" class="btn btn-outline-danger btn-sm">
						<i class="fa-sharp fa-solid fa-file-pdf"></i> Cetak Surat Jalan
					</a>
				</div>
			</div>
		</div>
	</div>
	@endsection