<?php

namespace Tests\Feature;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase {
    use RefreshDatabase;

    //Testing creating a new order.
    public function test_new_order_to_the_database():void {
        //Creating data to test.
        $res = $this->post('orders', [
            'label' => 'New Order',
            'send_at' => Carbon::tomorrow(),
        ]);

        $res->assertRedirect(route('welcome'));
        $this->assertCount(1, Order::all());
    }

    //Teting if the order fiels are not reequired.
    public function test_label_and_sendAt_can_not_be_null():void{
        //Creating data to test.
        $response = $this->post('orders', [
            'label' => '',
            'send_at' => '',
        ]);

        $response->assertSessionHasErrors(['label', 'send_at']);
    }

    public function test_order_can_be_updated():void{
        //Creating data to test.
        $this->post('orders', [
            'label' => 'New Order',
            'send_at' => Carbon::tomorrow(),
        ]);

        $order = Order::first(); //Fetch the row just created.

        // Update the order
        $res = $this->put('orders/' . $order->id, [
            'label' => 'Edited Order',
            'send_at' => Carbon::now()->addDays(2),
        ]);

        //Check if fields was update or fire an error
        $this->assertEquals('Edited Order', Order::first()->label);
        $this->assertEquals(Carbon::now()->addDays(2), Order::first()->send_at);

        $res->assertRedirect(route('orders.show', $order));
    }

    public function test_delete_an_ordeer():void {
        //Creating data to test.
        $this->post('orders', [
            'label' => 'New Order',
            'send_at' => Carbon::tomorrow(),
        ]);

        $order = Order::first(); //Fetch the row just created.

        $respon = $this->delete('orders/' . $order->id); // Delete the order
        $this->assertCount(0, Order::all()); // Check if the order was deleted.

        $respon->assertRedirect(route('welcome'));
    }
}
