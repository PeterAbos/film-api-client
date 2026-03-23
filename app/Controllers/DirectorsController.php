<?php

namespace App\Controllers;

use App\Http\ApiRequest;
use App\Views\Directors\CreateView;
use App\Views\Directors\EditView;
use App\Views\Directors\IndexView;

class DirectorsController
{
    private ApiRequest $api;

    public function __construct()
    {
        $this->api = new ApiRequest();
    }

    public function index(): string
    {
        $directors = $this->api->get("/directors");
        return (new IndexView($directors))->render();
    }

    public function create(): string
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->api->post("/directors", [
                "name" => $_POST["name"],
                "birth_date" => $_POST["birth_date"]
            ]);

            header("Location: /directors");
            exit;
        }

        return (new CreateView())->render();
    }

    public function edit(?int $id): string
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->api->put("/directors/$id", [
                "name" => $_POST["name"],
                "birth_date" => $_POST["birth_date"]
            ]);

            header("Location: /directors");
            exit;
        }

        $director = $this->api->get("/directors/$id");
        return (new EditView($director))->render();
    }

    public function delete(?int $id): void
    {
        $this->api->delete("/directors/$id");

        header("Location: /directors");
        exit;
    }
}