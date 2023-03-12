<!DOCTYPE html>
<html lang="en">
<head>
    <title>Keputusan Pembebasan Tugas Sementara - {{ $kpts->kasus->terduga_nip }}</title>
    <style>
        @page {margin: 0px;}
		html {margin: 0px;}
        body {margin: 40px 30px;}
        #judul, #memutuskan {text-align: center; margin-bottom: 30px;}
        #judul div {margin-bottom: 5px; text-transform: uppercase;}
        #memutuskan {margin-top: 20px;}
        .tabel-form {width: 100%}
        .tabel-form tr td {vertical-align: top; text-align: justify;}
        .tabel-ttd {margin-top: 20px;}
        #tembusan {width: 100%;}
    </style>
</head>
<body>
    <div id="judul" class="text-uppercase">
        <div>Keputusan {{ $kpts->keputusan == 1 ? 'Menteri Pendidikan, Kebudayaan, Riset dan Teknologi' : 'Rektor Universitas Negeri Semarang' }}</div>
        <div>Nomor ..............................</div>
        <br>
        <div>Dengan Rahmat Tuhan Yang Maha Esa</div>
        <div>{{ $kpts->keputusan == 1 ? 'Menteri Pendidikan, Kebudayaan, Riset dan Teknologi' : 'Rektor Universitas Negeri Semarang' }}</div>
    </div>
    <table class="tabel-form">
        <tr>
            <td width="70">Menimbang</td>
            <td width="5">:</td>
            <td colspan="2">bahwa untuk kelancaran pemeriksaan terhadap Sdr. {{ $kpts->terlapor_json->nama }}, NIP {{ $kpts->terlapor_json->nip }}, atas dugaan pelanggaran disiplin terhadap Pasal {{ $kpts->pelanggaran->kl->pasal }} Huruf {{ $kpts->pelanggaran->kl->huruf }} {{ $kpts->pelanggaran->kl->angka != '' ? 'Angka '.$kpts->pelanggaran->kl->angka : '' }}, Peraturan Pemerintah Nomor 94 Tahun 2021 tentang Disiplin Pegawai Negeri Sipil yang ancaman hukumannya berupa hukuman disiplin tingkat berat, perlu menetapkan Keputusan tentang Pembebasan Sementara dari Tugas Jabatannya;</td>
        </tr>
        <tr>
            <td>Mengingat</td>
            <td>:</td>
            <td width="5">1.</td>
            <td width="100%">Undang-Undang Nomor 5 Tahun 2014 tentang Aparatur Sipil Negara;</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>2.</td>
            <td>Peraturan Pemerintah Nomor 94 Tahun 2021 tentang Disiplin Pegawai Negeri Sipil;</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>3.</td>
            <td>Peraturan Badan Kepegawaian Negara Nomor 6 Tahun 2022 tentang Peraturan Pelaksanaan Peraturan Pemerintah Nomor 94 Tahun 2021 tentang Disiplin Pegawai Negeri Sipil;</td>
        </tr>
    </table>
    <div id="memutuskan">MEMUTUSKAN:</div>
    <table class="tabel-form">
        <tr>
            <td width="70">Menetapkan</td>
            <td width="5">:</td>
            <td width="100%"></td>
        </tr>
        <tr>
            <td>KESATU</td>
            <td>:</td>
            <td>
                Membebaskan sementara dari tugas jabatan Saudara:<br>
                <table class="tabel-form">
                    <tr>
                        <td width="80">Nama</td>
                        <td width="5">:</td>
                        <td width="100%">{{ $kpts->terlapor_json->nama }}</td>
                    </tr>
                    <tr>
                        <td>NIP</td>
                        <td>:</td>
                        <td>{{ $kpts->terlapor_json->nip }}</td>
                    </tr>
                    <tr>
                        <td>Pangkat</td>
                        <td>:</td>
                        <td>{{ $kpts->terlapor_json->pangkat }}</td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td>:</td>
                        <td>{{ $kpts->terlapor_json->jabatan }}</td>
                    </tr>
                    <tr>
                        <td>Unit Kerja</td>
                        <td>:</td>
                        <td>{{ $kpts->terlapor_json->unit }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>KEDUA</td>
            <td>:</td>
            <td>Selama menjalani pembebasan sementara dari tugas jabatannya sebagaimana tersebut pada Diktum KESATU, kepada Sdr. {{ $kpts->terlapor_json->nama }}, tersebut tetap diberikan hak-hak kepegawaiannya sesuai ketentuan peraturan perundang-undangan.</td>
        </tr>
        <tr>
            <td>KETIGA</td>
            <td>:</td>
            <td>Keputusan ini mulai berlaku pada tanggal ditetapkan.</td>
        </tr>
        <tr>
            <td>KEEMPAT</td>
            <td>:</td>
            <td>Keputusan ini disampaikan kepada yang bersangkutan untuk dilaksanakan sebagaimana mestinya.</td>
        </tr>
    </table>
    <table class="tabel-form tabel-ttd">
        <tr>
            <td width="55%"></td>
            <td width="45%">
                <div>Ditetapkan di {{ $kpts->tempat_ditetapkan }}</div>
                <div>pada tanggal {{ \Ajifatur\Helpers\DateTimeExt::full($kpts->tanggal_ditetapkan) }}</div>
                <br>
                <div>Atasan langsung,</div>
                <br><br><br><br>
                <div>{{ $kpts->atasan_json->nama }}</div>
                <div>NIP {{ $kpts->atasan_json->nip }}</div>
            </td>
        </tr>
    </table>
    <div id="tembusan">
        Tembusan Yth :
        <ol>
            @foreach($tembusan as $t)
            <li>{{ $t->tembusan->name }}</li>
            @endforeach
        </ol>
    </div>
</body>
</html>