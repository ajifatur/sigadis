@extends('faturhelper::layouts/admin/main')

@section('title', 'Kelola Keputusan Hukuman Disiplin')

@section('content')

<div class="d-sm-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-2 mb-sm-0">Kelola Keputusan Hukuman Disiplin</h1>
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
                                <th>Hukuman Disiplin</th>
                                <th width="80">Tanggal Keputusan</th>
                                <th width="40">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kephukdis as $k)
                            @php $terlapor = json_decode($k->terlapor_json); @endphp
                            <tr>
                                <td align="center"><input type="checkbox" class="form-check-input checkbox-one"></td>
                                <td>
                                    {{ $terlapor->nama }}
                                    <br>
                                    <span class="small text-muted">{{ $terlapor->nip }}</span>
                                </td>
                                <td>{{ $k->hukdis->nama }}</td>
                                <td>
                                    <span class="d-none">{{ $k->tanggal_ditetapkan }}</span>
                                    {{ date('d/m/Y', strtotime($k->tanggal_ditetapkan)) }}
                                </td>
                                <td align="center">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.kasus.detail', ['id' => $k->kasus_id]) }}" class="btn btn-sm btn-info" data-bs-toggle="tooltip" title="Lihat Detail"><i class="bi-eye"></i></a>
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

<form class="form-delete d-none" method="post" action="{{ route('admin.kasus.delete') }}">
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
<style>
    .table tr td {vertical-align: top!important;}
</style>

@endsection