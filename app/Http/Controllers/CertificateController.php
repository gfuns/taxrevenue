<?php
namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyRenewals;
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
    public function downloadCertificate($bsppcno)
    {
        $companyId  = preg_replace("/-/", "/", $bsppcno);
        $company    = Company::where("bsppc_number", $companyId)->first();
        $date       = Carbon::parse($company->created_at); // Replace with your input date
        $expiryDate = $date->addYear();
        $qrcodeURL  = route("download.certificate", [$bsppcno]);

        $fileName = 'qrcode_' . $bsppcno . '.png'; // Unique file name for each QR code
        $filePath = public_path('qrcodes/' . $fileName);
        QrCode::format('png')->size(300)->generate($qrcodeURL, $filePath);
        // return view("certificate", compact("company", "expiryDate", "qrcodeURL", "fileName"));

        view()->share(['company' => $company, 'expiryDate' => $expiryDate, 'qrcodeURL' => $qrcodeURL, "fileName" => $fileName]);

        $pdf      = PDF::loadView('certificate');
        $fileName = "BSPPC Certificate " . preg_replace("/-/", "", $bsppcno) . ".pdf";
        return $pdf->download($fileName);
    }

    /**
     * downloadRenewalCert
     *
     * @param mixed bsppcno
     *
     * @return void
     */
    public function downloadRenewalCert($reference)
    {
        $refNo      = preg_replace("/-/", "", $reference);
        $renewal    = CompanyRenewals::where("reference_number", $reference)->first();
        $company    = Company::find($renewal->company_id);
        $date       = Carbon::parse($renewal->created_at); // Replace with your input date
        $expiryDate = $date->addYear($renewal->period);
        $qrcodeURL  = route("download.downloadRenewalCert", [$refNo]);

        $fileName = 'qrcode_' . $refNo . '.png'; // Unique file name for each QR code
        $filePath = public_path('qrcodes/' . $fileName);
        QrCode::format('png')->size(300)->generate($qrcodeURL, $filePath);
        // return view("renewal_certificate", compact("company", "expiryDate", "qrcodeURL", "fileName", "renewal"));

        view()->share(['renewal_certificate' => $company, 'expiryDate' => $expiryDate, 'renewal' => $renewal, 'qrcodeURL' => $qrcodeURL, "fileName" => $fileName]);

        $pdf      = PDF::loadView('renewal_certificate');
        $fileName = "BSPPC Renewal Certificate " . preg_replace("/-/", "", $refNo) . ".pdf";
        return $pdf->download($fileName);
    }

    public function viewCertificate($bsppcno)
    {

        $companyId = preg_replace("/-/", "/", $bsppcno);
        $company   = Company::where("bsppc_number", $companyId)->first();

        $renewal = CompanyRenewals::orderBy("id", "desc")->where("company_id", $company->id)->where("status", "approved")->first();

        if (isset($renewal) && ! empty($renewal)) {
            $date       = Carbon::parse($renewal->created_at); // Replace with your input date
            $expiryDate = $date->addYear($renewal->period);

        } else {
            $date       = Carbon::parse($company->created_at); // Replace with your input date
            $expiryDate = $date->addYear();
        }

        $qrcodeURL = route("business.viewCertificate", [$bsppcno]);

        $fileName = 'qrcode_' . $bsppcno . '.png'; // Unique file name for each QR code
        $filePath = public_path('qrcodes/' . $fileName);
        QrCode::format('png')->size(300)->generate($qrcodeURL, $filePath);
        // return view("renewal_certificate", compact("company", "expiryDate", "qrcodeURL", "fileName"));

        view()->share(['company' => $company, 'expiryDate' => $expiryDate, 'qrcodeURL' => $qrcodeURL, "fileName" => $fileName]);

        $pdf      = PDF::loadView('renewal_certificate');
        $fileName = "BSPPC Certificate " . preg_replace("/-/", "", $bsppcno) . ".pdf";
        return $pdf->stream($fileName);
    }
}
