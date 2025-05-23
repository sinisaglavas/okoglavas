@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-5">
                <a href="{{ route('allStock') }}" class="btn btn-secondary form-control m-2">Svi artikli - LAGER</a>
                <h5 class="m-3">Pronađi artikle ako postoje na Lageru (max 10 rezultata):</h5>
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
                <div id="noResult">
                    {{-- JS --}}
                </div>
            </div>
            <div class="col-1"></div>
            <div class="col-6">
                <h2>Novi Artikal</h2>
                <form action="{{ route('saveStock') }}" method="POST">
                    @csrf
                    <label for="article">Artikal &nbsp;(Ukoliko želimo pretragu lagera preporuka je uneti po OPISU)</label>
                    <input type="text" name="article" id="article" value="{{ old('article') }}"
                           placeholder="Unos je obavezan - uneti najmanje tri karaktera (po nazivu ili opisu) za proveru lagera"
                           class="form-control" required>
                    <div class="row mt-3 p-1" style="background: #bebebf;">
                        <div class="text-center"><h5>Vrsta artikla (Unos je obavezan):</h5></div>
                        <div class="col-3 mt-3">
                            <input type="radio" id="cl" name="item_type" value="KS" {{ old('item_type') == 'KS' ? 'checked' : '' }} style="transform: scale(2)"
                                   required>
                              <label for="cl" style="color: firebrick; font-weight: bold">Kontak. sočivo</label>
                        </div>
                        <div class="col-3 mt-3">
                            <input type="radio" id="glasses" name="item_type" value="Ram" {{ old('item_type') == 'Ram' ? 'checked' : '' }} style="transform: scale(2)"
                                   required>
                              <label for="glasses">Dioptr. ram</label>
                        </div>
                        <div class="col-3 mt-3">
                            <input type="radio" id="dl" name="item_type" value="DS" {{ old('item_type') == 'DS' ? 'checked' : '' }} style="transform: scale(2)"
                                   required>
                              <label for="dl" style="color: blue; font-weight: bold">Dioptr.sočivo</label>
                        </div>
                        <div class="col-3 mt-3">
                            <input type="radio" id="other" name="item_type" value="Ostalo" {{ old('item_type') == 'Ostalo' ? 'checked' : '' }} style="transform: scale(2)"
                                   required>
                              <label for="other">Ostalo</label>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-6">
                            <label for="describe">Opis artikla</label>
                            <input type="text" name="describe" id="describe" value="{{ old('describe') }}" placeholder="Unos nije obavezan"
                                   class="form-control mb-3">
                        </div>
                        <div class="col-6">
                            <label for="barcode">Uneti Bar kod</label>
                            <input type="number" name="barcode" id="barcode" value="{{ old('barcode') }}" placeholder="Unos nije obavezan"
                                   class="form-control mb-3">
                            @if ($errors->has('barcode'))
                                <div class="alert alert-danger text-dark border-dark">
                                    {{ $errors->first('barcode') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3 p-1" style="background: #bebebf;">
                        <div class="text-center pb-3"><h5>Materijal (Unos nije obavezan):</h5></div>
                        <div class="col-1"></div>
                        <div class="col">
                            <input type="radio" id="metal" name="material" {{ old('item_type') == 'Ram' ? 'checked' : '' }} value="Metal" style="transform: scale(2)">
                              <label for="metal">Metal</label>
                        </div>
                        <div class="col">
                            <input type="radio" id="metal_plastic" name="material"  value="Metal/Plastika" {{ old('material') == 'Metal/Plastika' ? 'checked' : '' }}
                                   style="transform: scale(2)">
                              <label for="metal_plastic">Metal/Plastika</label>
                        </div>
                        <div class="col">
                            <input type="radio" id="plastic" name="material" value="Plastika" {{ old('material') == 'Plastika' ? 'checked' : '' }}
                                   style="transform: scale(2)">
                              <label for="plastic">Plastika</label>
                        </div>
                        <div class="col">
                            <input type="radio" id="silicon" name="material" value="Silikon" {{ old('material') == 'Silikon' ? 'checked' : '' }}
                                   style="transform: scale(2)">
                              <label for="silicon">Silikon</label>
                        </div>
                    </div>
                    <div class="row mb-3 p-1" style="background: #bebebf;">
                        <div class="text-center pb-3"><h5>Tip ugradnje (Unos nije obavezan):</h5></div>
                        <div class="col-2"></div>
                        <div class="col">
                            <input type="radio" id="full-frame" name="installation_type" value="Pun ram" {{ old('installation_type') == 'Pun ram' ? 'checked' : '' }}
                                   style="transform: scale(2)">
                              <label for="full-frame">Pun ram</label>
                        </div>
                        <div class="col">
                            <input type="radio" id="cutter" name="installation_type" value="Frez" {{ old('installation_type') == 'Frez' ? 'checked' : '' }}
                                   style="transform: scale(2)">
                              <label for="cutter">Frez</label>
                        </div>
                        <div class="col">
                            <input type="radio" id="drilling" name="installation_type" value="Bušenje" {{ old('installation_type') == 'Bušenje' ? 'checked' : '' }}
                                   style="transform: scale(2)">
                              <label for="drilling">Bušenje</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="purchase_price">Nabavna cena</label>
                            <input type="number" name="purchase_price" id="purchase_price" value="{{ old('purchase_price') }}" placeholder="Unos nije obavezan" min="0"
                                   class="form-control">
                        </div>
                        <div class="col">
                            <label for="selling_price">Prodajna cena</label>
                            <input type="number" name="selling_price" id="selling_price" value="{{ old('selling_price') }}" placeholder="Unos je obavezan" min="0"
                                   class="form-control" required>
                        </div>
                        <div class="col">
                            <label for="quantity">Količina</label>
                            <input type="number" name="quantity" id="quantity" value="{{ old('quantity') }}" placeholder="Unos je obavezan" min="0"
                                   class="form-control" required>
                        </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-secondary form-control">Snimi</button>
                </form>
                @if(session()->has('message')) <div class="alert alert-success p-1 text-uppercase text-center"> {{ session()->get('message') }}</div> @endif
            </div>
        </div>
    </div>

    <script>

        function displayData(data) {
            let noResult = document.getElementById('noResult');
            if (data.length === 0){
                noResult.innerHTML = '<h2 class="btn btn-warning text-uppercase" style="width: 100%;">Nema podataka, pokušajte ponovo!</h2>';
            }else {
                noResult.innerHTML = '';
            }

            let tableElement = document.getElementById('table');

            // Prvo, obrišem sve postojeće redove iz tabele
            while (tableElement.rows.length > 1) {
                tableElement.deleteRow(1);
            }

            for (let i = 0; i < data.length; i++) {
                const row = data[i];

                let columnsToDisplay = ['id', 'article', 'item_type', 'describe', 'material', 'installation_type', 'selling_price', 'quantity'];

                // Kreiraj novi red (<tr>) za svaki podatak
                // Metoda insertRow se koristi za dodavanje novog reda, a argument -1 označava da se novi red dodaje na kraj tabele
                // -1 znači da će se novi red smestiti nakon svih postojećih redova u tabeli.
                let trElement = tableElement.insertRow(-1); // -1 dodaje novi red na kraj tabele

                for (let key of columnsToDisplay) {
                    if (row.hasOwnProperty(key)) {
                        // Kreiraj <td> element za svaku vrednost
                        // Kreiranje i dodavanje nove ćelije (<td>) unutar trenutno kreiranog reda (<tr>) u HTML tabeli.
                        let tdElement = trElement.insertCell(-1); // -1 dodaje novu ćeliju u red

                        // Ako je ključ 'article', kreiraj <a> element i postavi ga kao tekstualni sadržaj
                        if (key === 'article') {
                            let aElement = document.createElement('a');

                            //${}` tretiraju se kao JavaScript izrazi i evaluiraju se
                            //${row['id']} će biti zamenjeno sa vrednošću row['id'], što je vrednost id atributa iz trenutnog reda row
                            //ako je row['id'] na primer 123, editUrl će dobiti vrednost /stock/123/edit
                            let editUrl = `/stock/${row['id']}/edit`; // Generiši URL
                            aElement.href = editUrl;
                            aElement.textContent = row[key];

                            // Postavi stilove za centriranje <a> elementa
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

