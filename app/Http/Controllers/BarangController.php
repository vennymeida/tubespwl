<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;
use PDF;
use Illuminate\Support\Facades\Storage;
use Google\Cloud\Storage\StorageClient;
use Illuminate\Support\Facades\URL;
use Google\Cloud\Core\Exception\NotFoundException;

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
                                    ->orwhere('keterangan', 'like', '%' . request('search') . '%')->paginate(10); // Mengambil semua isi tabel
            return view('barang.index', ['paginate'=>$paginate]);
        }else{
        //fungsi eloquent menampilkan data menggunakan pagination
        $Barang = Barang::all();
        $paginate = Barang::orderBy('id','asc')->paginate(10);
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
        //melakukan validasi data
        $request->validate([
            'Merk'=>'required',
            'Harga'=>'required',
            'Stok'=>'required',
            'Keterangan'=>'required',
            'featured_image' => 'required',
        ]);

        $image_name = '';
        if ($request->file('featured_image')) {
            $image_name = $request->file('featured_image')->store('images', 'public');
        }

        $image_name = '';
        if ($request->file('featured_image')) {
            $image_name = $request->file('featured_image');
            // $image_name = $request->file('featured_image')->store('images', 'public');
            $storage = new StorageClient([
                'keyFilePath' => public_path('key.json')
            ]);

            $bucketName = env('GOOGLE_CLOUD_BUCKET');
            $bucket = $storage->bucket($bucketName);

            //get filename with extension
            $filenamewithextension = pathinfo($request->file('featured_image')->getClientOriginalName(), PATHINFO_FILENAME);
            // $filenamewithextension = $request->file('featured_image')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('featured_image')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename . '_' . uniqid() . '.' . $extension;

            Storage::put('public/uploads/' . $filenametostore, fopen($request->file('featured_image'), 'r+'));

            $filepath = storage_path('app/public/uploads/' . $filenametostore);

            $object = $bucket->upload(
                fopen($filepath, 'r'),
                [
                    'predefinedAcl' => 'publicRead'
                ]
            );

            // delete file from local disk
            Storage::delete('public/uploads/' . $filenametostore);
        }

        
        $Barang = new Barang;
        $Barang->merk = $request->get('Merk');
        $Barang->harga = $request->get('Harga');
        $Barang->stok = $request->get('Stok');
        $Barang->keterangan = $request->get('Keterangan');
        $Barang->featured_image = $filenametostore;
        // dd($Barang->featured_image);
        // //fungsi eloquent untuk menambahkan data
        $Barang->save();
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
            'featured_image' => 'required',
        ]);
        $Barang = Barang::where('merk',$merk)->first();
        Barang::where('merk',$merk)
        ->update([
            'merk'=>$request->Merk,
            'harga'=>$request->Harga,
            'stok'=>$request->Stok,
            'keterangan'=>$request->Keterangan,
        ]);

        if ($Barang->featured_image && file_exists(storage_path('app/public/'. $Barang->featured_image))) {
            Storage::delete('public/'. $Barang->featured_image);
        }

        $image_name = '';
        if ($request->file('featured_image')) {
        $image_name = $request->file('featured_image')->store('images', 'public');
        }

        $Barang->featured_image = $image_name;
        $Barang->save();

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
        Barang::where('merk', $merk)->delete();
        return redirect()->route('barang.index')
            -> with('success', 'Barang Berhasil Dihapus');
    }

    public function barang_pdf()
    {
        $Barang = Barang::all();
        $pdf = PDF::loadview('barang.barang_pdf',['barang'=>$Barang]);
        return $pdf->stream();
    }
};