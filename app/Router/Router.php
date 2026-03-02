<?php

namespace App\Router;

class Router
{
    public function dispatch(string $uri): array
    {
        $path = trim(parse_url($uri, PHP_URL_PATH), "/");

        $parts = explode("/", $path);

        $resource = $parts[0] ?: "counties";
        $action = $parts[1] ?? "index";
        $id = $parts[2] ?? null;

        return [$resource, $action, $id];
    }
}