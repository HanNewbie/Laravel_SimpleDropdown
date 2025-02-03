<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['id_kategori', 'kategori'];

    public function subkategori()
    {
        return $this->hasMany(Subcategory::class, 'id_kategori', 'id_kategori');
    }
}

