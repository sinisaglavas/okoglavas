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
                <h2 class="text-center">Svi dužnici</h2><br>
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

