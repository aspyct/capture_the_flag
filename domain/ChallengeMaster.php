<?php
interface ChallengeMaster {
    public function getCurrentChallenge(): Challenge;
    public function validateAnswer(string $answer): bool;
}
