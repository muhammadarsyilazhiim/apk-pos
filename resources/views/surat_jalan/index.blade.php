@extends('templates/main')
@section('css')
<link rel="stylesheet" href="{{ asset('css/manage_account/account/style.css') }}">
@endsection
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="row page-title-header">
  <div class="col-12">
    <div class="page-header d-flex justify-content-between align-items-center">
      <h4 class="page-title">Daftar Surat Jalan</h4>
      <div class="d-flex justify-content-start">
        <div class="dropdown dropdown-search">
          <button class="btn btn-icons btn-inverse-primary btn-filter shadow-sm ml-2" type="button" id="dropdownMenuIconButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="mdi mdi-magnify"></i>
          </button>
          <div class="dropdown-menu search-dropdown" aria-labelledby="dropdownMenuIconButton1">
            <div class="row">
              <div class="col-11">
                <input type="text" class="form-control" name="search" placeholder="Cari Surat Jalan">
              </div>
            </div>
          </div>
        </div>
	      <a href="{{ url('/surat-jalan/new') }}" class="btn btn-icons btn-inverse-primary btn-new ml-2">
	      	<i class="mdi mdi-plus"></i>
	      </a>
      </div>
    </div>
  </div>
</div>

{{-- edit  --}}
<div class="row modal-group">
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ url('/surat-jalan/update') }}" method="post" enctype="multipart/form-data" name="update_form">
          <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Edit Surat Jalan</h5>
            <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            @csrf
            <div class="col-12" hidden="">
              <input type="text" name="id" id="id">
            </div>
            <div class="form-group row">
              <div class="col-sm-6">
                <label class="col-12 font-weight-bold col-form-label">No Surat <span class="text-danger">*</span></label>
                <div class="col-12">
                  <input type="text" class="form-control" name="no_surat" id="no_surat" placeholder="Masukkan no_surat" readonly>
                </div>
              </div>
              <div class="col-sm-6">
                <label class="col-12 font-weight-bold col-form-label">Customer <span class="text-danger">*</span></label>
                <div class="col-12">
                  <select class="form-control" name="id_customer" id="id_customer" required>
                    <option value="" selected>Pilih Customer</option>
                    @foreach($customers as $customer)
                      <option value="{{ $customer->id }}">{{ $customer->nama }}</option>
                    @endforeach
                  </select>
                </div>					
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-6">
                <label class="col-12 font-weight-bold col-form-label">Product <span class="text-danger">*</span></label>
                <div class="col-12">
                  <select class="form-control" name="id_product" id="id_product" required>
                    <option value="" selected>Pilih Product</option>
                    @foreach($products as $product)
                      <option value="{{ $product->id }}">{{ $product->nama_barang }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <label class="col-12 font-weight-bold col-form-label">Jumlah Barang <span class="text-danger">*</span></label>
                <div class="col-12">
                  <input type="number" name="jumlah" id="jumlah" class="form-control" required>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-6">
                <label class="col-12 font-weight-bold col-form-label">Supir <span class="text-danger">*</span></label>
                <div class="col-12">
                  <select class="form-control" name="id_supir" id="id_supir" required>
                    <option value="" selected>Pilih Supir</option>
                    @foreach($supirs as $supir)
                      <option value="{{ $supir->id }}">{{ $supir->nama }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <label class="col-12 font-weight-bold col-form-label">Ekspedisi <span class="text-danger">*</span></label>
                <div class="col-12">
                  <input type="text" name="ekspedisi" id="ekspedisi" class="form-control" required>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-6">
                <label class="col-12 font-weight-bold col-form-label">Tanggal Surat Jalan <span class="text-danger">*</span></label>
                <div class="col-12">
                  <input type="date" name="tgl_jalan" id="tgl_jalan" class="form-control" required>
                </div>
              </div>
              <div class="col-sm-6">
                <label class="col-12 font-weight-bold col-form-label">Pembayaran <span class="text-danger">*</span></label>
                <div class="col-12">
                  <label><input class="m-1" type="radio" name="pembayaran" value="Cash" required> Cash</label>
                  <label><input class="m-1" type="radio" name="pembayaran" value="Tokopedia" required> Tokopedia</label>
                </div>
              </div>              
            </div>
          </div>          
          <div class="modal-footer">
            <button type="submit" class="btn btn-update"><i class="mdi mdi-content-save"></i> Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="card card-noborder b-radius">
      <div class="card-body">
        <div class="row">
        	<div class="col-12 table-responsive">
            @if(Session::has('create_success'))
                <div class="alert alert-success">
                    {{ Session::get('create_success') }}
                </div>
            @endif
        		<table class="table table-custom">
              <thead>
                <tr>
                  <th>No Surat Jalan</th>
                  <th>Kode Transaksi</th>
                  <th>Kode Barang</th>
                  <th>Nama Barang</th>
                  <th>Nama Customer</th>
                  <th>Supir</th>
                  <th>Ekspedisi</th>
                  <th>Status</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
              	@foreach($sj as $SuratJalan)
                <tr>
                  <td>
                    <span class="btn kode-span kd-barang-field">{{ $SuratJalan->no_surat }}</span>
                  </td>
                  <td>{{ $SuratJalan->kode_transaksi }}</td>
                  <td>{{ $SuratJalan->kode_barang }}</td>
                  <td>{{ $SuratJalan->product->nama_barang }}</td>
                  <td>{{ $SuratJalan->customer->nama }}</td>
                  <td>{{ $SuratJalan->supir->nama }}</td>
                  <td>{{ $SuratJalan->ekspedisi }}</td>
                  <td>
                    @if ($SuratJalan->status == 1)
                        <span class="badge badge-success">Dikirim</span>
                    @else
                    <span class="">Belum dikirim</span>
                    @endif
                  </td>
                  
                  <td>
                  	{{-- <button type="button" class="btn btn-edit btn-icons btn-rounded btn-secondary" data-toggle="modal" data-target="#editModal" data-edit="{{ $SuratJalan->id }}">
                        <i class="fa-solid fa-pen-nib"></i>
                    </button> --}}
                    <a href="{{ route('detail.sj', $SuratJalan->id) }}" class="btn btn-icons btn-rounded btn-secondary ml-1">
                      <i class="fa-regular fa-eye"></i>
                    </a>
                    <button type="button" data-delete="{{ $SuratJalan->id }}" class="btn btn-icons btn-rounded btn-secondary ml-1 btn-delete">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                    {{-- <a href="{{ route('export.sj', $SuratJalan->id) }}" class="btn btn-outline-danger btn-sm">
                      <i class="fa-sharp fa-solid fa-file-pdf"></i> Cetak Surat Jalan
                    </a> --}}
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
<script src="{{ asset('js/manage_account/account/script.js') }}"></script>
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

  @if ($message = Session::get('both_error'))
    swal(
    "",
    "{{ $message }}",
    "error"
    );
  @endif

  @if ($message = Session::get('email_error'))
    swal(
    "",
    "{{ $message }}",
    "error"
    );
  @endif

  @if ($message = Session::get('username_error'))
    swal(
    "",
    "{{ $message }}",
    "error"
    );
  @endif

  $(document).on('click', '.filter-btn', function(e){
    e.preventDefault();
    var data_filter = $(this).attr('data-filter');
    $.ajax({
      method: "GET",
      url: "{{ url('/surat-jalan/filter') }}/" + data_filter,
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
      url: "{{ url('/surat-jalan/edit') }}/" + data_edit,
      success:function(response)
      {
        $('input[name=id]').val(response.sj.id);
        $('input[name=no_surat]').val(response.sj.no_surat);
        $('select[name=id_customer]').val(response.sj.id_customer);
        $('select[name=id_product]').val(response.sj.id_product);
        $('input[name=jumlah]').val(response.sj.jumlah);
        $('select[name=id_supir]').val(response.sj.id_supir);
        $('input[name=ekspedisi]').val(response.sj.ekspedisi);
        $('input[name=tgl_jalan]').val(response.sj.tgl_jalan);
        $('input[name="pembayaran"][value="' + response.sj.pembayaran + '"]').prop('checked', true);
        
      }
    });
  });

  $(document).on('click', '.btn-delete', function(e){
    e.preventDefault();
    var data_delete = $(this).attr('data-delete');
    swal({
      title: "Apa Anda Yakin?",
      text: "Data SuratJalan akan terhapus, klik oke untuk melanjutkan",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.open("{{ url('/surat-jalan/delete') }}/" + data_delete, "_self");
      }
    });
  });

  $(document).on('click', '.btn-delete-img', function(){
    $(".img-edit").attr("src", "{{ asset('pictures') }}/default.jpg");
    $('input[name=nama_foto]').val('default.jpg');
  });
</script>
@endsection