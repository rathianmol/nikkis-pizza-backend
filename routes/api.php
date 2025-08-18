<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PizzaController;
use App\Http\Controllers\Api\AddressController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Public routes (no authentication required)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes (authentication required)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/revoke-all', [AuthController::class, 'revokeAll']);

});

// Test route to verify API is working
Route::get('/test', function () {
    return response()->json(['message' => 'API is working!']);
});


// Pizza API Routes
Route::prefix('pizzas')->group(function () {
    /**
     * GET /api/pizzas - Get all pizzas
     * POST /api/pizzas - Create a new pizza
     * GET /api/pizzas/{id} - Get a specific pizza
     * PUT /api/pizzas/{id} - Update a pizza
     * DELETE /api/pizzas/{id} - Delete a pizza
     * GET /api/pizzas/paginated/list?per_page=10 - Get paginated pizzas
     * GET /api/pizzas/search/query?q=margherita - Search pizzas
     * GET /api/pizzas/filter/price?size=medium&min_price=10&max_price=15 - Filter by price
     */



    // Basic CRUD operations
    Route::get('/', [PizzaController::class, 'index']);
    // Route::post('/', [PizzaController::class, 'store']);
    Route::get('/{pizza}', [PizzaController::class, 'show']);
    // Route::put('/{pizza}', [PizzaController::class, 'update']);
    // Route::delete('/{pizza}', [PizzaController::class, 'destroy']);
    
    // Additional endpoints
    // Route::get('/paginated/list', [PizzaController::class, 'paginated']);
    // Route::get('/search/query', [PizzaController::class, 'search']);
    // Route::get('/filter/price', [PizzaController::class, 'filterByPrice']);
});


// Address API Routes
// "get the address by the user id"
Route::prefix('address/user')->group(function () {
    // Basic CRUD operations
    Route::get('/{user}', [AddressController::class, 'show']);  // public function show(Request $request, User $user): JsonResponse
    Route::post('/{user}', [AddressController::class, 'store']);
    Route::put('/{user}', [AddressController::class, 'update']);
    Route::delete('/{user}', [AddressController::class, 'destroy']);
});