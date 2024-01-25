<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CableProvider extends Model
{
    use HasFactory;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'id',
        'fee',
        'status',
        'created_at',
        'updated_at',
    ];

    public static function retrieveCablePlans($serviceId)
    {
        try {

            $provida = CableProvider::where("service_id", $serviceId)->first();

            $curl = curl_init();

            curl_setopt_array($curl, array(

                CURLOPT_URL => env('VTPASS_ENDPOINT') . "/api/service-variations?serviceID=" . $provida->service_id,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_TIMEOUT => 30000,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    // Set Here Your Requesred Headers
                    'Content-Type: application/json',
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);

            $result = json_decode($response);

            if ($result->response_description == "000") {
                $bouquets = Collect($result->content->varations);
                return $bouquets;

            } else {
                return null;
            }

        } catch (\Exception $e) {
            report($e);
            return null;
        }

    }
}
