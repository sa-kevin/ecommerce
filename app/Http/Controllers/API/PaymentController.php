<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Payment::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'amount' => 'required|numeric',
            'status' => 'required|string|max:255',
            'payment_method' => 'required|string|max:255',
        ]);
        $payment = Payment::create($validated);
        return response()->json($payment, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return  Payment::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'order_id' => 'sometimes|required|exists:orders,id',
            'amount' => 'sometimes|required|numeric',
            'status' => 'sometimes|required|string|max:255',
            'payment_method' => 'sometimes|required|string|max:255',
        ]);
        $payment = Payment::findOrFail($id);
        $payment->update($validated);
        return response()->json($payment, 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Payment::destroy($id);
        return response()->json(null, 204);
    }
}
