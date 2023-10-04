<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Bill;
use App\Models\Book;

class Bill_Detail extends Model
{
    use HasFactory;
    protected $table="bill_details";
    public function bill(): BelongsTo
    {
        return $this->belongsTo(Bill::class,'id_bill','id');
    }
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class,'id_book','id');
    }
}
