<?php

class App
{
    private array $handlers;
    private $notFoundHandler;
    private const METHOD_GET = 'GET';
    private const METHOD_POST = 'POST';

    public function run()
    {
        $this->addNotFoundHandler([NotFoundController::class, "index"]);

        $requestURI = parse_url($_SERVER['REQUEST_URI']);
        $requestPath = $requestURI['path'];

        $method = $_SERVER['REQUEST_METHOD'];

        $callback = null;

        foreach ($this->handlers as $handler) {
            if ($handler['path'] === $requestPath && $method === $handler['method']) {
                $callback = $handler['handler'];
            }
        }

        if (is_array($callback)) {
            $callback = $this->transformHandler($callback);
        } else if (is_string($callback)) {
            $parts = explode("@", $callback);
            $callback = $this->transformHandler($parts);
        }

        if (!$callback) {
            http_response_code(404);
            if (!empty($this->notFoundHandler)) {
                if (is_array($this->notFoundHandler)) {
                    $callback = $this->transformHandler($this->notFoundHandler);
                } else if (is_string($this->notFoundHandler)) {
                    $callback = $this->transformHandler(explode("@", $this->notFoundHandler));
                } else {
                    $callback = $this->notFoundHandler;
                }
            }
        }

        call_user_func_array($callback, [
            array_merge($_GET, $_POST)
        ]);
    }

    public function get(string $path, $handler)
    {
        $this->addHandler(self::METHOD_GET, $path, $handler);
    }

    public function post(string $path, $handler)
    {
        $this->addHandler(self::METHOD_POST, $path, $handler);
    }

    public function addNotFoundHandler($handler)
    {
        $this->notFoundHandler = $handler;
    }

    private function addHandler(string $method, string $path, $handler)
    {
        $this->handlers[$method . $path] = [
            'path' => $path,
            'method' => $method,
            'handler' => $handler,
        ];
    }

    private function transformHandler(array $callback)
    {
        $classController = array_shift($callback);
        require_once(dirname(__FILE__, 2) . "/controllers/" . $classController . ".php");
        $handler = new $classController;
        $method = array_shift($callback);

        return [$handler, $method];
    }
}
