@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">
                <a href="{{ route('homeGlasses') }}" class="btn btn-primary form-control m-2">Home/Glasses</a>
                <a href="{{ route('home.showExaminationForm',['id'=>$single_client->id]) }}" class="btn btn-light form-control m-2">{{ $single_client->name }} - New Exam</a>
            </div>
            <div class="col-1"></div>
            <div class="col-8">
                <h2 class="text-center m-5">{{ $single_client->name }} &nbsp; {{ $single_client->date_of_birth }} &nbsp; {{ $single_client->city }}</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-4"></div>
            <div class="col-8">
                @foreach($all_distances as $distance)
               <table class="table text-center table-bordered caption-top" style="background-color: rgb(200,200,200)">
                   <caption>{{ $distance->created_at->format('d. m. Y.') }}&nbsp;Distance</caption>
                   <thead>
                   <tr>
                       <th>Right eye sphere</th>
                       <th>Right eye cylinder</th>
                       <th>Right eye axis</th>
                       <th>Right eye pd</th>
                       <th></th>
                       <th>Left eye Sphere</th>
                       <th>Left eye cylinder</th>
                       <th>Left eye axis</th>
                       <th>Left eye pd</th>
                       <th></th>
                       <th>Total pd</th>
                       <th>Exam</th>
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

                   </tr>
                   </tbody>
                @endforeach
                   @foreach($all_proximities as $proximity)
               </table>
                    <table class="table text-center table-bordered caption-top">
                        <caption>{{ $proximity->created_at->format('d. m. Y.') }}&nbsp;Proximity</caption>
                        <thead>
                        <tr>
                            <th>Right eye sphere</th>
                            <th>Right eye cylinder</th>
                            <th>Right eye axis</th>
                            <th>Right eye pd</th>
                            <th></th>
                            <th>Left eye Sphere</th>
                            <th>Left eye cylinder</th>
                            <th>Left eye axis</th>
                            <th>Left eye pd</th>
                            <th></th>
                            <th>Total pd</th>
                            <th>Exam</th>
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
                       </tr>
                       </tbody>
                    </table>
                @endforeach
            </div>
        </div>
    </div>




@endsection
