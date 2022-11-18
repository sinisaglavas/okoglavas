@extends('layouts.master')

@section('main')

            <div class="col-5"><br>
                <h1 class="text-bg-info">All Clients - Glasses</h1><br><br>
                <table class="table table-info table-striped">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Date of birth</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>Phone</th>
                        <th>Identity card</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($all_clients as $client)
                        <tr>
                            <td>{{ $client->id }}</td>
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->date_of_birth }}</td>
                            <td>{{ $client->address }}</td>
                            <td>{{ $client->city }}</td>
                            <td>{{ $client->phone }}</td>
                            <td>{{ $client->identity_card }}</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-2"></div>
            <div class="col-5"><br>
                <h1>All Clients - Contact Lenses</h1><br><br>
                <table class="table table-bordered">
                    <thead>
                    <tr class="table-primary">
                        <th>Id</th>
                        <th>Name</th>
                        <th>Date of birth</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>Phone</th>
                        <th>Identity card</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($all_contact_lenses_clients as $client)
                        <tr>
                            <td>{{ $client->id }}</td>
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->date_of_birth }}</td>
                            <td>{{ $client->address }}</td>
                            <td>{{ $client->city }}</td>
                            <td>{{ $client->phone }}</td>
                            <td>{{ $client->identity_card }}</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>


@endsection
