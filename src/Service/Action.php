<?php

namespace Service;

class Action implements ActionInterface
{
    public function taskId()
    {
    	return $this->taskId;
    }

    public function userId();
    {
    	throw new Exception('Not implemented');
    }

    public function message();
    {
    	return $this->message();
    }
}