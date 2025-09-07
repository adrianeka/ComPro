<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Post;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');
        $now = Carbon::now();

        for ($i = 1; $i <= 11; $i++) {
            $title = rtrim($faker->sentence(mt_rand(3, 7)), '.');

            $slug = Str::slug($title) . '-' . Str::lower(Str::random(6));

            $paragraphs = $faker->paragraphs(mt_rand(3, 6));
            $content = '<p>' . implode('</p><p>', $paragraphs) . '</p>';

            if ($i % 3 === 0) {
                $content .= '<h2>' . e($faker->sentence(4)) . '</h2>';
                $content .= '<p>' . e($faker->paragraph()) . '</p>';
            }

            if ($i % 2 === 0) {
                $items = '<li>' . implode('</li><li>', array_map('e', $faker->sentences(3))) . '</li>';
                $content .= "<ul>{$items}</ul>";
            }

            $excerpt = Str::limit(strip_tags($content), 160);

            $publishedAt = $now->copy()->subDays(12 - $i)->setTime(10, 0)->toDateTimeString();

            Post::create([
                'title'        => $title,
                'slug'         => $slug,
                'thumbnail'    => null,          
                'excerpt'      => $excerpt,
                'content'      => $content,
                'author'       => 'Admin',       
                'published_at' => $publishedAt,
            ]);
        }
    }
}