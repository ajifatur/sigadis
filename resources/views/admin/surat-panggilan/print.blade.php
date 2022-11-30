<!DOCTYPE html>
<html lang="en">
<head>
    <title>Surat Panggilan {{ $surat->panggilan }} - {{ $surat->terlapor->nip_bar }}</title>
    <style>
        @page {margin: 0px;}
		html {margin: 0px;}
        body {margin: 40px 30px;}
        #judul {text-align: center; margin-bottom: 30px;}
        #judul div {margin-bottom: 5px; text-transform: uppercase;}
        #tabel-form {width: 100%; margin-bottom: 20px;}
        #tabel-form tr td {vertical-align: top;}
        #tabel-ttd {width: 100%; margin-bottom: 20px;}
        #tembusan {width: 100%;}
    </style>
</head>
<body>
    <div id="judul">
        <div>Rahasia</div>
        <div>Surat Panggilan {{ $surat->panggilan }}</div>
        <div>Nomor: .................................</div>
    </div>
    <table id="tabel-form">
        <tr>
            <td width="1%" rowspan="17">1.</td>
            <td width="99%" colspan="3">Bersama ini diminta dengan hormat kehadiran Saudara :</td>
        </tr>
        <tr>
            <td width="100">Nama</td>
            <td width="5">:</td>
            <td width="100%">{{ fullname($surat->terlapor->nama, $surat->terlapor->gelar_dpn, $surat->terlapor->gelar_blk) }}</td>
        </tr>
        <tr>
            <td>NIP</td>
            <td>:</td>
            <td>{{ $surat->terlapor->nip_bar }}</td>
        </tr>
        <tr>
            <td>Pangkat</td>
            <td>:</td>
            <?php
                $p = explode(' ', $surat->terlapor->pangkat);
                array_pop($p);
                $surat->terlapor->pangkat = implode(' ', $p);
            ?>
            <td>{{ $surat->terlapor->pangkat }}</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td>{{ $surat->terlapor->jabatan }}</td>
        </tr>
        <tr>
            <td>Unit Kerja</td>
            <td>:</td>
            <td>{{ $surat->terlapor->nama_unit }}</td>
        </tr>
        <tr>
            <td colspan="3">untuk menghadap kepada</td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>{{ fullname($surat->menghadap_kepada->nama, $surat->menghadap_kepada->gelar_dpn, $surat->menghadap_kepada->gelar_blk) }}</td>
        </tr>
        <tr>
            <td>NIP</td>
            <td>:</td>
            <td>{{ $surat->menghadap_kepada->nip_bar }}</td>
        </tr>
        <tr>
            <td>Pangkat</td>
            <td>:</td>
            <?php
                $p = explode(' ', $surat->menghadap_kepada->pangkat);
                array_pop($p);
                $surat->menghadap_kepada->pangkat = implode(' ', $p);
            ?>
            <td>{{ $surat->menghadap_kepada->pangkat }}</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td>{{ $surat->menghadap_kepada->jabatan }}</td>
        </tr>
        <tr>
            <td colspan="3">pada</td>
        </tr>
        <tr>
            <td>Hari</td>
            <td>:</td>
            <td>{{ $surat->hariIndo }}</td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td>:</td>
            <td>{{ $surat->tanggalIndo }}</td>
        </tr>
        <tr>
            <td>Jam</td>
            <td>:</td>
            <td>{{ date('H:i', strtotime($surat->jam)) }} WIB</td>
        </tr>
        <tr>
            <td>Tempat</td>
            <td>:</td>
            <td>{{ $surat->tempat }}</td>
        </tr>
        <tr>
            <td colspan="3">untuk {{ $surat->status == 1 ? 'diperiksa' : 'dimintai keterangan' }} sehubungan dengan dugaan pelanggaran disiplin {{ $surat->pelanggaran }}.</td>
        </tr>
        <tr>
            <td>2.</td>
            <td colspan="3">Demikian untuk dilaksanakan.</td>
        </tr>
    </table>
    <table id="tabel-ttd">
        <tr>
            <td width="50%"></td>
            <td width="50%" align="center">
                <div>Semarang, {{ $surat->tanggalIndo }}</div>
                <div>{{ $surat->atasan == 1 ? 'Atasan langsung' : 'Ketua Tim Pemeriksa' }}</div>
                <br><br><br><br>
                <div>{{ fullname($surat->ttd->nama, $surat->ttd->gelar_dpn, $surat->ttd->gelar_blk) }}</div>
                <div>NIP {{ $surat->ttd->nip_bar }}</div>
            </td>
        </tr>
    </table>
    <div id="tembusan">
        Tembusan Yth :
        <ol>
            <li>Rektor</li>
            <li>Wakil Rektor I, II, III</li>
        </ol>
    </div>
</body>
</html>