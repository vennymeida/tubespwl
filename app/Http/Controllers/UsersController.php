<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request('search')) {
            $paginate = User::where('name', 'like', '%' . request('search') . '%')
                                    ->orwhere('email', 'like', '%' . request('search') . '%')
                                    ->orwhere('alamat', 'like', '%' . request('search') . '%')
                                    ->orwhere('role', 'like', '%' . request('search') . '%')->paginate(10); // Mengambil semua isi tabel
            return view('user.index', ['paginate'=>$paginate]);
        }else{
        //fungsi eloquent menampilkan data menggunakan pagination
        $User = User::all();
        $paginate = User::orderBy('id','asc')->paginate(10);
        return view('user.index', ['user'=>$User,'paginate'=>$paginate]);
    }
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
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
            'Name'=>'required',
            'Email'=>'required',
            'Alamat'=>'required',
            'Nohp'=>'required',
            'Role'=>'required',
        ]);

        // //fungsi eloquent untuk menambahkan data
        User::create($request->all());
        //jika data berhasil ditambahkan, akan kembali ke halaman utama
        return redirect()->route('user.index')
        ->with('success','User Berhasil Ditambahakan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa
        $User = User::where('id', $id)->first();
        return view('user.detail', compact('User'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa untuk diedit
        $User = DB::table('users')->where('id', $id)->first();
        return view('user.edit', compact('User'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //melakukan validasi data
        $request->validate([
            'Name'=>'required',
            'Email'=>'required',
            'Alamat'=>'required',
            'Nohp'=>'required',
            'Role'=>'required',
        ]);

        User::where('id',$id)
        ->update([
            'name'=>$request->Name,
            'email'=>$request->Email,
            'alamat'=>$request->Alamat,
            'nohp'=>$request->Nohp,
            'role'=>$request->Role,
        ]);


        //jika data berhasil diupdate, akan kembali ke halaman utama
        return redirect()->route('user.index')
        ->with('success','Users Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        //fungsi eloquent untuk menghapus data
        User::where('id', $id)->delete();
        return redirect()->route('user.index')
            -> with('success', 'User Berhasil Dihapus');
    }
};