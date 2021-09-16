<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Review;
use App\Specialization;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $doctors = User::orderBy('id', 'DESC')->paginate(10);
        // $doctors = User::has('sponsors')->orderBy('updated_at','DESC')->get();
        $doctors = User::all();
        $specializations = Specialization::has('user')->get();
        $sponsoredDoctors = User::has('sponsors')->get();
        $currentDate = date("Y-m-d H:i:s");
        $activeDoctors = [];
        $reviews = Review::all();

        foreach ($sponsoredDoctors as $user) {
            foreach ($user->sponsors as $sponsor) {
                if ($sponsor->pivot->expiration_time > $currentDate) {
                    if (!in_array($user, $activeDoctors)) {
                        array_push($activeDoctors, $user);
                    }
                }
            }
        };

        return view('guest.homepage', compact('doctors', 'reviews', 'activeDoctors', 'specializations'));
    }

    public function toIndex(Request $request)
    {
        $selected = $request->route('id');
        //$selected = $request->input('specialization');
        $specializations = Specialization::has('user')->get();

        return view('guest.index', compact('selected', 'specializations'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $specializations = Specialization::all();
        $user->incrementReadCount();
        $reviews = Review::all()->reverse();
        return view('guest.show', compact('user', 'reviews', 'specializations'));
    }
}
