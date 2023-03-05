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
{{--    @if(isset($turnover_by_day) && isset($the_data) && isset($sum))--}}
{{--    <div class="container">--}}
{{--        @if(session()->has('message'))--}}
{{--            <div class="alert alert-success p-2 text-center">--}}
{{--                {{ session()->get('message') }}--}}
{{--            </div>--}}
{{--        @endif--}}
{{--        <div class="row mb-4">--}}
{{--            <div class="col-4">--}}

{{--            </div>--}}
{{--            <div class="col-4"></div>--}}
{{--            <div class="col-4">--}}

{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="row">--}}
{{--            <div class="col-2">--}}
{{--                <div class="row">--}}
{{--                    <div class="col">--}}
{{--                        <a href="{{ route('allStock') }}" class="btn btn-secondary form-control m-2">Svi artikli - LAGER</a>--}}
{{--                    </div>--}}
{{--                    <div class="col">--}}
{{--                        <a href="{{ route('turnoverByDays') }}" class="btn btn-secondary form-control m-2">Promet po danima</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-10">--}}
{{--                <form action="{{ route('dailyTurnover') }}" method="post" id="form">--}}
{{--                    @csrf--}}
{{--                    <table class="table table-striped-columns table-hover border-warning text-center">--}}
{{--                        <thead>--}}
{{--                        <tr class="table table-secondary border-dark">--}}
{{--                            <th>Artikal</th>--}}
{{--                            <th>Komada</th>--}}
{{--                            <th>Cena</th>--}}
{{--                            <th>Ukupno</th>--}}
{{--                            <th>Opis</th>--}}
{{--                            <th>Materijal</th>--}}
{{--                            <th>Tip ugradnje</th>--}}
{{--                            <th>Snimi</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        <tr>--}}
{{--                            <td>--}}
{{--                                <input type="hidden" name="article_id" class="form-control" id="article_id" readonly>--}}
{{--                                <input type="text" name="article" class="form-control" id="search" placeholder="Unesi slova" required>--}}
{{--                                <ul id="list" class="border m-0 p-0" style="display: none"></ul>--}}
{{--                            </td>--}}
{{--                            <td><input type="number" name="pcs" min="1" max="10" class="form-control" id="pcs" required></td>--}}
{{--                            <td><input type="number" name="price" class="form-control" id="price" readonly required></td>--}}
{{--                            <td><input type="number" name="total" class="form-control" id="total" readonly required></td>--}}
{{--                            <td><input type="text" name="describe" class="form-control" id="describe" readonly required></td>--}}
{{--                            <td><input type="text" name="material" class="form-control" id="material" readonly required></td>--}}
{{--                            <td><input type="text" name="installation_type" class="form-control" id="installation_type" readonly required></td>--}}
{{--                            <td><button class="btn btn-secondary form-control mt-2" id="save-data">Snimi</button></td>--}}
{{--                        </tr>--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="row mt-5">--}}
{{--            <div class="col-12">--}}
{{--                <h4 style="display: inline-block">{{ Carbon\Carbon::parse($turnover_by_day)->format('l j. F Y.') }}</h4>--}}
{{--                <h4 style="display:inline-block; float: right">Ukupno promet: {{ $sum }}</h4>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="row mt-2">--}}
{{--            <div class="col-12 text-center">--}}
{{--                <table class="table table-striped-columns table-hover border-warning text-center">--}}
{{--                    <thead>--}}
{{--                    <tr class="table table-secondary border-dark">--}}
{{--                        <th>Artikal</th>--}}
{{--                        <th>Komada</th>--}}
{{--                        <th>Cena</th>--}}
{{--                        <th>Ukupno</th>--}}
{{--                        <th>Opis</th>--}}
{{--                        <th>Materijal</th>--}}
{{--                        <th>Tip ugradnje</th>--}}
{{--                        <th></th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                    @foreach($the_data as $data)--}}
{{--                        <tr>--}}
{{--                            <td>{{ $data->article }}</td>--}}
{{--                            <td>{{ $data->pcs }}</td>--}}
{{--                            <td>{{ $data->price }}</td>--}}
{{--                            <td>{{ $data->total }}</td>--}}
{{--                            <td>{{ $data->describe }}</td>--}}
{{--                            <td>{{ $data->material }}</td>--}}
{{--                            <td>{{ $data->installation_type }}</td>--}}
{{--                            <td><a href="{{ route('updateBeforeDelete', ['id'=>$data->id, 'stock_id'=>$data->stock_id]) }}" class="btn btn-sm btn-warning"--}}
{{--                                   onclick="return confirm('Da li ste sigurni?')">Obrisi</a>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                    @endforeach--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    @endif--}}


    @if(isset($search_date) && isset($search_data))
    <div class="container">
        @if(session()->has('message'))
            <div class="alert alert-success p-2 text-center">
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="row mb-4">
            <div class="col-4">

            </div>
            <div class="col-4"></div>
            <div class="col-4">

            </div>
        </div>
        <div class="row">
            <div class="col-2">
                <div class="row">
                    <div class="col">
                        <a href="{{ route('allStock') }}" class="btn btn-secondary form-control m-2">Svi artikli - LAGER</a>
                    </div>
                    <div class="col">
                        <a href="{{ route('turnoverByDays') }}" class="btn btn-secondary form-control m-2">Promet po danima</a>
                    </div>
                </div>
            </div>
            <div class="col-10">
                <form action="{{ route('dailyTurnover') }}" method="post" id="form">
                    @csrf
                    <table class="table table-striped-columns table-hover border-warning text-center">
                        <thead>
                        <tr class="table table-secondary border-dark">
                            <th>Artikal</th>
                            <th>Komada</th>
                            <th>Cena</th>
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
                                <input type="text" name="article" class="form-control" id="search" placeholder="Artikal ili opis artikla" required>
                                <ul id="list" class="border m-0 p-0" style="display: none"></ul>
                            </td>
                            <td><input type="number" name="pcs" min="1" max="10" class="form-control" id="pcs" required>
                                <input type="hidden" name="search_date" value="{{ $search_date }}">
                            </td>
                            <td><input type="number" name="price" class="form-control" id="price" readonly required></td>
                            <td><input type="number" name="total" class="form-control" id="total" required></td>
                            <td><input type="text" name="describe" class="form-control" id="describe" readonly required></td>
                            <td><input type="text" name="material" class="form-control" id="material" readonly required></td>
                            <td><input type="text" name="installation_type" class="form-control" id="installation_type" readonly required></td>
                            <td><button type="submit" class="btn btn-secondary form-control mt-2" id="save-data">Snimi</button></td>
                        </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12">
                <h4 style="display: inline-block">{{ Carbon\Carbon::parse($search_date)->format('l j. F Y.') }}</h4>
                <h4 style="display:inline-block; float: right">Ukupno promet: {{ $sum }} dinara</h4>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12 text-center">
                <table class="table table-striped-columns table-hover border-warning text-center">
                    <thead>
                    <tr class="table table-secondary border-dark">
                        <th>Artikal</th>
                        <th>Komada</th>
                        <th>Cena</th>
                        <th>Ukupno</th>
                        <th>Opis</th>
                        <th>Materijal</th>
                        <th>Tip ugradnje</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($search_data as $data)
                        <tr>
                            <td>{{ $data->article }}</td>
                            <td>{{ $data->pcs }}</td>
                            <td>{{ $data->price }}</td>
                            <td>{{ $data->total }}</td>
                            <td>{{ $data->describe }}</td>
                            <td>{{ $data->material }}</td>
                            <td>{{ $data->installation_type }}</td>
                            <td><a href="{{ route('updateBeforeDelete', ['id'=>$data->id, 'stock_id'=>$data->stock_id, 'search_date'=>$search_date, 'sum'=>$sum]) }}" class="btn btn-sm btn-warning"
                                   onclick="return confirm('Da li ste sigurni?')">Obrisi</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif


    <script>

        function createInputData(){
            const tr = document.createElement('tr');
            tr.id = 'append-child';
            document.querySelector('tbody').appendChild(tr);

            const td1 = document.createElement('td');
            const input1 = document.createElement('input');
            input1.type = 'hidden';
            input1.name = 'article_id';
            input1.className = 'form-control';
            input1.id = 'article_id';
            input1.readOnly = true;
            td1.appendChild(input1);

            const input2 = document.createElement('input');
            input2.type = 'text';
            input2.name = 'article';
            input2.className = 'form-control';
            input2.id = 'search';
            input2.placeholder = 'Unesi slova';
            input2.required = true;
            td1.appendChild(input2);

            const ul = document.createElement('ul');
            ul.id = 'list';
            ul.className = 'border m-0 p-0';
            td1.appendChild(ul);
            tr.appendChild(td1);

            const td2 = document.createElement('td');
            const input3 = document.createElement('input');
            input3.type = 'number';
            input3.name = 'pcs';
            input3.min = '1';
            input3.max = '10';
            input3.className = 'form-control';
            input3.id = 'pcs';
            input3.required = true;
            td2.appendChild(input3);
            tr.appendChild(td2);

            const td3 = document.createElement('td');
            const input4 = document.createElement('input');
            input4.type = 'number';
            input4.name = 'price';
            input4.className = 'form-control';
            input4.id = 'price';
            input4.readOnly = true;
            input4.required = true;
            td3.appendChild(input4);
            tr.appendChild(td3);

            const td4 = document.createElement('td');
            const input5 = document.createElement('input');
            input5.type = 'number';
            input5.name = 'total';
            input5.className = 'form-control';
            input5.id = 'total';
            input5.readOnly = true;
            input5.required = true;
            td4.appendChild(input5);
            tr.appendChild(td4);

            const td5 = document.createElement('td');
            const input6 = document.createElement('input');
            input6.type = 'text';
            input6.name = 'describe';
            input6.className = 'form-control';
            input6.id = 'describe';
            input6.readOnly = true;
            input6.required = true;
            td5.appendChild(input6);
            tr.appendChild(td5);

            const td6 = document.createElement('td');
            const input7 = document.createElement('input');
            input7.type = 'text';
            input7.name = 'material';
            input7.className = 'form-control';
            input7.id = 'material';
            input7.readOnly = true;
            input7.required = true;
            td6.appendChild(input7);
            tr.appendChild(td6);

            const td7 = document.createElement('td');
            const input8 = document.createElement('input');
            input8.type = 'text';
            input8.name = 'installation_type';
            input8.className = 'form-control';
            input8.id = 'installation_type';
            input8.readOnly = true;
            input8.required = true;
            td7.appendChild(input8);
            tr.appendChild(td7);

            const td8 = document.createElement('td');
            const button = document.createElement('button');
            button.className = 'btn btn-warning form-control mt-2';
            button.id = 'save-data';
            button.appendChild(document.createTextNode('Snimi'));
            td8.appendChild(button);
            tr.appendChild(td8);
        }



        function writeDataInList(array) {
            document.getElementById('list').innerHTML = "";
            if (array.length === 0) {
                document.getElementById('list').style.display = 'none';
            } else {
                document.getElementById('list').style.display = 'block';
            }
            for (let i = 0; i < array.length; i++) {
                document.getElementById('list').innerHTML += '<li data-article_id = "' + array[i].id + '" data-article = "' + array[i].article + '" data-describe = "' + array[i].describe + '" data-material = "' + array[i].material + '" data-installation_type = "' + array[i].installation_type + '" data-selling_price = "' + array[i].selling_price + '">' + array[i].article + ' , ' + array[i].describe + ' , '
                    + array[i].material + ' , ' + array[i].installation_type + ' , ' + array[i].selling_price + ' din. ' +  array[i].quantity + 'kom.' + "</li>";
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
            let pcs = document.getElementById('pcs');
            pcs.addEventListener('change', function () {
                //let pcs = document.getElementById('pcs');
                let price = document.getElementById('price');
                let total = document.getElementById('total');
                if (pcs.value && price.value) {
                    total.value = pcs.value * price.value;
                }
                if (pcs.value === '') {
                    total.value = '';
                }
            })
        }



        window.addEventListener('load', function () {
            fetch('/api/stock')
                .then(res => res.json())
                .then(data => {
                    // ovde se obradjuje uspesno dobijen odgovor sa api rute
                    //   console.log(data);
                    writeDataInList(data);
                })
            document.getElementById('search').addEventListener('keyup', function (event) {
                let query = document.getElementById('search').value;
                fetch('/api/stock/' + query)
                    .then(res => res.json())
                    .then(data => {
                        writeDataInList(data);
                    });
            });
           // const pcs = document.getElementById('pcs').value;
            // if (pcs) {
            //     document.getElementById('save-data').addEventListener('click', function (){
            //         createInputData()
            //     });
            // }


        });

    </script>

@endsection
