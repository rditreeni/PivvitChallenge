<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Offering;

class Purchase extends Model
{
    protected $fillable = [
    	'offeringID',
        'customerName',
        'quantity'
    ];

    public function offering(){
        return $this->belongsTo(Offering::class, 'offeringID');
    }
}
