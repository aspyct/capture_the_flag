<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $challenge->getTitle(); ?> | Capture the flag!</title>
        <link rel="stylesheet" href="normalize.css" />
    </head>
    <body>
        <?php echo $challenge->getBody() ?>
        <form method="post">
            Your answer:
            <input type="text" name="answer" placeholder="<?php echo $challenge->getAnswerPlaceholder(); ?>"/>
            <input type="submit" value="Submit" />
        </form>
    </body>
</html>
