<?php

use App\Models\Information;
use Illuminate\Database\Seeder;

class InformationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $allData = [
            [
                'en' => ['name' => 'Contact Directly', 'value' => '<p>01211711090<br />
                01211711080</p>'],
                'ar' => ['name' => 'اتصل مباشرة', 'value' => '<p>01211711090<br />
                01211711080</p>'],
                'status' => '1',
            ],
            [
                'en' => ['name' => 'Customer Service', 'value' => '<a href="#">admin@ellistaa.com</a>'],
                'ar' => ['name' => 'خدمة العملاء', 'value' => '<a href="#">admin@ellistaa.com</a>'],
                'status' => '1',
            ],
            [
                'en' => ['name' => 'Vendor Support', 'value' => '<a href="#">admin@ellistaa.com</a>'],
                'ar' => ['name' => 'دعم البائعين', 'value' => '<a href="#">admin@ellistaa.com</a>'],
                'status' => '1',
            ],



        ];

        foreach ($allData as $data) {

            Information::create($data);
        }
    }
}
