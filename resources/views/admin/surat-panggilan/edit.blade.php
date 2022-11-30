@extends('faturhelper::layouts/admin/main')

@section('title', 'Edit Surat Panggilan')

@section('content')

<div class="d-sm-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Edit Surat Panggilan</h1>
</div>
<div class="row">
	<div class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ route('admin.surat-panggilan.update') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $surat->id }}">
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Panggilan <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="panggilan" id="panggilan-1" value="1" {{ $surat->panggilan == '1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="panggilan-1">Panggilan I</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="panggilan" id="panggilan-2" value="2" {{ $surat->panggilan == '2' ? 'checked' : '' }}>
                                <label class="form-check-label" for="panggilan-2">Panggilan II</label>
                            </div>
                            @if($errors->has('panggilan'))
                            <div class="small text-danger">{{ $errors->first('panggilan') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Terlapor <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <select name="terlapor" class="form-select form-select-sm {{ $errors->has('terlapor') ? 'border-danger' : '' }}">
                                <option value="" disabled selected>--Pilih--</option>
                            </select>
                            @if($errors->has('terlapor'))
                            <div class="small text-danger">{{ $errors->first('terlapor') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Menghadap Kepada <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <select name="menghadap_kepada" class="form-select form-select-sm {{ $errors->has('menghadap_kepada') ? 'border-danger' : '' }}">
                                <option value="" disabled selected>--Pilih--</option>
                            </select>
                            @if($errors->has('menghadap_kepada'))
                            <div class="small text-danger">{{ $errors->first('menghadap_kepada') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Tanggal <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <div class="input-group input-group-sm">
                                <input type="text" name="tanggal" class="form-control form-control-sm {{ $errors->has('tanggal') ? 'border-danger' : '' }}" value="{{ date('d/m/Y', strtotime($surat->tanggal)) }}" autocomplete="off">
                                <span class="input-group-text"><i class="bi-calendar2"></i></span>
                            </div>
                            @if($errors->has('tanggal'))
                            <div class="small text-danger">{{ $errors->first('tanggal') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Jam <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <div class="input-group input-group-sm">
                                <input type="text" name="jam" class="form-control form-control-sm {{ $errors->has('jam') ? 'border-danger' : '' }}" value="{{ date('H:i', strtotime($surat->jam)) }}" autocomplete="off">
                                <span class="input-group-text"><i class="bi-alarm"></i></span>
                            </div>
                            @if($errors->has('jam'))
                            <div class="small text-danger">{{ $errors->first('jam') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Tempat <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <input type="text" name="tempat" class="form-control form-control-sm {{ $errors->has('tempat') ? 'border-danger' : '' }}" value="{{ $surat->tempat }}">
                            @if($errors->has('tempat'))
                            <div class="small text-danger">{{ $errors->first('tempat') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Status <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="status-1" value="1" {{ $surat->status == '1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="status-1">Diperiksa</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="status-2" value="2" {{ $surat->status == '2' ? 'checked' : '' }}>
                                <label class="form-check-label" for="status-2">Dimintai Keterangan</label>
                            </div>
                            @if($errors->has('status'))
                            <div class="small text-danger">{{ $errors->first('status') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Pelanggaran <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <textarea name="pelanggaran" class="form-control form-control-sm {{ $errors->has('pelanggaran') ? 'border-danger' : '' }}" rows="3">{{ $surat->pelanggaran }}</textarea>
                            @if($errors->has('pelanggaran'))
                            <div class="small text-danger">{{ $errors->first('pelanggaran') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Atasan <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="atasan" id="atasan-1" value="1" {{ $surat->atasan == '1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="atasan-1">Atasan Langsung</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="atasan" id="atasan-2" value="2" {{ $surat->atasan == '2' ? 'checked' : '' }}>
                                <label class="form-check-label" for="atasan-2">Ketua Tim Pemeriksa</label>
                            </div>
                            @if($errors->has('atasan'))
                            <div class="small text-danger">{{ $errors->first('atasan') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Nama Atasan <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <select name="ttd" class="form-select form-select-sm {{ $errors->has('ttd') ? 'border-danger' : '' }}">
                                <option value="" disabled selected>--Pilih--</option>
                            </select>
                            @if($errors->has('ttd'))
                            <div class="small text-danger">{{ $errors->first('ttd') }}</div>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-2 col-md-3"></div>
                        <div class="col-lg-10 col-md-9">
                            <button type="submit" class="btn btn-sm btn-primary"><i class="bi-save me-1"></i> Submit</button>
                            <a href="{{ route('admin.surat-panggilan.index') }}" class="btn btn-sm btn-secondary"><i class="bi-arrow-left me-1"></i> Kembali</a>
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
    Spandiv.DatePicker("input[name=tanggal]");
    Spandiv.ClockPicker("input[name=jam]");
    
    // Select2 Server Side
    $(window).on("load", function() {
        $.ajax({
            type: "get",
            url: "{{ route('api.simpeg') }}",
            success: function(response) {
                var html = '<option value="" disabled selected>--Pilih--</option>';
                for(var i = 0; i < response.length; i++) {
                    html += '<option value="' + response[i].nip + '">' + response[i].gelar_depan + response[i].nama + (response[i].gelar_belakang != '' ? ', ' + response[i].gelar_belakang : response[i].gelar_belakang) + ' (' + response[i].nip + ')' + '</option>';
                }
                $("select[name=terlapor], select[name=menghadap_kepada], select[name=ttd]").html(html);
                $("select[name=terlapor]").val("{{ $surat->terlapor }}");
                $("select[name=menghadap_kepada]").val("{{ $surat->menghadap_kepada }}");
                $("select[name=ttd]").val("{{ $surat->ttd }}");
            }
        });
        $("select[name=terlapor], select[name=menghadap_kepada], select[name=ttd]").select2();
    });
</script>

@endsection

@section('css')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">

@endsection