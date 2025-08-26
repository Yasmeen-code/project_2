<?php

namespace Database\Seeders;

use App\Models\Campaign;
use Illuminate\Database\Seeder;

class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $campaigns = [
            [
                'name' => 'Education for All',
                'category' => 'education',
                'description' => 'Providing education for underprivileged children in remote areas by supplying school books, educational tools, and building schools.',
                'status' => 'active',
                'target_amount' => 500000,
                'current_amount' => 325000,
                'start_date' => '2024-01-15',
                'end_date' => '2024-06-15',
                'image_url' => null,
            ],
            [
                'name' => 'Health for All',
                'category' => 'healthcare',
                'description' => 'Providing basic healthcare for needy communities through various clinics and supplying medicines and medical supplies.',
                'status' => 'pending',
                'target_amount' => 300000,
                'current_amount' => 75000,
                'start_date' => '2024-02-01',
                'end_date' => '2024-08-01',
                'image_url' => null,
            ],
            [
                'name' => 'Emergency Food Relief',
                'category' => 'emergency_relief',
                'description' => 'Distributing monthly food packages to needy families affected by natural disasters and economic crises.',
                'status' => 'completed',
                'target_amount' => 200000,
                'current_amount' => 200000,
                'start_date' => '2023-11-01',
                'end_date' => '2023-12-31',
                'image_url' => null,
            ],
            [
                'name' => 'Safe Shelter Initiative',
                'category' => 'emergency_relief',
                'description' => 'Building and rehabilitating shelters for displaced families affected by wars and natural disasters.',
                'status' => 'active',
                'target_amount' => 750000,
                'current_amount' => 450000,
                'start_date' => '2024-01-01',
                'end_date' => '2024-12-31',
                'image_url' => null,
            ],
            [
                'name' => 'Clean Water Access',
                'category' => 'environment',
                'description' => 'Providing clean and safe water sources for communities suffering from water scarcity or pollution.',
                'status' => 'pending',
                'target_amount' => 400000,
                'current_amount' => 50000,
                'start_date' => '2024-03-01',
                'end_date' => '2024-09-01',
                'image_url' => null,
            ],
            [
                'name' => 'Community Garden Project',
                'category' => 'community',
                'description' => 'Establishing community gardens to promote sustainable food production and community engagement.',
                'status' => 'active',
                'target_amount' => 150000,
                'current_amount' => 85000,
                'start_date' => '2024-02-15',
                'end_date' => '2024-08-15',
                'image_url' => null,
            ],
            [
                'name' => 'School Supplies Drive',
                'category' => 'education',
                'description' => 'Collecting and distributing school supplies to underprivileged students in local communities.',
                'status' => 'active',
                'target_amount' => 80000,
                'current_amount' => 45000,
                'start_date' => '2024-01-20',
                'end_date' => '2024-05-20',
                'image_url' => null,
            ],
            [
                'name' => 'Medical Equipment Fund',
                'category' => 'healthcare',
                'description' => 'Providing essential medical equipment to rural clinics and healthcare centers.',
                'status' => 'pending',
                'target_amount' => 250000,
                'current_amount' => 30000,
                'start_date' => '2024-03-15',
                'end_date' => '2024-09-15',
                'image_url' => null,
            ],
            [
                'name' => 'Reforestation Program',
                'category' => 'environment',
                'description' => 'Planting trees and restoring natural habitats to combat deforestation and climate change.',
                'status' => 'active',
                'target_amount' => 300000,
                'current_amount' => 120000,
                'start_date' => '2024-02-01',
                'end_date' => '2024-11-01',
                'image_url' => null,
            ],
            [
                'name' => 'Youth Sports Program',
                'category' => 'community',
                'description' => 'Organizing sports activities and providing equipment for youth development in underserved areas.',
                'status' => 'pending',
                'target_amount' => 100000,
                'current_amount' => 15000,
                'start_date' => '2024-04-01',
                'end_date' => '2024-10-01',
                'image_url' => null,
            ],
        ];

        foreach ($campaigns as $campaign) {
            Campaign::create($campaign);
        }
    }
}
