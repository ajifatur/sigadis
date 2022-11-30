@extends('faturhelper::layouts/admin/main')

@section('title', 'Kelola Surat Panggilan')

@section('content')

<div class="d-sm-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-2 mb-sm-0">Kelola Surat Panggilan</h1>
    <div class="btn-group">
        <a href="{{ route('admin.surat-panggilan.create') }}" class="btn btn-sm btn-primary"><i class="bi-plus me-1"></i> Tambah Surat Panggilan</a>
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
                                <th>Menghadap Kepada</th>
                                <th width="100">Panggilan</th>
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

<form class="form-delete d-none" method="post" action="{{ route('admin.surat-panggilan.delete') }}">
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
        url: "{{ route('admin.surat-panggilan.index') }}",
        columns: [
            {data: 'checkbox', name: 'checkbox', className: 'text-center'},
            {data: 'terlapor_text', name: 'terlapor_text'},
            {data: 'menghadap_kepada_text', name: 'menghadap_kepada_text'},
            {data: 'panggilan_text', name: 'panggilan_text'},
            {data: 'datetime', name: 'datetime'},
            {data: 'options', name: 'options', className: 'text-center', orderable: false},
        ],
        order: [4, 'desc']
    });

    // Button Delete
    Spandiv.ButtonDelete(".btn-delete", ".form-delete");
</script>

@endsection

@section('css')

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">

@endsection