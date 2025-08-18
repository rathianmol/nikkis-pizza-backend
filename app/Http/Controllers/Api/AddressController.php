<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
// use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function store(Request $request): JsonResponse
    {
        // if ($request->input('user_id') !== Auth::id()) {
        //     return response()->json(['error' => 'Client side user ID not matching server side user ID'], Response::HTTP_NOT_ACCEPTABLE);
        // }
        // xdebug_break();
        try {
            $validated = $request->validate([
                'address_line_1' => 'required|string|max:255',
                'address_line_2' => 'nullable|string|max:255',
                'city' => 'required|string|max:255',
                'state' => 'required|string|max:255',
                'postal_code' => 'required|string|max:20',
            ]);

            // Add authenticated user's ID to validated data
            // $validated['user_id'] = Auth::id();
            $validated['user_id'] = $request->input('user_id');

            $address = Address::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Address saved successfully',
                'data' => $address
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to save address',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * GET /api/address/{user}
     */
    public function show(Request $request): JsonResponse
    {
        $success = false;
        $message = 'User does not have an associated address in the system.';
        $responseCode = Response::HTTP_NOT_FOUND;

        // if ($request->input('user_id') !== Auth::id()) {
        //     return response()->json(['error' => 'Client side user ID not matching server side user ID'], Response::HTTP_NOT_ACCEPTABLE);
        // }
        // xdebug_break();
        try {
            $user = User::find($request->input('user_id'));
            $address = $user->address ?? null;
            if (!is_null($address)) {
                $success = true;
                $message = 'User address successfully retrieved.'; 
                $responseCode = Response::HTTP_OK;
            }
            return response()->json([
                'success' => $success,
                'data' => $success ? $address : null,
                'message' => $message,
            ], $responseCode);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to show address',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request): JsonResponse
    {
        // if ($request->input('user_id') !== Auth::id()) {
        //     return response()->json(['error' => 'Client side user ID not matching server side user ID'], Response::HTTP_NOT_ACCEPTABLE);
        // }
        $success = false;
        $message = 'User does not have an associated address in the system.';
        $responseCode = Response::HTTP_NOT_FOUND;
        try {
            $user = User::find($request->input('user_id'));
            $address = $user->address ??  null;
            
            if (is_null($address)) {
                return response()->json([
                    'success' => $success,
                    'message' => $message,
                ], $responseCode);
            }

            $validated = $request->validate([
                'address_line_1' => 'required|string|max:255',
                'address_line_2' => 'nullable|string|max:255',
                'city' => 'required|string|max:255',
                'state' => 'required|string|max:255',
                'postal_code' => 'required|string|max:20',
            ]);

            $address->update($validated);
            $success = true;
            $message = 'Address updated successfully.';
            $responseCode = Response::HTTP_OK;
            return response()->json([
                'success' => $success,
                'message' => $message,
                'data' => $address->fresh()
            ], $responseCode);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update address',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request): JsonResponse
    {
        // if ($request->input('user_id') !== Auth::id()) {
        //     return response()->json(['error' => 'Client side user ID not matching server side user ID'], Response::HTTP_NOT_ACCEPTABLE);
        // }
        // xdebug_break();
        try {
            $user = User::find($request->input('user_id'));
            $address = $user->address ?? null;
            
            if (is_null($address)) {
                return response()->json([
                    'success' => false,
                    'message' => 'User does not have an associated address in the system.'
                ], Response::HTTP_NOT_FOUND);
            }

            $address->delete();

            return response()->json([
                'success' => true,
                'message' => 'Address deleted successfully'
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error encountered when trying to delete address.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
