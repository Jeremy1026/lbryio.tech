<?php

class ContentActions extends Actions
{
  const
    SLUG_RSS = 'rss.xml',
    SLUG_NEWS = 'news',
    SLUG_FAQ = 'faq',
    SLUG_PRESS = 'press',
    SLUG_BOUNTY = 'bounty',
    SLUG_CREDIT_REPORTS = 'credit-reports',

    URL_NEWS = '/' . self::SLUG_NEWS,
    URL_FAQ = '/' . self::SLUG_FAQ,
    URL_PRESS = '/' . self::SLUG_PRESS,
    URL_BOUNTY = '/' . self::SLUG_BOUNTY,
    URL_CREDIT_REPORTS = '/' . self::SLUG_CREDIT_REPORTS,

    CONTENT_DIR = ROOT_DIR . '/content',

    VIEW_FOLDER_NEWS = self::CONTENT_DIR . '/' . self::SLUG_NEWS,
    VIEW_FOLDER_FAQ = self::CONTENT_DIR . '/' . self::SLUG_FAQ,
    VIEW_FOLDER_BOUNTY = self::CONTENT_DIR . '/' . self::SLUG_BOUNTY,
    VIEW_FOLDER_PRESS = self::CONTENT_DIR . '/' . self::SLUG_PRESS,
    VIEW_FOLDER_CREDIT_REPORTS = self::CONTENT_DIR . '/' . self::SLUG_CREDIT_REPORTS;

  public static function executeHome(): array
  {
    Response::enableHttpCache();
    return ['page/home'];
  }
  
  public static function prepareLessonPartial(array $vars): array
  {
    $lesson = $vars['lesson'];
    $course = $vars['course'];
    $stepNum = $vars['steps']['stepNum'];
    $stepLabels = $vars['steps']['stepLabels'];
    $path   = 'lesson/' . $lesson . '.md';
    list($metadata, $instructionsHtml) = View::parseMarkdown($path);
    return $vars + $metadata + [
      'instructionsHtml' => $instructionsHtml,
      'stepNum'          => $stepNum,
      'stepLabels'       => $stepLabels,
      'course'           => $course
    ];

  }

  public static function prepareCoursesPartial(array $vars): array
  {
    $course = $vars['course'];
    $path   = 'courses/' . ucfirst($course) . '.md';
    list($metadata, $description) = View::parseMarkdown($path);
    return $vars + $metadata + [
      'course'      => $course,
      'description' => $description
    ];
  }

}
