<?php

namespace Service\Parser;

interface ParserStrategyInterface
{

    /**
     * 
     * @param array $data
     * @return \Service\ActionInterface
     */
    public function parse(array $data);
}
