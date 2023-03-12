<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ajifatur\Helpers\DateTimeExt;
use PDF;
use App\Models\Kasus;
use App\Models\Kephukdis;
use App\Models\Pelanggaran;
use App\Models\Hukdis;
use App\Models\SPMK;
use App\Models\Tembusan;
use App\Models\TembusanSurat;

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

        // Keputusan hukuman disiplin
        if($request->query('hukdis') == 'ringan') {
            $kephukdis = Kephukdis::whereHas('hukdis', function (Builder $query) {
                return $query->where('jenis_id','=',1);
            })->orderBy('created_at','desc')->get();
        }
        elseif($request->query('hukdis') == 'sedang') {
            $kephukdis = Kephukdis::whereHas('hukdis', function (Builder $query) {
                return $query->where('jenis_id','=',2);
            })->orderBy('created_at','desc')->get();
        }
        elseif($request->query('hukdis') == 'berat') {
            $kephukdis = Kephukdis::whereHas('hukdis', function (Builder $query) {
                return $query->where('jenis_id','=',3);
            })->orderBy('created_at','desc')->get();
        }

        // View
        return view('admin/kephukdis/index', [
            'kephukdis' => $kephukdis,
        ]);
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

        // Tembusan
        $tembusan = Tembusan::all();

        // View
        return view('admin/kephukdis/create', [
            'kasus' => $kasus,
            'surat_panggilan_1' => $surat_panggilan_1,
            'atasan' => $atasan,
            'bap' => $bap,
            'pelanggaran' => $pelanggaran,
            'hukdis' => $hukdis,
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
            'tanggal_pelanggaran' => 'required',
            'nomor' => 'required',
            'keputusan' => 'required',
            'hukdis' => 'required',
            'hukdis' => 'required',
            'tanggal_ditetapkan' => 'required',
            'tempat_ditetapkan' => 'required',
            'nama_pejabat' => 'required',
            'nip_pejabat' => 'required',
            'jabatan_pejabat' => 'required',
            'tmt' => in_array($request->hukdis, [4,5,6,7,8]) ? 'required' : '',
            'tukin' => in_array($request->hukdis, [4,5,6]) ? 'required' : '',
            'tmt_pengembalian' => in_array($request->hukdis, [4,5,6]) ? 'required' : '',
            'jabatan_setelah_diturunkan' => in_array($request->hukdis, [7]) ? 'required' : '',
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

            // Simpan keputusan hukuman disiplin
            $kephukdis = Kephukdis::find($request->id);
            if(!$kephukdis) $kephukdis = new Kephukdis;
            $kephukdis->kasus_id = $request->kasus_id;
            $kephukdis->pelanggaran_id = $request->pelanggaran_id;
            $kephukdis->hukdis_id = $request->hukdis;
            $kephukdis->nomor = $request->nomor;
            $kephukdis->terlapor = $request->terlapor;
            $kephukdis->terlapor_json = json_encode([
                'nama' => fullname($simpeg_terlapor->nama, $simpeg_terlapor->gelar_dpn, $simpeg_terlapor->gelar_blk),
                'nip' => $simpeg_terlapor->nip_bar,
                'pangkat' => $simpeg_terlapor->pangkat,
                'jabatan' => $simpeg_terlapor->jabatan,
                'unit' => $simpeg_terlapor->nama_unit,
            ]);
            $kephukdis->tmt = $request->tmt != '' ? DateTimeExt::change($request->tmt) : null;
            $kephukdis->tukin = $request->tukin != '' ? preg_replace('/[^0-9]/', '', $request->tukin) : null;
            $kephukdis->tmt_pengembalian = $request->tmt_pengembalian != '' ? DateTimeExt::change($request->tmt_pengembalian) : null;
            $kephukdis->jabatan_setelah_diturunkan = $request->jabatan_setelah_diturunkan;
            $kephukdis->keputusan = $request->keputusan;
            $kephukdis->dugaan_pelanggaran = $request->dugaan_pelanggaran;
            $kephukdis->tanggal_pelanggaran = DateTimeExt::change($request->tanggal_pelanggaran);
            $kephukdis->tanggal_ditetapkan = DateTimeExt::change($request->tanggal_ditetapkan);
            $kephukdis->tempat_ditetapkan = $request->tempat_ditetapkan;
            $kephukdis->nama_pejabat = $request->nama_pejabat;
            $kephukdis->nip_pejabat = $request->nip_pejabat;
            $kephukdis->jabatan_pejabat = $request->jabatan_pejabat;
            $kephukdis->save();

            // Simpan tembusan surat
            TembusanSurat::where('table_id','=',$kephukdis->id)->where('table_name','=','tbl_kephukdis')->delete();
            foreach($request->tembusan as $t) {
                $tembusan_surat = new TembusanSurat;
                $tembusan_surat->tembusan_id = $t;
                $tembusan_surat->table_id = $kephukdis->id;
                $tembusan_surat->table_name = 'tbl_kephukdis';
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

        // Tembusan
        $tembusan = Tembusan::all();

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
        
        // Menghapus keputusan hukdis
        $kephukdis = Kephukdis::find($request->id);
        $kephukdis->delete();

        // Menghapus surat panggilan menerima keputusan hukdis (jika ada)
        $spmk = SPMK::where('kasus_id','=',$kephukdis->kasus->id)->first();
        if($spmk) $spmk->delete();

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

        // Keputusan hukuman disiplin
        $kephukdis = Kephukdis::findOrFail($id);
        $kephukdis->terlapor_json = json_decode($kephukdis->terlapor_json);

        // File
        if(in_array($kephukdis->hukdis_id, [1,2,3]))
            $file = 'print-ringan';
        elseif(in_array($kephukdis->hukdis_id, [4,5,6]))
            $file = 'print-sedang';
        elseif(in_array($kephukdis->hukdis_id, [7]))
            $file = 'print-berat-1';
        elseif(in_array($kephukdis->hukdis_id, [8]))
            $file = 'print-berat-2';
        elseif(in_array($kephukdis->hukdis_id, [9]))
            $file = 'print-berat-3';

        // Tembusan
        $tembusan = TembusanSurat::where('table_id','=',$kephukdis->id)->where('table_name','=','tbl_kephukdis')->get();

        // PDF
        $pdf = PDF::loadView('admin/kephukdis/'.$file, [
            'kephukdis' => $kephukdis,
            'tembusan' => $tembusan
        ]);
        return $pdf->stream('Keputusan Hukuman Disiplin - '.$kephukdis->kasus->terduga_nip.'.pdf');
    }
}
