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

            <label for="date">Év</label>
            <input type="number" name="release_year" id="release_year" require>

            <br>

            <button type="submit" class="btn btn-primary">Mentés</button>
            <a href="/movies" class="btn btn-secondary">Mégse</a>

        </form>
        HTML;

        return (new LayoutView($content, "Új film"))->render();
    }

    private function chooseStudio() {
        $content = "<select id='studio_id'>";
        foreach ($this->studios as $studio) {
            $id = $studio['id'];
            $name = $studio['name'];
            $content .= `<option value='$id'>$name</option>`;
        }
        $content .= "</select>";
        return $content;
    }
    private function chooseDirector() {
        $content = "<select id='director_id'>";
        foreach ($this->directors as $director) {
            $id = $director['id'];
            $name = $director['name'];
            $content .= `<option value='$id'>$name</option>`;
        }
        $content .= "</select>";
        return $content;
    }
    private function chooseCategory() {
        $content = "<select id='category_id'>";
        foreach ($this->categories as $category) {
            $id = $category['id'];
            $name = $category['name'];
            $content .= `<option value='$id'>$name</option>`;
        }
        $content .= "</select>";
        return $content;
    }
}