<?php

require_once 'Repository.php';
class SessionRepository extends Repository
{
    public function addSession(int $id, string $login)
    {
        if ($this->isSession($id, $login)) {
            return;
        }

        $stmt = $this->database->connect()->prepare('
            INSERT INTO sesssions (id, login)
            VALUES (?, ?)
        ');

        $stmt->execute([
            $id,
            $login
        ]);
    }

    public function removeSession(int $id, string $login)
    {
        $stmt = $this->database->connect()->prepare('
            DELETE FROM sesssions WHERE id=? AND login=?
        ');

        $stmt->execute([
            $id,
            $login
        ]);
    }

    public function isSession(int $id, string $login): bool
    {
        $stmt = $this->database->connect()->prepare('
            select count(*) from sesssions where id=:id AND login=:login
        ');

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':login', $login, PDO::PARAM_STR);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data['count'] == 1) {
            return true;
        } else {
            return false;
        }
    }
}