@extends('faturhelper::layouts/admin/main')

@section('title', 'Tambah Laporan Hasil Pemeriksaan')

@section('content')

<div class="d-sm-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Tambah Laporan Hasil Pemeriksaan</h1>
</div>
<div class="row">
	<div class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ route('admin.lhp.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="">
                    <input type="hidden" name="kasus_id" value="{{ $kasus->id }}">
                    <input type="hidden" name="terlapor" value="{{ $kasus->terduga }}">
                    <input type="hidden" name="tanggal_pemeriksaan" value="{{ $bap->tanggal }}">
                    <input type="hidden" name="pelanggaran_id" value="{{ $bap->pelanggaran_id }}">
                    <input type="hidden" name="pelapor" value="{{ $surat_panggilan_1->atasan }}">
                    <input type="hidden" name="status_pelapor" value="{{ $bap->pemeriksa }}">
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Terduga / Terlapor</label>
                        <div class="col-lg-10 col-md-9">
                            <input type="text" class="form-control form-control-sm" value="{{ $kasus->terduga_nama }} ({{ $kasus->terduga_nip }})" disabled>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Tanggal Surat <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <div class="input-group input-group-sm">
                                <input type="text" name="tanggal_surat" class="form-control form-control-sm {{ $errors->has('tanggal_surat') ? 'border-danger' : '' }}" value="{{ old('tanggal_surat') }}" autocomplete="off">
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
                            <input type="text" name="tempat_surat" class="form-control form-control-sm {{ $errors->has('tempat_surat') ? 'border-danger' : '' }}" value="{{ old('tempat_surat') }}">
                            @if($errors->has('tempat_surat'))
                            <div class="small text-danger">{{ $errors->first('tempat_surat') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Penerima Surat <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <select name="penerima_surat" class="form-select form-select-sm {{ $errors->has('penerima_surat') ? 'border-danger' : '' }}" disabled>
                                <option value="" disabled selected>--Pilih--</option>
                            </select>
                            @if($errors->has('penerima_surat'))
                            <div class="small text-danger">{{ $errors->first('penerima_surat') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Tempat Penerima Surat <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <input type="text" name="tempat_penerima_surat" class="form-control form-control-sm {{ $errors->has('tempat_penerima_surat') ? 'border-danger' : '' }}" value="{{ old('tempat_penerima_surat') }}">
                            @if($errors->has('tempat_penerima_surat'))
                            <div class="small text-danger">{{ $errors->first('tempat_penerima_surat') }}</div>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Tanggal Pemeriksaan</label>
                        <div class="col-lg-10 col-md-9">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control form-control-sm" value="{{ date('d/m/Y', strtotime($bap->tanggal)) }}" disabled>
                                <span class="input-group-text"><i class="bi-calendar2"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Pelanggaran</label>
                        <div class="col-lg-10 col-md-9">
                            <select name="pelanggaran" class="form-select form-select-sm" disabled>
                                <option value="" disabled selected>--Pilih--</option>
                                @foreach($pelanggaran as $p)
                                <option value="{{ $p->id }}" {{ $bap->pelanggaran_id == $p->id ? 'selected' : '' }}>Pasal {{ $p->kl->pasal }} Huruf {{ $p->kl->huruf }} {{ $p->kl->angka != '' ? 'Angka '.$p->kl->angka : '' }} : {{ $p->kl->keterangan }} {{ $p->keterangan != '' ? '- '.$p->keterangan : '' }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Hukuman Disiplin <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <select name="hukdis" class="form-select form-select-sm">
                                <option value="" disabled selected>--Pilih--</option>
                                @foreach($hukdis as $h)
                                <option value="{{ $h->id }}" {{ old('hukdis') == $h->id ? 'selected' : '' }}>{{ $h->jenis->nama }} - {{ $h->nama }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('hukdis'))
                            <div class="small text-danger">{{ $errors->first('hukdis') }}</div>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Pelapor</label>
                        <div class="col-lg-10 col-md-9">
                            <input type="text" class="form-control form-control-sm" value="{{ $atasan->nama }} ({{ $atasan->nip }})" disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Status Pelapor</label>
                        <div class="col-lg-10 col-md-9">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="status-pelapor-1" disabled value="1" {{ $bap->pemeriksa == '1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="status-pelapor-1">Atasan Langsung</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="status-pelapor-2" disabled value="2" {{ $bap->pemeriksa == '2' ? 'checked' : '' }}>
                                <label class="form-check-label" for="status-pelapor-2">Tim Pemeriksa</label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Tembusan <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <select name="tembusan[]" class="form-select form-select-sm {{ $errors->has('tembusan') ? 'border-danger' : '' }}" data-url="{{ route('api.tembusan.store') }}" data-token="{{ csrf_token() }}" multiple>
                                @foreach($tembusan as $t)
                                <option value="{{ $t->id }}" {{ $t->id == old('tembusan') ? 'selected' : '' }}>{{ $t->name }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('tembusan'))
                            <div class="small text-danger">{{ $errors->first('tembusan') }}</div>
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
    Spandiv.Select2("select[name='tembusan[]']", {
        enableAddOption: true,
        orderByClicked: true
    });

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
                $("select[name=penerima_surat]").html(html);
                $("select[name=penerima_surat]").removeAttr("disabled");
            }
        });
        $("select[name=penerima_surat]").select2();
    });
</script>

@endsection

@section('css')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">

@endsection