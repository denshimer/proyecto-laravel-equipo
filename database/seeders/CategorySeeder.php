<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Tecnología', 'slug' => 'tecnologia', 'color' => '#3B82F6'],
            ['name' => 'Deportes', 'slug' => 'deportes', 'color' => '#10B981'],
            ['name' => 'Cultura', 'slug' => 'cultura', 'color' => '#8B5CF6'],
            ['name' => 'Académico', 'slug' => 'academico', 'color' => '#F59E0B'],
            ['name' => 'Social', 'slug' => 'social', 'color' => '#EC4899'],
            ['name' => 'Conferencias', 'slug' => 'conferencias', 'color' => '#6366F1'],
            ['name' => 'Talleres', 'slug' => 'talleres', 'color' => '#14B8A6'],
            ['name' => 'General', 'slug' => 'general', 'color' => '#6B7280'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
