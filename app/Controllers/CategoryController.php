<?php

namespace App\Controllers;

use App\Http\ApiRequest;
use App\Views\Categories\CreateView;
use App\Views\Categories\EditView;
use App\Views\Categories\IndexView;

class CategoryController
{
    private ApiRequest $api;

    public function __construct()
    {
        $this->api = new ApiRequest();
    }

    public function index(): string
    {
        $category = $this->api->get("/category");
        return (new IndexView($category))->render();
    }

    public function create(): string
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->api->post("/category", [
                "name" => $_POST["name"]
            ]);

            header("Location: /category");
            exit;
        }

        return (new CreateView())->render();
    }

    public function edit(?int $id): string
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->api->put("/category/$id", [
                "name" => $_POST["name"]
            ]);

            header("Location: /category");
            exit;
        }

        $category = $this->api->get("/category/$id");
        return (new EditView($category))->render();
    }

    public function delete(?int $id): void
    {
        $this->api->delete("/category/$id");

        header("Location: /category");
        exit;
    }
}