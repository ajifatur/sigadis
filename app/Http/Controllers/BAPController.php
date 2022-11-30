<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ajifatur\Helpers\DateTimeExt;
use PDF;
use App\Models\BAP;
use App\Models\TimPemeriksa;

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

        // SIMPEG
        $simpeg = file_get_contents("https://simpeg.unnes.ac.id/index.php/gen_xml/list_doskar_by_key/10/1");
        $simpeg = json_decode($simpeg, true);

        // Berita acara pemeriksaan
        $berita = BAP::orderBy('created_at','desc')->get();
        foreach($berita as $key=>$b) {
            foreach($simpeg as $si) {
                if($si['nip'] == $b->terlapor) $b->terlapor = $si;
            }
        }

        // View
        return view('admin/bap/index', [
            'berita' => $berita
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Check the access
        // has_access(method(__METHOD__), Auth::user()->role_id);

        // View
        return view('admin/bap/create');
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
            'saya_pemeriksa' => 'required',
            'wewenang' => 'required',
            'terlapor' => 'required',
            'pasal' => 'required',
            'ayat' => 'required',
            'huruf' => 'required',
            'angka' => 'required',
        ]);
        
        // Check errors
        if($validator->fails()) {
            // Back to form page with validation error messages
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        else {
            // QNA
            $qna = [
                'pertanyaan' => $request->pertanyaan,
                'jawaban' => $request->jawaban,
            ];

            // Simpan berita acara pemeriksaan
            $berita = new BAP;
            $berita->hari = date('w', strtotime(DateTimeExt::change($request->tanggal)));
            $berita->tanggal = DateTimeExt::change($request->tanggal);
            $berita->pemeriksa = $request->saya_pemeriksa;
            $berita->wewenang = $request->wewenang;
            $berita->terlapor = $request->terlapor;
            $berita->pasal = $request->pasal;
            $berita->ayat = $request->ayat;
            $berita->huruf = $request->huruf;
            $berita->angka = $request->angka;
            $berita->qna = json_encode($qna);
            $berita->save();

            foreach($request->pemeriksa as $p) {
                $pemeriksa = new TimPemeriksa;
                $pemeriksa->bap_id = $berita->id;
                $pemeriksa->pemeriksa = $p;
                $pemeriksa->save();
            }

            // Redirect
            return redirect()->route('admin.bap.index')->with(['message' => 'Berhasil menambah data.']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Check the access
        // has_access(method(__METHOD__), Auth::user()->role_id);

        // Berita acara pemeriksaan
        $berita = BAP::findOrFail($id);
        $berita->qna = json_decode($berita->qna, true);

        // View
        return view('admin/bap/edit', [
            'berita' => $berita
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required',
            'saya_pemeriksa' => 'required',
            'wewenang' => 'required',
            'terlapor' => 'required',
            'pasal' => 'required',
            'ayat' => 'required',
            'huruf' => 'required',
            'angka' => 'required',
        ]);
        
        // Check errors
        if($validator->fails()) {
            // Back to form page with validation error messages
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        else {
            // QNA
            $qna = [
                'pertanyaan' => $request->pertanyaan,
                'jawaban' => $request->jawaban,
            ];

            // Mengupdate Berita acara pemeriksaan
            $berita = BAP::find($request->id);
            $berita->hari = date('w', strtotime(DateTimeExt::change($request->tanggal)));
            $berita->tanggal = DateTimeExt::change($request->tanggal);
            $berita->pemeriksa = $request->saya_pemeriksa;
            $berita->wewenang = $request->wewenang;
            $berita->terlapor = $request->terlapor;
            $berita->pasal = $request->pasal;
            $berita->ayat = $request->ayat;
            $berita->huruf = $request->huruf;
            $berita->angka = $request->angka;
            $berita->qna = json_encode($qna);
            $berita->save();

            // Sync pemeriksa
            $pemeriksa_old = $berita->tim_pemeriksa;
            foreach($berita->tim_pemeriksa as $p) {
                if(!in_array($p->pemeriksa, $request->pemeriksa)) {
                    $po = TimPemeriksa::find($p->id);
                    $po->delete();
                }
            }
            foreach($request->pemeriksa as $p) {
                if(!in_array($p, $berita->tim_pemeriksa()->pluck('pemeriksa')->toArray())) {
                    $pn = new TimPemeriksa;
                    $pn->bap_id = $berita->id;
                    $pn->pemeriksa = $p;
                    $pn->save();
                }
            }

            // Redirect
            return redirect()->route('admin.bap.index')->with(['message' => 'Berhasil mengupdate data.']);
        }
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
        $berita = BAP::find($request->id);
        $berita->delete();

        // Redirect
        return redirect()->route('admin.bap.index')->with(['message' => 'Berhasil menghapus data.']);
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
        $berita = BAP::findOrFail($id);

        // Terlapor
        $terlapor = file_get_contents("https://simpeg.unnes.ac.id/index.php/gen_xml/json_nip_staff/".$berita->terlapor);
        $terlapor = json_decode($terlapor);
        $berita->terlapor = $terlapor->value;

        // Tim pemeriksa
        foreach($berita->tim_pemeriksa as $p) {
            $tp = file_get_contents("https://simpeg.unnes.ac.id/index.php/gen_xml/json_nip_staff/".$p->pemeriksa);
            $tp = json_decode($tp);
            $p->pemeriksa = $tp->value;
        }

        $berita->hariIndo = DateTimeExt::day($berita->tanggal);;
        $berita->bulanIndo = DateTimeExt::month(date('m', strtotime($berita->tanggal)));
        $berita->tanggalIndo = DateTimeExt::full($berita->tanggal);
        $berita->qna = json_decode($berita->qna, true);

        // PDF
        $pdf = PDF::loadView('admin/bap/print', [
            'berita' => $berita
        ]);
        return $pdf->stream('Berita Acara Pemeriksaan - '.$berita->terlapor->nip_bar.'.pdf');
    }
}
