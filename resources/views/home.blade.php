@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex">
            <div class="col-3 w-25 rounded bg-primary"  style="height: 200px; margin-left: 40px">
                <a href="{{ route('homeGlasses') }}" style="display: inline-block; width: 100%; height: 100%; color: white;" class="text-center text-decoration-none mt-5"><h2>Klijenti</h2><h2>Naočare</h2></a>
            </div>
            <div class="col-1"></div>
            <div class="col-3 w-25 rounded bg-danger"  style="height: 200px;">
                <a href="{{ route('homeContactLenses') }}" style="display: inline-block; width: 100%; height: 100%; color: white;" class="text-center text-decoration-none mt-5"><h2>Klijenti</h2><h2>Kontaktna sočiva</h2></a>
            </div>
            <div class="col-1"></div>
            <div class="col-3 w-25 rounded bg-secondary"  style="height: 200px">
                <a href="{{ route('allStock') }}" style="display: inline-block; width: 100%; height: 100%; color: white;" class="text-center text-decoration-none mt-5"><h2>Lager</h2></a>
            </div>
        </div>
    </div>
@endsection

