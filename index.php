<?php declare(strict_types=1);

session_start();
define('BODY_INCLUDE_PATH', __DIR__ . '/challenges/body/');

function autoload($className) {
    $expectedFilename = __DIR__ . '/domain/' . $className . '.php';
    require_once($expectedFilename);
}

function render(string $_template, array $vars = []): string {
    extract($vars);
    
    ob_start();
    include('./templates/' . $_template . '.php');
    return ob_get_clean();
}

function main() {
    $challengeList = require('./challenges/definitions.php');
    $sessionHandle = new SimpleSessionHandle('DefaultChallengeMaster');
    
    $challengeMaster = new DefaultChallengeMaster($sessionHandle, $challengeList);
    
    if ($challengeMaster->isFinished()) {
        echo render('success');
    }
    else {
        if (isset($_POST['answer'])) {
            $challengeMaster->validateAnswer($_POST['answer']);

            header('Location: index.php');
            die("You should be redirected to <a href='/index.php'>the next challenge</a>.");
        }

        $challenge = $challengeMaster->getCurrentChallenge();
        echo render('form', [
            'challenge' => $challenge
        ]);
    }
}

spl_autoload_register('autoload');
main();
