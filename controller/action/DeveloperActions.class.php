<?php

class DeveloperActions extends Actions
{
  const DEVELOPER_REWARD = 10,
    API_DOC_URL = 'https://lbryio.github.io/lbry/';

  public static function executeLearn(string $step = null)
  {
    $stepLabels  = [
      'home'     => 'Home',
      'intro'    => 'Introduction',
      'help'     => 'Help',
      'commands' => 'Commands'
    ];

    $allSteps    = array_keys($stepLabels);
    $currentStep = $step ?: $allSteps[0];
    $currentStepLong = $stepLabels[$currentStep] ?: $allSteps[0];
    $stepNum = array_search($currentStep, array_keys($stepLabels));

    $viewParams = [
      'stepNum'	    => $stepNum,
      'currentStep' => $currentStepLong,
      'stepLabels'  => $allSteps
    ];

    return ['developer/learn', $viewParams];
  }
}
