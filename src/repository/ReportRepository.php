<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Report.php';
require_once __DIR__.'/SessionRepository.php';

class ReportRepository extends Repository
{
    public function getReport(int $id): ?Report
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.reports WHERE id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $report = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$report) {
            return null;
        }

        return new Report(
            $report['title'],
            $report['description'],
            $report['image'],
            $report['latitude'],
            $report['longitude'],
            $report['type'],
            $report['date'],
            $report['contact']
        );
    }

    public function getReportData(int $id)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.reports WHERE id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addReport(Report $project): void
    {
        $date = new DateTime();
        $stmt = $this->database->connect()->prepare('
            INSERT INTO reports (title, description, image, created_at, id_assigned_by, latitude, longitude, type, date, contact)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ');

        $sessionRepository = new SessionRepository();
        if (isset($_COOKIE['id']) and isset($_COOKIE['login']) and $sessionRepository->isSession($_COOKIE['id'], $_COOKIE['login'])) {
            $assignedById = $_COOKIE['id'];
        }
        $assignedById = $_COOKIE['id'];

        $stmt->execute([
            $project->getTitle(),
            $project->getDescription(),
            $project->getImage(),
            $date->format('Y-m-d'),
            $assignedById,
            $project->getLatitude(),
            $project->getLongitude(),
            $project->getType(),
            $project->getDate(),
            $project->getContact()
        ]);

        $stmt = $this->database->connect()->prepare('
            SELECT id FROM reports WHERE latitude = :latitude AND longitude = :longitude
        ');
        $latitude = $project->getLatitude();
        $longitude = $project->getLongitude();
        $stmt->bindParam(':longitude', $longitude, PDO::PARAM_STR);
        $stmt->bindParam(':latitude', $latitude, PDO::PARAM_STR);
        $stmt->execute();

        $report = $stmt->fetch(PDO::FETCH_ASSOC);
        $idReport = $report['id'];

        $stmt = $this->database->connect()->prepare('
            INSERT INTO user_reports (id_user, id_report)
            VALUES (?, ?)
        ');

        $stmt->execute([
            $assignedById,
            $idReport
        ]);
    }

    public function removeReport(int $id) {
        $stmt = $this->database->connect()->prepare('
            DELETE FROM public.reports WHERE id = :id
        ');

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function getReports(string $searchedString)
    {
        if (empty($searchedString)) {
            $stmt = $this->database->connect()->prepare('
                SELECT * FROM reports
            ');
        } else {
            $searchedString = '%' . strtolower($searchedString) . '%';
            $stmt = $this->database->connect()->prepare('
                SELECT * FROM reports WHERE LOWER(title) LIKE :search OR LOWER(description) LIKE :search
            ');
            $stmt->bindParam(':search', $searchedString, PDO::PARAM_STR);
        }

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}