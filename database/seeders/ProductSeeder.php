<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Photoshop Pro',
                'desc' => 'A professional photo editing software for designers and photographers.'
            ],
            [
                'name' => 'eBook: Mastering Laravel',
                'desc' => 'A complete guide to becoming a Laravel expert from beginner to advanced level.'
            ],
            [
                'name' => 'Music Studio FX',
                'desc' => 'Digital audio workstation for music creation, mixing, and mastering.'
            ],
            [
                'name' => 'CodeSnippets Pro',
                'desc' => 'A productivity tool for managing and organizing reusable code snippets.'
            ],
            [
                'name' => 'TaskManager App',
                'desc' => 'Organize your work and life with this powerful task management tool.'
            ],
            [
                'name' => 'AI Writer 2.0',
                'desc' => 'Content generator powered by artificial intelligence for blogs, ads, and more.'
            ],
            [
                'name' => 'Cloud Storage Plus',
                'desc' => 'Secure and scalable cloud storage service for personal and business use.'
            ],
            [
                'name' => 'Online Course: UI/UX Design',
                'desc' => 'A self-paced online course to learn UI/UX fundamentals and tools.'
            ],
            [
                'name' => 'VPN SecureNet',
                'desc' => 'Protect your online privacy and access content worldwide with this VPN service.'
            ],
            [
                'name' => 'E-learning Bundle',
                'desc' => 'A package of online learning resources including video courses, PDFs, and quizzes.'
            ],
        ];

        Product::insert($products);

    }
}
