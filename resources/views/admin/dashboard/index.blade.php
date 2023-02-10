@extends('faturhelper::layouts/admin/main')

@section('title', 'Dashboard')

@section('content')

<div class="d-sm-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Dashboard</h1>
</div>
<div class="alert alert-success" role="alert">
    <div class="alert-message">
        <h4 class="alert-heading">Selamat Datang!</h4>
        <p class="mb-0">Selamat datang kembali <strong>{{ Auth::user()->name }}</strong> di {{ setting('name') }} ({{ setting('tagline') }}).</p>
    </div>
</div>
<div class="card shadow">
	<div class="card-body">
		<p class="card-text">Peraturan Pemerintah Nomor 94 Tahun 2021 tentang Disiplin Pegawai Negeri Sipil.</p>
		<a href="{{ asset('assets/pdf/PP Nomor 94 Tahun 2021.pdf') }}" class="btn btn-sm btn-primary" target="_blank"><i class="bi-download"></i> Unduh</a>
	</div>
</div>

@endsection