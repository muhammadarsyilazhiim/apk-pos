@extends('templates/main')
@section('css')
<link rel="stylesheet" href="{{ asset('css/manage_product/new_product/style.css') }}">
@endsection
@section('content')
@if(isset($room))
@php

if(!isset($amenities)){
$checked="";
}
$harga_barang = $room->harga_barang;
@endphp

@else

@php
$harga_barang = "1000000";
@endphp

@endif

<div class="row page-title-header">
  <div class="col-12">
    <div class="page-header d-flex justify-content-start align-items-center">
      <div class="quick-link-wrapper d-md-flex flex-md-wrap">
        <ul class="quick-links">
          <li><a href="{{ url('product') }}">Daftar Barang</a></li>
          <li><a href="{{ url('product/new') }}">Barang Baru</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 mb-4">
		<div class="card card-noborder b-radius">
			<div class="card-body">
				<form action="{{ url('/product/create') }}" method="post" name="create_form" enctype="multipart/form-data">
					@csrf
					<div class="form-group row">
						<div class="form-group row">
							<label class="col-12 font-weight-bold col-form-label">Foto Barang</label>
							<div class="col-12 d-flex flex-row align-items-center mt-2 mb-2">
								<img src="{{ asset('pictures/barang.jpg') }}" class="default-img mr-4" name="foto" id="preview-foto">
								<div class="btn-action">
									<input type="file" name="foto" id="foto" hidden="">
									<button class="btn btn-sm upload-btn mr-1" type="button">Upload Foto</button>
									<button class="btn btn-sm delete-btn" type="button">Hapus</button>
								</div>
							</div>
							<div class="col-12 error-notice" id="foto_error"></div>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-lg-6 col-md-6 col-sm-12 space-bottom">
							<div class="row">
								<label class="col-12 font-weight-bold col-form-label">Kode Barang</label>
								<div class="col-12">
									<div class="input-group mb-1">
										<input type="text" class="form-control" name="kode_barang" placeholder="Masukkan Kode Barang" readonly>
									</div>
									<sup class="text-danger">* Kode barang akan tergenerate otomatis berdasarkan jenis barang</sup>
								</div>
								<div class="col-12 error-notice" id="kode_barang_error"></div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 space-bottom">
					  		<div class="row">
					  			<label class="col-12 font-weight-bold col-form-label">Nama Barang</label>
							  	<div class="col-12">
							  		<input type="text" class="form-control" name="nama_barang" placeholder="Masukkan Nama Barang">
							  	</div>
								<div class="col-12 error-notice" id="nama_barang_error"></div>
					  		</div>
					  	</div>
					</div>
					<div class="form-group row">
						<div class="col-lg-6 col-md-6 col-sm-12">
							<div class="row">
								<label class="col-12 font-weight-bold col-form-label">Merek Barang</label>
								<div class="col-12">
									<input type="text" class="form-control" name="merek" placeholder="Masukkan Merek Barang">
								</div>
								<div class="col-12 error-notice" id="merek_error"></div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12">
							<div class="row">
								<label class="col-12 font-weight-bold col-form-label">Jenis Barang</label>
								<div class="col-12">
									<select class="form-control" name="jenis_barang">
										<option value="">-- Pilih Jenis Barang --</option>
										<option value="pompa">pompa</option>
										<option value="toren">toren</option>
										<option value="Bumbu Dapur">Bumbu Dapur</option>
										<option value="Roko">Roko</option>
										<option value="Sabun">Sabun</option>
										<option value="Bubuk Minuman">Bubuk Minuman</option>
										<option value="Cemilan">Cemilan</option>
										<option value="Permen">Permen</option>
										<option value="Bahan Baku">Bahan Baku</option>
										
									</select>
								</div>
								<div class="col-12 error-notice" id="jenis_barang_error"></div>
							</div>
						</div>
					  	
					</div>
					<div class="form-group row">
						<div class="col-lg-6 col-md-6 col-sm-12 space-bottom">
							<div class="row">
								<label class="col-12 font-weight-bold col-form-label">Satuan</label>
								<div class="col-12">
									<div class="input-group">
										<input type="text" class="form-control number-input" name="berat_barang" placeholder="Masukkan Satuan Barang">
										<div class="input-group-append">
											<select class="form-control" name="satuan_berat">
												<option value="kg">Kilogram</option>
												<option value="g">Gram</option>
												<option value="ml">Miligram</option>
												<option value="oz">Ons</option>
												<option value="l">Liter</option>
												<option value="ml">Mililiter</option>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
						@if($supply_system->status == true)
					  	<div class="col-lg-6 col-md-6 col-sm-12 space-bottom">
					  		<div class="row">
					  			<label class="col-12 font-weight-bold col-form-label">Stok Barang</label>
							  	<div class="col-12">
							  		<input type="text" class="form-control number-input" name="stok" placeholder="Masukkan Stok Barang">
							  	</div>
								<div class="col-12 error-notice" id="stok_error"></div>
					  		</div>
					  	</div>
					  	@endif
					  	<div class="col-lg-6 col-md-6 col-sm-12">
					  		<div class="row">
					  			<label class="col-12 font-weight-bold col-form-label">Harga Beli</label>
							  	<div class="col-12">
							  		<div class="input-group">
							  			<div class="input-group-prepend">
							  				<span class="input-group-text" style="background-color: #dee2e6">Rp. </span>
							  			</div>
										<input type="text" class="form-control number-input room_price thousandSeperator" id="harga_beli" name="harga_beli" oninput="ambilRupiah(this);" placeholder="Masukkan Harga Beli">
										<input type="hidden" name="harga_beli" id="harga_beli_input" value="" />
							  		</div>
							  	</div>
								<div class="col-12 error-notice" id="harga_error"></div>
					  		</div>
					  	</div>
					  	<div class="col-lg-6 col-md-6 col-sm-12">
					  		<div class="row">
					  			<label class="col-12 font-weight-bold col-form-label">Harga Jual</label>
							  	<div class="col-12">
							  		<div class="input-group">
							  			<div class="input-group-prepend">
							  				<span class="input-group-text" style="background-color: #dee2e6">Rp. </span>
							  			</div>
										<input type="text" class="form-control number-input room_price thousandSeperator" id="harga" name="harga" oninput="ambilRupiah(this);" placeholder="Masukkan Harga Jual">
										<input type="hidden" name="harga" id="harga_input" value="" />
							  		</div>
							  	</div>
								<div class="col-12 error-notice" id="harga_error"></div>
					  		</div>
					  	</div>
					</div>
					<div class="row">
						<div class="col-12 mt-2 d-flex justify-content-end">
					  		<button class="btn btn-simpan btn-sm" type="submit"><i class="mdi mdi-content-save"></i> Simpan</button>
					  	</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script src="{{ asset('plugins/js/quagga.min.js') }}"></script>
