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
    $challengeList = require('./challenges/definitions.php');
    $sessionHandle = new SimpleSessionHandle('DefaultChallengeMaster');
    
    $challengeMaster = new DefaultChallengeMaster($sessionHandle, $challengeList);

    if (isset($_POST['answer'])) {
        $success = $challengeMaster->validateAnswer($_POST['answer']);
        
        if ($success) {
            header('Location: index.php');
            die("Well done! You should be redirected to <a href='/index.php'>the next challenge</a>.");
        }
    }

    $challenge = $challengeMaster->getCurrentChallenge();
    
    echo render($challenge);
}

spl_autoload_register('autoload');
main();
