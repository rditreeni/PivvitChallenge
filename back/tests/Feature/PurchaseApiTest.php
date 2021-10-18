<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;

//use App\Models\Purchase;
use App\Models\Offering;
use DB;

class PurchaseApiTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function setUp() :void 
    {   
        parent::setup(); 
    }
    
    public function test_get_purchase()
    {
        $response = $this->get('/api/purchases');
        $response->assertStatus(200);
    }

    public function test_save_purchase_error()
    {
        $response = $this->withHeaders([
            'X-Header' => 'application/json',
        ])->json('POST', '/api/purchases', ['customerName' => '', 'offeringID' => '', 'quantity' => '']);

        $response->assertStatus(422);
    }

    public function test_save_purchase()
    {
        $offeringID = DB::table((new Offering())->getTable())->insertGetId([
            'title' => 'Offering 1',
            'price' => '8.15'
        ]);

        $data = ["customerName" => "Rahul", "offeringID" => $offeringID, "quantity" => "1"];
        
        $this->json('POST', 'api/purchases', $data, ['Accept' => 'application/json'])
            ->assertStatus(201);
    }
}
