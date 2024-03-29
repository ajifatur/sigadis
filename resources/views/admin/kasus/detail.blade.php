@extends('faturhelper::layouts/admin/main')

@section('title', 'Detail Kasus')

@section('content')

<div class="d-sm-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Detail Kasus</h1>
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
                <ul class="list-group list-group-flush mb-3">
                    <li class="list-group-item d-sm-flex justify-content-between p-0">
                        <strong>Terduga:</strong>
                        <div>{{ $kasus->terduga_nama }}</div>
                    </li>
                    <li class="list-group-item d-sm-flex justify-content-between p-0">
                        <strong>Dugaan Pelanggaran:</strong>
                        <div>{{ $kasus->dugaan_pelanggaran }}</div>
                    </li>
                </ul>
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-bordered">
                        <thead class="bg-light text-center">
                            <tr>
                                <th width="30">No</th>
                                <th>Tahapan</th>
                                <th width="150">Status</th>
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
                                    {{ $surat_panggilan_1 != null ? date('d/m/Y', strtotime($surat_panggilan_1->tanggal_surat)) : '-' }}
                                    <hr class="my-1">
                                    Pemanggilan:
                                    <br>
                                    {{ $surat_panggilan_1 != null ? date('d/m/Y', strtotime($surat_panggilan_1->tanggal)) : '-' }}
                                </td>
                                <td>
                                    <div class="btn-group">
                                        @if($surat_panggilan_1 == null)
                                            <a href="{{ route('admin.surat-panggilan.create', ['id' => $kasus->id, 'panggilan' => 1]) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Tambah"><i class="bi-plus"></i></a>
                                        @else
                                            <a href="{{ route('admin.surat-panggilan.print', ['id' => $surat_panggilan_1->id]) }}" class="btn btn-sm btn-info" data-bs-toggle="tooltip" title="Cetak" target="_blank"><i class="bi-printer"></i></a>
                                            <a href="{{ route('admin.surat-panggilan.edit', ['id' => $kasus->id, 'surat_id' => $surat_panggilan_1->id, 'panggilan' => 1]) }}" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" title="Edit"><i class="bi-pencil"></i></a>
                                            <a href="#" class="btn btn-sm btn-danger btn-delete-surat-panggilan" data-id="{{ $surat_panggilan_1->id }}" data-bs-toggle="tooltip" title="Hapus"><i class="bi-trash"></i></a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td align="right">2</td>
                                <td>Surat Panggilan II</td>
                                <td><span class="{{ $surat_panggilan_2 ? 'fst-italic text-success' : '' }}">{{ $surat_panggilan_2 ? 'Sudah dibuat' : '-' }}</span></td>
                                <td>
                                    @if($surat_panggilan_2 != null)
                                        Surat:
                                        <br>
                                        {{ date('d/m/Y', strtotime($surat_panggilan_2->tanggal_surat)) }}
                                        <hr class="my-1">
                                        Pemanggilan:
                                        <br>
                                        {{ date('d/m/Y', strtotime($surat_panggilan_2->tanggal)) }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        @if($surat_panggilan_1 && $surat_panggilan_2 == null && $bap == null)
                                            <a href="{{ route('admin.surat-panggilan.create', ['id' => $kasus->id, 'panggilan' => 2]) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Tambah"><i class="bi-plus"></i></a>
                                        @elseif($surat_panggilan_1 && $surat_panggilan_2)
                                            <a href="{{ route('admin.surat-panggilan.print', ['id' => $surat_panggilan_2->id]) }}" class="btn btn-sm btn-info" data-bs-toggle="tooltip" title="Cetak" target="_blank"><i class="bi-printer"></i></a>
                                            <a href="{{ route('admin.surat-panggilan.edit', ['id' => $kasus->id, 'surat_id' => $surat_panggilan_2->id, 'panggilan' => 2]) }}" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" title="Edit"><i class="bi-pencil"></i></a>
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
                                <td><span class="{{ $bap ? 'fst-italic text-success' : '' }}">{{ $bap ? 'Sudah dibuat' : '-' }}</span></td>
                                <td>{{ $bap ? date('d/m/Y', strtotime($bap->tanggal)) : '-' }}</td>
                                <td>
                                    <div class="btn-group">
                                        @if($surat_panggilan_1 && $bap == null)
                                            <a href="{{ route('admin.bap.create', ['id' => $kasus->id]) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Tambah"><i class="bi-plus"></i></a>
                                        @elseif($surat_panggilan_1 && $bap)
                                            <a href="{{ route('admin.bap.print', ['id' => $bap->id]) }}" class="btn btn-sm btn-info" data-bs-toggle="tooltip" title="Cetak" target="_blank"><i class="bi-printer"></i></a>
                                            <a href="{{ route('admin.bap.edit', ['id' => $kasus->id, 'bap_id' => $bap->id]) }}" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" title="Edit"><i class="bi-pencil"></i></a>
                                            <a href="#" class="btn btn-sm btn-danger btn-delete-bap" data-id="{{ $bap->id }}" data-bs-toggle="tooltip" title="Hapus"><i class="bi-trash"></i></a>
                                        @else
                                            -
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td align="right">4</td>
                                <td>Laporan Hasil Pemeriksaan</td>
                                <td><span class="{{ $lhp ? 'fst-italic text-success' : '' }}">{{ $lhp ? 'Sudah dibuat' : '-' }}</span></td>
                                <td>{{ $lhp ? date('d/m/Y', strtotime($lhp->tanggal_surat)) : '-' }}</td>
                                <td>
                                    <div class="btn-group">
                                        @if($bap && $lhp == null)
                                            <a href="{{ route('admin.lhp.create', ['id' => $kasus->id]) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Tambah"><i class="bi-plus"></i></a>
                                        @elseif($bap && $lhp)
                                            <a href="{{ route('admin.lhp.print', ['id' => $lhp->id]) }}" class="btn btn-sm btn-info" data-bs-toggle="tooltip" title="Cetak" target="_blank"><i class="bi-printer"></i></a>
                                            <a href="{{ route('admin.lhp.edit', ['id' => $kasus->id, 'lhp_id' => $lhp->id]) }}" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" title="Edit"><i class="bi-pencil"></i></a>
                                            <a href="#" class="btn btn-sm btn-danger btn-delete-lhp" data-id="{{ $lhp->id }}" data-bs-toggle="tooltip" title="Hapus"><i class="bi-trash"></i></a>
                                        @else
                                            -
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td align="right">5</td>
                                <td>
                                    Keputusan Pembebasan Sementara dari Tugas Jabatannya
                                    <br>
                                    <small class="text-danger">Untuk Hukuman Disiplin Berat</small>
                                </td>
                                <td><span class="{{ $kpts ? 'fst-italic text-success' : '' }}">{{ $kpts ? 'Sudah dibuat' : '-' }}</span></td>
                                <td>{{ $kpts ? date('d/m/Y', strtotime($kpts->tanggal_ditetapkan)) : '-' }}</td>
                                <td>
                                    <div class="btn-group">
                                        @if($bap && $kpts == null)
                                            <a href="{{ route('admin.kpts.create', ['id' => $kasus->id]) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Tambah"><i class="bi-plus"></i></a>
                                        @elseif($bap && $kpts)
                                            <a href="{{ route('admin.kpts.print', ['id' => $kpts->id]) }}" class="btn btn-sm btn-info" data-bs-toggle="tooltip" title="Cetak" target="_blank"><i class="bi-printer"></i></a>
                                            <a href="{{ route('admin.kpts.edit', ['id' => $kasus->id, 'kpts_id' => $kpts->id]) }}" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" title="Edit"><i class="bi-pencil"></i></a>
                                            <a href="#" class="btn btn-sm btn-danger btn-delete-kpts" data-id="{{ $kpts->id }}" data-bs-toggle="tooltip" title="Hapus"><i class="bi-trash"></i></a>
                                        @else
                                            -
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td align="right">6</td>
                                <td>Keputusan Hukuman Disiplin</td>
                                <td><span class="{{ $lhp ? 'fst-italic text-success' : '' }}">{{ $kephukdis ? 'Sudah dibuat' : '-' }}</span></td>
                                <td>{{ $kephukdis ? date('d/m/Y', strtotime($kephukdis->tanggal_ditetapkan)) : '-' }}</td>
                                <td>
                                    <div class="btn-group">
                                        @if($bap && $kephukdis == null)
                                            <a href="{{ route('admin.kephukdis.create', ['id' => $kasus->id]) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Tambah"><i class="bi-plus"></i></a>
                                        @elseif($bap && $kephukdis)
                                            <a href="{{ route('admin.kephukdis.print', ['id' => $kephukdis->id]) }}" class="btn btn-sm btn-info" data-bs-toggle="tooltip" title="Cetak" target="_blank"><i class="bi-printer"></i></a>
                                            <a href="{{ route('admin.kephukdis.edit', ['id' => $kasus->id, 'kephukdis_id' => $kephukdis->id]) }}" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" title="Edit"><i class="bi-pencil"></i></a>
                                            <a href="#" class="btn btn-sm btn-danger btn-delete-kephukdis" data-id="{{ $kephukdis->id }}" data-bs-toggle="tooltip" title="Hapus"><i class="bi-trash"></i></a>
                                        @else
                                            -
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td align="right">7</td>
                                <td>Surat Panggilan untuk Menerima Keputusan Hukuman Disiplin</td>
                                <td><span class="{{ $lhp ? 'fst-italic text-success' : '' }}">{{ $spmk ? 'Sudah dibuat' : '-' }}</span></td>
                                <td>
                                    @if($spmk)
                                        Surat:
                                        <br>
                                        {{ $spmk != null ? date('d/m/Y', strtotime($spmk->tanggal_surat)) : '-' }}
                                        <hr class="my-1">
                                        Pemanggilan:
                                        <br>
                                        {{ $spmk != null ? date('d/m/Y', strtotime($spmk->tanggal_menghadap)) : '-' }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        @if($kephukdis && $spmk == null)
                                            <a href="{{ route('admin.spmk.create', ['id' => $kasus->id]) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Tambah"><i class="bi-plus"></i></a>
                                        @elseif($kephukdis && $spmk)
                                            <a href="{{ route('admin.spmk.print', ['id' => $spmk->id]) }}" class="btn btn-sm btn-info" data-bs-toggle="tooltip" title="Cetak" target="_blank"><i class="bi-printer"></i></a>
                                            <a href="{{ route('admin.spmk.edit', ['id' => $kasus->id, 'spmk_id' => $spmk->id]) }}" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" title="Edit"><i class="bi-pencil"></i></a>
                                            <a href="#" class="btn btn-sm btn-danger btn-delete-spmk" data-id="{{ $spmk->id }}" data-bs-toggle="tooltip" title="Hapus"><i class="bi-trash"></i></a>
                                        @else
                                            -
                                        @endif
                                    </div>
                                </td>
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

<form class="form-delete-bap d-none" method="post" action="{{ route('admin.bap.delete') }}">
    @csrf
    <input type="hidden" name="id">
</form>

<form class="form-delete-lhp d-none" method="post" action="{{ route('admin.lhp.delete') }}">
    @csrf
    <input type="hidden" name="id">
</form>

<form class="form-delete-kpts d-none" method="post" action="{{ route('admin.kpts.delete') }}">
    @csrf
    <input type="hidden" name="id">
</form>

<form class="form-delete-kephukdis d-none" method="post" action="{{ route('admin.kephukdis.delete') }}">
    @csrf
    <input type="hidden" name="id">
</form>

<form class="form-delete-spmk d-none" method="post" action="{{ route('admin.spmk.delete') }}">
    @csrf
    <input type="hidden" name="id">
</form>

@endsection

@section('js')

<script type="text/javascript">
    // Button Delete
    Spandiv.ButtonDelete(".btn-delete-surat-panggilan", ".form-delete-surat-panggilan");
    Spandiv.ButtonDelete(".btn-delete-bap", ".form-delete-bap");
    Spandiv.ButtonDelete(".btn-delete-lhp", ".form-delete-lhp");
    Spandiv.ButtonDelete(".btn-delete-kpts", ".form-delete-kpts");
    Spandiv.ButtonDelete(".btn-delete-kephukdis", ".form-delete-kephukdis");
    Spandiv.ButtonDelete(".btn-delete-spmk", ".form-delete-spmk");
</script>

@endsection

@section('css')

<style>
    .table tr td {vertical-align: top!important;}
</style>

@endsection