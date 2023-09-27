@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-5">
                <a href="{{ route('allStock') }}" class="btn btn-secondary form-control m-2">Svi artikli - LAGER</a>
                <h5 class="m-3">Pronađi artikle ako postoje na Lageru:</h5>
                    <table class="table table-bordered" id="table">
                        <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Artikal</th>
                            <th scope="col">Vrsta art.</th>
                            <th scope="col">Opis</th>
                            <th scope="col">Mater.</th>
                            <th scope="col">Tip ugr.</th>
                            <th scope="col">Prod.cena</th>
                            <th scope="col">Na lageru</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr id="trElement">
                            {{-- JS --}}
                        </tr>
                        </tbody>
                    </table>
            </div>
            <div class="col-1"></div>
            <div class="col-6">
                <h2>Novi Artikal</h2>
                <form action="{{ route('saveStock') }}" method="POST">
                    @csrf
                        <label for="article">Artikal</label>
                        <input type="text" name="article" id="article" placeholder="Unos je obavezan - uneti najmanje tri karaktera za proveru lagera"
                               class="form-control" required>
                    <div class="row mt-3">
                        <div class="text-center"><h5>Vrsta artikla (obavezan unos):</h5></div>
                        <div class="col-3 mt-4">
                            <input type="radio" id="cl" name="item_type" value="KS" style="transform: scale(2)"
                                   required>
                              <label for="cl" style="color: firebrick; font-weight: bold">Kontak. sočivo</label>
                        </div>
                        <div class="col-3 mt-4">
                            <input type="radio" id="glasses" name="item_type" value="Ram" style="transform: scale(2)"
                                   required>
                              <label for="glasses">Dioptr. ram</label>
                        </div>
                        <div class="col-3 mt-4">
                            <input type="radio" id="dl" name="item_type" value="DS" style="transform: scale(2)"
                                   required>
                              <label for="dl" style="color: blue; font-weight: bold" >Dioptr.sočivo</label>
                        </div>
                        <div class="col-3 mt-4">
                            <input type="radio" id="other" name="item_type" value="Ostalo" style="transform: scale(2)"
                                   required>
                              <label for="other">Ostalo</label>
                        </div>
                    </div>
                    <label for="describe" class="mt-1">Opis artikla</label>
                    <input type="text" name="describe" id="describe" placeholder="Na primer: naziv rama..."
                           class="form-control mb-3">
                    <div class="row mb-3">
                        <div class="text-center pb-3"><h5>Materijal:</h5></div>
                        <div class="col-1"></div>
                        <div class="col">
                            <input type="radio" id="metal" name="material" value="Metal" style="transform: scale(2)">
                              <label for="metal">Metal</label>
                        </div>
                        <div class="col">
                            <input type="radio" id="metal_plastic" name="material" value="Metal/Plastika"
                                   style="transform: scale(2)">
                              <label for="metal_plastic">Metal/Plastika</label>
                        </div>
                        <div class="col">
                            <input type="radio" id="plastic" name="material" value="Plastika"
                                   style="transform: scale(2)">
                              <label for="plastic">Plastika</label>
                        </div>
                        <div class="col">
                            <input type="radio" id="silicon" name="material" value="Silikon"
                                   style="transform: scale(2)">
                              <label for="silicon">Silikon</label>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="text-center pb-3"><h5>Tip ugradnje:</h5></div>
                        <div class="col-2"></div>
                        <div class="col">
                            <input type="radio" id="full-frame" name="installation_type" value="Pun ram"
                                   style="transform: scale(2)">
                              <label for="full-frame">Pun ram</label>
                        </div>
                        <div class="col">
                            <input type="radio" id="cutter" name="installation_type" value="Frez"
                                   style="transform: scale(2)">
                              <label for="cutter">Frez</label>
                        </div>
                        <div class="col">
                            <input type="radio" id="drilling" name="installation_type" value="Bušenje"
                                   style="transform: scale(2)">
                              <label for="drilling">Bušenje</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="purchase_price">Nabavna cena</label>
                            <input type="text" name="purchase_price" id="purchase_price" class="form-control">
                        </div>
                        <div class="col">
                            <label for="selling_price">Prodajna cena</label>
                            <input type="text" name="selling_price" id="selling_price" placeholder="Unos je obavezan"
                                   class="form-control" required>
                        </div>
                        <div class="col">
                            <label for="quantity">Količina</label>
                            <input type="number" name="quantity" id="quantity" placeholder="Unos je obavezan" min="1"
                                   class="form-control" required>
                        </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary form-control">Snimi</button>
                </form>
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>

        // function displayData(data) {
        //     let tableElement = document.getElementById('table');
        //
        //     // Prvo, obrišite sve postojeće redove iz tabele
        //     while (tableElement.rows.length > 1) {
        //         tableElement.deleteRow(1);
        //     }
        //
        //     for (let i = 0; i < data.length; i++) {
        //         const row = data[i];
        //
        //         let columnsToDisplay = ['id', 'article', 'item_type', 'describe', 'material', 'installation_type', 'selling_price', 'quantity'];
        //
        //         // Kreirajte novi red (<tr>) za svaki podatak
        //         let trElement = tableElement.insertRow(-1); // -1 dodaje novi red na kraj tabele
        //
        //         for (let key of columnsToDisplay) {
        //             if (row.hasOwnProperty(key)) {
        //                 // Kreirajte <td> element za svaku vrednost i postavite ga
        //                 // kao tekstualni sadržaj
        //                 let tdElement = trElement.insertCell(-1); // -1 dodaje novu ćeliju u red
        //                 tdElement.textContent = row[key];
        //             }
        //         }
        //     }
        // }
        function displayData(data) {
            let tableElement = document.getElementById('table');

            // Prvo, obrišite sve postojeće redove iz tabele
            while (tableElement.rows.length > 1) {
                tableElement.deleteRow(1);
            }

            for (let i = 0; i < data.length; i++) {
                const row = data[i];

                let columnsToDisplay = ['id', 'article', 'item_type', 'describe', 'material', 'installation_type', 'selling_price', 'quantity'];

                // Kreirajte novi red (<tr>) za svaki podatak
                let trElement = tableElement.insertRow(-1); // -1 dodaje novi red na kraj tabele

                for (let key of columnsToDisplay) {
                    if (row.hasOwnProperty(key)) {
                        // Kreirajte <td> element za svaku vrednost
                        let tdElement = trElement.insertCell(-1); // -1 dodaje novu ćeliju u red

                        // Ako je ključ 'article', kreirajte <a> element i postavite ga kao tekstualni sadržaj
                        if (key === 'article') {
                            let aElement = document.createElement('a');
                            let editUrl = `/stock/${row['id']}/edit`; // Generišite URL
                            aElement.href = editUrl;
                            aElement.textContent = row[key];

                            // Postavite stilove za centriranje <a> elementa
                            aElement.style.display = 'block';
                            aElement.style.textAlign = 'center';
                            aElement.style.textDecoration = 'none';

                            tdElement.appendChild(aElement);
                        } else {
                            // Inače, postavite tekstualni sadržaj
                            tdElement.textContent = row[key];
                            tdElement.style.textAlign = 'center';
                        }
                    }
                }
            }
        }





        let timeoutId;
        async function fetchData(input) {
            console.log(input);
            // Proveravamo dužinu unosa pre dohvatanja podataka
            if (input.length >= 3) {
                try {
                    const response = await fetch('/api/stock/' + input);
                    const data = await response.json();

                    // Ograničavanje podataka na prvih 10 artikala
                    const firstTenItems = data.slice(0, 10); //radi
                    displayData(firstTenItems);
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
        const article = document.getElementById("article");

        article.addEventListener("input", (event) => {
            const input = event.target.value;
            handleInput(input);
        });

    </script>

@endsection

