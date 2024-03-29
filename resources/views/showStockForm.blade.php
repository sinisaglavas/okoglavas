@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4">
                <a href="{{ route('allStock') }}" class="btn btn-secondary form-control m-2">Svi artikli</a>
            </div>
            <div class="col-1"></div>
            <div class="col-6">
                <h2>Novi Artikal</h2>
                <form action="{{ route('saveStock') }}" method="POST">
                    @csrf
                        <label for="article">Artikal</label>
                        <input type="text" name="article" id="article" placeholder="Unos je obavezan"
                               class="form-control" required>
                    <div class="row mt-3">
                        <div class="text-center"><h5>Vrsta artikla (obavezan unos):</h5></div>
                        <div class="col mt-4">
                            <input type="radio" id="cl" name="item_type" value="KS" style="transform: scale(2)"
                                   required>
                              <label for="cl" style="color: firebrick; font-weight: bold">Kont.sočivo</label>
                        </div>
                        <div class="col mt-4">
                            <input type="radio" id="glasses" name="item_type" value="Ram" style="transform: scale(2)"
                                   required>
                              <label for="glasses">Dioptr. ram</label>
                        </div>
                        <div class="col mt-4">
                            <input type="radio" id="sunglasses" name="item_type" value="Sunčane" style="transform: scale(2)"
                                   required>
                              <label for="sunglasses">Sunčane n.</label>
                        </div>
                        <div class="col mt-4">
                            <input type="radio" id="dl" name="item_type" value="DS" style="transform: scale(2)"
                                   required>
                              <label for="dl" style="color: blue; font-weight: bold" >Dioptr.sočivo</label>
                        </div>
                        <div class="col mt-4">
                            <input type="radio" id="other" name="item_type" value="Ostalo" style="transform: scale(2)"
                                   required>
                              <label for="other">Ostalo</label>
                        </div>
                    </div>
                    <label for="describe" class="mt-1">Opis artikla</label>
                    <input type="text" name="describe" id="describe" placeholder="Na primer: naziv rama..."
                           class="form-control mb-3">
                    <div class="row mb-3">
                        <div class="text-center pb-3"><h5>Materijal:</h5></div>
                        <div class="col-1"></div>
                        <div class="col">
                            <input type="radio" id="metal" name="material" value="Metal" style="transform: scale(2)">
                              <label for="metal">Metal</label>
                        </div>
                        <div class="col">
                            <input type="radio" id="metal_plastic" name="material" value="Metal/Plastika"
                                   style="transform: scale(2)">
                              <label for="metal_plastic">Metal/Plastika</label>
                        </div>
                        <div class="col">
                            <input type="radio" id="plastic" name="material" value="Plastika"
                                   style="transform: scale(2)">
                              <label for="plastic">Plastika</label>
                        </div>
                        <div class="col">
                            <input type="radio" id="silicon" name="material" value="Silikon"
                                   style="transform: scale(2)">
                              <label for="silicon">Silikon</label>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="text-center pb-3"><h5>Tip ugradnje:</h5></div>
                        <div class="col-2"></div>
                        <div class="col">
                            <input type="radio" id="full-frame" name="installation_type" value="Pun ram"
                                   style="transform: scale(2)">
                              <label for="full-frame">Pun ram</label>
                        </div>
                        <div class="col">
                            <input type="radio" id="cutter" name="installation_type" value="Frez"
                                   style="transform: scale(2)">
                              <label for="cutter">Frez</label>
                        </div>
                        <div class="col">
                            <input type="radio" id="drilling" name="installation_type" value="Bušenje"
                                   style="transform: scale(2)">
                              <label for="drilling">Bušenje</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="purchase_price">Nabavna cena</label>
                            <input type="text" name="purchase_price" id="purchase_price" class="form-control">
                        </div>
                        <div class="col">
                            <label for="selling_price">Prodajna cena</label>
                            <input type="text" name="selling_price" id="selling_price" placeholder="Unos je obavezan"
                                   class="form-control" required>
                        </div>
                        <div class="col">
                            <label for="quantity">Količina</label>
                            <input type="number" name="quantity" id="quantity" placeholder="Unos je obavezan" min="1"
                                   class="form-control" required>
                        </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-secondary form-control">Snimi</button>
                </form>
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

