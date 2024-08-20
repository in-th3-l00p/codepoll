<?php

namespace core\Http;


// application's main router
use function core\Utils\notFound;

class Router
{
    private $routes = [];
    private $nameMap = [];

    /**
     * Add route to the router
     * @param Route $route : route object
     */
    public function add(Route $route)
    {
        $this->routes[$route->getPath()] = $route;
        $this->nameMap[$route->getName()] = $route;
    }

    /**
     * Get route by name
     * @param string $name : route name
     * @return Route|null
     */
    public function getRoute(string $name): ?Route
    {
        return $this->nameMap[$name] ?? null;
    }

    /**
     * Get route by path
     * @param string $path : route path
     * @return Route|null
     */
    public function getRouteByPath(string $path): ?Route
    {
        return $this->routes[$path] ?? null;
    }

    /**
     * Get all routes
     * @return array
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }

    /**
     * Handle the request
     */
    public function handle(): void
    {
        $url = parse_url($_SERVER['REQUEST_URI']);
        $route = $this->getRouteByPath($url["path"]);
        if ($route)
            $route->handle();
        else
            notFound();
    }
}