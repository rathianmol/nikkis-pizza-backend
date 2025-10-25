<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Address;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminCustomerController extends Controller
{
    /**
     * Get all customers with search and pagination
     */
    public function index(Request $request)
    {
        try {
            $query = User::with(['address', 'roles'])
                ->role('customer'); // Only get users with customer role

            // Search functionality
            if ($request->has('search') && !empty($request->search)) {
                $searchTerm = $request->search;
                $query->where(function($q) use ($searchTerm) {
                    $q->where('name', 'like', "%{$searchTerm}%")
                      ->orWhere('email', 'like', "%{$searchTerm}%")
                      ->orWhere('phone', 'like', "%{$searchTerm}%");
                });
            }

            // Filter by status (if you have an is_active field)
            if ($request->has('status') && $request->status !== 'all') {
                if ($request->status === 'active') {
                    $query->whereNull('deleted_at');
                } elseif ($request->status === 'inactive') {
                    $query->onlyTrashed();
                }
            }

            // Filter by has address
            if ($request->has('has_address') && $request->has_address !== 'all') {
                if ($request->has_address === 'yes') {
                    $query->has('address');
                } elseif ($request->has_address === 'no') {
                    $query->doesntHave('address');
                }
            }

            $customers = $query->latest()->paginate(15);

            return response()->json([
                'message' => $customers->isEmpty() ? 'No customers found.' : 'Customers retrieved successfully.',
                'success' => true,
                'data' => $customers,
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve customers.',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get a specific customer
     */
    public function show(int $customerId)
    {
        try {
            $customer = User::with(['address', 'roles'])
                ->role('customer')
                ->find($customerId);
            
            if (!$customer) {
                return response()->json([
                    'message' => 'Customer not found.',
                    'success' => false,
                    'data' => null,
                ], Response::HTTP_NOT_FOUND);
            }

            return response()->json([
                'message' => 'Customer retrieved successfully.',
                'success' => true,
                'data' => new UserResource($customer),
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve customer.',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Create a new customer
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'phone' => 'nullable|string|max:20',
                'password' => 'required|string|min:8',
                // Address fields (optional)
                'address_line_1' => 'nullable|string|max:255',
                'address_line_2' => 'nullable|string|max:255',
                'city' => 'nullable|string|max:255',
                'state' => 'nullable|string|max:255',
                'postal_code' => 'nullable|string|max:20',
            ]);

            DB::beginTransaction();

            // Create user
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'password' => Hash::make($validated['password']),
            ]);

            // Assign customer role
            $user->assignRole('customer');

            // Create address if provided
            if (!empty($validated['address_line_1'])) {
                Address::create([
                    'user_id' => $user->id,
                    'address_line_1' => $validated['address_line_1'],
                    'address_line_2' => $validated['address_line_2'] ?? null,
                    'city' => $validated['city'],
                    'state' => $validated['state'],
                    'postal_code' => $validated['postal_code'],
                ]);
            }

            DB::commit();

            // Refresh and load relationships
            $user->refresh()->load(['address', 'roles']);

            return response()->json([
                'message' => 'Customer created successfully.',
                'success' => true,
                'data' => new UserResource($user),
            ], Response::HTTP_CREATED);

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to create customer.',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update a customer
     */
    public function update(Request $request, int $customerId)
    {
        try {
            $customer = User::with(['address', 'roles'])
                ->role('customer')
                ->find($customerId);

            if (!$customer) {
                return response()->json([
                    'message' => 'Customer not found.',
                    'success' => false,
                ], Response::HTTP_NOT_FOUND);
            }

            $validated = $request->validate([
                'name' => 'sometimes|required|string|max:255',
                'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $customerId,
                'phone' => 'nullable|string|max:20',
                'password' => 'nullable|string|min:8',
                // Address fields (optional)
                'address_line_1' => 'nullable|string|max:255',
                'address_line_2' => 'nullable|string|max:255',
                'city' => 'nullable|string|max:255',
                'state' => 'nullable|string|max:255',
                'postal_code' => 'nullable|string|max:20',
            ]);

            DB::beginTransaction();

            // Update user fields
            $userData = [];
            if (isset($validated['name'])) $userData['name'] = $validated['name'];
            if (isset($validated['email'])) $userData['email'] = $validated['email'];
            if (isset($validated['phone'])) $userData['phone'] = $validated['phone'];
            if (isset($validated['password'])) $userData['password'] = Hash::make($validated['password']);

            if (!empty($userData)) {
                $customer->update($userData);
            }

            // Update or create address
            if (!empty($validated['address_line_1'])) {
                $addressData = [
                    'address_line_1' => $validated['address_line_1'],
                    'address_line_2' => $validated['address_line_2'] ?? null,
                    'city' => $validated['city'],
                    'state' => $validated['state'],
                    'postal_code' => $validated['postal_code'],
                ];

                if ($customer->address) {
                    $customer->address->update($addressData);
                } else {
                    $addressData['user_id'] = $customer->id;
                    Address::create($addressData);
                }
            }

            DB::commit();

            // Refresh and load relationships
            $customer->refresh()->load(['address', 'roles']);

            return response()->json([
                'message' => 'Customer updated successfully.',
                'success' => true,
                'data' => new UserResource($customer),
            ], Response::HTTP_OK);

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to update customer.',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Delete a customer (soft delete)
     */
    public function destroy(int $customerId)
    {
        try {
            $customer = User::role('customer')->find($customerId);

            if (!$customer) {
                return response()->json([
                    'message' => 'Customer not found.',
                    'success' => false,
                ], Response::HTTP_NOT_FOUND);
            }

            // Soft delete the customer
            $customer->delete();

            return response()->json([
                'message' => 'Customer deleted successfully.',
                'success' => true,
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete customer.',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}