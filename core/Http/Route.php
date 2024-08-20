<?php

namespace core\Http;

const CONTROLLER_BASE_PATH = BASE_PATH . "app/Controller/";

// methods
enum Method {
    case GET;
    case POST;
    case PUT;
    case DELETE;
}

// route mapping
class Route
{
    private string $name;
    private string $route;
    private Method $method;
    private string $controller;

    /**
     * @param string $name
     * @param string $route
     * @param Method $method
     * @param string $controller
     */
    public function __construct(
        string $name,
        string $route,
        Method $method,
        string $controller
    )
    {
        $this->name = $name;
        $this->route = $route;
        $this->method = $method;
        $this->controller = $controller;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPath(): string
    {
        return $this->route;
    }

    public function setRoute(string $route): void
    {
        $this->route = $route;
    }

    public function getMethod(): Method
    {
        return $this->method;
    }

    public function setMethod(Method $method): void
    {
        $this->method = $method;
    }

    public function getController(): string
    {
        return $this->controller;
    }

    public function setController(string $controller): void
    {
        $this->controller = $controller;
    }

    /**
     * Handle the route
     * @return void
     */
    public function handle(): void
    {
        $path = explode(".", $this->controller);
        for ($i = 0; $i < sizeof($path) - 1; $i++)
            $path[$i] = ucfirst($path[$i]);
        require CONTROLLER_BASE_PATH . implode("/", $path) . ".php";
    }
}