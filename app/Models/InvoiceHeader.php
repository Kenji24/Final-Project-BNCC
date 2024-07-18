<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceHeader extends Model
{
    use HasFactory, HasUuids;
    protected $guarded = ["id"];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function toy(){
        return $this->belongsTo(Toy::class);
    }
}
