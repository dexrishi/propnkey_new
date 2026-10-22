<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'Sarah Johnson',
                'designation' => 'CEO, Tech Solutions Inc.',
                'comment' => 'The service provided was exceptional. Our team productivity increased by 40% after implementing their solution. Highly recommended!',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Michael Chen',
                'designation' => 'Marketing Director, Global Corp',
                'comment' => 'Outstanding support and incredible results. The team went above and beyond to meet our requirements. Truly professional!',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Emily Rodriguez',
                'designation' => 'Project Manager, Innovate Labs',
                'comment' => 'Working with this team has been a game-changer for our business. Their expertise and dedication are unmatched.',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'David Thompson',
                'designation' => 'Founder, StartupXYZ',
                'comment' => 'The quality of work and attention to detail exceeded our expectations. We couldn\'t be happier with the results.',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Lisa Wang',
                'designation' => 'Operations Manager, Enterprise Co.',
                'comment' => 'Professional, reliable, and innovative. They delivered exactly what we needed on time and within budget.',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'James Wilson',
                'designation' => 'CTO, Digital Innovations',
                'comment' => 'The technical expertise and problem-solving approach were impressive. They turned our vision into reality perfectly.',
                'sort_order' => 6,
                'is_active' => true,
            ],
            [
                'name' => 'Maria Garcia',
                'designation' => 'Head of Sales, Growth Co.',
                'comment' => 'Exceptional service and incredible results. Our sales team saw immediate improvements after their implementation.',
                'sort_order' => 7,
                'is_active' => true,
            ],
            [
                'name' => 'Robert Brown',
                'designation' => 'Managing Director, Success Ltd.',
                'comment' => 'Outstanding work ethic and commitment to excellence. They are now our go-to partner for all major projects.',
                'sort_order' => 8,
                'is_active' => true,
            ],
            [
                'name' => 'Jennifer Lee',
                'designation' => 'VP of Operations, Mega Corp',
                'comment' => 'The team\'s professionalism and technical skills are top-notch. We achieved our goals faster than expected.',
                'sort_order' => 9,
                'is_active' => true,
            ],
            [
                'name' => 'Christopher Davis',
                'designation' => 'Business Owner, Local Services',
                'comment' => 'Amazing results and excellent customer service. They helped us streamline our operations significantly.',
                'sort_order' => 10,
                'is_active' => true,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}