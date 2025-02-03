<?php

namespace App\Models;

use App\Models\Category;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;
    protected $table = 'subkategori';
    protected $primaryKey = 'id_subkategori';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['id_subkategori', 'id_kategori', 'subkategori'];

    public function kategori()
    {
        return $this->belongsTo(Category::class, 'id_kategori', 'id_kategori');
    }
    
    public function layanan()
    {
        return $this->hasMany(Layanan::class, 'id_subkategori', 'id_subkategori');
    }
}
