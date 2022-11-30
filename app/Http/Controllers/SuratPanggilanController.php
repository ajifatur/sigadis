<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ajifatur\Helpers\DateTimeExt;
use PDF;
use DataTables;
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

        // SIMPEG
        $simpeg = file_get_contents("https://simpeg.unnes.ac.id/index.php/gen_xml/list_doskar_by_key/10/1");
        $simpeg = json_decode($simpeg, true);

        // Surat panggilan
        $surat = SuratPanggilan::orderBy('created_at','desc')->orderBy('panggilan','asc')->get();
        foreach($surat as $key=>$s) {
            foreach($simpeg as $si) {
                if($si['nip'] == $s->terlapor) $s->terlapor = $si;
                if($si['nip'] == $s->menghadap_kepada) $s->menghadap_kepada = $si;
                if($si['nip'] == $s->ttd) $s->ttd = $si;
            }
        }

        // View
        return view('admin/surat-panggilan/index', [
            'surat' => $surat
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
        return view('admin/surat-panggilan/create');
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
            'panggilan' => 'required',
            'terlapor' => 'required',
            'menghadap_kepada' => 'required',
            'tanggal' => 'required',
            'jam' => 'required',
            'tempat' => 'required',
            'status' => 'required',
            'pelanggaran' => 'required',
            'atasan' => 'required',
            'ttd' => 'required',
        ]);
        
        // Check errors
        if($validator->fails()) {
            // Back to form page with validation error messages
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        else {
            // Simpan surat panggilan
            $surat = new SuratPanggilan;
            $surat->panggilan = $request->panggilan;
            $surat->terlapor = $request->terlapor;
            $surat->menghadap_kepada = $request->menghadap_kepada;
            $surat->hari = date('w', strtotime(DateTimeExt::change($request->tanggal)));
            $surat->tanggal = DateTimeExt::change($request->tanggal);
            $surat->jam = $request->jam.':00';
            $surat->tempat = $request->tempat;
            $surat->status = $request->status;
            $surat->pelanggaran = $request->pelanggaran;
            $surat->atasan = $request->atasan;
            $surat->ttd = $request->ttd;
            $surat->save();

            // Redirect
            return redirect()->route('admin.surat-panggilan.index')->with(['message' => 'Berhasil menambah data.']);
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

        // Surat panggilan
        $surat = SuratPanggilan::findOrFail($id);

        // View
        return view('admin/surat-panggilan/edit', [
            'surat' => $surat
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
            'panggilan' => 'required',
            'terlapor' => 'required',
            'menghadap_kepada' => 'required',
            'tanggal' => 'required',
            'jam' => 'required',
            'tempat' => 'required',
            'status' => 'required',
            'pelanggaran' => 'required',
            'atasan' => 'required',
            'ttd' => 'required',
        ]);
        
        // Check errors
        if($validator->fails()) {
            // Back to form page with validation error messages
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        else {
            // Mengupdate surat panggilan
            $surat = SuratPanggilan::find($request->id);
            $surat->panggilan = $request->panggilan;
            $surat->terlapor = $request->terlapor;
            $surat->menghadap_kepada = $request->menghadap_kepada;
            $surat->hari = date('w', strtotime(DateTimeExt::change($request->tanggal)));
            $surat->tanggal = DateTimeExt::change($request->tanggal);
            $surat->jam = $request->jam.':00';
            $surat->tempat = $request->tempat;
            $surat->status = $request->status;
            $surat->pelanggaran = $request->pelanggaran;
            $surat->atasan = $request->atasan;
            $surat->ttd = $request->ttd;
            $surat->save();

            // Redirect
            return redirect()->route('admin.surat-panggilan.index')->with(['message' => 'Berhasil mengupdate data.']);
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
        
        // Menghapus surat panggilan
        $surat = SuratPanggilan::find($request->id);
        $surat->delete();

        // Redirect
        return redirect()->route('admin.surat-panggilan.index')->with(['message' => 'Berhasil menghapus data.']);
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

        // Terlapor
        $terlapor = file_get_contents("https://simpeg.unnes.ac.id/index.php/gen_xml/json_nip_staff/".$surat->terlapor);
        $terlapor = json_decode($terlapor);
        $surat->terlapor = $terlapor->value;

        // Menghadap kepada
        $menghadap_kepada = file_get_contents("https://simpeg.unnes.ac.id/index.php/gen_xml/json_nip_staff/".$surat->menghadap_kepada);
        $menghadap_kepada = json_decode($menghadap_kepada);
        $surat->menghadap_kepada = $menghadap_kepada->value;

        // Atasan
        $ttd = file_get_contents("https://simpeg.unnes.ac.id/index.php/gen_xml/json_nip_staff/".$surat->ttd);
        $ttd = json_decode($ttd);
        $surat->ttd = $ttd->value;

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
        return $pdf->stream('Surat Panggilan '.$surat->panggilan.' - '.$surat->terlapor->nip_bar.'.pdf');
    }
}
