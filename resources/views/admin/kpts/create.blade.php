@extends('faturhelper::layouts/admin/main')

@section('title', 'Tambah Keputusan Pembebasan Tugas Sementara')

@section('content')

<div class="d-sm-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Tambah Keputusan Pembebasan Tugas Sementara</h1>
</div>
<div class="row">
	<div class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ route('admin.kpts.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="">
                    <input type="hidden" name="kasus_id" value="{{ $kasus->id }}">
                    <input type="hidden" name="terlapor" value="{{ $kasus->terduga }}">
                    <input type="hidden" name="pelanggaran_id" value="{{ $bap->pelanggaran_id }}">
                    <input type="hidden" name="atasan" value="{{ $surat_panggilan_1->atasan }}">
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Terduga / Terlapor</label>
                        <div class="col-lg-10 col-md-9">
                            <input type="text" class="form-control form-control-sm" value="{{ $kasus->terduga_nama }} ({{ $kasus->terduga_nip }})" disabled>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Keputusan <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <select name="keputusan" class="form-select form-select-sm">
                                <option value="" disabled selected>--Pilih--</option>
                                @foreach($keputusan as $k)
                                <option value="{{ $k['id'] }}" {{ old('keputusan') == $k['id'] ? 'selected' : '' }}>{{ $k['nama'] }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('keputusan'))
                            <div class="small text-danger">{{ $errors->first('keputusan') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Tanggal Ditetapkan <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <div class="input-group input-group-sm">
                                <input type="text" name="tanggal_ditetapkan" class="form-control form-control-sm {{ $errors->has('tanggal_ditetapkan') ? 'border-danger' : '' }}" value="{{ old('tanggal_ditetapkan') }}" autocomplete="off">
                                <span class="input-group-text"><i class="bi-calendar2"></i></span>
                            </div>
                            @if($errors->has('tanggal_ditetapkan'))
                            <div class="small text-danger">{{ $errors->first('tanggal_ditetapkan') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Tempat Ditetapkan <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <input type="text" name="tempat_ditetapkan" class="form-control form-control-sm {{ $errors->has('tempat_ditetapkan') ? 'border-danger' : '' }}" value="{{ old('tempat_ditetapkan') }}">
                            @if($errors->has('tempat_ditetapkan'))
                            <div class="small text-danger">{{ $errors->first('tempat_ditetapkan') }}</div>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Atasan</label>
                        <div class="col-lg-10 col-md-9">
                            <input type="text" class="form-control form-control-sm" value="{{ $atasan->nama }} ({{ $atasan->nip }})" disabled>
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

<script>
    Spandiv.DatePicker("input[name=tanggal_ditetapkan]");
    Spandiv.Select2("select[name='tembusan[]']", {
        enableAddOption: true,
        orderByClicked: true
    });
</script>

@endsection