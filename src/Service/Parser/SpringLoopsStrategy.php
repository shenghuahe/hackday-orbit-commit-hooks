<?php

namespace Service\Parser;

class SpringLoopsStrategy implements ParserStrategyInterface
{

    public function parse(array $data)
    {
        $decoded = json_decode($data['payload']);
        $message = $decoded['commitMessage'];
        preg_match("/{{#TASK_ID ([0-9]+)}}/", $message, $matches);
        $taskId = $matches[1];

        $action = new Service\Action();
        
    }

}