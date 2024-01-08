@extends('layouts.app')

@section('content')
    <div class="container">
{{--        <div class="d-flex">--}}
{{--            <div class="col-3 w-25 rounded bg-primary"  style="height: 170px; margin-left: 40px">--}}
{{--                <a href="{{ route('homeGlasses') }}" style="display: inline-block; width: 100%; height: 100%; color: white;" class="text-center text-decoration-none mt-5"><h2>Klijenti</h2><h2>Naočare</h2></a>--}}
{{--            </div>--}}
{{--            <div class="col-1"></div>--}}
{{--            <div class="col-3 w-25 rounded bg-danger"  style="height: 170px;">--}}
{{--                <a href="{{ route('homeContactLenses') }}" style="display: inline-block; width: 100%; height: 100%; color: white;" class="text-center text-decoration-none mt-5"><h2>Klijenti</h2><h2>Kontaktna sočiva</h2></a>--}}
{{--            </div>--}}
{{--            <div class="col-1"></div>--}}
{{--            <div class="col-3 w-25 rounded bg-secondary"  style="height: 170px">--}}
{{--                <a href="{{ route('allStock') }}" style="display: inline-block; width: 100%; height: 100%; color: white;" class="text-center text-decoration-none mt-5"><h2>Lager</h2></a>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="row">
            <div class="col-5">
                <a href="{{ route('homeGlasses') }}" class="btn btn-primary mb-5 p-5" style="width: 100%;"><h2>Klijenti Naočare</h2></a>
                <br>
                <a href="{{ route('homeContactLenses') }}" class="btn btn-danger p-5" style="width: 100%;"><h2>Klijenti Kontaktna sočiva</h2></a>
                <br>
                <a href="{{ route('allStock') }}" class="btn btn-secondary mt-5 p-5" style="width: 100%;"><h2>Lager</h2></a>

            </div>
{{--            <div class="col-7 text-center">--}}
{{--                <img src="{{ asset('images/optikans.jpg') }}" style="width: 510px;" alt="Optika Kornelija Stankovica 27, NS">--}}
{{--                <p style="font-weight: bold; font-size: 22px;">Kornelija Stankovića 27, NOVI SAD</p>--}}
{{--            </div>--}}
            <div class="col-7 d-flex flex-column justify-content-center align-items-center" style="height: 580px; background-image: url('{{ asset('images/optikans.jpg') }}'); background-size: cover; background-position: center;">
            </div>

        </div>
    </div>
@endsection

