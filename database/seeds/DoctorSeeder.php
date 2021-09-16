<?php
use Illuminate\Support\Facades\DB;
use App\User;
use App\Review;
use App\Message;
use App\Specialization;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        for ($i = 0; $i < rand(30, 100); $i++) {
            $doctor = new User();
            $doctor->name = $faker->firstname();
            $doctor->lastname = $faker->lastname();
            $doctor->profile_image = 'img/avatar-donna.jpg';

            $doctor->city = $faker->city();
            $doctor->pv = $faker->citySuffix();
            $doctor->address = $faker->address();
            $doctor->email = $faker->email();
            $doctor->password = Hash::make('madeinsud');
            $doctor->save();


            for ($r = 0; $r < rand(2, 5); $r++) {
                $review = new Review();
                $review->name = $faker->name();
                $review->lastname = $faker->lastname();
                $review->vote = rand(1, 5);
                $review->title = $faker->sentence(5);
                $review->body = $faker->text(144);
                $doctor->reviews()->save($review);
            }

            for ($m = 0; $m < rand(2, 5); $m++) {
                $newMessage = new Message();
                $newMessage->name = $faker->firstname();
                $newMessage->lastname = $faker->lastname();
                $newMessage->email = $faker->email();
                $newMessage->phone_number = '333333333';
                $newMessage->text = $faker->text(144);
                $doctor->messages()->save($newMessage);
            }

            DB::table('specialization_user')->insert(
                [
                    'user_id' => User::select('id')->orderByRaw("RAND()")->first()->id,
                    'specialization_id' => Specialization::select('id')->orderByRaw("RAND()")->first()->id,
                ]
            );

            // DB::table('specialization_user')->insert(
            //     [
            //         'user_id' => \App\User::all()->random()->id,
            //         'specialization_id' => \App\Specialization::all()->random()->id,
            //     ]
            // );
        }
        

      
    }

}
