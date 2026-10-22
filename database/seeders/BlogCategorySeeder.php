<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BlogCategory;

class BlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Technology',
                'slug' => 'technology',
                'description' => '<p>Latest trends, innovations, and insights in the world of technology. From artificial intelligence to web development, we cover it all.</p>',
                'meta_title' => 'Technology Blog - Latest Tech News & Insights',
                'meta_description' => 'Stay updated with the latest technology trends, innovations, and insights. Expert analysis and practical guides for tech enthusiasts.',
                'is_active' => true,
            ],
            [
                'name' => 'Business',
                'slug' => 'business',
                'description' => '<p>Business strategies, entrepreneurship, and industry insights. Learn from successful business leaders and stay ahead in the competitive market.</p>',
                'meta_title' => 'Business Blog - Strategies & Entrepreneurship',
                'meta_description' => 'Expert business advice, entrepreneurship tips, and industry insights. Learn from successful leaders and grow your business.',
                'is_active' => true,
            ],
            [
                'name' => 'Marketing',
                'slug' => 'marketing',
                'description' => '<p>Digital marketing strategies, SEO tips, social media marketing, and content creation. Boost your online presence and reach your audience effectively.</p>',
                'meta_title' => 'Marketing Blog - Digital Marketing & SEO Tips',
                'meta_description' => 'Digital marketing strategies, SEO tips, and social media marketing insights. Boost your online presence and grow your audience.',
                'is_active' => true,
            ],
            [
                'name' => 'Web Development',
                'slug' => 'web-development',
                'description' => '<p>Web development tutorials, coding tips, and best practices. From frontend to backend, learn the skills you need to build amazing websites.</p>',
                'meta_title' => 'Web Development Blog - Coding Tutorials & Tips',
                'meta_description' => 'Web development tutorials, coding tips, and best practices. Learn frontend and backend development skills.',
                'is_active' => true,
            ],
            [
                'name' => 'Design',
                'slug' => 'design',
                'description' => '<p>UI/UX design principles, graphic design tips, and creative inspiration. Learn how to create beautiful and functional designs.</p>',
                'meta_title' => 'Design Blog - UI/UX & Graphic Design Tips',
                'meta_description' => 'UI/UX design principles, graphic design tips, and creative inspiration. Learn to create beautiful and functional designs.',
                'is_active' => true,
            ],
            [
                'name' => 'Lifestyle',
                'slug' => 'lifestyle',
                'description' => '<p>Lifestyle tips, productivity hacks, and personal development. Improve your daily life with practical advice and inspiring stories.</p>',
                'meta_title' => 'Lifestyle Blog - Tips for Better Living',
                'meta_description' => 'Lifestyle tips, productivity hacks, and personal development advice. Improve your daily life with practical insights.',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            BlogCategory::create($category);
        }
    }
}