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
        $categories = Category::all();
        return view('services', compact('categories'));
    }

    public function getSubcategories($categoryId)
    {
        $subcategories = Subcategory::where('id_kategori', $categoryId)->get();
        return response()->json($subcategories);
    }

    public function getBandwidth($subcategoryId)
    {
        $bandwidth = Layanan::where('id_subkategori', $subcategoryId)->get();
        return response()->json($bandwidth);
    }

    public function getHarga($bandwidthId)
    {
        $layanan = Layanan::find($bandwidthId);
        if ($layanan) {
            return response()->json($layanan);
        }
        return response()->json(['harga' => 'Harga tidak ditemukan'], 404);
    }
}


