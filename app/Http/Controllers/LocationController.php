<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class LocationController extends Controller
{

    public function index()
    {

        // Mengambil semua data location dari tabel
        $location = Location::orderBy('created_at', 'ASC')->get();
        // Mengirim data location ke tampilan


        return view('location.index', compact('location'));
    }

    public function generateToken()
    {

        $response = Http::asForm()
            ->post('https://api-satusehat-dev.dto.kemkes.go.id/oauth2/v1/accesstoken?grant_type=client_credentials', [
                'client_id' => env('CLIENT_ID'),
                'client_secret' => env('CLIENT_SCRET'),
            ]);

        $response = $response->object();
        Session::put('bearer', $response->access_token);
        return redirect()->route('location.create')->with('message', 'berhasil generate token');
    }

    public function create()
    {

        $data = [
            'locationOf' => $_GET['locationOf'] ?? null,
        ];
        // Mengirim data location ke tampilan
        return view('location.create', $data);
    }


    public function store(Request $request)
    {
        // Validasi request jika diperlukan

        // // Proses insert ke tabel location


        // Redirect atau berikan respons sukses 
        $url = "https://api-satusehat-dev.dto.kemkes.go.id/fhir-r4/v1/Location";
        $ihs = '100027612';
        $identifier_value = $request->input('identifier_value');
        $name = $request->input('name');
        $description = $request->input('description');

        $organitationOf = $request->input('organitationOf');
        $locationOf = $request->input('locationOf');
        $bearer = Session::get('bearer');

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => "Bearer $bearer",
        ];
        $data = [
            "resourceType" => "Location",
            "identifier" => [
                [
                    "system" => "http://sys-ids.kemkes.go.id/location/100027612",
                    "value" => $identifier_value
                ]
            ],
            "status" => "active",
            "name" => $name,
            "description" => $description,
            "mode" => "instance",
            "address" => [
                "use" => "work",
                "type" => "physical",
                "line" => [
                    "Jl. Hasyim Asyari No.17"
                ],
                "city" => "Bojonegoro",
                "postalCode" => "62113",
                "country" => "ID",
                "extension" => [
                    [
                        "url" => "https://fhir.kemkes.go.id/r4/StructureDefinition/administrativeCode",
                        "extension" => [
                            [
                                "url" => "province",
                                "valueCode" => "35"
                            ],
                            [
                                "url" => "city",
                                "valueCode" => "3522"
                            ],
                            [
                                "url" => "district",
                                "valueCode" => "352215"
                            ],
                            [
                                "url" => "village",
                                "valueCode" => "7105162005"
                            ]
                        ]
                    ]
                ]
            ],
            "physicalType" => [
                "coding" => [
                    [
                        "system" => "http://terminology.hl7.org/CodeSystem/location-physical-type",
                        "code" => "ro",
                        "display" => "Room"
                    ]
                ]
            ],
            "position" => [
                "longitude" => -7.1509934,
                "latitude" => 111.8786604,
                "altitude" => 0
            ],
            // "managingOrganization" => [
            //     "reference" => "Organization/$organitationOf"
            // ],
            "partOf" => [
                "reference" => "Location/$locationOf"
            ]
        ];


        // return response()->json($data);

        $response = Http::withHeaders($headers)
            ->post($url, $data);

        if ($response->status() == 200 || $response->status() == 201) {
            $response = $response->object();
            Location::create([
                'id' => $response->id,
                'value_identifier' => $request->input('value_identifier'),
                'identifier_value' =>  $identifier_value,
                'name' =>  $name,
                'description' =>  $description,
                'partOf' => $locationOf
            ]);

            return redirect()->route('location.index');
        }

        dd($response->status(), $response->json(), $data);
    }
}
