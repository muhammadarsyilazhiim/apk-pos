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
          <li><a href="{{ url('surat-jalan') }}">Daftar Surat Jalan</a></li>
          <li><a href="{{ url('surat-jalan/new') }}">Surat Jalan Baru</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="row">
	<div class="col-12">
		<div class="card card-noborder b-radius">
			<div class="card-body">
				<form action="{{ url('surat-jalan/create') }}" method="post" name="create_form" enctype="multipart/form-data">
					@csrf
					<div class="form-group row">
						<div class="col-sm-6">
							<label class="col-12 font-weight-bold col-form-label">No Surat <span class="text-danger">*</span></label>
							<div class="col-12">
								<input type="text" class="form-control" name="no_surat" id="no_surat" placeholder="Masukkan no_surat" readonly>
							</div>
						</div>
						<div class="col-sm-6">
							<label class="col-12 font-weight-bold col-form-label">Pilih Kode Transaksi <span class="text-danger">*</span></label>
							<div class="col-12">
								<select class="form-control select2" name="kode_transaksi" id="id_transaksi" required>
									<option value="" selected>Pilih Kode Transaksi</option>
									@foreach($transasksi as $trans)
										<option value="{{ $trans->kode_transaksi }}">{{ $trans->kode_transaksi }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-sm-12"id="product-details" style="display: none;">
							<label class="col-sm-12 font-weight-bold col-form-label">Detail Produk</label>
							<div class="col-sm-12" id="product-list">
							</div>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-sm-6">
							<label class="col-12 font-weight-bold col-form-label">Pilih Supir <span class="text-danger">*</span></label>
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
							<label class="col-12 font-weight-bold col-form-label">Pilih Ekspedisi <span class="text-danger">*</span></label>
							<div class="col-12">
								<select class="form-control" name="ekspedisi" id="ekspedisi" required>
									<option value="" selected>Pilih Ekspedisi</option>
									<option value="JNE">JNE</option>
									<option value="Antar_Aja">Antar Aja</option>
									<option value="Sicepat">Sicepat</option>
								</select>
							</div>
						</div>
						<div class="col-sm-6">
							<label class="col-12 font-weight-bold col-form-label">Tanggal Jalan <span class="text-danger">*</span></label>
							<div class="col-12">
								<input type="date" class="form-control" name="tgl_jalan" id="tgl_jalan" required>
							</div>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const noSuratInput = document.getElementById('no_surat');
        const today = new Date();
        const date = String(today.getDate()).padStart(2, '0');
        const month = String(today.getMonth() + 1).padStart(2, '0');
        const year = today.getFullYear();
        const randomNumber = Math.floor(1000 + Math.random() * 9000); 

        const noSurat = `SJ/${randomNumber}/${date}/${month}/${year}`;
        noSuratInput.value = noSurat;
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    $('#id_transaksi').change(function(){
        var transactionId = $(this).val();
        if(transactionId) {
            $.ajax({
                url: '/get-products-by-transaction/' + transactionId,
                type: 'GET',
                success: function(response) {
                    $('#product-list').empty();
                    if(response.length > 0) {
                        $('#product-details').show();
                        var tableHTML = '<table class="table col-sm-12"><thead><tr><th>Kode Barang</th><th>Nama Barang</th><th>Nama Customer</th><th>Jumlah</th><th>Harga</th><th>Metode Pembayaran</th><th>Pilih</th></tr></thead><tbody>';
                        $.each(response, function(index, product) {
							if(product.status == 0) {
								tableHTML += '<tr>' +
									'<input type="hidden" id="id_customer" value="'+product.id_customer+'">' +
									'<td>' + product.kode_barang + '</td>' +
									'<td>' + product.nama_barang + '</td>' +
									'<td>' + product.customer.nama + '</td>' +
									// '<td>' + (product.customer ? product.customer.nama : '') + '</td>' +
									'<td>' + product.jumlah + '</td>' +
									'<td>' + product.harga + '</td>' +
									'<td>' + product.metodePem + '</td>' +
									'<td><input type="checkbox" name="selected_products[]" value="' + product.kode_barang + '"></td>' +
								'</tr>';
							} else {
								tableHTML += '<tr>' +
									'<input type="hidden" id="id_customer" value="'+product.id_customer+'">' +
									'<td>' + product.kode_barang + '</td>' +
									'<td>' + product.nama_barang + '</td>' +
									'<td>' + product.customer.nama + '</td>' +
									// '<td>' + (product.customer ? product.customer.nama : '') + '</td>' +
									'<td>' + product.jumlah + '</td>' +
									'<td>' + product.harga + '</td>' +
									'<td>' + product.metodePem + '</td>' +
									'<td><span class="badge badge-success">Sudah Dikirim</span></td>' +
								'</tr>';
							}
						});
                        tableHTML += '</tbody></table>';
                        $('#product-list').html(tableHTML);
                    } else {
                        $('#product-list').html('<p>No products found for this transaction.</p>');
                    }
                },
                error: function(xhr) {
                    console.log('Error:', xhr);
                }
            });
        } else {
            $('#product-details').hide();
            $('#product-list').empty();
        }
    });

	$('form[name="create_form"]').submit(function(e) {
		e.preventDefault();
		var selectedProducts = [];
		$('input[name="selected_products[]"]:checked').each(function() {
			selectedProducts.push($(this).val());
		});
		selectedProducts.forEach(function(selectedProduct) {
			console.log(selectedProducts)
			var formData = {
				no_surat: $('#no_surat').val(),
				id_supir: $('#id_supir').val(),
				ekspedisi: $('#ekspedisi').val(),
				tgl_jalan: $('#tgl_jalan').val(),
				kode_transaksi: $('#id_transaksi').val(),
				id_cust: $('#id_customer').val(),
				selected_product: selectedProduct,
				_token: '{{ csrf_token() }}'
			};
			$.ajax({
				url: '/surat-jalan/create',
				type: 'POST',
				data: formData,
				success: function(response) {
					window.location.href = '/surat-jalan?success=Surat Jalan baru berhasil dibuat';
				},
				error: function(xhr) {
					console.log('Error:', xhr);
				}
			});
		});
	});

});
</script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>

@endsection