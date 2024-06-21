<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Order::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:user_id',
            'total' => 'required|numeric',
            'status' => 'required|string|max:255',
        ]);
        $order = Order::create($validated);
        return response()->json($order, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Order::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'user_id' => 'sometimes|required|exists:user,id',
            'total' => 'sometimes|required|numeric',
            'status' => 'sometimes|required|string|max:255',
        ]);

        $order = Order::findOrFail($id);
        $order->update($validated);
        return response()->json($order, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Order::destroy($id);
        return response()->json(null, 204);
    }
}
