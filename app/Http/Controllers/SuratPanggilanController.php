<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ajifatur\Helpers\DateTimeExt;
use PDF;
use App\Models\Kasus;
use App\Models\SuratPanggilan;

class SuratPanggilanController extends Controller
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

        // View
        return view('admin/surat-panggilan/create', [
            'kasus' => $kasus
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
            'nomor' => 'required',
            'menghadap_kepada' => 'required',
            'tanggal' => 'required',
            'jam' => 'required',
            'tempat' => 'required',
            'status' => 'required',
            'pelanggaran' => 'required',
            'status_atasan' => 'required',
            'atasan' => 'required',
            'tanggal_surat' => 'required',
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

            // SIMPEG Menghadap Kepada
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

            // Simpan surat panggilan
            $surat = SuratPanggilan::find($request->id);
            if(!$surat) $surat = new SuratPanggilan;
            $surat->kasus_id = $request->kasus_id;
            $surat->panggilan = $request->panggilan;
            $surat->terlapor = $request->terlapor;
            $surat->terlapor_json = json_encode([
                'nama' => fullname($simpeg_terlapor->nama, $simpeg_terlapor->gelar_dpn, $simpeg_terlapor->gelar_blk),
                'nip' => $simpeg_terlapor->nip_bar,
                'pangkat' => $simpeg_terlapor->pangkat,
                'jabatan' => $simpeg_terlapor->jabatan,
                'unit' => $simpeg_terlapor->nama_unit,
            ]);
            $surat->nomor = $request->nomor;
            $surat->menghadap_kepada = $request->menghadap_kepada;
            $surat->menghadap_kepada_json = json_encode([
                'nama' => fullname($simpeg_menghadap_kepada->nama, $simpeg_menghadap_kepada->gelar_dpn, $simpeg_menghadap_kepada->gelar_blk),
                'nip' => $simpeg_menghadap_kepada->nip_bar,
                'pangkat' => $simpeg_menghadap_kepada->pangkat,
                'jabatan' => $simpeg_menghadap_kepada->jabatan,
                'unit' => $simpeg_menghadap_kepada->nama_unit,
            ]);
            $surat->tanggal = DateTimeExt::change($request->tanggal);
            $surat->jam = $request->jam.':00';
            $surat->tempat = $request->tempat;
            $surat->status = $request->status;
            $surat->pelanggaran = $request->pelanggaran;
            $surat->status_atasan = $request->status_atasan;
            $surat->atasan = $request->atasan;
            $surat->atasan_json = json_encode([
                'nama' => fullname($simpeg_atasan->nama, $simpeg_atasan->gelar_dpn, $simpeg_atasan->gelar_blk),
                'nip' => $simpeg_atasan->nip_bar,
                'pangkat' => $simpeg_atasan->pangkat,
                'jabatan' => $simpeg_atasan->jabatan,
                'unit' => $simpeg_atasan->nama_unit,
            ]);
            $surat->tanggal_surat = DateTimeExt::change($request->tanggal_surat);
            $surat->save();

            // Redirect
            return redirect()->route('admin.kasus.detail', ['id' => $request->kasus_id])->with(['message' => 'Berhasil memperbarui data.']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param  int  $surat_id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $surat_id)
    {
        // Check the access
        // has_access(method(__METHOD__), Auth::user()->role_id);

        // Kasus
        $kasus = Kasus::findOrFail($id);

        // Surat panggilan
        $surat = SuratPanggilan::findOrFail($surat_id);

        // View
        return view('admin/surat-panggilan/edit', [
            'kasus' => $kasus,
            'surat' => $surat
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
        
        // Menghapus surat panggilan
        $surat = SuratPanggilan::find($request->id);
        $surat->delete();

        // Redirect
        return redirect()->route('admin.kasus.detail', ['id' => $surat->kasus->id])->with(['message' => 'Berhasil menghapus data.']);
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

        // Surat panggilan
        $surat = SuratPanggilan::findOrFail($id);

        // JSON decode
        $surat->terlapor_json = json_decode($surat->terlapor_json);
        $surat->menghadap_kepada_json = json_decode($surat->menghadap_kepada_json);
        $surat->atasan_json = json_decode($surat->atasan_json);

        // Panggilan
        $length = $surat->panggilan;
        $surat->panggilan = '';
        for($i=1; $i<=$length; $i++) {
            $surat->panggilan .= 'I';
        }

        $surat->hariIndo = DateTimeExt::day($surat->tanggal);
        $surat->tanggalIndo = DateTimeExt::full($surat->tanggal);

        // PDF
        $pdf = PDF::loadView('admin/surat-panggilan/print', [
            'surat' => $surat
        ]);
        return $pdf->stream('Surat Panggilan '.$surat->panggilan.' - '.$surat->kasus->terduga_nip.'.pdf');
    }
}
