<?php

namespace Database\Seeders;

use App\Models\Phase;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PhaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Phase::create([
            'name' => [
                'en' => 'Agreement',
                'ar' => 'تم-الإتفاق',
            ],
            'step' => 1,
        ]);

        Phase::create([
            'name' => [
                'en' => 'Design',
                'ar' => 'التصميم',
            ],
            'step' => 2,
        ]);

        Phase::create([
            'name' => [
                'en' => 'Client-Approval',
                'ar' => 'اعتماد-العميل',
            ],
            'step' => 3,
        ]);

        Phase::create([
            'name' => [
                'en' => 'In-Progress',
                'ar' => 'جاري-التنفيذ',
            ],
            'step' => 4,
        ]);

        Phase::create([
            'name' => [
                'en' => 'Completed',
                'ar' => 'تم-التنفيذ',
            ],
            'step' => 5,
        ]);

        Phase::create([
            'name' => [
                'en' => 'Delivered',
                'ar' => 'تم-التسليم',
            ],
            'step' => 6,
        ]);
    }
}
