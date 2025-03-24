@extends('layouts.app')

@section('content')
    <style>
        .pagination .page-link {
            color: black !important; /* Boja brojeva */
        }

        .pagination .page-item.active .page-link {
            background-color: #ffc107 !important; /* Boja aktivne stranice */
            border-color: #ffc107 !important;
            color: white !important;
        }

        .pagination .page-item.disabled .page-link {
            color: grey !important; /* Boja disable-ovanih linkova */
        }

    </style>
    @php
        use Illuminate\Support\Str;
        $currentUrl = URL::current(); // red 84
    @endphp
    <div class="container">
        <div class="row mb-4">
            <div class="col">
                <a href="{{ route('turnoverByDays') }}" class="btn btn-secondary form-control m-2">Promet po danima</a>
            </div>
            <div class="col">
                <a href="{{ route('showStockForm') }}" class="btn btn-secondary form-control m-2">Novi artikal</a>
            </div>
            <div class="col">
                <button class="btn btn-warning form-control m-2">Ukupno na lageru: <span class="fw-bold">{{ $total }} dinara</span>
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col">
                        <a href="{{ route('home.stockContactLenses') }}" class="btn btn-outline-secondary form-control">KS: <span class="fw-bold">{{ $cl_sum }} kom.</span></a>
                    </div>
                    <div class="col">
                        <a href="{{ route('home.stockGlasses') }}" class="btn btn-outline-secondary form-control">Ramovi: <span class="fw-bold">{{ $glasses_sum }} kom.</span></a>
                    </div>
                    <div class="col">
                        <a href="{{ route('home.stockSunglasses') }}" class="btn btn-outline-secondary form-control">Sunčane naočare: <span class="fw-bold">{{ $sunglasses_sum }} kom.</span></a>
                    </div>
                    <div class="col">
                        <a href="{{ route('home.stockDioptricLenses') }}" class="btn btn-outline-secondary form-control">Diop. Sočiva: <span class="fw-bold">{{ $dl_sum }} kom.</span></a>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col">
                        @if(session('attention'))
                            <div class="alert alert-warning text-dark fw-bold p-2 m-0 flash-message">
                                {{ session('attention') }}
                            </div>
                            <form style="display: none;" class="searchForm" action="{{route('searchStockBarcode')}}" method="POST">
                                @csrf
                                <div class="input-group">
                                    <input type="submit" class="btn btn-outline-secondary" value="Traži">
                                    <input type="number" min="1000000000" max="9999999999999" name="barcode" value="{{ session('search_barcode') }}"
                                           class="form-control"
                                           placeholder="Skeniraj ceo bar kod i pronađi"
                                           aria-label="Search client" required autofocus>
                                </div>
                            </form>
                        @else
                            <form action="{{route('searchStockBarcode')}}" method="POST">
                                @csrf
                                <div class="input-group">
                                    <input type="submit" class="btn btn-outline-secondary" value="Traži">
                                    <input type="number" min="1000000000" max="9999999999999" name="barcode" value="{{ session('search_barcode') }}"
                                           class="form-control"
                                           placeholder="Skeniraj ceo bar kod i pronađi"
                                           aria-label="Search client" required autofocus>
                                </div>
                            </form>
                        @endif
                    </div>
                    <div class="col-4">
                        @if(Str::contains($currentUrl, 'all-stock') || session('warning') || session('attention'))
                            <h2 class="text-center fw-bold">L A G E R</h2>
                        @else
                            <h2 class="text-center text-uppercase">Rezultat pretrage:</h2>
                        @endif
                    @php session()->forget('attention'); @endphp <!-- Briše poruku iz sesije odmah nakon prikaza -->
                    @php session()->forget('warning'); @endphp <!-- Briše poruku iz sesije odmah nakon prikaza -->
                    </div>
                    <div class="col">
                        @if(session('warning'))
                            <div class="alert alert-warning text-dark fw-bold p-2 m-0 flash-message">
                                {{ session('warning') }}
                            </div>
                            <form style="display: none;" class="searchForm" action="{{route('searchStock')}}" method="POST">
                                @csrf
                                <div class="input-group">
                                    <input type="text" name="article" value="{{ session('search_article') }}" class="form-control"
                                           placeholder="Pronađi po artiklu ili po opisu ili po prodajnoj ceni"
                                           aria-label="Search client" required>
                                    <input type="submit" class="btn btn-outline-secondary" value="Traži">
                                </div>
                            </form>
                        @else
                            <form action="{{route('searchStock')}}" method="POST">
                                @csrf
                                <div class="input-group">
                                    <input type="text" name="article" value="{{ session('search_article') }}" class="form-control"
                                           placeholder="Pronađi po artiklu ili po opisu ili po prodajnoj ceni"
                                           aria-label="Search client" required>
                                    <input type="submit" class="btn btn-outline-secondary" value="Traži">
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
                <br>
                <div class="row justify-content-between">
                    <div class="col-6">{{ $stocks->links('pagination::bootstrap-4') }}</div>
                    <div class="col-2"><a href="{{ route('allStock') }}" class="btn btn-secondary form-control m-2">Vrati na LAGER</a></div>
                </div>
                <table class="table table-striped-columns table-hover border-warning text-center">
                    <thead>
                    <tr class="table table-secondary border-dark">
                        <th>Id</th>
                        <th>Artikal</th>
                        <th>Tip</th>
                        <th>Opis artikla</th>
                        <th>Bar kod</th>
                        <th>Materijal</th>
                        <th>Tip ugradnje</th>
                        <th>Nabavna cena</th>
                        <th>Prodajna cena</th>
                        <th>Količina</th>
                        <th>Ukupna vrednost</th>
                        <th>Kreirano</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($stocks as $stock)
                        <tr>
                            <td>{{ $stock->id }}</td>
                            <td>{{ $stock->article }}</a></td>
                            <td>{{ $stock->item_type }}</td>
                            <td>{{ $stock->describe }}</td>
                            <td>{{ $stock->barcode }}</td>
                            <td>{{ $stock->material }}</td>
                            <td>{{ $stock->installation_type }}</td>
                            <td>{{ $stock->purchase_price }}</td>
                            <td>{{ $stock->selling_price }}</td>
                            <td>{{ $stock->quantity }}</td>
                            <td>{{ $stock->selling_price * $stock->quantity }}</td>
                            <td>{{ $stock->	created_at->format('d.m.Y.') }}</td>
                            <td style="background: #babbbc;"><a href="{{ route('editStock',['id'=>$stock->id]) }}"
                                                                class="text-decoration-none" style="color: black;">Promeni</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $stocks->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>

    <script>
        setTimeout(function() {
            let flashMessages = document.querySelectorAll('.flash-message');
            flashMessages.forEach(flashMessage => {
                flashMessage.style.transition = "opacity 0.5s ease-out";
                flashMessage.style.opacity = "0";
                setTimeout(() => {
                    flashMessage.remove(); // Nakon fade-out efekta, brišemo element

                    let inputSearchForms = document.querySelectorAll('.searchForm'); // Dohvatimo sve forme
                    inputSearchForms.forEach(form => {
                        form.style.display = 'block'; // Prikazujemo svaku formu sa ovom klasom
                    });
                }, 500); // 500ms = trajanje animacije
            });
        }, 2000); // 2000ms = 2 sekunde, kada će poruka početi da nestaje
    </script>




@endsection

