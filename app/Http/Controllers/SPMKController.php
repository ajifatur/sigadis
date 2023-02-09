<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ajifatur\Helpers\DateTimeExt;
use PDF;
use App\Models\Kasus;
use App\Models\SPMK;
use App\Models\Pelanggaran;
use App\Models\Hukdis;

class SPMKController extends Controller
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

        // Kephukdis
        $kephukdis = $kasus->kephukdis->first();

        // View
        return view('admin/spmk/create', [
            'kasus' => $kasus,
            'surat_panggilan_1' => $surat_panggilan_1,
            'atasan' => $atasan,
            'bap' => $bap,
            'kephukdis' => $kephukdis,
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
            'tanggal_surat' => 'required',
            'tempat_surat' => 'required',
            'tempat_penerima_surat' => 'required',
            'menghadap_kepada' => 'required',
            'tanggal_menghadap' => 'required',
            'jam_menghadap' => 'required',
            'tempat_menghadap' => 'required',
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

            // SIMPEG Penerima
            $simpeg_menghadap_kepada = file_get_contents("https://simpeg.unnes.ac.id/index.php/gen_xml/json_nip_staff/".$request->menghadap_kepada);
            $simpeg_menghadap_kepada = json_decode($simpeg_menghadap_kepada);
            $simpeg_menghadap_kepada = $simpeg_menghadap_kepada->value;
            $p = explode(' ', $simpeg_menghadap_kepada->pangkat);
            array_pop($p);
            $simpeg_menghadap_kepada->pangkat = implode(' ', $p);

            // SIMPEG Atasan
            $simpeg_atasan = file_get_contents("https://simpeg.unnes.ac.id/index.php/gen_xml/json_nip_staff/".$request->atasan);
            $simpeg_atasan = json_decode($simpeg_atasan);
            $simpeg_atasan = $simpeg_atasan->value;
            $p = explode(' ', $simpeg_atasan->pangkat);
            array_pop($p);
            $simpeg_atasan->pangkat = implode(' ', $p);

            // Simpan laporan hasil pemeriksaan
            $spmk = SPMK::find($request->id);
            if(!$spmk) $spmk = new SPMK;
            $spmk->kasus_id = $request->kasus_id;
            $spmk->pelanggaran_id = $request->pelanggaran_id;
            $spmk->hukdis_id = $request->hukdis_id;
            $spmk->terlapor = $request->terlapor;
            $spmk->terlapor_json = json_encode([
                'nama' => fullname($simpeg_terlapor->nama, $simpeg_terlapor->gelar_dpn, $simpeg_terlapor->gelar_blk),
                'nip' => $simpeg_terlapor->nip_bar,
                'pangkat' => $simpeg_terlapor->pangkat,
                'jabatan' => $simpeg_terlapor->jabatan,
                'unit' => $simpeg_terlapor->nama_unit,
            ]);
            $spmk->tanggal_surat = DateTimeExt::change($request->tanggal_surat);
            $spmk->tempat_surat = $request->tempat_surat;
            $spmk->tempat_penerima_surat = $request->tempat_penerima_surat;
            $spmk->menghadap_kepada = $request->menghadap_kepada;
            $spmk->menghadap_kepada_json = json_encode([
                'nama' => fullname($simpeg_menghadap_kepada->nama, $simpeg_menghadap_kepada->gelar_dpn, $simpeg_menghadap_kepada->gelar_blk),
                'nip' => $simpeg_menghadap_kepada->nip_bar,
                'pangkat' => $simpeg_menghadap_kepada->pangkat,
                'jabatan' => $simpeg_menghadap_kepada->jabatan,
                'unit' => $simpeg_menghadap_kepada->nama_unit,
            ]);
            $spmk->tanggal_menghadap = DateTimeExt::change($request->tanggal_menghadap);
            $spmk->jam_menghadap = $request->jam_menghadap.':00';
            $spmk->tempat_menghadap = $request->tempat_menghadap;
            $spmk->atasan = $request->atasan;
            $spmk->atasan_json = json_encode([
                'nama' => fullname($simpeg_atasan->nama, $simpeg_atasan->gelar_dpn, $simpeg_atasan->gelar_blk),
                'nip' => $simpeg_atasan->nip_bar,
                'pangkat' => $simpeg_atasan->pangkat,
                'jabatan' => $simpeg_atasan->jabatan,
                'unit' => $simpeg_atasan->nama_unit,
            ]);
            $spmk->save();

            // Redirect
            return redirect()->route('admin.kasus.detail', ['id' => $request->kasus_id])->with(['message' => 'Berhasil memperbarui data.']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param  int  $spmk_id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $spmk_id)
    {
        // Check the access
        // has_access(method(__METHOD__), Auth::user()->role_id);

        // Kasus
        $kasus = Kasus::findOrFail($id);

        // Laporan hasil pemeriksaan
        $spmk = SPMK::findOrFail($spmk_id);

        // Surat panggilan 1
        $surat_panggilan_1 = $kasus->surat_panggilan->where('panggilan','=',1)->first();

        // Atasan
        $atasan = $surat_panggilan_1 ? json_decode($surat_panggilan_1->atasan_json) : [];

        // BAP
        $bap = $kasus->bap->first();

        // Kephukdis
        $kephukdis = $kasus->kephukdis->first();

        // View
        return view('admin/spmk/edit', [
            'kasus' => $kasus,
            'spmk' => $spmk,
            'surat_panggilan_1' => $surat_panggilan_1,
            'atasan' => $atasan,
            'bap' => $bap,
            'kephukdis' => $kephukdis,
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
        
        // Menghapus surat panggilan untuk menerima hukdis
        $spmk = SPMK::find($request->id);
        $spmk->delete();

        // Redirect
        return redirect()->route('admin.kasus.detail', ['id' => $spmk->kasus->id])->with(['message' => 'Berhasil menghapus data.']);
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
