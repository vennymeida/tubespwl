<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request('search')) {
            $paginate = Barang::where('merk', 'like', '%' . request('search') . '%')
                                    ->orwhere('harga', 'like', '%' . request('search') . '%')
                                    ->orwhere('stok', 'like', '%' . request('search') . '%')
                                    ->orwhere('keterangan', 'like', '%' . request('search') . '%')->paginate(3); // Mengambil semua isi tabel
            return view('barang.index', ['paginate'=>$paginate]);
        }else{
        //fungsi eloquent menampilkan data menggunakan pagination
        $Barang = Barang::all();
        $paginate = Barang::orderBy('id','asc')->paginate(3);
        return view('barang.index', ['barang'=>$Barang,'paginate'=>$paginate]);
    }
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('barang.create');
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
            'Merk'=>'required',
            'Harga'=>'required',
            'Stok'=>'required',
            'Keterangan'=>'required',
        ]);

        // //fungsi eloquent untuk menambahkan data
        Barang::create($request->all());
        //jika data berhasil ditambahkan, akan kembali ke halaman utama
        return redirect()->route('barang.index')
        ->with('success','Barang Berhasil Ditambahakan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($merk)
    {
        //menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa
        $Barang = Barang::where('merk', $merk)->first();
        return view('barang.detail', compact('Barang'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($merk)
    {
        //menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa untuk diedit
        $Barang = DB::table('barangs')->where('merk', $merk)->first();
        return view('barang.edit', compact('Barang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $merk)
    {
        //melakukan validasi data
        $request->validate([
            'Merk'=>'required',
            'Harga'=>'required',
            'Stok'=>'required',
            'Keterangan'=>'required',
        ]);

        Barang::where('merk',$merk)
        ->update([
            'merk'=>$request->Merk,
            'harga'=>$request->Harga,
            'stok'=>$request->Stok,
            'keterangan'=>$request->Keterangan,
        ]);


        //jika data berhasil diupdate, akan kembali ke halaman utama
        return redirect()->route('barang.index')
        ->with('success','Barang Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($merk)
    {
        //fungsi eloquent untuk menghapus data
        Barang::where('merk',$merk)->delete();
        return redirect()->route('barang.index')
        ->with('success','Barang Berhasil Dihapus');
    }
};