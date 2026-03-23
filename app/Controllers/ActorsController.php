<?php

namespace App\Controllers;

use App\Http\ApiRequest;
use App\Views\Actors\CreateView;
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

    public function create(): string
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->api->post("/actors", [
                "name" => $_POST["name"],
                "birth_date" => $_POST["birth_date"]
            ]);

            header("Location: /actors");
            exit;
        }

        return (new CreateView())->render();
    }

    public function edit(?int $id): string
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->api->put("/actors/$id", [
                "name" => $_POST["name"],
                "birth_date" => $_POST["birth_date"]
            ]);

            header("Location: /actors");
            exit;
        }

        $actor = $this->api->get("/actors/$id");
        return $this->index();
    }
}