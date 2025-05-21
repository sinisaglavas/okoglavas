@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">
                <a href="{{ route('homeContactLenses') }}" class="btn btn-danger form-control m-2">Svi klijenti</a>
                <a href="{{ route('home.showContactLensesExaminationForm',['id'=>$single_client->id]) }}"
                   class="btn btn-light form-control m-2 border">{{ $single_client->name }} - Novi pregled</a>
            </div>
            <div class="col-8 mx-auto"> {{--mx-auto - polozaj na sredini--}}
                <h3 class="text-center m-2 p-3 border border rounded-pill">
                    <a class="fw-bold text-decoration-none text-uppercase text-danger" title="Klik za detalje o pacijentu" id="clientData"
                       data-id ="{{ $single_client->id }}"
                       href="{{ route('showContactLensesClientData', ['id'=>$single_client->id]) }}">{{ $single_client->name }}</a> &nbsp; &nbsp;{{ $single_client->date_of_birth }}</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-1"></div>
            <div class="col-11">
                @foreach($all_contact_lenses_exams as $contact_lenses_exam)

                    <table class="table text-center table-bordered border-dark caption-top"
                           style="background-color: rgb(252, 202, 211)">
                        <caption>{{ $contact_lenses_exam->created_at->format('d. m. Y.') }}&nbsp;Kontaktna sočiva recept</caption>
                        <thead>
                        <tr>
                            <th colspan="4">Desno oko - Right Eye</th>
                            <th></th>
                            <th colspan="4">Levo oko - Left Eye</th>
                            <th></th>
                            <th colspan="7">Specifikacije</th>
                            <th></th>
                            <th colspan="3"></th>
                        </tr>
                        <tr>
                            <th>Sphere</th>
                            <th>Cylinder</th>
                            <th>Axis</th>
                            <th>Add</th>
                            <th></th>
                            <th>Sphere</th>
                            <th>Cylinder</th>
                            <th>Axis</th>
                            <th>Add</th>
                            <th></th>
                            <th>Producer</th>
                            <th>Type</th>
                            <th>Base Curve</th>
                            <th>Diameter</th>
                            <th>Material</th>
                            <th>Packaging</th>
                            <th>Maximum Use</th>
                            <th></th>
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
                            <td>{{ $contact_lenses_exam->right_eye_add }}</td>
                            <td></td>
                            <td>{{ $contact_lenses_exam->left_eye_sphere }}</td>
                            <td>{{ $contact_lenses_exam->left_eye_cylinder }}</td>
                            <td>{{ $contact_lenses_exam->left_eye_axis }}</td>
                            <td>{{ $contact_lenses_exam->left_eye_add }}</td>
                            <td></td>
                            <td>{{ $contact_lenses_exam->producer }}</td>
                            <td>{{ $contact_lenses_exam->type }}</td>
                            <td>{{ $contact_lenses_exam->base_curve }}</td>
                            <td>{{ $contact_lenses_exam->diameter }}</td>
                            <td>{{ $contact_lenses_exam->material }}</td>
                            <td>{{ $contact_lenses_exam->packaging }}</td>
                            <td>{{ $contact_lenses_exam->maximum_use }}</td>
                            <td></td>
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

    <!-- Modalni prozor -->
    <div id="clientModal" style="display:none; position:fixed; top:30%; left:50%; transform:translate(-50%, -20%); background:dimgrey; color: white; padding:20px; border:1px solid black;">
        <h3>Osnovni podaci o pacijentu</h3>
        <p id="clientDetails"></p>
        <button onclick="closeModal()">Zatvori</button>
    </div>

    <script>

        document.addEventListener('DOMContentLoaded', function () {
            let clientData = document.getElementById('clientData');
            let clientId = clientData.getAttribute('data-id');

            clientData.addEventListener('click', function (event) {
                event.preventDefault(); // Sprečava osvežavanje stranice!Stranica se osvežava nakon klika.Ako je <a> tag ili <button> uzrokovao osvežavanje stranice, onda AJAX zahtev nestane pre nego što vidiš odgovor.
                fetch(`/show-contact-lenses-client-data/${clientId}`)
                    .then(response => response.json())
                    .then(data => {
                        console.log(data.phone);
                        document.getElementById('clientDetails').innerHTML =
                            `<span>Ime i prezime:</span> ${data.name} <br>
                            <span>Rođen/a:</span> ${data.date_of_birth} <br>
                            <span>Mesto boravka:</span> ${data.city} <br>
                            <span>Tel:</span> ${data.phone} <br>`;
                    })
                let clientModal = document.getElementById('clientModal');
                clientModal.style.display = 'block';
            })

        })

        function closeModal() {
            document.getElementById('clientModal').style.display = 'none';
        }
    </script>


@endsection
