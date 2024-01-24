@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">
                <a href="{{ route('viewClientsOrganisations') }}" class="btn btn-info form-control m-2">Pregled svih dužnika</a>
                <a href="{{ route('viewAllCompany') }}" class="btn btn-info form-control m-2">Pregled unetih organizacija</a>
            </div>
           <div class="col-6 offset-1 mt-5">
               <h3 class="mb-3">Obrazac za unošenje dužnika za plaćanje na rate</h3>
               <form action="{{ route('saveNewClientCompany') }}" method="POST" id="myForm">
                   @csrf
                   <label for="mySelect">Ime i prezime</label>
                   <select name="client" class="form-control" id="mySelect">
                       <option value="no_data" id="noDataOption">Klikni ovde i odaberi klijenta</option>
                       @foreach($all_clients as $single_client)
                           <option value="{{ $single_client->id}}">{{ $single_client->name }}</option>
                       @endforeach
                   </select>
                   <label for="mySelect1">Organizacije</label>
                   <select name="debt_companies" class="form-control" id="mySelect1">
                       <option value="no_data1" id="noDataOption1">Klikni ovde i odaberi organizaciju</option>
                       @foreach($debt_companies as $debt_company)
                           <option value="{{ $debt_company->id}}">{{ $debt_company->name_company }}</option>
                       @endforeach
                   </select>
                   <div class="row">
                       <div class="col-5">
                           <label for="debit">Ukupno zaduženje</label>
                           <input type="number" min="0" name="debit" id="debit" class="form-control" placeholder="Obavezno unesi zaduženje" required>
                       </div>
                       <div class="col-3">
                           <label for="installment_number">Broj rata</label>
                           <select name="installment_number" class="form-control" id="installment_number">
                               <?php for ($i=1;$i<=24;$i++){
                                   echo "<option value=".$i.">".$i."</option>"; }?>
                           </select>
                       </div>
                       <div class="col-4">
                           <label for="installment_amount">Iznos rate</label>
                           <input type="number" name="installment_amount" id="installment_amount" class="form-control" readonly>
                       </div>
                   </div>
                   <label for="note">Dodatne beleške</label>
                   <textarea name="note" id="note" cols="30" rows="3" maxlength="150" class="form-control" oninput="updateCharacterCount()"
                             placeholder="Unošenje beleške nije obavezno - Maksimalan unos 150 karaktera"></textarea>
                   <div id="characterCount">Preostalo karaktera: 150</div>
                   <button type="submit" class="btn btn-info form-control mt-3">Pošalji</button>
               </form>

               @if(session()->has('message'))
                   <div class="alert alert-success text-center">
                       {{ session()->get('message') }}
                   </div>
               @endif
           </div>
        </div>
    </div>

    <script>
        document.getElementById('noDataOption').disabled = true;

        document.getElementById('myForm').addEventListener('submit', function (event) {
            var selectedOption = document.getElementById('mySelect').value;

            if (selectedOption === 'no_data') {
                event.preventDefault(); // Spriječava slanje forme ako je odabrana opcija bez slanja podataka
                alert('Odaberite KLIJENTA');
            }
        });
        document.getElementById('noDataOption1').disabled = true;

        document.getElementById('myForm').addEventListener('submit', function (event) {
            var selectedOption = document.getElementById('mySelect1').value;

            if (selectedOption === 'no_data1') {
                event.preventDefault(); // Sprečava slanje forme ako je odabrana opcija bez slanja podataka
                alert('Odaberite ORGANIZACIJU');
            }
        });

        // Opciono: Možete dodati brojač karaktera koji će prikazati koliko karaktera je ostalo za unos.
        function updateCharacterCount() {
            var textarea = document.getElementById('note');
            var characterCount = document.getElementById('characterCount');
            var remainingChars = 150 - textarea.value.length; // 200 je maksimalan broj karaktera minus broj unetih karaktera

            characterCount.textContent = 'Preostalo karaktera: ' + remainingChars; // Prikazuje preostali broj karaktera

            // Opciono: Možete dodati stilizaciju ili promeniti boju teksta kada se približite maksimalnom broju karaktera.
            if (remainingChars < 1) {
                characterCount.style.color = 'red';// Možete promeniti boju u crvenu kada premašite maksimalni broj karaktera.
                characterCount.style.fontWeight = 'bold'; // Možete promeniti font kada premašite maksimalni broj karaktera.
            } else {
                characterCount.style.color = ''; // Vraća boju na podrazumevanu vrednost.
                characterCount.style.fontWeight = ''; // Vraća font na podrazumevanu vrednost.
            }
        }


        let debit = document.getElementById('debit');
        let installment_number = document.getElementById('installment_number');
        installment_number.addEventListener('change', function () {
            if (debit.value && installment_number.value){
                let installment_amount = document.getElementById('installment_amount');
                let result = (debit.value / installment_number.value).toFixed(2); // toFixed(2) - zaokružuje na dve decimale
                installment_amount.value = result;
            }
        });
        debit.addEventListener('keyup', function () {
            if (debit.value && installment_number.value){
                let installment_amount = document.getElementById('installment_amount');
                let result = (debit.value / installment_number.value).toFixed(2);
                installment_amount.value = result;
            }
        });
        debit.addEventListener('mouseup', function () {
            if (debit.value && installment_number.value){
                let installment_amount = document.getElementById('installment_amount');
                let result = (debit.value / installment_number.value).toFixed(2);
                installment_amount.value = result;
            }
        });
    </script>

@endsection

