<?php

namespace App\Models;

use App\Models\Subcategory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;

    protected $table = 'layanan';
    protected $primaryKey = 'id_layanan';
    public $incrementing = false;
    protected $keyType = 'integer';
    protected $fillable = ['id_layanan', 'id_subkategori', 'bandwidth', 'satuan', 'harga'];

    public function subkategori()
    {
        return $this->belongsTo(Subcategory::class, 'id_subkategori', 'id_subkategori');
    }
}
