<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceCategory;
use Illuminate\Support\Str;

class SearchKeywordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoriesData = [
            'Web Dev' => [
                'website fullstack', 'web payment gateway', 'custom web app', 
                'redesign website bisnis', 'frontend/backend'
            ],
            'System Dev' => [
                'custom software', 'otomasi sistem', 'ERP/CRM', 'integrasi API sistem'
            ],
            'Mobile Dev' => [
                'mobile app', 'jasa aplikasi mobile', 'maintenance aplikasi', 'custom mobile app'
            ],
            'Digital Marketing' => [
                'rekomendasi digital ads', 'handling media sosial', 'jasa agency ads', 
                'optimasi SEO', 'social media'
            ],
            'Training & Workshop' => [
                'workshop speaker', 'in house training', 'workshop digital', 
                'corporate training', 'bootcamp perusahaan'
            ]
        ];

        foreach ($categoriesData as $categoryName => $keywords) {
            $category = ServiceCategory::create([
                'name' => $categoryName,
                'slug' => Str::slug($categoryName)
            ]);

            foreach ($keywords as $keyword) {
                $category->searchKeywords()->create([
                    'keyword' => $keyword,
                    'is_active' => true
                ]);
            }
        }
    }
}