<script src="{{ asset('js/manage_product/new_product/script.js') }}"></script>
<script type="text/javascript">
  @if ($message = Session::get('create_failed'))
    swal(
        "",
        "{{ $message }}",
        "error"
    );
  @endif

  @if ($message = Session::get('import_failed'))
    swal(
        "",
        "{{ $message }}",
        "error"
    );
  @endif

	$(document).on('click', '.delete-btn', function(){
		$("#preview-foto").attr("src", "{{ asset('pictures') }}/barang.jpg");
	});
</script>

<script>
	if ("{{$harga_barang}}" != "") {
		var e = document.getElementById("harga");
		e.value = formatRupiah(e, e.value);
	}

	function ambilRupiah(e) {
	var hiddenInput = document.getElementById(e.id + "_value");
	hiddenInput.value = hiddenInput.value.replace(/[^0-9]*/g, '');
	hiddenInput.value = e.value.match(/\d/g).join("");
	e.value = formatRupiah(e, e.value);
	}
</script>

<script type="text/javascript">
	function fileValidation(){
		let fi = document.getElementsByClassName('validateImage');
		fi = fi[0];
		// Check if any file is selected.
		if (fi.files.length > 0) {
			for (let i = 0; i <= fi.files.length - 1; i++) {

				const fsize = fi.files.item(i).size;
				const fname = fi.files.item(i).name;
				const file = Math.round((fsize / 1024));
				// The size of the file.
				if (file >= 2048) {
					alert(
					"File "+fname+" too Big, please select a file less than 2mb !");
					fi.value = '';
				}
			}
		}
	}

	$(function(){
		$(".numbers").number(true,0);
	});

	$('.numberValidation').keyup(function () {
			this.value = this.value.replace(/[^0-9\.]/g,'');
		});
		$('.thousandSeperator').keyup(function () {
			var cek = parseInt(this.value);
			if(isNaN(cek)){
				this.value = "";
			}else{
				var hiddenInput = document.getElementById(this.id + "_input");
				hiddenInput.value = hiddenInput.value.replace(/[^0-9]*/g, '');
				hiddenInput.value = this.value.match(/\d/g).join("");
				this.value = formatRibuanTyping(this, this.value);
			}
		});

	/* Fungsi formatRupiah */
	function formatRibuanTyping(rupiah, angka, prefix) {
		var number_string = angka.replace(/[^0-9]*/g, '').toString(),
			split = number_string.split(','),
			sisa = split[0].length % 3,
			rupiah = split[0].substr(0, sisa),
			ribuan = split[0].substr(sisa).match(/\d{3}/gi);
		// tambahkan titik jika yang di input sudah menjadi angka ribuan
		if (ribuan) {
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}
		rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
		return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
	}
	//END

</script>

<script>
	$(document).ready(function() {
		$('select[name="jenis_barang"]').change(function() {
			const jenisBarang = $(this).val();

			if (jenisBarang) {
				$.ajax({
					url: '/generate-kode-barang',
					method: 'POST',
					data: {
						jenis_barang: jenisBarang,
						_token: '{{ csrf_token() }}'
					},
					success: function(response) {
						$('input[name="kode_barang"]').val(response.kode_barang);
					},
					error: function(xhr) {
						alert('Error: ' + xhr.responseJSON.error);
					}
				});
			} else {
				$('input[name="kode_barang"]').val('');
			}
		});
	});
</script>

@endsection