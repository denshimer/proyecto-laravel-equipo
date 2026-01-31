<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('content_types')->insert([
            ['name' => 'Noticia', 'key' => 'post', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Evento',  'key' => 'event', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
