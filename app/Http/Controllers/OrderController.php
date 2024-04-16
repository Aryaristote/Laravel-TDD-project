<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request) {
        Order::create([
            'label' => $request->label,
            'send_at' => $request->send_at,
        ]);
    }
}
