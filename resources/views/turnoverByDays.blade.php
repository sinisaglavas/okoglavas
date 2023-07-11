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
            </div>
            <div class="col"></div>
            <div class="col-7">
                <table class="table border-warning text-center">
                    <thead>
                    <tr class="table table-secondary border-dark">
                        <th>Datum</th>
                        <th>Ukupan promet</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($turnover_by_days as $turnover_by_day)
                        <tr>
                            <td><a href="/requested/{{ $turnover_by_day->created_at }}/day" class="text-decoration-none">{{ Carbon\Carbon::parse($turnover_by_day->created_at)->format('d. M. Y.') }}</a></td>
                            <td><a href="/requested/{{ $turnover_by_day->created_at }}/day" class="text-decoration-none">{{ $turnover_by_day->sum }}</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


