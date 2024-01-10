@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-5">
            <div class="col">
                <a href="{{ route('allStock') }}" class="btn btn-secondary form-control m-2">Lager</a>
            </div>
            <div class="col">
                <button class="btn btn-warning form-control m-2">Količina Sunčane: <span class="fw-bold">{{ $sunglasses_sum }} kom.</span></button>
            </div>
            <div class="col">
                <button class="btn btn-warning form-control m-2">Vrednost Sunčane: <span class="fw-bold">{{ $total }} dinara</span>
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="row mt-4">
                    <div class="col-8">
                        <h2 class="text-center">L A G E R &nbsp;&nbsp;Sunčane (Sunčane naočare)</h2>
                    </div>
                    <div class="col-4">
                        <form action="{{route('searchStock')}}" method="POST">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="article" class="form-control"
                                       placeholder="Pronađi po artiklu ili po opisu ili po prodajnoj ceni"
                                       aria-label="Search client" required>
                                <input type="submit" class="btn btn-outline-secondary" value="Traži">
                            </div>
                        </form>
                    </div>
                </div>
                @if(isset($search_stocks))
                    <table class="table text-center">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Artikal</th>
                            <th>Tip</th>
                            <th>Opis artikla</th>
                            <th>Materijal</th>
                            <th>Nabavna cena</th>
                            <th>Prodajna cena</th>
                            <th>Količina</th>
                            <th>Ukupna vrednost</th>
                            <th>Kreirano</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($search_stocks as $search_stock)
                            <tr>
                                <td>{{ $search_stock->id }}</td>
                                <td>{{ $search_stock->article }}</a></td>
                                <td>{{ $search_stock->item_type }}</td>
                                <td>{{ $search_stock->describe }}</td>
                                <td>{{ $search_stock->material }}</td>
                                <td>{{ $search_stock->purchase_price }}</td>
                                <td>{{ $search_stock->selling_price }}</td>
                                <td>{{ $search_stock->quantity }}</td>
                                <td>{{ $search_stock->selling_price * $search_stock->quantity }}</td>
                                <td>{{ $search_stock->created_at->format('d.m.Y.') }}</td>
                                <td><a href="{{ route('editStock',['id'=>$search_stock->id]) }}"
                                       style="text-decoration: none; color: #ffc107; display: block; font-weight: bold">PROMENI</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
                <br>
                <table class="table table-striped-columns table-hover border-warning text-center">
                    <thead>
                    <tr class="table table-secondary border-dark">
                        <th>Id</th>
                        <th>Artikal</th>
                        <th>Tip</th>
                        <th>Opis artikla</th>
                        <th>Materijal</th>
                        <th>Tip ugradnje</th>
                        <th>Nabavna cena</th>
                        <th>Prodajna cena</th>
                        <th>Količina</th>
                        <th>Ukupna vrednost</th>
                        <th>Kreirano</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sunglassess as $sunglasses)
                        <tr>
                            <td>{{ $sunglasses->id }}</td>
                            <td>{{ $sunglasses->article }}</a></td>
                            <td>{{ $sunglasses->item_type }}</td>
                            <td>{{ $sunglasses->describe }}</td>
                            <td>{{ $sunglasses->material }}</td>
                            <td>{{ $sunglasses->installation_type }}</td>
                            <td>{{ $sunglasses->purchase_price }}</td>
                            <td>{{ $sunglasses->selling_price }}</td>
                            <td>{{ $sunglasses->quantity }}</td>
                            <td>{{ $sunglasses->selling_price * $sunglasses->quantity }}</td>
                            <td>{{ $sunglasses->	created_at->format('d.m.Y.') }}</td>
                            <td style="background: #babbbc;"><a href="{{ route('editStock',['id'=>$sunglasses->id]) }}"
                                                                class="text-decoration-none" style="color: black;">Promeni</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection



