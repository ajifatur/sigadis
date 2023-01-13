<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ajifatur\Helpers\DateTimeExt;
use PDF;
use App\Models\Terduga;
use App\Models\BAP;
use App\Models\TimPemeriksa;
use App\Models\Pelanggaran;

class BAPController extends Controller
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

        // Terduga
        $terduga = Terduga::findOrFail($id);

        // Surat panggilan 1
        $surat_panggilan_1 = $terduga->surat_panggilan->where('panggilan','=',1)->first();

        // Atasan
        $atasan = $surat_panggilan_1 ? json_decode($surat_panggilan_1->atasan_json) : [];

        // Pelanggaran
        $pelanggaran = Pelanggaran::all();

        // View
        return view('admin/bap/create', [
            'terduga' => $terduga,
            'surat_panggilan_1' => $surat_panggilan_1,
            'atasan' => $atasan,
            'pelanggaran' => $pelanggaran
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
            'tanggal' => 'required',
            'pemeriksa' => 'required',
            'wewenang' => 'required',
            'surat_perintah' => $request->wewenang == 2 ? 'required' : '',
            'pelanggaran' => 'required',
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

            // QNA
            $qna = [
                'pertanyaan' => $request->pertanyaan,
                'jawaban' => $request->jawaban,
            ];

            // Simpan berita acara pemeriksaan
            $bap = BAP::find($request->id);
            if(!$bap) $bap = new BAP;
            $bap->terduga_id = $request->terduga_id;
            $bap->pelanggaran_id = $request->pelanggaran;
            $bap->terlapor = $request->terlapor;
            $bap->terlapor_json = json_encode([
                'nama' => fullname($simpeg_terlapor->nama, $simpeg_terlapor->gelar_dpn, $simpeg_terlapor->gelar_blk),
                'nip' => $simpeg_terlapor->nip_bar,
                'pangkat' => $simpeg_terlapor->pangkat,
                'jabatan' => $simpeg_terlapor->jabatan,
                'unit' => $simpeg_terlapor->nama_unit,
            ]);
            $bap->tanggal = DateTimeExt::change($request->tanggal);
            $bap->pemeriksa = $request->pemeriksa;
            $bap->wewenang = $request->wewenang;
            $bap->surat_perintah = $request->wewenang == 2 ? $request->surat_perintah : '';
            $bap->qna = json_encode($qna);
            $bap->save();

            if($request->id == '') {
                foreach($request->tim_pemeriksa as $p) {
                    $pemeriksa = new TimPemeriksa;
                    $pemeriksa->bap_id = $bap->id;
                    $pemeriksa->pemeriksa = $p;
                    $pemeriksa->save();
                }
            }
            else {
                foreach($bap->tim_pemeriksa as $p) {
                    if(!in_array($p->pemeriksa, $request->tim_pemeriksa)) {
                        $po = TimPemeriksa::find($p->id);
                        $po->delete();
                    }
                }
                foreach($request->tim_pemeriksa as $p) {
                    if(!in_array($p, $bap->tim_pemeriksa()->pluck('pemeriksa')->toArray())) {
                        $pn = new TimPemeriksa;
                        $pn->bap_id = $bap->id;
                        $pn->pemeriksa = $p;
                        $pn->save();
                    }
                }
            }

            // Redirect
            return redirect()->route('admin.terduga.detail', ['id' => $request->terduga_id])->with(['message' => 'Berhasil memperbarui data.']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param  int  $bap_id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $bap_id)
    {
        // Check the access
        // has_access(method(__METHOD__), Auth::user()->role_id);

        // Terduga
        $terduga = Terduga::findOrFail($id);

        // Berita acara pemeriksaan
        $bap = BAP::findOrFail($bap_id);
        $bap->qna = json_decode($bap->qna, true);

        // Surat panggilan 1
        $surat_panggilan_1 = $terduga->surat_panggilan->where('panggilan','=',1)->first();

        // Atasan
        $atasan = $surat_panggilan_1 ? json_decode($surat_panggilan_1->atasan_json) : [];

        // Pelanggaran
        $pelanggaran = Pelanggaran::all();

        // View
        return view('admin/bap/edit', [
            'terduga' => $terduga,
            'bap' => $bap,
            'surat_panggilan_1' => $surat_panggilan_1,
            'atasan' => $atasan,
            'pelanggaran' => $pelanggaran
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
        
        // Menghapus Berita acara pemeriksaan
        $bap = BAP::find($request->id);
        $bap->delete();

        // Redirect
        return redirect()->route('admin.terduga.detail', ['id' => $bap->terduga->id])->with(['message' => 'Berhasil menghapus data.']);
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
        return $pdf->stream('Berita Acara Pemeriksaan - '.$bap->terduga->terduga_nip.'.pdf');
    }
}
