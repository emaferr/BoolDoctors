<?php

namespace App\Http\Controllers;

use Braintree;
use App\Http\Resources\SponsorResource;
use Illuminate\Http\Request;
use App\User;
use App\Sponsor;

class SponsorController extends Controller
{
    public function buySponsorship(User $user)
    {
        $sponsors = Sponsor::all();
        $gateway = new Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey'),

        ]);

        $token = $gateway->ClientToken()->generate();


        return view('doctor.sponsors', ['user' => $user, 'sponsors' => $sponsors, 'token' => $token]);
    }
}
