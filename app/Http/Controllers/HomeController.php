<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Barang;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home()
    {
       return view('index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     return view('home');
    // }
    public function index()
    {
        $barangs = Barang ::paginate(20);
       $user = Auth::user();
       return view('main',['user' => $user,'barangs'=> $barangs]);
    }

    public function indexbarang()
    {
        $barangs = Barang ::paginate(20);
        return view('homepelanggan', compact ('barangs'));
    }
}
