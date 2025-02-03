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
        $bandwidth = Layanan::where('id_subkategori', $id_subkategori)->get(['bandwidth', 'satuan', 'harga']);

        if ($bandwidth->isEmpty()) {
            return response()->json([]);
        }
        return response()->json($bandwidth);
    }

    public function getDetails($details)
    {
        $details = Layanan::where('bandwidth', $details)->first(['bandwidth', 'satuan', 'harga']);

        if ($details) {
            return response()->json($details);
        } else {
            return response()->json([]);
        }
    }

}


