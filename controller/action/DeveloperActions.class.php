<?php

class DeveloperActions extends Actions
{
  const DEVELOPER_REWARD = 10,
    API_DOC_URL = 'https://lbryio.github.io/lbry/';

  public static function executeLearn(string $course = null, string $step = null)
  {
    $stepLabels  = static::getLessonsForCourse($course);

    $allSteps    = array_keys($stepLabels);
    $currentStep = $step ?: $allSteps[0];
    $currentStepLong = $stepLabels[$currentStep] ?: $allSteps[0];
    $stepNum = array_search($currentStep, array_keys($stepLabels));

    $viewParams = [
      'stepNum'	    => $stepNum,
      'currentStep' => $currentStepLong,
      'stepLabels'  => $allSteps,
      'course'      => $course
    ];

    return ['developer/lesson', $viewParams];
  }

  protected static function getLessonsForCourse($course) {

    $courses = [
      'basics'     => [
                        'home'     => 'Introduction',
                        'help'     => 'Help',
                        'commands' => 'Commands'
                      ],
      'content'    => [
                      ],
      'blockchain' => [
                      ]
    ];

    return $courses[$course];

  }

  public static function executeCourses() {

    $courses = [
      'basics'     => 'Introduction to the API',
      'content'    => 'Publishing and downloading content',
      'blockchain' => 'Working with the blockchain'
    ];

    $courseShortNames = array_flip($courses);

    $viewParams = [
      'courses'           => $courses,
      'courseShortNames'  => $courseShortNames
    ];

    return ['developer/courses', $viewParams];
  }
}
