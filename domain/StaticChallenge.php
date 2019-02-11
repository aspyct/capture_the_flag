<?php
class StaticChallenge implements Challenge {
    private $title;
    private $bodyFile;
    private $expectedAnswer;
    private $placeholder;
    
    public function __construct($title, $bodyFile, $expectedAnswer, $placeholder = '') {
        $this->title = $title;
        $this->bodyFile = $bodyFile;
        $this->expectedAnswer = $expectedAnswer;
        $this->placeholder = $placeholder;
    }

    public function getBody(): string {
        # TODO Possibly dangerous.
        # Limit the includes to a specific folder
        if (preg_match("/^[0-9a-zA-Z-]+\\.(php|html)$/", $this->bodyFile)) {
            ob_start();
            require(BODY_INCLUDE_PATH . $this->bodyFile);
            return ob_get_clean();
        }
        else {
            die("Body file names may contain letters, numbers and dashes," .
                    " and must end with .php or .html");
        }
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function validate(string $answer): bool {
        return strtolower($answer) == strtolower($this->expectedAnswer);
    }

    public function getAnswerPlaceholder(): string {
        return $this->placeholder;
    }
}
