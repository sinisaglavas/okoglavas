@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">
                <a href="{{ route('showDebtorForm') }}" class="btn btn-primary form-control m-2">Novi klijent / Dužnik</a>
                <a href="{{ route('homeGlasses') }}" class="btn btn-primary form-control m-2">Svi klijenti</a>

            </div>
            <div class="col-1"></div>
            <div class="col-8">

                <div class="row mb-3">
                    <div class="col-3">
                        <h2>Svi dužnici</h2>
                    </div>
                    <div class="col-3"></div>
                    <div class="col-6">
                        <form action="{{route('searchDebtClient')}}" method="POST">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="name" class="form-control" placeholder="Traži dužnika po imenu ili po broju telefona" aria-label="Search client">
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
                            <th>Telefon</th>
                            <th>Ukupni dug</th>
                            <th>Trenutni dug</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($search_clients as $search_client)
                            <tr>
                                <td>{{ $search_client->id }}</td>
                                <td><a href="{{ route('home.showSingleDebtor',['id'=>$search_client->id]) }}" class="text-decoration-none fw-bold">{{ $search_client->name }}</a></td>
                                <td>{{ $search_client->client_phone }}</td>
                                <td>{{ $search_client->debit }}</td>
                                <td>{{ $search_client->debit - \App\Models\Payment::where('debtor_id', $search_client->id)->sum('payment') }}</td>
                                <td style="background-color: #86b7fe;"><a href="/client/{{$search_client->id}}/edit" style="text-decoration: none; color: white; display: block">Promeni</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif

                <table class="table table-hover table-bordered text-center">
                    <thead>
                    <tr class="table-primary">
                        <th>Id</th>
                        <th>Ime</th>
                        <th>Telefon</th>
                        <th>Ukupan Dug</th>
                        <th>Trenutni dug</th>
                        <th>Kreirano</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($all_debtors as $debtor)
                        <tr>
                            @if($debtor->debit - \App\Models\Payment::where('debtor_id', $debtor->id)->sum('payment') >= 1)
                            <td style="background-color: rgb(252, 141, 141);">{{ $debtor->id }}</td>
                            @else
                            <td>{{ $debtor->id }}</td>
                            @endif
                            <td><a href="{{ route('home.showSingleDebtor',['id'=>$debtor->id]) }}" class="text-decoration-none text-black">{{ $debtor->name }}</a></td>
                            <td>{{ $debtor->client_phone }}</td>
                            <td >{{ $debtor->debit }}</td>
                            @if($debtor->debit - \App\Models\Payment::where('debtor_id', $debtor->id)->sum('payment') >= 1)
                            <td style="background-color: rgb(252, 141, 141);">{{ $debtor->debit - \App\Models\Payment::where('debtor_id', $debtor->id)->sum('payment') }}</td>
                            @else
                            <td>{{ $debtor->debit - \App\Models\Payment::where('debtor_id', $debtor->id)->sum('payment') }}</td>
                            @endif
                            <td>{{ $debtor->created_at->format('d.m.Y.') }}</td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection

