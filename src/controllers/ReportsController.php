<?php

class ReportsController extends AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->reportsRepository = new ReportRepository();
    }

    public function index()
    {
        $this->render('reports');
    }

    public function reports()
    {
        $this->render('reports');
    }

    public function retrieve()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);

            echo json_encode($this->reportsRepository->getReports($decoded));
        }
    }

    public function get_report() {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);

            echo json_encode($this->reportsRepository->getReportData((int)$decoded));
        }
    }

    public function delete() {
        $reportsRepository = new ReportRepository();
        $reportsRepository->removeReport($_COOKIE['report_id']);

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/reports");
    }
}