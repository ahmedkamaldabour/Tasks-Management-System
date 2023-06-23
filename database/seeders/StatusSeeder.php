<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // statusTypes is an array of strings for name en and ar

        $statusTypes = [
            [
                'en' => 'Todo',
                'ar' => 'مفتوح',
            ],
            [
                'en' => 'Doing',
                'ar' => 'جاري',
            ],
            [
                'en' => 'Done',
                'ar' => 'مكتمل',
            ],
            [
                'en' => 'Canceled',
                'ar' => 'ملغي',
            ],
        ];

        foreach ($statusTypes as $statusType) {
            Status::create([
                'name' => [
                    'en' => $statusType['en'],
                    'ar' => $statusType['ar'],
                ],
            ]);
        }
    }
}
