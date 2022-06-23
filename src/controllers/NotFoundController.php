<?php

class NotFoundController extends Controller
{

    public function index()
    {
        return $this->jsonResponse(["status" => 404, "message" => "Not Found"], 404);
    }
}
