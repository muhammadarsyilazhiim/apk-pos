@extends('templates/main')
@section('css')
<link rel="stylesheet" href="{{ asset('css/manage_account/new_account/style.css') }}">
@endsection
@section('content')
<div class="row page-title-header">
  <div class="col-12">
    <div class="page-header d-flex justify-content-start align-items-center">
      <div class="quick-link-wrapper d-md-flex flex-md-wrap">
        <ul class="quick-links">
          <li><a href="{{ url('cusstomer') }}">Daftar cusstomer</a></li>
          <li><a href="{{ url('cusstomer/new') }}">cusstomer Baru</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="row">
	<div class="col-12">
		<div class="card card-noborder b-radius">
			<div class="card-body">
				<form action="{{ url('customer/create') }}" method="post" name="create_form" enctype="multipart/form-data">
				  @csrf
				  <div class="form-group row">
				  	<label class="col-12 font-weight-bold col-form-label">Nama <span class="text-danger">*</span></label>
				  	<div class="col-12">
				  		<input type="text" class="form-control" name="nama" placeholder="Masukkan Nama">
				  	</div>
				  	<div class="col-12 error-notice" id="nama_error"></div>
				  </div>
				  <div class="form-group row">
				  	<label class="col-12 font-weight-bold col-form-label">Email <span class="text-danger">*</span></label>
				  	<div class="col-12">
				  		<input type="email" class="form-control" name="email" placeholder="Masukkan Email">
				  	</div>
				  	<div class="col-12 error-notice" id="email_error"></div>
				  </div>
				  <div class="form-group row">
				  	<label class="col-12 font-weight-bold col-form-label">notel <span class="text-danger">*</span></label>
				  	<div class="col-12">
				  		<input type="text" class="form-control" name="notel" placeholder="Masukkan notel">
				  	</div>
				  	<div class="col-12 error-notice" id="username_error"></div>
				  </div>
				  <div class="form-group row">
				  	<label class="col-12 font-weight-bold col-form-label">Alamat <span class="text-danger">*</span></label>
				  	<div class="col-12">
						<textarea class="form-control" name="alamat" id="" cols="30" rows="10"></textarea>
				  	</div>
				  </div>
				  <div class="row mt-5">
				  	<div class="col-12 d-flex justify-content-end">
				  		<button class="btn simpan-btn btn-sm" type="submit"><i class="mdi mdi-content-save"></i> Simpan</button>
				  	</div>
				  </div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script src="{{ asset('js/manage_account/new_account/script.js') }}"></script>
<script type="text/javascript">
	@if ($message = Session::get('both_error'))
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

	@if ($message = Session::get('email_error'))
	  swal(
		"",
		"{{ $message }}",
		"error"
	  );
	@endif

	$(document).on('click', '.delete-btn', function(){
		$("#preview-foto").attr("src", "{{ asset('pictures') }}/default.jpg");
	});
</script>
@endsection