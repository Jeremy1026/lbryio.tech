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

  public static function prepareLessonPartial(array $vars): array
  {
    $lesson = $vars['lesson'];
    $path   = 'lesson/' . $lesson . '.md';
    list($metadata, $instructionsHtml) = View::parseMarkdown($path);
    return $vars + $metadata + [
      'instructionsHtml' => $instructionsHtml,
    ];

  }

  public static function preparePostAuthorPartial(array $vars): array
  {
    $post = $vars['post'];
    return [
      'authorName'    => $post->getAuthorName(),
      'photoImgSrc'   => $post->getAuthorPhoto(),
      'authorBioHtml' => $post->getAuthorBioHtml()
    ];
  }

  public static function preparePostListPartial(array $vars): array
  {
    $count = $vars['count'] ?? 3;
    return [
      'posts' => array_slice(Post::find(static::VIEW_FOLDER_NEWS, Post::SORT_DATE_DESC), 0, $count)
    ];
  }
  public static function executePostCategoryFilter(string $category)
  {
    Response::enableHttpCache();

    $filter_post = [];

    $posts = array_filter(
      Post::find(static::VIEW_FOLDER_NEWS, Post::SORT_DATE_DESC),
      function(Post $post) use ($category)  {
        return (($post->getCategory() === $category) && (!$post->getDate() || $post->getDate()->format('U') <= date('U')));
      });



    return ['content/news', [
      'posts'             => $posts,
      View::LAYOUT_PARAMS => [
        'showRssLink' => true
      ]
    ]];
  }
}
