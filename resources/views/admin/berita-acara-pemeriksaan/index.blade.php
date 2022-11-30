@extends('faturhelper::layouts/admin/main')

@section('title', 'Kelola Berita Acara Pemeriksaan')

@section('content')

<div class="d-sm-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-2 mb-sm-0">Kelola Berita Acara Pemeriksaan</h1>
    <div class="btn-group">
        <a href="{{ route('admin.berita-acara-pemeriksaan.create') }}" class="btn btn-sm btn-primary"><i class="bi-plus me-1"></i> Tambah Berita Acara Pemeriksaan</a>
    </div>
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
                    <table class="table table-sm table-hover table-bordered" id="datatable">
                        <thead class="bg-light">
                            <tr>
                                <th width="30"><input type="checkbox" class="form-check-input checkbox-all"></th>
                                <th>Terlapor</th>
                                <th width="80">Tanggal</th>
                                <th width="60">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($berita as $b)
                            <tr>
                                <td align="center"><input type="checkbox" class="form-check-input checkbox-one"></td>
                                <td>
                                    {{ fullname($b->terlapor['nama'], $b->terlapor['gelar_depan'], $b->terlapor['gelar_belakang']) }}
                                    <br>
                                    <span class="small text-muted">{{ $b->terlapor['nip'] }}</span>
                                </td>
                                <td>
                                    <span class="d-none">{{ $b->tanggal }}</span>
                                    {{ date('d/m/Y', strtotime($b->tanggal)) }}
                                    <br>
                                    <span class="small text-muted">{{ date('H:i', strtotime($b->jam)) }} WIB</span>
                                </td>
                                <td align="center">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.berita-acara-pemeriksaan.print', ['id' => $b->id]) }}" class="btn btn-sm btn-info" data-bs-toggle="tooltip" title="Cetak" target="_blank"><i class="bi-printer"></i></a>
                                        <a href="{{ route('admin.berita-acara-pemeriksaan.edit', ['id' => $b->id]) }}" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" title="Edit"><i class="bi-pencil"></i></a>
                                        <a href="#" class="btn btn-sm btn-danger btn-delete" data-id="{{ $b->id }}" data-bs-toggle="tooltip" title="Hapus"><i class="bi-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
		</div>
	</div>
</div>

<form class="form-delete d-none" method="post" action="{{ route('admin.berita-acara-pemeriksaan.delete') }}">
    @csrf
    <input type="hidden" name="id">
</form>

@endsection

@section('js')

<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript">
    // DataTable
    Spandiv.DataTable("#datatable");

    // Button Delete
    Spandiv.ButtonDelete(".btn-delete", ".form-delete");
</script>

@endsection

@section('css')

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">

@endsection