<?php
return new DefaultChallengeMaster(
    new StaticChallenge("Life, Universe and Everything", "everything.php", "42", "It's a number"),
    new StaticChallenge("What's my name?", 'whatsmyname.php', 'Antoine', 'Some name')
);
