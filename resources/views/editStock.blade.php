@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4">
                <a href="{{ route('allStock') }}" class="btn btn-secondary form-control m-2">Svi artikli - LAGER</a>
            </div>
            <div class="col-4 text-center">
                <h2>Promeni Artikal</h2>
                <form action="{{ route('updateStock', ['id'=>$stock->id]) }}" method="POST">
                    @csrf
                    @method('put')

                    <div class="row">
                        <div class="col">
                            <label for="article">Artikal</label>
                            <input type="text" name="article" id="article" placeholder="Unos je obavezan"
                                   class="form-control" value="{{ $stock->article }}" required>
                        </div>
                        <div class="col">
                            <label for="item-type">Tip artikla</label>
                            <select name="item_type" id="item-type" class="form-control" required>
                                <option value="{{ $stock->item_type }}" hidden>{{ $stock->item_type }}</option>
                                <option value="KS">KS (kontaktna sočiva)</option>
                                <option value="Ram">Dioptrijski ram</option>
                                <option value="Sunčane">Sunčane naočare</option>
                                <option value="DS">DS (dioptrijsko sočivo)</option>
                                <option value="Ostalo">Ostalo</option>
                            </select>
                        </div>
                    </div>
                    <label for="describe">Opis artikla</label>
                    <input type="text" name="describe" id="describe" class="form-control"
                           value="{{ $stock->describe }}">
                    <label for="barcode">Bar kod</label>
                    <input type="number" min="1000000000" max="9999999999999" name="barcode" id="barcode"
                           class="form-control" value="{{ $stock->barcode }}">
                    <label for="material">Materijal</label>
                    <select name="material" id="material" class="form-control">
                        <option value="{{ $stock->material }}" hidden>{{ $stock->material }}</option>
                        <option value="Metal">Metal</option>
                        <option value="PLastika">Plastika</option>
                        <option value="Metal/Plastika">Metal/Plastika</option>
                        <option value="Silikon">Silikon</option>
                    </select>
                    <label for="installation_type">Tip ugradnje</label>
                    <select name="installation_type" id="installation_type" class="form-control">
                        <option value="{{ $stock->installation_type }}"
                                hidden>{{ $stock->installation_type }}</option>
                        <option value="Pun ram">Pun ram</option>
                        <option value="Frez">Frez</option>
                        <option value="Bušenje">Bušenje</option>
                    </select>
                    <div class="row">
                        <div class="col">
                            <label for="purchase_price">Nabavna cena</label>
                            <input type="text" name="purchase_price" id="purchase_price" class="form-control"
                                   value="{{ $stock->purchase_price }}">
                        </div>
                        <div class="col">
                            <label for="selling_price">Prodajna cena</label>
                            <input type="text" name="selling_price" id="selling_price" placeholder="Unos je obavezan"
                                   class="form-control" value="{{ $stock->selling_price }}" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col"></div>
                        <div class="col">
                            <label for="quantity">Količina</label>
                            <input type="number" name="quantity" id="quantity" placeholder="Unos je obavezan" min="0"
                                   class="form-control" value="{{ $stock->quantity }}" required>
                        </div>
                        <div class="col"></div>
                    </div>
                    <button type="submit" class="btn btn-outline-secondary form-control">Promeni</button>
                </form>
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
            </div>
            <div class="col-4">
                <a href="{{ route('showStockForm') }}" class="btn btn-secondary form-control m-2">Novi artikal</a>
            </div>
        </div>
    </div>
@endsection
