<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ajifatur\Helpers\DateTimeExt;
use PDF;
use App\Models\Kasus;
use App\Models\LHP;
use App\Models\Pelanggaran;
use App\Models\Hukdis;

class LHPController extends Controller
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

        // View
        return view('admin/lhp/create', [
            'kasus' => $kasus,
            'surat_panggilan_1' => $surat_panggilan_1,
            'atasan' => $atasan,
            'bap' => $bap,
            'pelanggaran' => $pelanggaran,
            'hukdis' => $hukdis,
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
            'penerima_surat' => 'required',
            'tempat_penerima_surat' => 'required',
            'hukdis' => 'required',
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
            $simpeg_penerima = file_get_contents("https://simpeg.unnes.ac.id/index.php/gen_xml/json_nip_staff/".$request->penerima_surat);
            $simpeg_penerima = json_decode($simpeg_penerima);
            $simpeg_penerima = $simpeg_penerima->value;
            $p = explode(' ', $simpeg_penerima->pangkat);
            array_pop($p);
            $simpeg_penerima->pangkat = implode(' ', $p);

            // SIMPEG Pelapor
            $simpeg_pelapor = file_get_contents("https://simpeg.unnes.ac.id/index.php/gen_xml/json_nip_staff/".$request->pelapor);
            $simpeg_pelapor = json_decode($simpeg_pelapor);
            $simpeg_pelapor = $simpeg_pelapor->value;
            $p = explode(' ', $simpeg_pelapor->pangkat);
            array_pop($p);
            $simpeg_pelapor->pangkat = implode(' ', $p);

            // Simpan laporan hasil pemeriksaan
            $lhp = LHP::find($request->id);
            if(!$lhp) $lhp = new LHP;
            $lhp->kasus_id = $request->kasus_id;
            $lhp->pelanggaran_id = $request->pelanggaran_id;
            $lhp->hukdis_id = $request->hukdis;
            $lhp->terlapor = $request->terlapor;
            $lhp->terlapor_json = json_encode([
                'nama' => fullname($simpeg_terlapor->nama, $simpeg_terlapor->gelar_dpn, $simpeg_terlapor->gelar_blk),
                'nip' => $simpeg_terlapor->nip_bar,
                'pangkat' => $simpeg_terlapor->pangkat,
                'jabatan' => $simpeg_terlapor->jabatan,
                'unit' => $simpeg_terlapor->nama_unit,
            ]);
            $lhp->tanggal_surat = DateTimeExt::change($request->tanggal_surat);
            $lhp->tempat_surat = $request->tempat_surat;
            $lhp->penerima_surat = $request->penerima_surat;
            $lhp->penerima_surat_json = json_encode([
                'nama' => fullname($simpeg_penerima->nama, $simpeg_penerima->gelar_dpn, $simpeg_penerima->gelar_blk),
                'nip' => $simpeg_penerima->nip_bar,
                'pangkat' => $simpeg_penerima->pangkat,
                'jabatan' => $simpeg_penerima->jabatan,
                'unit' => $simpeg_penerima->nama_unit,
            ]);
            $lhp->tempat_penerima_surat = $request->tempat_penerima_surat;
            $lhp->tanggal_pemeriksaan = $request->tanggal_pemeriksaan;
            $lhp->pelapor = $request->pelapor;
            $lhp->pelapor_json = json_encode([
                'nama' => fullname($simpeg_pelapor->nama, $simpeg_pelapor->gelar_dpn, $simpeg_pelapor->gelar_blk),
                'nip' => $simpeg_pelapor->nip_bar,
                'pangkat' => $simpeg_pelapor->pangkat,
                'jabatan' => $simpeg_pelapor->jabatan,
                'unit' => $simpeg_pelapor->nama_unit,
            ]);
            $lhp->status_pelapor = $request->status_pelapor;
            $lhp->laporan = '';
            $lhp->save();

            // Redirect
            return redirect()->route('admin.kasus.detail', ['id' => $request->kasus_id])->with(['message' => 'Berhasil memperbarui data.']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param  int  $lhp_id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $lhp_id)
    {
        // Check the access
        // has_access(method(__METHOD__), Auth::user()->role_id);

        // Kasus
        $kasus = Kasus::findOrFail($id);

        // Laporan hasil pemeriksaan
        $lhp = LHP::findOrFail($lhp_id);

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

        // View
        return view('admin/lhp/edit', [
            'kasus' => $kasus,
            'lhp' => $lhp,
            'surat_panggilan_1' => $surat_panggilan_1,
            'atasan' => $atasan,
            'bap' => $bap,
            'pelanggaran' => $pelanggaran,
            'hukdis' => $hukdis,
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
        
        // Menghapus laporan hasil pemeriksaan
        $lhp = LHP::find($request->id);
        $lhp->delete();

        // Redirect
        return redirect()->route('admin.kasus.detail', ['id' => $lhp->kasus->id])->with(['message' => 'Berhasil menghapus data.']);
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
