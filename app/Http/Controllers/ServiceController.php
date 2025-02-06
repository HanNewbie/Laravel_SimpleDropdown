<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Layanan;

class ServiceController extends Controller
{
    //FUNGSI UNTUK MENAMPILKAN HALAMAN SERVICES DAN MENGAMBIL DATA KATEGORI
    public function index()
    {
        $kategori = Category::all();
        return view('services', compact('kategori'));
    }

    //FUNGSI UNTUK MENGAMBIL DATA SUBKATEGORI BERDASARKAN ID KATEGORI
    public function getSubkategori($id_kategori)
    {
        $subkategori = Subcategory::where('id_kategori', $id_kategori)->get();
        return response()->json($subkategori);
    }

    //FUNGSI UNTUK MENGAMBIL DATA BANDWIDTH BERDASARKAN ID SUBKATEGORI
    public function getBandwidth($id_subkategori)
    {
        $bandwidth = Layanan::where('id_subkategori', $id_subkategori)->get(['bandwidth', 'satuan', 'harga']);

        if ($bandwidth->isEmpty()) {
            return response()->json([]);
        }
        return response()->json($bandwidth);
    }

    //FUNGSI UNTUK MENGAMBIL DETAIL LAYANAN BERDASARKAN BANDWIDTH
    public function getDetails(Request $request, $bandwidth)
    {
        $id_subkategori = $request->input('id_subkategori');

        $details = Layanan::where('bandwidth', $bandwidth)
            ->where('id_subkategori', $id_subkategori)
            ->first(['bandwidth', 'satuan', 'harga']);

        if ($details) {
            return response()->json($details);
        } else {
            return response()->json([]);
        }
    }
}



