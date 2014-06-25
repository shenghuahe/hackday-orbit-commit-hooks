<?php

namespace Service\Parser;

class SpringLoopsStrategy implements ParserStrategyInterface
{

    public function parse(array $data)
    {
    	// decode data payload
        $decoded = (array)json_decode($data['payload']);
        //@todo to be removed 
        //$decoded = array('commitMessage' => "{{#TASK_ID 123123098}} {{#MESSAGE a oasifjoasdifsaoid }}");
        $message = $decoded['commitMessage'];

        // get taskId matches
        $matches = array();
        preg_match("/{{#TASK_ID ([0-9]+)}}/u", $message, $matches);
        $taskId = $matches[1];

        // get message matches
        $matches = array();
        preg_match("/{{#MESSAGE (.*)}}/u", $message, $matches);
        $message = $matches[1];

        // get time spent matches
        $matches = array();
        preg_match("/{{#TIME_SPENT ([0-9]+)}}/u", $message, $matches);
        $timeSpent = $matches[1];

        // add stuff to action object
        $action = new \Service\Action();
        $action->taskId = $taskId;
        $action->message = $message;
        $action->timeSpent = $timeSpent

        return $action;
    }

}