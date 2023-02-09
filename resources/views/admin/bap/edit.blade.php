@extends('faturhelper::layouts/admin/main')

@section('title', 'Edit Berita Acara Pemeriksaan')

@section('content')

<div class="d-sm-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Edit Berita Acara Pemeriksaan</h1>
</div>
<div class="row">
	<div class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ route('admin.bap.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $bap->id }}">
                    <input type="hidden" name="kasus_id" value="{{ $kasus->id }}">
                    <input type="hidden" name="terlapor" value="{{ $kasus->terduga }}">
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Terduga / Terlapor</label>
                        <div class="col-lg-10 col-md-9">
                            <input type="text" class="form-control form-control-sm" value="{{ $kasus->terduga_nama }} ({{ $kasus->terduga_nip }})" disabled>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Tanggal <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <div class="input-group input-group-sm">
                                <input type="text" name="tanggal" class="form-control form-control-sm {{ $errors->has('tanggal') ? 'border-danger' : '' }}" value="{{ date('d/m/Y', strtotime($bap->tanggal)) }}" autocomplete="off">
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
                                <input class="form-check-input" type="radio" name="pemeriksa" id="pemeriksa-1" value="1" {{ $bap->pemeriksa == '1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="pemeriksa-1">Atasan Langsung</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pemeriksa" id="pemeriksa-2" value="2" {{ $bap->pemeriksa == '2' ? 'checked' : '' }}>
                                <label class="form-check-label" for="pemeriksa-2">Tim Pemeriksa</label>
                            </div>
                            @if($errors->has('pemeriksa'))
                            <div class="small text-danger">{{ $errors->first('pemeriksa') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3 {{ $bap->pemeriksa == '1' ? '' : 'd-none' }}" id="atasan-langsung">
                        @if($atasan)
                        <label class="col-lg-2 col-md-3 col-form-label">Atasan Langsung</label>
                        <div class="col-lg-10 col-md-9">
                            <input type="text" class="form-control form-control-sm" value="{{ $atasan->nama }} ({{ $atasan->nip }})" disabled>
                        </div>
                        @endif
                    </div>
                    <div class="row mb-3 {{ $bap->pemeriksa == '2' ? '' : 'd-none' }}" id="tim-pemeriksa">
                        <label class="col-lg-2 col-md-3 col-form-label">Tim Pemeriksa</label>
                        <div class="col-lg-10 col-md-9">
                            <input type="hidden" class="tim-pemeriksa-nip" value="{{ implode(',', $bap->tim_pemeriksa->pluck('pemeriksa')->toArray()) }}">
                            <select name="tim_pemeriksa[]" class="form-select form-select-sm tim-pemeriksa" multiple="multiple">
                                <option value="" disabled>--Pilih--</option>
                            </select>
                            <div class="small text-muted">Nama yang pertama adalah Ketua Tim Pemeriksa.</div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Wewenang <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="wewenang" id="wewenang-1" value="1" {{ $bap->wewenang == '1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="wewenang-1">Atasan Langsung</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="wewenang" id="wewenang-2" value="2" {{ $bap->wewenang == '2' ? 'checked' : '' }}>
                                <label class="form-check-label" for="wewenang-2">Surat Perintah</label>
                            </div>
                            @if($errors->has('wewenang'))
                            <div class="small text-danger">{{ $errors->first('wewenang') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3 {{ $bap->wewenang == '2' ? '' : 'd-none' }}" id="surat-perintah">
                        <label class="col-lg-2 col-md-3 col-form-label">Surat Perintah <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <input type="text" name="surat_perintah" class="form-control form-control-sm" value="{{ $bap->surat_perintah }}">
                            @if($errors->has('surat_perintah'))
                            <div class="small text-danger">{{ $errors->first('surat_perintah') }}</div>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Pelanggaran <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <select name="pelanggaran" class="form-select form-select-sm">
                                <option value="" disabled selected>--Pilih--</option>
                                @foreach($pelanggaran as $p)
                                <option value="{{ $p->id }}" {{ $bap->pelanggaran_id == $p->id ? 'selected' : '' }}>Pasal {{ $p->kl->pasal }} Huruf {{ $p->kl->huruf }} {{ $p->kl->angka != '' ? 'Angka '.$p->kl->angka : '' }} : {{ $p->kl->keterangan }} {{ $p->keterangan != '' ? '- '.$p->keterangan : '' }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('pelanggaran'))
                            <div class="small text-danger">{{ $errors->first('pelanggaran') }}</div>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Pertanyaan dan Jawaban <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <div class="col" id="qna">
                                @foreach($bap->qna['pertanyaan'] as $key=>$p)
                                <div class="row mb-3">
                                    <div class="col">
                                        <textarea name="pertanyaan[]" class="form-control form-control-sm" rows="3" placeholder="Pertanyaan">{{ $bap->qna['pertanyaan'][$key] }}</textarea>
                                    </div>
                                    <div class="col">
                                        <textarea name="jawaban[]" class="form-control form-control-sm" rows="3" placeholder="Jawaban">{{ $bap->qna['jawaban'][$key] }}</textarea>
                                    </div>
                                    <div class="col-auto">
                                        <div class="btn-group">
                                            <a href="#" class="btn btn-sm btn-success btn-add-row" title="Tambah"><i class="bi-plus"></i></a>
                                            <a href="#" class="btn btn-sm btn-danger btn-delete-row" title="Hapus"><i class="bi-trash"></i></a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
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
    Spandiv.DatePicker("input[name=tanggal]");

    // Select2 Server Side
    $(window).on("load", function() {
        $.ajax({
            type: "get",
            url: "{{ route('api.simpeg') }}",
            success: function(response) {
                var html = '';
                for(var i = 0; i < response.length; i++) {
                    html += '<option value="' + response[i].nip + '">' + response[i].gelar_depan + response[i].nama + (response[i].gelar_belakang != '' ? ', ' + response[i].gelar_belakang : response[i].gelar_belakang) + ' (' + response[i].nip + ')' + '</option>';
                }
                $("select.tim-pemeriksa").html(html);
                $($("input.tim-pemeriksa-nip").val().split(",")).each(function(key,value) {
                    $("select.tim-pemeriksa option[value=" + value + "]").prop("selected", true);
                });
            }
        });
        $("select.tim-pemeriksa, select[name=pelanggaran]").select2();
    });
    $("select.tim-pemeriksa").on("select2:select", function(evt) {
        var element = evt.params.data.element;
        var $element = $(element);
        $element.detach();
        $(this).append($element);
        $(this).trigger("change");
    });

    // Atasan langsung / tim pemeriksa
    $(document).on("change", "input[name=pemeriksa]", function() {
        var value = $("input[name=pemeriksa]:checked").val();
        if(value == 1) {
            $("#atasan-langsung").removeClass("d-none");
            $("#tim-pemeriksa").addClass("d-none");
            $("select.tim-pemeriksa").val(null);
            $("select.tim-pemeriksa").trigger("change");
            $("select.tim-pemeriksa option[value=" + "{{ $surat_panggilan_1->atasan }}" + "]").prop("selected", true);
            $("select.tim-pemeriksa").trigger("change");
        }
        else if(value == 2) {
            $("#atasan-langsung").addClass("d-none");
            $("#tim-pemeriksa").removeClass("d-none");
        }
    });

    // Surat perintah
    $(document).on("change", "input[name=wewenang]", function() {
        var value = $("input[name=wewenang]:checked").val();
        value == 2 ? $("#surat-perintah").removeClass("d-none") : $("#surat-perintah").addClass("d-none");
    });

    // Tambah Pertanyaan dan Jawaban
    $(document).on("click", "#qna .btn-add-row", function(e) {
        e.preventDefault();
        var html = '';
        html += '<div class="row mb-3">';
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