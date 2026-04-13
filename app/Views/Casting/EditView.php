<?php

namespace App\Views\Casting;

use App\Views\Layout\LayoutView;

class EditView
{
    public function __construct(
        private array $casting,
        private array $movies,
        private array $actors
    ) {}

    public function render(): string
    {
        $casting = $this->casting;
        $id = $casting["id"];
        $character_name = htmlspecialchars($casting["character_name"]);

        $content = <<<HTML
        <h1>Új szerep létrehozása</h1>

        <form method="post" action="/casting/edit/{$id}" class="form">

            <label for="title">Film címe</label>
            {$this->chooseMovie()}
            <br>

            <label for="actor">Színész neve</label>
            {$this->chooseActor()}
            <br>

            <label for="character_name">Szerep neve</label>
            <input type="text" name="character_name" id="character_name" value="{$character_name}" require>
            <br>

            <button type="submit" class="btn btn-primary">Mentés</button>
            <a href="/casting" class="btn btn-secondary">Mégse</a>

        </form>
        HTML;

        return (new LayoutView($content, "Film módosítása"))->render();
    }

    private function chooseMovie() {
        $id = $this->casting["movie_id"];
        $content = "<select name='movie_id' id='movie_id'>";
        foreach ($this->movies as $movie) {
            $selected = $movie["id"] == $id ? " selected" : "";
            $content .= "<option value='". $movie["id"] ."'". $selected .">". $movie["title"] ."</option>";
        }
        $content .= "</select>";
        return $content;
    }
    private function chooseActor() {
        $id = $this->casting["actor_id"];
        $content = "<select name='actor_id' id='actor_id'>";
        foreach ($this->actors as $actor) {
            $selected = $actor["id"] == $id ? " selected" : "";
            $content .= "<option value='". $actor["id"] ."'". $selected .">". $actor["name"] ."</option>";
        }
        $content .= "</select>";
        return $content;
    }
}