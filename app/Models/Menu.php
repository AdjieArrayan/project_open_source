<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nama_menu',
        'deskripsi',
        'harga',
        'gambar',
    ];

    // Relasi ke TransactionDetail
    public function transactionDetails()
    {
        // Satu menu bisa muncul di banyak detail transaksi
        return $this->hasMany(TransactionDetail::class);
    }
}
