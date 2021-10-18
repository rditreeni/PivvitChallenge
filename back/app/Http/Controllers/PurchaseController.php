<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Purchase;
use App\Http\Requests\SavePurchase;

class PurchaseController extends Controller
{
    public function index(){
        $purchases = Purchase::with('offering')->latest()->get();
        return response()->json(compact('purchases'), 200);
    }
    public function store(SavePurchase $request){
        $data = $request->all();
        $purchase = new Purchase($data);
        $purchase->save();
        return response()->json(compact('purchase'), 201);
    }
}
