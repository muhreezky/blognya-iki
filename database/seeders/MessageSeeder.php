<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0; $i < 20; $i++) {
            Message::create([
                'email' => fake()->email(),
                'subject' => fake()->realText(),
                'content' => fake()->realText(),
                'purpose' => fake()->randomElement(['Pembuatan Website', 'Layanan SEO', 'Konsultasi Tugas', 'Lainnya']),
                'created_at' => time(),
                'updated_at' => time(),
            ]);
        }
    }
}
