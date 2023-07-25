@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">
                <a href="{{ route('homeGlasses') }}" class="btn btn-primary form-control m-2">Svi klijenti</a>
                <a href="{{ route('home.showExaminationForm',['id'=>$single_client->id]) }}"
                   class="btn btn-light form-control m-2">{{ $single_client->name }} - Novi pregled</a>
            </div>
            <div class="col-1"></div>
            <div class="col-8">
                <h2 class="text-center m-5">{{ $single_client->name }} &nbsp; {{ $single_client->date_of_birth }}
                    &nbsp; {{ $single_client->city }}</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                @foreach($all_distances as $distance)
                    <div class="row">
                        <div class="col-3">
                            <label for="note">Napomena:</label>
                            <textarea style="background-color: rgb(200,200,200)" id="note" cols="10" rows="5"
                                      class="form-control mt-2" readonly>{{ $distance->note }}</textarea>
                        </div>
                        <div class="col-9">
                            <table class="table text-center table-bordered caption-top"
                                   style="background-color: rgb(200,200,200)">
                                <caption>{{ $distance->created_at->format('d. m. Y.') }}&nbsp;Daljina</caption>
                                <thead>
                                <tr>
                                    <th colspan="4">Right Eye</th>
                                    <th></th>
                                    <th colspan="4">Left Eye</th>
                                    <th></th>
                                    <th colspan="4"></th>
                                </tr>
                                <tr>
                                    <th>Sphere</th>
                                    <th>Cylinder</th>
                                    <th>Axis</th>
                                    <th>Pd</th>
                                    <th></th>
                                    <th>Sphere</th>
                                    <th>Cylinder</th>
                                    <th>Axis</th>
                                    <th>Pd</th>
                                    <th></th>
                                    <th>Total pd</th>
                                    <th>Exam</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ $distance->right_eye_sphere }}</td>
                                    <td>{{ $distance->right_eye_cylinder }}</td>
                                    <td>{{ $distance->right_eye_axis }}</td>
                                    <td>{{ $distance->right_eye_pd }}</td>
                                    <td></td>
                                    <td>{{ $distance->left_eye_sphere }}</td>
                                    <td>{{ $distance->left_eye_cylinder }}</td>
                                    <td>{{ $distance->left_eye_axis }}</td>
                                    <td>{{ $distance->left_eye_pd }}</td>
                                    <td></td>
                                    <td>{{ $distance->right_eye_pd + $distance->left_eye_pd }}</td>
                                    @if($distance->exam == 'green')
                                        <td style="background-color:#0f5907;"></td>
                                    @else
                                        <td style="background-color:#b82830;"></td>
                                    @endif
                                    <td></td>
                                    <td style="background-color: #ffc107;"><a
                                            href="/distance-form/{{$distance->id}}/edit"
                                            style="text-decoration: none; color: black; display: block" onclick="return confirm('Da li ste sigurni?')">Izmeni</a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
                @foreach($all_proximities as $proximity)
                    <div class="row">
                        <div class="col-3">
                            <label for="note">Napomena:</label>
                            <textarea id="note" cols="10" rows="5"
                                      class="form-control mt-2" readonly>{{ $proximity->note }}</textarea>
                        </div>
                        <div class="col-9">
                            <table class="table text-center table-bordered caption-top">
                                <caption>{{ $proximity->created_at->format('d. m. Y.') }}&nbsp;Blizina</caption>
                                <thead>
                                <tr>
                                    <th colspan="4">Right Eye</th>
                                    <th></th>
                                    <th colspan="4">Left Eye</th>
                                    <th></th>
                                    <th colspan="4"></th>
                                </tr>
                                <tr>
                                    <th>Sphere</th>
                                    <th>Cylinder</th>
                                    <th>Axis</th>
                                    <th>Pd</th>
                                    <th></th>
                                    <th>Sphere</th>
                                    <th>Cylinder</th>
                                    <th>Axis</th>
                                    <th>Pd</th>
                                    <th></th>
                                    <th>Total pd</th>
                                    <th>Exam</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ $proximity->right_eye_sphere }}</td>
                                    <td>{{ $proximity->right_eye_cylinder }}</td>
                                    <td>{{ $proximity->right_eye_axis }}</td>
                                    <td>{{ $proximity->right_eye_pd }}</td>
                                    <td></td>
                                    <td>{{ $proximity->left_eye_sphere }}</td>
                                    <td>{{ $proximity->left_eye_cylinder }}</td>
                                    <td>{{ $proximity->left_eye_axis }}</td>
                                    <td>{{ $proximity->left_eye_pd }}</td>
                                    <td></td>
                                    <td>{{ $proximity->right_eye_pd + $proximity->left_eye_pd }}</td>
                                    @if($proximity->exam == 'green')
                                        <td style="background-color:#0f5907;"></td>
                                    @endif
                                    @if($proximity->exam == 'red')
                                        <td style="background-color:#b82830;"></td>
                                    @endif
                                    <td></td>
                                    <td style="background-color: #ffc107;"
                                        onclick="return confirm('Da li ste sigurni?')"><a
                                            href="/proximity-form/{{$proximity->id}}/edit"
                                            style="text-decoration: none; color: black; display: block">Izmeni</a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>




@endsection
