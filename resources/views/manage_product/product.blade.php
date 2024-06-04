
@extends('templates/main')
@section('css')
<link rel="stylesheet" href="{{ asset('css/manage_product/product/style.css') }}">
@endsection
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    <div class="page-header d-flex justify-content-between align-items-center">
      <h4 class="page-title">Daftar Barang</h4>
      <div class="d-flex justify-content-start">
      	<div class="dropdown">
	        <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton1">
	          <h6 class="dropdown-header">Urut Berdasarkan :</h6>
	          <div class="dropdown-divider"></div>
	          <a href="#" class="dropdown-item filter-btn" data-filter="kode_barang">Kode Barang</a>
            <a href="#" class="dropdown-item filter-btn" data-filter="jenis_barang">Jenis Barang</a>
            <a href="#" class="dropdown-item filter-btn" data-filter="nama_barang">Nama Barang</a>
            <a href="#" class="dropdown-item filter-btn" data-filter="berat_barang">Satuuan Barang</a>
            <a href="#" class="dropdown-item filter-btn" data-filter="merek">Merek Barang</a>
            @if($supply_system->status == true)
            <a href="#" class="dropdown-item filter-btn" data-filter="stok">Stok Barang</a>
            @endif
            <a href="#" class="dropdown-item filter-btn" data-filter="harga">Harga Barang</a>
	        </div>
	      </div>
        <div class="dropdown dropdown-search">
          <button class="btn btn-icons btn-inverse-primary btn-filter shadow-sm ml-2" type="button" id="dropdownMenuIconButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="mdi mdi-magnify"></i>
          </button>
          <div class="dropdown-menu search-dropdown" aria-labelledby="dropdownMenuIconButton1">
            <div class="row">
              <div class="col-11">
                <input type="text" class="form-control" name="search" placeholder="Cari barang">
              </div>
            </div>
          </div>
        </div>
	      <a href="{{ url('/product/new') }}" class="btn btn-icons btn-inverse-primary btn-new ml-2">
	      	<i class="mdi mdi-plus"></i>
	      </a>
      </div>
    </div>
  </div>
