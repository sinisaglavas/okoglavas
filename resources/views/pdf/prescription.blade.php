<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Recept za naočare</title>
</head>

<style>
    body {
        font-family: " DejaVu Sans, sans-serif, Helvetica, Arial, sans-serif", 'serif';
    }


    #leftbox {
        float: left;
        width: 20%;
    }

    #leftbox img {
        max-width: 95%; /* Dodaj logo ako imaš */
        border-radius: 7px;
    }

    #middlebox {
        float: left;
        width: 39%;
        font-size: 11px;
    }

    #middlebox span {
        display: block;
    }

    #rightbox {
        float: right;
        width: 40%;
        font-size: 11px;
    }

    .optom {
        text-align: center;
    }
    .title {
        font-size: 24px;
    }

    .patient-info, .prescription-details {
        margin-bottom: 20px;
    }
    .prescription-details table {
        width: 100%;
    }

    .prescription-details table th {
        text-align: center;
    }

    .prescription-details th, .prescription-details td {
        border: 1px solid gray;
        padding: 8px;
        text-align: center;

    }

    .doctor-signature {
        text-align: right;
        margin-top: 30px;
        font-style: italic;
    }
</style>

<body>

    <div class="prescription-container">
        <div class="header">
            <div id="leftbox"><img src="{{ public_path('images/logooptika.jpg') }}" alt="Logo Optika"></div> <!-- Ako imaš logo -->
            <div id="middlebox"><span>NOVI SAD, Kornelija Stankovića 27, 060/5590883</span>
                                <span>NOVI SAD, Dalmatinska 31, 063/1190990</span><br>
                                <span>optikaglavas.com</span></div>
            <div id="rightbox"><span>BAČKA PALANKA, Kralja Petra I 28, 060/5590990</span>
                                <span>FUTOG, Rade Kondića 2, 060/5590882</span></div>
        </div>
        <div style="clear: both;"></div> {{-- div ispod koji će "očistiti" float --}}
        <div class="optom">
            <p class="title">Optometrijska Ordinacija i Optika</p>
        </div>
        <div class="patient-info">
            <p><strong>Datum pregleda:</strong> {{ $patient->created_at->format('d.m.Y.') }}</p>
            <p><strong>Pacijent:</strong> {{ $patient->name }}, &nbsp;rođ:{{ $patient->date_of_birth }}</p>
            <br>
            <h3>Detalji recepta</h3>
        </div>
        @if(isset($distance))
        <div class="prescription-details">
            <p>Korekcija za DALJINU</p>
            <table>
                <thead>
                <tr>
                    <th colspan="4">Desno oko</th>
                    <th></th>
                    <th colspan="4">Levo oko</th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <th>Sph</th>
                    <th>Cyl</th>
                    <th>Ax</th>
                    <th>Pd</th>
                    <th></th>
                    <th>Sph</th>
                    <th>Cyl</th>
                    <th>Ax</th>
                    <th>Pd</th>
                    <th></th>
                    <th>Total pd</th>
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
                </tr>
                </tbody>
            </table>
        </div>
        @endif
        @if(isset($proximity))
            <div class="prescription-details">
                <p>Korekcija za BLIZINU</p>
                <table>
                    <thead>
                    <tr>
                        <th colspan="4">Desno oko</th>
                        <th></th>
                        <th colspan="4">Levo oko</th>
                        <th></th>
                        <th></th>
                    </tr>
                    <tr>
                        <th>Sph</th>
                        <th>Cyl</th>
                        <th>Ax</th>
                        <th>Pd</th>
                        <th></th>
                        <th>Sph</th>
                        <th>Cyl</th>
                        <th>Ax</th>
                        <th>Pd</th>
                        <th></th>
                        <th>Total pd</th>
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
                    </tr>
                    </tbody>
                </table>
            </div>
        @endif
        <div class="doctor-signature">
            <p>______________________</p>
            <p>Optom. Ime Prezime</p>
        </div>
    </div>
</body>
</html>










