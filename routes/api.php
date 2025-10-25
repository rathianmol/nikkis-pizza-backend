<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PizzaController;
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\AdminOrderController;
use App\Http\Controllers\Api\AdminCustomerController;
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


    Route::prefix('address/user')->group(function () {
        // Basic CRUD operations
        Route::get('/', [AddressController::class, 'show']);
        Route::post('/', [AddressController::class, 'store']);
        Route::put('/', [AddressController::class, 'update']);
        Route::delete('/', [AddressController::class, 'destroy']);
    });

    Route::prefix('orders')->group(function () {

        // BUG FIX: Specific routes MUST come before parameterized routes (routes with {parameter}).
        // Customer POV - order history view api data.
        Route::get('/history', [OrderController::class, 'getOrderDetailsByCustomerId']);
        // Customer POV - latest order placed view api data.
        Route::get('/tracking', [OrderController::class, 'getLatestOrderDetailByCustomerId']);

        // Basic CRUD operations
        Route::get('/', [OrderController::class, 'index']);
        Route::get('/{order}', [OrderController::class, 'show']);
        Route::post('/', [OrderController::class, 'store']);
        Route::put('/{order}', [OrderController::class, 'update']);
        Route::delete('/{order}', [OrderController::class, 'destroy']);
    });

        // ADMIN ROUTES - Protected by Spatie roles middleware
    Route::middleware('role:admin|super-admin')->prefix('admin')->group(function () {
        
        Route::prefix('/orders')->group(function () {
            Route::get('/', [AdminOrderController::class, 'index']);
            Route::get('/{order}', [AdminOrderController::class, 'show']);
            Route::put('/{order}', [AdminOrderController::class, 'update']);
            Route::delete('/{order}', [AdminOrderController::class, 'destroy']);
            Route::get('/export/all', [AdminOrderController::class, 'exportAll']);
            Route::patch('/{order}/status', [AdminOrderController::class, 'updateStatus']);
        });

        // Customer Management Routes
        Route::prefix('/customers')->group(function () {
            Route::get('/', [AdminCustomerController::class, 'index']);
            Route::get('/{customer}', [AdminCustomerController::class, 'show']);
            Route::post('/', [AdminCustomerController::class, 'store']);
            Route::put('/{customer}', [AdminCustomerController::class, 'update']);
            Route::delete('/{customer}', [AdminCustomerController::class, 'destroy']);
        });
    });
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