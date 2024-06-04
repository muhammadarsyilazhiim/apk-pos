@extends('templates/main')
@section('css')
<link rel="stylesheet" href="{{ asset('css/manage_product/product/style.css') }}">
@endsection
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="row page-title-header">
    <div class="col-12">
      <div class="page-header d-flex justify-content-between align-items-center">
        <h4 class="page-title">Daftar Barang Yang Hampir Habis</h4>
        <div class="d-flex justify-content-start">
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
        </div>
      </div>
    </div>
  </div>
<div class="row">
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
                  <th>Harga</th>
                  <th>Keterangan</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach($products as $product)
                    @if ($product->stok < 10)
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
                                <td>
                                    <span class="ammount-box bg-secondary"><i class="mdi mdi-cube-outline"></i></span>{{ $product->stok }}
                                </td>
                            @endif
                            <td>
                                <span class="ammount-box bg-green"><i class="mdi mdi-coin"></i></span>Rp. {{ number_format($product->harga) }}
                            </td>
                            @if($supply_system->status == true)
                                <td>
                                    @if($product->keterangan == 'Tersedia')
                                        <span class="btn tersedia-span">{{ $product->keterangan }}</span>
                                    @else
                                        <span class="btn habis-span">{{ $product->keterangan }}</span>
                                    @endif
                                </td>
                            @endif
                        </tr>
                    @endif
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


{{-- <script>
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
</script> --}}

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
@endsection