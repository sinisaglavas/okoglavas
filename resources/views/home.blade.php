@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-3 w-25 rounded"  style="background-color: #0a53be; height: 200px">
                <a href="{{ route('homeGlasses') }}" style="display: inline-block; width: 100%; height: 100%; color: white;" class="text-center text-decoration-none p-5"><h2>Glasses</h2></a>
            </div>
            <div class="col-2"></div>
            <div class="col-3 w-25 rounded"  style="background-color: #0a53be; height: 200px;">
                <a href="{{ route('homeContactLenses') }}" style="display: inline-block; width: 100%; height: 100%; color: white;" class="text-center text-decoration-none p-5"><h2>Contact Lenses</h2></a>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
@endsection

