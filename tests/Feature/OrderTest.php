<?php

namespace Tests\Feature;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase {
    use RefreshDatabase;
    public function test_new_order_to_the_database(){
        $res = $this->post('orders', [
            'label' => 'New Order',
            'send_at' => Carbon::tomorrow(),
        ]);

        $res->assertOk();
        $this->assertCount(1, Order::all());
    }
}
