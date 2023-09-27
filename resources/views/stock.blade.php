@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col">
                <a href="{{ route('turnoverByDays') }}" class="btn btn-secondary form-control m-2">Promet po danima</a>
            </div>
            <div class="col">
                <a href="{{ route('showStockForm') }}" class="btn btn-secondary form-control m-2">Novi artikal</a>
            </div>
            <div class="col">
                <button class="btn btn-warning form-control m-2">Ukupno na lageru: <span class="fw-bold">{{ $total }} dinara</span>
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="row">

                    <div class="col">
                        <button class="btn btn-outline-secondary form-control">KS: <span class="fw-bold">{{ $cl_sum }} kom.</span>
                        </button>
                    </div>
                    <div class="col">
                        <button class="btn btn-outline-secondary form-control">Ramovi: <span class="fw-bold">{{ $glasses_sum }} kom.</span>
                        </button>
                    </div>
                    <div class="col">
                        <button class="btn btn-outline-secondary form-control">Sunčane naočare: <span class="fw-bold">{{ $sunglasses_sum }} kom.</span>                    </div>
                    <div class="col">
                        <button class="btn btn-outline-secondary form-control">Diop. Sočiva: <span class="fw-bold">{{ $dl_sum }} kom.</span>
                        </button>
                    </div>

                </div>
                <div class="row mt-4">
                    <div class="col-8">
                        <h2 class="text-center">L A G E R</h2>
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
                    @foreach($all_stocks as $all_stock)
                        <tr>
                            <td>{{ $all_stock->id }}</td>
                            <td>{{ $all_stock->article }}</a></td>
                            <td>{{ $all_stock->item_type }}</td>
                            <td>{{ $all_stock->describe }}</td>
                            <td>{{ $all_stock->material }}</td>
                            <td>{{ $all_stock->installation_type }}</td>
                            <td>{{ $all_stock->purchase_price }}</td>
                            <td>{{ $all_stock->selling_price }}</td>
                            <td>{{ $all_stock->quantity }}</td>
                            <td>{{ $all_stock->selling_price * $all_stock->quantity }}</td>
                            <td>{{ $all_stock->	created_at->format('d.m.Y.') }}</td>
                            <td style="background: #babbbc;"><a href="{{ route('editStock',['id'=>$all_stock->id]) }}"
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

