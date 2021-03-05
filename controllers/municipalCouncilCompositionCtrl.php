<?php
$councilComposition = new councilComposition();
$theMayor = $councilComposition->showMayor();
$mayorExists = $councilComposition->numberOfMember();
$assistants = $councilComposition->showAssistants();
$numberOfAssistants = $councilComposition->numberOfMember();
$advisors = $councilComposition->showAdvisor();
$numberOfAdvisors = $councilComposition->showAdvisor();
$otherMembers = $councilComposition->showOtherMembers();
$numberOfOtherMembers = $councilComposition->showAdvisor();