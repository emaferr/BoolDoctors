@extends('layouts.guest')

@section('title', 'BDoctors | HomePage')


@section('content')

@if (session('success'))
<div id="confermaMessaggio" class="alert alert-success alert-dismissible fade show"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>{{ session('success') }}
</div>

<script type="text/javascript">
    setTimeout(function() {
        $(".alert").alert('close')
    }, 3000);
</script>
@endif


{{-- show dottore page --}}
<div id="app" class="container padding-top">
    <button class="btn fix d-lg-block d-none">
        <a href="/"><i class="fas fa-arrow-left"></i></a>
    </button>
    {{-- messaggio di avvenuta recensione --}}
    @if (session('success'))
    <div id="confermaRecensione" class="alert alert-success alert-dismissible fade show"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>{{ session('success') }}
    </div>

    <script type="text/javascript">
        setTimeout(function() {
            $(".alert").alert('close')
            console.log('Success');
        }, 3000);
    </script>
    @endif


    <div class="row pt-4">
        <!-- Card Doctor Info Principale -->
        <div class="col-lg-8">
            {{-- dottore singolo --}}
            <div class="card border-0 mb-3">
                <div class="card-header"><i class="fas fa-user-md icon-show"></i> Informazione Generale</div>
                <div class="bg-white rounded shadow p-4 mb-4 clearfix graph-star-rating row no-gutters">
                    <div class="col-md-4 d-flex align-items-center">
                        <img style="object-fit: cover" src="{{ asset('storage/' . $user->profile_image) }}" onerror="this.src='{{ asset('img/avatar-donna.jpg') }}';" class="rounded-circle mx-auto" height="200" width="200" alt="{{ $user->name . ' ' . $user->lastname }}">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            @foreach ($user->specializations as $specialization)
                            <span class="card-text text-info h6">
                                {{ $specialization->name }} &nbsp;</span>
                            @endforeach
                            <h5 class="card-title mt-3">Dr. {{ $user->name }} {{ $user->lastname }}</h5>
                            <span class="card-text font-weight-bold text-secondary">Città e Provincia</span>
                            <span class="card-text d-block pb-3">{{ $user->city }} ({{$user->pv}})</span>
                            <span class="card-text font-weight-bold text-secondary">Indirizzo</span>
                            <span class="card-text d-block pb-3">{{ $user->address }}</span>
                            <span class="card-text font-weight-bold text-secondary">Telefono</span>
                            <span class="card-text d-block pb-3">{{ $user->phone_number }}</span>

                            <!-- pulsante per inviare un messagio -->
                            @if(!Auth::user())
                            <button class="btn custom-button p-0" data-toggle="modal" data-target="#modalMessage">
                                <i class="far fa-envelope icon-show align-middle mr-1"></i> <span class="text-black-50">Invia un messaggio</span>
                            </button>

                            <!-- pulsante per inviare una recensione -->
                            <button class="btn custom-button p-0" data-toggle="modal" data-target="#modalReview">
                                <i class="fas fa-comment-medical icon-show align-middle mr-1"></i> <span class="text-black-50">Invia una recensione</span>
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Stelline recensione -->
        <div class="col-lg-4">
            <div class="card-header"><i class="far fa-star icon-show"></i></i> Recensione</div>
            @php
            $star5 = [];
            $star4 = [];
            $star3 = [];
            $star2 = [];
            $star1 = [];

            foreach ($user->reviews as $review) {
            switch ($review->vote) {
            case 5:
            array_push($star5, $review->vote);

            break;
            case 4:
            array_push($star4, $review->vote);
            break;
            case 3:
            array_push($star3, $review->vote);
            break;
            case 2:
            array_push($star2, $review->vote);
            break;
            case 1:
            array_push($star1, $review->vote);
            break;
            }
            }

            $cinquestelle = $quattrostelle = $trestelle = $duestelle = $unastella = $sum5 = $sum4 = $sum3 = $sum2 = $sum1 = $totalSum = 0;

            if (count($user->reviews) > 0) {
            $cinquestelle = (count($star5) * 100) / count($user->reviews);
            $quattrostelle = (count($star4) * 100) / count($user->reviews);
            $trestelle = (count($star3) * 100) / count($user->reviews);
            $duestelle = (count($star2) * 100) / count($user->reviews);
            $unastella = (count($star1) * 100) / count($user->reviews);
            $sum5 = array_sum($star5);
            $sum4 = array_sum($star4);
            $sum3 = array_sum($star3);
            $sum2 = array_sum($star2);
            $sum1 = array_sum($star1);
            $totalSum = ($sum5 + $sum4 + $sum3 + $sum2 + $sum1) / count($user->reviews);
            }

            @endphp
            <div class="bg-white rounded shadow p-4 mb-4 clearfix graph-star-rating">
                {{-- <h4 class="mb-0 mb-4 text-center">Recensioni dei Clienti </h4> --}}
                <div class="graph-star-rating-header">
                    <div class="star-rating d-flex flex-column justify-content-between">
                        <span class="text-black mb-2">Totale recensioni:
                            <span class="text-info">{{ count($user->reviews) }}</span>
                        </span>
                        <span class="text-black mb-2">
                            Media voti <span class="text-info">{{ round($totalSum, 1) }}</span> su <span class="text-info">5</span>
                        </span>
                    </div>
                </div>
                <!-- Stelle -->
                <div class="graph-star-rating-body">
                    <div class="rating-list">
                        <div class="rating-list-left text-black">
                            {{-- 5 stelle --}}
                            @for ($i = 0; $i < 5; $i++) <i class="fas fa-star"></i>
                                @endfor
                        </div>
                        <div class="rating-list-center">
                            <div class="progress">
                                <div style="width: {{ $cinquestelle }}%" aria-valuemax="5" aria-valuemin="0" aria-valuenow="5" role="progressbar" class="progress-bar bg-primary">
                                </div>
                            </div>
                        </div>
                        <div class="rating-list-right text-black">{{ round($cinquestelle) }}%</div>
                    </div>
                    <div class="rating-list">
                        <div class="rating-list-left text-black">
                            {{-- 4 stelle --}}
                            @for ($i = 0; $i < 4; $i++) <i class="fas fa-star"></i>
                                @endfor
                        </div>
                        <div class="rating-list-center">
                            <div class="progress">
                                <div style="width: {{ $quattrostelle }}%" aria-valuemax="5" aria-valuemin="0" aria-valuenow="5" role="progressbar" class="progress-bar bg-primary">
                                </div>
                            </div>
                        </div>
                        <div class="rating-list-right text-black">{{ round($quattrostelle) }}%</div>
                    </div>
                    <div class="rating-list">
                        <div class="rating-list-left text-black">
                            {{-- 3 Stelle --}}
                            @for ($i = 0; $i < 3; $i++) <i class="fas fa-star"></i>
                                @endfor
                        </div>
                        <div class="rating-list-center">
                            <div class="progress">
                                <div style="width: {{ $trestelle }}%" aria-valuemax="5" aria-valuemin="0" aria-valuenow="5" role="progressbar" class="progress-bar bg-primary">
                                </div>
                            </div>
                        </div>
                        <div class="rating-list-right text-black">{{ round($trestelle) }}%</div>
                    </div>
                    <div class="rating-list">
                        <div class="rating-list-left text-black">
                            {{-- 2 Stelle --}}
                            @for ($i = 0; $i < 2; $i++) <i class="fas fa-star"></i>
                                @endfor
                        </div>
                        <div class="rating-list-center">
                            <div class="progress">
                                <div style="width: {{ $duestelle }}%" aria-valuemax="5" aria-valuemin="0" aria-valuenow="5" role="progressbar" class="progress-bar bg-primary">
                                </div>
                            </div>
                        </div>
                        <div class="rating-list-right text-black">{{ round($duestelle) }}%</div>
                    </div>
                    <div class="rating-list">
                        <div class="rating-list-left text-black">
                            {{-- 1 Stella --}}
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="rating-list-center">
                            <div class="progress">
                                <div style="width: {{ $unastella }}%" aria-valuemax="5" aria-valuemin="0" aria-valuenow="5" role="progressbar" class="progress-bar bg-primary">
                                </div>
                            </div>
                        </div>
                        <div class="rating-list-right text-black">{{ round($unastella, 0) }}%</div>
                    </div>
                </div>
                <!-- /Stelle -->

                <!-- modale per vedere tutti gli recensioni??? -->
                <!-- Button trigger modal -->
                <div class="text-center mt-2">
                    <button type="button" class="btn text-white btn-show" data-toggle="modal" data-target="#exampleModalLong">
                        Leggi tutte le recensioni
                    </button>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <img width="200" class="img-fluid" src="{{ asset('img/logo_small.png') }}" alt="BoolDoctors logo">

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card border-light mb-3 rounded">
                                            <div class="card-body">
                                                @if (count($user->reviews) > 0)
                                                @foreach ($reviews as $review)
                                                @if ($review->user_id === $user->id)
                                                <div class="card-text mb-2 border p-2 shadow">
                                                    <h5>{{ $review->name }} {{ $review->lastname }}</h5>
                                                    <h5>{{ $review->title }}</h5>
                                                    <p>{{ $review->body }}</p>
                                                    
                                                    <h5 class="pb-2">Voto:

                                                        @for ($i = 0; $i < $review->vote; $i++)
                                                            <i class="fas fa-star"></i>
                                                            @endfor
                                                    </h5>
                                                    <span>{{ $review->created_at->format('d-m-Y h:m') }}</span>
                                                </div>
                                                @endif
                                                @endforeach
                                                @else
                                                <h4>Nessuna recensione ricevuta</h4>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /modale per vedere tutti gli recensioni??? -->
            </div>
        </div>
    </div>


    <!--CV Dottore  -->
    <div class="row">
        <div class="col-12">
            <div div class="card border-light mb-3 rounded shadow">
                <div class="card-header"><i class="fas fa-graduation-cap icon-show"></i> Profilo</div>
                <div class="card-body">
                    <h5 class="card-title">Titoli conseguiti</h5>
                    <ul class="card-text">
                        <li>Specializzazione in Andrologia presso l’Università di Pisa nel 1992;</li>
                        <li>Specializzazione in Chirurgia Generale presso l’Università degli Studi di Roma “La Sapienza”
                            nel 1987;</li>
                        <li>Specializzazione in Oncologia presso l’Università degli Studi di Roma “La Sapienza” nel
                            1980;</li>
                        <li>Specializzazione in Endocrinologia presso l’Università degli Studi di Roma “La Sapienza” nel
                            1977.</li>
                    </ul>
                    <h5 class="card-title">Curriculum e attività</h5>
                    <ul class="card-text">
                        <li>Laurea in Medicina e Chirurgia presso l’Università degli Studi di Roma “La Sapienza” (luglio
                            1974);</li>
                        <li>Dal 1975 al 2001 Assistente e quindi Aiuto della Chirurgia Generale dell'Ospedale San Carlo
                            Nancy di Roma;</li>
                        <li>dal 1982 ad oggi Dirigente dello Studio di Andrologia e di Chirurgia Andrologica di Roma,
                            prima struttura andrologica privata di Roma;</li>
                        <li>Ha pubblicato oltre 200 articoli su riviste straniere ed italiane, Editor di Diagnosing
                            Impotence (Masson 1989), Diagnosing Infertility (Karger, 1991);</li>
                        <li>Organizzatore degli International Meeting of Andrology che hanno portato a Roma i più grandi
                            andrologi del mondo;</li>
                        <li>Visitato oltre 30.000 pazienti con patologie andrologiche; una ricche casistica personale di
                            protesi peniene (oltre 500);</li>
                        <li>Frequenza istituto e laboratori della Clinica Medica V, Università Sapienza di Roma dal 1970
                            al 1974;</li>
                        <li>Frequenza del Reparto di Urologia Klinikum Steglitz di Berlino 1981, 1982, 1983. Istituto
                            Andrologico de Baleares dal 1984 al 1987;</li>
                        <li>Lavora presso alcune strutture accreditate con il SSN.</li>
                    </ul>
                    <h5 class="card-title">Apparecchiature utilizzate</h5>
                    <p class="card-text">Ecografo, EcoColorDoppler, Rigiscan, Biotesiometro, Cistoscopio sottile,
                        UroFlussimetria, UroDinaMica, Onde Urto Extracorporee a Bassa Intensità (LIESW).</p>
                    <h5 class="card-title">Metodologie diagnostiche e terapeutiche</h5>
                    <p class="card-text">Diagnosi e terapia del Deficit Erettile e delle patologie del pene ed
                        eiaculazione Chirurgia del varicocele con tecniche microchirurgiche e scleroterapia sec. Tauber;
                        Tecniche di recupero chirurgico di spermatozoi testicolari nell'azoospermia (TESE,MESA);
                        Chirurgia dei Corpi Cavernosi per placche da IPP, incurvamenti; Deficit Erettile con Protesi
                        peniene malleabili ed idrauliche; oltre 5.000 varicoceli operati, peni curvi, chirurgia di
                        placca, chirurgia dei deferenti, chirurgia della azoospermia; Oltre 13.000 iniezioni
                        intra-cavernose di PGE1; Viagra, Cialis, Levitra, MESA, TESE nella PMA; Chirurgia dell'uretra
                        per stenosi; Chirurgia della prostata per ipertrofia benigna. Circoncisione, frenuloplastica;
                        Rigiscan, per le erezioni notturne, EcoColorDoppler per la valutazione del pene e dei testicoli,
                        cavernometria per la valutazione della circolazione venosa, Biotesiometria per valutazione della
                        innervazione autonomica del pene, AVSS Test per valutazione erettile con Rigiscan della risposta
                        erettile a stimolazioni sessuali visive ed iniettive; Test con PGE1 per valutazione della
                        risposta vascolare; Cistoscopia sottile per valutazione dell'uretra e della vescica; Biopsie
                        prostatiche.</p>
                    <h5 class="card-title">Laurea e abilitazione</h5>
                    <p class="card-text">
                        <strong>Laurea:</strong> 17/07/1974 - Università degli Studi di Roma "La Sapienza" <br>
                        <strong>Abilitazione:</strong> seconda sessione 1974 - Università degli Studi di Roma "La
                        Sapienza" <br>
                    <ul>
                        <li>Iscritto all'Ordine dei Medici Chirurghi e Odontoiatri (FNOMCeO) della Provincia di Roma
                        </li>
                        <li>Posizione numero: 21539</li>
                        <li>Verifica FNOMCeO</li>
                    </ul>
                    <strong> P.IVA:</strong> 01807700586
                    </p>
                    <h5 class="card-title">Dichiarazione di conformità alle linee guida dell'Ordine</h5>
                    <p class="card-text">Il sottoscritto Dr. Diego Pozza dichiara sotto la propria responsabilità
                        che il messaggio informativo contenuto nel presente sito è diramato nel rispetto delle linee
                        guida approvate dalla FNOMCeO inerenti l'applicazione degli artt. 55, 56 e 57 del Nuovo Codice
                        di Deontologia Medica.</p>
                </div>
            </div>
        </div>
    </div>
    <!--Servizi  -->
    <div class="row">
        <div class="col-12">
            <div class="card border-light mb-3 rounded shadow">
                <div class="card-header"><i class="fas fa-clinic-medical icon-show"></i> Servizi</div>
                <div class="card-body">
                    <h5 class="card-title">Patologie trattate</h5>
                    <ul class="card-text d-flex justify-content-start">
                        <div class="mr-5">
                            <li>Aneiaculazione</li>
                            <li>Biofeedback</li>
                            <li>Calcoli renali</li>
                            <li>Cisti renali</li>
                            <li>Cistite</li>
                            <li>Colica renale</li>
                            <li>Condilomi</li>
                            <li>Criptorchidismo</li>
                        </div>
                        <div>
                            <li>Disfunzione erettile</li>
                            <li>Disturbi della sfera sessuale</li>
                            <li>Eiaculazione precoce</li>
                            <li>Falloplastica</li>
                            <li>Fimosi</li>
                            <li>Frenulotomia</li>
                            <li>Idrocele</li>
                            <li>Impotenza</li>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- form per inviare un messaggio al dottore -->
