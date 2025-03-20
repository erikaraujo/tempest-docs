<?php

namespace App\Web\Documentation;

use Tempest\Container\Container;
use Tempest\Core\KernelEvent;
use Tempest\EventBus\EventHandler;
use Tempest\Router\HttpMiddleware;
use Tempest\Router\HttpMiddlewareCallable;
use Tempest\Router\MatchedRoute;
use Tempest\Router\Request;
use Tempest\Router\Response;
use Tempest\Router\Responses\NotFound;
use Tempest\Router\Responses\Redirect;
use Tempest\Router\Router;

use function Tempest\get;
use function Tempest\Support\Regex\matches;
use function Tempest\Support\str;
use function Tempest\uri;

final readonly class RedirectMiddleware implements HttpMiddleware
{
    public function __construct(
        private Router $router,
    ) {
    }

    #[EventHandler(KernelEvent::BOOTED)]
    public function register(): void
    {
        $this->router->addMiddleware(self::class);
    }

    #[\Override]
    public function __invoke(Request $request, HttpMiddlewareCallable $next): Response
    {
        $path = str($request->path);
        $response = $next($request);
        $matched = get(MatchedRoute::class);
        $version = Version::tryFromString($matched->params['version']);

        // If not a docs page, let's just continue normal flow
        if ($matched->route->uri !== '/{version}/{category}/{slug}') {
            return $response;
        }

        // Redirect to slugs without numbers
        if (matches($matched->params['category'], '/^\d+-/') || matches($matched->params['slug'], '/^\d+-/')) {
            return new Redirect($path->replaceRegex('/\/\d+-/', '/'));
        }

        // Redirect to actual version
        if ($version->value !== $matched->params['version']) {
            return new Redirect($path->replace("/{$matched->params['version']}/", "/{$version->value}/"));
        }

        // Redirect to docs index if not found
        if ($response instanceof NotFound) {
            return new Redirect(uri([ChapterController::class, 'index']));
        }

        return $response;
    }
}
