<?php

namespace App\Models;
use App\Models\Subcategory;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $table = 'layanan';
    protected $primaryKey = 'id_layanan';
    public $incrementing = false;
    protected $fillable = [
        'id_layanan',
        'id_subkategori',
        'bandwidth',
        'satuan',
        'harga',
    ];

    public function subkategori()
    {
        return $this->belongsTo(Subcategory::class, 'id_subkategori');
    }
}
