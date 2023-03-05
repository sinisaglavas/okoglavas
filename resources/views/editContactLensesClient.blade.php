@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4">
                <a href="{{ route('homeContactLenses') }}" class="btn btn-danger form-control m-2">Svi klijenti</a>
            </div>
            <div class="col-2"></div>
            <div class="col-4">
                <h2>Izmeni klijenta</h2>
                <form action="{{ route('updateCL', ['id'=>$client->id]) }}" method="POST">
                    @csrf
                    @method('put')
                    <label for="name">Ime</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $client->name }}" placeholder="Unos je obavezan" required>
                    <label for="date-of-birth">Datum rođenja</label>
                    <input type="text" name="date_of_birth" id="date-of-birth" class="form-control" value="{{ $client->date_of_birth }}">
                    <label for="address">Adresa</label>
                    <input type="text" name="address" id="address" class="form-control" value="{{ $client->address }}" >
                    <label for="city">Grad</label>
                    <input type="text" name="city" id="city" class="form-control" value="{{ $client->city }}">
                    <label for="phone">Telefon</label>
                    <input type="tel" name="phone" id="phone" class="form-control" value="{{ $client->phone }}" placeholder="Unos je obavezan" required>
                    @error('phone')
                    <p class="bg-warning">{{ $errors->first('phone') }}</p>
                    @enderror
                    <br>
                    <label for="identity_card">Lična karta broj</label>
                    <input type="number" name="identity_card" id="identity_card" class="form-control" value="{{ $client->identity_card }}"><br>
                    <button type="submit" class="btn btn-outline-danger form-control">Promeni</button>
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

