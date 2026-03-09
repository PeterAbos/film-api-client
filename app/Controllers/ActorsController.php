<?php

namespace App\Controllers;

use App\Http\ApiRequest;
use App\Views\Actors\IndexView;

class ActorsController
{
    private ApiRequest $api;

    public function __construct()
    {
        $this->api = new ApiRequest();
    }

    public function index(): string
    {
        $actors = $this->api->get("/actors");
        return (new IndexView($actors))->render();
    }

}