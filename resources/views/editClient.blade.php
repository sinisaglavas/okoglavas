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
                    <div class="row">
                        <div class="col">
                            <label for="name">Ime i prezime</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $client->name }}" required>
                        </div>
                        <div class="col">
                            <label for="date-of-birth">Datum rođenja</label>
                            <input type="text" name="date_of_birth" placeholder="Unos je opcionalan" id="date-of-birth" class="form-control"
                                   value="{{ $client->date_of_birth }}">
                        </div>
                    </div>
                    <label for="address">Adresa</label>
                    <input type="text" name="address" id="address" placeholder="Unos je opcionalan" class="form-control" value="{{ $client->address }}">
                    <label for="city">Grad</label>
                    <input type="text" name="city" id="city" placeholder="Unos je opcionalan" class="form-control" value="{{ $client->city }}">
                    <label for="phone">Telefon</label>
                    <input type="tel" name="phone" id="phone" class="form-control" value="{{ $client->phone }}" required>
                    @error('phone')
                    <p class="bg-warning">{{ $errors->first('phone') }}</p>
                    @enderror
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="{{ $client->email }}" class="form-control">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
{{--                    <label for="identity_card">Lična karta broj</label>--}}
{{--                    <input type="number" name="identity_card" placeholder="Unos je opcionalan" id="identity_card" class="form-control mb-4" value="{{ $client->identity_card }}">--}}
                    <button type="submit" class="btn btn-primary form-control mt-4">Promeni</button>
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
