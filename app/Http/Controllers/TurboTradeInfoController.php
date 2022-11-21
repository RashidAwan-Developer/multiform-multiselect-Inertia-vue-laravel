<?php

namespace App\Http\Controllers;

use App\Models\turboTradeInfo;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TurboTradeInfoController extends Controller
{
    public function addinfo()
    {
        return Inertia::render('TurboTrade/Addinfo');
    }

    public function firstStep(Request $request)
    {
        $request->validate([
            'vin' => ['required'],
            'body' => ['required']
        ]);
        return to_route('addinfo');

    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vin' => ['required'],
            'body' => ['required'] ,
            'username' => ['required'] ,
            'address' => ['required']
        ]);

        $vin = json_encode($request->vin);

        turboTradeInfo::create([
            'vin' => $vin,
            'body' => $request->body,
            'username' => $request->username,
            'address' => $request->address,
        ]);
//        return to_route('addinfo');


    }

}
