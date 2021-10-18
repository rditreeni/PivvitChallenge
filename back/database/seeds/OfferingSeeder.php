<?php

use Illuminate\Database\Seeder;
use App\Models\Offering;

class OfferingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $offerings = array(
            array(
                'title' => 'Test Offering 1',
                'price' => 1.00,
            ),
            array(
                'title' => 'Test Offering 2',
                'price' => 5.50,
            ),
            array(
                'title' => 'Test Offering 3',
                'price' => 9.99,
            ),
            array(
                'title' => 'Test Offering 4',
                'price' => 21.21,
            ),
            array(
                'title' => 'Test Offering 5',
                'price' => 49.49,
            ),
        );

        foreach($offerings as $offering){
            Offering::create($offering);
        }
    }
}
