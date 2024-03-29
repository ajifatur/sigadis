<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ajifatur\Helpers\DateTimeExt;
use PDF;
use App\Models\Kasus;
use App\Models\KPTS;
use App\Models\Pelanggaran;
use App\Models\Tembusan;
use App\Models\TembusanSurat;

class KPTSController extends Controller
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

        // Keputusan
        $keputusan = [
            ['id' => 1, 'nama' => 'Menteri Pendidikan, Kebudayaan, Riset dan Teknologi'],
            ['id' => 2, 'nama' => 'Rektor']
        ];

        // Tembusan
        $tembusan = Tembusan::all();

        // View
        return view('admin/kpts/create', [
            'kasus' => $kasus,
            'surat_panggilan_1' => $surat_panggilan_1,
            'atasan' => $atasan,
            'bap' => $bap,
            'pelanggaran' => $pelanggaran,
            'keputusan' => $keputusan,
            'tembusan' => $tembusan,
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
            'tanggal_ditetapkan' => 'required',
            'tempat_ditetapkan' => 'required',
            'tembusan' => 'required',
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

            // SIMPEG Atasan
            $simpeg_atasan = file_get_contents("https://simpeg.unnes.ac.id/index.php/gen_xml/json_nip_staff/".$request->atasan);
            $simpeg_atasan = json_decode($simpeg_atasan);
            $simpeg_atasan = $simpeg_atasan->value;
            $p = explode(' ', $simpeg_atasan->pangkat);
            array_pop($p);
            $simpeg_atasan->pangkat = implode(' ', $p);

            // Simpan keputusan pembebasan tugas sementara
            $kpts = KPTS::find($request->id);
            if(!$kpts) $kpts = new KPTS;
            $kpts->kasus_id = $request->kasus_id;
            $kpts->pelanggaran_id = $request->pelanggaran_id;
            $kpts->terlapor = $request->terlapor;
            $kpts->terlapor_json = json_encode([
                'nama' => fullname($simpeg_terlapor->nama, $simpeg_terlapor->gelar_dpn, $simpeg_terlapor->gelar_blk),
                'nip' => $simpeg_terlapor->nip_bar,
                'pangkat' => $simpeg_terlapor->pangkat,
                'jabatan' => $simpeg_terlapor->jabatan,
                'unit' => $simpeg_terlapor->nama_unit,
            ]);
            $kpts->keputusan = $request->keputusan;
            $kpts->tanggal_ditetapkan = DateTimeExt::change($request->tanggal_ditetapkan);
            $kpts->tempat_ditetapkan = $request->tempat_ditetapkan;
            $kpts->atasan = $request->atasan;
            $kpts->atasan_json = json_encode([
                'nama' => fullname($simpeg_atasan->nama, $simpeg_atasan->gelar_dpn, $simpeg_atasan->gelar_blk),
                'nip' => $simpeg_atasan->nip_bar,
                'pangkat' => $simpeg_atasan->pangkat,
                'jabatan' => $simpeg_atasan->jabatan,
                'unit' => $simpeg_atasan->nama_unit,
            ]);
            $kpts->save();

            // Simpan tembusan surat
            TembusanSurat::where('table_id','=',$kpts->id)->where('table_name','=','tbl_kpts')->delete();
            foreach($request->tembusan as $t) {
                $tembusan_surat = new TembusanSurat;
                $tembusan_surat->tembusan_id = $t;
                $tembusan_surat->table_id = $kpts->id;
                $tembusan_surat->table_name = 'tbl_kpts';
                $tembusan_surat->save();
            }

            // Redirect
            return redirect()->route('admin.kasus.detail', ['id' => $request->kasus_id])->with(['message' => 'Berhasil memperbarui data.']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param  int  $kpts_id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $kpts_id)
    {
        // Check the access
        // has_access(method(__METHOD__), Auth::user()->role_id);

        // Kasus
        $kasus = Kasus::findOrFail($id);

        // keputusan pembebasan tugas sementara
        $kpts = KPTS::findOrFail($kpts_id);

        // Surat panggilan 1
        $surat_panggilan_1 = $kasus->surat_panggilan->where('panggilan','=',1)->first();

        // Atasan
        $atasan = $surat_panggilan_1 ? json_decode($surat_panggilan_1->atasan_json) : [];

        // BAP
        $bap = $kasus->bap->first();

        // Pelanggaran
        $pelanggaran = Pelanggaran::all();

        // Keputusan
        $keputusan = [
            ['id' => 1, 'nama' => 'Menteri Pendidikan, Kebudayaan, Riset dan Teknologi'],
            ['id' => 2, 'nama' => 'Rektor']
        ];

        // Tembusan
        $tembusan = Tembusan::all();

        // View
        return view('admin/kpts/edit', [
            'kasus' => $kasus,
            'kpts' => $kpts,
            'surat_panggilan_1' => $surat_panggilan_1,
            'atasan' => $atasan,
            'bap' => $bap,
            'pelanggaran' => $pelanggaran,
            'keputusan' => $keputusan,
            'tembusan' => $tembusan
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
        
        // Menghapus keputusan pembebasan tugas sementara
        $kpts = KPTS::find($request->id);
        $kpts->delete();

        // Redirect
        return redirect()->route('admin.kasus.detail', ['id' => $kpts->kasus->id])->with(['message' => 'Berhasil menghapus data.']);
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

        // Keputusan pembebasan tugas sementara
        $kpts = KPTS::findOrFail($id);
        $kpts->terlapor_json = json_decode($kpts->terlapor_json);
        $kpts->atasan_json = json_decode($kpts->atasan_json);

        // Tembusan
        $tembusan = TembusanSurat::where('table_id','=',$kpts->id)->where('table_name','=','tbl_kpts')->get();

        // PDF
        $pdf = PDF::loadView('admin/kpts/print', [
            'kpts' => $kpts,
            'tembusan' => $tembusan
        ]);
        return $pdf->stream('Keputusan Pembebasan Tugas Sementara - '.$kpts->kasus->terduga_nip.'.pdf');
    }
}
