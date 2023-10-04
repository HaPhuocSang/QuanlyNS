<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Book;

class Supplier extends Model
{
    use HasFactory;
    protected $table="suppliers";
    public function book(): Hasmany
    {
        return $this->hasmany(Book::class,'id_supplier','id');
    }
}
