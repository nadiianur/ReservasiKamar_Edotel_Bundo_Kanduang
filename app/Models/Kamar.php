<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;
    protected $table = 'rooms';

    protected $guarded = ["id_kamar"];

    public function transaksi(){
        return $this->hasMany(Transaksi::class, "id_kamar", "id_kamar");
    }
}
