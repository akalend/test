<?php

/**
 * Step 1: Require the Slim Framework
 *
 * If you are not using Composer, you need to require the
 * Slim Framework and register its PSR-0 autoloader.
 *
 * If you are using Composer, you can skip this step.
 */

session_cache_limiter(false);
session_start();
ini_set('display_errors', 1);
ini_set('html_errors', 0);

require '../slim/slim/Slim/Slim.php';

require 'config.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim($config);


$level= \Slim\Log::DEBUG;

$app->config('debug_mode', true);


$app->notFound(function (){
    echo 'route notFound',PHP_EOL;
    exit;
});

if ( $app->config('security')){
    $apiKey = $app->request->headers->get("X-API-KEY");
    if (!$apiKey){ 
        echo 'api key absent';
        exit;
    };
    if ($apiKey != $app->config('apikey')){
        echo 'api key error';
        exit;
    }
    
}

$app->get(
    '/api/get',
    function () {
        $app->response->write('********');
        return;        
    }
);

$app->get(
    '/api/capcha/',
    function ()  use($app) {
        require 'capcha.php';

        capcha($app->config('salt'));
        exit();
    }
);


$app->post(
    '/api/check',
    function() use($app) {

    
    if( $_SESSION['count'] === md5( $app->request->post('code') . $app->config('salt')) ) {
        $app->response->write("OK");
    } else
        $app->response->redirect('/api/info');
    }
);


$app->get(
    '/api/info',
    function () {
        $template = <<<EOT
        <h2>rooot akalend </h2>
            <section style="padding-bottom: 20px">
                <h2>name</h2>
                <p>
                   text info
                </p>
            </section>
            <section style="padding-bottom: 20px">
                <h2>name</h2>
                <p>
                   text info
                </p>
            </section>

            <section style="padding-bottom: 20px">
                <img src="/api/capcha/?123">
                <form action="/api/check" method="post">
                   <input name="code">
                   <input type="submit" >
                </p>
            </section>


        </body>
    </html>
EOT;
        echo $template;
    }
);

$app->run();