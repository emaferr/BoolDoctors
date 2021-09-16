@extends('layouts.guest')

@section('title', ' | Homepage')

@section('content')

{{-- App --}}
<div id="app">

    <a href="#" id="scroll" style="display: none; z-index: 9999;" class="shadow"><span></span></a>

    {{-- Code for cicle doctor reviews count and avarage --}}
    @php

    $recensioni = [];

    $messaggi = [];

    foreach ($doctors as $doctor) {
    $totMesDoc = count($doctor->messages);

    $totRecDoc = count($doctor->reviews);

    array_push($messaggi, $totMesDoc);

    array_push($recensioni, $totRecDoc);
    }

    $recensioniTotali = array_sum($recensioni);

    $messaggiTotali = array_sum($messaggi);

    @endphp
    {{-- ----------------------------------------------- --}}

    {{-- Ricerca --}}
    <div class=" test d-flex flex-column flex-wrap justify-content-center align-items-center">
        <div>
            <img class="img-jumbo animate__animated animate__slideInRight img-fluid" src="{{ asset('img/jumbo.png') }}" alt="">
        </div>
        <div class="pb-3 d-flex flex-column align-items-center animate__animated animate__slideInLeft">
            <img width="100" class="mb-4" src="{{ asset('img/logo_small_icon_only.png') }}" alt="">
            <h1 class="text-white ml-3 text-center">Contatta online i migliori specialisti</h1>
        </div>
        <form action="{{ route('toIndex', 0) }}" method="post">
            @csrf
            @method('GET')
            <div class="form-group">
                {{-- select specializzazioni --}}
                <select id="dynamic_select" class="selectpicker mt-4 mb-2" data-show-subtext="false" data-live-search="true" id="specialization" name="specialization" required>
                    <option value="">Cerca lo Specialista</option>
                    @foreach ($specializations as $spec)
                    <option value="{{ $spec->id }}" class="">{{ $spec->name }}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>
    {{-- End Ricerca --}}

    <!-- Medici in Evidenzia -->
    <div class="pt-3 margin_neg">

        <div class="card-carousel overflow-hidden my-3" id="debug_id_1">
            <button class="button-spin counterclockwise d-none">&lt;</button>
            <div class="inner-carousel">
                @foreach ($activeDoctors as $doctor)
                <div style="height: 340px;" class="d-flex flex-column align-content-center align-items-center">
                    <div class="w-100" style="position: relative;">
                        <span class="font-weight-bold" style="font-size: .7rem; color:#fff; text-shadow: 1px 1px 1px rgb(175, 175, 175)">IN EVIDENZA</span>
                    </div>
                    <img src="{{ asset('storage/' . $doctor->profile_image) }}" onerror="this.src='{{ asset('img/avatar-donna.png') }}';" class="rounded-circle p-2 img-home" width="150" height="150" alt="{{ $doctor->name . $doctor->name }}">
                    <h6 style="text-transform: capitalize;">{{ $doctor->name }} {{ $doctor->lastname }}</h6>
                    <span class="d-block" style="font-size: .8rem; text-transform: capitalize;">{{ $doctor->specializations[0]->name }}</span>
                    @php
                    $average = 0;
                    @endphp
                    @foreach ($reviews as $review)
                    @if ($doctor->id === $review->user_id)
                    @php
                    $average += $review->vote;
                    @endphp
                    @endif
                    @endforeach
                    @if ($average != 0)
                    <div class="d-flex justify-content-center">
                        @for ($i = 0; $i < ceil($average / count($doctor->reviews)); $i++)
                            <i style="color: #ffd900; font-size: .9rem;" class="fas fa-star mt-3"></i>
                            @endfor
                    </div>
                    @else
                    <span style="font-size: .6rem; text-transform: capitalize;" class="text-muted mt-3">Nessuna
                        recensione ricevuta</span>
                    @endif
                    <a href="{{ route('show', $doctor->id) }}">Visualizza</a>
                </div>
                @endforeach
            </div>
            <button id="click" class="button-spin clockwise d-none">&gt;</button>
        </div>
    </div>

    <!-- End Medici in Evidenzia -->

    {{-- Come Funziona --}}
    <div id="how-it-works" class="py-5 container">
        <section class="vc_row wpb_row vc_row-fluid no_padding no_cols_padding folded_section transparent separator_top separator_bottom">
            <div class="container">
                <div class="row animate__animated animate__bounceInLeft">
                    <div class="wpb_column vc_column_container col-sm-3 col-xs-6  vc_custom_1446619389066 sep_triangular_downhill_top sep_triangular_downhill_bottom" style="border-color: rgb(8, 142, 255);">
                        <div class="separator_top" style="border-left-width: 289px;">
                            <div></div>
                        </div>
                        <div class="wpb_wrapper">
                            <!-- ========================== TEASER BOX ==========================-->
                            <div class="teaser_box wpb_content_element text-center  transparent boxed same_height_col" style="height: auto; min-height: 215px;">
                                <div class="figure transparent">
                                    <i class="fas fa-list-ol icon_folio"></i>
                                </div>
                                <div class="content text-center    ">
                                    <div class="hgroup">
                                        <h5 class="text-white h6"> Cerca per specializzazione </h5>
                                        <p class="text-white py-2">Troverai tutto quello di cui hai bisogno.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- END======================= TEASER BOX ==========================-->
                        </div>
                        <div class="separator_bottom" style="border-left-width: 289px;">
                            <div></div>
                        </div>
                    </div>
                    <div class="wpb_column vc_column_container col-sm-3 col-xs-6  vc_custom_1447875610924 sep_triangular_uphill_top sep_triangular_uphill_bottom" style="border-color: rgb(38, 156, 255);">
                        <div class="separator_top" style="border-left-width: 267px;">
                            <div></div>
                        </div>
                        <div class="wpb_wrapper">
                            <!-- ========================== TEASER BOX ==========================-->
                            <div class="teaser_box wpb_content_element text-center  transparent boxed same_height_col" style="height: auto; min-height: 215px;">
                                <div class="figure transparent">
                                    <i class="fas fa-user-md icon_folio"></i>
                                </div>
                                <div class="content text-center    ">
                                    <div class="hgroup">
                                        <h5 class="text-white h6"> Scegli il dottore </h5>
                                        <p class="text-white py-2">Valorizza i feedback dei pazienti.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- END======================= TEASER BOX ==========================-->
                        </div>
                        <div class="separator_bottom" style="border-left-width: 267px;">
                            <div></div>
                        </div>
                    </div>
                    <div class="wpb_column vc_column_container col-sm-3 col-xs-6  vc_custom_1447875785935 sep_triangular_downhill_top sep_triangular_downhill_bottom" style="border-color: rgb(69, 170, 255);">
                        <div class="separator_top" style="border-left-width: 289px;">
                            <div></div>
                        </div>
                        <div class="wpb_wrapper">
                            <!-- ========================== TEASER BOX ==========================-->
                            <div class="teaser_box wpb_content_element text-center  transparent boxed same_height_col" style="height: auto; min-height: 215px;">
                                <div class="figure transparent">
                                    <i class="fas fa-tty icon_folio"></i>
                                </div>
                                <div class="content text-center    ">
                                    <div class="hgroup">
                                        <h5 class="text-white h6"> Contatta il dottore </h5>
                                        <p class="text-white py-2">Ti bastano pochi secondi: è facile e veloce.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- END======================= TEASER BOX ==========================-->
                        </div>
                        <div class="separator_bottom" style="border-left-width: 289px;">
                            <div></div>
                        </div>
                    </div>
                    <div class="wpb_column vc_column_container col-sm-3 col-xs-6  vc_custom_1447875797423 sep_triangular_uphill_top sep_triangular_uphill_bottom" style="border-color: rgb(100, 184, 255);">
                        <div class="separator_top" style="border-left-width: 170px;">
                            <div></div>
                        </div>
                        <div class="wpb_wrapper">
                            <!-- ========================== TEASER BOX ==========================-->
                            <div class="teaser_box wpb_content_element text-center  transparent boxed same_height_col" style="height: auto; min-height: 215px;">
                                <div class="figure transparent">
                                    <i class="fas fa-handshake icon_folio"></i>
                                </div>
                                <div class="content text-center">
                                    <div class="hgroup">
                                        <h5 class="text-white h6"> Vai al tuo appuntamento </h5>
                                        <p class="text-white py-2">Invia un messaggio al dottore e fissa un appuntamento.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- END======================= TEASER BOX ==========================-->
                        </div>
                        <div class="separator_bottom" style="border-left-width: 170px;">
                            <div></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    {{-- End Come Funziona --}}

    {{-- Recensioni --}}
    <div class="spot row mx-0 py-5">
        <div class="col-md-6 d-flex align-items-center justify-content-center pb-5">
            <img width="500" class="img-fluid pt-2 mt-5" src="{{ asset('img/recensioni-dei-pazienti.svg') }}" alt="">
        </div>
        <div class="col-md-6 d-flex flex-column justify-content-center pr-5">
            <h3 class="h3 text-secondary mb-4">
                Solo su BoolDoctors puoi consultare oltre 100 recensioni di pazienti verificati!
            </h3>
            <div class="text-left">
                <span class="font-weight-bold">Un servizio pensato su misura per il paziente.</span>
                <p style="font-size: 1.1rem" class="d-block mt-3">Le nostre recensioni sono totalmente affidabili.</p>
                <img class="text-center" width="230" src="{{ asset('img/altroconsumo.svg') }}" alt="">
                <p class="d-block mt-4">I giudizi che puoi leggere sono rilasciati esclusivamente dai pazienti che
                    hanno
                    prenotato attraverso BoolDoctors ed hanno realmente interagito col medico di riferimento.
                </p>
            </div>
        </div>
    </div>
    {{-- End Recensioni --}}

    {{-- Counters --}}
    <div class="counters">
        <div class="row mx-0">
            <div class="col_counter col-12 col-lg-4 py-5">
                <h4 class="counting" data-count="{{ count($doctors) }}">0</h4>
                <h4>Medici</h4>
            </div>
            <div class="col_counter center col-12 col-lg-4 py-5">
                <h4 class="counting" data-count="{{ $messaggiTotali }}">0</h4>
                <h4>Messaggi inviati</h4>
            </div>
            <div class="col_counter col-12 col-lg-4 py-5">
                <h4 class="counting" data-count="{{ $recensioniTotali }}">0</h4>
                <h4>Recensioni</h4>
            </div>
        </div>
    </div>
    {{-- End Counters --}}

    {{-- Sei un Medico --}}
    <div class="spot2 row mx-0 py-4">
        <div class="col-md-6 d-flex align-items-center justify-content-center pb-5">
            <img width="350" class="img-fluid pt-2 mt-5" src="{{ asset('img/doctor-spot.png') }}" alt="">
        </div>
        <div class="col-md-6 d-flex flex-column justify-content-center pr-5">
            <h2 class="text-secondary mb-4">
                Sei un Medico? Iscriviti!
            </h2>
            <div class="text-left">
                <h5 class="font-weight-bold">Più di migliaia di pazienti cercano ogni mese il loro Medico su
                    BoolDoctors.
                </h5>
                <p style="font-size: 1.1rem" class="d-block mt-3">Non perdere l'opportunità di raggiungere nuovi
                    pazienti!</p>
                <p style="font-size: 1.1rem" class="d-block mt-3">Con BoolDoctors:</p>
                <ul>
                    <li class="py-1">Avrai a tua disposizione il nostro staff 7 giorni su 7</li>
                    <li class="py-1">Ottieni visibilità sul web</li>
                    <li class="py-1">Migliori la tua reputazione online</li>
                    <li class="py-1">Incrementi gli appuntamenti</li>
                </ul>
                @if (!Auth::user())
                <a style="text-decoration: none" href="{{ route('register') }}">
                    <button style="border: 3px solid; font-size: 1.2rem;" type="button" class="btn btn-outline-info font-weight-bold mt-3">Iscriviti</button>
                </a>
                @endif
            </div>
        </div>
    </div>
    {{-- End Sei un medico --}}

    {{-- Dicono di Noi --}}
    <div class="pt-5">
        <section class="pt-5 pb-5">
            <div class="container">
                <div class="row mx-0">
                    <div class="col-6">
                        <h2 class="mb-3 font-weight-bold text-info">Dicono di Noi</h2>
                    </div>
                    <div class="col-6 text-right">
                        <a class="btn btn-primary mb-3 mr-1" href="#carouselExampleIndicators2" role="button" data-slide="prev">
                            <i class="fa fa-arrow-left"></i>
                        </a>
                        <a class="btn btn-primary mb-3 " href="#carouselExampleIndicators2" role="button" data-slide="next">
                            <i class="fa fa-arrow-right"></i>
                        </a>
                    </div>
                    <div class="col-12 pt-5">
                        <div id="carouselExampleIndicators2" class="carousel slide pt-4" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <div class="text-center">
                                                <img style="object-fit: cover" class="img-fluid rounded-circle dic" alt="100%x280" src="{{ asset('img/rec1.jpg') }}">
                                                <div class="card-body">
                                                    <h4 class="card-title">Ginecologo</h4>
                                                    <p class="card-text">"Grazie a BoolDoctors ho ampliato la mia
                                                        clientela"</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="text-center">
                                                <img style="object-fit: cover" class="img-fluid rounded-circle dic" alt="100%x280" src="{{ asset('img/rec2.png') }}">
                                                <div class="card-body">
                                                    <h4 class="card-title">Cardiologo</h4>
                                                    <p class="card-text">"Booldoctor mi ha permesso di essere
                                                        contattato da pazienti da tutta Italia in modo semplice e pratico"
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="text-center">
                                                <img style="object-fit: cover" class="img-fluid rounded-circle dic" alt="100%x280" src="{{ asset('img/rec3.jpeg') }}">
                                                <div class="card-body">
                                                    <h4 class="card-title">Anestesista</h4>
                                                    <p class="card-text">"Booldoctors ha migliorato tantissimo
                                                        l'organizzazione del mio lavoro, l'interazione coi pazienti e
                                                        l'organizzazione degli appuntamenti."</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <div class="text-center">
                                                <img style="object-fit: cover" class="img-fluid rounded-circle dic" alt="100%x280" src="{{ asset('img/rec4.jpeg') }}">
                                                <div class="card-body">
                                                    <h4 class="card-title">Pediatra</h4>
                                                    <p class="card-text">"Una piattaforma web semplice da usare ed
                                                        estremamente intuitiva."</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="text-center">
                                                <img style="object-fit: cover" class="img-fluid rounded-circle dic" alt="100%x280" src="{{ asset('img/rec5.jpeg') }}">
                                                <div class="card-body">
                                                    <h4 class="card-title">Dentista</h4>
                                                    <p class="card-text">"Booldoctors è stata una bella scoperta, mi
                                                        sta aiutando notevolmente nella gestione del mio lavoro di medico."
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="text-center">
                                                <img style="object-fit: cover" class="img-fluid rounded-circle dic" alt="100%x280" src="{{ asset('img/rec6.jpeg') }}">
                                                <div class="card-body">
                                                    <h4 class="card-title">Internista</h4>
                                                    <p class="card-text">"Grazie a booldoctors sono stata contattata
                                                        da moltissimi pazienti e il mio lavoro ne ha giovato tantissimo."
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Scroll to top button -->
        </section>
    </div>
    {{-- End Dicono di Noi --}}

</div>
{{-- End App --}}
@endsection