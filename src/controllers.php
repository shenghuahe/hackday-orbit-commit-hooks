<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Silex\Provider\DoctrineServiceProvider;
use Service\Parser\RepositoryHookParser;

//Request::setTrustedProxies(array('127.0.0.1'));
$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html', array());
})
->bind('homepage');

$app->post('/api/action', function (Request $request) use ($app) {
    
    error_log($request->getContent());
    $dbConfig = require_once(__DIR__.'/../config/db/doctrine.config.php');
    $app->register(new \Silex\Provider\DoctrineServiceProvider(), array(
        'db.options' => $dbConfig
    ));
//    $hookParser = new RepositoryHookParser();
//    switch($hookParser->identifyRequest($data))
//    {
//        case RepositoryHookParser::REPO_BIT_BUCKET:
//            $action = $hookParser->constructAction(new \Service\Parser\BitBucketStrategy(), $data);
//            break;
//        case RepositoryHookParser::REPO_SPRING_LOOPS:
//            $action = $hookParser->constructAction(new \Service\Parser\SpringLoopsStrategy(), $data);
//            break;
//        default:
//    }
//    $sql = "SELECT * FROM `changelog`";
//    $post = $app['db']->fetchAll($sql);
//    $postData = $request->getContent();
//    echo "<pre>";
//    print_r($postData);
//    print_r($post);
//    echo "</pre>";
    return new Response('Action received', 201);
});

$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    // 404.html, or 40x.html, or 4xx.html, or error.html
    $templates = array(
        'errors/'.$code.'.html',
        'errors/'.substr($code, 0, 2).'x.html',
        'errors/'.substr($code, 0, 1).'xx.html',
        'errors/default.html',
    );

    return new Response($app['twig']->resolveTemplate($templates)->render(array('code' => $code)), $code);
});
