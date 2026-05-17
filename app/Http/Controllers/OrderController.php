<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    public function index()
    {
        return Order::with(['user', 'demande'])->latest()->paginate(10);
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);
        $data['user_id'] = $request->user()?->id ?? $data['user_id'];
        $data['total_price'] = $data['quantity'] * $data['unit_price'];

        $order = Order::create($data);

        return response()->json($order->load(['user', 'demande']), Response::HTTP_CREATED);
    }

    public function show(Order $order)
    {
        return $order->load(['user', 'demande']);
    }

    public function update(Request $request, Order $order)
    {
        $data = $this->validatedData($request, true);

        $quantity = $data['quantity'] ?? $order->quantity;
        $unitPrice = $data['unit_price'] ?? $order->unit_price;
        $data['total_price'] = $quantity * $unitPrice;

        $order->update($data);

        return $order->load(['user', 'demande']);
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return response()->noContent();
    }

    private function validatedData(Request $request, bool $partial = false): array
    {
        $required = $partial ? 'sometimes' : 'required';

        return $request->validate([
            'user_id' => [$request->user() ? 'nullable' : $required, 'exists:users,id'],
            'demande_id' => ['nullable', 'exists:demandes,id'],
            'reference' => [$required, 'string', 'max:255', Rule::unique('orders', 'reference')->ignore($request->route('order'))],
            'product_name' => [$required, 'string', 'max:255'],
            'quantity' => [$required, 'integer', 'min:1'],
            'unit_price' => [$required, 'numeric', 'min:0'],
            'status' => ['sometimes', Rule::in(['draft', 'confirmed', 'shipped', 'delivered', 'cancelled'])],
            'ordered_at' => ['nullable', 'date'],
        ]);
    }
}
