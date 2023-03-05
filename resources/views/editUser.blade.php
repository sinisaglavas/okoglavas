@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4">
                <h2>Promeni svoje podatke</h2>
                <form action="{{ route('updateUser',['id'=>$user->id]) }}" method="POST">
                    @csrf
                    @method('put')

                    <label for="name">Ime</label>
                    <input type="text" name="name" id="name" placeholder="Unos je obavezan" class="form-control" value="{{ $user->name }}" required>
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Unos je obavezan" class="form-control" value="{{ $user->email }}" required>
                    <label for="password">Lozinka</label>
                    <input type="password" name="password" id="password" class="form-control" value="{{ $user->password }}">
                    @error('password')
                    <p class="bg-warning">{{ $errors->first('password') }}</p>
                    @enderror
                    <br>
                    <button type="submit" class="btn btn-outline-success form-control">Promeni</button>
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


