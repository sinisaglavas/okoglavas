@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">
                <a href="{{ route('showDebtorContactLensesForm') }}" class="btn btn-danger form-control m-2">Novi dužnik</a>
                <a href="{{ route('homeContactLenses') }}" class="btn btn-danger form-control m-2">Svi klijenti</a>
                <div class="row mt-3">
                    <span class="text-uppercase text-center">Filter:</span>
                    <div class="col">
                        <a href="{{ route('allDebtorsContactLenses') }}" class="btn btn-danger form-control m-2">Svi</a>
                    </div>
                    <div class="col">
                        <a href="{{ route('unpaidDebtCL') }}" class="btn btn-warning form-control m-2">Neplaćeno</a>
                    </div>
                </div>
            </div>

            <div class="col-1"></div>
            <div class="col-8">
                <div class="row mb-3">
                    <div class="col-3">
                        @if((url()->current() == route('allDebtorsContactLenses')))
                            <h2 class="btn btn-outline-danger form-control fw-bold border text-uppercase">Svi dužnici</h2>
                        @endif
                        @if((url()->current() == route('unpaidDebtCL')))
                            <h2 class="btn btn-outline-warning form-control fw-bold border text-uppercase">Neplaćeno</h2>
                        @endif
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
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
                @if((url()->current() == route('allDebtorsContactLenses')))
                <table class="table table-hover table-bordered text-center">
                    <thead>
                    <tr class="table-danger">
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
                            @if($debtor->debit - \App\Models\PaymentContactLense::where('debtors_contact_lenses_id', $debtor->id)->sum('payment') >= 1)
                            <td style="background-color: rgb(252, 194, 189);">{{ $debtor->id }}</td>
                            @else
                            <td>{{ $debtor->id }}</td>
                            @endif
                            <td><a href="{{ route('showSingleDebtorContactLenses',['id'=>$debtor->id]) }}" class="text-decoration-none text-danger">{{ $debtor->name }}</a></td>
                            <td>{{ $debtor->client_phone }}</td>
                            <td >{{ $debtor->debit }}</td>
                            @if($debtor->debit - \App\Models\PaymentContactLense::where('debtors_contact_lenses_id', $debtor->id)->sum('payment') > 1)
                                <td style="background-color: rgb(252, 194, 189);">{{ $debtor->debit - \App\Models\PaymentContactLense::where('debtors_contact_lenses_id', $debtor->id)->sum('payment') }}</td>
                            @else
                                <td>{{ $debtor->debit - \App\Models\PaymentContactLense::where('debtors_contact_lenses_id', $debtor->id)->sum('payment') }}</td>
                            @endif
                            <td>{{ $debtor->created_at->format('d.m.Y.') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @endif
                @if((url()->current() == route('unpaidDebtCL')))
                    <table class="table table-hover table-bordered text-center">
                        <thead>
                        <tr class="table-danger">
                            <th>Id</th>
                            <th>Ime</th>
                            <th>Telefon</th>
                            <th>Ukupan Dug</th>
                            <th>Trenutni dug</th>
                            <th>Kreirano</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($unpaidDebtors as $debtor)
                            <tr>
                                <td>{{ $debtor->id }}</td>
                                <td><a href="{{ route('home.showSingleDebtor',['id'=>$debtor->id]) }}" class="text-decoration-none text-black">{{ $debtor->name }}</a></td>
                                <td>{{ $debtor->client_phone }}</td>
                                <td >{{ $debtor->debit }}</td>
                                <td style="background-color: rgb(204, 39, 58); color: #fff;">{{ $debtor->debit - $debtor->total_paid }}</td>
                                <td>{{ $debtor->created_at->format('d.m.Y.') }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

@endsection
