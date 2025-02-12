@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">
                <a href="{{ route('home.allDebtors') }}" class="btn btn-primary form-control m-2">Svi Klijenti / Dužnici</a>
                <a href="{{ route('homeGlasses') }}" class="btn btn-primary form-control m-2">Svi klijenti</a>
                <div class="border border-opacity-10 m-3 p-3">
                    <h5 class="mt-3">{{ $debtor->name }} - ukupno sve:</h5>
                    <hr>
                    <h6>Kreirano: {{ $debtor->created_at->format('d.m.Y.') }}</h6>
                    <h6>Zaduženje: {{ $debtor->debit }} dinara</h6>
                    <h6>Ukupno plaćeno: {{ \App\Models\Payment::where('debtor_id', $debtor->id)->sum('payment') }} dinara</h6>
                    @if($debtor->debit - \App\Models\Payment::where('debtor_id', $debtor->id)->sum('payment') > 0)
                        <h6>Trenutno zaduženje: <span style="color: #b82830; font-weight: bold">{{ $debtor->debit - \App\Models\Payment::where('debtor_id', $debtor->id)->sum('payment') }} dinara</span></h6>
                    @elseif($debtor->debit - \App\Models\Payment::where('debtor_id', $debtor->id)->sum('payment') <= 0)
                        <h6>Trenutno stanje: <span style="font-weight: bold">{{ $debtor->debit - \App\Models\Payment::where('debtor_id', $debtor->id)->sum('payment') }}</span></h6>
                    @endif
                </div>
            </div>
            <div class="col-1"></div>
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
                </table>


            </div>
            <div class="col">
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


