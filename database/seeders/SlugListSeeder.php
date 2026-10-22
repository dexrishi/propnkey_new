<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SlugList;

class SlugListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $slugLists = [
            [
                'url' => 'about-us',
                'meta_title' => 'About Us - Property Management Company',
                'meta_description' => 'Learn about our property management company, our mission, and how we help property owners maximize their investments.',
                'heading' => 'About Our Company',
                'description' => '<h2>Welcome to Our Property Management Company</h2><p>We are a leading property management company dedicated to providing exceptional service to our clients. With over 10 years of experience in the industry, we have built a reputation for excellence and reliability.</p><h3>Our Mission</h3><p>To provide comprehensive property management solutions that maximize value for property owners while ensuring tenant satisfaction.</p><h3>Our Vision</h3><p>To be the most trusted and innovative property management company in the region.</p><h3>Why Choose Us?</h3><ul><li>Experienced and professional team</li><li>24/7 customer support</li><li>Advanced technology solutions</li><li>Competitive pricing</li><li>Proven track record</li></ul>',
                'is_active' => true,
            ],
            [
                'url' => 'services',
                'meta_title' => 'Property Management Services - Complete Solutions',
                'meta_description' => 'Discover our comprehensive property management services including tenant screening, maintenance, rent collection, and more.',
                'heading' => 'Our Services',
                'description' => '<h2>Comprehensive Property Management Services</h2><p>We offer a full range of property management services designed to meet your specific needs and maximize your property\'s potential.</p><h3>Property Management</h3><p>Complete property management services including tenant screening, rent collection, maintenance coordination, and financial reporting.</p><h3>Property Maintenance</h3><p>Regular maintenance and repair services to keep your properties in excellent condition and maximize their value.</p><h3>Tenant Services</h3><p>Professional tenant services including application processing, lease management, and customer support.</p><h3>Financial Management</h3><p>Comprehensive financial management including rent collection, expense tracking, and detailed reporting.</p>',
                'is_active' => true,
            ],
            [
                'url' => 'contact',
                'meta_title' => 'Contact Us - Get in Touch Today',
                'meta_description' => 'Contact our property management team today. We\'re here to help with all your property management needs.',
                'heading' => 'Contact Our Team',
                'description' => '<h2>Get in Touch</h2><p>We would love to hear from you. Contact us today to learn more about our services or to discuss your property management needs.</p><h3>Office Information</h3><p><strong>Address:</strong> 123 Property Street, City, State 12345</p><p><strong>Phone:</strong> (555) 123-4567</p><p><strong>Email:</strong> info@propnkey.com</p><h3>Business Hours</h3><p>Monday - Friday: 9:00 AM - 6:00 PM</p><p>Saturday: 10:00 AM - 4:00 PM</p><p>Sunday: Closed</p><h3>Emergency Contact</h3><p>For urgent matters outside business hours, please call our emergency line at (555) 123-4568.</p>',
                'is_active' => true,
            ],
            [
                'url' => 'privacy-policy',
                'meta_title' => 'Privacy Policy - Data Protection',
                'meta_description' => 'Read our privacy policy to understand how we collect, use, and protect your personal information.',
                'heading' => 'Privacy Policy',
                'description' => '<h2>Privacy Policy</h2><p>This privacy policy explains how we collect, use, and protect your personal information.</p><h3>Information We Collect</h3><p>We collect information you provide directly to us, such as when you create an account, contact us, or use our services.</p><h3>How We Use Your Information</h3><p>We use the information we collect to provide, maintain, and improve our services, communicate with you, and ensure the security of our platform.</p><h3>Information Sharing</h3><p>We do not sell, trade, or otherwise transfer your personal information to third parties without your consent, except as described in this policy.</p><h3>Data Security</h3><p>We implement appropriate security measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction.</p>',
                'is_active' => true,
            ],
            [
                'url' => 'terms-of-service',
                'meta_title' => 'Terms of Service - Legal Agreement',
                'meta_description' => 'Read our terms of service that govern your use of our website and property management services.',
                'heading' => 'Terms of Service',
                'description' => '<h2>Terms of Service</h2><p>These terms of service govern your use of our website and services.</p><h3>Acceptance of Terms</h3><p>By accessing or using our services, you agree to be bound by these terms and conditions.</p><h3>Use of Services</h3><p>You may use our services only for lawful purposes and in accordance with these terms.</p><h3>User Accounts</h3><p>You are responsible for maintaining the confidentiality of your account and password and for all activities that occur under your account.</p><h3>Limitation of Liability</h3><p>To the maximum extent permitted by law, we shall not be liable for any indirect, incidental, special, consequential, or punitive damages.</p>',
                'is_active' => false,
            ],
        ];

        foreach ($slugLists as $slugListData) {
            SlugList::create($slugListData);
        }
    }
}