
<?php

class Controller
{
    public function jsonResponse($data = [], $code = 200)
    {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code($code);
        echo json_encode($data);
    }

    public function model($model)
    {
        require_once dirname(__FILE__, 2) . '/models/' . $model . '.php';
        return new $model;
    }
}
