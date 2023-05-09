@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4">
                <a href="{{ route('homeContactLenses') }}" class="btn btn-danger form-control m-2">Svi klijenti</a>
                <a href="{{ url('/home/single-contact-lenses-client',['id'=>$single_client->id])}}" class="btn btn-light form-control m-2">Klijent: {{ $single_client->name }}</a>
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
            @if(isset($suitable_contact_lenses))
            <div class="col-8 p-3" style="background-color: rgb(200,200,200);">
                <h5>Kontaktna sočiva - Pregled</h5>
                <div class="row">
                </div>
                <form action="{{ route('saveContactLensesForm',['id'=>$single_client->id]) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-2">
                            <label for="right-eye-sphere">R sph</label>
                            <select name="right_diopter" class="form-control form-control-sm" id="right-eye-sphere">
                                @foreach($all_diopters as $diopter)
                                    <option name="right_eye_sphere" value="{{ $diopter->sphere_range}}" {{ $diopter->sphere_range == 0 ? 'selected' : '' }}>{{ $diopter->sphere_range }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-2">
                            <label for="right-eye-cylinder">R cyl</label>
                            <select name="right_diopter2" class="form-control form-control-sm" id="right-eye-cylinder">
                                @foreach($all_diopters as $diopter)
                                    <option name="right_eye_cylinder" value="{{ $diopter->cylinder_range }}" {{ $diopter->cylinder_range == 0 ? 'selected' : '' }}>{{ $diopter->cylinder_range }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-2">
                            <label for="right-eye-axis">R ax</label>
                            <select name="right_axis" class="form-control form-control-sm" id="right-eye-axis">
                                @foreach($all_diopters as $diopter)
                                    <option name="right_eye_axis" value="{{ $diopter->axis_range }}">{{ $diopter->axis_range }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-2">
                            <label for="left-eye-sphere">L sph</label>
                            <select name="left_diopter" class="form-control form-control-sm" id="left-eye-sphere">
                                @foreach($all_diopters as $diopter)
                                    <option name="left_eye_sphere" value="{{ $diopter->sphere_range}}" {{ $diopter->sphere_range == 0 ? 'selected' : '' }}>{{ $diopter->sphere_range }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-2">
                            <label for="left-eye-cylinder">L cyl</label>
                            <select name="left_diopter2" class="form-control form-control-sm" id="left-eye-cylinder">
                                @foreach($all_diopters as $diopter)
                                    <option name="left_eye_cylinder" value="{{ $diopter->cylinder_range }}" {{ $diopter->cylinder_range == 0 ? 'selected' : '' }}>{{ $diopter->cylinder_range }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-2">
                            <label for="left-eye-axis">L ax</label>
                            <select name="left_axis" class="form-control form-control-sm" id="left-eye-axis">
                                @foreach($all_diopters as $diopter)
                                    <option name="left_eye_axis" value="{{ $diopter->axis_range }}">{{ $diopter->axis_range }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-3">
                                    <label for="type">Type</label>
                                    <input readonly name="type" class="form-control form-control-sm" id="type" value="{{ $suitable_contact_lenses->type }}">
                                </div>
                                <div class="col-3">
                                    <label for="producer">Producer</label>
                                    <input readonly name="producer" class="form-control form-control-sm" id="producer" value="{{ $suitable_contact_lenses->producer }}">
                                </div>
                                <div class="col-3">
                                    <label for="base_curve">Base curve</label>
                                    <input readonly name="base_curve" class="form-control form-control-sm" id="base_curve" value="{{ $suitable_contact_lenses->base_curve }}">
                                </div>
                                <div class="col-3">
                                    <label for="diameter">Diameter</label>
                                    <input readonly name="diameter" class="form-control form-control-sm" id="diameter" value="{{ $suitable_contact_lenses->diameter }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-4">
                                    <label for="material">Material</label>
                                    <input readonly name="material" class="form-control form-control-sm" id="material" value="{{ $suitable_contact_lenses->material }}">
                                </div>
                                <div class="col-4">
                                    <label for="packaging">Packaging</label>
                                    <input readonly name="packaging" class="form-control form-control-sm" id="packaging" value="{{ $suitable_contact_lenses->packaging }}">
                                </div>
                                <div class="col-4">
                                    <label for="maximum_use">Max use</label>
                                    <input readonly name="maximum_use" class="form-control form-control-sm" id="maximum_use" value="{{ $suitable_contact_lenses->maximum_use }}">
                                </div>
                            </div>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-6">
                            <button name="green" value="green" class="btn btn-success form-control">By optometry Glavas</button>
                        </div>
                        <div class="col-6">
                            <button name="red" value="red" class="btn btn-danger form-control">By prescription</button>
                        </div>
                    </div>
                </form>
            </div>
            @else
                <div class="col-8 p-3 text-center"><h5 class="text-bg-danger">Click on the contact lens type to activate the preview form !</h5></div>
            @endif
        </div><br>
        <div class="row">
            <div class="col-12 m-2">
                <div class="row">
                    <div class="col-8"><h2>Sva kontaktna sočiva</h2></div>
                    <div class="col-4">
                        <form action="{{ route('searchContactLensesType',['id'=>$single_client->id]) }}" method="POST">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="type" class="form-control" placeholder="Traži tip kontaktnih sočiva (Type)" aria-label="Search contact lenses type">
                                <input type="submit" class="btn btn-outline-secondary" value="Traži">
                            </div>
                        </form>
                    </div>
                </div><br>
                @if(isset($search_contact_lenses))
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Type</th>
                            <th>Producer</th>
                            <th>Base curve</th>
                            <th>Diameter</th>
                            <th>Material</th>
                            <th>Packaging</th>
                            <th>Maximum use</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($search_contact_lenses as $scl)
                            <tr>
                                <td>{{ $scl->id }}</td>
                                <td><a href="{{ route('suitableContactLenses',['id'=>$scl->id, 'client_id'=>$single_client->id]) }}">{{ $scl->type }}</a></td>
                                <td>{{ $scl->producer }}</a></td>
                                <td>{{ $scl->base_curve }}</td>
                                <td>{{ $scl->diameter }}</td>
                                <td>{{ $scl->material }}</td>
                                <td>{{ $scl->packaging }}</a></td>
                                <td>{{ $scl->maximum_use }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
                <table class="table table-hover table-bordered text-center">
                    <thead>
                    <tr class="table-secondary">
                        <th>Id</th>
                        <th>Type</th>
                        <th>Producer</th>
                        <th>Base curve</th>
                        <th>Diameter</th>
                        <th>Material</th>
                        <th>Packaging</th>
                        <th>Maximum use</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($contact_lenses as $cl)
                        <tr>
                            <td>{{ $cl->id }}</td>
                            <td><a href="{{ route('suitableContactLenses',['id'=>$cl->id, 'client_id'=>$single_client->id]) }}" class="text-decoration-none text-danger">{{ $cl->type }}</a></td>
                            <td>{{ $cl->producer }}</a></td>
                            <td>{{ $cl->base_curve }}</td>
                            <td>{{ $cl->diameter }}</td>
                            <td>{{ $cl->material }}</td>
                            <td>{{ $cl->packaging }}</a></td>
                            <td>{{ $cl->maximum_use }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
