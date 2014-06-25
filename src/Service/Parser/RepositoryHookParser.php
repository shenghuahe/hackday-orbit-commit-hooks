<?php

namespace Service\Parser;

class RepositoryHookParser
{

    const REPO_SPRING_LOOPS = 'springloops.io';
    const REPO_BIT_BUCKET   = 'bitbucket.org';

    /**
     * 
     * @param array $data
     * @return REPO_SPRING_LOOPS | REPO_BIT_BUCKET
     */
    public function identifyRequest(array $data)
    {
        
    }

    /**
     * 
     * @param ParserStrategyInterface $ps
     * @param array $data
     * @return \Service\ActionInterface
     */
    public function constructAction(ParserStrategyInterface $ps, array $data)
    {
        return $ps->parse($data);
    }

}