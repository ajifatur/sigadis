<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ajifatur\Helpers\DateTimeExt;
use App\Models\Terduga;
use App\Models\BAP;

class TerdugaController extends Controller
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

        // Terduga
        $terduga = Terduga::latest()->get();

        // View
        return view('admin/terduga/index', [
            'terduga' => $terduga
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
        return view('admin/terduga/create');
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

            // Simpan terduga
            $terduga = new Terduga;
            $terduga->terduga = $request->terduga;
            $terduga->terduga_nip = $simpeg->nip_bar;
            $terduga->terduga_nama = fullname($simpeg->nama, $simpeg->gelar_dpn, $simpeg->gelar_blk);
            $terduga->dugaan_pelanggaran = $request->dugaan_pelanggaran;
            $terduga->save();

            // Redirect
            return redirect()->route('admin.terduga.index')->with(['message' => 'Berhasil menambah data.']);
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

        // Terduga
        $terduga = Terduga::findOrFail($id);
        
        // Surat panggilan
        $surat_panggilan_1 = $terduga->surat_panggilan->where('panggilan','=',1)->first();
        $surat_panggilan_2 = $terduga->surat_panggilan->where('panggilan','=',2)->first();

        // BAP
        $bap = $terduga->bap->first();

        // View
        return view('admin/terduga/detail', [
            'terduga' => $terduga,
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

        // Terduga
        $terduga = Terduga::findOrFail($id);

        // View
        return view('admin/terduga/edit', [
            'terduga' => $terduga
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
            $terduga = Terduga::find($request->id);
            $terduga->terduga = $request->terduga;
            $terduga->terduga_nip = $simpeg->nip_bar;
            $terduga->terduga_nama = fullname($simpeg->nama, $simpeg->gelar_dpn, $simpeg->gelar_blk);
            $terduga->dugaan_pelanggaran = $request->dugaan_pelanggaran;
            $terduga->save();

            // Redirect
            return redirect()->route('admin.terduga.index')->with(['message' => 'Berhasil mengupdate data.']);
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
        $terduga = Terduga::find($request->id);
        $terduga->delete();

        // Redirect
        return redirect()->route('admin.terduga.index')->with(['message' => 'Berhasil menghapus data.']);
    }
}
