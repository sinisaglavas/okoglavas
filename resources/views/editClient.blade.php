@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4">
                <a href="{{ route('homeGlasses') }}" class="btn btn-primary form-control m-2">Svi klijenti</a>
            </div>
            <div class="col-2"></div>
            <div class="col-4">
                <h2>Izmeni klijenta</h2>
                <form action="/client/{{ $client->id }}/edit" method="post">
                    @csrf
                    @method('put')

                    <label for="name">Ime</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $client->name }}" required>
                    <label for="date-of-birth">Datum rođenja</label>
                    <input type="text" name="date_of_birth" placeholder="Unos je opcionalan" id="date-of-birth" class="form-control"
                           value="{{ $client->date_of_birth }}">
                    <label for="address">Adresa</label>
                    <input type="text" name="address" id="address" placeholder="Unos je opcionalan" class="form-control" value="{{ $client->address }}">
                    <label for="city">Grad</label>
                    <input type="text" name="city" id="city" placeholder="Unos je opcionalan" class="form-control" value="{{ $client->city }}">
                    <label for="phone">Telefon</label>
                    <input type="tel" name="phone" id="phone" class="form-control" value="{{ $client->phone }}" required>
                    @error('phone')
                    <p class="bg-warning">{{ $errors->first('phone') }}</p>
                    @enderror
                    <br>
                    <label for="identity_card">Lična karta broj</label>
                    <input type="number" name="identity_card" placeholder="Unos je opcionalan" id="identity_card" class="form-control" value="{{ $client->identity_card }}">
{{--                    @error('identity_card')--}}
{{--                    <p class="bg-warning">{{ $errors->first('identity_card') }}</p>--}}
{{--                    @enderror--}}
                    <button type="submit" class="btn btn-outline-primary form-control">Promeni</button>
                </form>
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
