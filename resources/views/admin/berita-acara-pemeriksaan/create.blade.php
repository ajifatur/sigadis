@extends('faturhelper::layouts/admin/main')

@section('title', 'Tambah Berita Acara Pemeriksaan')

@section('content')

<div class="d-sm-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Tambah Berita Acara Pemeriksaan</h1>
</div>
<div class="row">
	<div class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ route('admin.berita-acara-pemeriksaan.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Tanggal <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <div class="input-group input-group-sm">
                                <input type="text" name="tanggal" class="form-control form-control-sm {{ $errors->has('tanggal') ? 'border-danger' : '' }}" value="{{ old('tanggal') }}" autocomplete="off">
                                <span class="input-group-text"><i class="bi-calendar2"></i></span>
                            </div>
                            @if($errors->has('tanggal'))
                            <div class="small text-danger">{{ $errors->first('tanggal') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Pemeriksa <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="saya_pemeriksa" id="pemeriksa-1" value="1" {{ old('saya_pemeriksa') == '1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="pemeriksa-1">Saya</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="saya_pemeriksa" id="pemeriksa-2" value="2" {{ old('saya_pemeriksa') == '2' ? 'checked' : '' }}>
                                <label class="form-check-label" for="pemeriksa-2">Tim Pemeriksa</label>
                            </div>
                            @if($errors->has('saya_pemeriksa'))
                            <div class="small text-danger">{{ $errors->first('saya_pemeriksa') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Wewenang <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="wewenang" id="wewenang-1" value="1" {{ old('wewenang') == '1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="wewenang-1">Saya</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="wewenang" id="wewenang-2" value="2" {{ old('wewenang') == '2' ? 'checked' : '' }}>
                                <label class="form-check-label" for="wewenang-2">Surat Perintah</label>
                            </div>
                            @if($errors->has('wewenang'))
                            <div class="small text-danger">{{ $errors->first('wewenang') }}</div>
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
                    <hr>
                    <p class="fw-bold">Yang dilanggar dalam PP No. 94 Tahun 2021:</p>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Pasal <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <select name="pasal" class="form-select form-select-sm {{ $errors->has('pasal') ? 'border-danger' : '' }}">
                                <option value="" disabled selected>--Pilih--</option>
                                @for($i=1; $i<=10; $i++)
                                <option value="{{ $i }}" {{ old('pasal') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                            @if($errors->has('pasal'))
                            <div class="small text-danger">{{ $errors->first('pasal') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Ayat <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <select name="ayat" class="form-select form-select-sm {{ $errors->has('ayat') ? 'border-danger' : '' }}">
                                <option value="" disabled selected>--Pilih--</option>
                                @for($i=1; $i<=10; $i++)
                                <option value="{{ $i }}" {{ old('ayat') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                            @if($errors->has('ayat'))
                            <div class="small text-danger">{{ $errors->first('ayat') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Huruf <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <select name="huruf" class="form-select form-select-sm {{ $errors->has('huruf') ? 'border-danger' : '' }}">
                                <option value="" disabled selected>--Pilih--</option>
                                @for($i=1; $i<=10; $i++)
                                <option value="{{ $i }}" {{ old('huruf') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                            @if($errors->has('huruf'))
                            <div class="small text-danger">{{ $errors->first('huruf') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Angka <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <select name="angka" class="form-select form-select-sm {{ $errors->has('angka') ? 'border-danger' : '' }}">
                                <option value="" disabled selected>--Pilih--</option>
                                @for($i=1; $i<=10; $i++)
                                <option value="{{ $i }}" {{ old('angka') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                            @if($errors->has('angka'))
                            <div class="small text-danger">{{ $errors->first('angka') }}</div>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <p class="fw-bold">Tim Pemeriksa:</p>
                    <div class="col" id="tim-pemeriksa">
                        <div class="row">
                            <div class="col">
                                <select name="pemeriksa[]" class="form-select form-select-sm pemeriksa">
                                    <option value="" disabled selected>--Pilih--</option>
                                </select>
                            </div>
                            <div class="col-auto">
                                <div class="btn-group">
                                    <a href="#" class="btn btn-sm btn-success btn-add-row" title="Tambah"><i class="bi-plus"></i></a>
                                    <a href="#" class="btn btn-sm btn-danger btn-delete-row" title="Hapus"><i class="bi-trash"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <p class="fw-bold">Pertanyaan dan Jawaban:</p>
                    <div class="col" id="qna">
                        <div class="row">
                            <div class="col">
                                <textarea name="pertanyaan[]" class="form-control form-control-sm" rows="3" placeholder="Pertanyaan"></textarea>
                            </div>
                            <div class="col">
                                <textarea name="jawaban[]" class="form-control form-control-sm" rows="3" placeholder="Jawaban"></textarea>
                            </div>
                            <div class="col-auto">
                                <div class="btn-group">
                                    <a href="#" class="btn btn-sm btn-success btn-add-row" title="Tambah"><i class="bi-plus"></i></a>
                                    <a href="#" class="btn btn-sm btn-danger btn-delete-row" title="Hapus"><i class="bi-trash"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <!-- <div class="col-lg-2 col-md-3"></div> -->
                        <div class="col-lg-10 col-md-9">
                            <button type="submit" class="btn btn-sm btn-primary"><i class="bi-save me-1"></i> Submit</button>
                            <a href="{{ route('admin.berita-acara-pemeriksaan.index') }}" class="btn btn-sm btn-secondary"><i class="bi-arrow-left me-1"></i> Kembali</a>
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
                $("select[name=terlapor], select.pemeriksa").html(html);
            }
        });
        $("select[name=terlapor], select.pemeriksa").select2();
    });

    // Tambah Pemeriksa
    $(document).on("click", "#tim-pemeriksa .btn-add-row", function(e) {
        e.preventDefault();
        var pemeriksa = $("#tim-pemeriksa select.pemeriksa")[0];
        var html = '';
        html += '<div class="row mt-3">';
        html += '<div class="col">';
        html += '<select name="pemeriksa[]" class="form-select form-select-sm pemeriksa">';
        html += $(pemeriksa).html();
        html += '</select>';
        html += '</div>';
        html += '<div class="col-auto">';
        html += '<div class="btn-group">';
        html += '<a href="#" class="btn btn-sm btn-success btn-add-row" title="Tambah"><i class="bi-plus"></i></a>';
        html += '<a href="#" class="btn btn-sm btn-danger btn-delete-row" title="Hapus"><i class="bi-trash"></i></a>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        $("#tim-pemeriksa").append(html);
        Spandiv.Select2("select.pemeriksa");
    });

    // Hapus Pemeriksa
    $(document).on("click", "#tim-pemeriksa .btn-delete-row", function(e) {
        e.preventDefault();
        if($("#tim-pemeriksa .row").length > 1) {
            var rows = $(this).parents(".row");
            rows[0].remove();
        }
        else $("#tim-pemeriksa select").val(null).trigger("change");
    });

    // Tambah Pertanyaan dan Jawaban
    $(document).on("click", "#qna .btn-add-row", function(e) {
        e.preventDefault();
        var html = '';
        html += '<div class="row mt-3">';
        html += '<div class="col">';
        html += '<textarea name="pertanyaan[]" class="form-control form-control-sm" rows="3" placeholder="Pertanyaan"></textarea>';
        html += '</div>';
        html += '<div class="col">';
        html += '<textarea name="jawaban[]" class="form-control form-control-sm" rows="3" placeholder="Jawaban"></textarea>';
        html += '</div>';
        html += '<div class="col-auto">';
        html += '<div class="btn-group">';
        html += '<a href="#" class="btn btn-sm btn-success btn-add-row" title="Tambah"><i class="bi-plus"></i></a>';
        html += '<a href="#" class="btn btn-sm btn-danger btn-delete-row" title="Hapus"><i class="bi-trash"></i></a>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        $("#qna").append(html);
    });

    // Hapus Pertanyaan dan Jawaban
    $(document).on("click", "#qna .btn-delete-row", function(e) {
        e.preventDefault();
        if($("#qna .row").length > 1) {
            var rows = $(this).parents(".row");
            rows[0].remove();
        }
        else $("#qna textarea").val(null);
    });
</script>

@endsection

@section('css')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">

@endsection