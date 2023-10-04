<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Bill_Detail;
use App\Models\Type_book;
use App\Models\Supplier;
use App\Models\Author;
use App\Models\Warehouse;

class Book extends Model
{
    use HasFactory;
    protected $Table = 'books'; 
    public function billDetail(): HasMany{
        return $this->hasMany(Bill_Detail::class,'id_book','id');
    }
    public function Typebook(): BelongsTo
    {
        return $this->belongsTo(Type_book::class,'id_type','id');
    }
    public function Supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class,'id_supplier','id');
    }
    public function Author(): BelongsTo
    {
        return $this->belongsTo(Author::class,'id_author','id');
    }
    public function Warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class, 'id', 'id_book');
    }
}
