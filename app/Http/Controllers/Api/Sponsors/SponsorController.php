<?php

namespace App\Http\Controllers\Api\Sponsors;

use App\Http\Controllers\Controller;
use App\Http\Resources\SponsorResource;
use App\Sponsor;
use Illuminate\Http\Request;

class SponsorController extends Controller
{
    public function index(Request $request){
        $sponsors = Sponsor::all();

        return response()->json([
            'sponsors'=>$sponsors,
            'success'=> true,
        ]);
    }
}
