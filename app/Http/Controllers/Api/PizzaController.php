<?php

namespace App\Http\Controllers\Api;

use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Pizza;

class PizzaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pizzas = Pizza::all();
        $success = null;
        $message = '';
        $responseCode = null;

        if ($pizzas->isEmpty()) {
            $success = false;
            $message = 'Error in retrieving Pizzas.';
            $pizzas = [];
            $responseCode = Response::HTTP_NOT_FOUND;
        } else {
            $success = true;
            $message = 'Pizzas retrieved successfully.';
            $responseCode = Response::HTTP_OK;
        }

        return response()->json([
            'success' => $success,
            'data' => $pizzas,
            'message' => $message
        ], $responseCode);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $pizza = Pizza::find($id);
        $success = null;
        $message = '';
        $responseCode = null;

        if ($pizza) {
            $success = true;
            $message = 'Pizza retrieved successfully.';
            $responseCode = Response::HTTP_OK;
        } else {
            $success = false;
            $message = 'Pizza cannot be retrieved successfully.';
            $responseCode = Response::HTTP_NOT_FOUND;
        }

        return response()->json([
            'success' => $success,
            'data' => $pizza, // find() returns null if not found.
            'message' => $message
        ], $responseCode);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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
