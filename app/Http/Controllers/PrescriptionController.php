<?php

namespace App\Http\Controllers;

use App\Models\Distance;
use App\Models\Proximity;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Client;

class PrescriptionController extends Controller
{
    public function generatePDF($id, $fromTable)
    {
        ini_set('max_execution_time', 300); // Povećava vreme izvršenja na 5 minuta

        session()->put('distance_prescription', true);

        // Provera iz koje tabele dolazi id
        if ($fromTable === 'distances') {
            // Pronađi podatke iz 'distances' tabele
            $distance = Distance::find($id);
            $patient = Client::findOrFail($distance->client_id);

            if ($distance) {
                // Proveri da li postoji podatak u 'proximities' sa istim datumom
                $proximity = Proximity::where('client_id', $distance->client_id)
                    ->whereDate('created_at', $distance->created_at) // Poredi samo datum
                    ->first();
                if ($proximity) {
                    $pdf = PDF::loadView('pdf.prescription', compact('patient', 'distance', 'proximity'));
                    return $pdf->stream("Recept-{$patient->name}.pdf");
                }
                // Ako ne postoji, vrati samo distance, a proximity je null
                $pdf = PDF::loadView('pdf.prescription', compact('patient', 'distance'));
                return $pdf->stream("Recept-{$patient->name}.pdf");

            }

        } elseif ($fromTable === 'proximities') {
            // Pronađi podatke iz 'proximities' tabele
            $proximity = Proximity::find($id);
            $patient = Client::findOrFail($proximity->client_id);

            if ($proximity) {
                // Proveri da li postoji podatak u 'distances' sa istim datumom
                $distance = Distance::where('client_id', $proximity->client_id)
                    ->whereDate('created_at', $proximity->created_at) // Poredi samo datum
                    ->first();

                if ($distance) {
                    $pdf = PDF::loadView('pdf.prescription', compact('patient', 'distance', 'proximity'));
                    return $pdf->stream("Recept-{$patient->name}.pdf");
                }

                // Ako ne postoji, vrati samo proximity, a distance je null
                $pdf = PDF::loadView('pdf.prescription', compact('patient', 'proximity'));
                return $pdf->stream("Recept-{$patient->name}.pdf");
            }
        }

    }

    public function proximityGeneratePDF($id)
    {
        ini_set('max_execution_time', 300); // Povećava vreme izvršenja na 5 minuta

        $proximity = Proximity::findOrFail($id);
        $patient = Client::findOrFail($proximity->client_id);
        session()->put('proximity_prescription', true);
        $pdf = PDF::loadView('pdf.prescription', compact('patient', 'proximity'));

        return $pdf->stream("Recept-{$patient->name}.pdf");
    }
}
