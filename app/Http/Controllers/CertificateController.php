<?php
namespace App\Http\Controllers;

use App\Models\Company;
use Carbon\Carbon;

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
        return view("certificate", compact("company", "expiryDate"));
    }
}
