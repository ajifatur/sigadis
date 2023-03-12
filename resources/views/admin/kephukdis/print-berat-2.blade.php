<!DOCTYPE html>
<html lang="en">
<head>
    <title>Keputusan Hukuman Disiplin - {{ $kephukdis->kasus->terduga_nip }}</title>
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
        <div>Keputusan {{ $kephukdis->keputusan == 1 ? 'Menteri Pendidikan, Kebudayaan, Riset dan Teknologi' : 'Rektor Universitas Negeri Semarang' }}</div>
        <div>Nomor {{ $kephukdis->nomor }}</div>
        <br>
        <div>Dengan Rahmat Tuhan Yang Maha Esa</div>
        <div>{{ $kephukdis->keputusan == 1 ? 'Menteri Pendidikan, Kebudayaan, Riset dan Teknologi' : 'Rektor Universitas Negeri Semarang' }}</div>
    </div>
    <table class="tabel-form">
        <tr>
            <td width="70">Menimbang</td>
            <td width="5">:</td>
            <td width="5">a.</td>
            <td width="100%">bahwa berdasarkan hasil pemeriksaan tim pemerika, Sdr. {{ $kephukdis->terlapor_json->nama }}, NIP {{ $kephukdis->terlapor_json->nip }}, telah terbukti melakukan perbuatan berupa {{ $kephukdis->dugaan_pelanggaran }};</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>b.</td>
            <td>bahwa perbuatan tersebut merupakan pelanggaran terhadap ketentuan Pasal {{ $kephukdis->pelanggaran->kl->pasal }} Huruf {{ $kephukdis->pelanggaran->kl->huruf }} {{ $kephukdis->pelanggaran->kl->angka != '' ? 'Angka '.$kephukdis->pelanggaran->kl->angka : '' }}, Peraturan Pemerintah Nomor 94 Tahun 2021 tentang Disiplin Pegawai Negeri Sipil;</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>c.</td>
            <td>bahwa untuk menegakkan disiplin, perlu menjatuhkan hukuman disiplin yang setimpal dengan pelanggaran disiplin yang dilakukannya;</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>d.</td>
            <td>bahwa berdasarkan pertimbangan sebagaimana dimaksud dalam huruf a, huruf b, dan huruf c, perlu menetapkan Keputusan tentang Penjatuhan Hukuman Disiplin {{ $kephukdis->hukdis->nama }};</td>
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
                Menjatuhkan hukuman disiplin berupa {{ $kephukdis->hukdis->nama }} kepada:<br>
                <table class="tabel-form">
                    <tr>
                        <td width="80">Nama</td>
                        <td width="5">:</td>
                        <td width="100%">{{ $kephukdis->terlapor_json->nama }}</td>
                    </tr>
                    <tr>
                        <td>NIP</td>
                        <td>:</td>
                        <td>{{ $kephukdis->terlapor_json->nip }}</td>
                    </tr>
                    <tr>
                        <td>Pangkat</td>
                        <td>:</td>
                        <td>{{ $kephukdis->terlapor_json->pangkat }}</td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td>:</td>
                        <td>{{ $kephukdis->terlapor_json->jabatan }}</td>
                    </tr>
                    <tr>
                        <td>Unit Kerja</td>
                        <td>:</td>
                        <td>{{ $kephukdis->terlapor_json->unit }}</td>
                    </tr>
                </table>
                karena yang bersangkutan pada tanggal {{ \Ajifatur\Helpers\DateTimeExt::full($kephukdis->tanggal_pelanggaran) }}, telah melakukan perbuatan yang melanggar ketentuan Pasal {{ $kephukdis->pelanggaran->kl->pasal }} Huruf {{ $kephukdis->pelanggaran->kl->huruf }} {{ $kephukdis->pelanggaran->kl->angka != '' ? 'Angka '.$kephukdis->pelanggaran->kl->angka : '' }}, Peraturan Pemerintah Nomor 94 Tahun 2021.
            </td>
        </tr>
        <tr>
            <td>KEDUA</td>
            <td>:</td>
            <td>Terhitung mulai tanggal {{ date('j', strtotime($kephukdis->tmt)) }}, bulan {{ \Ajifatur\Helpers\DateTimeExt::month(date('m', strtotime($kephukdis->tmt))) }}, tahun {{ date('Y', strtotime($kephukdis->tmt)) }}, Sdr. {{ $kephukdis->terlapor_json->nama }} yang semula menduduki jabatan {{ $kephukdis->terlapor_json->jabatan }} dibebaskan menjadi jabatan pelaksana.</td>
        </tr>
        <tr>
            <td>KETIGA</td>
            <td>:</td>
            <td>Atas pembebasan jabatan tersebut, hak-hak kepegawaian dari Sdr. {{ $kephukdis->terlapor_json->nama }} disesuaikan dengan jabatan terbaru.</td>
        </tr>
        <tr>
            <td>KEEMPAT</td>
            <td>:</td>
            <td>Pengangkatan dalam jabatan yang baru dalam rangka pembebasan dari jabatannya menjadi jabatan pelaksana, ditetapkan dengan keputusan tersendiri sesuai ketentuan peraturan perundang-undangan.</td>
        </tr>
        <tr>
            <td>KELIMA</td>
            <td>:</td>
            <td>Keputusan ini mulai berlaku pada hari kerja ke-15 (lima belas) terhitung mulai tanggal PNS yang bersangkutan menerima keputusan atau hari kerja ke-15 (lima belas) sejak tanggal diterimanya keputusan Hukuman Disiplin yang dikirim ke alamat PNS yang bersangkutan.</td>
        </tr>
        <tr>
            <td>KEENAM</td>
            <td>:</td>
            <td>Keputusan ini disampaikan kepada yang bersangkutan untuk dilaksanakan sebagaimana mestinya.</td>
        </tr>
    </table>
    <table class="tabel-form tabel-ttd">
        <tr>
            <td width="55%"></td>
            <td width="45%">
                <div>Ditetapkan di {{ $kephukdis->tempat_ditetapkan }}</div>
                <div>pada tanggal {{ \Ajifatur\Helpers\DateTimeExt::full($kephukdis->tanggal_ditetapkan) }}</div>
                <br>
                <div>{{ $kephukdis->jabatan_pejabat }},</div>
                <br><br><br><br>
                <div>{{ $kephukdis->nama_pejabat }}</div>
                <div>NIP {{ $kephukdis->nip_pejabat }}</div>
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