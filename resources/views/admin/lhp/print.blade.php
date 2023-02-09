<!DOCTYPE html>
<html lang="en">
<head>
    <title>Laporan Hasil Pemeriksaan - {{ $lhp->kasus->terduga_nip }}</title>
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
    <div id="tanggal-surat">{{ $lhp->tempat_surat }}, {{ \Ajifatur\Helpers\DateTimeExt::full($lhp->tanggal_surat) }}</div>
    <div id="penerima-surat">
        Kepada
        <br>
        Yth. {{ $lhp->penerima_surat_json->nama }}
        <br>
        di {{ $lhp->tempat_penerima_surat }}
    </div>
    <div id="judul">
        <div>Rahasia</div>
    </div>
    <table class="tabel-form">
        <tr>
            <td colspan="3">Dengan ini dilaporkan dengan hormat, bahwa berdasarkan hasil pemeriksaan pada hari {{ \Ajifatur\Helpers\DateTimeExt::day($lhp->tanggal_pemeriksaan) }}, tanggal {{ date('j', strtotime($lhp->tanggal_pemeriksaan)) }}, bulan {{ \Ajifatur\Helpers\DateTimeExt::month(date('m', strtotime($lhp->tanggal_pemeriksaan))) }}, tahun {{ date('Y', strtotime($lhp->tanggal_pemeriksaan)) }}, {{ $lhp->status_pelapor == 1 ? 'saya' : 'Tim Pemeriksa' }} telah melakukan pemeriksaan terhadap:</td>
        </tr>
        <tr>
            <td width="100">Nama</td>
            <td width="5">:</td>
            <td width="100%">{{ $lhp->terlapor_json->nama }}</td>
        </tr>
        <tr>
            <td>NIP</td>
            <td>:</td>
            <td>{{ $lhp->terlapor_json->nip }}</td>
        </tr>
        <tr>
            <td>Pangkat</td>
            <td>:</td>
            <td>{{ $lhp->terlapor_json->pangkat }}</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td>{{ $lhp->terlapor_json->jabatan }}</td>
        </tr>
        <tr>
            <td>Unit Kerja</td>
            <td>:</td>
            <td>{{ $lhp->terlapor_json->unit }}</td>
        </tr>
        <tr>
            <td colspan="3"><br>Berdasarkan hasil pemeriksaan, dapat kami laporkan sebagai berikut:</td>
        </tr>
    </table>
    <table class="tabel-form" border="1">
        <tr>
            <td>Bentuk Pelanggaran</td>
            <td>Waktu</td>
            <td>Tempat</td>
            <td>Faktor yang Memberatkan</td>
            <td>Faktor yang Meringankan</td>
            <td>Dampak Perbuatan</td>
        </tr>
        <tr>
            <td><br><br><br><br></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>
    <table class="tabel-form tabel-keterangan">
        <tr>
            <td width="5">1.</td>
            <td>Yang bersangkutan terbukti melakukan pelanggaran disiplin {{ $lhp->pelanggaran->kl->keterangan }} {{ $lhp->pelanggaran->keterangan != '' ? '- '.$lhp->pelanggaran->keterangan : '' }}, sehingga direkomendasikan untuk dijatuhi Hukuman Disiplin {{ $lhp->hukdis->jenis->nama }}: {{ $lhp->hukdis->nama }}.</td>
        </tr>
        <tr>
            <td>2.</td>
            <td>Kewenangan untuk menjatuhkan hukuman disiplin kepada PNS tersebut di atas merupakan kewenangan {{ $lhp->penerima_surat_json->jabatan }}.</td>
        </tr>
        <tr>
            <td colspan="2">Sehubungan dengan hal tersebut, disampaikan Berita Acara Pemeriksaan terhadap PNS yang bersangkutan untuk digunakan dalam penetapan keputusan penjatuhan Hukuman Disiplin.<br>Demikian disampaikan untuk dipergunakan sebagaimana mestinya.
            </td>
        </tr>
    </table>
    <table class="tabel-form tabel-ttd">
        <tr>
            <td width="55%"></td>
            <td width="45%">
                <div>Yang melaporkan</div>
                <div>{{ $lhp->status_pelapor == 1 ? 'Atasan Langsung' : 'Ketua Tim Pemeriksa' }},</div>
                <br><br><br><br>
                <div>{{ $lhp->pelapor_json->nama }}</div>
                <div>NIP {{ $lhp->pelapor_json->nip }}</div>
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