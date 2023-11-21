@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">
                <a href="{{ route('home.allDebtors') }}" class="btn btn-primary form-control m-2">Svi klijenti /
                    Dužnici</a>
                <a href="{{ route('homeGlasses') }}" class="btn btn-primary form-control m-2">Svi klijenti</a>

            </div>
            <div class="col-1"></div>
            <div class="col-8">
                <h2>Novi dužnik:</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-4"></div>
            <div class="col-5">
                <form action="{{ route('saveDebtorForm') }}" method="POST">
                    @csrf
                    <label for="find_client">Pronađi klijenta:</label>
                    <select name="client" class="form-control" id="find_client">
                        <option value="0" id="control">Klikni ovde</option>
                        @foreach($all_clients as $single_client)
                            <option value="{{ $single_client->id}}">{{ $single_client->name }}</option>
                        @endforeach
                    </select><br>
                    <label for="debit">Iznos duga:</label>
                    <input type="number" name="debit" class="form-control" id="debit"
                           placeholder="Upis duga je moguć kada odaberete klijenta" disabled required><br>
                    <button class="btn btn-primary form-control">Zapamti</button>
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

        document.getElementById('find_client').addEventListener('change', function () {
            var debitInput = document.getElementById('debit');
            var selectedOption = this.options[this.selectedIndex];

            if (selectedOption.value === '0') {
                debitInput.disabled = true;
            } else {
                debitInput.disabled = false;
            }
        });

    </script>

@endsection

