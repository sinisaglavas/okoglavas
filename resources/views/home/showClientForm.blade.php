@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4">
                <a href="{{ route('homeGlasses') }}" class="btn btn-primary form-control m-2">Home/Glasses</a>
            </div>
            <div class="col-2"></div>
            <div class="col-4">
                <h2>New Client - Glasses</h2>
                <form action="{{ route('home.saveClient') }}" method="POST">
                    @csrf
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                    <label for="date-of-birth">Date of birth</label>
                    <input type="text" name="date_of_birth" id="date-of-birth" class="form-control">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" placeholder="Entry is optional" class="form-control">
                    <label for="city">City</label>
                    <input type="text" name="city" id="city" placeholder="Entry is optional" class="form-control">
                    <label for="phone">Phone</label>
                    <input type="tel" name="phone" id="phone" class="form-control" required>
                    @error('phone')
                    <p class="bg-warning">{{ $errors->first('phone') }}</p>
                    @enderror
                    <br>
                    <label for="identity_card">Identity card</label>
                    <input type="number" name="identity_card" placeholder="Entry is optional" id="identity_card" class="form-control"><br>
                    <button type="submit" class="btn btn-primary">Save</button>
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
