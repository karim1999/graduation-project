<?php

namespace App\Http\Controllers;

use App\Models\Box;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BoxController extends Controller
{
    public function index(Request $request){
        $boxes = Box::all();
        $fromAddress = $request->input('fromAddress');
        $toAddress = $request->input('toAddress');
        $pickDate = $request->input('pickDate');
        return Inertia::render('myItems', [
            "boxes" => $boxes,
            "fromAddress" => $fromAddress,
            "toAddress" => $toAddress,
            "pickDate" => $pickDate,
            "nextStep" => route('addresses.index'),
        ]);
    }
}
