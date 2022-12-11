<?php

namespace App\Http\Controllers\Api\Search;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchInputController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($address)
    {    
        $tomtomApiUrl = "https://api.tomtom.com/search/2/search/";
        $tomtomKey = config("tomtom");
        $typeahead = true;
        $limit = 5;
        $language = "it-IT";
        $countrySet = "IT";
        $minFuzzyLevel = 1;
        $maxFuzzyLevel = 2;
        $address = str_replace(" ", "-", $address);
        $tomtomApiUrl .= $address . ".json?key=" . $tomtomKey . "&typeahead=" . $typeahead . "&limit=" . $limit . "&language=" . $language . "&countrySet=" . $countrySet . "&minFuzziLevel=" . $minFuzzyLevel . "&maxFuzzyLevel=" . $maxFuzzyLevel;
        $response = file_get_contents($tomtomApiUrl);
        $response = json_decode($response, true);
        return response()->json([
            'results' => $response,
            'success' => true
        ]);
    }

}
