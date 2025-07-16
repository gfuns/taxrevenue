<?php
namespace App\Http\Controllers;

use App\Models\Company;
use Carbon\Carbon;
use PDF;

class CertificateController extends Controller
{
    /**
     * downloadCertificate
     *
     * @return void
     */
    public function downloadCertificate()
    {
        $reference  = "BSPPC-221752354411324";
        $company    = Company::where("reg_reference_number", $reference)->first();
        $date       = Carbon::parse($company->created_at); // Replace with your input date
        $expiryDate = $date->addYear();
        $qrcodeURL  = route("download.certificate", [$reference]);
        return view("certificate", compact("company", "expiryDate", "qrcodeURL"));

        view()->share(['company' => $company, 'expiryDate' => $expiryDate, 'qrcodeURL' => $qrcodeURL]);

        $pdf      = PDF::loadView('certificate');
        $fileName = "BSPPC Certificate.pdf";
        return $pdf->stream($fileName);
    }
}
