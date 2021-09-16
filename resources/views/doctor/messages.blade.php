@extends('layouts.app')

@section('title', '| Messaggi')

@section('content')
<div id="app">
    <h2>Messaggi</h2>

@if (session('message'))
<div id="confermaMessaggio" class="alert alert-success alert-dismissible fade show"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>{{ session('message') }}</div>

<script type="text/javascript">
    setTimeout(function() {
        $(".alert").alert('close')
        console.log('Success');
    }, 3000);
</script>
@endif


@if (count(Auth::user()->messages) > 0)

@foreach ($messages as $message)
@if (Auth::user()->id === $message->user_id)


<div class="card rounded shadow mb-3">
    <div class="card-header d-flex justify-content-between align-items-center align-content-center">
        <h5 class="text-center text-info"><i class="far fa-user text-success"></i> {{ $message->name }}
            {{ $message->lastname }}
        </h5>
        <div class="d-flex align-items-center">
            <span class="text-info mr-2">Ricevuto: </span>
            <span style="font-size: .8rem">{{ $message->created_at->format('d-m-Y h:m') }}</span>
        </div>

    </div>

    <div class="card-body text-secondary row">

        <div class="col-lg-11">

            <p> <span class="text-info">Messaggio:</span> {{ $message->text }}</p>
            <p><span class="text-info">Telefono:</span> {{ $message->phone_number }}</p>
            <p><span class="text-info">Email:</span> <a href="mailto:{{ $message->email }}">{{ $message->email }}</a></p>
        </div>
        <div class="col-lg-1 d-flex flex-column justify-content-center">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger my-2" data-toggle="modal" data-target="#exampleModalCenter2">
                <i class="fas fa-trash fa-xs fa-fw"></i>
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-exclamation-triangle text-warning"></i> Sei sicuro di
                                cancellare il messaggio?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Sei sicuro di eliminare? Questo processo è irreversibile.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
                            <form action="{{ route('messages.destroy', $message->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Cancella</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <form action="{{ route('messages.destroy', $message->id) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"><i class="fas fa-trash fa-xs fa-fw"></i></button>
            </form> --}}
        </div>
    </div>
</div>

@endif
@endforeach
@else
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Non ci sono Messaggi!</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>



@endif
</div>

<footer></footer>

@endsection