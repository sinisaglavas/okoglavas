@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col">
                <a href="{{ route('home.showContactLensesForm') }}" class="btn btn-danger form-control m-2">Novi klijent</a>
            </div>
            <div class="col">
                <a href="{{ route('allDebtorsContactLenses') }}" class="btn btn-danger form-control m-2">Svi klijenti / Dužnici</a>
            </div>
            <div class="col">
                <a href="/home/show-new-type-contact-lens-form" class="btn btn-danger form-control m-2">Unesi novi tip Kontaktnih sočiva</a>
            </div>
            <div class="col">
                <a href="#" class="btn btn-outline-danger form-control m-2">Ukupno klijenata: {{ \Illuminate\Support\Facades\DB::table('contact_lenses_clients')->select('id')->count('id') }}</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-6">
                        <h2>Svi klijenti</h2>
                    </div>
                    <div class="col-6">
                        <form action="{{route('searchContactLensesClients')}}" method="POST">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="name" class="form-control" placeholder="Traži klijenta po imenu ili po broju telefona" aria-label="Search client">
                                <input type="submit" class="btn btn-outline-secondary" value="Traži">
                            </div>
                        </form>
                    </div>
                </div>

                @if(isset($search_clients))
                    <h5 class="btn text-uppercase" style="background: #f5828b; color: #fff;">Rezultat pretrage:</h5>
                    <table class="table table-hover table-bordered border-dark text-center">
                        <thead>
                        <tr style="background: #f5828b; color: #fff;">
                            <th>Id</th>
                            <th>Ime</th>
                            <th>Datum rođenja</th>
                            <th>Adresa</th>
                            <th>Grad</th>
                            <th>Telefon</th>
                            <th>Lična karta broj</th>
                            <th>Kreirano</th>
                            <th></th>
                        </thead>
                        <tbody>
                        @foreach($search_clients as $search_client)
                            <tr>
                                <td>{{ $search_client->id }}</td>
                                <td title="Klik na istoriju pregleda"><a href="{{ route('home.singleContactLensesClient',['id'=>$search_client->id]) }}" class="text-decoration-none fw-bold">{{ $search_client->name }}</a></td>
                                <td>{{ $search_client->date_of_birth }}</td>
                                <td>{{ $search_client->address }}</td>
                                <td>{{ $search_client->city }}</td>
                                <td>{{ $search_client->phone }}</td>
                                <td>{{ $search_client->identity_card }}</a></td>
                                <td>{{ $search_client->created_at->format('d.m.Y') }}</td>
                                <td><button class="btn" style="background: #f5828b;"><a href="{{ route('editCL', ['id'=>$search_client->id]) }}" style="color: #fff; text-decoration: none">Promeni</a></button></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
                <br>
                <table class="table table-hover table-bordered text-center">
                    <thead>
                    <tr>
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
                            <td title="Klik na istoriju pregleda"><a href="{{ route('home.singleContactLensesClient',['id'=>$client->id]) }}" class="text-decoration-none text-danger">{{ $client->name }}</a></td>
                            <td>{{ $client->date_of_birth }}</td>
                            <td>{{ $client->address }}</td>
                            <td>{{ $client->city }}</td>
                            <td>{{ $client->phone }}</td>
                            <td>{{ $client->identity_card }}</a></td>
                            <td>{{ $client->created_at->format('d.m.Y') }}</td>
                            <td><button class="btn" style="background: #f5828b;"><a href="{{ route('editCL', ['id'=>$client->id]) }}" style="color: #fff; text-decoration: none">Promeni</a></button></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection

