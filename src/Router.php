<?php

class Router
{
    private $_middlewareBefore = [];
    private $_middlewareBeforeAny = [];
    private $_registeredRoutes = [];

    public function beforeAny(callable $callable)
    {
        array_push($this->_middlewareBeforeAny, $callable);
    }

    public function before(string $route, callable $callable)
    {
        $route = $this->formatRoute($route);

        if (!isset($this->_middlewareBefore["GET_{$route}"])) {
            $this->_middlewareBefore["GET_{$route}"] = [];
        }

        array_push($this->_middlewareBefore["GET_{$route}"], $callable);
    }

    public function get(string $route, callable $callable)
    {
        $route = $this->formatRoute($route);
        $this->_registeredRoutes["GET_{$route}"] = $callable;
    }
    
    public function post(string $route, callable $callable)
    {
        $route = $this->formatRoute($route);
        $this->_registeredRoutes["POST_{$route}"] = $callable;
    }

    public function formatRoute(string $route): string
    {
        return $route === '/' ? $route : strtolower(rtrim($route, '/'));
    }
    
    public function resolveRoute(): void
    {
        $method = strtoupper($_SERVER['REQUEST_METHOD']);
        $route = strtolower($_SERVER['REQUEST_URI']);

        $preMiddleware = $this->_middlewareBefore["{$method}_{$route}"] ?? [];
        $callable = $this->_registeredRoutes["{$method}_{$route}"] ?? null;

        if (is_null($callable)) {
            return;
        }

        foreach ($this->_middlewareBeforeAny as $beforeAny) {
            $continue = call_user_func($beforeAny, $_REQUEST);
            if (!$continue) {
                return;
            }
        }

        foreach ($preMiddleware as $pre) {
            $continue = call_user_func($pre, $_REQUEST);
            if (!$continue) {
                return;
            }
        }

        call_user_func($callable, $_REQUEST);
    }
    
    public function __destruct()
    {
        $this->resolveRoute();
    }
}
