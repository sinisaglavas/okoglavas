@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">
                <a href="{{ route('homeGlasses') }}" class="btn btn-primary form-control m-2">Svi klijenti</a>
                <a href="{{ route('home.singleClient',['id'=>$single_client->id]) }}" class="btn btn-light form-control m-2">Klijent: {{ $single_client->name }}</a>
                @if(session()->has('message1'))
                    <div class="alert alert-info form-control m-2 text-center text-uppercase">
                        {{ session()->get('message1') }}
                    </div>
                @endif
                @if(session()->has('message2'))
                    <div class="alert alert-info form-control m-2 text-center text-uppercase">
                        {{ session()->get('message2') }}
                    </div>
                @endif
            </div>

            <div class="col-4 p-4 m-1" style="background-color: rgb(200,200,200)">
                <h2>Daljina</h2>
                <form action="{{ route('home.saveDistance',['id'=>$single_client->id]) }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-6">
                            <div>Right Eye</div>
                            <hr class="mt-1">
                            <label for="right-eye-sphere">Sphere</label>
                            <select name="right_diopter" class="form-control" id="right-eye-sphere">
                                @foreach($all_diopters as $diopter)
                                    <option name="right_eye_sphere" value="{{ $diopter->sphere_range}}" {{ $diopter->sphere_range == 0 ? 'selected' : '' }}>{{ $diopter->sphere_range }}</option>
                                @endforeach
                            </select>
                            <div class="row">
                                <div class="col-6">
                                    <label for="right-eye-cylinder">Cylinder</label>
                                    <select name="right_diopter2" class="form-control" id="right-eye-cylinder">
                                        @foreach($all_diopters as $diopter)
                                            <option name="right_eye_cylinder" value="{{ $diopter->cylinder_range }}" {{ $diopter->cylinder_range == 0 ? 'selected' : '' }}>{{ $diopter->cylinder_range }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="right-eye-axis">Axis</label>
                                    <select name="right_axis" class="form-control" id="right-eye-axis">
                                        @foreach($all_diopters as $diopter)
                                            <option name="right_eye_axis" value="{{ $diopter->axis_range }}">{{ $diopter->axis_range }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <label for="right-eye-pd">Pd</label>
                            <select name="right_pd" class="form-control" id="right-eye-pd">
                                @foreach($all_pd as $pd)
                                    <option name="right_eye_cylinder" value="{{ $pd->pd_range }}" {{ $pd->pd_range == 30 ? 'selected' : '' }}>{{ $pd->pd_range }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6">
                            <div>Left Eye</div>
                            <hr class="mt-1">
                            <label for="left-eye-sphere">Sphere</label>
                            <select name="left_diopter" class="form-control" id="left-eye-sphere">
                                @foreach($all_diopters as $diopter)
                                    <option name="left_eye_sphere" value="{{ $diopter->sphere_range}}" {{ $diopter->sphere_range == 0 ? 'selected' : '' }}>{{ $diopter->sphere_range }}</option>
                                @endforeach
                            </select>
                            <div class="row">
                                <div class="col-6">
                                    <label for="left-eye-cylinder">Cylinder</label>
                                    <select name="left_diopter2" class="form-control" id="left-eye-cylinder">
                                        @foreach($all_diopters as $diopter)
                                            <option name="left_eye_cylinder" value="{{ $diopter->cylinder_range }}" {{ $diopter->cylinder_range == 0 ? 'selected' : '' }}>{{ $diopter->cylinder_range }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="left-eye-axis">Axis</label>
                                    <select name="left_axis" class="form-control" id="left-eye-axis">
                                        @foreach($all_diopters as $diopter)
                                            <option name="right_eye_axis" value="{{ $diopter->axis_range }}">{{ $diopter->axis_range }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <label for="left-eye-pd">Pd</label>
                            <select name="left_pd" class="form-control" id="left-eye-pd">
                                @foreach($all_pd as $pd)
                                    <option name="left_eye_cylinder" value="{{ $pd->pd_range }}" {{ $pd->pd_range == 30 ? 'selected' : '' }}>{{ $pd->pd_range }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <label for="note1">Note:</label>
                    <textarea name="note" id="note1" cols="10" rows="4" class="form-control" maxlength="130" oninput="updateCharacterCount()" placeholder="Unos nije obavezan, max 130 karaktera"></textarea>
                    <div id="characterCount1" class="mb-2">Preostalo karaktera: 130</div>
                    <button name="green" value="green" class="btn btn-success form-control">Od optometrije Glavaš</button>
                    <br><br>
                    <button name="red" value="red" class="btn btn-danger form-control">Po receptu</button>
                </form>
            </div>
            <div class="col-4 border p-4 m-1">
                <h2>Blizina</h2>
                <form action="{{ route('home.saveProximity',['id'=>$single_client->id]) }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-6">
                            <div>Right Eye</div>
                            <hr class="mt-1">
                            <label for="right-eye-sphere">Sphere</label>
                            <select name="right_diopter" class="form-control" id="right-eye-sphere">
                                @foreach($all_diopters as $diopter)
                                    <option name="right_eye_sphere" value="{{ $diopter->sphere_range}}" {{ $diopter->sphere_range == 0 ? 'selected' : '' }}>{{ $diopter->sphere_range }}</option>
                                @endforeach
                            </select>
                            <div class="row">
                                <div class="col-6">
                                    <label for="right-eye-cylinder">Cylinder</label>
                                    <select name="right_diopter2" class="form-control" id="right-eye-cylinder">
                                        @foreach($all_diopters as $diopter)
                                            <option name="right_eye_cylinder" value="{{ $diopter->cylinder_range }}" {{ $diopter->cylinder_range == 0 ? 'selected' : '' }}>{{ $diopter->cylinder_range }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="right-eye-axis">Axis</label>
                                    <select name="right_axis" class="form-control" id="right-eye-axis">
                                        @foreach($all_diopters as $diopter)
                                            <option name="right_eye_axis" value="{{ $diopter->axis_range }}">{{ $diopter->axis_range }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <label for="right-eye-pd">Pd</label>
                            <select name="right_eye_pd" class="form-control" id="right-eye-pd">
                                @foreach($all_pd as $pd)
                                    <option name="right_eye_cylinder" value="{{ $pd->pd_range }}" {{ $pd->pd_range == 30 ? 'selected' : '' }}>{{ $pd->pd_range }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6">
                            <div>Left Eye</div>
                            <hr class="mt-1">
                            <label for="left-eye-sphere">Sphere</label>
                            <select name="left_diopter" class="form-control" id="left-eye-sphere">
                                @foreach($all_diopters as $diopter)
                                    <option name="left_eye_sphere" value="{{ $diopter->sphere_range}}" {{ $diopter->sphere_range == 0 ? 'selected' : '' }}>{{ $diopter->sphere_range }}</option>
                                @endforeach
                            </select>
                            <div class="row">
                                <div class="col-6">
                                    <label for="left-eye-cylinder">Cylinder</label>
                                    <select name="left_diopter2" class="form-control" id="left-eye-cylinder">
                                        @foreach($all_diopters as $diopter)
                                            <option name="left_eye_cylinder" value="{{ $diopter->cylinder_range }}" {{ $diopter->cylinder_range == 0 ? 'selected' : '' }}>{{ $diopter->cylinder_range }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="left-eye-axis">Axis</label>
                                    <select name="left_axis" class="form-control" id="left-eye-axis">
                                        @foreach($all_diopters as $diopter)
                                            <option name="right_eye_axis" value="{{ $diopter->axis_range }}">{{ $diopter->axis_range }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <label for="left-eye-pd">Pd</label>
                            <select name="left_eye_pd" class="form-control" id="left-eye-pd">
                                @foreach($all_pd as $pd)
                                    <option name="right_eye_cylinder" value="{{ $pd->pd_range }}" {{ $pd->pd_range == 30 ? 'selected' : '' }}>{{ $pd->pd_range }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <label for="note2">Note:</label>
                    <textarea name="note" id="note2" cols="10" rows="4" class="form-control" maxlength="130" oninput="updateCharacterCount1()" placeholder="Unos nije obavezan, max 130 karaktera"></textarea>
                    <div id="characterCount2" class="mb-2">Preostalo karaktera: 130</div>
                    <button name="green" value="green" class="btn btn-success form-control">Od optometrije Glavaš</button>
                    <br><br>
                    <button name="red" value="red" class="btn btn-danger form-control">Po receptu</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Opciono: Možete dodati brojač karaktera koji će prikazati koliko karaktera je ostalo za unos.
        function updateCharacterCount() {
            var textarea = document.getElementById('note1');
            var characterCount = document.getElementById('characterCount1');
            var remainingChars = 130 - textarea.value.length; // 130 je maksimalan broj karaktera minus broj unetih karaktera

            characterCount.textContent = 'Preostalo karaktera: ' + remainingChars; // Prikazuje preostali broj karaktera

            // Opciono: Možete dodati stilizaciju ili promeniti boju teksta kada se približite maksimalnom broju karaktera.
            if (remainingChars < 1) {
                characterCount.style.color = 'red';// Možete promeniti boju u crvenu kada premašite maksimalni broj karaktera.
                characterCount.style.fontWeight = 'bold'; // Možete promeniti font kada premašite maksimalni broj karaktera.
            } else {
                characterCount.style.color = ''; // Vraća boju na podrazumevanu vrednost.
                characterCount.style.fontWeight = ''; // Vraća font na podrazumevanu vrednost.
            }
        }

        // Opciono: Možete dodati brojač karaktera koji će prikazati koliko karaktera je ostalo za unos.
        function updateCharacterCount1() {
            var textarea = document.getElementById('note2');
            var characterCount = document.getElementById('characterCount2');
            var remainingChars = 130 - textarea.value.length; // 130 je maksimalan broj karaktera minus broj unetih karaktera

            characterCount.textContent = 'Preostalo karaktera: ' + remainingChars; // Prikazuje preostali broj karaktera

            // Opciono: Možete dodati stilizaciju ili promeniti boju teksta kada se približite maksimalnom broju karaktera.
            if (remainingChars < 1) {
                characterCount.style.color = 'red';// Možete promeniti boju u crvenu kada premašite maksimalni broj karaktera.
                characterCount.style.fontWeight = 'bold'; // Možete promeniti font kada premašite maksimalni broj karaktera.
            } else {
                characterCount.style.color = ''; // Vraća boju na podrazumevanu vrednost.
                characterCount.style.fontWeight = ''; // Vraća font na podrazumevanu vrednost.
            }
        }
    </script>
@endsection
