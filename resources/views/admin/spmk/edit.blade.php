@extends('faturhelper::layouts/admin/main')

@section('title', 'Edit Surat Panggilan Menerima Hukdis')

@section('content')

<div class="d-sm-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Edit Surat Panggilan Menerima Hukdis</h1>
</div>
<div class="row">
	<div class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ route('admin.spmk.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $spmk->id }}">
                    <input type="hidden" name="kasus_id" value="{{ $kasus->id }}">
                    <input type="hidden" name="terlapor" value="{{ $kasus->terduga }}">
                    <input type="hidden" name="pelanggaran_id" value="{{ $bap->pelanggaran_id }}">
                    <input type="hidden" name="hukdis_id" value="{{ $kephukdis->hukdis_id }}">
                    <input type="hidden" name="atasan" value="{{ $surat_panggilan_1->atasan }}">
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Terduga / Terlapor</label>
                        <div class="col-lg-10 col-md-9">
                            <input type="text" class="form-control form-control-sm" value="{{ $kasus->terduga_nama }} ({{ $kasus->terduga_nip }})" disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Atasan</label>
                        <div class="col-lg-10 col-md-9">
                            <input type="text" class="form-control form-control-sm" value="{{ $atasan->nama }} ({{ $atasan->nip }})" disabled>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Tanggal Surat <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <div class="input-group input-group-sm">
                                <input type="text" name="tanggal_surat" class="form-control form-control-sm {{ $errors->has('tanggal_surat') ? 'border-danger' : '' }}" value="{{ date('d/m/Y', strtotime($spmk->tanggal_surat)) }}" autocomplete="off">
                                <span class="input-group-text"><i class="bi-calendar2"></i></span>
                            </div>
                            @if($errors->has('tanggal_surat'))
                            <div class="small text-danger">{{ $errors->first('tanggal_surat') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Tempat Surat <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <input type="text" name="tempat_surat" class="form-control form-control-sm {{ $errors->has('tempat_surat') ? 'border-danger' : '' }}" value="{{ $spmk->tempat_surat }}">
                            @if($errors->has('tempat_surat'))
                            <div class="small text-danger">{{ $errors->first('tempat_surat') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Tempat Penerima Surat <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <input type="text" name="tempat_penerima_surat" class="form-control form-control-sm {{ $errors->has('tempat_penerima_surat') ? 'border-danger' : '' }}" value="{{ $spmk->tempat_penerima_surat }}">
                            @if($errors->has('tempat_penerima_surat'))
                            <div class="small text-danger">{{ $errors->first('tempat_penerima_surat') }}</div>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Menghadap Kepada <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <select name="menghadap_kepada" class="form-select form-select-sm {{ $errors->has('menghadap_kepada') ? 'border-danger' : '' }}" disabled>
                                <option value="" disabled selected>--Pilih--</option>
                            </select>
                            @if($errors->has('menghadap_kepada'))
                            <div class="small text-danger">{{ $errors->first('menghadap_kepada') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Tanggal Menghadap <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <div class="input-group input-group-sm">
                                <input type="text" name="tanggal_menghadap" class="form-control form-control-sm {{ $errors->has('tanggal_menghadap') ? 'border-danger' : '' }}" value="{{ date('d/m/Y', strtotime($spmk->tanggal_menghadap)) }}" autocomplete="off">
                                <span class="input-group-text"><i class="bi-calendar2"></i></span>
                            </div>
                            @if($errors->has('tanggal_menghadap'))
                            <div class="small text-danger">{{ $errors->first('tanggal_menghadap') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Jam Menghadap <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <div class="input-group input-group-sm">
                                <input type="text" name="jam_menghadap" class="form-control form-control-sm {{ $errors->has('jam_menghadap') ? 'border-danger' : '' }}" value="{{ date('H:i', strtotime($spmk->jam_menghadap)) }}" autocomplete="off">
                                <span class="input-group-text"><i class="bi-alarm"></i></span>
                            </div>
                            @if($errors->has('jam_menghadap'))
                            <div class="small text-danger">{{ $errors->first('jam_menghadap') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Tempat Menghadap <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <input type="text" name="tempat_menghadap" class="form-control form-control-sm {{ $errors->has('tempat_menghadap') ? 'border-danger' : '' }}" value="{{ $spmk->tempat_menghadap }}">
                            @if($errors->has('tempat_menghadap'))
                            <div class="small text-danger">{{ $errors->first('tempat_menghadap') }}</div>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-2 col-md-3"></div>
                        <div class="col-lg-10 col-md-9">
                            <button type="submit" class="btn btn-sm btn-primary"><i class="bi-save me-1"></i> Submit</button>
                            <a href="{{ route('admin.kasus.detail', ['id' => $kasus->id]) }}" class="btn btn-sm btn-secondary"><i class="bi-arrow-left me-1"></i> Kembali</a>
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
    Spandiv.DatePicker("input[name=tanggal_surat]");
    Spandiv.DatePicker("input[name=tanggal_menghadap]");
    Spandiv.ClockPicker("input[name=jam_menghadap]");

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
                $("select[name=menghadap_kepada]").html(html);
                $("select[name=menghadap_kepada]").removeAttr("disabled");
                $("select[name=menghadap_kepada]").val("{{ $spmk->menghadap_kepada }}");
            }
        });
        $("select[name=menghadap_kepada]").select2();
    });
</script>

@endsection

@section('css')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">

@endsection