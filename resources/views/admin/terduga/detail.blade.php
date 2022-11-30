@extends('faturhelper::layouts/admin/main')

@section('title', 'Detail Terduga: '.$terduga->terduga_nama)

@section('content')

<div class="d-sm-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Detail Terduga: {{ $terduga->terduga_nama }}</h1>
</div>
<div class="row">
	<div class="col-12">
        <div class="card">
            <div class="card-body">
                @if(Session::get('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <div class="alert-message">{{ Session::get('message') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-bordered">
                        <thead class="bg-light text-center">
                            <tr>
                                <th width="30">No</th>
                                <th>Tahapan</th>
                                <th width="120">Status</th>
                                <th width="120">Tanggal</th>
                                <th width="60">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td align="right">1</td>
                                <td>Surat Panggilan I</td>
                                <td><em class="{{ $surat_panggilan_1 ? 'text-success' : 'text-danger' }}">{{ $surat_panggilan_1 ? 'Sudah dibuat' : 'Belum dibuat' }}</em></td>
                                <td>
                                    Surat:
                                    <br>
                                    {{ $surat_panggilan_1 != null ? date('d/m/Y', strtotime($surat_panggilan_1->created_at)) : '-' }}
                                    <hr class="my-1">
                                    Pemanggilan:
                                    <br>
                                    {{ $surat_panggilan_1 != null ? date('d/m/Y', strtotime($surat_panggilan_1->tanggal)) : '-' }}
                                </td>
                                <td>
                                    <div class="btn-group">
                                        @if($surat_panggilan_1 == null)
                                            <a href="{{ route('admin.surat-panggilan.create', ['id' => $terduga->id, 'panggilan' => 1]) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Tambah"><i class="bi-plus"></i></a>
                                        @else
                                            <a href="{{ route('admin.surat-panggilan.print', ['id' => $surat_panggilan_1->id]) }}" class="btn btn-sm btn-info" data-bs-toggle="tooltip" title="Cetak" target="_blank"><i class="bi-printer"></i></a>
                                            <a href="{{ route('admin.surat-panggilan.edit', ['id' => $terduga->id, 'surat_id' => $surat_panggilan_1->id, 'panggilan' => 1]) }}" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" title="Edit"><i class="bi-pencil"></i></a>
                                            <a href="#" class="btn btn-sm btn-danger btn-delete-surat-panggilan" data-id="{{ $surat_panggilan_1->id }}" data-bs-toggle="tooltip" title="Hapus"><i class="bi-trash"></i></a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td align="right">2</td>
                                <td>Surat Panggilan II</td>
                                <td><em class="{{ $surat_panggilan_2 ? 'text-success' : 'text-danger' }}">{{ $surat_panggilan_2 ? 'Sudah dibuat' : 'Belum dibuat' }}</em></td>
                                <td>
                                    Surat:
                                    <br>
                                    {{ $surat_panggilan_2 != null ? date('d/m/Y', strtotime($surat_panggilan_2->created_at)) : '-' }}
                                    <hr class="my-1">
                                    Pemanggilan:
                                    <br>
                                    {{ $surat_panggilan_2 != null ? date('d/m/Y', strtotime($surat_panggilan_2->tanggal)) : '-' }}
                                </td>
                                <td>
                                    <div class="btn-group">
                                        @if($surat_panggilan_1 && $surat_panggilan_2 == null)
                                            <a href="{{ route('admin.surat-panggilan.create', ['id' => $terduga->id, 'panggilan' => 2]) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Tambah"><i class="bi-plus"></i></a>
                                        @elseif($surat_panggilan_1 && $surat_panggilan_2)
                                            <a href="{{ route('admin.surat-panggilan.print', ['id' => $surat_panggilan_2->id]) }}" class="btn btn-sm btn-info" data-bs-toggle="tooltip" title="Cetak" target="_blank"><i class="bi-printer"></i></a>
                                            <a href="{{ route('admin.surat-panggilan.edit', ['id' => $terduga->id, 'surat_id' => $surat_panggilan_2->id, 'panggilan' => 2]) }}" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" title="Edit"><i class="bi-pencil"></i></a>
                                            <a href="#" class="btn btn-sm btn-danger btn-delete-surat-panggilan" data-id="{{ $surat_panggilan_2->id }}" data-bs-toggle="tooltip" title="Hapus"><i class="bi-trash"></i></a>
                                        @else
                                            -
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td align="right">3</td>
                                <td>Berita Acara Pemeriksaan</td>
                                <td><em class="text-danger">Belum</em></td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td align="right">4</td>
                                <td>Laporan Hasil Pemeriksaan</td>
                                <td><em class="text-danger">Belum</em></td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td align="right">5</td>
                                <td>Keputusan Pembebasan Sementara dari Tugas Jabatannya</td>
                                <td><em class="text-danger">Belum</em></td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td align="right">6</td>
                                <td>Keputusan Hukuman Disiplin</td>
                                <td><em class="text-danger">Belum</em></td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td align="right">7</td>
                                <td>Surat Panggilan untuk Menerima Keputusan Hukuman Disiplin</td>
                                <td><em class="text-danger">Belum</em></td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
	</div>
</div>

<form class="form-delete-surat-panggilan d-none" method="post" action="{{ route('admin.surat-panggilan.delete') }}">
    @csrf
    <input type="hidden" name="id">
</form>

@endsection

@section('js')

<script type="text/javascript">
    // Button Delete
    Spandiv.ButtonDelete(".btn-delete-surat-panggilan", ".form-delete-surat-panggilan");
</script>

@endsection

@section('css')

<style>
    .table tr td {vertical-align: top!important;}
</style>

@endsection