<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ajifatur\Helpers\DateTimeExt;
use App\Models\Kasus;

class KasusController extends Controller
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

        // Kasus
        $kasus = Kasus::latest()->get();

        foreach($kasus as $key=>$k) {
            if($k->bap()->first())
                $kasus[$key]->progress = 'BAP';
            elseif($k->surat_panggilan->where('panggilan','=',2)->first())
                $kasus[$key]->progress = 'Surat Panggilan II';
            elseif($k->surat_panggilan->where('panggilan','=',1)->first())
                $kasus[$key]->progress = 'Surat Panggilan I';
            else
                $kasus[$key]->progress = '-';
        }

        // View
        return view('admin/kasus/index', [
            'kasus' => $kasus
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
        return view('admin/kasus/create');
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
            'terduga' => 'required',
            'dugaan_pelanggaran' => 'required',
        ]);
        
        // Check errors
        if($validator->fails()) {
            // Back to form page with validation error messages
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        else {
            // SIMPEG Terduga
            $simpeg = file_get_contents("https://simpeg.unnes.ac.id/index.php/gen_xml/json_nip_staff/".$request->terduga);
            $simpeg = json_decode($simpeg);
            $simpeg = $simpeg->value;

            // Simpan kasus
            $kasus = new Kasus;
            $kasus->terduga = $request->terduga;
            $kasus->terduga_nip = $simpeg->nip_bar;
            $kasus->terduga_nama = fullname($simpeg->nama, $simpeg->gelar_dpn, $simpeg->gelar_blk);
            $kasus->dugaan_pelanggaran = $request->dugaan_pelanggaran;
            $kasus->save();

            // Redirect
            return redirect()->route('admin.kasus.index')->with(['message' => 'Berhasil menambah data.']);
        }
    }

    /**
     * Show the detail from the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        // Check the access
        // has_access(method(__METHOD__), Auth::user()->role_id);

        // Kasus
        $kasus = Kasus::findOrFail($id);
        
        // Surat panggilan
        $surat_panggilan_1 = $kasus->surat_panggilan->where('panggilan','=',1)->first();
        $surat_panggilan_2 = $kasus->surat_panggilan->where('panggilan','=',2)->first();

        // BAP
        $bap = $kasus->bap->first();

        // View
        return view('admin/kasus/detail', [
            'kasus' => $kasus,
            'surat_panggilan_1' => $surat_panggilan_1,
            'surat_panggilan_2' => $surat_panggilan_2,
            'bap' => $bap,
        ]);
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

        // Kasus
        $kasus = Kasus::findOrFail($id);

        // View
        return view('admin/kasus/edit', [
            'kasus' => $kasus
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
            'terduga' => 'required',
            'dugaan_pelanggaran' => 'required',
        ]);
        
        // Check errors
        if($validator->fails()) {
            // Back to form page with validation error messages
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        else {
            // SIMPEG Terduga
            $simpeg = file_get_contents("https://simpeg.unnes.ac.id/index.php/gen_xml/json_nip_staff/".$request->terduga);
            $simpeg = json_decode($simpeg);
            $simpeg = $simpeg->value;

            // Mengupdate terduga
            $kasus = Kasus::find($request->id);
            $kasus->terduga = $request->terduga;
            $kasus->terduga_nip = $simpeg->nip_bar;
            $kasus->terduga_nama = fullname($simpeg->nama, $simpeg->gelar_dpn, $simpeg->gelar_blk);
            $kasus->dugaan_pelanggaran = $request->dugaan_pelanggaran;
            $kasus->save();

            // Redirect
            return redirect()->route('admin.kasus.index')->with(['message' => 'Berhasil mengupdate data.']);
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
        
        // Menghapus terduga
        $kasus = Kasus::find($request->id);
        $kasus->delete();

        // Redirect
        return redirect()->route('admin.kasus.index')->with(['message' => 'Berhasil menghapus data.']);
    }
}
