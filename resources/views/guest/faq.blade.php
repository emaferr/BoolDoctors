@extends('layouts.guest')

@section('title', 'BDoctors | FAQ')

@section('content')
<div class="container">

    <div class="accordion py-5" id="accordionExample">
    <div class="card">
        <div class="card-header" id="headingOne">
        <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            Come lasciare una recensione?
            </button>
        </h2>
        </div>

        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
        <div class="card-body">
            Se desideri aggiungere una recensione su un dottore, usa il tasto Invia una recensione, che si trova su tutti i profili. Scegli il numero di stelle, scrivi la recensione e fai click sul tasto Invia recensione. Prima di lasciare una recensione, leggi i Termini e Condizioni d'utilizzo.
        </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="headingTwo">
        <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            Posso cancellare una mia recensione già pubblicata sul profilo di uno specialista?
            </button>
        </h2>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
        <div class="card-body">
            No.
        </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="headingThree">
        <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            Non riesco a loggarmi al mio account/non ricordo la mia password
            </button>
        </h2>
        </div>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
        <div class="card-body">
            Assicurati che l'indirizzo email fornito sia quello usato durante la registrazione. Poi utilizza la funzione di recupero della password. Riceverai ulteriori istruzioni via email, che ti permetteranno di effettuare il login.
        </div>
        </div>
    </div>
    </div>
</div>

@endsection