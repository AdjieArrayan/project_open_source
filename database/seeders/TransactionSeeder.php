<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $userIds = DB::table('users')->pluck('id')->toArray();

        for ($i = 0; $i < 20; $i++) {
            DB::table('transactions')->insert([
                'user_id' => $faker->randomElement($userIds),
                'total_harga' => 0,
                'metode_pembayaran' => $faker->randomElement(['cash', 'qris']),
                'tanggal_transaksi' => $faker->dateTimeBetween('-1 month', 'now'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
