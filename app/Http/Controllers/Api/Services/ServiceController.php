<?php

namespace App\Http\Controllers\Api\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service;

class ServiceController extends Controller
{
    public function index()
    {

    }

    public function show(Request $request){
        $services = Service::all();

        return response()->json([
            'services'=>$services,
            'success'=> true,
        ]);
    }
}

