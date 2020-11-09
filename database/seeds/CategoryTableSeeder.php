<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoryTableSeeder extends Seeder
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
                'en' => ['name' => 'Woman Care'],
                'ar' => ['name' => 'العناية بالمرأة'],
                'photo' => '1591021194_woman-care.jpg',
                'status' => '1',
            ],
            [
                'en' => ['name' => 'Hair Care'],
                'ar' => ['name' => 'العناية بالشعر'],
                'status' => '1',
                'photo' => '1591021223_hair-care.jpg',
            ],
            [
                'en' => ['name' => 'Baby Care'],
                'ar' => ['name' => 'العناية بالطفل'],
                'photo' => '1591020167_2Nxaff2rdwTTzS8MQx47b9-320-80.jpg',
                'status' => '1',
                'parent_id' => '1',
            ],


        ];

        foreach ($allData as $data) {

            Category::create($data);
        }
    }
}
