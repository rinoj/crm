<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Office;
use GuzzleHttp\Client;
class OfficeController extends Controller
{
    public function index(){
        $offices = Office::all();
        
        return view('offices.index')
                ->withOffices($offices);
    }

    public function show($id){
        $office = Office::find($id);

        $client = new Client();
        $response = $client->get($office->api);
        $results = $response->getBody()->getContents();
        // dd(json_decode($results));
        return view('offices.show')->withOffice($office)->with('results', json_decode($results));
    }
}
