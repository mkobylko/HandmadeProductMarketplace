<?php

namespace controllers;

use core\Controller;
use core\Database;

class BackupArchiveController extends Controller
{
    public function indexAction()
    {
        if (!$this->authenticated(true)) {
            return;
        }

        $this->render("views/backupAndArchive.php");
    }

    public function backupAction()
    {
        if (!$this->authenticated(true)) {
            return;
        }

        $db = Database::getInstance();
        $db->backup();
    }

    public function archiveAction()
    {
        if (!$this->authenticated(true)) {
            return;
        }

        $db = Database::getInstance();
        $db->archive($db->conn);
    }
}