<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ajifatur\Helpers\DateTimeExt;
use PDF;
use DataTables;
use App\Models\BeritaAcaraPemeriksaan;
use App\Models\TimPemeriksa;

class BeritaAcaraPemeriksaanController extends Controller
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

            // Berita acara pemeriksaan
            $berita = BeritaAcaraPemeriksaan::orderBy('created_at','desc')->get();
            foreach($berita as $key=>$b) {
                foreach($simpeg as $si) {
                    if($si['nip'] == $b->terlapor) $b->terlapor = $si;
                }
            }

            return DataTables::of($berita)
                ->addColumn('checkbox', '
                    <input type="checkbox" class="form-check-input checkbox-one">
                ')
                ->addColumn('terlapor_text', '
                    {{ fullname($terlapor["nama"], $terlapor["gelar_depan"], $terlapor["gelar_belakang"]) }}
                    <br>
                    <span class="small text-muted">{{ $terlapor["nip"] }}</span>
                ')
                ->addColumn('datetime', '
                    <span class="d-none">{{ $tanggal }}</span>
                    {{ date("d/m/Y", strtotime($tanggal)) }}
                ')
                ->addColumn('options', '
                    <div class="btn-group">
                        <a href="{{ route(\'admin.berita-acara-pemeriksaan.print\', [\'id\' => $id]) }}" class="btn btn-sm btn-info" data-bs-toggle="tooltip" title="Cetak" target="_blank"><i class="bi-printer"></i></a>
                        <a href="{{ route(\'admin.berita-acara-pemeriksaan.edit\', [\'id\' => $id]) }}" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" title="Edit"><i class="bi-pencil"></i></a>
                        <a href="#" class="btn btn-sm btn-danger btn-delete" data-id="{{ $id }}" data-bs-toggle="tooltip" title="Hapus"><i class="bi-trash"></i></a>
                    </div>
                ')
                ->rawColumns(['checkbox', 'terlapor_text', 'datetime', 'options'])
                ->make(true);
        }

        // View
        return view('admin/berita-acara-pemeriksaan/index');
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
        return view('admin/berita-acara-pemeriksaan/create');
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
            $berita = new BeritaAcaraPemeriksaan;
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
            return redirect()->route('admin.berita-acara-pemeriksaan.index')->with(['message' => 'Berhasil menambah data.']);
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
        $berita = BeritaAcaraPemeriksaan::findOrFail($id);
        $berita->qna = json_decode($berita->qna, true);

        // View
        return view('admin/berita-acara-pemeriksaan/edit', [
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
            $berita = BeritaAcaraPemeriksaan::find($request->id);
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
            return redirect()->route('admin.berita-acara-pemeriksaan.index')->with(['message' => 'Berhasil mengupdate data.']);
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
        $berita = BeritaAcaraPemeriksaan::find($request->id);
        $berita->delete();

        // Redirect
        return redirect()->route('admin.berita-acara-pemeriksaan.index')->with(['message' => 'Berhasil menghapus data.']);
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
        $berita = BeritaAcaraPemeriksaan::findOrFail($id);

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

        $berita->hariIndo = $this->days[$berita->hari];
        $berita->bulanIndo = DateTimeExt::month(date('m', strtotime($berita->tanggal)));
        $berita->tanggalIndo = DateTimeExt::full($berita->tanggal);
        $berita->qna = json_decode($berita->qna, true);

        // PDF
        $pdf = PDF::loadView('admin/berita-acara-pemeriksaan/print', [
            'berita' => $berita
        ]);
        return $pdf->stream('Berita Acara Pemeriksaan.pdf');
    }
}
