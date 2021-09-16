<?php

namespace App\Http\Controllers;

use App\Review;
use App\User;
use Dotenv\Result\Success;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function saveReview(Request $request, User $user)
    {
        $this->reviewValidation($request);
        $review = new Review();
        $review->fill($request->all());
        $review->user_id = $user->id;
        $review->save();
        return redirect()->route('show', compact('user'))->with('success', 'Recensione inserita correttamente');
    }

    // validazione messaggi
    protected function reviewValidation(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:50',
            'lastname' => 'required|string|min:3|max:50',
            'title' => 'required|min:10',
            'vote' => 'required|numeric',
            'body' => 'required|string|min:30'
        ]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        //
    }
}
