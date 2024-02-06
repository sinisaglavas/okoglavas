@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">
                <a href="{{ route('showDebtCompanyForm') }}" class="btn btn-info form-control m-2">Obrazac za PIO i druge organizacije</a>
            </div>
            <div class="col-3">
                <a href="{{ route('viewAllCompany') }}" class="btn btn-info form-control m-2">Unošenje i pregled unetih organizacija</a>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h2 class="text-center">Pregled svih zaduženja klijenata</h2><br>
                <table class="table table-bordered table-striped text-center">
                    <thead>
                    <tr class="table-info">
                        <th>Id</th>
                        <th>Datum</th>
                        <th style="width: 20%;">Organizacija</th>
                        <th>Ime</th>
                        <th>Zaduženje</th>
                        <th>Broj rata</th>
                        <th>Iznos rate</th>
                        <th>Ukupno za sve</th>
                        <th>Beleška</th>
                        <th></th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($clients_organisations as $client)
                        <tr>
                            <td>{{ $client->id }}</td>
                            <td>{{ $client->formatted_date }}</td>
                            <td>{{ $client->debt_company }}</td>
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->debit }}</td>
                            <td>{{ $client->installment_number }}</td>
                            <td>{{ $client->installment_amount }}</td>
                            <td>{{ $client->total_all }}</td>
                            <td>{{ $client->note }}</td>
                            <td><a href="{{ route('deleteClientOrganisation', ['id'=>$client->id]) }}"
                                   class="btn btn-sm btn-warning"
                                   onclick="return confirm('Da li ste sigurni?')">Obrisi</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @if(session()->has('message'))
                    <div onclick="return confirm({{ session()->get('message') }})"></div>
                @endif
            </div>
        </div>


    </div>

    <script>
        // Opciono: Možete dodati brojač karaktera koji će prikazati koliko karaktera je ostalo za unos.
        function updateCharacterCount() {
            var textarea = document.getElementById('other-data');
            var characterCount = document.getElementById('characterCount');
            var remainingChars = 50 - textarea.value.length; // 50 je maksimalan broj karaktera minus broj unetih karaktera

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
    </script>

@endsection




