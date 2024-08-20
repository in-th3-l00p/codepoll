<?php

namespace core\Http;

// application's main router
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
     * @return Route
     * @throws \Exception : if route not found
     */
    public function getRoute(string $name): Route
    {
        if (!isset($this->nameMap[$name]))
            throw new \Exception("Route with name $name not found");
        return $this->nameMap[$name];
    }

    /**
     * Get route by path
     * @param string $path : route path
     * @return Route : route object
     * @throws \Exception : if route not found
     */
    public function getRouteByPath(string $path): Route
    {
        if (!isset($this->routes[$path]))
            throw new \Exception("Route with path $path not found");
        return $this->routes[$path];
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