<?php
interface Challenge {
    public function getTitle(): string;
    public function getBody(): string;
    public function getAnswerPlaceholder(): string;
    public function validate(string $answer) : bool;
}
