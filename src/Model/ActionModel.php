<?php

namespace Model;

class ActionModel
{

    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function addAction(\Service\ActionInterface $action)
    {
        $taskId   = $action->taskId();
        $personId = 1000001308;
        $message  = $action->message();
        $date     = new \DateTime('now');
        $sql      = "INSERT INTO `actions` (`taskId`, `createdBy`, `actionNotes`, `date`)
            VALUES (" . (int) $taskId . ", " . (int) $personId . ", \"" . mysql_real_escape_string($message) . "\",
                \"" . $date->format('Y-m-d') . "\")";
        return $this->db->exec($sql);
    }

}