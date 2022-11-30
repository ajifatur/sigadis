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
    public $days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu'];

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

        if($request->ajax()) {
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

            return DataTables::of($surat)
                ->addColumn('checkbox', '
                    <input type="checkbox" class="form-check-input checkbox-one">
                ')
                ->addColumn('terlapor_text', '
                    {{ fullname($terlapor["nama"], $terlapor["gelar_depan"], $terlapor["gelar_belakang"]) }}
                    <br>
                    <span class="small text-muted">{{ $terlapor["nip"] }}</span>
                ')
                ->addColumn('menghadap_kepada_text', '
                    {{ fullname($menghadap_kepada["nama"], $menghadap_kepada["gelar_depan"], $menghadap_kepada["gelar_belakang"]) }}
                    <br>
                    <span class="small text-muted">{{ $menghadap_kepada["nip"] }}</span>
                ')
                ->addColumn('panggilan_text', function($data) {
                    $length = $data->panggilan;
                    $text = '';
                    for($i=1; $i<=$length; $i++) {
                        $text .= 'I';
                    }
                    return 'Panggilan '.$text;
                })
                ->addColumn('datetime', '
                    <span class="d-none">{{ $tanggal }}</span>
                    {{ date("d/m/Y", strtotime($tanggal)) }}
                    <br>
                    <span class="small text-muted">{{ date("H:i", strtotime($jam)) }} WIB</span>
                ')
                ->addColumn('options', '
                    <div class="btn-group">
                        <a href="{{ route(\'admin.surat-panggilan.print\', [\'id\' => $id]) }}" class="btn btn-sm btn-info" data-bs-toggle="tooltip" title="Cetak" target="_blank"><i class="bi-printer"></i></a>
                        <a href="{{ route(\'admin.surat-panggilan.edit\', [\'id\' => $id]) }}" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" title="Edit"><i class="bi-pencil"></i></a>
                        <a href="#" class="btn btn-sm btn-danger btn-delete" data-id="{{ $id }}" data-bs-toggle="tooltip" title="Hapus"><i class="bi-trash"></i></a>
                    </div>
                ')
                ->rawColumns(['checkbox', 'terlapor_text', 'menghadap_kepada_text', 'panggilan_text', 'datetime', 'options'])
                ->make(true);
        }

        // View
        return view('admin/surat-panggilan/index');
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

        $surat->hariIndo = $this->days[$surat->hari];
        $surat->tanggalIndo = DateTimeExt::full($surat->tanggal);

        // PDF
        $pdf = PDF::loadView('admin/surat-panggilan/print', [
            'surat' => $surat
        ]);
        return $pdf->stream('Surat Panggilan.pdf');
    }
}
