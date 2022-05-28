<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\DB;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request('search')) {
            $paginate = Pelanggan::where('nik', 'like', '%' . request('search') . '%')
                                    ->orwhere('nama', 'like', '%' . request('search') . '%')
                                    ->orwhere('alamat', 'like', '%' . request('search') . '%')
                                    ->orwhere('telepom', 'like', '%' . request('search') . '%')->paginate(3); // Mengambil semua isi tabel
            return view('pelanggan.index', ['paginate'=>$paginate]);
        }else{
        //fungsi eloquent menampilkan data menggunakan pagination
        $Pelanggan = Pelanggan::all();
        $paginate = Pelanggan::orderBy('id_pelanggan','asc')->paginate(3);
        return view('pelanggan.index', ['pelanggan'=>$Pelanggan,'paginate'=>$paginate]);
    }
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pelanggan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // if ($request->file('image')){
        //     $image_name = $request->file('image')->store('images','public');
        // }
        //melakukan validasi data
        $request->validate([
            'Nik'=>'required',
            'Nama'=>'required',
            'Alamat'=>'required',
            'Telepon'=>'required',
        ]);

        // //fungsi eloquent untuk menambahkan data
        Pelanggan::create($request->all());
        //jika data berhasil ditambahkan, akan kembali ke halaman utama
        return redirect()->route('pelanggan.index')
        ->with('success','Pelanggan Berhasil Ditambahakan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($nik)
    {
        //menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa
        $Pelanggan = Pelanggan::where('nik', $nik)->first();
        return view('pelanggan.detail', compact('Pelanggan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($nik)
    {
        //menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa untuk diedit
        $Pelanggan = DB::table('pelanggan')->where('nik', $nik)->first();
        return view('pelanggan.edit', compact('Pelanggan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nik)
    {
        //melakukan validasi data
        $request->validate([
            'Nik'=>'required',
            'Nama'=>'required',
            'Alamat'=>'required',
            'Telepon'=>'required',
        ]);

        Pelanggan::where('nik',$nik)
        ->update([
            'nik'=>$request->Nik,
            'nama'=>$request->Nama,
            'alamat'=>$request->Alamat,
            'telepon'=>$request->Telepon,
        ]);


        //jika data berhasil diupdate, akan kembali ke halaman utama
        return redirect()->route('pelanggan.index')
        ->with('success','Pelanggan Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($nik)
    {
        //fungsi eloquent untuk menghapus data
        Pelanggan::where('nik',$nik)->delete();
        return redirect()->route('pelanggan.index')
        ->with('success','Pelanggan Berhasil Dihapus');
    }
};