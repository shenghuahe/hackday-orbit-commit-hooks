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
        //@todo should return it
        return self::REPO_SPRING_LOOPS;
        $jsonDecoded = json_decode($data['payload']);
        if ($jsonDecoded['domain'] == self::REPO_SPRING_LOOPS)
        {
            return self::REPO_SPRING_LOOPS;
        }
        else
        {
            //@todo add the actual case properly
            return self::REPO_BIT_BUCKET;
        }
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