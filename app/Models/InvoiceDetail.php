<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    use HasFactory;
    protected $guarded = ["id"];

    public function toy(){
        return $this->belongsTo(Toy::class);
    }
}
