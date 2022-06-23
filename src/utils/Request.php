<?php

class Request
{
    /**
     * static method for filtering & sanitizing data from params
     * @param array $params array of unfiltered data
     * @param array $only array of selected key
     * @return array filtered & sanitized data params
     */
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
