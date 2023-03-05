@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-3 w-25 rounded bg-primary"  style="height: 200px; margin-left: 40px">
                <a href="{{ route('homeGlasses') }}" style="display: inline-block; width: 100%; height: 100%; color: white;" class="text-center text-decoration-none p-5"><h2>Glasses</h2></a>
            </div>
            <div class="col-1"></div>
            <div class="col-3 w-25 rounded bg-danger"  style="height: 200px;">
                <a href="{{ route('homeContactLenses') }}" style="display: inline-block; width: 100%; height: 100%; color: white;" class="text-center text-decoration-none p-5"><h2>Contact Lenses</h2></a>
            </div>
            <div class="col-1"></div>
            <div class="col-3 w-25 rounded bg-secondary"  style="height: 200px">
                <a href="{{ route('allStock') }}" style="display: inline-block; width: 100%; height: 100%; color: white;" class="text-center text-decoration-none p-5"><h2>Stock</h2></a>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-4"></div>
            <div class="col-3 w-25 rounded"  style="background-color: olivedrab; height: 200px; margin-left: 40px">
                <a href="{{ route('editUser') }}" style="display: inline-block; width: 100%; height: 100%; color: white;" class="text-center text-decoration-none p-5"><h2>User - Data</h2></a>
            </div>
        </div>
    </div>
@endsection

