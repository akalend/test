<?php

/**
 * Step 1: Require the Slim Framework
 *
 * If you are not using Composer, you need to require the
 * Slim Framework and register its PSR-0 autoloader.
 *
 * If you are using Composer, you can skip this step.
 */
require '../slim/slim/Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();


$app->get(
    '/api/get',
    function () {

        echo "*****<br>";
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

        </body>
    </html>
EOT;
        echo $template;
    }
);

$app->run();