<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Warehouse;

class Import_product extends Model
{
    use HasFactory;
    protected $table="import_products";
    public function Warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class,'id_book','id_book');
    }
}
