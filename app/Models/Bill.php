<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use App\Models\Bill_Detail;

class Bill extends Model
{
    use HasFactory;
    protected $table="bills";
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'id_user','id');
    }
    public function billDetail(): HasMany
    {
        return $this->hasmany(Bill_Detail::class,'id_bill','id');
    }

}
