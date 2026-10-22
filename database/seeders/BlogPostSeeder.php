<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BlogPost;
use App\Models\BlogCategory;

class BlogPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technologyCategory = BlogCategory::where('slug', 'technology')->first();
        $businessCategory = BlogCategory::where('slug', 'business')->first();
        $marketingCategory = BlogCategory::where('slug', 'marketing')->first();
        $webDevCategory = BlogCategory::where('slug', 'web-development')->first();
        $designCategory = BlogCategory::where('slug', 'design')->first();
        $lifestyleCategory = BlogCategory::where('slug', 'lifestyle')->first();

        $posts = [
            [
                'title' => 'The Future of Artificial Intelligence in 2024',
                'slug' => 'future-artificial-intelligence-2024',
                'blog_category_id' => $technologyCategory->id,
                'description' => '<h2>Introduction</h2><p>Artificial Intelligence continues to evolve at an unprecedented pace, reshaping industries and transforming how we work and live. As we move through 2024, several key trends are emerging that will define the future of AI.</p><h2>Key Trends</h2><p>From machine learning advancements to ethical AI considerations, the landscape is rapidly changing. Companies are investing heavily in AI research and development, leading to breakthrough innovations.</p><h2>Conclusion</h2><p>The future of AI holds immense promise, but it also requires careful consideration of ethical implications and responsible development practices.</p>',
                'meta_title' => 'Future of AI 2024 - Latest Trends & Predictions',
                'meta_description' => 'Explore the latest trends and predictions in artificial intelligence for 2024. Learn about emerging technologies and their impact on various industries.',
                'is_active' => true,
                'is_featured' => true,
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => '10 Essential Business Strategies for Startups',
                'slug' => 'essential-business-strategies-startups',
                'blog_category_id' => $businessCategory->id,
                'description' => '<h2>Starting Your Journey</h2><p>Starting a business is an exciting but challenging endeavor. Having the right strategies in place can make the difference between success and failure.</p><h2>Key Strategies</h2><p>From market research to financial planning, these essential strategies will help you build a solid foundation for your startup.</p><h2>Implementation</h2><p>Success requires careful planning, execution, and continuous adaptation to market conditions.</p>',
                'meta_title' => '10 Essential Startup Business Strategies 2024',
                'meta_description' => 'Discover 10 essential business strategies every startup should implement. Learn from successful entrepreneurs and avoid common pitfalls.',
                'is_active' => true,
                'is_featured' => false,
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Complete Guide to Digital Marketing in 2024',
                'slug' => 'complete-guide-digital-marketing-2024',
                'blog_category_id' => $marketingCategory->id,
                'description' => '<h2>Digital Marketing Landscape</h2><p>The digital marketing landscape is constantly evolving, with new platforms and strategies emerging regularly. Staying updated is crucial for success.</p><h2>Core Strategies</h2><p>From SEO to social media marketing, this comprehensive guide covers all aspects of digital marketing that matter in 2024.</p><h2>Best Practices</h2><p>Learn the best practices that top marketers use to achieve outstanding results in their campaigns.</p>',
                'meta_title' => 'Digital Marketing Guide 2024 - Complete Strategy',
                'meta_description' => 'Complete guide to digital marketing in 2024. Learn SEO, social media, content marketing, and other essential strategies.',
                'is_active' => true,
                'is_featured' => true,
                'published_at' => now()->subDays(7),
            ],
            [
                'title' => 'Modern Web Development: React vs Vue vs Angular',
                'slug' => 'modern-web-development-react-vue-angular',
                'blog_category_id' => $webDevCategory->id,
                'description' => '<h2>Framework Comparison</h2><p>Choosing the right JavaScript framework is crucial for modern web development. Each framework has its strengths and use cases.</p><h2>React</h2><p>React, developed by Facebook, is known for its component-based architecture and large ecosystem.</p><h2>Vue</h2><p>Vue.js offers a gentle learning curve and excellent documentation, making it popular among developers.</p><h2>Angular</h2><p>Angular, by Google, provides a complete framework with built-in tools and features for enterprise applications.</p>',
                'meta_title' => 'React vs Vue vs Angular - Web Development 2024',
                'meta_description' => 'Compare React, Vue, and Angular for modern web development. Learn which framework to choose for your next project.',
                'is_active' => true,
                'is_featured' => false,
                'published_at' => now()->subDays(10),
            ],
            [
                'title' => 'UI/UX Design Principles Every Designer Should Know',
                'slug' => 'ui-ux-design-principles-every-designer',
                'blog_category_id' => $designCategory->id,
                'description' => '<h2>Design Fundamentals</h2><p>Great UI/UX design is built on solid principles that ensure user satisfaction and business success.</p><h2>User-Centered Design</h2><p>Always prioritize the user\'s needs and create intuitive experiences that solve real problems.</p><h2>Visual Hierarchy</h2><p>Use typography, color, and spacing to guide users through your interface effectively.</p><h2>Consistency</h2><p>Maintain consistent design patterns throughout your application to build user trust and familiarity.</p>',
                'meta_title' => 'UI/UX Design Principles - Essential Guide 2024',
                'meta_description' => 'Learn essential UI/UX design principles every designer should know. Improve user experience and create better digital products.',
                'is_active' => true,
                'is_featured' => false,
                'published_at' => now()->subDays(12),
            ],
            [
                'title' => 'Productivity Hacks for Remote Workers',
                'slug' => 'productivity-hacks-remote-workers',
                'blog_category_id' => $lifestyleCategory->id,
                'description' => '<h2>Remote Work Challenges</h2><p>Working remotely comes with unique challenges that can impact productivity and work-life balance.</p><h2>Time Management</h2><p>Effective time management is crucial for remote workers. Learn techniques to maximize your productivity.</p><h2>Workspace Setup</h2><p>Create a dedicated workspace that promotes focus and minimizes distractions.</p><h2>Communication</h2><p>Maintain clear communication with your team and establish boundaries between work and personal time.</p>',
                'meta_title' => 'Remote Work Productivity Hacks - Work From Home Tips',
                'meta_description' => 'Discover productivity hacks for remote workers. Learn time management, workspace setup, and communication strategies.',
                'is_active' => true,
                'is_featured' => false,
                'published_at' => now()->subDays(15),
            ],
            [
                'title' => 'The Rise of No-Code Development Platforms',
                'slug' => 'rise-no-code-development-platforms',
                'blog_category_id' => $technologyCategory->id,
                'description' => '<h2>No-Code Revolution</h2><p>No-code platforms are democratizing software development, allowing non-technical users to build applications.</p><h2>Popular Platforms</h2><p>From Webflow to Bubble, explore the leading no-code platforms and their capabilities.</p><h2>Benefits and Limitations</h2><p>Understand when to use no-code solutions and when traditional development might be necessary.</p>',
                'meta_title' => 'No-Code Development Platforms - Complete Guide 2024',
                'meta_description' => 'Explore the rise of no-code development platforms. Learn about popular tools and when to use them for your projects.',
                'is_active' => true,
                'is_featured' => false,
                'published_at' => now()->subDays(18),
            ],
            [
                'title' => 'Building a Strong Brand Identity',
                'slug' => 'building-strong-brand-identity',
                'blog_category_id' => $businessCategory->id,
                'description' => '<h2>Brand Identity Essentials</h2><p>A strong brand identity is crucial for business success. It helps differentiate your company from competitors.</p><h2>Visual Elements</h2><p>Logo, color palette, typography, and imagery all contribute to your brand\'s visual identity.</p><h2>Brand Voice</h2><p>Develop a consistent brand voice that resonates with your target audience across all touchpoints.</p>',
                'meta_title' => 'How to Build a Strong Brand Identity - Business Guide',
                'meta_description' => 'Learn how to build a strong brand identity for your business. Essential tips for visual design and brand voice.',
                'is_active' => true,
                'is_featured' => false,
                'published_at' => now()->subDays(20),
            ],
        ];

        foreach ($posts as $post) {
            BlogPost::create($post);
        }
    }
}