<?php

namespace App\Http\Controllers;
use App\Models\Pengaduan;
use App\Support\Facades\Auth;
use App\Support\Facades\Hash;
use DB;

use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    public function index() {
        $pengaduan = Pengaduan::all();
        return view('masyarakat.dashboard',compact('pengaduan'));
    }

    public function create() {

        return view('masyarakat.create');
    }

    public function store(Request $request) {

        $this->validate($request,[
            'id_pengaduan'  => 'max:15',
            // 'tgl_pengaduan' => 'required',
            'nik'           => 'required|max:13',
            'isi_laporan'   => 'required|max:255',
            'foto'          => 'required|image|mimes:jpeg,png,jpg,gif',
            'status',
        ]);


        $image = $request->file('foto');
        $image->storeAs('public/images', $image->hashName());

        Pengaduan::create([
            'id_pengaduan'      => $request->id_pengaduan,
            'tgl_pengaduan'     => date('Y-m-d'),
            'nik'               => $request->nik,
            'isi_laporan'       => $request->isi_laporan,
            'foto'              => $image->hashName(),
            'status',
        ]);

        return redirect()->route('masyarakat.dashboard');
    }

    public function show($id) {

        // $pengaduan = Pengaduan::find($id);
        $pengaduan = DB::table('pengaduans')->where('id_pengaduan',$id)->first();
        return view('masyarakat.show', compact('pengaduan'));
    }

    public function edit($id) {

        $pengaduan  = DB::table('pengaduans')->where('id_pengaduan',$id)->first();
        return view('masyarakat.edit', compact('pengaduan'));
    }

    public function update(Request $request,$id) {

    }

    public function delete($id) {

        $pengaduan = Pengaduan::delete($id);

        return redirect()->route('masyarakat.dashboard');
    }


}
