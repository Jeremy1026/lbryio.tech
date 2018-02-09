<?php

class Controller
{
  const CACHE_CLEAR_PATH = '/clear-cache';

  protected static $queuedFunctions = [];

  public static function dispatch($uri)
  {
    try
    {
      if (IS_PRODUCTION && function_exists('newrelic_name_transaction'))
      {
        newrelic_name_transaction(Request::getMethod() . ' ' . strtolower($uri));
      }

      $viewAndParams  = static::execute(Request::getMethod(), $uri);
      $viewTemplate   = $viewAndParams[0];
      $viewParameters = $viewAndParams[1] ?? [];
      if (!IS_PRODUCTION && isset($viewAndParams[2]))
      {
        throw new Exception('use response::setheader instead of returning headers');
      }

      if (!$viewTemplate)
      {
        if ($viewTemplate !== null)
        {
          throw new LogicException('All execute methods must return a template or NULL.');
        }
      }
      else
      {
        $layout = !(isset($viewParameters['_no_layout']) && $viewParameters['_no_layout']);
        unset($viewParameters['_no_layout']);

        $layoutParams = $viewParameters[View::LAYOUT_PARAMS] ?? [];
        unset($viewParameters[View::LAYOUT_PARAMS]);

        $content = View::render($viewTemplate, $viewParameters + ['fullPage' => true]);

        Response::setContent($layout ? View::render('layout/basic', ['content' => $content] + $layoutParams) : $content);
      }

      Response::setDefaultSecurityHeaders();
      if (Request::isGzipAccepted())
      {
        Response::gzipContentIfNotDisabled();
      }

      Response::send();
    }
    catch (StopException $e)
    {

    }
  }

  public static function execute($method, $uri)
  {
    $router = static::getRouterWithRoutes();
    static::performSubdomainRedirects();
    try
    {
      $dispatcher = new Routing\Dispatcher($router->getData());
      return $dispatcher->dispatch($method, $uri);
    }
    catch (\Routing\HttpRouteNotFoundException $e)
    {
      return NavActions::execute404();
    }
    catch (\Routing\HttpMethodNotAllowedException $e)
    {
      Response::setStatus(405);
      Response::setHeader('Allow', implode(', ', $e->getAllowedMethods()));
      return ['page/405'];
    }
  }

  protected static function performSubdomainRedirects()
  {
    $subDomain = Request::getSubDomain();

    switch($subDomain) {
      case 'chat':
      case 'slack':
        return static::redirect('https://discordapp.com/invite/U5aRyN6');
    }
  }
  
  protected static function getRouterWithRoutes(): \Routing\RouteCollector
  {
    $router = new Routing\RouteCollector();

    $router->get(['/', 'home'], 'ContentActions::executeHome');

    $router->get(['/courses', 'courses'], 'DeveloperActions::executeCourses');
    $router->get('/courses/{lesson}/{step}?', 'DeveloperActions::executeLearn');

    $permanentRedirects = [
    ];

    $tempRedirects = [
    ];


    foreach ([307 => $tempRedirects, 301 => $permanentRedirects] as $code => $redirects)
    {
      foreach ($redirects as $src => $target)
      {
        $router->any($src, function () use ($target, $code) { return static::redirect($target, $code); });
      }
    }

    $router->get([ContentActions::URL_CREDIT_REPORTS . '/{year:c}-q{quarter:c}', ContentActions::URL_CREDIT_REPORTS . '/{year:c}-Q{quarter:c}'], 'ContentActions::executeCreditReport');

    $router->get('/{slug}', function (string $slug)
    {
      if (View::exists('page/' . $slug))
      {
        Response::enableHttpCache();
        return ['page/' . $slug, []];
      }
      else
      {
        return NavActions::execute404();
      }
    });

    return $router;
  }

  public static function redirect($url, $statusCode = 302)
  {
    if (!$url)
    {
      throw new InvalidArgumentException('Cannot redirect to an empty URL.');
    }

    $url = str_replace('&amp;', '&', $url);

    Response::setStatus($statusCode);

    if ($statusCode == 201 || ($statusCode >= 300 && $statusCode < 400))
    {
      Response::setHeader(Response::HEADER_LOCATION, $url);
    }

    return ['internal/redirect', ['url' => $url]];
  }

  public static function queueToRunAfterResponse(callable $fn)
  {
    static::$queuedFunctions[] = $fn;
  }

  public static function shutdown()
  {
    while ($fn = array_shift(static::$queuedFunctions))
    {
      call_user_func($fn);
    }
  }
}
