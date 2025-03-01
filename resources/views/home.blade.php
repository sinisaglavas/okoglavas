@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-5">
                <a href="{{ route('homeGlasses') }}" class="btn btn-primary mb-5 p-4" style="width: 100%;"><h2>Klijenti Naočare</h2></a>
                <br>
                <a href="{{ route('homeContactLenses') }}" class="btn btn-danger p-4" style="width: 100%;"><h2>Klijenti Kontaktna sočiva</h2></a>
                <br>
                <a href="{{ route('allStock') }}" class="btn btn-secondary mt-5 p-4" style="width: 100%;"><h2>Lager i evidencija prometa</h2></a>
                <br>
                <a href="{{ route('showDebtCompanyForm') }}" class="btn btn-info mt-5 p-4" style="width: 100%;"><h2>Obrazac za PIO i druge organizacije</h2></a>
            </div>
            @if($currentUrl == 'https://ns-24.optikaglavas.com/home')
            <div class="col-7 d-flex flex-column justify-content-center align-items-center" style="height: 580px; background-image: url('{{ asset('images/okoglavas-ns.jpg') }}'); background-size: cover; background-position: center;"></div>
            @endif
            @if($currentUrl == 'https://ns2025.optikaglavas.com/home')
                <div class="col-7 d-flex flex-column justify-content-center align-items-center" style="height: 580px; background-image: url('{{ asset('images/okoglavas-ns.jpg') }}'); background-size: cover; background-position: center;"></div>
            @endif
            @if($currentUrl == 'https://bp2024.optikaglavas.com/home')
                <div class="col-7 d-flex flex-column justify-content-center align-items-center" style="height: 580px; background-image: url('{{ asset('images/okoglavasbp.jpg') }}'); background-size: cover; background-position: top;"></div>
            @endif
            @if($currentUrl == 'https://bp2025.optikaglavas.com/home')
                <div class="col-7 d-flex flex-column justify-content-center align-items-center" style="height: 580px; background-image: url('{{ asset('images/okoglavasbp.jpg') }}'); background-size: cover; background-position: top;"></div>
            @endif
        </div>
    </div>
@endsection

