<?php
use App\Core\Router;
use App\Controllers\EmployeeController;

$router = new Router();

// تسجيل الدخول والخروج أولًا
$router->get('login', 'AuthController@login');
$router->post('login', 'AuthController@doLogin');
$router->get('logout', 'AuthController@logout');

$router->get('admin', 'HomeController@admin');
$router->get('manager', 'HomeController@manager');
$router->get('employee', 'HomeController@employee');
$router->get('', 'HomeController@index');

$router->get('employees', 'EmployeeController@index');
$router->get('employees/create', 'EmployeeController@createForm');
$router->post('employees/create', 'EmployeeController@store');
$router->get('employees/edit/{id}', 'EmployeeController@editForm');
$router->post('employees/edit/{id}', 'EmployeeController@update');
$router->get('employees/delete/{id}', 'EmployeeController@delete');

$router->dispatch($_GET['url'] ?? '', $_SERVER['REQUEST_METHOD']);
?>