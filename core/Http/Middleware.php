<?php

namespace core\Http;

// handles all the middleware logic
class Middleware
{
    private array $middleware = [];

    public function __construct()
    {
    }

    /**
     * Add middleware to the middleware stack.
     * @param callable $middleware Middleware function
     * @return self : Middleware instance (for chaining)
     */
    public function add(callable $middleware): self
    {
        $this->middleware[] = $middleware;
        return $this;
    }

    /**
     * Run all the middleware in the middleware stack.
     * @return void
     */
    public function run(): void
    {
        foreach ($this->middleware as $middleware) {
            $middleware();
        }
    }
}
