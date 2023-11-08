<?php

require_once 'AppController.php';

class DefaultController extends AppController {

    public function index()
    {
        $this->render('reports');
    }

    public function new_report()
    {
        $this->render('new_report');
    }

    public function new_report_photo()
    {
        $this->render('new_report_photo');
    }

    public function login() {
        $this->render('login');
    }

    public function register() {
        $this->render('register');
    }

    public function report_view() {
        $this->render('report_view');
    }
}