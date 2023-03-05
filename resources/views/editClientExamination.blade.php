@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4">
                <a href="{{ route('homeGlasses') }}" class="btn btn-primary form-control m-2">Svi klijenti</a>
                <a href="{{ route('home.singleClient',['id'=>$single_client->id]) }}" class="btn btn-light form-control m-2">Promena podataka za klijenta: {{ $single_client->name }}</a>
                @if(session()->has('message'))
                    <div class="alert alert-info form-control m-2 text-center text-uppercase">
                        {{ session()->get('message') }}
                    </div>
                @endif
                @if(session()->has('message1'))
                    <div class="alert alert-info form-control m-2 text-center text-uppercase">
                        {{ session()->get('message1') }}
                    </div>
                @endif
            </div>
            <div class="col-1"></div>

            <div class="col-3 p-2 m-1" style="background-color: rgb(200,200,200)">
                <h2>Distance</h2>
                <form action="{{ route('home.saveDistance',['id'=>$single_client->id]) }}" method="POST">
                    @csrf
                    <label for="right-eye-sphere">Right eye sphere</label>
                    <input type="text" name="right_eye_sphere" id="right-eye-sphere" class="form-control" value="{{ $single_distance->right_eye_sphere }}">
                    <div class="row">
                        <div class="col-6">
                            <label for="right-eye-cylinder">Right eye cylinder</label>
                            <input type="text" name="right_eye_cylinder" id="right-eye-cylinder" class="form-control" value="{{ $single_distance->right_eye_cylinder }}">
                        </div>
                        <div class="col-6">
                            <label for="right-eye-axis">Right eye axis</label>
                            <input type="number" name="right_eye_axis" id="right-eye-axis" class="form-control" min="0" max="180" value="{{ $single_distance->right_eye_axis }}">
                        </div>
                    </div>
                    <label for="right-eye-pd">Right eye pd</label>
                    <input type="number" name="right_eye_pd" id="right-eye-pd" class="form-control" min="20" max="41" value="{{ $single_distance->right_eye_pd }}">
                    <br>
                    <label for="left-eye-sphere">Left eye sphere</label>
                    <input type="text" name="left_eye_sphere" id="left-eye-sphere" class="form-control" value="{{ $single_distance->left_eye_sphere }}">
                    <div class="row">
                        <div class="col-6">
                            <label for="left-eye-cylinder">Left eye cylinder</label>
                            <input type="text" name="left_eye_cylinder" id="left-eye-cylinder" class="form-control" value="{{ $single_distance->left_eye_cylinder }}">
                        </div>
                        <div class="col-6">
                            <label for="left-eye-axis">Left eye axis</label>
                            <input type="number" name="left_eye_axis" id="left-eye-axis" class="form-control" min="0" max="180" value="{{ $single_distance->left_eye_axis }}">
                        </div>
                    </div>
                    <label for="left-eye-pd">Left eye pd</label>
                    <input type="number" name="left_eye_pd" id="left-eye-pd" class="form-control" min="20" max="41" value="{{ $single_distance->left_eye_pd }}">
                    <br>
                    <button name="green" value="green" class="btn btn-success form-control">By optometry Glavas</button>
                    <br><br>
                    <button name="red" value="red" class="btn btn-danger form-control">By prescription</button>
                </form>
            </div>

        </div>
    </div>
@endsection
