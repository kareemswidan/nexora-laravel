<?php

namespace Tests\Feature;

use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class OrderAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_order_success_page_requires_a_temporary_signature(): void
    {
        $order = Order::create([
            'order_number' => 'NX-TEST-ONE',
            'customer_name' => 'Demo Customer',
            'email' => 'customer@example.com',
            'total' => 24,
            'status' => 'confirmed',
        ]);

        $this->get(route('order.success', $order))->assertForbidden();

        $signed = URL::temporarySignedRoute('order.success', now()->addMinute(), ['order' => $order]);
        $this->get($signed)->assertOk()->assertSee('NX-TEST-ONE');
    }

    public function test_tracking_requires_both_order_number_and_matching_email(): void
    {
        Order::create([
            'order_number' => 'NX-PRIVATE-ONE',
            'customer_name' => 'First Customer',
            'email' => 'first@example.com',
            'total' => 24,
            'status' => 'confirmed',
        ]);

        $this->post(route('orders.find'), [
            'order_number' => 'NX-PRIVATE-ONE',
            'email' => 'wrong@example.com',
        ])->assertOk()->assertDontSee('NX-PRIVATE-ONE');

        $this->post(route('orders.find'), [
            'order_number' => 'NX-PRIVATE-ONE',
            'email' => 'first@example.com',
        ])->assertOk()->assertSee('NX-PRIVATE-ONE');
    }
}
