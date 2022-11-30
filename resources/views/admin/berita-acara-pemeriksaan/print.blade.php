<!DOCTYPE html>
<html lang="en">
<head>
    <title>Berita Acara Pemeriksaan</title>
    <style>
        @page {margin: 0px;}
		html {margin: 0px;}
        body {margin: 40px 30px;}
        #judul {text-align: center; margin-bottom: 30px;}
        #judul div {margin-bottom: 5px; text-transform: uppercase;}
        #tabel-form {width: 100%; margin-bottom: 20px;}
        #tabel-form tr td {vertical-align: top;}
        #tabel-ttd {width: 100%; margin-bottom: 20px;}
        #tabel-terlapor {width: 100%;}
        #tabel-terlapor tr td {vertical-align: top;}
        #tabel-tim-pemeriksa {width: 100%;}
        #tabel-tim-pemeriksa tr td {vertical-align: top;}
    </style>
</head>
<body>
    <div id="judul">
        <div>Rahasia</div>
        <div>Berita Acara Pemeriksaan</div>
    </div>
    <table id="tabel-form">
        <tr>
            <td colspan="4">Pada hari ini {{ $berita->hariIndo }}, tanggal {{ date('d', strtotime($berita->tanggal)) }}, bulan {{ $berita->bulanIndo }}, tahun {{ date('Y', strtotime($berita->tanggal)) }}, {{ $berita->pemeriksa == 1 ? 'Saya' : 'Tim Pemeriksa' }} masing-masing:</td>
        </tr>
        @foreach($berita->tim_pemeriksa as $key=>$p)
        <tr>
            <td width="10">{{ $key+1 }}.</td>
            <td width="100">Nama</td>
            <td width="5">:</td>
            <td width="100%">{{ fullname($p->pemeriksa->nama, $p->pemeriksa->gelar_dpn, $p->pemeriksa->gelar_blk) }}</td>
        </tr>
        <tr>
            <td></td>
            <td>NIP</td>
            <td>:</td>
            <td>{{ $p->pemeriksa->nip_bar }}</td>
        </tr>
        <tr>
            <td></td>
            <td>Pangkat</td>
            <td>:</td>
            <?php
                $pa = explode(' ', $p->pemeriksa->pangkat);
                array_pop($pa);
                $p->pemeriksa->pangkat = implode(' ', $pa);
            ?>
            <td>{{ $p->pemeriksa->pangkat }}</td>
        </tr>
        <tr>
            <td></td>
            <td>Jabatan</td>
            <td>:</td>
            <td>{{ $p->pemeriksa->jabatan }}</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="4">Berdasarkan wewenang yang ada pada {{ $berita->wewenang == 1 ? 'Saya' : 'Surat Perintah' }} telah melakukan pemeriksaan terhadap:</td>
        </tr>
        <tr>
            <td colspan="2">Nama</td>
            <td>:</td>
            <td>{{ fullname($berita->terlapor->nama, $berita->terlapor->gelar_dpn, $berita->terlapor->gelar_blk) }}</td>
        </tr>
        <tr>
            <td colspan="2">NIP</td>
            <td>:</td>
            <td>{{ $berita->terlapor->nip_bar }}</td>
        </tr>
        <tr>
            <td colspan="2">Pangkat</td>
            <td>:</td>
            <?php
                $pa = explode(' ', $berita->terlapor->pangkat);
                array_pop($pa);
                $berita->terlapor->pangkat = implode(' ', $pa);
            ?>
            <td>{{ $berita->terlapor->pangkat }}</td>
        </tr>
        <tr>
            <td colspan="2">Jabatan</td>
            <td>:</td>
            <td>{{ $berita->terlapor->jabatan }}</td>
        </tr>
        <tr>
            <td colspan="2">Unit Kerja</td>
            <td>:</td>
            <td>{{ $berita->terlapor->nama_unit }}</td>
        </tr>
        <tr>
            <td colspan="4">karena yang bersangkutan diduga telah melakukan pelanggaran terhadap ketentuan Pasal {{ $berita->pasal }}, ayat {{ $berita->ayat }}, huruf {{ $berita->huruf }}, angka {{ $berita->angka }}, Peraturan Pemerintah Nomor 94 Tahun 2021 tentang Disiplin Pegawai Negeri Sipil.</td>
        </tr>
        @foreach($berita->qna['pertanyaan'] as $key=>$p)
        <tr>
            <td>{{ $key+1 }}.</td>
            <td colspan="3">
                <u>Pertanyaan :</u>
                <br>
                {{ $berita->qna['pertanyaan'][$key] }}
                <br>
                <u>Jawaban :</u>
                <br>
                {{ $berita->qna['jawaban'][$key] }}
            </td>
        </tr>
        @endforeach
        <tr>
            <td colspan="4">Demikian Berita Acara Pemeriksaan ini dibuat untuk dapat digunakan sebagaimana mestinya.</td>
        </tr>
    </table>
    <table id="tabel-ttd">
        <tr>
            <td width="50%"></td>
            <td width="50%">
                <div>Semarang, {{ $berita->tanggalIndo }}</div>
            </td>
        </tr>
        <tr>
            <td valign="top">
                <table id="tabel-terlapor">
                    <tr>
                        <td colspan="3">Yang diperiksa :</td>
                    </tr>
                    <tr>
                        <td width="80">Nama</td>
                        <td width="5">:</td>
                        <td width="100%">{{ fullname($berita->terlapor->nama, $berita->terlapor->gelar_dpn, $berita->terlapor->gelar_blk) }}</td>
                    </tr>
                    <tr>
                        <td>NIP</td>
                        <td>:</td>
                        <td>{{ $berita->terlapor->nip_bar }}</td>
                    </tr>
                    <tr>
                        <td>Tanda Tangan</td>
                        <td>:</td>
                        <td></td>
                    </tr>
                </table>
            </td>
            <td valign="top">
                <table id="tabel-tim-pemeriksa">
                    <tr>
                        <td colspan="4">Tim Pemeriksa :</td>
                    </tr>
                    @foreach($berita->tim_pemeriksa as $key=>$p)
                    <tr>
                        <td width="10">{{ $key+1 }}.</td>
                        <td width="80">Nama</td>
                        <td width="5">:</td>
                        <td width="100%">{{ fullname($p->pemeriksa->nama, $p->pemeriksa->gelar_dpn, $p->pemeriksa->gelar_blk) }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>NIP</td>
                        <td>:</td>
                        <td>{{ $p->pemeriksa->nip_bar }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Tanda Tangan</td>
                        <td>:</td>
                        <td></td>
                    </tr>
                    @endforeach
                </table>
            </td>
        </tr>
    </table>
</body>
</html>