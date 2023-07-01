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
            <div class="col-5 p-2 m-1" style="background-color: rgb(200,200,200)">
                <h4 class="text-center">KS - Promena parametara</h4>
                <form action="{{ route('updateContactLensesExam',['id'=>$contact_lenses_exam->id]) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="row mt-3">
                        <h5>Right eye</h5>
                        <div class="col">
                            <label for="right-eye-sphere">Sphere</label>
                            <select name="right_diopter" class="form-control" id="right-eye-sphere">
                                @foreach($all_diopters as $diopter)
                                    <option name="right_eye_sphere"
                                            value="{{$diopter->sphere_range }}" {{ $diopter->sphere_range == $contact_lenses_exam->right_eye_sphere ? 'selected' : '' }}>{{ $diopter->sphere_range }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="right-eye-cylinder">Cylinder</label>
                            <select name="right_diopter2" class="form-control" id="right-eye-cylinder">
                                @foreach($all_diopters as $diopter)
                                    <option name="right_eye_cylinder"
                                            value="{{$diopter->cylinder_range }}" {{ $diopter->cylinder_range == $contact_lenses_exam->right_eye_cylinder ? 'selected' : '' }}>{{ $diopter->cylinder_range }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="right-eye-axis">Axis</label>
                            <select name="right_axis" class="form-control" id="right-eye-axis">
                                @foreach($all_diopters as $diopter)
                                    <option name="right_eye_axis"
                                            value="{{ $diopter->axis_range }}" {{ $diopter->axis_range == $contact_lenses_exam->right_eye_axis ? 'selected' : '' }}>{{ $diopter->axis_range }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="right-eye-add">Add</label>
                            <select name="right_add" class="form-control" id="right-eye-add">
                                <option name="right_eye_add" value=""></option>
                                <option name="right_eye_add" value="0.50" {{ 0.50 == $contact_lenses_exam->right_eye_add ? 'selected' : '' }}>0.50</option>
                                <option name="right_eye_add" value="0.75" {{ 0.75 == $contact_lenses_exam->right_eye_add ? 'selected' : '' }}>0.75</option>
                                <option name="right_eye_add" value="1.00" {{ 1.00 == $contact_lenses_exam->right_eye_add ? 'selected' : '' }}>1.00</option>
                                <option name="right_eye_add" value="1.25" {{ 1.25 == $contact_lenses_exam->right_eye_add ? 'selected' : '' }}>1.25</option>
                                <option name="right_eye_add" value="1.50" {{ 1.50 == $contact_lenses_exam->right_eye_add ? 'selected' : '' }}>1.50</option>
                                <option name="right_eye_add" value="1.75" {{ 1.75 == $contact_lenses_exam->right_eye_add ? 'selected' : '' }}>1.75</option>
                                <option name="right_eye_add" value="2.00" {{ 2.00 == $contact_lenses_exam->right_eye_add ? 'selected' : '' }}>2.00</option>
                                <option name="right_eye_add" value="2.25" {{ 2.25 == $contact_lenses_exam->right_eye_add ? 'selected' : '' }}>2.25</option>
                                <option name="right_eye_add" value="2.50" {{ 2.50 == $contact_lenses_exam->right_eye_add ? 'selected' : '' }}>2.50</option>
                                <option name="right_eye_add" value="2.75" {{ 2.75 == $contact_lenses_exam->right_eye_add ? 'selected' : '' }}>2.75</option>
                                <option name="right_eye_add" value="3.00" {{ 3.00 == $contact_lenses_exam->right_eye_add ? 'selected' : '' }}>3.00</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-3">
                        <h5>Left eye</h5>
                        <div class="col">
                            <label for="left-eye-sphere">Sphere</label>
                            <select name="left_diopter" class="form-control" id="left-eye-sphere">
                                @foreach($all_diopters as $diopter)
                                    <option name="left_eye_sphere"
                                            value="{{$diopter->sphere_range }}" {{ $diopter->sphere_range == $contact_lenses_exam->left_eye_sphere ? 'selected' : '' }}>{{ $diopter->sphere_range }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="left-eye-cylinder">Cylinder</label>
                            <select name="left_diopter2" class="form-control" id="left-eye-cylinder">
                                @foreach($all_diopters as $diopter)
                                    <option name="left_eye_cylinder"
                                            value="{{$diopter->cylinder_range }}" {{ $diopter->cylinder_range == $contact_lenses_exam->left_eye_cylinder ? 'selected' : '' }}>{{ $diopter->cylinder_range }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="left-eye-axis">Axis</label>
                            <select name="left_axis" class="form-control" id="left-eye-axis">
                                @foreach($all_diopters as $diopter)
                                    <option name="left_eye_axis"
                                            value="{{ $diopter->axis_range }}" {{ $diopter->axis_range == $contact_lenses_exam->left_eye_axis ? 'selected' : '' }}>{{ $diopter->axis_range }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="left-eye-add">Add</label>
                            <select name="left_add" class="form-control" id="left-eye-add">
                                <option name="left_eye_add" value=""></option>
                                <option name="left_eye_add" value="0.50" {{ 0.50 == $contact_lenses_exam->left_eye_add ? 'selected' : '' }}>0.50</option>
                                <option name="left_eye_add" value="0.75" {{ 0.75 == $contact_lenses_exam->left_eye_add ? 'selected' : '' }}>0.75</option>
                                <option name="left_eye_add" value="1.00" {{ 1.00 == $contact_lenses_exam->left_eye_add ? 'selected' : '' }}>1.00</option>
                                <option name="left_eye_add" value="1.25" {{ 1.25 == $contact_lenses_exam->left_eye_add ? 'selected' : '' }}>1.25</option>
                                <option name="left_eye_add" value="1.50" {{ 1.50 == $contact_lenses_exam->left_eye_add ? 'selected' : '' }}>1.50</option>
                                <option name="left_eye_add" value="1.75" {{ 1.75 == $contact_lenses_exam->left_eye_add ? 'selected' : '' }}>1.75</option>
                                <option name="left_eye_add" value="2.00" {{ 2.00 == $contact_lenses_exam->left_eye_add ? 'selected' : '' }}>2.00</option>
                                <option name="left_eye_add" value="2.25" {{ 2.25 == $contact_lenses_exam->left_eye_add ? 'selected' : '' }}>2.25</option>
                                <option name="left_eye_add" value="2.50" {{ 2.50 == $contact_lenses_exam->left_eye_add ? 'selected' : '' }}>2.50</option>
                                <option name="left_eye_add" value="2.75" {{ 2.75 == $contact_lenses_exam->left_eye_add ? 'selected' : '' }}>2.75</option>
                                <option name="left_eye_add" value="3.00" {{ 3.00 == $contact_lenses_exam->left_eye_add ? 'selected' : '' }}>3.00</option>
                            </select>
                        </div>
                    </div>
                    <hr>
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

