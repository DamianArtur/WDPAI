<?php

require 'Router.php';

//phpinfo();

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Router::get('', 'ReportsController');
Router::get('reports', 'ReportsController');

Router::get('login', 'DefaultController');
Router::get('logout', 'SecurityController');
Router::get('register', 'DefaultController');
Router::get('report_view', 'ReportViewController');
Router::get('new_report', 'DefaultController');

Router::post('login', 'SecurityController');
Router::post('register', 'SecurityController');
Router::post('retrieve', 'ReportsController');
Router::post('get_report', 'ReportsController');
Router::post('delete', 'ReportsController');

Router::post('add_report', 'NewReportController');
Router::post('add_report_calendar', 'NewReportController');

Router::run($path);