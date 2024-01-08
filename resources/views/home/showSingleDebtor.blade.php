@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">
                <a href="{{ route('home.allDebtors') }}" class="btn btn-primary form-control m-2">Svi Klijenti / Dužnici</a>
                <a href="{{ route('homeGlasses') }}" class="btn btn-primary form-control m-2">Svi klijenti</a>
            </div>
            <div class="col-1"></div>
            <div class="col-5 border-bottom">
                <h2 class="text-center">{{ $debtor->name }}</h2><br>
                <table class="table table-hover table-bordered text-center m-3">
                    <thead>
                    <tr class="table-primary">
                        <th>Zaduženje</th>
                        <th>Kreirano</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($debtors as $debtor)
                        <tr>
                            <td>{{ $debtor->debit }}</td>
                            <td>{{ $debtor->created_at->format('d.m.Y.') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-3 border-bottom">
            </div>
        </div>
        <div class="row">
                <div class="col-4"></div>
                <div class="col-5">
                    <table class="table table-bordered text-center m-3">
                        <thead>
                        <tr class="table-primary">
                            <th>Plaćanja</th>
                            <th>Kreirano</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($payments as $payment)
                            <tr>
                                <td>{{ $payment->payment }}</td>
                                <td>{{ $payment->created_at->format('d.m.Y.') }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table><br>
                    <div class="row">
                        <div class="col-6">
                            <h5 class="btn btn-outline-primary form-control form-control-sm">Ukupno uplaćeno: {{ \App\Models\Payment::where('debtor_id', $debtor->id)->sum('payment') }}</h5>
                        </div>
                        <div class="col-6">
                            @if($debtor->debit - \App\Models\Payment::where('debtor_id', $debtor->id)->sum('payment') > 0)
                            <h5 class="btn btn-outline-danger form-control form-control-sm">Trenutno zaduženje: {{ $debtor->debit - \App\Models\Payment::where('debtor_id', $debtor->id)->sum('payment') }}</h5>
                            @elseif($debtor->debit - \App\Models\Payment::where('debtor_id', $debtor->id)->sum('payment') == 0)
                            <h5 class="btn btn-outline-success form-control form-control-sm">Trenutno zaduženje: {{ $debtor->debit - \App\Models\Payment::where('debtor_id', $debtor->id)->sum('payment') }}</h5>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <form action="{{ route('home.savePaymentForm',['id'=>$debtor->id]) }}" method="POST" class="m-3">
                        @csrf
                        <label for="payment">Uplaćeno:</label>
                        <input type="number" name="payment" class="form-control" id="payment" min="0" required><br>
                        <button class="btn btn-primary form-control">Zapamti</button>
                    </form>
                </div>
        </div>
    </div>
@endsection


