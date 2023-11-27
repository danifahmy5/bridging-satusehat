<?php

namespace App\Http\Controllers;

use App\Models\Organisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class OrganisasiController extends Controller
{
    public function index()
    {

        // Mengambil semua data organisasi dari tabel
        $organisasi = file_get_contents('organitation.json');
        $organisasi = json_decode($organisasi,TRUE); 
        // Mengirim data organisasi ke tampilan


        return view('organisasi.index', compact('organisasi'));
    }

    public function generateToken()
    {

        $response = Http::asForm()
            ->post('https://api-satusehat.kemkes.go.id/oauth2/v1/accesstoken?grant_type=client_credentials', [ 
                'client_id' => env('CLIENT_ID'),
                'client_secret' => env('CLIENT_SCRET'),
            ]);
        
        $response = $response->object(); 
        Session::put('bearer',$response->access_token);
        return redirect()->route('organisasi.create')->with('message','berhasil generate token');
    }

    public function create()
    {
        $typeCode = file_get_contents('typeCode.json');
        $addressUse = file_get_contents('addressUse.json');
        $addressType = file_get_contents('addressType.json');

        $data = [
            'typeCode' => json_decode($typeCode),
            'addressUse' => json_decode($addressUse),
            'addressType' => json_decode($addressType),
            'pathOf' => $_GET['pathOf'] ?? null,
        ];
        // Mengirim data organisasi ke tampilan
        return view('organisasi.create', $data);
    }


    public function store(Request $request)
    {
        // Validasi request jika diperlukan

        // // Proses insert ke tabel organisasi


        // Redirect atau berikan respons sukses 

        $url = 'https://api-satusehat-dev.dto.kemkes.go.id/fhir-r4/v1/Organization';
        $ihs = '100027612';
        $value_identifier = $request->input('value_identifier');
        $typecode = $request->input('typecode');
        $typedisplay = $request->input('typedisplay');
        $address_type = $request->input('address_type');
        $address_use = $request->input('address_use');
        $address_text = $request->input('address_text');
        $address_line = $request->input('address_line');
        $organitation_name = $request->input('organitation_name');
        $pathOf = $request->input('pathOf');
        $bearer = Session::get('bearer');

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => "Bearer $bearer",
        ];

        $data = [
            'resourceType' => 'Organization',
            'active' => true,
            'identifier' => [
                [
                    'use' => 'official',
                    'system' => "http://sys-ids.kemkes.go.id/organization/$ihs",
                    'value' => $value_identifier,
                ],
            ],
            'type' => [
                [
                    'coding' => [
                        [
                            'system' => 'http://terminology.hl7.org/CodeSystem/organization-type',
                            'code' => $typecode,
                            'display' => $typedisplay,
                        ],
                    ],
                ],
            ],
            'name' => "RUMAH SAKIT 'AISYIYAH BOJONEGORO",
            'address' => [
                [
                    'use' => $address_use,
                    'type' => $address_type,
                    'text' => $address_text,
                    'line' => [
                        $address_line
                    ],
                    'city' => 'Bojonegoro',
                    'postalCode' => '62113',
                    'country' => 'ID',
                    'extension' => [
                        [
                            'url' => 'https://fhir.kemkes.go.id/r4/StructureDefinition/administrativeCode',
                            'extension' => [
                                [
                                    'url' => 'province',
                                    'valueCode' => '35',
                                ],
                                [
                                    'url' => 'city',
                                    'valueCode' => '3522',
                                ],
                                [
                                    'url' => 'district',
                                    'valueCode' => '352215',
                                ],
                                [
                                    'url' => 'village',
                                    'valueCode' => '7105162005',
                                ],
                            ],
                        ],
                    ],
                ],
            ], 
        ];

        if ($pathOf) {
            $data['partOf'] = [
                "reference" => "Organization/$pathOf"
            ];
        }
        // return response()->json($data);

        $response = Http::withHeaders($headers)
            ->post($url, $data);

        if ($response->status() == 200 || $response->status() == 201) {
            $response = $response->object(); 
            Organisasi::create([
                'id' => $response->id,
                'value_identifier' => $request->input('value_identifier'),
                'ihs' => $ihs,
                'typecode' => $request->input('typecode'),
                'organitation_name' => "RUMAH SAKIT 'AISYIYAH BOJONEGORO",
                'typedisplay' => $request->input('typedisplay'),
                'address_type' => $request->input('address_type'),
                'address_use' => $request->input('address_use'),
                'address_text' => $request->input('address_text'),
                'address_line' => $request->input('address_line'),
                'pathOf' => $pathOf,
            ]);

            return redirect()->route('organisasi.index');
        }

        dd($response->status(), $response->json(),$data);
    }
}
