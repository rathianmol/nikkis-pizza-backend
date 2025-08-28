<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    /**
     * Store a new order from cart data
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'cartItems' => 'required|array|min:1',
            'cartItems.*.id' => 'required|string',
            'cartItems.*.pizzaId' => 'required|integer',
            'cartItems.*.title' => 'required|string',
            'cartItems.*.image' => 'required|string',
            'cartItems.*.size' => 'required|string',
            'cartItems.*.price' => 'required|string',
            'amount' => 'required|integer|min:1',
            'totalPrice' => 'required|numeric|min:0',
            'orderType' => 'required|in:pickup,delivery',
            'paymentMethod' => 'required|in:cash,card',
            'deliveryAddress' => 'nullable|array',
            'deliveryAddress.id' => 'required_if:orderType,delivery|integer',
            'deliveryAddress.address_line_1' => 'required_if:orderType,delivery|string',
            'deliveryAddress.address_line_2' => 'nullable|string',
            'deliveryAddress.city' => 'required_if:orderType,delivery|string',
            'deliveryAddress.state' => 'required_if:orderType,delivery|string',
            'deliveryAddress.postal_code' => 'required_if:orderType,delivery|string',
            'cardInfo' => 'nullable|array',
            'cardInfo.cardNumber' => 'required_if:paymentMethod,card|string',
            'cardInfo.expirationDate' => 'required_if:paymentMethod,card|string',
            'cardInfo.securityCode' => 'required_if:paymentMethod,card|string',
            'cardInfo.billingZipCode' => 'required_if:paymentMethod,card|string',
        ]);

        try {
            $order = Order::create([
                'cart_items' => $request->cartItems,
                'amount' => $request->amount,
                'total_price' => $request->totalPrice,
                'order_type' => $request->orderType,
                'payment_method' => $request->paymentMethod,
                'delivery_address' => $request->deliveryAddress,
                'card_info' => $request->cardInfo,
                'status' => 'pending',
            ]);

            return response()->json([
                'success' => true,
                'error' => false,
                'message' => 'Order created successfully',
                'order' => $order,
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => true,
                'message' => 'Failed to create order',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get all orders
     */
    public function index(): JsonResponse
    {
        $orders = Order::latest()->get();
        
        return response()->json([
            'success' => true,
            'orders' => $orders,
        ]);
    }

    /**
     * Get a specific order
     */
    public function show(Order $order): JsonResponse
    {
        return response()->json([
            'success' => true,
            'order' => $order,
        ]);
    }

    /**
     * Update order status
     */
    // public function updateStatus(Request $request, Order $order): JsonResponse
    public function update(Request $request, Order $order): JsonResponse
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,preparing,ready,completed,cancelled',
        ]);

        $order->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'Order status updated successfully',
            'order' => $order,
        ]);
    }

    /**
     * Delete an order
     */
    public function destroy(Order $order): JsonResponse
    {
        $order->delete();

        return response()->json([
            'success' => true,
            'message' => 'Order deleted successfully',
        ]);
    }
}