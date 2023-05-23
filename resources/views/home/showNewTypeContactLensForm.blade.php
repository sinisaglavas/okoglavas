@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3">
            <a href="{{ route('homeContactLenses') }}" class="btn btn-danger form-control mb-5">Svi klijenti</a>
            <h5>Unesi novi tip kontaktnih sočiva</h5>
            <form action="{{ route('home.saveContactLensTypeForm') }}" method="POST">
                @csrf
                <label for="producer">Proizvođač</label>
                <input type="text" name="producer" id="producer" class="form-control"  placeholder="Unos je obavezan" required>
                <label for="type">Tip</label>
                <input type="text" name="type" id="type" class="form-control" placeholder="Unos je obavezan" required>
                <div class="row">
                    <div class="col">
                        <label for="base-curve">Bazna krivina</label>
                        <select name="base_curve" id="base-curve" class="form-control mb-3">
                            <option value="7.00">7.00</option>
                            <option value="7.10">7.10</option>
                            <option value="7.20">7.20</option>
                            <option value="7.30">7.30</option>
                            <option value="7.40">7.40</option>
                            <option value="7.50">7.50</option>
                            <option value="7.60">7.60</option>
                            <option value="7.70">7.70</option>
                            <option value="7.80">7.80</option>
                            <option value="7.90">7.90</option>
                            <option value="8.00">8.00</option>
                            <option value="8.10">8.10</option>
                            <option value="8.20">8.20</option>
                            <option value="8.30">8.30</option>
                            <option value="8.40">8.40</option>
                            <option value="8.50">8.50</option>
                            <option value="8.60" selected>8.60</option>
                            <option value="8.70">8.70</option>
                            <option value="8.80">8.80</option>
                            <option value="8.90">8.90</option>
                            <option value="9.00">9.00</option>
                            <option value="8.30/8.60">8.30/8.60</option>
                            <option value="8.40/8.70">8.40/8.70</option>
                            <option value="8.50/8.70">8.50/8.70</option>
                            <option value="8.50/8.80">8.50/8.80</option>
                            <option value="8.60/8.90">8.60/8.90</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="diameter">Dijametar</label>
                        <select name="diameter" id="diameter" class="form-control mb-3">
                            <option value="13.00">13.00</option>
                            <option value="13.10">13.10</option>
                            <option value="13.20">13.20</option>
                            <option value="13.30">13.30</option>
                            <option value="13.40">13.40</option>
                            <option value="13.50">13.50</option>
                            <option value="13.60">13.60</option>
                            <option value="13.70">13.70</option>
                            <option value="13.80">13.80</option>
                            <option value="13.90">13.90</option>
                            <option value="14.00">14.00</option>
                            <option value="14.10">14.10</option>
                            <option value="14.20" selected>14.20</option>
                            <option value="14.30">14.30</option>
                            <option value="14.40">14.40</option>
                            <option value="14.50">14.50</option>
                            <option value="14.60">14.60</option>
                            <option value="14.70">14.70</option>
                            <option value="14.80">14.80</option>
                            <option value="14.90">14.90</option>
                            <option value="15.00">15.00</option>
                            <option value="14.40/14.50">14.40/14.50</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="packaging">Pakovanje</label>
                        <select name="packaging" id="packaging" class="form-control mb-3">
                            <option value="1 pcs">1 kom.</option>
                            <option value="2 pcs">2 kom.</option>
                            <option value="3 pcs">3 kom.</option>
                            <option value="6 pcs" selected>6 kom.</option>
                            <option value="30 pcs">30 kom.</option>
                            <option value="3/6 pcs">3/6 kom.</option>
                        </select>
                    </div>
                </div>
                <label for="material">Materijal</label>
                <input type="text" name="material" id="material" class="form-control" placeholder="Unos je obavezan" required>

                <label for="maximum_use">Maksimalna upotreba</label>
                <select name="maximum_use" id="maximum_use" class="form-control mb-3">
                    <option value="monthly" selected>Mesečna</option>
                    <option value="three-month">Tromesečna</option>
                    <option value="6 month">Šestomesečna</option>
                    <option value="yearly">Godišnja</option>
                    <option value="daily">Dnevna</option>
                </select>
                <button type="submit" class="btn btn-danger form-control">Zapamti</button>
            </form>
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
        </div>
        <div class="col-1"></div>
        <div class="col-8">
            <h2 class="text-center">Pregled Kontaktnih sočiva</h2><br>
            <table class="table table-bordered table-striped text-center">
                <thead>
                <tr class="table-danger">
                    <th>Id</th>
                    <th>Proizvođač</th>
                    <th>Tip</th>
                    <th>Bazna krivina</th>
                    <th>Dijametar</th>
                    <th>Materijal</th>
                    <th>Pakovanje</th>
                    <th>Maksimalna upotreba</th>
                </tr>
                </thead>
                <tbody>
                @foreach($all_contact_lenses as $contact_lenses)
                    <tr>
                        <td>{{ $contact_lenses->id }}</td>
                        <td>{{ $contact_lenses->producer }}</td>
                        <td>{{ $contact_lenses->type }}</td>
                        <td>{{ $contact_lenses->base_curve }}</td>
                        <td>{{ $contact_lenses->diameter }}</td>
                        <td>{{ $contact_lenses->material }}</td>
                        <td>{{ $contact_lenses->packaging }}</td>
                        <td>{{ $contact_lenses->maximum_use }}</td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection


