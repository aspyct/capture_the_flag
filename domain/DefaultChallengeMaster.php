<?php
class DefaultChallengeMaster implements \ChallengeMaster {
    private $sessionHandle;
    private $challengeList;
    
    public function __construct(SessionHandle $sessionHandle, $challengeList) {
        $this->sessionHandle = $sessionHandle;
        $this->challengeList = $challengeList;
    }
    
    public function getCurrentChallenge(): \Challenge {
        return $this->challengeList[$this->getCurrentChallengeOffset()];
    }

    public function validateAnswer(string $answer): bool {
        $challenge = $this->getCurrentChallenge();
        
        if ($challenge->validate($answer)) {
            $this->incrementChallengeOffset();
            return true;
        }
        
        return false;
    }
    
    private function getCurrentChallengeOffset(): int {
        return $this->sessionHandle->getValue(0);
    }
    
    private function incrementChallengeOffset() {
        $currentOffset = $this->getCurrentChallengeOffset();
        $this->sessionHandle->setValue($currentOffset + 1);
    }
}
