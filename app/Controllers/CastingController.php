<?php

namespace App\Controllers;

use App\Http\ApiRequest;
use App\Views\Casting\CreateView;
use App\Views\Casting\EditView;
use App\Views\Casting\IndexView;

class CastingController
{
    private ApiRequest $api;

    public function __construct()
    {
        $this->api = new ApiRequest();
    }

    public function index(): string
    {
        $casting = $this->api->get("/casting");
        unset($casting['code']);
        $filled_casting = [];
        foreach ($casting as $cast) {
            $seged = [];
            $seged['id'] = $cast['id'];
            $movie_id = $cast['movie_id'];
            $seged['title'] = $this->api->get("/movies/$movie_id")['title'];
            $actor_id = $cast['actor_id'];
            $seged['actor'] = $this->api->get("/actors/$actor_id")['name'];
            $seged['character_name'] = $cast['character_name'];

            $filled_casting[] = $seged;
        }
        return (new IndexView($filled_casting))->render();
    }

    
    public function create(): string
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->api->post("/casting", [
                "movie_id" => $_POST["movie_id"],
                "actor_id" => $_POST["actor_id"],
                "character_name" => $_POST["character_name"],
            ]);

            header("Location: /casting");
            exit;
        }

        $movies = $this->api->get("/movies");
        unset($movies['code']);
        $actors = $this->api->get("/actors");
        unset($actors['code']);

        return (new CreateView($movies, $actors))->render();
    }

    public function edit(?int $id): string
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->api->put("/casting/$id", [
                "movie_id" => $_POST["movie_id"],
                "actor_id" => $_POST["actor_id"],
                "character_name" => $_POST["character_name"],
            ]);

            header("Location: /casting");
            exit;
        }

        $cast = $this->api->get("/casting/$id");
        $movies = $this->api->get("/movies");
        unset($movies['code']);
        $actors = $this->api->get("/actors");
        unset($actors['code']);

        return (new EditView($cast, $movies, $actors))->render();
    }

    public function delete(?int $id): void
    {
        $this->api->delete("/casting/$id");

        header("Location: /casting");
        exit;
    }
}