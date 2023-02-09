@extends('faturhelper::layouts/admin/main')

@section('title', 'Edit Keputusan Hukuman Disiplin')

@section('content')

<div class="d-sm-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Edit Keputusan Hukuman Disiplin</h1>
</div>
<div class="row">
	<div class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ route('admin.kephukdis.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $kephukdis->id }}">
                    <input type="hidden" name="kasus_id" value="{{ $kasus->id }}">
                    <input type="hidden" name="terlapor" value="{{ $kasus->terduga }}">
                    <input type="hidden" name="dugaan_pelanggaran" value="{{ $kasus->dugaan_pelanggaran }}">
                    <input type="hidden" name="pelanggaran_id" value="{{ $bap->pelanggaran_id }}">
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Terduga / Terlapor</label>
                        <div class="col-lg-10 col-md-9">
                            <input type="text" class="form-control form-control-sm" value="{{ $kasus->terduga_nama }} ({{ $kasus->terduga_nip }})" disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Dugaan</label>
                        <div class="col-lg-10 col-md-9">
                            <textarea class="form-control form-control-sm" rows="3" disabled>{{ $kasus->dugaan_pelanggaran }}</textarea>
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
                        <label class="col-lg-2 col-md-3 col-form-label">Keputusan <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <select name="keputusan" class="form-select form-select-sm">
                                <option value="" disabled selected>--Pilih--</option>
                                @foreach($keputusan as $k)
                                <option value="{{ $k['id'] }}" {{ $kephukdis->keputusan == $k['id'] ? 'selected' : '' }}>{{ $k['nama'] }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('keputusan'))
                            <div class="small text-danger">{{ $errors->first('keputusan') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Hukuman Disiplin <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <select name="hukdis" class="form-select form-select-sm">
                                <option value="" disabled selected>--Pilih--</option>
                                @foreach($hukdis as $h)
                                <option value="{{ $h->id }}" {{ $kephukdis->hukdis_id == $h->id ? 'selected' : '' }}>{{ $h->jenis->nama }} - {{ $h->nama }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('hukdis'))
                            <div class="small text-danger">{{ $errors->first('hukdis') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Tanggal Ditetapkan <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <div class="input-group input-group-sm">
                                <input type="text" name="tanggal_ditetapkan" class="form-control form-control-sm {{ $errors->has('tanggal_ditetapkan') ? 'border-danger' : '' }}" value="{{ date('d/m/Y', strtotime($kephukdis->tanggal_ditetapkan)) }}" autocomplete="off">
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
                            <input type="text" name="tempat_ditetapkan" class="form-control form-control-sm {{ $errors->has('tempat_ditetapkan') ? 'border-danger' : '' }}" value="{{ $kephukdis->tempat_ditetapkan }}">
                            @if($errors->has('tempat_ditetapkan'))
                            <div class="small text-danger">{{ $errors->first('tempat_ditetapkan') }}</div>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <h5 class="mb-3">Pejabat yang Berwenang Menghukum</h5>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Nama <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <input type="text" name="nama_pejabat" class="form-control form-control-sm {{ $errors->has('nama_pejabat') ? 'border-danger' : '' }}" value="{{ $kephukdis->nama_pejabat }}">
                            @if($errors->has('nama_pejabat'))
                            <div class="small text-danger">{{ $errors->first('nama_pejabat') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">NIP <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <input type="text" name="nip_pejabat" class="form-control form-control-sm {{ $errors->has('nip_pejabat') ? 'border-danger' : '' }}" value="{{ $kephukdis->nip_pejabat }}">
                            @if($errors->has('nip_pejabat'))
                            <div class="small text-danger">{{ $errors->first('nip_pejabat') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Jabatan <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <input type="text" name="jabatan_pejabat" class="form-control form-control-sm {{ $errors->has('jabatan_pejabat') ? 'border-danger' : '' }}" value="{{ $kephukdis->jabatan_pejabat }}">
                            @if($errors->has('jabatan_pejabat'))
                            <div class="small text-danger">{{ $errors->first('jabatan_pejabat') }}</div>
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

<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
<script>
    Spandiv.DatePicker("input[name=tanggal_ditetapkan]");
</script>

@endsection

@section('css')

<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"> -->

@endsection