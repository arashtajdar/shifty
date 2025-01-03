<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\ShiftLabelController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\TemplateDayController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/health', function () { echo "it is ok";});
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/shops/employer', [ShopController::class, 'shopsByEmployer']);
Route::get('/shops/{shopId}/users', [ShopController::class, 'usersByShop']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user/profile', [UserController::class, 'getProfile']);
    Route::put('/user/profile', [UserController::class, 'updateProfile']);
    Route::put('/user/change-password', [UserController::class, 'changePassword']);
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);


    Route::patch('/shops/{id}/toggle-state/{state}', [ShopController::class, 'toggleState']);
    Route::post('/shops/{shop}/grantAdmin/{user}', [ShopController::class, 'grantAdminAccess']);
    Route::post('/shops/{shop}/revokeAdmin/{user}', [ShopController::class, 'revokeAdminAccess']);
    Route::get('/shops/{shop}/isUserAdmin/{user}', [ShopController::class, 'userIsShopAdmin']);
    // Templates
    Route::apiResource('templates', TemplateController::class);

// Template Days (if needed separately, otherwise handled in TemplateController)
    Route::apiResource('template-days', TemplateDayController::class);

// Shifts
    Route::apiResource('shifts', ShiftController::class);

// Schedules
    Route::apiResource('schedules', ScheduleController::class);

// Shops
    Route::apiResource('shops', ShopController::class);

    // other endpoints
    Route::get('/shops/employer', [ShopController::class, 'shopsByEmployer']);


    Route::post('/apply-template', [ShiftController::class, 'applyTemplate']);
    Route::apiResource('schedules', ScheduleController::class);
    Route::get('/employee-shifts', [ShiftController::class, 'employeeShifts']);

    Route::get('/users/employer', [UserController::class, 'usersByEmployer']);
    Route::get('/users/listUsersToManage', [UserController::class, 'getManagedUsers']);

    Route::get('/users', [UserController::class, 'index']);

    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::post('/users', [UserController::class, 'store']);
    Route::post('/users/addEmployee', [UserController::class, 'addEmployee']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
    Route::get('/shops/{shopId}/users', [UserController::class, 'usersByShop']);
    Route::post('/shops/{shopId}/users', [ShopController::class, 'addUserToShop']);
    Route::delete('/shops/{shopId}/users/{userId}', [ShopController::class, 'removeUserFromShop']);

    //shift labels
    Route::get('/all-shift-labels', [ShiftLabelController::class, 'getAllShiftLabels']);
    Route::get('/shift-labels', [ShiftLabelController::class, 'index']);
    Route::post('/shift-labels', [ShiftLabelController::class, 'store']);
    Route::delete('/shift-labels/{id}', [ShiftLabelController::class, 'destroy']);
    Route::put('/shift-labels/{id}', [ShiftLabelController::class, 'update']);



    Route::post('/auto', [ShiftController::class, 'auto']);

    Route::apiResource('rules', RuleController::class);


});




