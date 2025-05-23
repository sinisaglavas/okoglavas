<?php

namespace App\Http\Controllers;

use App\Mail\SendClientReportMail;
use App\Models\Distance;
use App\Models\Proximity;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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

    // Prikaz i upravljanje nalozima ili klijentima-tamo gde sistem pokrece slanje nalaza emailom
    public function sendPDF($id, $fromTable)
    {
        if ($fromTable === 'distances') {
            $distance = Distance::findOrFail($id);
            $patient = Client::findOrFail($distance->client_id);
            $proximity = Proximity::where('client_id', $distance->client_id)
                ->whereDate('created_at', $distance->created_at)
                ->first();
            return $this->generateAndSend($patient, $distance, $proximity);
        }

        if ($fromTable === 'proximities') {
            $proximity = Proximity::findOrFail($id);
            $patient = Client::findOrFail($proximity->client_id);
            $distance = Distance::where('client_id', $proximity->client_id)
                ->whereDate('created_at', $proximity->created_at)
                ->first();
            return $this->generateAndSend($patient, $distance, $proximity);
        }

        return back()->with('error', 'Nepoznat izvor podataka.');
    }

    private function generateAndSend($patient, $distance = null, $proximity = null)
    {
        if (!$patient->email) {
            return back()->with('error', 'Nije poslato! Nedostaje mail pacijenta!'); // session
        }

        $pdf = PDF::loadView('pdf.prescription', compact('patient', 'distance', 'proximity'));
        $pdfPath = storage_path("app/temp/prescription_{$patient->id}.pdf");
        $pdf->save($pdfPath);
        //Log::info('PDF mail poslat klijentu: ' . $patient->email);

        $email = trim($patient->email); // ukloni razmake pre/posle
        Mail::to($email)->send(new SendClientReportMail($pdfPath));

        unlink($pdfPath);

        return back()->with('success', 'Nalaz je poslat pacijentu na mail.'); // session
    }

}
