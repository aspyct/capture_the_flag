<?php
class DefaultChallengeMaster implements \ChallengeMaster {
    private $currentChallengeOffset;
    private $challengeList;
    
    public function __construct(...$challengeList) {
        $this->currentChallengeOffset = 0;
        $this->challengeList = $challengeList;
    }
    
    public function getCurrentChallenge(): \Challenge {
        return $this->challengeList[$this->currentChallengeOffset];
    }

    public function exportSession() {
        
    }

    public function recoverSession($contestant) {
        
    }

    public function submitAnswer(string $answer): bool {
        $challenge = $this->getCurrentChallenge();
        
        if ($challenge->validate($answer)) {
            $this->currentChallengeOffset += 1;
            return true;
        }
        
        return false;
    }
}
