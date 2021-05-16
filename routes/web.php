<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Erpname
    Route::delete('erpnames/destroy', 'ErpnameController@massDestroy')->name('erpnames.massDestroy');
    Route::post('erpnames/parse-csv-import', 'ErpnameController@parseCsvImport')->name('erpnames.parseCsvImport');
    Route::post('erpnames/process-csv-import', 'ErpnameController@processCsvImport')->name('erpnames.processCsvImport');
    Route::resource('erpnames', 'ErpnameController');

    // Zone
    Route::delete('zones/destroy', 'ZoneController@massDestroy')->name('zones.massDestroy');
    Route::resource('zones', 'ZoneController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Categories
    Route::delete('categories/destroy', 'CategoriesController@massDestroy')->name('categories.massDestroy');
    Route::resource('categories', 'CategoriesController');

    // Vendors
    Route::delete('vendors/destroy', 'VendorsController@massDestroy')->name('vendors.massDestroy');
    Route::resource('vendors', 'VendorsController');

    // Status
    Route::delete('statuses/destroy', 'StatusController@massDestroy')->name('statuses.massDestroy');
    Route::resource('statuses', 'StatusController');

    // Instock
    Route::delete('instocks/destroy', 'InstockController@massDestroy')->name('instocks.massDestroy');
    Route::post('instocks/parse-csv-import', 'InstockController@parseCsvImport')->name('instocks.parseCsvImport');
    Route::post('instocks/process-csv-import', 'InstockController@processCsvImport')->name('instocks.processCsvImport');
    Route::resource('instocks', 'InstockController');

    // Outward
    Route::delete('outwards/destroy', 'OutwardController@massDestroy')->name('outwards.massDestroy');
    Route::post('outwards/parse-csv-import', 'OutwardController@parseCsvImport')->name('outwards.parseCsvImport');
    Route::post('outwards/process-csv-import', 'OutwardController@processCsvImport')->name('outwards.processCsvImport');
    Route::resource('outwards', 'OutwardController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
