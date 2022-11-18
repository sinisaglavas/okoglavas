@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">
                <a href="{{ route('home.allDebtors') }}" class="btn btn-secondary form-control m-2">Home/Debtors</a>
                <a href="{{ route('showDebtorForm') }}" class="btn btn-secondary form-control m-2">New debtor</a>
                <a href="{{ route('homeGlasses') }}" class="btn btn-primary form-control m-2">Home/Glasses</a>

            </div>
            <div class="col-1"></div>
            <div class="col-8">
                <h2 class="text-center">All Debtors</h2><br>
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
                            <td><a href="{{ route('home.showSingleDebtor',['id'=>$debtor->id]) }}" class="text-decoration-none text-danger">{{ $debtor->name }}</a></td>
                            <td>{{ $debtor->client_phone }}</td>
                            <td >{{ $debtor->debit }}</td>
                                @if($debtor->debit - \App\Models\Payment::where('debtor_id', $debtor->id)->sum('payment') > 1)
                            <td style="background-color: rgb(252, 194, 189);">{{ $debtor->debit - \App\Models\Payment::where('debtor_id', $debtor->id)->sum('payment') }}</td>
                                @else
                            <td style="background-color:rgb(0, 255, 0) ">{{ $debtor->debit - \App\Models\Payment::where('debtor_id', $debtor->id)->sum('payment') }}</td>
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

