@extends('layouts.app')

@section('title', '| Modifica Profilo')

@section('content')
@include('layouts.partials.errors')

<form action="{{ route('doctor.update', $doctor->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method("PUT")

    <div id="app" class="form-group row">
        <!-- Nome -->
        <div class="col-6">
            <label for="name" class="font-weight-bold">Nome</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ $doctor->name }}" @error('title') is-invalid @enderror placeholder="Nome..." required autocomplete="name" autofocus minlength="3" maxlength="50">
            <small id="nameHelp" class="text-muted">Deve contenere min:3, max:50
                caratteri</small>
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Cognome -->
        <div class="col-6">
            <label for="lastname" class="font-weight-bold">Cognome</label>
            <input type="text" class="form-control " name="lastname" id="lastname" value="{{ $doctor->lastname }}" @error('lastname') is-invalid @enderror placeholder="Cognome..." required autocomplete="lastname" autofocus minlength="3" maxlength="50">
            <small id="lastnameHelp" class="text-muted">Deve contenere min:3, max:50
                caratteri</small>
            @error('lastname')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    {{-- IMMAGINE DEL DOTTORE --}}
    <div class="form-group">
        {{-- immagine precedente --}}
        <label for="name" class="font-weight-bold d-block">Inserisci la tua immagine</label>
        <img style="width: 200px" src="{{ asset(Auth::user()->path) }}" class="p-2" alt="{{ $doctor->name . ' ' . $doctor->lastname }}">
        <small id="nameHelp" class="text-muted">immagine di profilo attuale</small>
        {{-- immagine da editare --}}
        <input type="file" class="form-control-file @error('profile_image')is-invalid @enderror" name="profile_image" id="profile_image" autofocus>
        <small id="fileHelpId" class="form-text text-muted">Formati consentiti(jpeg, png, bmp, gif, svg,
            webp) max: 2MB</small>
        @error('profile_image')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    {{-- SPECIALIZZAZIONE DOTTORI --}}
    <div class="form-group">
        <label for="chechHelp" class="font-weight-bold d-block">Specializzazioni:</label>
        <div id="form_check" class="form-check">
            @if ($specializations)
            @foreach ($specializations as $specialization)
            @if ($errors->any())
            <input name="specializations[]" id="specializations" class="form-check-input d-block @error('specializations')is-invalid @enderror" type="checkbox" value="{{ $specialization->id }}">
            @endif
            <input name="specializations[]" id="specializations" class="form-check-input d-block" type="checkbox" value="{{ $specialization->id }}" {{ $doctor->specializations->contains($specialization) ? 'checked' : '' }}>
            <label class="form-check-label d-block" for="specializations">
                {{ $specialization->name }}
            </label>
            @endforeach
            @endif
        </div>
        <small id="chechHelp" class="form-text text-muted">Seleziona almeno una o più
            specializzazioni</small>
        @error('specializations')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    {{-- SERVIZI DEL DOTTORE --}}
    <div class="form-group">
        <label for="service" class="font-weight-bold">Servizi</label>
        <textarea name="service" class="form-control" id="service" cols="30" rows="5" placeholder="Le prestazioni..." {{ old('curriculum') }}>{{ $doctor->service }}</textarea>
        <small id="serviceHelp" class="form-text text-muted">Descrivi le tue prestazioni</small>
        @error('service')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    {{-- CURRICULUM DOTTORE --}}
    <div class="form-group">
        <label for="curriculum" class="font-weight-bold">Curriculum</label>
        <textarea name="curriculum" class="form-control" id="curriculum" cols="30" rows="6" 
        placeholder="Titoli conseguiti, 
Apparecchiature utilizzate, 
Patologie trattate, 
Metodologie diagnostiche e terapeutiche, 
Laurea e abilitazione" {{ old('curriculum') }}>{{ $doctor->curriculum }}</textarea>
        <small id="curriculum" class="form-text text-muted">Compila nella text area il tuo CV</small>
        @error('curriculum')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-row">
        <!-- Città -->
        <div class="col-6">
            <label for="city" class="font-weight-bold">Città</label>
            <input type="text" class="form-control" name="city" id="city" value="{{ $doctor->city }}" required autocomplete="city" autofocus minlength="3" maxlength="50" placeholder="Città...">
            <small id="cityHelp" class="form-text text-muted">Città, max:50 caratteri</small>
            @error('city')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Provincia -->
        <div class="col-6">
            <label for="pv" class="font-weight-bold">Provincia</label>
            <input type="text" class="form-control" name="pv" id="pv" value="{{ $doctor->pv }}" required autocomplete="pv" autofocus minlength="2" maxlength="50" placeholder="Provincia...">
            <small id="pvHelp" class="form-text text-muted">Provincia, puoi utilizzare min 2, max 50
                caratteri</small>
            @error('pv')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    {{-- INDIRIZZO DOTTORE --}}
    <div class="form-group">
        <label for="address" class="font-weight-bold">Indirizzo</label>
        <input type="text" class="form-control" name="address" id="address" value="{{ $doctor->address }}" required autocomplete="address" autofocus minlength="5" maxlength="255" placeholder="Indirizzo...">
        <small id="addressHelp" class="form-text text-muted">Indirizzo, puoi utilizzare min 5, max 255
            caratteri</small>
        @error('address')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

    </div>

    <div class="form-row">
        <!-- Mail -->
        <div class="col-6">
            <label for="email" class="font-weight-bold">Mail</label>
            <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2, 4}$" class="form-control" name="email" id="email" value="{{ $doctor->email }}" required autocomplete="email" autofocus minlength="7">
            <small id="emailHelp" class="form-text text-muted">example@gmail.it</small>

            @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Telefono -->
        <div class="col-6">
            <label for="phone_number" class="font-weight-bold">Numero di telefono</label>
            <input type="tel" pattern="^[0-9+\s]*$" class="form-control" name="phone_number" id="phone_number" value="{{ $doctor->phone_number }}" autocomplete="phone_number" autofocus minlength="9" maxlength="13" placeholder="Telefono... +39 1234567">
            <small id="phone_numberHelp" class="form-text text-muted">Numero di Telefono, puoi utilizzare min 9,
                max 13 caratteri </small>

            @error('phone_number')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    {{-- BTN INVIO FORM --}}
    <button type="submit" class="btn btn-dark mt-3">Update</button>
</form>

<footer></footer>

@endsection