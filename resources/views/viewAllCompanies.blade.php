@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4 border-end">
                <a href="{{ route('showDebtCompanyForm') }}" class="btn btn-info form-control mb-3">Obrazac za PIO i druge organizacije</a>
                <a href="{{ route('viewClientsOrganisations') }}" class="btn btn-info form-control mb-5">Pregled svih dužnika</a>
                <h3 class="mt-5 text-center">Unesi novu organizaciju</h3>
                <form action="{{ route('saveNewCompany') }}" method="POST">
                    @csrf
                    <label for="company">Organizacija</label>
                    <input type="text" name="name_company" id="company" class="form-control"  placeholder="Unos je obavezan" required>
                    <label for="other-data">Drugi podaci - adresa, telefon...</label>
                    <textarea name="other_data" id="other-data" cols="30" rows="3" class="form-control" maxlength="150" oninput="updateCharacterCount()" placeholder="Unos nije obavezan - maksimalan unos 150 karaktera"></textarea>
                    <div id="characterCount" class="mb-3">Preostalo karaktera: 150</div>
                    <button type="submit" class="btn btn-info form-control">Zapamti</button>
                </form>
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
            </div>
            <div class="col-7 offset-1">
                <h2 class="text-center">Pregled svih organizacija</h2><br>
                <table class="table table-bordered table-striped text-center">
                    <thead>
                    <tr class="table-info">
                        <th>Id</th>
                        <th>Organizacija</th>
                        <th>Drugi podaci</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($companies as $company)
                        <tr>
                            <td>{{ $company->id }}</td>
                            <td>{{ $company->name_company }}</td>
                            <td>{{ $company->other_data }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Opciono: Možete dodati brojač karaktera koji će prikazati koliko karaktera je ostalo za unos.
        function updateCharacterCount() {
            var textarea = document.getElementById('other-data');
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
    </script>

@endsection



