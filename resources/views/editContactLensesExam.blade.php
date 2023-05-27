@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4">
                <a href="{{ route('homeContactLenses') }}" class="btn btn-danger form-control m-2">Svi klijenti</a>
                <a href="{{ route('home.singleContactLensesClient',['id'=>$single_client->id]) }}"
                   class="btn btn-light form-control m-2">Promena podataka za klijenta: {{ $single_client->name }}</a>
                @if(session()->has('message'))
                    <div class="alert alert-info form-control m-2 text-center text-uppercase">
                        {{ session()->get('message') }}
                    </div>
                @endif
            </div>
            <div class="col-1"></div>
            <div class="col-3 p-2 m-1" style="background-color: rgb(200,200,200)">
                <h4 class="text-center">KS - Promena parametara</h4>
                <form action="{{ route('updateContactLensesExam',['id'=>$contact_lenses_exam->id]) }}" method="POST">
                    @csrf
                    @method('put')
                    <label for="right-eye-sphere">Right eye sphere</label>
                    <select name="right_diopter" class="form-control" id="right-eye-sphere">
                        @foreach($all_diopters as $diopter)
                            <option name="right_eye_sphere"
                                    value="{{$diopter->sphere_range }}" {{ $diopter->sphere_range == $contact_lenses_exam->right_eye_sphere ? 'selected' : '' }}>{{ $diopter->sphere_range }}</option>
                        @endforeach
                    </select>
                    <div class="row">
                        <div class="col-6">
                            <label for="right-eye-cylinder">Right eye cylinder</label>
                            <select name="right_diopter2" class="form-control" id="right-eye-cylinder">
                                @foreach($all_diopters as $diopter)
                                    <option name="right_eye_cylinder"
                                            value="{{$diopter->cylinder_range }}" {{ $diopter->cylinder_range == $contact_lenses_exam->right_eye_cylinder ? 'selected' : '' }}>{{ $diopter->cylinder_range }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="right-eye-axis">Right eye axis</label>
                            <select name="right_axis" class="form-control" id="right-eye-axis">
                                @foreach($all_diopters as $diopter)
                                    <option name="right_eye_axis"
                                            value="{{ $diopter->axis_range }}" {{ $diopter->axis_range == $contact_lenses_exam->right_eye_axis ? 'selected' : '' }}>{{ $diopter->axis_range }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <label for="left-eye-sphere">Left eye sphere</label>
                    <select name="left_diopter" class="form-control" id="left-eye-sphere">
                        @foreach($all_diopters as $diopter)
                            <option name="left_eye_sphere"
                                    value="{{$diopter->sphere_range }}" {{ $diopter->sphere_range == $contact_lenses_exam->left_eye_sphere ? 'selected' : '' }}>{{ $diopter->sphere_range }}</option>
                        @endforeach
                    </select>
                    <div class="row">
                        <div class="col-6">
                            <label for="left-eye-cylinder">Left eye cylinder</label>
                            <select name="left_diopter2" class="form-control" id="left-eye-cylinder">
                                @foreach($all_diopters as $diopter)
                                    <option name="left_eye_cylinder"
                                            value="{{$diopter->cylinder_range }}" {{ $diopter->cylinder_range == $contact_lenses_exam->left_eye_cylinder ? 'selected' : '' }}>{{ $diopter->cylinder_range }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="left-eye-axis">Left eye axis</label>
                            <select name="left_axis" class="form-control" id="left-eye-axis">
                                @foreach($all_diopters as $diopter)
                                    <option name="left_eye_axis"
                                            value="{{ $diopter->axis_range }}" {{ $diopter->axis_range == $contact_lenses_exam->left_eye_axis ? 'selected' : '' }}>{{ $diopter->axis_range }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="contact-lenses">Kontaktna sočiva</label>
                            <select name="all_contact_lenses" class="form-control" id="contact-lenses">
                                @foreach($all_contact_lenses as $contact_lenses)
                                    <option name="contact_lenses" value="{{ $contact_lenses->id }}" {{ $contact_lenses->type == $contact_lenses_exam->type ? 'selected' : '' }}>{{ $contact_lenses->type }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <button name="green" value="green" class="btn btn-success form-control">Od optometrije Glavaš</button>
                    <br><br>
                    <button name="red" value="red" class="btn btn-danger form-control">Po receptu</button>
                </form>
            </div>
        </div>
    </div>
@endsection

