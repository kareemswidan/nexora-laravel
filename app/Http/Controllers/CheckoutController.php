<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    private function items()
    {
        $cart = session('cart', []);

        return Product::whereIn('id', array_keys($cart))->get()->map(fn ($product) => [
            'product' => $product,
            'quantity' => (int) $cart[$product->id],
            'line_total' => (float) $product->price * (int) $cart[$product->id],
        ]);
    }

    public function index()
    {
        if (! count(session('cart', []))) {
            return redirect()->route('cart');
        }

        return view('checkout', ['items' => $this->items()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_name' => 'required|string|min:2|max:120',
            'email' => 'required|email|max:190',
        ]);
        $items = $this->items();
        abort_if($items->isEmpty(), 422);

        $order = DB::transaction(function () use ($data, $items) {
            $order = Order::create([
                'order_number' => 'NX-'.now()->format('ymd').'-'.Str::upper(Str::random(6)),
                'customer_name' => $data['customer_name'],
                'email' => strtolower($data['email']),
                'total' => $items->sum('line_total'),
                'status' => 'confirmed',
            ]);

            foreach ($items as $row) {
                $order->items()->create([
                    'product_id' => $row['product']->id,
                    'product_name' => $row['product']->name,
                    'unit_price' => $row['product']->price,
                    'quantity' => $row['quantity'],
                ]);
            }

            return $order;
        });

        session()->forget('cart');

        return redirect()->to(URL::temporarySignedRoute(
            'order.success',
            now()->addMinutes(20),
            ['order' => $order]
        ));
    }

    public function success(Order $order)
    {
        return view('order-success', compact('order'));
    }

    public function trackForm()
    {
        return view('track');
    }

    public function track(Request $request)
    {
        $data = $request->validate([
            'order_number' => 'required|string',
            'email' => 'required|email',
        ]);
        $order = Order::where('order_number', $data['order_number'])
            ->where('email', strtolower($data['email']))
            ->first();

        return view('track', compact('order'))->with('searched', true);
    }
}
