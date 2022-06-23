<?php

class Request
{
    public static function only($params, array $only)
    {
        $filtered = [];
        foreach ($only as $key) {
            if (array_key_exists($key, $params)) {
                $filtered[$key] = self::sanitize($params[$key]);
            }
        }
        return $filtered;
    }

    private static function sanitize($data)
    {
        return trim(htmlspecialchars($data));
    }
}
