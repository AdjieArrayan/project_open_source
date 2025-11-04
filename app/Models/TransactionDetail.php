<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'transaction_id',
        'menu_id',
        'jumlah',
        'subtotal',
    ];

    // Relasi ke Transaction
    public function transaction()
    {
        // Satu detail hanya punya satu transaksi
        return $this->belongsTo(Transaction::class);
    }

    // Relasi ke Menu
    public function menu()
    {
        // Satu detail hanya punya satu menu
        return $this->belongsTo(Menu::class);
    }
}
