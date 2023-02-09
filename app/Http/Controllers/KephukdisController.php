<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ajifatur\Helpers\DateTimeExt;
use PDF;
use App\Models\Kasus;
use App\Models\Kephukdis;
use App\Models\Pelanggaran;
use App\Models\Hukdis;

class KephukdisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Check the access
        // has_access(method(__METHOD__), Auth::user()->role_id);

        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        // Check the access
        // has_access(method(__METHOD__), Auth::user()->role_id);

        // Kasus
        $kasus = Kasus::findOrFail($id);

        // Surat panggilan 1
        $surat_panggilan_1 = $kasus->surat_panggilan->where('panggilan','=',1)->first();

        // Atasan
        $atasan = $surat_panggilan_1 ? json_decode($surat_panggilan_1->atasan_json) : [];

        // BAP
        $bap = $kasus->bap->first();

        // Pelanggaran
        $pelanggaran = Pelanggaran::all();

        // Hukdis
        $hukdis = Hukdis::all();

        // Keputusan
        $keputusan = [
            ['id' => 1, 'nama' => 'Menteri Pendidikan, Kebudayaan, Riset dan Teknologi'],
            ['id' => 2, 'nama' => 'Rektor']
        ];

        // View
        return view('admin/kephukdis/create', [
            'kasus' => $kasus,
            'surat_panggilan_1' => $surat_panggilan_1,
            'atasan' => $atasan,
            'bap' => $bap,
            'pelanggaran' => $pelanggaran,
            'hukdis' => $hukdis,
            'keputusan' => $keputusan,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'keputusan' => 'required',
            'hukdis' => 'required',
            'tanggal_ditetapkan' => 'required',
            'tempat_ditetapkan' => 'required',
            'nama_pejabat' => 'required',
            'nip_pejabat' => 'required',
            'jabatan_pejabat' => 'required',
        ]);
        
        // Check errors
        if($validator->fails()) {
            // Back to form page with validation error messages
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        else {
            // SIMPEG Terlapor
            $simpeg_terlapor = file_get_contents("https://simpeg.unnes.ac.id/index.php/gen_xml/json_nip_staff/".$request->terlapor);
            $simpeg_terlapor = json_decode($simpeg_terlapor);
            $simpeg_terlapor = $simpeg_terlapor->value;
            $p = explode(' ', $simpeg_terlapor->pangkat);
            array_pop($p);
            $simpeg_terlapor->pangkat = implode(' ', $p);

            // Simpan keputusan hukuman disiplin
            $kephukdis = Kephukdis::find($request->id);
            if(!$kephukdis) $kephukdis = new Kephukdis;
            $kephukdis->kasus_id = $request->kasus_id;
            $kephukdis->pelanggaran_id = $request->pelanggaran_id;
            $kephukdis->hukdis_id = $request->hukdis;
            $kephukdis->terlapor = $request->terlapor;
            $kephukdis->terlapor_json = json_encode([
                'nama' => fullname($simpeg_terlapor->nama, $simpeg_terlapor->gelar_dpn, $simpeg_terlapor->gelar_blk),
                'nip' => $simpeg_terlapor->nip_bar,
                'pangkat' => $simpeg_terlapor->pangkat,
                'jabatan' => $simpeg_terlapor->jabatan,
                'unit' => $simpeg_terlapor->nama_unit,
            ]);
            $kephukdis->keputusan = $request->keputusan;
            $kephukdis->dugaan_pelanggaran = $request->dugaan_pelanggaran;
            $kephukdis->tanggal_ditetapkan = DateTimeExt::change($request->tanggal_ditetapkan);
            $kephukdis->tempat_ditetapkan = $request->tempat_ditetapkan;
            $kephukdis->nama_pejabat = $request->nama_pejabat;
            $kephukdis->nip_pejabat = $request->nip_pejabat;
            $kephukdis->jabatan_pejabat = $request->jabatan_pejabat;
            $kephukdis->save();

            // Redirect
            return redirect()->route('admin.kasus.detail', ['id' => $request->kasus_id])->with(['message' => 'Berhasil memperbarui data.']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param  int  $kephukdis_id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $kephukdis_id)
    {
        // Check the access
        // has_access(method(__METHOD__), Auth::user()->role_id);

        // Kasus
        $kasus = Kasus::findOrFail($id);

        // Keputusan hukdis
        $kephukdis = Kephukdis::findOrFail($kephukdis_id);

        // Surat panggilan 1
        $surat_panggilan_1 = $kasus->surat_panggilan->where('panggilan','=',1)->first();

        // Atasan
        $atasan = $surat_panggilan_1 ? json_decode($surat_panggilan_1->atasan_json) : [];

        // BAP
        $bap = $kasus->bap->first();

        // Pelanggaran
        $pelanggaran = Pelanggaran::all();

        // Hukdis
        $hukdis = Hukdis::all();

        // Keputusan
        $keputusan = [
            ['id' => 1, 'nama' => 'Menteri Pendidikan, Kebudayaan, Riset dan Teknologi'],
            ['id' => 2, 'nama' => 'Rektor']
        ];

        // View
        return view('admin/kephukdis/edit', [
            'kasus' => $kasus,
            'kephukdis' => $kephukdis,
            'surat_panggilan_1' => $surat_panggilan_1,
            'atasan' => $atasan,
            'bap' => $bap,
            'pelanggaran' => $pelanggaran,
            'hukdis' => $hukdis,
            'keputusan' => $keputusan,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        // Check the access
        // has_access(method(__METHOD__), Auth::user()->role_id);
        
        // Menghapus keputusan hukdis
        $kephukdis = Kephukdis::find($request->id);
        $kephukdis->delete();

        // Redirect
        return redirect()->route('admin.kasus.detail', ['id' => $kephukdis->kasus->id])->with(['message' => 'Berhasil menghapus data.']);
    }

    /**
     * Print PDF.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function print($id)
    {
        // Check the access
        // has_access(method(__METHOD__), Auth::user()->role_id);

        // Berita acara pemeriksaan
        $bap = BAP::findOrFail($id);
        $bap->terlapor_json = json_decode($bap->terlapor_json);

        // Tim pemeriksa
        foreach($bap->tim_pemeriksa as $p) {
            $tp = file_get_contents("https://simpeg.unnes.ac.id/index.php/gen_xml/json_nip_staff/".$p->pemeriksa);
            $tp = json_decode($tp);
            $p->pemeriksa = $tp->value;
        }

        $bap->hariIndo = DateTimeExt::day($bap->tanggal);
        $bap->bulanIndo = DateTimeExt::month(date('m', strtotime($bap->tanggal)));
        $bap->tanggalIndo = DateTimeExt::full($bap->tanggal);
        $bap->qna = json_decode($bap->qna, true);

        // PDF
        $pdf = PDF::loadView('admin/bap/print', [
            'bap' => $bap
        ]);
        return $pdf->stream('Berita Acara Pemeriksaan - '.$bap->kasus->terduga_nip.'.pdf');
    }
}
