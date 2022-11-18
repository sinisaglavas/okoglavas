@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">
                <a href="{{ route('allDebtorsContactLenses') }}" class="btn btn-secondary form-control m-2">Home/Debtors Contact Lenses</a>
                <a href="{{ route('homeContactLenses') }}" class="btn btn-primary form-control m-2">Home/Contact Lenses</a>
            </div>
            <div class="col-1"></div>
            <div class="col-5 border-bottom">
                <h2 class="text-center">{{ $debtor->name }}</h2><br>
                <table class="table table-hover table-bordered text-center m-3">
                    <thead>
                    <tr class="table-primary">
                        <th>Debit</th>
                        <th>Created at</th>
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
                        <th>Payment</th>
                        <th>Created at</th>
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
                        <h5 class="fw-bold text-center text-bg-primary">Ukupno uplaceno: {{ \App\Models\PaymentContactLense::where('debtors_contact_lenses_id', $debtor->id)->sum('payment') }}</h5>
                    </div>
                    <div class="col-6">
                        <h5 class="fw-bold text-center text-bg-danger">Trenutno zaduzenje: {{ $debtor->debit - \App\Models\PaymentContactLense::where('debtors_contact_lenses_id', $debtor->id)->sum('payment') }}</h5>

                    </div>
                </div>
            </div>
            <div class="col-3">
                <form action="{{ route('savePaymentContactLensesForm',['id'=>$debtor->id]) }}" method="POST" class="m-3">
                    @csrf
                    <label for="payment">Payment</label>
                    <input type="number" name="payment" class="form-control" id="payment" required><br>
                    <button class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection



