<?php

use Illuminate\Database\Seeder;
use App\Sponsor;

class SponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsArray = [
            [
                'name' => 'Silver',
                'duration' => 24,
                'price' => 2.99
            ],
            [
                'name' => 'Gold',
                'duration' => 72,
                'price' => 5.99
            ],
            [
                'name' => 'Platinum',
                'duration' => 144,
                'price' => 9.99
            ]

        ];
        foreach ($sponsArray as $sponsor) {
            $spons = new Sponsor();
            $spons->fill($sponsor);
            $spons->save();
        }
    }
}
