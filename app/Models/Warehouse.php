<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Book;
use App\Models\Import_product;

class Warehouse extends Model
{
    use HasFactory;
    protected $table="warehouses";
    public function Book(): HasOne
    {
        return $this->hasOne(Book::class, 'id', 'id_book');
    }
    public function importProduct(): HasMany{
        return $this->hasMany(Import_product::class,'id_book','id_book');
    }
}
