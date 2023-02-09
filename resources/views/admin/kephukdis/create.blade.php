@extends('faturhelper::layouts/admin/main')

@section('title', 'Tambah Keputusan Hukuman Disiplin')

@section('content')

<div class="d-sm-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Tambah Keputusan Hukuman Disiplin</h1>
</div>
<div class="row">
	<div class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ route('admin.kephukdis.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="">
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
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Tanggal Pelanggaran <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <div class="input-group input-group-sm">
                                <input type="text" name="tanggal_pelanggaran" class="form-control form-control-sm {{ $errors->has('tanggal_pelanggaran') ? 'border-danger' : '' }}" value="{{ old('tanggal_pelanggaran') }}" autocomplete="off">
                                <span class="input-group-text"><i class="bi-calendar2"></i></span>
                            </div>
                            @if($errors->has('tanggal_pelanggaran'))
                            <div class="small text-danger">{{ $errors->first('tanggal_pelanggaran') }}</div>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Nomor <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <input type="text" name="nomor" class="form-control form-control-sm {{ $errors->has('nomor') ? 'border-danger' : '' }}" value="{{ old('nomor') }}">
                            @if($errors->has('nomor'))
                            <div class="small text-danger">{{ $errors->first('nomor') }}</div>
                            @endif
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
                    <div class="row mb-3 d-none" id="tmt">
                        <label class="col-lg-2 col-md-3 col-form-label">TMT <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <div class="input-group input-group-sm">
                                <input type="text" name="tmt" class="form-control form-control-sm {{ $errors->has('tmt') ? 'border-danger' : '' }}" value="{{ old('tmt') }}" autocomplete="off">
                                <span class="input-group-text"><i class="bi-calendar2"></i></span>
                            </div>
                            <div class="small text-secondary"></div>
                            @if($errors->has('tmt'))
                            <div class="small text-danger">{{ $errors->first('tmt') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3 d-none" id="tukin">
                        <label class="col-lg-2 col-md-3 col-form-label">Tunjangan Kinerja <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">Rp</span>
                                <input type="text" name="tukin" class="form-control form-control-sm {{ $errors->has('tukin') ? 'border-danger' : '' }}" value="{{ old('tukin') }}" autocomplete="off">
                            </div>
                            @if($errors->has('tukin'))
                            <div class="small text-danger">{{ $errors->first('tukin') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3 d-none" id="tmt-pengembalian">
                        <label class="col-lg-2 col-md-3 col-form-label">TMT Pengembalian Tunjangan Kinerja <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <div class="input-group input-group-sm">
                                <input type="text" name="tmt_pengembalian" class="form-control form-control-sm {{ $errors->has('tmt_pengembalian') ? 'border-danger' : '' }}" value="{{ old('tmt_pengembalian') }}" autocomplete="off">
                                <span class="input-group-text"><i class="bi-calendar2"></i></span>
                            </div>
                            @if($errors->has('tmt_pengembalian'))
                            <div class="small text-danger">{{ $errors->first('tmt_pengembalian') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3 d-none" id="jabatan-setelah">
                        <label class="col-lg-2 col-md-3 col-form-label">Jabatan Setelah Diturunkan <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <input type="text" name="jabatan_setelah_diturunkan" class="form-control form-control-sm {{ $errors->has('jabatan_setelah_diturunkan') ? 'border-danger' : '' }}" value="{{ old('jabatan_setelah_diturunkan') }}">
                            @if($errors->has('jabatan_setelah_diturunkan'))
                            <div class="small text-danger">{{ $errors->first('jabatan_setelah_diturunkan') }}</div>
                            @endif
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
                    <h5 class="mb-3">Pejabat yang Berwenang Menghukum</h5>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Nama <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <input type="text" name="nama_pejabat" class="form-control form-control-sm {{ $errors->has('nama_pejabat') ? 'border-danger' : '' }}" value="{{ old('nama_pejabat') }}">
                            @if($errors->has('nama_pejabat'))
                            <div class="small text-danger">{{ $errors->first('nama_pejabat') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">NIP <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <input type="text" name="nip_pejabat" class="form-control form-control-sm {{ $errors->has('nip_pejabat') ? 'border-danger' : '' }}" value="{{ old('nip_pejabat') }}">
                            @if($errors->has('nip_pejabat'))
                            <div class="small text-danger">{{ $errors->first('nip_pejabat') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Jabatan <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <input type="text" name="jabatan_pejabat" class="form-control form-control-sm {{ $errors->has('jabatan_pejabat') ? 'border-danger' : '' }}" value="{{ old('jabatan_pejabat') }}">
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

<script>
    Spandiv.DatePicker("input[name=tanggal_pelanggaran]");
    Spandiv.DatePicker("input[name=tanggal_ditetapkan]");
    Spandiv.DatePicker("input[name=tmt]");
    Spandiv.DatePicker("input[name=tmt_pengembalian]");

    // Tunjangan kinerja
    $(document).on("keyup", "input[name=tukin]", function() {
        $(this).val(Spandiv.NumberFormat($("input[name=tukin]").val()));
    });

    // Execute hukdis form
    $(window).on("load", function() {
        hukdisForm();
    });
    $(document).on("change", "select[name=hukdis]", function() {
        hukdisForm();
    });

function hukdisForm() {
    var ids = [4,5,6,7,8];
    var pemotonganTunjangan = [4,5,6];
    var hukdis = parseInt($("select[name=hukdis]").val());

    // Show fields
    if(ids.indexOf(hukdis) != -1) {
        $("#tmt").removeClass("d-none");
        if(pemotonganTunjangan.indexOf(hukdis) != -1) {
            $("#tmt").find(".small.text-secondary").text("TMT Pemotongan Tunjangan Kinerja");
            $("#tukin").removeClass("d-none");
            $("#tmt-pengembalian").removeClass("d-none");
            $("#jabatan-setelah").addClass("d-none");
            $("#jabatan-setelah").find("input").val(null);
        }
        else if(hukdis == 7) {
            $("#tmt").find(".small.text-secondary").text("TMT Penurunan Jabatan");
            $("#tukin").addClass("d-none");
            $("#tukin").find("input").val(null);
            $("#tmt-pengembalian").addClass("d-none");
            $("#tmt-pengembalian").find("input").val(null);
            $("#jabatan-setelah").removeClass("d-none");
        }
        else if(hukdis == 8) {
            $("#tmt").find(".small.text-secondary").text("TMT Pembebasan dari Jabatan");
            $("#tukin").addClass("d-none");
            $("#tukin").find("input").val(null);
            $("#tmt-pengembalian").addClass("d-none");
            $("#tmt-pengembalian").find("input").val(null);
            $("#jabatan-setelah").addClass("d-none");
            $("#jabatan-setelah").find("input").val(null);
        }
    }
    // Hide fields
    else {
        $("#tmt").addClass("d-none");
        $("#tmt").find("input").val(null);
        $("#tukin").addClass("d-none");
        $("#tukin").find("input").val(null);
        $("#tmt-pengembalian").addClass("d-none");
        $("#tmt-pengembalian").find("input").val(null);
        $("#jabatan-setelah").addClass("d-none");
        $("#jabatan-setelah").find("input").val(null);
    }
}
</script>

@endsection