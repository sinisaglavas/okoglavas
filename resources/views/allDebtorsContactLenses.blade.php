@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">
                <a href="{{ route('allDebtorsContactLenses') }}" class="btn btn-secondary form-control m-2">Home/Debtors Contact Lenses</a>
                <a href="{{ route('showDebtorContactLensesForm') }}" class="btn btn-secondary form-control m-2">New debtor</a>
                <a href="{{ route('homeContactLenses') }}" class="btn btn-primary form-control m-2">Home/Contact Lenses</a>

            </div>
            <div class="col-1"></div>
            <div class="col-8">
                <h2 class="text-center">All Debtors / Contact Lenses</h2><br>
                <table class="table table-hover table-bordered text-center">
                    <thead>
                    <tr class="table-primary">
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Debit</th>
                        <th>Current debit</th>
                        <th>Created at</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($all_debtors as $debtor)
                        <tr>
                            <td><a href="{{ route('showSingleDebtorContactLenses',['id'=>$debtor->id]) }}" class="text-decoration-none text-danger">{{ $debtor->name }}</a></td>
                            <td>{{ $debtor->client_phone }}</td>
                            <td >{{ $debtor->debit }}</td>
                            @if($debtor->debit - \App\Models\PaymentContactLense::where('debtors_contact_lenses_id', $debtor->id)->sum('payment') > 1)
                                <td style="background-color: rgb(252, 194, 189);">{{ $debtor->debit - \App\Models\PaymentContactLense::where('debtors_contact_lenses_id', $debtor->id)->sum('payment') }}</td>
                            @else
                                <td style="background-color: rgb(0, 255, 0)">{{ $debtor->debit - \App\Models\PaymentContactLense::where('debtors_contact_lenses_id', $debtor->id)->sum('payment') }}</td>
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
