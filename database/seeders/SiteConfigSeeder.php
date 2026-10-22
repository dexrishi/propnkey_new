<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SiteConfig;

class SiteConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $configs = [
            // Site Information
            [
                'label' => 'site_name',
                'type' => 'text',
                'content' => 'Propnkey',
                'description' => 'The name of the website',
            ],
            [
                'label' => 'site_description',
                'type' => 'textarea',
                'content' => 'A powerful property management platform that helps you manage your real estate portfolio efficiently.',
                'description' => 'Brief description of the website',
            ],
            [
                'label' => 'site_keywords',
                'type' => 'text',
                'content' => 'property, management, real estate, platform',
                'description' => 'SEO keywords for the website',
            ],
            [
                'label' => 'site_logo',
                'type' => 'file',
                'content' => '',
                'description' => 'Site logo file',
            ],
            [
                'label' => 'site_favicon',
                'type' => 'file',
                'content' => '',
                'description' => 'Site favicon file',
            ],

            // Contact Information
            [
                'label' => 'contact_email',
                'type' => 'text',
                'content' => 'contact@propnkey.com',
                'description' => 'Main contact email address',
            ],
            [
                'label' => 'contact_phone',
                'type' => 'text',
                'content' => '+1 (555) 123-4567',
                'description' => 'Main contact phone number',
            ],
            [
                'label' => 'contact_address',
                'type' => 'textarea',
                'content' => '123 Property Street\nCity, State 12345\nUnited States',
                'description' => 'Physical address of the company',
            ],

            // Social Media
            [
                'label' => 'facebook_url',
                'type' => 'text',
                'content' => 'https://facebook.com/propnkey',
                'description' => 'Facebook page URL',
            ],
            [
                'label' => 'twitter_url',
                'type' => 'text',
                'content' => 'https://twitter.com/propnkey',
                'description' => 'Twitter profile URL',
            ],
            [
                'label' => 'linkedin_url',
                'type' => 'text',
                'content' => 'https://linkedin.com/company/propnkey',
                'description' => 'LinkedIn company page URL',
            ],
            [
                'label' => 'instagram_url',
                'type' => 'text',
                'content' => 'https://instagram.com/propnkey',
                'description' => 'Instagram profile URL',
            ],

            // System Settings
            [
                'label' => 'maintenance_message',
                'type' => 'textarea',
                'content' => 'We are currently performing scheduled maintenance. Please check back later.',
                'description' => 'Message to display during maintenance mode',
            ],
            [
                'label' => 'welcome_message',
                'type' => 'textarea',
                'content' => 'Welcome to Propnkey! Your property management solution.',
                'description' => 'Welcome message for new users',
            ],
            [
                'label' => 'terms_of_service',
                'type' => 'file',
                'content' => '',
                'description' => 'Terms of service document',
            ],
            [
                'label' => 'privacy_policy',
                'type' => 'file',
                'content' => '',
                'description' => 'Privacy policy document',
            ],

            // Email Settings
            [
                'label' => 'smtp_host',
                'type' => 'text',
                'content' => 'smtp.gmail.com',
                'description' => 'SMTP server hostname',
            ],
            [
                'label' => 'smtp_port',
                'type' => 'text',
                'content' => '587',
                'description' => 'SMTP server port',
            ],
            [
                'label' => 'smtp_username',
                'type' => 'text',
                'content' => 'noreply@propnkey.com',
                'description' => 'SMTP username',
            ],
            [
                'label' => 'smtp_encryption',
                'type' => 'text',
                'content' => 'tls',
                'description' => 'SMTP encryption type',
            ],

            // Business Settings
            [
                'label' => 'currency',
                'type' => 'text',
                'content' => 'USD',
                'description' => 'Default currency code',
            ],
            [
                'label' => 'timezone',
                'type' => 'text',
                'content' => 'America/New_York',
                'description' => 'Default timezone',
            ],
            [
                'label' => 'date_format',
                'type' => 'text',
                'content' => 'Y-m-d',
                'description' => 'Default date format',
            ],
            [
                'label' => 'time_format',
                'type' => 'text',
                'content' => 'H:i:s',
                'description' => 'Default time format',
            ],

            // Feature Settings
            [
                'label' => 'analytics_code',
                'type' => 'textarea',
                'content' => '<!-- Google Analytics Code -->\n<!-- Add your analytics code here -->',
                'description' => 'Google Analytics tracking code',
            ],
            [
                'label' => 'custom_css',
                'type' => 'textarea',
                'content' => '/* Custom CSS styles */\n/* Add your custom styles here */',
                'description' => 'Custom CSS styles for the site',
            ],
            [
                'label' => 'custom_js',
                'type' => 'textarea',
                'content' => '// Custom JavaScript\n// Add your custom scripts here',
                'description' => 'Custom JavaScript code for the site',
            ],

            // Documentation
            [
                'label' => 'user_manual',
                'type' => 'file',
                'content' => '',
                'description' => 'User manual document',
            ],
            [
                'label' => 'api_documentation',
                'type' => 'file',
                'content' => '',
                'description' => 'API documentation file',
            ],
        ];

        foreach ($configs as $config) {
            SiteConfig::create($config);
        }
    }
}