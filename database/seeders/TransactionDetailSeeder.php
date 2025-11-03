<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class TransactionDetailSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $transactions = DB::table('transactions')->get();
        $menus = DB::table('menus')->get();

        foreach ($transactions as $transaction) {
            $totalHarga = 0;

            // Setiap transaksi punya 1–3 item menu acak
            $jumlahItem = $faker->numberBetween(1, 3);

            for ($i = 0; $i < $jumlahItem; $i++) {
                $menu = $menus->random();
                $jumlah = $faker->numberBetween(1, 5);
                $subtotal = $menu->harga * $jumlah;

                // Tambahkan detail transaksi
                DB::table('transaction_details')->insert([
                    'transaction_id' => $transaction->id,
                    'menu_id' => $menu->id,
                    'jumlah' => $jumlah,
                    'subtotal' => $subtotal,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $totalHarga += $subtotal;
            }

            // Update total harga di tabel transactions
            DB::table('transactions')
                ->where('id', $transaction->id)
                ->update(['total_harga' => $totalHarga]);
        }
    }
}
