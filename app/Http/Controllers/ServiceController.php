<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Layanan;


class ServiceController extends Controller
{
    public function index()
    {
        $kategori = Category::all();
        return view('services', compact('kategori'));
    }

    public function getSubkategori($id_kategori)
    {
        $subkategori = Subcategory::where('id_kategori', $id_kategori)->get();
        return response()->json($subkategori);
    }

    public function getBandwidth($id_subkategori)
    {
        $bandwidth = Layanan::where('id_subkategori', $id_subkategori)->get(['id_layanan', 'bandwidth']);

        return response()->json($bandwidth);
    }

}


