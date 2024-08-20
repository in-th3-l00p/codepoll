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
        $this->routes[$route->getName()] = $route;
    }

    /**
     * Get route by name
     * @param string $name : route name
     * @return Route
     * @throws \Exception : if route not found
     */
    public function getRoute(string $name): Route
    {
        if (!isset($this->routes[$name]))
            throw new \Exception("Route with name $name not found");
        return $this->routes[$name];
    }

    /**
     * Get route by path and method
     * @param string $path : route path
     * @param Method $method : route method
     * @return Route : route object
     * @throws \Exception : if route not found
     */
    public function getRouteByPathAndMethod(string $path, Method $method): Route
    {
        $route = null;
        foreach ($this->routes as $r) {
            if ($r->getPath() == $path && $r->getMethod() == $method) {
                $route = $r;
                break;
            }
        }
        if (!$route)
            throw new \Exception("Route with path $path not found");
        return $route;
    }

    /**
     * Handle the request
     */
    public function handle(): void
    {
        $url = parse_url($_SERVER['REQUEST_URI']);
        $method = $_POST["_method"] || $_SERVER['REQUEST_METHOD'];
        switch ($method) {
            case "GET":
                $method = Method::GET;
                break;
            case "POST":
                $method = Method::POST;
                break;
            case "PUT":
                $method = Method::PUT;
                break;
            case "DELETE":
                $method = Method::DELETE;
                break;
        }
        try {
            $route = $this->getRouteByPathAndMethod($url["path"], $method);
            $route->handle();
        } catch (\Exception) {
            notFound();
        }
    }
}