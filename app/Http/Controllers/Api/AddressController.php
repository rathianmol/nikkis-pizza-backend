<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AddressController extends Controller
{
    public function index()
    {
        //
    }

    public function store(Request $request): JsonResponse
    {
        $success = false;
        $message = 'Unable to save user address.';
        $responseCode = Response::HTTP_NOT_FOUND;

        $user = Auth::user();
        // If address does not exist already (is_null true).
        // if not is_null, then address already exists, dont create another one.
        $data = is_null($user->address) ? null : $user->address;

        // 1. validate
        $validated = $request->validate([
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
        ]);

        // 2. check if the user already has an address.
        // If address already existing, no need to create a new address. Logically, should be updating.
        if (is_null($data)) {
            $validated['user_id'] = $user->id;
            $data = Address::create($validated);
            $success = true;
            $message = 'Address saved successfully.';
            $responseCode = Response::HTTP_FOUND;
        }

        return response()->json([
            'success' => $success,
            'message' => $message,
            'data' => $data,
        ], $responseCode);
    }

    public function show(): JsonResponse
    {
        // xdebug_break();

        $success = false;
        $message = 'User does not have an associated address in the system.';
        $responseCode = Response::HTTP_NOT_FOUND;

        $user = Auth::user();
        $data = !is_null($user->address) ? $user->address : null;

        if (!is_null($data) ) {
            $success = true;
            $message = "User address successfully retrieved.";
            $responseCode = Response::HTTP_FOUND;
        }

        return response()->json([
            'success' => $success,
            'data' => $success ? $data : null,
            'message' => $message,
            'data' => $data,
        ], $responseCode);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request): JsonResponse
    {
        // xdebug_break();
        $success = false;
        $message = 'Unable to update user address.';
        $responseCode = Response::HTTP_NOT_FOUND;

        $user = Auth::user();
        $data = !is_null($user->address) ? $user->address : null;

        // 1. validate
        $validated = $request->validate([
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
        ]);

        // 2. check if the user already has an address/
        // Dont update a non-existing user-address record.
        if (!is_null($data)) {
            $data->update($validated);
            $data->fresh();
            $success = true;
            $message = 'Address updated successfully.';
            $responseCode = Response::HTTP_OK;
        }

        return response()->json([
            'success' => $success,
            'message' => $message,
            'data' => $data,
        ], $responseCode);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(): JsonResponse
    {
        $success = false;
        $message = 'Unable to delete user address.';
        $responseCode = Response::HTTP_NOT_FOUND;

        $user = Auth::user();
        // If address does not exist already (is_null true). -> give data = null, dont proceed - dont delete a non-existent record.
        // if not is_null, then address already exists, able to destroy.
        $data = is_null($user->address) ? null : $user->address;

        // 2. check if the user already has an address. Dont update a non-existing user-address record.
        // if not is_null, then address already exists, able to destroy.
        if (!is_null($data)) {
            $data = $data->delete();
            $success = true;
            $message = 'Address deleted successfully.';
            $responseCode = Response::HTTP_OK;
        }

        return response()->json([
            'success' => $success,
            'message' => $message,
            'data' => $data,
        ], $responseCode);
    }
}
