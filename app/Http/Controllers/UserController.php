<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Review;
use App\Sponsor;
use App\Message;
use App\Specialization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = User::all();
        $reviews = Review::all();
        $messages = Message::all();
        $sponsors = Sponsor::all();

        return view('doctor.home', compact('doctors', 'reviews', 'messages', 'sponsors'));
    }

    public function messages()
    {
        $messages = Message::all()->reverse();
        return view('doctor.messages', compact('messages'));
    }

    public function reviews()
    {

        $reviews = Review::all()->reverse();
        return view('doctor.reviews', compact('reviews'));
    }

    public function sponsors(User $doctor)
    {

        $sponsors = Sponsor::all()->reverse();
        return view('doctor.sponsors', compact('doctor', 'sponsors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $doctor)
    {
        $sponsors = Sponsor::all();
        $specializations = Specialization::all();
        if (Auth::user()->id === $doctor->id) {
            return view('doctor.edit', compact('doctor', 'specializations', 'sponsors'));
        } else {
            return redirect()->route("home");
        }

        return view('doctor.edit', compact('doctor', 'specializations', 'sponsors'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $doctor)
    {

        $validate = $request->validate([
            'profile_image' => 'nullable | image | max:2048',
            'name' => 'required | min:3 | max:50',
            'lastname' => 'required | min:3 | max:50',
            'city' => 'required | max:50',
            'pv' => 'required | max:50',
            'address' => 'required |min:5| max:255',
            'phone_number' => 'nullable | min:9 | max:13',
            'curriculum' => 'nullable',
            'email' => 'required',
            'specializations' => 'required',
            'service' => 'nullable',
            'sponsor' => 'nullable'
        ]);

        if (Auth::user()->id === $doctor->id) {


            if (array_key_exists('profile_image', $validate)) {

                Storage::delete($doctor->profile_image);

                $file_path = Storage::put('doctors_images', $validate['profile_image']);

                $validate['profile_image'] = $file_path;
            }
            // ddd($file_path);

            $doctor->specializations()->sync($request->specializations);
            $doctor->sponsors()->attach($request->sponsors);
            $doctor->update($validate);

            return redirect()->route('dashboard')->with('success_update', 'Profilo aggiornato correttamente.');
        } else {
            return redirect()->route("home");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $doctor)
    {
        $doctor->specializations()->detach();
        $doctor->sponsors()->detach();
        $doctor->delete();

        return redirect()->route("home");
    }
}
