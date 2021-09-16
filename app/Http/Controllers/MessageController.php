<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use App\User;

class MessageController extends Controller
{
    public function saveMessage(Request $request, User $user)
    {
        $this->messageValidation($request);
        $message = new Message();
        $message->fill($request->all());
        $message->user_id = $user->id;
        $message->save();
        return redirect()->route('show', compact('user'))->with('success', 'Messaggio inviato correttamente, sarai contattato nell\'arco delle 24 ore');
    }

    // validazione messaggi
    protected function messageValidation(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:50',
            'lastname' => 'required|string|min:3|max:50',
            'email' => 'required|email',
            'phone_number' => 'required|string|min:9|max:13',
            'text' => 'required|string|min:30'
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
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        $message->delete();
        return redirect()->route('messages')->with('message', 'Messaggio Cancellato!');
    }
}
