<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminOrderController extends Controller
{
    /**
     * Get all orders (admin only)
     */
    public function index(Request $request)
    {
        // xdebug_break();
        // Additional permission check (optional, since middleware already protects this)
        // $this->authorize('view-all-orders');
 
        $message = 'No orders found.';
        $data = [];
        $success = false;
        $orders = Order::with('user')
            ->latest()
            ->paginate(15);

        if(!$orders->isEmpty()) {
            $message = 'Orders retrieved successfully.';
            $data = $orders;
            $success = true;
        }

        return response()->json([
            'message' => $message,
            'success' => $success,
            'data' => $data,
        ], 200);
    }

    /**
     * Get a specific order
     */
    // public function show(Order $order)
    public function show(int $orderId)
    {
        // $this->authorize('view-order', $order);
        try {
            $message = 'Order does not exist.';
            $success = false;
            $data = [];
            $httpCode = Response::HTTP_NOT_FOUND; // not found
            // $order->load('user');
            $order = Order::with('user')
                ->where('id', $orderId)
                ->first();
            
            if ($order) {
                $message = 'Order retrieved successfully.';
                $success = true;
                $data = $order;
                $httpCode = Response::HTTP_OK;
            }

            return response()->json([
                'message' => $message,
                'success' => $success,
                'data' => $data,
            ], $httpCode);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => true,
                'message' => 'Failed to retrieve order',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update an order
     */
    // public function update(Request $request, Order $order)
    // public function update(Request $request)
    // {
    //     // $this->authorize('update-order', $order);
    //     $message = 'Attempt to update order failed, (please check order Id).';
    //     $success = false;
    //     $data = [];
    //     $httpCode = Response::HTTP_NOT_FOUND; 
    //     try {
    //         $validated = $request->validate([
    //             'status' => 'nullable|in:pending,confirmed,preparing,ready,delivered,cancelled',
    //             // 'notes' => 'nullable|string',
    //             // 'total_price' => 'nullable|numeric|min:0',
    //         ]);

    //         // $order->update($validated);
    //         $order = Order::with('user')
    //             ->where('id', $request->input('orderId'))
    //             ->first();

    //         $order->update($validated);

    //         if ($order->wasChanged()) {
    //             $message = 'Order was updated successfully.';
    //             $success = true;
    //             $data = $order->fresh();
    //             $httpCode = Response::HTTP_OK;
    //         } else {
    //             $message = 'Updated with no attribute changes.';
    //             $success = true;
    //             $data = $order;
    //             $httpCode = Response::HTTP_OK;
    //         }

    //         return response()->json([
    //             'message' => $message,
    //             'data' => $data,
    //             'success' => $success,
    //         ], $httpCode);

    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Failed to update order.',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
        
    // }

    /**
     * Update order status
     */
    public function updateStatus(Request $request, Order $order)
    {
        try {
            $validated = $request->validate([
                'status' => 'required|in:pending,confirmed,preparing,ready,out for delivery,completed,cancelled',
            ]);

            $order->update($validated);

            // Explicitly refresh the model from database to ensure we have the latest data
            $order->refresh();
            
            // Load the user relationship
            $order->load('user');

            return response()->json([
                'message' => 'Order status updated successfully.',
                'data' => $order,
                'success' => true,
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update order status.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete an order
     */
    public function destroy(Order $order)
    {
        // $this->authorize('delete-order', $order);

        try {
            $order->delete();

            return response()->json([
                'message' => 'Order deleted successfully'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete order.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // /**
    //  * Export all orders
    //  */
    // public function exportAll()
    // {
    //     $this->authorize('export-orders');

    //     $orders = Order::with('user', 'items')->get();

    //     return response()->json([
    //         'message' => 'Orders exported successfully',
    //         'data' => $orders,
    //         'count' => $orders->count()
    //     ], 200);
    // }

    // /**
    //  * Get all users (super-admin only)
    //  */
    // public function getAllUsers()
    // {
    //     $this->authorize('manage-users');

    //     $users = User::with('roles')->paginate(15);

    //     return response()->json([
    //         'message' => 'Users retrieved successfully',
    //         'data' => $users
    //     ], 200);
    // }

    // /**
    //  * Assign role to user (super-admin only)
    //  */
    // public function assignRoleToUser(Request $request)
    // {
    //     $this->authorize('assign-roles');

    //     $validated = $request->validate([
    //         'user_id' => 'required|exists:users,id',
    //         'role' => 'required|string|exists:roles,name',
    //     ]);

    //     $user = User::findOrFail($validated['user_id']);
    //     $user->syncRoles($validated['role']);

    //     return response()->json([
    //         'message' => 'Role assigned successfully',
    //         'data' => $user->load('roles')
    //     ], 200);
    // }
}