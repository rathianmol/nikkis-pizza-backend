<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

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
        if ($request->input('user_id') !== Auth::id()) {
            return response()->json(['error' => 'Client side user ID not matching server side user ID'], Response::HTTP_NOT_ACCEPTABLE);
        }
        try {
            $validated = $request->validate([
                'address_line_1' => 'required|string|max:255',
                'address_line_2' => 'nullable|string|max:255',
                'city' => 'required|string|max:255',
                'state' => 'required|string|max:255',
                'postal_code' => 'required|string|max:20',
            ]);

            // Add authenticated user's ID to validated data
            $validated['user_id'] = Auth::id();

            $address = Address::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Address saved successfully',
                'data' => $address
            ], Response::HTTP_OK);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to save address',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * /api/{userId}/address
     */
    public function show(Request $request): JsonResponse
    {
        $success = false;
        $message = 'User does not have an associated address in the system.';
        $responseCode = Response::HTTP_NOT_FOUND;

        if ($request->input('user_id') !== Auth::id()) {
            return response()->json(['error' => 'Client side user ID not matching server side user ID'], Response::HTTP_NOT_ACCEPTABLE);
        }

        $address = Auth::user()->address;
        if ($address) {
            $success = true;
            $message = 'User address successfully retrieved.';
            $responseCode = Response::HTTP_OK;
        }
        return response()->json([
            'success' => $success,
            'data' => $success ? $address : null,
            'message' => $message,
        ], $responseCode);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
