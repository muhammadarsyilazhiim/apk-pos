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
          <li><a href="{{ url('supir') }}">Daftar supir</a></li>
          <li><a href="{{ url('supir/new') }}">supir Baru</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="row">
	<div class="col-12">
		<div class="card card-noborder b-radius">
			<div class="card-body">
				<form action="{{ url('supir/create') }}" method="post" name="create_form" enctype="multipart/form-data">
				  @csrf
				  <div class="form-group row">
					<div class="col-sm-6">
						<label class="col-12 font-weight-bold col-form-label">Nama <span class="text-danger">*</span></label>
						<div class="col-12">
							<input type="text" class="form-control" name="nama" placeholder="Masukkan Nama">
						</div>
						<div class="col-12 error-notice" id="nama_error"></div>
					</div>
					<div class="col-sm-6">
						<label class="col-12 font-weight-bold col-form-label">No Telpon <span class="text-danger">*</span></label>
						<div class="col-12">
							<input type="number" class="form-control" name="no_tel" placeholder="Masukkan No Telp">
						</div>
						<div class="col-12 error-notice" id="nama_error"></div>
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