<?php

namespace Service\Parser;

class BitBucketStrategy implements ParserStrategyInterface
{

    public function parse(array $json)
    {
        // decode data payload
        $decoded = (array)json_decode($data['payload']);
        //@todo to be removed 
        //$decoded = array('commitMessage' => "{{#TASK_ID 123123098}} {{#MESSAGE a oasifjoasdifsaoid }}");
        $message = $decoded['message'];

        // get taskId matches
        $matches = array();
        preg_match("/{{#TASK_ID ([0-9]+)}}/", $message, $matches);
        $taskId = $matches[1];

        // get message matches
        $matches = array();
        preg_match("/{{#MESSAGE (.*)}}/", $message, $matches);
        $message = $matches[1];

        // get time spent matches
        $matches = array();
        preg_match("/{{#TIME_SPENT ([0-9]+)}}/", $message, $matches);
        $timeSpent = $matches[1];

        // add stuff to action object
        $action = new \Service\Action();
        $action->taskId = $taskId;
        $action->message = $message;
        $action->timeSpent = $timeSpent

        return $action;
    }

}