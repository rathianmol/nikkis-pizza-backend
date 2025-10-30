<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StoreLocation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\StoreLocationResource;

class AdminStoreLocationController extends Controller
{
    public function index(Request $request)
    {
        try {
            // Store Location details should be in the system upon runnning migrations because of Store-Location seeder.
            // $storeLocations = StoreLocation::all();
            $storeLocations = StoreLocation::paginate(10);
            return response()->json([
                    'success' => true,
                    'message' => 'Store location details retrieved successfully.',
                    'data' => $storeLocations,
            ], 200);
        } catch (\Exception $e) {
             return response()->json([
                'success' => false,
                'error' => true,
                'message' => 'Failed to retrieve store location details.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get a specific store location
     */
    public function show(int $locationId)
    {
        try {
            $location = StoreLocation::find($locationId);
            $message = 'Store location retrieved successfully.';
            $success = true;
            $data = ($location) ? new StoreLocationResource($location) : [];
            $httpResponseCode = Response::HTTP_OK;
            if (!$location) {
                $message = 'Store location not found.';
                $success = false;
                $httpResponseCode = Response::HTTP_NOT_FOUND;
            }
            return response()->json([
                'message' => $message,
                'success' => $success,
                'data' => $data,
            ], $httpResponseCode);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error when retrieving store location.',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Create a new store location
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'address_line_1' => 'required|string|max:255',
                'address_line_2' => 'nullable|string|max:255',
                'city' => 'required|string|max:255',
                'state' => 'required|string|max:255',
                'postal_code' => 'required|string|max:20',
                'country' => 'nullable|string|max:255',
                'phone_number' => 'required|string|max:20',
                'email' => 'nullable|email|max:255',
                'monday_hours' => 'nullable|string|max:50',
                'tuesday_hours' => 'nullable|string|max:50',
                'wednesday_hours' => 'nullable|string|max:50',
                'thursday_hours' => 'nullable|string|max:50',
                'friday_hours' => 'nullable|string|max:50',
                'saturday_hours' => 'nullable|string|max:50',
                'sunday_hours' => 'nullable|string|max:50',
                'is_active' => 'nullable|boolean',
                'is_primary' => 'nullable|boolean',
                'special_instructions' => 'nullable|string',
            ]);

            DB::beginTransaction();

            // If setting as primary, unset other primary locations
            if (isset($validated['is_primary']) && $validated['is_primary']) {
                StoreLocation::where('is_primary', true)->update(['is_primary' => false]);
            }

            // Set default values
            $validated['country'] = $validated['country'] ?? 'IND';
            $validated['is_active'] = $validated['is_active'] ?? false;
            $validated['is_primary'] = $validated['is_primary'] ?? false;

            $location = StoreLocation::create($validated);

            DB::commit();

            return response()->json([
                'message' => 'Store location created successfully.',
                'success' => true,
                'data' => new StoreLocationResource($location),
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
                'message' => 'Failed to create store location.',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, StoreLocation $location)
    {
        try {
            $validated = $request->validate([
                'name' => 'sometimes|required|string|max:255',
                'address_line_1' => 'sometimes|required|string|max:255',
                'address_line_2' => 'nullable|string|max:255',
                'city' => 'sometimes|required|string|max:255',
                'state' => 'sometimes|required|string|max:255',
                'postal_code' => 'sometimes|required|string|max:20',
                'country' => 'nullable|string|max:255',
                'phone_number' => 'sometimes|required|string|max:20',
                'email' => 'nullable|email|max:255',
                'monday_hours' => 'nullable|string|max:50',
                'tuesday_hours' => 'nullable|string|max:50',
                'wednesday_hours' => 'nullable|string|max:50',
                'thursday_hours' => 'nullable|string|max:50',
                'friday_hours' => 'nullable|string|max:50',
                'saturday_hours' => 'nullable|string|max:50',
                'sunday_hours' => 'nullable|string|max:50',
                'is_active' => 'nullable|boolean',
                'is_primary' => 'nullable|boolean',
            ]);

            DB::beginTransaction();

            // If setting as primary, unset other primary locations
            if (isset($validated['is_primary']) && $validated['is_primary']) {
                StoreLocation::where('id', '!=', $location->id)
                    ->where('is_primary', true)
                    ->update(['is_primary' => false]);
            }

            $location->update($validated);

            DB::commit();

            // Refresh to get updated data
            $location->refresh();

            return response()->json([
                'message' => 'Store location updated successfully.',
                'success' => true,
                'data' => new StoreLocationResource($location),
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Exception error when updating Store Location.',
                'errors' => $e->getMessage(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * Delete an order
     */
    public function destroy(StoreLocation $storeLocation)
    {
        // $this->authorize('delete-order', $order);

        try {
            $storeLocation->delete();

            return response()->json([
                'message' => 'Store Location deleted successfully.',
                'success' => true,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Server error when trying to delete Store Location.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}