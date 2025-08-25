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
                'description' => 'Providing basic healthcare for needy communities through various clinics and supplying medicines and medical supplies.',
                'status' => 'pending',
                'target_amount' => 300000,
                'current_amount' => 75000,
                'start_date' => '2024-02-01',
                'end_date' => '2024-08-01',
                'image_url' => null,
            ],
            [
                'name' => 'Safe Food Campaign',
                'description' => 'Distributing monthly food packages to needy families affected by natural disasters and economic crises.',
                'status' => 'completed',
                'target_amount' => 200000,
                'current_amount' => 200000,
                'start_date' => '2023-11-01',
                'end_date' => '2023-12-31',
                'image_url' => null,
            ],
            [
                'name' => 'Safe Shelter Campaign',
                'description' => 'Building and rehabilitating shelters for displaced families affected by wars and natural disasters.',
                'status' => 'active',
                'target_amount' => 750000,
                'current_amount' => 450000,
                'start_date' => '2024-01-01',
                'end_date' => '2024-12-31',
                'image_url' => null,
            ],
            [
                'name' => 'Clean Water Campaign',
                'description' => 'Providing clean and safe water sources for communities suffering from water scarcity or pollution.',
                'status' => 'pending',
                'target_amount' => 400000,
                'current_amount' => 50000,
                'start_date' => '2024-03-01',
                'end_date' => '2024-09-01',
                'image_url' => null,
            ],
        ];

        foreach ($campaigns as $campaign) {
            Campaign::create($campaign);
        }
    }
}
