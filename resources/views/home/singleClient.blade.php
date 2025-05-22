@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">
                <a href="{{ route('homeGlasses') }}" class="btn btn-primary form-control m-2">Svi klijenti</a>
                <a href="{{ route('home.showExaminationForm',['id'=>$single_client->id]) }}"
                   class="btn btn-light form-control m-2 border">{{ $single_client->name }} - Novi pregled</a>
            </div>
            <div class="col-8 mx-auto"> {{--mx-auto - polozaj na sredini--}}
                <h2 class="text-center m-2 p-3 border border rounded-pill">
                    <a class="fw-bold text-decoration-none text-uppercase text-primary" title="Klik za detalje o pacijentu" id="clientData"
                       data-id ="{{ $single_client->id }}"
                       href="{{ route('showClientData', ['id'=>$single_client->id]) }}">{{ $single_client->name }}</a>
                </h2>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12">
                @foreach($all_distances as $distance)
                    <div class="row mt-5 p-2 border" style="background-color: #e1e8f2">
                        <div class="col-9">
                            <div class="row">
                                <div class="col-4">
                                    <a href="{{ route('sendPDF', [$distance->id, 'distances']) }}" class="fw-bold float-end">Pošalji na mejl</a>
                                </div>
                                <div class="col-4">
                                    <a href="{{ route('requestedDay', ['date'=>$distance->created_at->format('Y-m-d'), 'client_id'=>$single_client->id]) }}"
                                       class="fw-bold float-end"
                                       title="Povežite prodati artikal sa pacijentom">Poveži prodaju sa kupcem
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href="{{ route('generatePDF', [$distance->id,'distances']) }}"
                                       class="fw-bold float-end" target="_blank">Štampa-PDF
                                    </a>
                                </div>
                            </div>
                            <table class="table text-center table-bordered border-dark caption-top">
                                <caption class="fw-bold text-uppercase pt-0">{{ $distance->created_at->format('d. m. Y.') }}&nbsp;Daljina</caption>
                                <thead>
                                <tr>
                                    <th colspan="4">Desno oko - Right Eye</th>
                                    <th></th>
                                    <th colspan="4">Levo oko - Left Eye</th>
                                    <th></th>
                                    <th colspan="6"></th>
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
                                    <th style="padding: 8px 0;"></th>
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
                                        <td style="background-color:#7aba2d;"></td>
                                    @else
                                        <td style="background-color:#b82830;"></td>
                                    @endif
                                    <td></td>
                                    <td style="background-color: #e09c09;"><a
                                            href="/distance-form/{{$distance->id}}/edit"
                                            style="text-decoration: none; color: #fff; display: block" onclick="return confirm('Da li ste sigurni?')">Promeni</a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-3">
                            <label for="note" class="mt-4">Napomena:</label>
                            <textarea id="note" cols="10" rows="5"
                                      class="form-control" readonly>{{ $distance->note }}</textarea>
                        </div>
                    </div>
                @endforeach
                @foreach($all_proximities as $proximity)
                    <div class="row mt-5 p-2 border">
                        <div class="col-9">
                            <div class="row justify-content-end">
                                <div class="col-4">
                                    <a href="{{ route('sendPDF', [$proximity->id, 'proximities']) }}" class="fw-bold float-end">Pošalji na mejl</a>
                                </div>
                                <div class="col-4">
                                    <a href="{{ route('requestedDay', ['date'=>$proximity->created_at->format('Y-m-d'), 'client_id'=>$single_client->id]) }}"
                                       class="fw-bold float-end"
                                       title="Povežite prodati artikal sa pacijentom">Poveži prodaju sa kupcem
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href="{{ route('generatePDF', [$proximity->id, 'proximities']) }}"
                                       class="fw-bold float-end" target="_blank">Štampa-PDF
                                    </a>
                                </div>
                            </div>
                            <table style="background-color: rgb(250, 250, 250)" class="table text-center table-bordered border-dark caption-top">
                                <caption class="fw-bold text-uppercase pt-0">{{ $proximity->created_at->format('d. m. Y.') }}&nbsp;Blizina</caption>
                                <thead>
                                <tr>
                                    <th colspan="4">Desno oko - Right Eye</th>
                                    <th></th>
                                    <th colspan="4">Levo oko - Left Eye</th>
                                    <th></th>
                                    <th colspan="6"></th>
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
                                        <td style="background-color:#7aba2d;"></td>
                                    @endif
                                    @if($proximity->exam == 'red')
                                        <td style="background-color:#b82830;"></td>
                                    @endif
                                    <td></td>
                                    <td style="background-color: #e09c09;"
                                        onclick="return confirm('Da li ste sigurni?')"><a
                                            href="/proximity-form/{{$proximity->id}}/edit"
                                            style="text-decoration: none; color: #fff; display: block" title="Izmenite unesene podatke">Promeni</a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-3">
                            <label for="note" class="mt-4">Napomena:</label>
                            <textarea style="background-color: rgb(250, 250, 250)" id="note" cols="10" rows="5"
                                      class="form-control mt-2" readonly>{{ $proximity->note }}</textarea>
                        </div>
                    </div>
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

    <!-- Feedback Modal -->
    <div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="feedbackModalLabel">Obaveštenje</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Zatvori"></button>
                </div>
                <div class="modal-body">
                    {{-- Dinamička poruka iz sesije --}}
                    {{ session('success') ?? session('error') }}
                </div>
            </div>
        </div>
    </div>
    @if(session('success') || session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const feedbackModal = new bootstrap.Modal(document.getElementById('feedbackModal'));
                feedbackModal.show();
            });
        </script>
    @endif

    <script>

    document.addEventListener('DOMContentLoaded', function () {
            let clientData = document.getElementById('clientData');
            let clientId = clientData.getAttribute('data-id');

            clientData.addEventListener('click', function (event) {
                event.preventDefault(); // Sprečava osvežavanje stranice!Stranica se osvežava nakon klika.Ako je <a> tag ili <button> uzrokovao osvežavanje stranice, onda AJAX zahtev nestane pre nego što vidiš odgovor.
                fetch(`/show-client-data/${clientId}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('clientDetails').innerHTML =
                            `<span>Ime i prezime:</span> ${data.name} <br>
                            <span>Rođen/a:</span> ${data.date_of_birth} <br>
                            <span>Mesto boravka:</span> ${data.city} <br>
                            <span>Tel:</span> ${data.phone} <br>
                            <span>Mail:</span> ${data.email} <br>`;
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
