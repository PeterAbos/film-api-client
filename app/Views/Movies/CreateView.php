<?php

namespace App\Views\Movies;

use App\Views\Layout\LayoutView;

class CreateView
{
    public function __construct(
        private array $studios,
        private array $directors,
        private array $categories
    ) {}

    public function render(): string
    {
        $content = <<<HTML
        <h1>Új film létrehozása</h1>

        <form method="post" action="/movies/create" class="form">

            <label for="title">Film neve</label>
            <input type="text" id="title" name="title" require>
            <br>

            <label for="duration">Film hossza (perc)</label>
            <input type="number" id="duration" name="duration" require>
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
            <input type="number" name="release_year" id="release_year" require>

            <br>

            <button type="submit" class="btn btn-primary">Mentés</button>
            <a href="/movies" class="btn btn-secondary">Mégse</a>

        </form>
        HTML;

        return (new LayoutView($content, "Új film"))->render();
    }

    private function chooseStudio() {
        if(count($this->studios) == 0) {
            return "<p>NINCS</p>";
        }
        $content = "<select name='studio_id' id='studio_id'>";
        foreach ($this->studios as $studio) {
            $content .= "<option value='". $studio["id"] ."'>". $studio["name"] ."</option>";
        }
        $content .= "</select>";
        return $content;
    }
    private function chooseDirector() {
        $content = "<select name='director_id' id='director_id'>";
        foreach ($this->directors as $director) {
            $content .= "<option value='". $director["id"] ."'>". $director["name"] ."</option>";
        }
        $content .= "</select>";
        return $content;
    }
    private function chooseCategory() {
        $content = "<select name='category_id' id='category_id'>";
        foreach ($this->categories as $category) {
            $content .= "<option value='". $category["id"] ."'>". $category["name"] ."</option>";
        }
        $content .= "</select>";
        return $content;
    }
}