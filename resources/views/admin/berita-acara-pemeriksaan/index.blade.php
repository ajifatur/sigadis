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
                        <tbody></tbody>
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
    Spandiv.DataTable("#datatable", {
        serverSide: true,
        pageLength: 25,
        url: "{{ route('admin.berita-acara-pemeriksaan.index') }}",
        columns: [
            {data: 'checkbox', name: 'checkbox', className: 'text-center'},
            {data: 'terlapor_text', name: 'terlapor_text'},
            {data: 'datetime', name: 'datetime'},
            {data: 'options', name: 'options', className: 'text-center', orderable: false},
        ],
        order: [2, 'desc']
    });

    // Button Delete
    Spandiv.ButtonDelete(".btn-delete", ".form-delete");
</script>

@endsection

@section('css')

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">

@endsection