<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'total_harga',
        'metode_pembayaran',
        'tanggal_transaksi',
    ];

    protected $casts = [
        'tanggal_transaksi' => 'datetime',
    ];

    // Relasi ke TransactionDetail
    public function details()
    {
        // Satu transaksi punya banyak detail
        return $this->hasMany(TransactionDetail::class);
    }

    // Relasi ke User (optional)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
