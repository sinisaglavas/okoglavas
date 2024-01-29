@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">
                <a href="{{ route('allStock') }}" class="btn btn-secondary form-control m-2">Svi artikli - LAGER</a>
            </div>
            <div class="col-9">
                <div class="row">
                    <div class="col-2"><a href="/view-monthly-turnover/{{ $id = 1 }}"
                                          class="btn btn-primary form-control mt-2">Jan
                            <span>{{ \App\Models\Daily_turnover::whereMonth('created_at', 1)->sum('total') }}</span></a>
                    </div>

                    <div class="col-2"><a href="/view-monthly-turnover/{{ $id = 2 }}"
                                          class="btn btn-primary form-control mt-2">Feb
                            <span>{{ \App\Models\Daily_turnover::whereMonth('created_at', 2)->sum('total') }}</span></a>
                    </div>
                    <div class="col-2"><a href="/view-monthly-turnover/{{ $id = 3 }}"
                                          class="btn btn-primary form-control mt-2">Mar
                            <span>{{ \App\Models\Daily_turnover::whereMonth('created_at', 3)->sum('total') }}</span></a>
                    </div>
                    <div class="col-2"><a href="/view-monthly-turnover/{{ $id = 4 }}"
                                          class="btn btn-primary form-control mt-2">Apr
                            <span>{{ \App\Models\Daily_turnover::whereMonth('created_at', 4)->sum('total') }}</span></a>
                    </div>
                    <div class="col-2"><a href="/view-monthly-turnover/{{ $id = 5 }}"
                                          class="btn btn-primary form-control mt-2">Maj
                            <span>{{ \App\Models\Daily_turnover::whereMonth('created_at', 5)->sum('total') }}</span></a>
                    </div>
                    <div class="col-2"><a href="/view-monthly-turnover/{{ $id = 6 }}"
                                          class="btn btn-primary form-control mt-2">Jun
                            <span>{{ \App\Models\Daily_turnover::whereMonth('created_at', 6)->sum('total') }}</span></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2"><a href="/view-monthly-turnover/{{ $id = 7 }}"
                                          class="btn btn-primary form-control mt-2">Jul
                            <span>{{ \App\Models\Daily_turnover::whereMonth('created_at', 7)->sum('total') }}</span></a>
                    </div>
                    <div class="col-2"><a href="/view-monthly-turnover/{{ $id = 8 }}"
                                          class="btn btn-primary form-control mt-2">Avg
                            <span>{{ \App\Models\Daily_turnover::whereMonth('created_at', 8)->sum('total') }}</span></a>
                    </div>
                    <div class="col-2"><a href="/view-monthly-turnover/{{ $id = 9 }}"
                                          class="btn btn-primary form-control mt-2">Sep
                            <span>{{ \App\Models\Daily_turnover::whereMonth('created_at', 9)->sum('total') }}</span></a>
                    </div>
                    <div class="col-2"><a href="/view-monthly-turnover/{{ $id = 10 }}"
                                          class="btn btn-primary form-control mt-2">Okt
                            <span>{{ \App\Models\Daily_turnover::whereMonth('created_at', 10)->sum('total') }}</span></a>
                    </div>
                    <div class="col-2"><a href="/view-monthly-turnover/{{ $id = 11 }}"
                                          class="btn btn-primary form-control mt-2">Nov
                            <span>{{ \App\Models\Daily_turnover::whereMonth('created_at', 11)->sum('total') }}</span></a>
                    </div>
                    <div class="col-2"><a href="/view-monthly-turnover/{{ $id = 12 }}"
                                          class="btn btn-primary form-control mt-2">Dec
                            <span>{{ \App\Models\Daily_turnover::whereMonth('created_at', 12)->sum('total') }}</span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-3">
                <h4>Evidentiraj promet:</h4>
                <form action="{{ route('requestedDay') }}" method="get">
                    <label for="date">Odaberi datum</label>
                    <input type="date" name="date" value="{{ date('d.m.Y') }}" class="form-control" id="date" required>
                    <button class="btn btn-secondary form-control mt-2">Pošalji</button>
                </form>
                <hr>
                <h4>Ukupan promet za period:</h4>
                <label for="date">Odaberi period za računanje - klikni ispod</label>
                <div id="reportrange"
                     style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%; border-radius: 5px">
                    <i class="fa fa-calendar"></i>&nbsp;
                    <span></span> <i class="fa fa-caret-down"></i>
                </div>
                <form id="dateRangeForm" action="{{ route('dateRange') }}" method="POST">
                @csrf
                <!-- Ovde možete dodati druga polja za unos podataka -->
                    <input type="hidden" name="start_date" id="start_date">
                    <input type="hidden" name="end_date" id="end_date">
                    <!-- Dodajte dugme za slanje forme -->
                    <button type="submit" class="btn btn-secondary form-control mt-2">Izračunaj</button>
                </form>
            </div>
            <div class="col-1"></div>
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
                                <td><a href="/requested/{{ $monthly_turnover->day }}/day"
                                       class="text-decoration-none">{{ Carbon\Carbon::parse($monthly_turnover->day)->format('d. M. Y.') }}</a>
                                </td>
                                <td><a href="/requested/{{ $monthly_turnover->day }}/day"
                                       class="text-decoration-none">{{ $monthly_turnover->sum }}</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @elseif(isset($total_turnover))
                    <h4 class="mt-5">Promet za period od {{ $start_date }} do {{ $end_date }} iznosi: <span
                            style="font-weight: bold">{{ $total_turnover }}</span> dinara.</h4>
                @endif
            </div>
        </div>
    </div>



    <script type="text/javascript">
        $(function () {

            var start = moment().subtract(29, 'days');
            var end = moment();

            function cb(start, end) {
                $('#reportrange span').html(start.format('D MMMM, YYYY') + ' - ' + end.format('D MMMM, YYYY'));

                // Postavite vrednosti skrivenih polja sa odabranim datumima
                $('#start_date').val(start.format('YYYY-MM-DD'));
                $('#end_date').val(end.format('YYYY-MM-DD'));
            }


            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Danas': [moment(), moment()],
                    'Juce': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Zadnjih 7 Dana': [moment().subtract(6, 'days'), moment()],
                    'Zadnjih 30 Dana': [moment().subtract(29, 'days'), moment()],
                    'Ovaj mesec': [moment().startOf('month'), moment()],
                    'Zadnji mesec': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb);

            cb(start, end);

        });
    </script>
@endsection


