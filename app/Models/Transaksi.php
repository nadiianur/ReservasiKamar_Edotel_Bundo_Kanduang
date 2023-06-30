<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transactions';
    protected $guarded = [
        'id_transaksi'
    ];

    public function user(){
        return $this->belongsTo(User::class, "id_user", "id_user");
    }

    public function kamar(){
        return $this->belongsTo(Kamar::class, "id_kamar", "id_kamar");
    }
}
