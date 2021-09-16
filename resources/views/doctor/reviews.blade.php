@extends('layouts.app')

@section('title', '| Recensioni')

@section('content')

<h2>Recensioni</h2>
<div id="app" class="row">
    <div class="col-lg-8">
        @if (count(Auth::user()->reviews) > 0)

        @foreach ($reviews as $review)
        @if (Auth::user()->id === $review->user_id)

        <div class="card rounded shadow mb-3">
            <div class="card-header d-flex justify-content-between align-items-center align-content-center">
                <h5 class="text-center text-info"><i class="far fa-user text-success"></i> {{$review->name}} {{$review->lastname}}</h5>
                <p style="font-size: .8rem"><span class="text-info">Ricevuto: &nbsp;</span> {{$review->created_at->format('d-m-Y h:m') }}</p>
            </div>

            <div class="card-body text-secondary rowb d-flex justify-content-between align-content-center">
                <div class="col-lg-7">
                    <span class="text-info">Commento:</span>
                    <p> {{$review->body}}</p>
                </div>
                <div class="col-lg-3 text-center">
                    <span class="text-info d-block">Voto:</span>
                    @for ($i = 0; $i < $review->vote; $i++)
                        <i class="fas fa-star"></i>
                        @endfor
                        {{-- <h5>Vote: {{$review->vote}}</h5> --}}
                </div>
            </div>
        </div>


        @endif
        @endforeach
        @else
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Non hai nessuna recensione!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        @endif
    </div>

    <div class="col-lg-4">
        <div class="card-header"><i class="far fa-star icon-show"></i></i> Recensione</div>
        @php
        $star5 = [];
        $star4 = [];
        $star3 = [];
        $star2 = [];
        $star1 = [];

        foreach (Auth::user()->reviews as $review) {
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

        if (count(Auth::user()->reviews) > 0) {
        $cinquestelle = (count($star5) * 100) / count(Auth::user()->reviews);
        $quattrostelle = (count($star4) * 100) / count(Auth::user()->reviews);
        $trestelle = (count($star3) * 100) / count(Auth::user()->reviews);
        $duestelle = (count($star2) * 100) / count(Auth::user()->reviews);
        $unastella = (count($star1) * 100) / count(Auth::user()->reviews);
        $sum5 = array_sum($star5);
        $sum4 = array_sum($star4);
        $sum3 = array_sum($star3);
        $sum2 = array_sum($star2);
        $sum1 = array_sum($star1);
        $totalSum = ($sum5 + $sum4 + $sum3 + $sum2 + $sum1) / count(Auth::user()->reviews);
        }

        @endphp
        <div class="bg-white rounded shadow p-4 mb-4 clearfix graph-star-rating">
            {{-- <h4 class="mb-0 mb-4 text-center">Recensioni dei Clienti </h4> --}}
            <div class="graph-star-rating-header">
                <div class="star-rating d-flex flex-column justify-content-between">
                    <span class="text-black mb-2">Totale recensioni:
                        <span class="text-info">{{ count(Auth::user()->reviews) }}</span>
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
        </div>
    </div>
</div>

</div>
<footer></footer>

@endsection