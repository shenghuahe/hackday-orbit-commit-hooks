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
        $timeSpent = $action->timeSpent();
        error_log('timespent:'.$timeSpent);
        $date     = new \DateTime('now');
        $sql      = "INSERT INTO `actions` (`taskId`, `createdBy`, `internalAssignment`, `actionNotes`, `date`, `timeSpent`)
            VALUES (" . (int) $taskId . ", " . (int) $personId . "," . (int) $personId . ", \"" . addslashes($message) . "\",
                \"" . $date->format('Y-m-d') . "\", ".(int)$timeSpent.")";
        return $this->db->exec($sql);
    }

}