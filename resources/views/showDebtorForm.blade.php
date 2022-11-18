@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">
                <a href="{{ route('home.allDebtors') }}" class="btn btn-secondary form-control m-2">Home/Debtors</a>
                <a href="{{ route('homeGlasses') }}" class="btn btn-primary form-control m-2">Home/Glasses</a>

            </div>
            <div class="col-1"></div>
            <div class="col-8">
            <h2>Select the debtor</h2></div>
        </div>
        <div class="row">
            <div class="col-4"></div>

            <div class="col-8">
                <form action="{{ route('saveDebtorForm') }}" method="POST">
                    @csrf
                    <label for="find_client">Find client</label>
                    <select name="client" class="form-control" id="find_client">
                        @foreach($all_clients as $single_client)
                            <option value="{{ $single_client->id}}">{{ $single_client->name }}</option>
                        @endforeach
                    </select><br>
                    <label for="debit">Debit</label>
                    <input type="number" name="debit" class="form-control" id="debit" required><br>
                    <button class="btn btn-primary">Save</button>
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

