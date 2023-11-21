@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4">
                <a href="{{ route('homeContactLenses') }}" class="btn btn-danger form-control m-2">Svi klijenti</a>
            </div>
            <div class="col-2"></div>
            <div class="col-4">
                <h2>Novi klijent - Kontaktna sočiva</h2>
                <form action="{{ route('home.saveContactLensesClientForm') }}" method="POST">
                    @csrf
                    <label for="name">Ime i prezime</label>
                    <input type="text" name="name" id="name" class="form-control"  placeholder="Unos je obavezan" required>
                    <label for="date-of-birth">Datum rođenja</label>
                    <input type="text" name="date_of_birth" id="date-of-birth" class="form-control">
                    <label for="address">Adresa</label>
                    <input type="text" name="address" id="address" class="form-control">
                    <label for="city">Grad</label>
                    <input type="text" name="city" id="city" class="form-control">
                    <label for="phone">Telefon</label>
                    <input type="tel" name="phone" id="phone" class="form-control" placeholder="Unos je obavezan" required>
                    @error('phone')
                    <p class="bg-warning">{{ $errors->first('phone') }}</p>
                    @enderror
                    <br>
                    <label for="identity_card">Lična karta broj</label>
                    <input type="number" name="identity_card" id="identity_card" class="form-control"><br>
                    <button type="submit" class="btn btn-danger form-control">Zapamti</button>
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

