<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Bill;

class Customer extends Model
{
    use HasFactory;
    protected $table="customers";
    public function bill(): Hasmany
    {
        return $this->hasmany(Bill::class,'id_customer','id');
    }

}
