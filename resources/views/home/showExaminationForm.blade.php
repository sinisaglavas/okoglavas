@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4">
                <a href="{{ route('homeGlasses') }}" class="btn btn-primary form-control m-2">Svi klijenti</a>
                <a href="{{ route('home.singleClient',['id'=>$single_client->id]) }}" class="btn btn-light form-control m-2">Klijent: {{ $single_client->name }}</a>
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
                    <select name="right_diopter" class="form-control" id="right-eye-sphere">
                        @foreach($all_diopters as $diopter)
                        <option name="right_eye_sphere" value="{{ $diopter->sphere_range}}" {{ $diopter->sphere_range == 0 ? 'selected' : '' }}>{{ $diopter->sphere_range }}</option>
                        @endforeach
                    </select>
                    <div class="row">
                        <div class="col-6">
                            <label for="right-eye-cylinder">Right eye cylinder</label>
                            <select name="right_diopter2" class="form-control" id="right-eye-cylinder">
                                @foreach($all_diopters as $diopter)
                                    <option name="right_eye_cylinder" value="{{ $diopter->cylinder_range }}" {{ $diopter->cylinder_range == 0 ? 'selected' : '' }}>{{ $diopter->cylinder_range }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="right-eye-axis">Right eye axis</label>
                            <select name="right_axis" class="form-control" id="right-eye-axis">
                                @foreach($all_diopters as $diopter)
                                    <option name="right_eye_axis" value="{{ $diopter->axis_range }}">{{ $diopter->axis_range }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <label for="right-eye-pd">Right eye pd</label>
                    <select name="right_eye_pd" class="form-control" id="right-eye-pd">
                        @foreach($all_pd as $pd)
                            <option name="right_eye_cylinder" value="{{ $pd->pd_range }}" {{ $pd->pd_range == 30 ? 'selected' : '' }}>{{ $pd->pd_range }}</option>
                        @endforeach
                    </select><br>
                    <label for="left-eye-sphere">Left eye sphere</label>
                    <select name="left_diopter" class="form-control" id="left-eye-sphere">
                        @foreach($all_diopters as $diopter)
                            <option name="left_eye_sphere" value="{{ $diopter->sphere_range}}" {{ $diopter->sphere_range == 0 ? 'selected' : '' }}>{{ $diopter->sphere_range }}</option>
                        @endforeach
                    </select>

                    <div class="row">
                        <div class="col-6">
                            <label for="left-eye-cylinder">Left eye cylinder</label>
                            <select name="left_diopter2" class="form-control" id="left-eye-cylinder">
                                @foreach($all_diopters as $diopter)
                                    <option name="left_eye_cylinder" value="{{ $diopter->cylinder_range }}" {{ $diopter->cylinder_range == 0 ? 'selected' : '' }}>{{ $diopter->cylinder_range }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="left-eye-axis">Left eye axis</label>
                            <select name="left_axis" class="form-control" id="left-eye-axis">
                                @foreach($all_diopters as $diopter)
                                    <option name="right_eye_axis" value="{{ $diopter->axis_range }}">{{ $diopter->axis_range }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <label for="left-eye-pd">Left eye pd</label>
                    <select name="left_eye_pd" class="form-control" id="left-eye-pd">
                        @foreach($all_pd as $pd)
                            <option name="right_eye_cylinder" value="{{ $pd->pd_range }}" {{ $pd->pd_range == 30 ? 'selected' : '' }}>{{ $pd->pd_range }}</option>
                        @endforeach
                    </select><br>
                    <button name="green" value="green" class="btn btn-success form-control">By optometry Glavas</button>
                    <br><br>
                    <button name="red" value="red" class="btn btn-danger form-control">By prescription</button>
                </form>
            </div>


            <div class="col-3 border p-2 m-1">
                <h2>Proximity</h2>
                <form action="{{ route('home.saveProximity',['id'=>$single_client->id]) }}" method="POST">
                    @csrf
                    <label for="right-eye-sphere">Right eye sphere</label>
                    <select name="right_diopter" class="form-control" id="right-eye-sphere">
                        @foreach($all_diopters as $diopter)
                            <option name="right_eye_sphere" value="{{ $diopter->sphere_range}}" {{ $diopter->sphere_range == 0 ? 'selected' : '' }}>{{ $diopter->sphere_range }}</option>
                        @endforeach
                    </select>
                    <div class="row">
                        <div class="col-6">
                            <label for="right-eye-cylinder">Right eye cylinder</label>
                            <select name="right_diopter2" class="form-control" id="right-eye-cylinder">
                                @foreach($all_diopters as $diopter)
                                    <option name="right_eye_cylinder" value="{{ $diopter->cylinder_range }}" {{ $diopter->cylinder_range == 0 ? 'selected' : '' }}>{{ $diopter->cylinder_range }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="right-eye-axis">Right eye axis</label>
                            <select name="right_axis" class="form-control" id="right-eye-axis">
                                @foreach($all_diopters as $diopter)
                                    <option name="right_eye_axis" value="{{ $diopter->axis_range }}">{{ $diopter->axis_range }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <label for="right-eye-pd">Right eye pd</label>
                    <select name="right_eye_pd" class="form-control" id="right-eye-pd">
                        @foreach($all_pd as $pd)
                            <option name="right_eye_cylinder" value="{{ $pd->pd_range }}" {{ $pd->pd_range == 30 ? 'selected' : '' }}>{{ $pd->pd_range }}</option>
                        @endforeach
                    </select><br>
                    <label for="left-eye-sphere">Left eye sphere</label>
                    <select name="left_diopter" class="form-control" id="left-eye-sphere">
                        @foreach($all_diopters as $diopter)
                            <option name="left_eye_sphere" value="{{ $diopter->sphere_range}}" {{ $diopter->sphere_range == 0 ? 'selected' : '' }}>{{ $diopter->sphere_range }}</option>
                        @endforeach
                    </select>
                    <div class="row">
                        <div class="col-6">
                            <label for="left-eye-cylinder">Left eye cylinder</label>
                            <select name="left_diopter2" class="form-control" id="left-eye-cylinder">
                                @foreach($all_diopters as $diopter)
                                    <option name="left_eye_cylinder" value="{{ $diopter->cylinder_range }}" {{ $diopter->cylinder_range == 0 ? 'selected' : '' }}>{{ $diopter->cylinder_range }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="left-eye-axis">Left eye axis</label>
                            <select name="left_axis" class="form-control" id="left-eye-axis">
                                @foreach($all_diopters as $diopter)
                                    <option name="right_eye_axis" value="{{ $diopter->axis_range }}">{{ $diopter->axis_range }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <label for="left-eye-pd">Left eye pd</label>
                    <select name="left_eye_pd" class="form-control" id="left-eye-pd">
                        @foreach($all_pd as $pd)
                            <option name="right_eye_cylinder" value="{{ $pd->pd_range }}" {{ $pd->pd_range == 30 ? 'selected' : '' }}>{{ $pd->pd_range }}</option>
                        @endforeach
                    </select><br>
                    <button name="green" value="green" class="btn btn-success form-control">By optometry Glavas</button>
                    <br><br>
                    <button name="red" value="red" class="btn btn-danger form-control">By prescription</button>
                </form>
            </div>
        </div>
    </div>
@endsection
