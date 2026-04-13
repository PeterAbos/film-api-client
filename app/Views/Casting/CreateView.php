<?php

namespace App\Views\Casting;

use App\Views\Layout\LayoutView;

class CreateView
{
    public function __construct(
        private array $movies,
        private array $actors
    ) {}

    public function render(): string
    {
        $content = <<<HTML
        <h1>Új szerep létrehozása</h1>

        <form method="post" action="/casting/create" class="form">

            <label for="title">Film címe</label>
            {$this->chooseMovie()}
            <br>

            <label for="actor">Színész neve</label>
            {$this->chooseActor()}
            <br>

            <label for="character_name">Szerep neve</label>
            <input type="text" name="character_name" id="character_name" require>
            <br>

            <button type="submit" class="btn btn-primary">Mentés</button>
            <a href="/casting" class="btn btn-secondary">Mégse</a>

        </form>
        HTML;

        return (new LayoutView($content, "Új szerep"))->render();
    }

    private function chooseMovie() {
        $content = "<select name='movie_id' id='movie_id'>";
        foreach ($this->movies as $movie) {
            $content .= "<option value='". $movie["id"] ."'>". $movie["title"] ."</option>";
        }
        $content .= "</select>";
        return $content;
    }
    private function chooseActor() {
        $content = "<select name='actor_id' id='actor_id'>";
        foreach ($this->actors as $actor) {
            $content .= "<option value='". $actor["id"] ."'>". $actor["name"] ."</option>";
        }
        $content .= "</select>";
        return $content;
    }
}