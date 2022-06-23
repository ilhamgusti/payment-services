
<?php

class Controller
{
    /**
     * @param array $data data of result
     * @param number $code HTTP Response Code (default: 200)
     * @return string|false response of JSON encoded string on success or FALSE on failure.
     */
    public function jsonResponse($data = [], $code = 200)
    {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code($code);
        echo json_encode($data);
    }

    /**
     * @param string $model className of Model. ex: Transaksi.
     * @return object Class Object.
     */
    public function model($model)
    {
        require_once dirname(__FILE__, 2) . '/models/' . $model . '.php';
        return new $model;
    }
}
