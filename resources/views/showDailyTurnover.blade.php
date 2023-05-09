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

    <div class="container">
        <div class="row mb-4">
            <div class="col-4">
                <a href="{{ route('allStock') }}" class="btn btn-secondary form-control m-2">Svi artikli - LAGER</a>
            </div>
            <div class="col-4"></div>
            <div class="col-4">
                <a href="{{ route('turnoverByDays') }}" class="btn btn-secondary form-control m-2">Promet po danima</a>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col text-center">
                <h2>Dnevni promet</h2>
            </div>
                <div class="col">
                    <div id="total-per-day" class="text-center"></div>
                </div>
                <div class="col">
                    <div id="total-value-of" class="text-center"></div>
                </div>
        </div>
        <div class="row mt-2">
            <div class="col-3">
                <form action="{{ route('dailyTurnover') }}" method="post" id="form">
                    @csrf
                <div class="row">
                    <div class="col">
                        <label for="describe">Opis</label>
                        <input type="text" name="describe" class="form-control" id="describe" readonly>
                    </div>
                    <div class="col">
                        <label for="material">Materijal</label>
                        <input type="text" name="material" class="form-control" id="material" readonly>
                    </div>
                    <div class="col">
                        <label for="installation_type">Tip ugradnje</label>
                        <input type="text" name="installation_type" class="form-control" id="installation_type" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="hidden" name="article_id" class="form-control" id="article_id" readonly>
                        <label for="search">Artikal</label>
                        <input type="text" name="article" class="form-control" id="search" placeholder="Unesi slova" required>
                        <ul id="list" class="border m-0 p-0"></ul>
                    </div>
                    <div class="col">
                        <div id="repeat">
                            <label for="date">Datum prometa</label>
                            <input type="date" name="date" class="form-control" value="{{ date('d.m.Y') }}"  id="date" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="pcs">Komada</label>
                        <input type="number" name="pcs" min="1" max="10" class="form-control" id="pcs" placeholder="Obavezan unos" required>
                    </div>
                    <div class="col">
                        <label for="price">Cena</label>x
                        <input type="number" name="price" class="form-control" id="price" readonly>
                    </div>
                    <div class="col">
                        <label for="total">Ukupno</label>
                        <input type="number" name="total" class="form-control" id="total" readonly>
                    </div>
                </div>
                    <button class="btn btn-warning form-control mt-2">Snimi</button>
                </form>
                @if(session()->has('message'))
                    <div class="alert alert-success p-2 text-center">
                        {{ session()->get('message') }}
                    </div>
                @endif
            </div>
            <div class="col-5 text-center">
                <table class="table table-striped-columns table-hover border-warning text-center">
                    <thead>
                    <tr class="table table-secondary border-dark">
                        <th>Id</th>
                        <th>Artikal</th>
                        <th>Opis</th>
                        <th>Materijal</th>
                        <th>Tip ugradnje</th>
                        <th>Komada</th>
                        <th>Cena</th>
                        <th>Ukupno</th>
                        <th>Datum</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <div id="p-tag"></div>
            </div>
        </div>
    </div>

    <script>
        const repeat = document.getElementById('repeat');
        repeat.addEventListener('mouseover', function (e){
            if (e.target.classList.contains('repeat-content')) {
                window.location.reload();
            }
        });

        function setDate(arg) {
            let date = new Date(arg);
            let day = date.getDate();
            let month = date.getMonth() + 1;
            let year = date.getFullYear();
            let searchDay = day + '.' + month + '.' + year + '.';
            return searchDay;
        }

        function writeDataInTable(array) {
            let countTotal = 0;
            document.getElementById('date').addEventListener('change', function (){
                let date = document.getElementById('date');
                date.classList.add('repeat-content');

                for (let i = 0; i < array.length; i++) {
                    if (array[i]['date_of_sale'] === date.value) {
                        const tr = document.createElement('tr');
                        tr.id = 'append-child';
                        document.querySelector('tbody').appendChild(tr);

                        const td1 = document.createElement('td');
                        td1.appendChild(document.createTextNode(array[i]['id']));
                        tr.appendChild(td1);

                        const td2 = document.createElement('td');
                        td2.appendChild(document.createTextNode(array[i]['article']));
                        tr.appendChild(td2);

                        const td3 = document.createElement('td');
                        td3.appendChild(document.createTextNode(array[i]['describe']));
                        tr.appendChild(td3);

                        const td4 = document.createElement('td');
                        td4.appendChild(document.createTextNode(array[i]['material']));
                        tr.appendChild(td4);

                        const td5 = document.createElement('td');
                        td5.appendChild(document.createTextNode(array[i]['installation_type']));
                        tr.appendChild(td5);

                        const td6 = document.createElement('td');
                        td6.appendChild(document.createTextNode(array[i]['pcs']));
                        tr.appendChild(td6);

                        const td7 = document.createElement('td');
                        td7.appendChild(document.createTextNode(array[i]['price']));
                        tr.appendChild(td7);

                        const td8 = document.createElement('td');
                        td8.appendChild(document.createTextNode(array[i]['total']));
                        td8.id = 'summary';
                        tr.appendChild(td8);

                        const td9 = document.createElement('td');
                        td9.appendChild(document.createTextNode(array[i]['date_of_sale']));
                        tr.appendChild(td9);

                        countTotal += array[i]['total'];
                    } // izlaz iz uslova
                } // izlaz iz petlje
                const div = document.getElementById('p-tag');
                const pTag = document.querySelector('p'); // ovo je iz JS kreiran p tag - ova linija koda je zbog if u sledecoj liniji koda
                if (pTag) {
                    pTag.remove();
                    const pTag = document.createElement('p');
                    pTag.style.backgroundColor = 'orange';
                    pTag.style.padding = '10px';
                    pTag.style.fontWeight = 'bold';
                    pTag.appendChild(document.createTextNode('Ukupan promet: ' + countTotal + ' dinara'));
                    div.appendChild(pTag);
                } else {
                    const pTag = document.createElement('p');
                    pTag.style.backgroundColor = 'orange';
                    pTag.style.padding = '10px';
                    pTag.style.fontWeight = 'bold';
                    pTag.appendChild(document.createTextNode('Ukupan promet: ' + countTotal + ' dinara'));
                    div.appendChild(pTag);
                }

            });
        }
        function totalPerDay(array){
            document.getElementById('date').addEventListener('change', function () {
                let date = document.getElementById('date');
                const totalPerDay = document.getElementById('per-day');
                const totalValueOf = document.getElementById('value-of');
                for (let i = 0; i < array.length; i++) {
                    if (array[i]['date_of_sale'] === date.value) {
                        if (totalPerDay && totalValueOf) {
                            totalPerDay.remove();
                            totalValueOf.remove();
                            const totalPerDay = document.getElementById('total-per-day');
                            const totalValueOf = document.getElementById('total-value-of');

                            const perDay = document.createElement('h2');
                            perDay.id = 'per-day';
                            perDay.appendChild(document.createTextNode('Promet na dan '+ setDate(date.value)));
                            totalPerDay.appendChild(perDay);

                            const valueOf = document.createElement('h2');
                            valueOf.id = 'value-of';
                            valueOf.appendChild(document.createTextNode(array[i]['sum']+ ' dinara'));
                            totalValueOf.appendChild(valueOf);

                        } else {
                            const totalPerDay = document.getElementById('total-per-day');
                            const totalValueOf = document.getElementById('total-value-of');

                            const perDay = document.createElement('h2');
                            perDay.id = 'per-day';
                            perDay.appendChild(document.createTextNode('Promet na dan '+ setDate(date.value)));
                            totalPerDay.appendChild(perDay);

                            const valueOf = document.createElement('h2');
                            valueOf.id = 'value-of';
                            valueOf.appendChild(document.createTextNode(array[i]['sum']+ ' dinara'));
                            totalValueOf.appendChild(valueOf);
                        }
                    }
                }
            });
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
                    + array[i].material + ' , ' + array[i].installation_type + ' , ' + array[i].selling_price + ' din.' + "</li>";
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
        });
        window.addEventListener('load', function () {
            fetch('{{ route('dailyTurnover') }}')
                .then(res => res.json())
                .then(data => {
                    writeDataInTable(data);
                })
            document.getElementById('date').addEventListener('change', function () {

            });
        });
        window.addEventListener('load', function () {
            fetch('{{ route('totalPerDay') }}')
                .then(res => res.json())
                .then(data => {
                    totalPerDay(data);
                })

        });

    </script>
@endsection


