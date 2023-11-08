<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/Report.php';
require_once __DIR__ .'/../repository/ReportRepository.php';

class NewReportController extends AppController
{
    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';

    private $message = [];
    private $reportRepository;

    public function __construct()
    {
        parent::__construct();
        $this->reportRepository = new ReportRepository();
    }

    public function add_report()
    {
        if (!$this->isPost()) {
            return $this->render('add_report');
        }

        if ($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {
            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']
            );

            $report = new Report($_POST['title'], $_POST['description'], $_FILES['file']['name'], $_POST['latitude'], $_POST['longitude'], $_COOKIE['new_report_type'], null, null);
            $this->reportRepository->addReport($report);

            return $this->render('reports', ['messages' => $this->message]);
        }

        return $this->render('new_report', ['messages' => $this->message]);
    }

    public function add_report_calendar()
    {
        if (!$this->isPost()) {
            return $this->render('add_report_calendar');
        }

        if ($this->isPost()) {

            //$report = new Report($_POST['title'], $_POST['description'], $_FILES['file']['name']);
            $report = new Report($_POST['title'], $_POST['description'], null, $_POST['latitude'], $_POST['longitude'], $_COOKIE['new_report_type'], $_POST['date'], $_POST['contact']);
            $this->reportRepository->addReport($report);

            return $this->render('reports', ['messages' => $this->message]);
        }

        return $this->render('new_report', ['messages' => $this->message]);
    }

    private function validate(array $file): bool
    {
        if ($file['size'] > self::MAX_FILE_SIZE) {
            $this->message[] = 'File is too large for destination file system.';
            return false;
        }

        if (!isset($file['type']) || !in_array($file['type'], self::SUPPORTED_TYPES)) {
            $this->message[] = 'File type is not supported.';
            return false;
        }
        return true;
    }
}