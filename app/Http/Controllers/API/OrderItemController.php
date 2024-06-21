<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Http\Request;


class OrderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return OrderItem::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:order_id',
            'product_id' => 'required|exists:product,id',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);
        $order = OrderItem::create($validated);
        return response()->json($order, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return OrderItem::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'order_id' => 'sometimes|required|exists:order_id',
            'product_id' => 'sometimes|required|exists:product,id',
            'quantity' => 'sometimes|required|integer',
            'price' => 'sometimes|required|numeric',
        ]);

        $order = OrderItem::findOrFail($id);
        $order->update($validated);
        return response()->json($order, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        OrderItem::destroy($id);
        return response()->json(null, 204);
    }
}
