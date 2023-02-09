<!DOCTYPE html>
<html lang="en">
<head>
    <title>Berita Acara Pemeriksaan - {{ $bap->kasus->terduga_nip }}</title>
    <style>
        @page {margin: 0px;}
		html {margin: 0px;}
        body {margin: 40px 30px;}
        #judul {text-align: center; margin-bottom: 30px;}
        #judul div {margin-bottom: 5px; text-transform: uppercase;}
        .tabel-form {width: 100%}
        .tabel-form tr td {vertical-align: top;}
        #tabel-ttd {width: 100%; margin-top: 20px; margin-bottom: 20px;}
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
    <table class="tabel-form">
        <tr>
            <td colspan="{{ $bap->pemeriksa == 1 ? 3 : 4 }}">Pada hari ini {{ $bap->hariIndo }}, tanggal {{ date('j', strtotime($bap->tanggal)) }}, bulan {{ $bap->bulanIndo }}, tahun {{ date('Y', strtotime($bap->tanggal)) }}, {{ $bap->pemeriksa == 1 ? 'Saya' : 'Tim Pemeriksa masing-masing' }}:</td>
        </tr>
        @foreach($bap->tim_pemeriksa as $key=>$p)
        <tr>
            @if($bap->pemeriksa == 2)
                <td width="10">{{ $key+1 }}.</td>
            @endif
            <td width="100">Nama</td>
            <td width="5">:</td>
            <td width="100%">{{ fullname($p->pemeriksa->nama, $p->pemeriksa->gelar_dpn, $p->pemeriksa->gelar_blk) }}</td>
        </tr>
        <tr>
            @if($bap->pemeriksa == 2)
                <td></td>
            @endif
            <td>NIP</td>
            <td>:</td>
            <td>{{ $p->pemeriksa->nip_bar }}</td>
        </tr>
        <tr>
            @if($bap->pemeriksa == 2)
                <td></td>
            @endif
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
            @if($bap->pemeriksa == 2)
                <td></td>
            @endif
            <td>Jabatan</td>
            <td>:</td>
            <td>{{ $p->pemeriksa->jabatan }}</td>
        </tr>
        @endforeach
    </table>
    <table class="tabel-form">
        <tr>
            <td colspan="3">Berdasarkan wewenang yang ada pada {{ $bap->wewenang == 1 ? 'Saya' : 'Surat Perintah '.$bap->surat_perintah }} telah melakukan pemeriksaan terhadap:</td>
        </tr>
        <tr>
            <td width="{{ $bap->pemeriksa == 2 ? '110' : '100' }}">Nama</td>
            <td width="5">:</td>
            <td width="100%">{{ $bap->terlapor_json->nama }}</td>
        </tr>
        <tr>
            <td>NIP</td>
            <td>:</td>
            <td>{{ $bap->terlapor_json->nip }}</td>
        </tr>
        <tr>
            <td>Pangkat</td>
            <td>:</td>
            <td>{{ $bap->terlapor_json->pangkat }}</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td>{{ $bap->terlapor_json->jabatan }}</td>
        </tr>
        <tr>
            <td>Unit Kerja</td>
            <td>:</td>
            <td>{{ $bap->terlapor_json->unit }}</td>
        </tr>
        <tr>
            <td colspan="3">karena yang bersangkutan diduga telah melakukan pelanggaran terhadap ketentuan Pasal {{ $bap->pelanggaran->kl->pasal }}, huruf {{ $bap->pelanggaran->kl->huruf }}{{ $bap->pelanggaran->kl->angka != '' ? ', angka '.$bap->pelanggaran->kl->angka : '' }}, Peraturan Pemerintah Nomor 94 Tahun 2021 tentang Disiplin Pegawai Negeri Sipil.</td>
        </tr>
    </table>
    <table class="tabel-form">
        @foreach($bap->qna['pertanyaan'] as $key=>$p)
        <tr>
            <td width="5">{{ $key+1 }}.</td>
            <td width="100%">
                <u>Pertanyaan :</u>
                <br>
                {{ $bap->qna['pertanyaan'][$key] }}
                <br>
                <u>Jawaban :</u>
                <br>
                {{ $bap->qna['jawaban'][$key] }}
            </td>
        </tr>
        @endforeach
        <tr>
            <td colspan="2">Demikian Berita Acara Pemeriksaan ini dibuat untuk dapat digunakan sebagaimana mestinya.</td>
        </tr>
    </table>
    <table id="tabel-ttd">
        <tr>
            <td width="50%"></td>
            <td width="50%">
                <div>Semarang, {{ $bap->tanggalIndo }}</div>
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
                        <td width="100%">{{ $bap->terlapor_json->nama }}</td>
                    </tr>
                    <tr>
                        <td>NIP</td>
                        <td>:</td>
                        <td>{{ $bap->terlapor_json->nip }}</td>
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
                        <td colspan="{{ $bap->pemeriksa == 1 ? '3' : '4' }}">{{ $bap->pemeriksa == 1 ? 'Pejabat' : 'Tim' }} Pemeriksa :</td>
                    </tr>
                    @foreach($bap->tim_pemeriksa as $key=>$p)
                    <tr>
                        @if($bap->pemeriksa == 2)
                        <td width="10">{{ $key+1 }}.</td>
                        @endif
                        <td width="80">Nama</td>
                        <td width="5">:</td>
                        <td width="100%">{{ fullname($p->pemeriksa->nama, $p->pemeriksa->gelar_dpn, $p->pemeriksa->gelar_blk) }}</td>
                    </tr>
                    <tr>
                        @if($bap->pemeriksa == 2)
                        <td></td>
                        @endif
                        <td>NIP</td>
                        <td>:</td>
                        <td>{{ $p->pemeriksa->nip_bar }}</td>
                    </tr>
                    <tr>
                        @if($bap->pemeriksa == 2)
                        <td></td>
                        @endif
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