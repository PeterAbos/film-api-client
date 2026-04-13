<?php

namespace App\Controllers;

use App\Http\ApiRequest;
use App\Views\Movies\CreateView;
use App\Views\Movies\EditView;
use App\Views\Movies\IndexView;

class MoviesController
{
    private ApiRequest $api;

    public function __construct()
    {
        $this->api = new ApiRequest();
    }

    public function index(): string
    {
        $movies = $this->api->get("/movies");
        unset($movies['code']);
        $filled_movies = [];
        foreach ($movies as $movie) {
            $seged = [];
            $seged['id'] = $movie['id'];
            $seged['title'] = $movie['title'];
            $seged['duration'] = $movie['duration'];
            $studio_id = $movie['studio_id'];
            $seged['studio'] = $this->api->get("/studio/$studio_id")['name'];
            $director_id = $movie['director_id'];
            $seged['director'] = $this->api->get("/directors/$director_id")['name'];
            $category_id = $movie['category_id'];
            $seged['category'] = $this->api->get("/category/$category_id")['name'];
            $seged['release_year'] = $movie['release_year'];

            $filled_movies[] = $seged;
        }
        return (new IndexView($filled_movies))->render();
    }

    
    public function create(): string
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->api->post("/movies", [
                "title" => $_POST["title"],
                "duration" => $_POST["duration"],
                "studio_id" => $_POST["studio_id"],
                "director_id" => $_POST["director_id"],
                "category_id" => $_POST["category_id"],
                "release_year" => $_POST["release_year"]
            ]);

            header("Location: /movies");
            exit;
        }

        $studios = $this->api->get("/studio");
        unset($studios['code']);
        $directors = $this->api->get("/directors");
        unset($directors['code']);
        $categories = $this->api->get("/category");
        unset($categories['code']);

        return (new CreateView($studios, $directors, $categories))->render();
    }

    public function edit(?int $id): string
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->api->put("/movies/$id", [
                "title" => $_POST["title"],
                "duration" => $_POST["duration"],
                "studio_id" => $_POST["studio_id"],
                "director_id" => $_POST["director_id"],
                "category_id" => $_POST["category_id"],
                "release_year" => $_POST["release_year"]
            ]);

            header("Location: /movies");
            exit;
        }

        $movie = $this->api->get("/movies/$id");
        $studios = $this->api->get("/studio");
        unset($studios['code']);
        $directors = $this->api->get("/directors");
        unset($directors['code']);
        $categories = $this->api->get("/category");
        unset($categories['code']);

        return (new EditView($movie, $studios, $directors, $categories))->render();
    }

    public function delete(?int $id): void
    {
        $this->api->delete("/movies/$id");

        header("Location: /movies");
        exit;
    }
}