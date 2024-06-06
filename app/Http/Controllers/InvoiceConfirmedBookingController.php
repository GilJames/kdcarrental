<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Selfdrive;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class InvoiceConfirmedBookingController extends Controller
{
    public function generateInvoice(Request $request)
    {
        $data = Booking::find($request->input('book_id'));

        $pdf = PDF::loadView('invoice', [
            'data' => $data,
        ]);

        return $pdf->stream('invoice.pdf');
        // return $pdf->download('invoice.pdf');
    }
    public function generateBookingReport(Request $request)
    {
        // Retrieve bookings data from the query parameter
        $bookingsData = json_decode($request->input('bookingsData'), true);

        // Check if decoding was successful and $bookingsData is an array
        if (is_array($bookingsData)) {
            // Your logic to generate the PDF using the $bookingsData

            // Example: Save to file
            // $pdf = PDF::loadView('pdf.booking-report', ['data' => $bookingsData]);
            // $pdf->save(storage_path('app/public/reports/report.pdf'));

            // // Example: Return as response
            // return $pdf->stream('report.pdf');

            return view('booking-reports-pdf', [
                'bookings' => $bookingsData
            ]);
        } else {
            // Handle the case where decoding fails
            return response()->json(['error' => 'Invalid JSON format'], 400);
        }
    }
    public function saveScreenshot(Request $request)
    {
        // Get the user ID
        $userId = auth()->user()->id;

        // Delete the existing file if it exists
        $existingPath = 'img/screenshot' . $userId . '.png';
        if (Storage::exists($existingPath)) {
            Storage::delete($existingPath);
        }

        // Save the new screenshot
        $base64Image = $request->input('image');
        $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Image));

        $path = 'img/screenshot' . $userId . '.png';
        Storage::put($path, $image);

        return response()->json(['message' => $path]);
    }

    public function take()
    {
        return view('livewire.is-admin.graph-template');
    }
}
