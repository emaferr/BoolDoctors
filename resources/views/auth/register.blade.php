@extends('layouts.reg')



@section('content')

    <div class="container pt-5">

        <div class="row justify-content-center">

            <div class="col-md-8">

                <div class="card">

                    <div class="card-header"><img width="200" class="img-fluid"
                            src="{{ asset('img/logo_small.png') }}" alt="Booldoctors Logo"></div>



                    <div class="card-body">

                        @php
                            
                            use App\Specialization;
                            
                            $specializations = Specialization::all();
                            
                        @endphp

                        <form method="POST" action="{{ route('register', compact('specializations')) }}">

                            @csrf



                            {{-- REGISTRAZIONE NOME --}}

                            <div class="form-group row">

                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                                <div class="col-md-6">

                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}" placeholder="Inserisci il tuo nome..."
                                        required autocomplete="name" autofocus minlength="3" maxlength="50">

                                    <small id="nameHelp" class="text-muted">(*) Il Tuo Nome Deve Contenere min:3, max:50

                                        caratteri.</small>

                                    @error('name')

                                        <span class="invalid-feedback" role="alert">

                                            <strong>{{ $message }}</strong>

                                        </span>

                                    @enderror

                                </div>

                            </div>



                            {{-- REGISTRAZIONE COGNOME --}}

                            <div class="form-group row">

                                <label for="lastname"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Cognome') }}</label>

                                <div class="col-md-6">

                                    <input id="lastname" type="text"
                                        class="form-control @error('lastname') is-invalid @enderror" name="lastname"
                                        value="{{ old('lastname') }}" placeholder="Inserisci il tuo cognome..." required
                                        autocomplete="lastname" autofocus minlength="3" maxlength="30">

                                    <small id="lastnameHelp" class="text-muted">(*) Il Tuo Cognome Deve Contenere min:3,

                                        max:30 caratteri.</small>

                                    @error('lastname')

                                        <span class="invalid-feedback" role="alert">

                                            <strong>{{ $message }}</strong>

                                        </span>

                                    @enderror

                                </div>

                            </div>



                            {{-- REGISTRAZIONE INDIRIZZO --}}

                            <div class="form-group row">

                                <label for="address"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo') }}</label>



                                <div class="col-md-6">

                                    <input id="address" type="text" class="form-control" name="address" required
                                        value="{{ old('address') }}" placeholder="Inserisci il tuo indirizzo..."
                                        autocomplete="address" minlength="5" maxlength="50">

                                    <small id="addressHelp" class="text-muted">(*) Il Tuo Indirizzo Deve Contenere

                                        min:5, max:50 caratteri.</small>

                                </div>

                                @error('address')

                                    <span class="invalid-feedback" role="alert">

                                        <strong>{{ $message }}</strong>

                                    </span>

                                @enderror

                            </div>



                            {{-- REGISTRAZIONE CITTA' --}}

                            <div class="form-group row">

                                <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('Città') }}</label>

                                <div class="col-md-6">

                                    <input id="city" type="text" class="form-control" name="city" required
                                        value="{{ old('city') }}" placeholder="Inserisci la tua città..."
                                        autocomplete="city" minlength="3" maxlength="50">

                                    <small id="cityHelp" class="text-muted">(*) La Tua Città Deve Contenere

                                        min:3, max:50 caratteri.</small>

                                </div>

                                @error('city')

                                    <span class="invalid-feedback" role="alert">

                                        <strong>{{ $message }}</strong>

                                    </span>

                                @enderror

                            </div>



                            {{-- REGISTRAZIONE PROVINCIA --}}

                            <div class="form-group row">

                                <label for="province"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Provincia') }}</label>



                                <div class="col-md-6">

                                    <input id="pv" type="text" class="form-control" name="pv" required
                                        value="{{ old('pv') }}" placeholder="Inserisci la tua provincia..."
                                        autocomplete="pv" minlength="2" maxlength="30">

                                    <small id="pv" class="form-text text-muted">(*) La Tua Provincia Deve Contenere min 2,

                                        max 50 caratteri</small>

                                </div>

                                @error('province')

                                    <span class="invalid-feedback" role="alert">

                                        <strong>{{ $message }}</strong>

                                    </span>

                                @enderror

                            </div>



                            {{-- REGISTRAZIONE SPECIALIZZAZIONI --}}

                            <div class="form-group row">

                                <label for="specializations"
                                    class="col-md-4 col-form-label text-md-right">Specializzazioni</label>

                                <div style="width: 60%" id="form_check" class="form-check col-md-6 mx-3">

                                    <small id="specializations" class="form-text text-muted">(*)Seleziona una o più

                                        Specializzazzioni</small>



                                    @if ($specializations)

                                        @foreach ($specializations as $specialization)

                                            @if ($errors->any())

                                                <input name="specializations[]" id="specializations"
                                                    class="form-check-input d-block" type="checkbox"
                                                    value="{{ old($specialization->id) }}"
                                                    {{ in_array($specialization->id, old('specializations')) ? 'checked' : '' }}>

                                            @endif

                                            <input name="specializations[]" id="specializations"
                                                class="form-check-input d-block " type="checkbox"
                                                value="{{ $specialization->id }}">
                                            <label class="form-check-label d-block" for="specializations">

                                                {{ $specialization->name }}

                                            </label>

                                        @endforeach

                                    @endif

                                </div>

                            </div>



                            {{-- REGISTRAZIONE TELEFONO --}}

                            <div class="form-group row">

                                <label for="phone_number"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Numero di Telefono') }}</label>

                                <div class="col-md-6">

                                    <input id="phone_number" type="text" class="form-control" name="phone_number" required
                                        value="{{ old('phone_number') }}" autocomplete="phone_number" minlength="9"
                                        maxlength="13" placeholder="Inserisci il tuo telefono..." autofocus>

                                    <small id="phone_numberHelp" class="form-text text-muted">(*) Il Telefono, Deve

                                        Contenere

                                        min 9, max 13 caratteri</small>

                                </div>

                                @error('phone_number')

                                    <span class="invalid-feedback" role="alert">

                                        <strong>{{ $message }}</strong>

                                    </span>

                                @enderror

                            </div>



                            {{-- REGISTRAZIONE E-MAIL --}}

                            <div class="form-group row">

                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('e-Mail') }}</label>



                                <div class="col-md-6">

                                    <input id="email" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2, 4}$"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" placeholder="Inserisci una mail valida..." required
                                        autocomplete="email" minlength="7" maxlength="100">

                                    <small id="emailHelp" class="form-text text-muted">(*)E-mail valida...

                                        esempio@gmail.it</small>

                                    @error('email')

                                        <span class="invalid-feedback" role="alert">

                                            <strong>{{ $message }}</strong>

                                        </span>

                                    @enderror

                                </div>

                            </div>



                            {{-- REGISTRAZIONE PASSWORD --}}

                            <div class="form-group row">

                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">

                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password" minlength="8" placeholder="Inserisci password">

                                    <small id="passwordHelp" class="form-text text-muted">(*)La Password deve contenere

                                        almeno 8 caratteri</small>

                                    @error('password')

                                        <span class="invalid-feedback" role="alert">

                                            <strong>{{ $message }}</strong>

                                        </span>

                                    @enderror

                                </div>

                            </div>



                            {{-- REGISTRAZIONE CONFERMA PASSWORD --}}

                            <div class="form-group row">

                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Conferma Password') }}</label>



                                <div class="col-md-6">

                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password" minlength="8"
                                        placeholder="Conferma password">

                                    <small id="password-confirmHelp" class="form-text text-muted">(*)Ripeti e Conferma La

                                        Tua Password</small>

                                </div>

                            </div>



                            {{-- BOTTONE INVIA FORM DI REGISTRAZIONE --}}

                            <div class="form-group row mb-0">

                                <div class="col-md-6 offset-md-4">

                                    <button type="submit" class="btn text-white btn-lg my-3 form-button">

                                        {{ __('Registra') }}

                                    </button>

                                </div>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
