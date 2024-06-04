@extends('templates/main')
@section('css')
<link rel="stylesheet" href="{{ asset('css/manage_account/account/style.css') }}">
@endsection
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="row page-title-header">
  <div class="col-12">
    <div class="page-header d-flex justify-content-between align-items-center">
      <h4 class="page-title">Daftar Customer</h4>
      <div class="d-flex justify-content-start">
        <div class="dropdown dropdown-search">
          <button class="btn btn-icons btn-inverse-primary btn-filter shadow-sm ml-2" type="button" id="dropdownMenuIconButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="mdi mdi-magnify"></i>
          </button>
          <div class="dropdown-menu search-dropdown" aria-labelledby="dropdownMenuIconButton1">
            <div class="row">
              <div class="col-11">
                <input type="text" class="form-control" name="search" placeholder="Cari Customer">
              </div>
            </div>
          </div>
        </div>
	      <a href="{{ url('/customer/new') }}" class="btn btn-icons btn-inverse-primary btn-new ml-2">
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
        <form action="{{ url('/customer/update') }}" method="post" enctype="multipart/form-data" name="update_form">
          <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Edit customer</h5>
            <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              @csrf
              <div class="col-12" hidden="">
                <input type="text" name="id">
              </div>
              <div class="form-group row mt-4">
                <label class="col-3 col-form-label font-weight-bold">Nama</label>
                <div class="col-9">
                  <input type="text" class="form-control" name="nama">
                </div>
                <div class="col-9 offset-3 error-notice" id="nama_error"></div>
              </div>
              <div class="form-group row">
                <label class="col-3 col-form-label font-weight-bold">Email</label>
                <div class="col-9">
                  <input type="email" class="form-control" name="email">
                </div>
                <div class="col-9 offset-3 error-notice" id="email_error"></div>
              </div>
              <div class="form-group row">
                <label class="col-3 col-form-label font-weight-bold">No telp</label>
                <div class="col-9">
                  <input type="text" class="form-control" name="notel">
                </div>
                <div class="col-9 offset-3 error-notice" id="username_error"></div>
              </div>
              <div class="form-group row">
                <label class="col-3 col-form-label font-weight-bold">Alamat</label>
                <div class="col-9">
                  <input type="text" class="form-control" name="alamat" cols="30" rows="10">
                </div>
                <div class="col-9 offset-3 error-notice" id="username_error"></div>
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
        		<table class="table table-custom">
              <thead>
                <tr>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>No Telp</th>
                  <th>Alamat</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
              	@foreach($cust as $customer)
                <tr>
                  <td>{{ $customer->nama }}</td>
                  <td>{{ $customer->email }}</td>
                  <td>{{ $customer->notel }}</td>
                  <td>{{ $customer->alamat }}</td>
                  
                  <td>
                  	<button type="button" class="btn btn-edit btn-icons btn-rounded btn-secondary" data-toggle="modal" data-target="#editModal" data-edit="{{ $customer->id }}">
                        <i class="fa-solid fa-pen-nib"></i>
                    </button>
                    <button type="button" data-delete="{{ $customer->id }}" class="btn btn-icons btn-rounded btn-secondary ml-1 btn-delete">
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
      url: "{{ url('/customer/filter') }}/" + data_filter,
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
      url: "{{ url('/customer/edit') }}/" + data_edit,
      success:function(response)
      {
        $('input[name=id]').val(response.customer.id);
        $('input[name=nama]').val(response.customer.nama);
        $('input[name=email]').val(response.customer.email);
        $('input[name=notel]').val(response.customer.notel);
        $('input[name=alamat]').val(response.customer.alamat);
        validator.resetForm();
      }
    });
  });

  $(document).on('click', '.btn-delete', function(e){
    e.preventDefault();
    var data_delete = $(this).attr('data-delete');
    swal({
      title: "Apa Anda Yakin?",
      text: "Data customer akan terhapus, klik oke untuk melanjutkan",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.open("{{ url('/customer/delete') }}/" + data_delete, "_self");
      }
    });
  });

  $(document).on('click', '.btn-delete-img', function(){
    $(".img-edit").attr("src", "{{ asset('pictures') }}/default.jpg");
    $('input[name=nama_foto]').val('default.jpg');
  });
</script>
@endsection