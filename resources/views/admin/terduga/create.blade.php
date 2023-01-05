@extends('faturhelper::layouts/admin/main')

@section('title', 'Tambah Kasus')

@section('content')

<div class="d-sm-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Tambah Kasus</h1>
</div>
<div class="row">
	<div class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ route('admin.terduga.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Terduga <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <select name="terduga" class="form-select form-select-sm {{ $errors->has('terduga') ? 'border-danger' : '' }}" disabled>
                                <option value="" disabled selected>--Pilih--</option>
                            </select>
                            @if($errors->has('terduga'))
                            <div class="small text-danger">{{ $errors->first('terduga') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Dugaan Pelanggaran <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <textarea name="dugaan_pelanggaran" class="form-control form-control-sm {{ $errors->has('dugaan_pelanggaran') ? 'border-danger' : '' }}" rows="3">{{ old('dugaan_pelanggaran') }}</textarea>
                            @if($errors->has('dugaan_pelanggaran'))
                            <div class="small text-danger">{{ $errors->first('dugaan_pelanggaran') }}</div>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-2 col-md-3"></div>
                        <div class="col-lg-10 col-md-9">
                            <button type="submit" class="btn btn-sm btn-primary"><i class="bi-save me-1"></i> Submit</button>
                            <a href="{{ route('admin.terduga.index') }}" class="btn btn-sm btn-secondary"><i class="bi-arrow-left me-1"></i> Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
	</div>
</div>

@endsection

@section('js')

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>    
    // Select2 Server Side
    $(window).on("load", function() {
        var key = "";
        $.ajax({
            type: "get",
            url: "{{ route('api.simpeg') }}",
            success: function(response) {
                var html = '<option value="" disabled selected>--Pilih--</option>';
                for(var i = 0; i < response.length; i++) {
                    var selected = (key === response[i].nip) ? 'selected' : '';
                    html += '<option value="' + response[i].nip + '" ' + selected + '>' + response[i].gelar_depan + response[i].nama + (response[i].gelar_belakang != '' ? ', ' + response[i].gelar_belakang : response[i].gelar_belakang) + ' (' + response[i].nip + ')' + '</option>';
                }
                $("select[name=terduga]").html(html).removeAttr("disabled");
            }
        });
    });
    $("select[name=terduga]").select2();
</script>

@endsection

@section('css')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">

@endsection