<?php

Route::redirect('/', '/login');
Route::redirect('/home', '/admin');
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

    // Services
    Route::delete('services/destroy', 'ServicesController@massDestroy')->name('services.massDestroy');
    Route::resource('services', 'ServicesController');

    // Clients
    Route::delete('clients/destroy', 'ClientsController@massDestroy')->name('clients.massDestroy');
    Route::resource('clients', 'ClientsController');

    // Appointments
    Route::delete('bookings/destroy', 'BookingController@massDestroy')->name('bookings.massDestroy');
    Route::resource('bookings', 'BookingController');
    
    // cities
    Route::resource('cities', "CityController");
    Route::post("get-provinces-by-region","HomeController@getProvincesByRegion")->name("get_provinces_by_region");
    Route::post("get-cities-by-province","HomeController@getCitiesByProvince")->name("get_cities_by_province");
    Route::post("get-youth-centers-by-province","HomeController@getYouthCentersByProvince")->name("get_youth_center_by_province");

    // youth centers
    Route::resource('youthCenters', "YouthCenterController");

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
});
