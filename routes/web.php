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

    // Bookings
    Route::delete('bookings/destroy', 'BookingController@massDestroy')->name('bookings.massDestroy');
    Route::resource('bookings', 'BookingController');
    Route::post('bookings/unavailability', 'BookingController@saveUnavailability')->name('save_unavailability');
    Route::get('bookings/unavailability/create', 'BookingController@createUnavailability')->name('create_unavailability');
    Route::get('bookings/unavailability/edit/{id}', 'BookingController@editUnavailability')->name('edit_unavailability');
    Route::delete('bookings/unavailability/delete/{booking}', 'BookingController@destroyUnavailabilityBooking')->name('delete_unavailability');
    
    // cities
    Route::resource('cities', "CityController");
    Route::post("get-provinces-by-region","HomeController@getProvincesByRegion")->name("get_provinces_by_region");
    Route::post("get-cities-by-province","HomeController@getCitiesByProvince")->name("get_cities_by_province");
    Route::post("get-youth-centers-by-province","HomeController@getYouthCentersByProvince")->name("get_youth_center_by_province");
    Route::post("get-services-by-youth-center","HomeController@getServicesByYouthCenter")->name("get_services_by_youth_center");

    // youth centers
    Route::resource('youthCenters', "YouthCenterController");

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
    Route::match(['get', 'post'], 'system-calendar/search', "SystemCalendarController@index")->name('calendar_searching');
});
