@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-4">
                <a href="{{ route('allStock') }}" class="btn btn-secondary form-control m-2">Svi artikli - LAGER</a>
            </div>
            <div class="col-4"></div>
            <div class="col-4">
            </div>
        </div>
        <div class="row pt-5">
            <div class="col-4">
                <h3>Odaberi dan i evidentiraj promet:</h3>
                <form action="{{ route('requestedDay') }}" method="get">
                    <label for="date">Odaberi datum</label>
                    <input type="date" name="date" value="{{ date('d.m.Y') }}" class="form-control" id="date" required>
                    <button class="btn btn-secondary form-control mt-2">Posalji</button>
                </form>
                <br>
                <div class="row">
                    <div class="col-6">
                        <a href="/view-monthly-turnover/{{ $id = 1 }}" class="btn btn-primary form-control mt-2">Januar <span>{{ \App\Models\Daily_turnover::whereMonth('created_at', 1)->sum('total') }}</span></a>
                        <a href="/view-monthly-turnover/{{ $id = 2 }}" class="btn btn-primary form-control mt-2">Februar <span>{{ \App\Models\Daily_turnover::whereMonth('created_at', 2)->sum('total') }}</span></a>
                        <a href="/view-monthly-turnover/{{ $id = 3 }}" class="btn btn-primary form-control mt-2">Mart <span>{{ \App\Models\Daily_turnover::whereMonth('created_at', 3)->sum('total') }}</span></a>
                        <a href="/view-monthly-turnover/{{ $id = 4 }}" class="btn btn-primary form-control mt-2">April <span>{{ \App\Models\Daily_turnover::whereMonth('created_at', 4)->sum('total') }}</span></a>
                        <a href="/view-monthly-turnover/{{ $id = 5 }}" class="btn btn-primary form-control mt-2">Maj <span>{{ \App\Models\Daily_turnover::whereMonth('created_at', 5)->sum('total') }}</span></a>
                        <a href="/view-monthly-turnover/{{ $id = 6 }}" class="btn btn-primary form-control mt-2">Jun <span>{{ \App\Models\Daily_turnover::whereMonth('created_at', 6)->sum('total') }}</span></a>
                    </div>
                    <div class="col-6">
                        <a href="/view-monthly-turnover/{{ $id = 7 }}" class="btn btn-primary form-control mt-2">Jul <span>{{ \App\Models\Daily_turnover::whereMonth('created_at', 7)->sum('total') }}</span></a>
                        <a href="/view-monthly-turnover/{{ $id = 8 }}" class="btn btn-primary form-control mt-2">Avgust <span>{{ \App\Models\Daily_turnover::whereMonth('created_at', 8)->sum('total') }}</span></a>
                        <a href="/view-monthly-turnover/{{ $id = 9 }}" class="btn btn-primary form-control mt-2">Septembar <span>{{ \App\Models\Daily_turnover::whereMonth('created_at', 9)->sum('total') }}</span></a>
                        <a href="/view-monthly-turnover/{{ $id = 10 }}" class="btn btn-primary form-control mt-2">Oktobar <span>{{ \App\Models\Daily_turnover::whereMonth('created_at', 10)->sum('total') }}</span></a>
                        <a href="/view-monthly-turnover/{{ $id = 11 }}" class="btn btn-primary form-control mt-2">Novembar <span>{{ \App\Models\Daily_turnover::whereMonth('created_at', 11)->sum('total') }}</span></a>
                        <a href="/view-monthly-turnover/{{ $id = 12 }}" class="btn btn-primary form-control mt-2">Decembar <span>{{ \App\Models\Daily_turnover::whereMonth('created_at', 12)->sum('total') }}</span></a>
                    </div>
                </div>
            </div>
            <div class="col"></div>
            <div class="col-7">
                @if(isset($monthly_turnovers))
                <table class="table border-warning text-center">
                    <thead>
                    <tr class="table table-secondary border-dark">
                        <th>Datum</th>
                        <th>Ukupan promet</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($monthly_turnovers as $monthly_turnover)
                        <tr>
                            <td><a href="/requested/{{ $monthly_turnover->day }}/day" class="text-decoration-none">{{ Carbon\Carbon::parse($monthly_turnover->day)->format('d. M. Y.') }}</a></td>
                            <td><a href="/requested/{{ $monthly_turnover->day }}/day" class="text-decoration-none">{{ $monthly_turnover->sum }}</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>
@endsection


