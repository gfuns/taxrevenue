<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ArtisanPortfolio;
use Auth;
use Cloudinary;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function __construct()
    {
        Auth::shouldUse('api');
    }

    /**
     * addPortfolio
     *
     * @param Request request
     *
     * @return void
     */
    public function addPortfolio(Request $request)
    {
        $validator = $this->validate($request, [
            'file' => 'required',
            'portfolio_url' => 'required',
        ]);

        $extension = $request->file('file')->getClientOriginalExtension();
        if ($extension == "png" || $extension == "jpg" || $extension == "jpeg" || $extension == "svg" || $extension == "webp") {

            $portfolio = new ArtisanPortfolio;
            $portfolio->artisan_id = Auth::user()->artisan->id;
            $portfolio->file = Cloudinary::uploadFile($request->file('file')->getRealPath())->getSecurePath();
            $portfolio->portfolio_url = $request->portfolio_url;
            if ($portfolio->save()) {
                return new JsonResponse([
                    'response' => [
                        'status_code' => (int) 200,
                        'status' => "Successful",
                        "data" => [
                            "portfolio" => ArtisanPortfolio::where('artisan_id', Auth::user()->artisan->id)->get(),
                        ],
                    ],
                ], 200);
            } else {
                return new JsonResponse([
                    'response' => [
                        'status_code' => (int) 400,
                        'status' => "Failed",
                        'message' => 'Only images are accepted. please upload an image',
                    ],
                ], 400);
            }
        } else {
            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 400,
                    'status' => "Failed",
                    'message' => 'Only images are accepted. please upload an image',
                ],
            ], 400);
        }
    }

    /**
     * getPortfolio
     *
     * @return void
     */
    public function getPortfolio()
    {
        return new JsonResponse([
            'response' => [
                'status_code' => (int) 200,
                'status' => "Successful",
                "data" => [
                    "portfolio" => ArtisanPortfolio::where('artisan_id', Auth::user()->artisan->id)->get(),
                ],
            ],
        ], 200);
    }

    /**
     * deletePortfolio
     *
     * @param Request request
     *
     * @return void
     */
    public function deletePortfolio(Request $request)
    {
        $validator = $this->validate($request, [
            'portfolio_id' => 'required',
        ]);

        $portfolio = ArtisanPortfolio::where('artisan_id', Auth::user()->artisan->id)->where("id", $request->portfolio_id)->first();
        if (isset($portfolio)) {
            if ($portfolio->delete()) {
                return new JsonResponse([
                    'response' => [
                        'status_code' => (int) 200,
                        'status' => "Successful",
                        "data" => [
                            "portfolio" => ArtisanPortfolio::where('artisan_id', Auth::user()->artisan->id)->get(),
                        ],
                    ],
                ], 200);
            } else {
                return new JsonResponse([
                    'response' => [
                        'status_code' => (int) 400,
                        'status' => "Failed",
                        'message' => 'Something went wrong',
                    ],
                ], 400);
            }
        } else {
            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 400,
                    'status' => "Failed",
                    'message' => 'The portfolio with the provided portfolio id does not exist',
                ],
            ], 400);
        }
    }

    /**
     * updatePortfolio
     *
     * @param Request request
     *
     * @return void
     */
    public function updatePortfolio(Request $request)
    {
        $validator = $this->validate($request, [
            'portfolio_id' => 'required',
            'file' => 'required',
            'portfolio_url' => 'required',
        ]);

        $extension = $request->file('file')->getClientOriginalExtension();
        if ($extension == "png" || $extension == "jpg" || $extension == "jpeg" || $extension == "svg" || $extension == "webp") {

            $portfolio = ArtisanPortfolio;
            $portfolio->artisan_id = Auth::user()->artisan->id;
            $portfolio->file = Cloudinary::uploadFile($request->file('file')->getRealPath())->getSecurePath();
            $portfolio->portfolio_url = $request->portfolio_url;
            if ($portfolio->save()) {
                return new JsonResponse([
                    'response' => [
                        'status_code' => (int) 200,
                        'status' => "Successful",
                        "data" => [
                            "portfolio" => ArtisanPortfolio::where('artisan_id', Auth::user()->artisan->id)->get(),
                        ],
                    ],
                ], 200);
            } else {
                return new JsonResponse([
                    'response' => [
                        'status_code' => (int) 400,
                        'status' => "Failed",
                        'message' => 'Only images are accepted. please upload an image',
                    ],
                ], 400);
            }
        } else {
            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 400,
                    'status' => "Failed",
                    'message' => 'Only images are accepted. please upload an image',
                ],
            ], 400);
        }

    }
}