@include('layouts.partials.errors')
<div class="modal fade" id="modalMessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form action="{{ route('saveMessage', compact('user')) }}" method="post">
        @csrf
        @method('POST')
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <img width="200" class="img-fluid" src="{{ asset('img/logo_small.png') }}" alt="BoolDoctors logo">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-3">
                    {{-- NOME --}}
                    <div class="md-form mb-5">
                        <label data-error="wrong" data-success="right" for="name">Nome</label>
                        <input type="text" class="form-control validate" id="name" name="name" required autocomplete="name" autofocus placeholder="Nome..." minlength="3" maxlength="50">
                        <small class="form-text text-muted" id="nameHelp">(*) Il Tuo Nome Deve Contenere min:3,
                            max:50
                            caratteri</small>
                    </div>

                    {{-- COGNOME --}}
                    <div class="md-form mb-4">
                        <label data-error="wrong" data-success="right" for="lastname">Cognome</label>
                        <input type="text" class="form-control validate" name="lastname" required autocomplete="lastname" autofocus placeholder="Cognome..." minlength="3" maxlength="50">
                        <small id="lastnameHelp" class="text-form text-muted">(*) Il Tuo Cognome Deve Contenere
                            min:3,
                            max:50 caratteri</small>
                    </div>
                    {{-- EMAIL --}}
                    <div class="md-form mb-4">
                        <label data-error="wrong" data-success="right" for="email">E-Mail</label>
                        <input type="email" name="email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2, 4}$" class="form-control validate" required autocomplete="email" autofocus placeholder="e-mail valida...">
                        <small id="emailHelp" class=" text-form text-muted">(*) Esempio e-mail...
                            exemple@gmail.it</small>
                        @error('email')
                        <div class="alert alert-danger alert-dismissible fade show">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- NUMERO DI TELEFONO --}}
                    <div class="md-form mb-4">
                        <label data-error="wrong" data-success="right" for="phone_number">Numero di
                            telefono</label>
                        <input type="tel" pattern="^[0-9+\s]*$" class="form-control validate" id="phone_number" name="phone_number" required autocomplete="phone_number" autofocus minlength="9" maxlength="13" placeholder="Inserisci il tuo numero di telefono">
                        <small id="phone_numberHelp" class="form-text text-muted">(*) Numero di Telefono, puoi
                            utilizzare
                            min 9, max 13 caratteri </small>
                    </div>
                    {{-- MESSAGGIO --}}
                    <div class="md-form mb-4">
                        <label data-error="wrong" data-success="right" for="">Messaggio</label>
                        <textarea name="text" id="text" cols="54" rows="3" required minlength="30" placeholder="Inserisci il tuo messaggio..." {{ old('text') }}></textarea>
                        <small id="textHelp" class="form-text text-muted">(*) Il Testo Deve contenere almeno 30
                            caratteri</small>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="submit" class="btn custom-button">Invia messaggio</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- form per inviare una Recensione al dottore  -->
