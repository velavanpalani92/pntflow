<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Erpname
    Route::apiResource('erpnames', 'ErpnameApiController');

    // Zone
    Route::apiResource('zones', 'ZoneApiController');

    // Categories
    Route::apiResource('categories', 'CategoriesApiController');

    // Vendors
    Route::apiResource('vendors', 'VendorsApiController');

    // Status
    Route::apiResource('statuses', 'StatusApiController');

    // Instock
    Route::apiResource('instocks', 'InstockApiController');

    // Outward
    Route::apiResource('outwards', 'OutwardApiController');
});
