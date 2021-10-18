<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Offering;

class OfferingController extends Controller
{
    public function index(){
        $offerings = Offering::all();
        return response()->json(compact('offerings'), 200);
    }
}
