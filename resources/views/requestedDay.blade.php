@extends('layouts.app')

@section('content')
    <style>
        #list {
            position: absolute;
            background-color: #f1f2f0;
            width: 450px;
            border-radius: 10px;
            display: none;
        }

        #list li:hover {
            background-color: silver;
            border-radius: 10px;
        }

        #list li {
            display: block;
            padding: 4px;
            cursor: default;
        }

    </style>


    @if(isset($search_date) && isset($search_data))
        <div class="container">
            @if(session()->has('message'))
                <div class="alert alert-success p-2 text-center">
                    {{ session()->get('message') }}
                </div>
            @endif
            <div class="row">
                <div class="col-2">
                    <a href="{{ route('allStock') }}" class="btn btn-secondary form-control m-2">Svi artikli - LAGER</a>
                    <a href="{{ route('turnoverByDays') }}" class="btn btn-secondary form-control m-2">Promet po danima</a>
                </div>
                <div class="col-10">
                    <form action="{{ route('dailyTurnover') }}" method="post" id="form">
                        @csrf
                        <table class="table table-striped-columns table-hover border-warning text-center">
                            <thead>
                            <tr class="table table-secondary border-dark">
                                <th style="width: 20%;">Artikal-Opis artikla</th>
                                <th>Komada</th>
                                <th>Cena</th>
                                <th>Popust</th>
                                <th>Ukupno</th>
                                <th>Opis</th>
                                <th>Materijal</th>
                                <th>Tip ugradnje</th>
                                <th>Snimi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <input type="hidden" name="article_id" class="form-control" id="article_id" readonly>
                                    <input type="text" name="article" class="form-control" id="search"
                                           placeholder="Ukucaj najmanje tri karaktera" autofocus required>
                                    <ul id="list" class="border m-0 p-0" style="display: none"></ul>
                                </td>
                                <td><input type="number" name="pcs" min="1" max="10" class="form-control" id="pcs"
                                           disabled required>
                                    <input type="hidden" name="search_date" value="{{ $search_date }}">
                                </td>
                                <td><input type="number" name="price" class="form-control" id="price" readonly required></td>
                                <td>
                                    <select name="discount" id="discount" class="form-control">
                                        <option value="0">0%</option>
                                        <option value="10">10%</option>
                                        <option value="20">20%</option>
                                        <option value="30">30%</option>
                                        <option value="50">50%</option>
                                        <option value="75">75%</option>
                                        <option value="100">100%</option>
                                    </select>
                                </td>
                                <td><input type="number" name="total" class="form-control" id="total" required readonly></td>
                                <td><input type="text" name="describe" class="form-control" id="describe" readonly required></td>
                                <td><input type="text" name="material" class="form-control" id="material" readonly required></td>
                                <td>
                                    @if(isset($client_id))
                                    <input type="hidden" name="client_id" value="{{ $client_id }}" class="form-control" readonly>
                                    @endif
                                    <input type="text" name="installation_type" class="form-control"
                                           id="installation_type" readonly required></td>
                                <td>
                                    <button type="submit" class="btn btn-secondary form-control" id="save-data">Snimi</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
            <div class="row mt-1">
                 <div class="col-12">
                     @if(request()->has('client_id')) {{--proverava da li u URL-u postoji GET parametar client_id, bez obzira na njegovu vrednost--}}
                     <h5><span class="fw-bold text-danger text-uppercase">Upozorenje!</span><br>
                         Na ovoj stranici ako evidentirate bilo koju robu, posle skidanja sa lagera će biti dodatno povezana sa odabranim kupcem.
                         Za evidentiranje robe bez odabranog kupca idite na dugme iznad ↑ <span class="fw-bold">'Promet po danima'!</span>
                     </h5>
                     @endif
                     @if(session('client'))
                    <h5>Kupac: <a href="{{ route('home.singleClient',['id'=>session('client')->id]) }}" class="text-decoration-none fw-bold">
                            {{ session('client')->name }}</a>, {{ session('client')->date_of_birth }}
                            {{ session('client')->city }}, telefon: {{ session('client')->phone }}</h5>
                     @endif
                 </div>
            </div>

            <div class="row mt-3">
                <div class="col text-start">
                    <h4 style="display: inline-block">{{ Carbon\Carbon::parse($search_date)->format('l j. F Y.') }}</h4>
                </div>
                <div class="col text-center">
                    <h4><a href="{{ route('displayTurnover', ['turnover_by_day'=>$search_date]) }}" class="btn btn-secondary">Uzlazno ↑</a>&nbsp;<a href="{{ route('descendingArticle', ['search_date'=>$search_date]) }}" class="btn btn-secondary">Silazno ↓</a></h4>
                </div>
                <div class="col text-end">
                    <h4 style="display:inline-block; float: right">Ukupno promet: {{ $sum }} dinara</h4>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12 text-center">
                    <table class="table table-striped-columns table-hover border border-warning text-center">
                        <thead>
                        <tr class="table table-secondary border-dark">
                            <th>Id</th>
                            <th>Artikal</th>
                            <th>Komada</th>
                            <th>Cena</th>
                            <th>Popust</th>
                            <th>Ukupno</th>
                            <th>Opis</th>
                            <th>Materijal</th>
                            <th>Tip ugradnje</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(session('from_method') == 'requestedDay' || session('from_method') == 'saveDailyTurnover'
                                                                     || session('from_method') == 'displayTurnover')
                            @foreach($search_data as $data)
                            <tr>
                                    @if(isset($data->client->id))
                                <td>{{ $data->id }}</td>
                                <td><a href="{{ route('clientsShow', ['id'=>$data->client->id]) }}">{{ $data->article }}</a></td>
                                    @endif
                                    @if(empty($data->client->id)) {{-- proveravam da li je null, false, prazan string, 0-kao nula, itd.. --}}
                                <td>{{ $data->id }}</td>
                                <td>{{ $data->article }}</td>
                                    @endif
                                <td>{{ $data->pcs }}</td>
                                <td>{{ $data->price }}</td>
                                <td>{{ $data->discount }}</td>
                                <td>{{ $data->total }}</td>
                                <td>{{ $data->describe }}</td>
                                <td>{{ $data->material }}</td>
                                <td>{{ $data->installation_type }}</td>
                            @if(request()->has('client_id'))
                                <td><a href="{{ route('updateBeforeDelete', ['id'=>$data->id, 'stock_id'=>$data->stock_id, 'search_date'=>$search_date, 'sum'=>$sum,
                                              'client_id' => request('client_id')]) }}" {{--// Dodavanje client_id iz URL-a --}}
                                              class="btn btn-sm btn-warning" onclick="return confirm('Da li ste sigurni?')">Obrisi
                                    </a>
                                </td>
                            @endif
                            @if(!request()->has('client_id'))
                                 <td><a href="{{ route('updateBeforeDelete', ['id'=>$data->id, 'stock_id'=>$data->stock_id, 'search_date'=>$search_date, 'sum'=>$sum]) }}"
                                                 class="btn btn-sm btn-warning" onclick="return confirm('Da li ste sigurni?')">Obrisi
                                     </a>
                                 </td>
                            @endif
                            </tr>
                            @endforeach {{-- iznad ↑ 'id - asc' --}}
                        @endif {{-- session('from_method') == 'requestedDay' --}}

                        @if(session('from_method') == 'descendingArticle')
                            @foreach($search_data as $data)
                                <tr>
                                    @if(isset($data->client->id))
                                        <td>{{ $data->id }}</td>
                                        <td><a href="{{ route('clientsShow', ['id'=>$data->client->id]) }}">{{ $data->article }}</a></td>
                                    @endif
                                    @if(empty($data->client->id)) {{-- proveravam da li je null, false, prazan string, 0-kao nula, itd.. --}}
                                    <td>{{ $data->id }}</td>
                                    <td>{{ $data->article }}</td>
                                    @endif
                                    <td>{{ $data->pcs }}</td>
                                    <td>{{ $data->price }}</td>
                                    <td>{{ $data->discount }}</td>
                                    <td>{{ $data->total }}</td>
                                    <td>{{ $data->describe }}</td>
                                    <td>{{ $data->material }}</td>
                                    <td>{{ $data->installation_type }}</td>
                                    @if(request()->has('client_id'))
                                        <td><a href="{{ route('updateBeforeDelete', ['id'=>$data->id, 'stock_id'=>$data->stock_id, 'search_date'=>$search_date, 'sum'=>$sum,
                                              'client_id' => request('client_id')]) }}" {{--// Dodavanje client_id iz URL-a --}}
                                            class="btn btn-sm btn-warning" onclick="return confirm('Da li ste sigurni?')">Obrisi
                                            </a>
                                        </td>
                                    @endif
                                    @if(!request()->has('client_id'))
                                        <td><a href="{{ route('updateBeforeDelete', ['id'=>$data->id, 'stock_id'=>$data->stock_id, 'search_date'=>$search_date, 'sum'=>$sum]) }}"
                                               class="btn btn-sm btn-warning" onclick="return confirm('Da li ste sigurni?')">Obrisi
                                            </a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach {{-- iznad ↑ 'id - desc'  --}}
                        @endif {{-- session('from_method') == 'descendingArticle' --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif

    <script>
        function writeDataInList(array) {
            document.getElementById('list').innerHTML = "";
            if (array.length === 0) {
                document.getElementById('list').style.display = 'none';
            } else {
                document.getElementById('list').style.display = 'block';
                document.getElementById('pcs').disabled = false;
            }
            for (let i = 0; i < array.length; i++) {
                document.getElementById('list').innerHTML += '<li data-article_id = "' + array[i].id + '" data-article = "' + array[i].article + '" data-describe = "' + array[i].describe + '" data-material = "' + array[i].material + '" data-installation_type = "' + array[i].installation_type + '" data-selling_price = "' + array[i].selling_price + '">' + array[i].article + ' , ' + array[i].describe + ' , '
                    + array[i].material + ' , ' + array[i].installation_type + ' , ' + array[i].selling_price + ' din. ' + array[i].quantity + 'kom.' + "</li>";
            }
            let suggestions = document.querySelectorAll('#list li');
            for (let i = 0; i < suggestions.length; i++) {
                suggestions[i].addEventListener('click', function () {
                    writeDataInList([]);
                    // u hidden polje upisujem article_id
                    let articleId = suggestions[i].dataset.article_id;
                    document.getElementById('article_id').value = articleId;

                    let articleName = suggestions[i].dataset.article;
                    document.getElementById('search').value = articleName;

                    let describe = suggestions[i].dataset.describe;
                    document.getElementById('describe').value = describe;

                    let material = suggestions[i].dataset.material;
                    document.getElementById('material').value = material;

                    let installationType = suggestions[i].dataset.installation_type;
                    document.getElementById('installation_type').value = installationType;
                    // u polje #price upisujem selling_price
                    let sellingPrice = suggestions[i].dataset.selling_price;
                    document.getElementById('price').value = sellingPrice;
                });
            }
            var pcs = document.getElementById('pcs');
            var price = document.getElementById('price');
            var total = document.getElementById('total');
            var discount = document.getElementById('discount');
            pcs.addEventListener('change', function () {
                //let pcs = document.getElementById('pcs');
                if (pcs.value && price.value) {
                    total.value = (pcs.value * price.value) - (discount.value / 100) * (pcs.value * price.value);
                }
                if (pcs.value === '') {
                    total.value = '';
                }
            });
            pcs.addEventListener('keyup', function () {
                //let pcs = document.getElementById('pcs');
                if (pcs.value && price.value) {
                    total.value = (pcs.value * price.value) - (discount.value / 100) * (pcs.value * price.value);
                }
                if (pcs.value === '') {
                    total.value = '';
                }
            });

            discount.addEventListener('change', function () {
                if (discount.value && pcs.value && price.value) {
                    total.value = (pcs.value * price.value) - (discount.value / 100) * (pcs.value * price.value);
                }
                if (pcs.value === '') {
                    total.value = '';
                }
            });




        }

        let timeoutId;

        async function fetchData(input) {
            console.log(input);
            // Proveravamo dužinu unosa pre dohvatanja podataka
            if (input.length >= 3) {
                try {
                    const response = await fetch('/api/stock/' + input);
                    const data = await response.json();
                    writeDataInList(data);
                } catch (error) {
                    // Obrada greške prilikom dohvatanja podataka
                    console.error(error);
                }
            }
        }

        function handleInput(input) {
            // Pre svakog novog unosa, poništavamo prethodni timeout
            clearTimeout(timeoutId);

            if (input.length >= 3) {
                // Postavljamo novi timeout koji će se izvršiti nakon 500ms
                timeoutId = setTimeout(() => {
                    // Pozivamo funkciju za hvatanje podataka
                    fetchData(input);
                }, 500);
            }
        }

        // Pratimo promene u unosu
        const inputElement = document.getElementById("search");

        inputElement.addEventListener("input", (event) => {
            const input = event.target.value;
            handleInput(input);
        });

    </script>

@endsection
