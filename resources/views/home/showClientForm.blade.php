@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4">
                <a href="{{ route('homeGlasses') }}" class="btn btn-primary form-control m-2">Svi klijenti</a>
                @if(isset($new_client))
                <a href="{{ route('home.showExaminationForm',['id'=>$new_client_id]) }}" class="btn btn-info m-2 form-control">Klijent: <span>{{ $new_client->name }}</span> - Novi pregled</a>
                @endif
            </div>
            <div class="col-2"></div>
            <div class="col-4">
                <h2>Novi klijent - Naočare</h2>
                <form action="{{ route('home.saveClient') }}" method="POST">
                    @csrf
                    <label for="name">Ime</label>
                    <input type="text" name="name" id="name" placeholder="Unos je obavezan" class="form-control" required>
                    <label for="date-of-birth">Datum rođenja</label>
                    <input type="text" name="date_of_birth" id="date-of-birth" class="form-control">
                    <label for="address">Adresa</label>
                    <input type="text" name="address" id="address" class="form-control">
                    <label for="city">Grad</label>
                    <input type="text" name="city" id="city" class="form-control">
                    <label for="phone">Telefon</label>
                    <input type="tel" name="phone" id="phone" placeholder="Unos je obavezan" class="form-control" required>
                    @error('phone')
                    <p class="bg-warning">{{ $errors->first('phone') }}</p>
                    @enderror
                    <br>
                    <label for="identity_card">Lična karta broj:</label>
                    <input type="number" name="identity_card" id="identity_card" class="form-control"><br>
                    <button type="submit" class="btn btn-primary form-control">Zapamti</button>
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
