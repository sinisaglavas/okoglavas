@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-4">
            <a href="{{ route('home.showClientForm') }}" class="btn btn-primary form-control m-2">Novi klijent</a>
        </div>
        <div class="col-4">
            <a href="{{ route('home.allDebtors') }}" class="btn btn-primary form-control m-2">Svi klijenti / Dužnici</a>
        </div>
        <div class="col-4">
            <a href="#" class="btn btn-outline-primary form-control m-2">Ukupno klijenata: {{ \Illuminate\Support\Facades\DB::table('clients')->select('id')->count('id') }}</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col">
                    <h2>Svi klijenti - Naočare</h2>
                </div>
                <div class="col">
                    <form action="{{route('searchClient')}}" method="POST">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="name" class="form-control" placeholder="Traži klijenta po imenu ili po broju telefona" aria-label="Search client">
                            <input type="submit" class="btn btn-outline-secondary" value="Traži">
                        </div>
                    </form>
                </div>
            </div>
                @if(isset($search_clients))
                    <table class="table text-center">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Ime</th>
                            <th>Datum rođenja</th>
                            <th>Adresa</th>
                            <th>Grad</th>
                            <th>Telefon</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($search_clients as $search_client)
                        <tr>
                            <td>{{ $search_client->id }}</td>
                            <td><a href="{{ route('home.singleClient',['id'=>$search_client->id]) }}" class="text-decoration-none fw-bold">{{ $search_client->name }}</a></td>
                            <td>{{ $search_client->date_of_birth }}</td>
                            <td>{{ $search_client->address }}</td>
                            <td>{{ $search_client->city }}</td>
                            <td>{{ $search_client->phone }}</td>
                            <td style="background-color: #86b7fe;"><a href="/client/{{$search_client->id}}/edit" style="text-decoration: none; color: white; display: block">Promeni</a></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            <br>
            <table class="table table-hover table-bordered text-center">
                <thead>
                <tr class="table-primary">
                    <th>Id</th>
                    <th>Ime</th>
                    <th>Datum rođenja</th>
                    <th>Adresa</th>
                    <th>Grad</th>
                    <th>Telefon</th>
                    <th>Lična karta broj</th>
                    <th>Kreirano</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($all_clients as $client)
                    <tr>
                        <td>{{ $client->id }}</td>
                        <td><a href="{{ route('home.singleClient',['id'=>$client->id]) }}" class="text-decoration-none">{{ $client->name }}</a></td>
                        <td>{{ $client->date_of_birth }}</td>
                        <td>{{ $client->address }}</td>
                        <td>{{ $client->city }}</td>
                        <td>{{ $client->phone }}</td>
                        <td>{{ $client->identity_card }}</a></td>
                        <td>{{ $client->created_at->format('d.m.Y') }}</td>
                        <td style="background-color: #86b7fe"><a href="/client/{{$client->id}}/edit" style="text-decoration: none; color: black; display: block">Promeni</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
