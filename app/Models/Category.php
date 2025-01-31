<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';
    public $timestamps = false;
    protected $fillable = [
        'id_kategori', 
        'kategori',
    ];

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class, 'id_kategori'); 
    }
}

