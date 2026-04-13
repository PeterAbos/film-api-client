<?php

namespace App\Views\Movies;

use App\Views\Layout\LayoutView;

class EditView
{
    public function __construct(
        private array $movie,
        private array $studios,
        private array $directors,
        private array $categories
    ) {}

    public function render(): string
    {
        $movie = $this->movie;
        $id = $movie["id"];
        $title = htmlspecialchars($movie["title"]);
        $duration = $movie["duration"];
        $release_year = $movie["release_year"];

        $content = <<<HTML
        <h1>Új film létrehozása</h1>

        <form method="post" action="/movies/edit/{$id}" class="form">

            <label for="title">Film neve</label>
            <input type="text" id="title" name="title" value="{$title}" require>
            <br>

            <label for="duration">Film hossza (perc)</label>
            <input type="number" id="duration" name="duration" value="{$duration}" require>
            <br>

            <label for="studio_id">Studió neve</label>
            {$this->chooseStudio()}
            <br>

            <label for="director_id">Rendező neve</label>
            {$this->chooseDirector()}
            <br> 

            <label for="category_id">Kategória neve</label>
            {$this->chooseCategory()}
            <br>

            <label for="release_year">Év</label>
            <input type="number" name="release_year" id="release_year" value="{$release_year}" require>

            <br>

            <button type="submit" class="btn btn-primary">Mentés</button>
            <a href="/movies" class="btn btn-secondary">Mégse</a>

        </form>
        HTML;

        return (new LayoutView($content, "Film módosítása"))->render();
    }

    private function chooseStudio() {
        $id = $this->movie["studio_id"];
        $content = "<select name='studio_id' id='studio_id'>";
        foreach ($this->studios as $studio) {
            $selected = $studio["id"] == $id ? " selected" : "";
            $content .= "<option value='". $studio["id"] ."'". $selected .">". $studio["name"] ."</option>";
        }
        $content .= "</select>";
        return $content;
    }
    private function chooseDirector() {
        $id = $this->movie["director_id"];
        $content = "<select name='director_id' id='director_id'>";
        foreach ($this->directors as $director) {
            $selected = $director["id"] == $id ? " selected" : "";
            $content .= "<option value='". $director["id"] ."'". $selected .">". $director["name"] ."</option>";
        }
        $content .= "</select>";
        return $content;
    }
    private function chooseCategory() {
        $id = $this->movie["category_id"];
        $content = "<select name='category_id' id='category_id'>";
        foreach ($this->categories as $category) {
            $selected = $category["id"] == $id ? " selected" : "";
            $content .= "<option value='". $category["id"] ."'". $selected .">". $category["name"] ."</option>";
        }
        $content .= "</select>";
        return $content;
    }
}