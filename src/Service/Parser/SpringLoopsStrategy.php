<?php

namespace Service\Parser;

class SpringLoopsStrategy implements ParserStrategyInterface
{

    public function parse(array $data)
    {
    	// decode data payload
        $decoded = json_decode($data['payload']);
        //@todo to be removed 
        //$decoded = array('commitMessage' => "{{#TASK_ID 123123098}} {{#MESSAGE a oasifjoasdifsaoid }}");
        $message = $decoded['commitMessage'];

        // get taskId matches
        $matches = array();
        preg_match("/{{#TASK_ID ([0-9]+)}}/", $message, $matches);
        $taskId = $matches[1];

        // get message matches
        $matches = array();
        preg_match("/{{#MESSAGE (.*)}}/", $message, $matches);
        $message = $matches[1];

        // add stuff to action object
        $action = new \Service\Action();
        $action->taskId = $taskId;
        $action->message = $message;

        return $action;
    }

}