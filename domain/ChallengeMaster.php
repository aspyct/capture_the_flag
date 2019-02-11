<?php
interface ChallengeMaster {
    public function recoverSession($contestant);
    public function exportSession();
    public function getCurrentChallenge(): Challenge;
    public function submitAnswer(string $answer): bool;
}
