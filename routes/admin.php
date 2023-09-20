<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PlanController;
use Illuminate\Support\Facades\Route;


Route::get("/dashboard", [AdminController::class, "index"])->name("dashboard");
Route::get("/plans/create", [PlanController::class, "create"])->name("plans.create");
Route::post("/plans", [PlanController::class, "store"])->name("plans.store");
