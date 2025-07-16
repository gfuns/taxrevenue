<?php
namespace App\Http\Controllers;

use App\Models\Company;
use Carbon\Carbon;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CertificateController extends Controller
{
    /**
     * downloadCertificate
     *
     * @return void
     */
    public function downloadCertificate($reference)
    {
        $company    = Company::where("reg_reference_number", $reference)->first();
        $date       = Carbon::parse($company->created_at); // Replace with your input date
        $expiryDate = $date->addYear();
        $qrcodeURL  = route("download.certificate", [$reference]);

        $fileName = 'qrcode_' . $reference . '.png'; // Unique file name for each QR code
        $filePath = public_path('qrcodes/' . $fileName);
        QrCode::format('png')->size(300)->generate($qrcodeURL, $filePath);
        // return view("certificate", compact("company", "expiryDate", "qrcodeURL", "fileName"));

        view()->share(['company' => $company, 'expiryDate' => $expiryDate, 'qrcodeURL' => $qrcodeURL, "fileName" => $fileName]);

        $pdf      = PDF::loadView('certificate');
        $fileName = "BSPPC Certificate.pdf";
        return $pdf->stream($fileName);
    }
}
