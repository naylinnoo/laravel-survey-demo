<?php

namespace Database\Seeders;

use App\Models\Field;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FieldsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        Field::insert([
            [
                'label' => 'Name',
                'name' => 'name',
                'type' => 'text',
            ],
            [
                'label' => 'Date of birth',
                'name' => 'dob',
                'type' => 'date',
            ],
            [
                'label' => 'Gender',
                'name' => 'gender',
                'type' => 'text',
            ],
            [
                'label' => 'Phone',
                'name' => 'phone',
                'type' => 'number',
            ]
        ]);
    }
}
