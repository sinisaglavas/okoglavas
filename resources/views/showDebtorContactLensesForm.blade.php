@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">
                <a href="{{ route('allDebtorsContactLenses') }}" class="btn btn-danger form-control m-2">Svi klijenti / Dužnici</a>
                <a href="{{ route('homeContactLenses') }}" class="btn btn-danger form-control m-2">Svi klijenti</a>

            </div>
            <div class="col-1"></div>
            <div class="col-8">
                <h2>Odaberi klijenta:</h2></div>
        </div>
        <div class="row">
            <div class="col-4"></div>

            <div class="col-5">
                <form action="{{ route('saveDebtorContactLensesForm') }}" method="POST">
                    @csrf
                    <label for="find_client">Pronađi klijenta</label>
                    <select name="client" class="form-control" id="find_client">
                        @foreach($all_clients as $single_client)
                            <option value="{{ $single_client->id}}">{{ $single_client->name }}</option>
                        @endforeach
                    </select><br>
                    <label for="debit">Dug</label>
                    <input type="number" name="debit" class="form-control" id="debit" required><br>
                    <button class="btn btn-danger form-control">Zapamti</button>
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


