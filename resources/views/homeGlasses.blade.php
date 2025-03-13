@extends('layouts.app')

@section('content')
    <div class="container">
    <div class="row mb-4">
        <div class="col-4">
            <a href="{{ route('home.showClientForm') }}" class="btn btn-primary form-control m-2">Novi klijent</a>
        </div>
        <div class="col-4">
            <a href="{{ route('home.allDebtors') }}" class="btn btn-primary form-control m-2">Svi klijenti / Dužnici</a>
        </div>
        <div class="col-4">
            <a href="#" class="btn btn-outline-primary form-control m-2">Ukupno klijenata: {{ \Illuminate\Support\Facades\DB::table('clients')->select('id')->count('id') }}</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col">
                    <h2>Svi klijenti - Naočare</h2>
                </div>
                <div class="col">
                    <form action="{{route('searchClient')}}" method="POST">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="name" class="form-control" placeholder="Traži klijenta po imenu ili po broju telefona" aria-label="Search client">
                            <input type="submit" class="btn btn-outline-secondary" value="Traži">
                        </div>
                    </form>
                </div>
            </div>
                @if(isset($search_clients))
                <h5 class="btn btn-secondary">Rezultat pretrage:</h5>
                    <table class="table table-hover table-bordered text-center">
                        <thead>
                        <tr class="table-secondary">
                            <th>Id</th>
                            <th>Ime</th>
                            <th></th>
                            <th>Datum rođenja</th>
                            <th>Adresa</th>
                            <th>Grad</th>
                            <th>Telefon</th>
                            <th>Lična karta broj</th>
                            <th>Kreirano</th>
                            <th></th>
                            <th>SMS</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($search_clients as $search_client)
                        <tr>
                            <td>{{ $search_client->id }}</td>
                            <td title="Klik na istoriju pregleda"><a href="{{ route('home.singleClient',['id'=>$search_client->id]) }}" class="text-decoration-none fw-bold">{{ $search_client->name }}</a></td>
                            <td><button class="btn-purchases btn btn-secondary" data-client-id="{{ $search_client->id ?? '' }}" data-client-name="{{ $search_client->name ?? '' }}">Kupljeno</button></td>
                            <td>{{ $search_client->date_of_birth }}</td>
                            <td>{{ $search_client->address }}</td>
                            <td>{{ $search_client->city }}</td>
                            <td>{{ $search_client->phone }}</td>
                            <td>{{ $search_client->identity_card }}</a></td>
                            <td>{{ $search_client->created_at->format('d.m.Y') }}</td>
                            <td><button class="btn btn-primary"><a href="/client/{{$search_client->id}}/edit" style="color: #fff; text-decoration: none">Promeni</a></button></td>
                            <td></td>
{{--                            @if(session('success'))--}}
{{--                                <td>--}}
{{--                                    <form action="{{ route('home.sendSms',['id'=>$search_client->id]) }}" method="POST">--}}
{{--                                        @csrf--}}
{{--                                        <input type="hidden" name="id" value="{{ $search_client->id }}">--}}
{{--                                        <button style="background: green;" type="submit">{{ session('success') }}</button></form>--}}
{{--                                </td>--}}
{{--                            @elseif(session('error'))--}}
{{--                                <td>--}}
{{--                                    <form action="{{ route('home.sendSms',['id'=>$search_client->id]) }}" method="POST">--}}
{{--                                        @csrf--}}
{{--                                        <input type="hidden" name="id" value="{{ $search_client->id }}">--}}
{{--                                        <button style="background: red;" type="submit">{{ session('error') }}</button>--}}
{{--                                    </form>--}}
{{--                                </td>--}}
{{--                            @else--}}
{{--                                <td>--}}
{{--                                    <form action="{{ route('home.sendSms',['id'=>$search_client->id]) }}" method="POST">--}}
{{--                                        @csrf--}}
{{--                                        <input type="hidden" name="id" value="{{ $search_client->id }}">--}}
{{--                                        <button type="submit">Pošalji SMS</button>--}}
{{--                                    </form>--}}
{{--                                </td>--}}
{{--                            @endif--}}
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            <br>
            <table class="table table-hover table-bordered text-center">
                <thead>
                <tr class="table-primary">
                    <th>Id</th>
                    <th>Ime</th>
                    <th></th>
                    <th>Datum rođenja</th>
                    <th>Adresa</th>
                    <th>Grad</th>
                    <th>Telefon</th>
                    <th>Lična karta broj</th>
                    <th>Kreirano</th>
                    <th></th>
                    <th>SMS</th>
                </tr>
                </thead>
                <tbody>
                @foreach($all_clients as $client)
                    <tr>
                        <td>{{ $client->id }}</td>
                        <td title="Klik na istoriju pregleda"><a href="{{ route('home.singleClient',['id'=>$client->id]) }}" class="text-decoration-none">{{ $client->name }}</a></td>
                        <td><button class="btn-purchases btn btn-secondary" data-client-id="{{ $client->id ?? '' }}" data-client-name="{{ $client->name ?? '' }}">Kupljeno</button></td>
                        {{--Kod iznad-ako $single_client->id postoji, koristiće se njegova vrednost.Ako ne postoji, dugme neće slati undefined vrednost, već prazan string.--}}
                        <td>{{ $client->date_of_birth }}</td>
                        <td>{{ $client->address }}</td>
                        <td>{{ $client->city }}</td>
                        <td>{{ $client->phone }}</td>
                        <td>{{ $client->identity_card }}</a></td>
                        <td>{{ $client->created_at->format('d.m.Y') }}</td>
                        <td><button class="btn btn-primary"><a href="/client/{{$client->id}}/edit" style="color: #fff; text-decoration: none">Promeni</a></button></td>
                        <td></td>
{{--                        @if(session('success'))--}}
{{--                            <td>--}}
{{--                                <form action="{{ route('home.sendSms',['id'=>$client->id]) }}" method="POST">--}}
{{--                                    @csrf--}}
{{--                                    <input type="hidden" name="id" value="{{ $client->id }}">--}}
{{--                                    <button style="background: green;" type="submit">{{ session('success') }}</button></form>--}}
{{--                            </td>--}}
{{--                        @elseif(session('error'))--}}
{{--                            <td>--}}
{{--                                <form action="{{ route('home.sendSms',['id'=>$client->id]) }}" method="POST">--}}
{{--                                    @csrf--}}
{{--                                    <input type="hidden" name="id" value="{{ $client->id }}">--}}
{{--                                    <button style="background: red;" type="submit">{{ session('error') }}</button>--}}
{{--                                </form>--}}
{{--                            </td>--}}
{{--                        @else--}}
{{--                            <td>--}}
{{--                                <form action="{{ route('home.sendSms',['id'=>$client->id]) }}" method="POST">--}}
{{--                                    @csrf--}}
{{--                                    <input type="hidden" name="id" value="{{ $client->id }}">--}}
{{--                                    <button type="submit">Pošalji SMS</button>--}}
{{--                                </form>--}}
{{--                            </td>--}}
{{--                        @endif--}}
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.btn-purchases').forEach(button => {
            button.addEventListener('click', function () {
                console.log(this.dataset);
                let clientId = this.dataset.clientId; //Hvatamo id kupca
                let clientName = this.dataset.clientName; // Dohvatamo ime kupca

                // Proveri da li modal već postoji i ukloni ga pre kreiranja novog
                let existingModal = document.getElementById('custom-modal');
                if (existingModal) {
                    existingModal.remove();
                }

                fetch(`/client-purchases/${clientId}`)
                    .then(response => response.json())
                    .then(data => {
                        let modalContent = `<h3>Kupac - ${clientName}:</h3>`;

                        if (data.length === 0) {
                            modalContent += '<p class="text-uppercase fw-bold">Nema podataka</p>';
                        } else {
                            modalContent += `<ul>`
                            data.forEach(item => {
                                let date = new Date(item.created_at); // Prenos u zeljeni format
                                let formattedDate = date.toLocaleDateString('en-GB'); // Format: 04/02/2025
                                modalContent += `<li>${item.article} ${item.describe}, ${item.pcs}x${item.price} dinara, ${formattedDate}</li>`;
                            });
                            modalContent += '</ul>';
                        }

                        modalContent += '</ul><button class="btn btn-secondary" id="close-modal">Zatvori</button>';

                        let modal = document.createElement('div');
                        modal.id = 'custom-modal';
                        modal.innerHTML = modalContent;
                        modal.style.position = 'fixed';
                        modal.style.top = '50%';
                        modal.style.left = '50%';
                        modal.style.transform = 'translate(-50%, -50%)';
                        modal.style.backgroundColor = '#f7dc43';
                        modal.style.padding = '20px';
                        modal.style.boxShadow = '0px 4px 6px rgba(0,0,0,0.5)';
                        modal.style.zIndex = '1000';

                        document.body.appendChild(modal);

                        document.getElementById('close-modal').addEventListener('click', function () {
                            modal.remove();
                        });
                    });
            });
        });
    });
</script>


@endsection
