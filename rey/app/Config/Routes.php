<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Authentication Routes
// Authentication Routes
$routes->get('/', 'Auth::login');
$routes->get('/login', 'Auth::login');                // Show login page
$routes->post('/login', 'Auth::attemptLogin');       // Handle login
$routes->get('/register', 'Auth::register');        // Show register page
$routes->post('/register', 'Auth::attemptRegister'); // Handle registration
$routes->get('/logout', 'Auth::logout');


// Admin Dashboard Route
$routes->get('/admin/dashboard', 'Admin::dashboard');

// Admin - Manage Users
$routes->get('admin/home', 'Admin::dashboard');
$routes->get('/admin/manage-users', 'Admin::manageUsers');
$routes->get('/admin/create-user', 'Admin::createUser');
$routes->post('/admin/store-user', 'Admin::storeUser');
$routes->get('/admin/edit-user/(:num)', 'Admin::editUser/$1');
$routes->post('/admin/update-user/(:num)', 'Admin::updateUser/$1');
$routes->get('/admin/delete-user/(:num)', 'Admin::deleteUser/$1');

// Admin - Manage Services
$routes->get('/admin/manage-services', 'Admin::manageServices');
$routes->get('/admin/create-service', 'Admin::createService');
$routes->post('/admin/store-service', 'Admin::storeService');
$routes->get('/admin/edit-service/(:num)', 'Admin::editService/$1');
$routes->post('/admin/update-service/(:num)', 'Admin::updateService/$1');
$routes->get('/admin/delete-service/(:num)', 'Admin::deleteService/$1');

// Admin - Manage Appointments
$routes->get('/admin/manage-appointments', 'Admin::manageAppointments');
$routes->get('/admin/view-appointment/(:num)', 'Admin::viewAppointment/$1');
$routes->get('admin/reschedule-appointment/(:num)', 'Admin::rescheduleAppointment/$1');
$routes->post('/admin/update-appointment/(:num)', 'Admin::updateAppointment/$1');
$routes->get('/admin/delete-appointment/(:num)', 'Admin::deleteAppointment/$1');


// Admin - Manage Staff
$routes->get('/admin/manage-staff', 'Admin::manageStaff');
$routes->get('/admin/create-staff', 'Admin::createStaff');
$routes->post('/admin/store-staff', 'Admin::storeStaff');
$routes->get('/admin/edit-staff/(:num)', 'Admin::editStaff/$1');
$routes->post('/admin/update-staff/(:num)', 'Admin::updateStaff/$1');
$routes->get('/admin/delete-staff/(:num)', 'Admin::deleteStaff/$1');

// Admin - Manage Payments
$routes->get('/admin/manage-payments', 'Admin::managePayments');
$routes->get('/admin/view-payment/(:num)', 'Admin::viewPayment/$1');
$routes->post('/admin/issue-refund/(:num)', 'Admin::issueRefund/$1');
$routes->post('/admin/toggle-system', 'Admin::toggleSystemMode');

$routes->get('/maintenance', 'Home::maintenance');
$routes->get('/admin/network-logs', 'Admin::dashboard'); // Dashboard includes network logs
$routes->get('/admin/clear-network-logs', 'Admin::clearNetworkLogs');


// User Routes
$routes->get('user/dashboard', 'User::dashboard');
$routes->get('user/browse-services', 'User::browseServices');
$routes->post('user/book-appointment', 'User::bookAppointment');
$routes->get('user/view-appointments', 'User::viewAppointments');
$routes->get('/user/appointments', 'User::viewAppointments');
$routes->get('user/manage-profile', 'User::profile');
$routes->post('user/update-profile', 'User::updateProfile');
$routes->get('user/profile', 'User::profile');
$routes->get('user/reschedule-appointment/(:num)', 'User::rescheduleAppointment/$1');
$routes->post('user/reschedule-appointment/(:num)', 'User::updateAppointment/$1');
$routes->get('user/cancel-appointment/(:num)', 'User::cancelAppointment/$1');  // Add this line
$routes->get('user/logout', 'User::logout');


