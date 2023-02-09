<!DOCTYPE html>
<html lang="en">
<head>
    <title>Surat Panggilan Menerima Keputusan Hukdis - {{ $spmk->kasus->terduga_nip }}</title>
    <style>
        @page {margin: 0px;}
		html {margin: 0px;}
        body {margin: 40px 30px;}
        #tanggal-surat {text-align: right; margin-bottom: 20px;}
        #penerima-surat {text-align: left; margin-bottom: 20px;}
        #judul {text-align: center; margin-bottom: 30px;}
        #judul div {margin-bottom: 5px; text-transform: uppercase;}
        .tabel-form {width: 100%}
        .tabel-form tr td {vertical-align: top; text-align: justify;}
        .tabel-keterangan {margin-top: 10px;}
        .tabel-ttd {margin-top: 20px;}
        #tembusan {width: 100%;}
    </style>
</head>
<body>
    <div id="tanggal-surat">{{ $spmk->tempat_surat }}, {{ \Ajifatur\Helpers\DateTimeExt::full($spmk->tanggal_surat) }}</div>
    <div id="penerima-surat">
        Kepada
        <br>
        Yth. {{ $spmk->terlapor_json->nama }}
        <br>
        di {{ $spmk->tempat_penerima_surat }}
    </div>
    <div id="judul">
        <div>Rahasia</div>
    </div>
    <table class="tabel-form">
        <tr>
            <td colspan="3">Dengan ini diminta kehadiran Saudara, untuk menghadap kepada:</td>
        </tr>
        <tr>
            <td width="100">Nama</td>
            <td width="5">:</td>
            <td width="100%">{{ $spmk->menghadap_kepada_json->nama }}</td>
        </tr>
        <tr>
            <td>NIP</td>
            <td>:</td>
            <td>{{ $spmk->menghadap_kepada_json->nip }}</td>
        </tr>
        <tr>
            <td>Pangkat</td>
            <td>:</td>
            <td>{{ $spmk->menghadap_kepada_json->pangkat }}</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td>{{ $spmk->menghadap_kepada_json->jabatan }}</td>
        </tr>
        <tr>
            <td>Unit Kerja</td>
            <td>:</td>
            <td>{{ $spmk->menghadap_kepada_json->unit }}</td>
        </tr>
        <tr>
            <td colspan="3">pada</td>
        </tr>
        <tr>
            <td>Hari</td>
            <td>:</td>
            <td>{{ \Ajifatur\Helpers\DateTimeExt::day($spmk->tanggal_menghadap) }}</td>
        </tr>
        <tr>
            <td>Hari</td>
            <td>:</td>
            <td>{{ \Ajifatur\Helpers\DateTimeExt::full($spmk->tanggal_menghadap) }}</td>
        </tr>
        <tr>
            <td>Jam</td>
            <td>:</td>
            <td>{{ date('H:i', strtotime($spmk->jam_menghadap)) }} WIB</td>
        </tr>
        <tr>
            <td>Tempat</td>
            <td>:</td>
            <td>{{ $spmk->tempat_menghadap }}</td>
        </tr>
        <tr>
            <td colspan="3"><br>untuk menerima Keputusan {{ $spmk->keputusan->keputusan == 1 ? 'Menteri Pendidikan, Kebudayaan, Riset dan Teknologi' : 'Rektor Universitas Negeri Semarang' }}, Nomor {{ $spmk->keputusan->nomor }}, tanggal {{ \Ajifatur\Helpers\DateTimeExt::full($spmk->keputusan->tanggal_ditetapkan) }}, tentang penjatuhan hukuman disiplin {{ $spmk->hukdis->nama }}.<br>Demikian disampaikan untuk dilaksanakan.</td>
        </tr>
    </table>
    <table class="tabel-form tabel-ttd">
        <tr>
            <td width="55%"></td>
            <td width="45%">
                <div>{{ $spmk->atasan_json->jabatan }},</div>
                <br><br><br><br>
                <div>{{ $spmk->atasan_json->nama }}</div>
                <div>NIP {{ $spmk->atasan_json->nip }}</div>
            </td>
        </tr>
    </table>
    <div id="tembusan">
        Tembusan Yth :
        <ol>
            <li>Rektor</li>
            <li>Wakil Rektor Bid. Umum dan Keuangan</li>
        </ol>
    </div>
</body>
</html>