@include('layouts.partials.errors')
<div class="modal fade" id="modalReview" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form action="{{ route('saveReview', compact('user')) }}" method="post">
        @csrf
        @method('POST')
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <img width="200" class="img-fluid" src="{{ asset('img/logo_small.png') }}" alt="BoolDoctors logo">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-3">
                    {{-- NOME --}}
                    <div class="md-form mb-5">
                        <label data-error="wrong" data-success="right" for="name">Nome</label>
                        <input type="text" class="form-control validate" name="name" id="name" required autocomplete="name" autofocus minlength="3" maxlength="50" placeholder="Inserisci il tuo nome">
                        <small id="nameHelp" class="text-form text-muted">(*) Il tuo Nome deve contenere min:3,
                            max:50
                            caratteri </small>
                    </div>
                    {{-- COGNOME --}}
                    <div class="md-form mb-4">
                        <label data-error="wrong" data-success="right" for="lastname">Cognome</label>
                        <input type="text" class="form-control validate" name="lastname" id="lastname" required autocomplete="lastname" autofocus minlength="3" maxlength="50" placeholder="Inserisci il tuo cognome">
                        <small id="lastnameHelp" class="text-form text-muted">(*) Il tuo Cognome deve contenere
                            min:3,
                            max:50 caratteri</small>
                    </div>

                    {{-- TITLE --}}
                    <div class="md-form mb-4">
                        <label data-error="wrong" data-success="right" for="title">Titolo</label>
                        <input type="title" class="form-control validate" name="title" id="title" required autocomplete="title" autofocus placeholder="Inserisci un titolo per la recensione" minlength="10">
                        <small id="title" class="text-form text-muted">(*) Il Titolo deve contenere almeno 10
                            caratteri</small>
                    </div>

                    {{-- VOTE --}}
                    <div class="md-form mb-4">

                        <div class="form-group">
                            <label for="vote">Dai un voto al Dottore</label>
                            <select class="custom-select" name="vote" id="vote" required autofocus>
                                <option selected>Seleziona il tuo voto da 1 a 5</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            <div class="alert alert-warning alert-dismissible fade show">
                                <strong>Attenzione!</strong> Devi selezionare un voto!
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                            </div>
                        </div>


                    </div>

                    {{-- MESSAGGIO --}}
                    <div class="md-form mb-4">
                        <label data-error="wrong" data-success="right" for="">Testo</label>
                        <textarea name="body" id="body" cols="54" rows="3" required autocomplete="body" autofocus minlength="30" placeholder="Inserisci il tuo testo per la recensione"></textarea>
                        <p>
                            <small id="bodyHelp" class="text-form text-muted">
                                (*) Il testo delle recensione deve contenere
                                minimo 30 caratteri</small>
                        </p>

                    </div>
                </div>

                {{-- BOTTONE INVIA RECENSIONE --}}
                <div class="modal-footer d-flex justify-content-center">
                    <button type="submit" class="btn custom-button">Invia recensione</button>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection