<?php declare(strict_types=1);

session_start();
define('BODY_INCLUDE_PATH', __DIR__ . '/challenges/body/');

function autoload($className) {
    $expectedFilename = __DIR__ . '/domain/' . $className . '.php';
    require_once($expectedFilename);
}

function render(Challenge $challenge): string {
    ob_start();
    include('./templates/form.php');
    return ob_get_clean();
}

function main() {
    $challengeMaster = require('./challenges/definitions.php');
    $challengeMaster->recoverSession($_SESSION['contestant']);

    if (isset($_POST['answer'])) {
        $challengeMaster->submitAnswer($_POST['answer']);
    }

    $challenge = $challengeMaster->getCurrentChallenge();

    $_SESSION['contestant'] = $challengeMaster->exportSession();
    
    echo render($challenge);
}

spl_autoload_register('autoload');
main();
