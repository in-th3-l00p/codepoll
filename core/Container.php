<?php

namespace core;

// used for dependency injection
class Container
{
    private $services = [];

    /**
     * used for setting a service
     * @param string $service_name : the name of the added service
     * @param string $service : the service itself
     * @throws \Exception : if a service with @param service_name already exists
     */
    public function bind(string $service_name, mixed $service)
    {
        if (array_key_exists($service_name, $this->services))
            throw new \Exception(
                "service with name \"{$service_name}\" already exists."
            );
        $this->services[$service_name] = $service;
    }

    /**
     * used for getting a service
     * @param string $service_name : the name of the added service
     * @return mixed : the service
     * @throws \Exception : if a service with the given name doesn't exist
     */
    public function resolve(string $service_name)
    {
        if (!array_key_exists($service_name, $this->services))
            throw new \Exception(
                "service with name \"{$service_name}\" doesn't exist"
            );
        return $this->services[$service_name];
    }

    // singleton pattern
    private static $instance = null;

    // The constructor is private to prevent initiation with external code.
    private function __construct()
    {
    }

    // Prevent the instance from being cloned.
    private function __clone()
    {
    }

    // Prevent the instance from being unserialized.
    private function __wakeup()
    {
    }

    /**
     * @return void : the container instance
     */
    public static function initialize(): void
    {
        self::$instance = new self();
    }

    /**
     * gives the application's container instance
     * @throws \Exception : if the container wasn't initialized
     */
    public static function get(): self
    {
        if (self::$instance === null)
            throw new \Exception("container wasn't initialized");
        return self::$instance;
    }
}