</div>
<div class="row modal-group">
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ url('/product/update') }}" method="post" name="update_form" enctype="multipart/form-data">
          <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Edit Barang</h5>
            <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="edit-modal-body">
              @csrf
              <div class="row" hidden="">
                <div class="col-12">
                  <input type="text" name="id">
                </div>
              </div>
              <div class="col-12 text-center">
                <img src="{{ asset('pictures/barang.jpg') }}" class="img-edit" name="foto">
              </div>
              <div class="col-12 text-center mt-2">
                <input type="file" name="foto" hidden="">
                <input type="text" name="nama_foto" hidden="">
                <button type="button" class="btn btn-primary preview-foto font-weight-bold btn-upload">Ubah</button>
                <button type="button" class="btn btn-delete-img">Hapus</button>
                <div class="col-12 error-notice" id="foto_error"></div>
              </div>
              <br>
              <div class="form-group row">
                <label class="col-lg-3 col-md-3 col-sm-12 col-form-label font-weight-bold">Kode Barang</label>
                <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                  <input type="text" class="form-control" name="kode_barang" readonly>
                </div>
                {{-- <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                  <button class="btn btn-inverse-primary btn-sm btn-scan shadow-sm" type="button"><i class="mdi mdi-crop-free"></i></button>
                </div> --}}
                <div class="col-lg-9 col-md-9 col-sm-12 offset-lg-3 offset-md-3 error-notice" id="kode_barang_error"></div>
              </div>
              <div class="form-group row">
                <label class="col-lg-3 col-md-3 col-sm-12 col-form-label font-weight-bold">Jenis Barang</label>
                <div class="col-lg-9 col-md-9 col-sm-12">
                  {{-- <input type="text" class="form-control" name="jenis_barang"> --}}
                  <select class="form-control" name="jenis_barang">
										<option value="">-- Pilih Jenis Barang --</option>
										<option value="Makanan">Makanan</option>
										<option value="Minuman">Minuman</option>
										<option value="Bumbu Dapur">Bumbu Dapur</option>
										<option value="Roko">Roko</option>
										<option value="Sabun">Sabun</option>
										<option value="Bubuk Minuman">Bubuk Minuman</option>
										<option value="Cemilan">Cemilan</option>
										<option value="Permen">Permen</option>
                    <option value="toren">toren</option>
										<option value="Bahan Baku">Bahan Baku</option>
										
									</select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-lg-3 col-md-3 col-sm-12 col-form-label font-weight-bold">Nama Barang</label>
                <div class="col-lg-9 col-md-9 col-sm-12">
                  <input type="text" class="form-control" name="nama_barang">
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 offset-lg-3 offset-md-3 error-notice" id="nama_barang_error"></div>
              </div>
              <div class="form-group row">
                <label class="col-lg-3 col-md-3 col-sm-12 col-form-label font-weight-bold">Merek Barang</label>
                <div class="col-lg-9 col-md-9 col-sm-12">
                  <input type="text" class="form-control" name="merek">
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 offset-lg-3 offset-md-3 error-notice" id="merek_error"></div>
              </div>
              <div class="form-group row">
                <label class="col-lg-3 col-md-3 col-sm-12 col-form-label font-weight-bold">Satuuan</label>
                <div class="col-lg-9 col-md-9 col-sm-12">
                  <div class="input-group">
                      <input type="text" class="form-control number-input input-notzero" name="berat_barang">
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
              <div class="form-group row" @if($supply_system->status == false) hidden="" @endif>
                <label class="col-lg-3 col-md-3 col-sm-12 col-form-label font-weight-bold">Stok Barang</label>
                <div class="col-lg-9 col-md-9 col-sm-12">
                  <input type="text" class="form-control number-input" name="stok" readonly>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 offset-lg-3 offset-md-3 error-notice" id="stok_error"></div>
              </div>
              <div class="form-group row">
                <label class="col-lg-3 col-md-3 col-sm-12 col-form-label font-weight-bold">Harga Beli</label>
                <div class="col-lg-9 col-md-9 col-sm-12">
                  <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text" style="background-color: #dee2e6">Rp. </span>
                      </div>
                      <input type="text" class="form-control number-input room_price thousandSeperator" id="harga_beli" name="harga_beli" oninput="ambilRupiah(this);" placeholder="Masukkan Harga Beli">
                      <input type="hidden" name="harga_beli" id="harga_beli_input" value="harga_beli" />
                      {{-- <input type="text" class="form-control number-input input-notzero" name="harga"> --}}
                  </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 offset-lg-3 offset-md-3 error-notice" id="harga_error"></div>
              </div>
              <div class="form-group row">
                <label class="col-lg-3 col-md-3 col-sm-12 col-form-label font-weight-bold">Harga Jual</label>
                <div class="col-lg-9 col-md-9 col-sm-12">
                  <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text" style="background-color: #dee2e6">Rp. </span>
                      </div>
                      <input type="text" class="form-control number-input room_price thousandSeperator" id="harga" name="harga" oninput="ambilRupiah(this);" placeholder="Masukkan Harga Jual">
                      <input type="hidden" name="harga" id="harga_input" value="harga" />
                      {{-- <input type="text" class="form-control number-input input-notzero" name="harga"> --}}
                  </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 offset-lg-3 offset-md-3 error-notice" id="harga_error"></div>
              </div>
          </div>
          {{-- <div class="modal-body" id="scan-modal-body" hidden="">
            <div class="row">
              <div class="col-12 text-center" id="area-scan">
              </div>
              <div class="col-12 barcode-result" hidden="">
                <h5 class="font-weight-bold">Hasil</h5>
                <div class="form-border">
                  <p class="barcode-result-text"></p>
                </div>
              </div>
            </div>
          </div> --}}
          <div class="modal-footer" id="edit-modal-footer">
            <button type="submit" class="btn btn-update"><i class="mdi mdi-content-save"></i> Simpan</button>
          </div>
          <div class="modal-footer" id="scan-modal-footer" hidden="">
            <button type="button" class="btn btn-primary btn-sm font-weight-bold rounded-0 btn-continue">Lanjutkan</button>
            <button type="button" class="btn btn-outline-secondary btn-sm font-weight-bold rounded-0 btn-repeat">Ulangi</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <div class="alert alert-primary d-flex justify-content-between align-items-center" role="alert">
      @if($supply_system->status == false)
      <div class="text-instruction">
        <i class="mdi mdi-information-outline mr-2"></i> Aktifkan sistem stok dan pasok dengan klik tombol disamping
      </div>
      <a href="{{ url('/supply/system/active') }}" class="btn stok-btn">Aktifkan</a>
      @else
      <div class="text-instruction">
        <i class="mdi mdi-information-outline mr-2"></i> Nonaktifkan sistem stok dan pasok dengan klik tombol disamping
      </div>
      <a href="{{ url('/supply/system/nonactive') }}" class="btn stok-btn">Nonaktifkan</a>
      @endif
    </div>
  </div>
  <div class="col-12 grid-margin">
    <div class="card card-noborder b-radius">
      <div class="card-body">
        <div class="row">
        	<div class="col-12 table-responsive">
        		<table class="table table-custom">
              <thead>
                <tr>
                  <th>Kode Barang</th>
                  <th>Nama Barang</th>
                  <th>Merk</th>
                  <th>Jenis</th>
                  <th>Satuuan</th>
                  @if($supply_system->status == true)
                  <th>Stok</th>
                  @endif
                  <th>Harga Beli</th>
                  <th>Harga Jual</th>
                  <th>Keterangan</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach($products as $product)
              	<tr>
                  <td>
                    <span class="btn kode-span kd-barang-field">{{ $product->kode_barang }}</span>
                  </td>
                  <td>
                    <img src="{{ asset('pictures/' . $product->foto) }}">
                    <span class="ml-2">{{ $product->nama_barang }}</span>
                  </td>
                  <td>{{ $product->merek }}</td>
                  <td>{{ $product->jenis_barang }}</td>
                  <td>{{ $product->berat_barang }}</td>
                  @if($supply_system->status == true)
                  <td><span class="ammount-box bg-secondary"><i class="mdi mdi-cube-outline"></i></span>{{ $product->stok }}</td>
                  @endif
                  <td><span class="ammount-box bg-green"><i class="mdi mdi-coin"></i></span>Rp. {{ number_format($product->harga_beli) }}</td>
                  <td><span class="ammount-box bg-green"><i class="mdi mdi-coin"></i></span>Rp. {{ number_format($product->harga) }}</td>
                  @if($supply_system->status == true)
                  <td>
                    @if($product->keterangan == 'Tersedia')
                    <span class="btn tersedia-span">{{ $product->keterangan }}</span>
                    @else
                    <span class="btn habis-span">{{ $product->keterangan }}</span>
                    @endif
                  </td>
                  @endif
                  <td>
                    <button type="button" class="btn btn-edit btn-icons btn-rounded btn-secondary" data-toggle="modal" data-target="#editModal" data-edit="{{ $product->id }}">
                        <i class="fa-solid fa-pen-nib"></i>
                    </button>
                    <button type="button" class="btn btn-icons btn-rounded btn-secondary ml-1 btn-delete" data-delete="{{ $product->kode_barang }}" data-merek="{{ $product->merek }}">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
        	</div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script src="{{ asset('plugins/js/quagga.min.js') }}"></script>
