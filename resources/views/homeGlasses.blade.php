@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3">
            <a href="{{ route('homeGlasses') }}" class="btn btn-primary form-control m-2">Home/Glasses</a>
            <a href="{{ route('home.showClientForm') }}" class="btn btn-primary form-control m-2">New Client</a>
            <a href="{{ route('home.allDebtors') }}" class="btn btn-secondary form-control m-2">Home/Debtors</a>
        </div>
        <div class="col-1"></div>
        <div class="col-8">
            <div class="row">
                <div class="col-6">
                    <h2>All Clients - Glasses</h2>
                </div>
                <div class="col-6">
                    <form action="{{route('searchClient')}}" method="POST">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="name" class="form-control" placeholder="Search client" aria-label="Search client">
                            <input type="submit" class="btn btn-outline-secondary" value="Find">
                        </div>
                    </form>
                </div>
            </div>
                @if(isset($search_clients))
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Date of birth</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>Phone</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($search_clients as $search_client)
                        <tr>
                            <td><a href="{{ route('home.singleClient',['id'=>$search_client->id]) }}" class="text-decoration-none fw-bold">{{ $search_client->name }}</a></td>
                            <td>{{ $search_client->date_of_birth }}</td>
                            <td>{{ $search_client->address }}</td>
                            <td>{{ $search_client->city }}</td>
                            <td>{{ $search_client->phone }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            <br>
            <table class="table table-hover table-bordered text-center">
                <thead>
                <tr class="table-primary">
                    <th>Name</th>
                    <th>Date of birth</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>Phone</th>
                    <th>Identity card</th>
                    <th>Created at</th>
                </tr>
                </thead>
                <tbody>
                @foreach($all_clients as $client)
                    <tr>
                        <td><a href="{{ route('home.singleClient',['id'=>$client->id]) }}" class="text-decoration-none fw-bold">{{ $client->name }}</a></td>
                        <td>{{ $client->date_of_birth }}</td>
                        <td>{{ $client->address }}</td>
                        <td>{{ $client->city }}</td>
                        <td>{{ $client->phone }}</td>
                        <td>{{ $client->identity_card }}</a></td>
                        <td>{{ $client->created_at->format('d.m.Y') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
