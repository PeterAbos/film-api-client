<?php

namespace App\Controllers;

use App\Http\ApiRequest;
use App\Views\Studios\CreateView;
use App\Views\Studios\EditView;
use App\Views\Studios\IndexView;

class StudioController
{
    private ApiRequest $api;

    public function __construct()
    {
        $this->api = new ApiRequest();
    }

    public function index(): string
    {
        $studios = $this->api->get("/studio");
        return (new IndexView($studios))->render();
    }

    public function create(): string
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->api->post("/studio", [
                "name" => $_POST["name"]
            ]);

            header("Location: /studio");
            exit;
        }

        return (new CreateView())->render();
    }

    public function edit(?int $id): string
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->api->put("/studio/$id", [
                "name" => $_POST["name"]
            ]);

            header("Location: /studio");
            exit;
        }

        $studio = $this->api->get("/studio/$id");
        return (new EditView($studio))->render();
    }

    public function delete(?int $id): void
    {
        $this->api->delete("/studio/$id");

        header("Location: /studio");
        exit;
    }
}