<script src="{{ asset('js/manage_product/product/script.js') }}"></script>
<script type="text/javascript">
  @if ($message = Session::get('create_success'))
    swal(
        "Berhasil!",
        "{{ $message }}",
        "success"
    );
  @endif

  @if ($message = Session::get('update_success'))
    swal(
        "Berhasil!",
        "{{ $message }}",
        "success"
    );
  @endif

  @if ($message = Session::get('delete_success'))
    swal(
        "Berhasil!",
        "{{ $message }}",
        "success"
    );
  @endif  
  @if ($message = Session::get('delete_error'))
    swal(
        "Gagal!",
        "{{ $message }}",
        "error"
    );
  @endif  

  @if ($message = Session::get('import_success'))
    swal(
        "Berhasil!",
        "{{ $message }}",
        "success"
    );
  @endif

  @if ($message = Session::get('update_failed'))
    swal(
        "",
        "{{ $message }}",
        "error"
    );
  @endif

  @if ($message = Session::get('supply_system_status'))
    swal(
        "",
        "{{ $message }}",
        "success"
    );
  @endif

  $(document).on('click', '.filter-btn', function(e){
    e.preventDefault();
    var data_filter = $(this).attr('data-filter');
    $.ajax({
      method: "GET",
      url: "{{ url('/product/filter') }}/" + data_filter,
      success:function(data)
      {
        $('tbody').html(data);
      }
    });
  });

  $(document).on('click', '.btn-edit', function(){
    var data_edit = $(this).attr('data-edit');
    $.ajax({
      method: "GET",
      url: "{{ url('/product/edit') }}/" + data_edit,
      success:function(response)
      {
        $('input[name=id]').val(response.product.id);
        $('.img-edit').attr("src", "{{ asset('pictures') }}/" + response.product.foto);
        $('input[name=kode_barang]').val(response.product.kode_barang);
        $('input[name=nama_barang]').val(response.product.nama_barang);
        $('input[name=merek]').val(response.product.merek);
        $('input[name=stok]').val(response.product.stok);
        $('input[name=harga_beli]').val(response.product.harga_beli);
        $('input[name=harga]').val(response.product.harga);
        var berat_barang = response.product.berat_barang.split(" ");
        $('input[name=berat_barang]').val(berat_barang[0]);
        $('select[name=jenis_barang] option[value="'+ response.product.jenis_barang +'"]').prop('selected', true);
        $('select[name=satuan_berat] option[value="'+ berat_barang[1] +'"]').prop('selected', true);
        validator.resetForm();
      }
    });
  });

  $(document).on('click', '.btn-delete', function(e){
    e.preventDefault();
    var data_delete = $(this).attr('data-delete');
    var merek = $(this).attr('data-merek');
    swal({
      title: "Apa Anda Yakin?",
      text: "Barang dengan merek "+merek+" akan terhapus, klik oke untuk melanjutkan",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.open("{{ url('/product/delete') }}/" + data_delete, "_self");
      }
    });
  });

  $(document).on('click', '.btn-delete-img', function(){
    $(".img-edit").attr("src", "{{ asset('pictures') }}/barang.jpg");
    $('input[name=nama_foto]').val('barang.jpg');
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