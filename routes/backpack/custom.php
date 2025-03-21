<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\CRUD.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix' => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
], function () {
    // DEBUG Testroute:
    Route::get('debug-test', function () {
        return 'Custom.php loaded!';
    });// custom admin routes

    // Backpack CRUDs hier mit FQCN eintragen:
    Route::crud('channel', \App\Http\Controllers\Admin\ChannelCrudController::class);
    Route::crud('task', \App\Http\Controllers\Admin\TaskCrudController::class);
    Route::crud('members', \App\Http\Controllers\Admin\MembersCrudController::class);

});
