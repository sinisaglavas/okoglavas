@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">
                <a href="{{ route('homeContactLenses') }}" class="btn btn-danger form-control m-2">Svi klijenti</a>
                <a href="{{ route('home.showContactLensesExaminationForm',['id'=>$single_client->id]) }}"
                   class="btn btn-light form-control m-2">{{ $single_client->name }} - Novi pregled</a>
            </div>
            <div class="col-8">
                <h2 class="text-center m-5">{{ $single_client->name }} &nbsp; {{ $single_client->date_of_birth }}
                    &nbsp; {{ $single_client->city }}</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-10">
                @foreach($all_contact_lenses_exams as $contact_lenses_exam)

                    <table class="table text-center table-bordered caption-top"
                           style="background-color: rgb(200,200,200)">
                        <caption>{{ $contact_lenses_exam->created_at->format('d. m. Y.') }}&nbsp;Kontaktna sočiva recept</caption>
                        <thead>
                        <tr>
                            <th colspan="3">Right Eye</th>
                            <th></th>
                            <th colspan="3">Left Eye</th>
                            <th></th>
                            <th colspan="4"></th>
                        </tr>
                        <tr>
                            <th>Sphere</th>
                            <th>Cylinder</th>
                            <th>Axis</th>
                            <th></th>
                            <th>Sphere</th>
                            <th>Cylinder</th>
                            <th>Axis</th>
                            <th></th>
                            <th>Producer</th>
                            <th>Type</th>
                            <th>Base Curve</th>
                            <th>Diameter</th>
                            <th>Material</th>
                            <th>Packaging</th>
                            <th>Maximum Use</th>
                            <th>Exam</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ $contact_lenses_exam->right_eye_sphere }}</td>
                            <td>{{ $contact_lenses_exam->right_eye_cylinder }}</td>
                            <td>{{ $contact_lenses_exam->right_eye_axis }}</td>
                            <td></td>
                            <td>{{ $contact_lenses_exam->left_eye_sphere }}</td>
                            <td>{{ $contact_lenses_exam->left_eye_cylinder }}</td>
                            <td>{{ $contact_lenses_exam->left_eye_axis }}</td>
                            <td></td>
                            <td>{{ $contact_lenses_exam->producer }}</td>
                            <td>{{ $contact_lenses_exam->type }}</td>
                            <td>{{ $contact_lenses_exam->base_curve }}</td>
                            <td>{{ $contact_lenses_exam->diameter }}</td>
                            <td>{{ $contact_lenses_exam->material }}</td>
                            <td>{{ $contact_lenses_exam->packaging }}</td>
                            <td>{{ $contact_lenses_exam->maximum_use }}</td>
                            @if($contact_lenses_exam->exam == 'green')
                                <td style="background-color:#0f5907;"></td>
                            @else
                                <td style="background-color:#b82830;"></td>
                            @endif
                            <td></td>
                            <td style="background-color: #ffc107;" onclick="return confirm('Da li ste sigurni?')"><a href="/contact-lens-form/{{$contact_lenses_exam->id}}/edit" style="text-decoration: none; color: black; display: block">Izmeni</a></td>
                        </tr>
                        </tbody>
                @endforeach
            </div>
        </div>
    </div>




@endsection
